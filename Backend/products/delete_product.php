<?php
require_once '../auth/auth_check.php';
require_once '../auth/db.php';

$type = $_GET['type'] ?? null;

if (!$type || !in_array($type, ['product', 'best_seller', 'on_sale'])) {
    die("Tipe produk tidak valid.");
}

try {
    $basePath = $_SERVER['DOCUMENT_ROOT'] . '/technologia/vue-project/public';

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
        foreach (['image_1', 'image_2', 'image_3', 'qr_code'] as $imgField) {
            if (!empty($product[$imgField])) {
                $filePath = $basePath . $product[$imgField];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // Hapus dari best_seller dan on_sale juga jika ada
        $conn->prepare("DELETE FROM best_seller WHERE slug = ?")->execute([$product['slug']]);
        $conn->prepare("DELETE FROM on_sale WHERE slug = ?")->execute([$product['slug']]);

        // Hapus dari products
        $conn->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);

        header("Location: list.php?deleted=product");
        exit();

    } elseif ($type === 'best_seller') {
        if (empty($_GET['slug'])) {
            die("Slug produk tidak valid.");
        }

        $slug = $_GET['slug'];

        $stmt = $conn->prepare("SELECT image_1, image_2, image_3, qr_code FROM best_seller WHERE slug = ?");
        $stmt->execute([$slug]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Produk best seller tidak ditemukan.");
        }

        foreach (['image_1', 'image_2', 'image_3', 'qr_code'] as $imgField) {
            if (!empty($product[$imgField])) {
                $filePath = $basePath . $product[$imgField];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $conn->prepare("DELETE FROM best_seller WHERE slug = ?")->execute([$slug]);

        header("Location: list.php?deleted=best_seller");
        exit();

    } elseif ($type === 'on_sale') {
        if (empty($_GET['slug'])) {
            die("Slug produk tidak valid.");
        }

        $slug = $_GET['slug'];

        $stmt = $conn->prepare("SELECT image_1, image_2, image_3, qr_code FROM on_sale WHERE slug = ?");
        $stmt->execute([$slug]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("Produk on sale tidak ditemukan.");
        }

        foreach (['image_1', 'image_2', 'image_3', 'qr_code'] as $imgField) {
            if (!empty($product[$imgField])) {
                $filePath = $basePath . $product[$imgField];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $conn->prepare("DELETE FROM on_sale WHERE slug = ?")->execute([$slug]);

        header("Location: list.php?deleted=on_sale");
        exit();
    }

} catch (PDOException $e) {
    die("Gagal menghapus: " . $e->getMessage());
}
