<?php
require_once '../auth/db.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

try {
    $stmt = $conn->query("SELECT * FROM best_seller ORDER BY created_at DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($products);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
