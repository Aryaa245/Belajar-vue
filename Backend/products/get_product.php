<?php
require_once '../auth/db.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // hanya untuk pengujian


if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID tidak ditemukan']);
    exit;
}

$slug = $_GET['id'];

try {
    $stmt = $conn->prepare("SELECT * FROM products WHERE slug = ?");
    $stmt->execute([$slug]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Produk tidak ditemukan']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
