<?php
require_once '../auth/auth_check.php';
require_once '../auth/db.php';

$type = $_GET['type'] ?? null;

if (!$type || !in_array($type, ['product', 'best_seller'])) {
    die("Tipe produk tidak valid.");
}

try {
    if ($type === 'product') {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die("ID produk tidak valid.");
        }

        $id = $_GET['id'];

        // Ambil data produk
        $stmt = $conn->prepare("SELECT slug, image_1, image_2, image_3, qr_code FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Produk tidak ditemukan.");
        }

        // Hapus file gambar
        $basePath = $_SERVER['DOCUMENT_ROOT'] . '/technologia/vue-project/public';
        foreach (['image_1', 'image_2', 'image_3', 'qr_code'] as $imgField) {
            if (!empty($product[$imgField])) {
                $filePath = $basePath . $product[$imgField];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // Hapus dari tabel best_seller (jika ada)
        $delBestSeller = $conn->prepare("DELETE FROM best_seller WHERE slug = ?");
        $delBestSeller->execute([$product['slug']]);

        // Hapus dari tabel products
        $delProduct = $conn->prepare("DELETE FROM products WHERE id = ?");
        $delProduct->execute([$id]);

        header("Location: list.php?deleted=product");
        exit();

    } elseif ($type === 'best_seller') {
        if (!isset($_GET['slug']) || empty($_GET['slug'])) {
            die("Slug produk tidak valid.");
        }

        $slug = $_GET['slug'];

        // Ambil data produk best seller
        $stmt = $conn->prepare("SELECT image_1, image_2, image_3, qr_code FROM best_seller WHERE slug = ?");
        $stmt->execute([$slug]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Produk best seller tidak ditemukan.");
        }

        // Hapus file gambar
        $basePath = $_SERVER['DOCUMENT_ROOT'] . '/technologia/vue-project/public';
        foreach (['image_1', 'image_2', 'image_3', 'qr_code'] as $imgField) {
            if (!empty($product[$imgField])) {
                $filePath = $basePath . $product[$imgField];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // Hapus dari tabel best_seller
        $delStmt = $conn->prepare("DELETE FROM best_seller WHERE slug = ?");
        $delStmt->execute([$slug]);

        header("Location: list.php?deleted=best_seller");
        exit();
    }

} catch (PDOException $e) {
    die("Gagal menghapus: " . $e->getMessage());
}
