<?php
require_once '../auth/auth_check.php';
require_once '../auth/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID produk tidak valid.");
}

$id = $_GET['id'];

try {
    // Ambil informasi gambar untuk menghapus file dari server jika perlu
    $stmt = $conn->prepare("SELECT image_1, image_2, image_3, qr_code FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Hapus file gambar (opsional, jika file fisik ingin dihapus)
        $basePath = $_SERVER['DOCUMENT_ROOT'] . '/technologia/vue-project/public';
        foreach (['image_1', 'image_2', 'image_3', 'qr_code'] as $imgField) {
            if (!empty($product[$imgField])) {
                $filePath = $basePath . $product[$imgField];
                if (file_exists($filePath)) {
                    unlink($filePath); // hapus file dari folder /Images/
                }
            }
        }

        // Hapus data dari database
        $delStmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $delStmt->execute([$id]);

        header("Location: list.php?deleted=1");
        exit();
    } else {
        die("Produk tidak ditemukan.");
    }

} catch (PDOException $e) {
    die("Gagal menghapus produk: " . $e->getMessage());
}
