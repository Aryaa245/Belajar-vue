<?php
require_once '../auth/db.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // hanya untuk pengujian

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID tidak ditemukan']);
    exit;
}

$slug = $_GET['id'];
$product = null;
$table = ''; // tabel asal produk
$relatedProducts = [];

try {
    // Cek di tabel products
    $stmt = $conn->prepare("SELECT * FROM products WHERE slug = ?");
    $stmt->execute([$slug]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $table = 'products';

    // Jika tidak ditemukan di products
    if (!$product) {
        $stmt = $conn->prepare("SELECT * FROM best_seller WHERE slug = ?");
        $stmt->execute([$slug]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $table = 'best_seller';
    }

    // Jika tidak ditemukan di best_seller
    if (!$product) {
        $stmt = $conn->prepare("SELECT * FROM on_sale WHERE slug = ?");
        $stmt->execute([$slug]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        $table = 'on_sale';
    }

    if ($product) {
        // Ambil 4 produk lain dari tabel yang sama, exclude produk ini
        $stmt = $conn->prepare("SELECT * FROM $table WHERE slug != ? LIMIT 4");
        $stmt->execute([$slug]);
        $relatedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'product' => $product,
            'related' => $relatedProducts,
        ]);
    } else {
        echo json_encode(['error' => 'Produk tidak ditemukan']);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
