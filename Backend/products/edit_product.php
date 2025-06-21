<?php
require_once '../auth/auth_check.php';
require_once '../auth/db.php';

// Ambil tipe dari query string
$type = $_GET['type'] ?? 'products';
$validTypes = ['products', 'best_seller', 'on_sale'];

if (!in_array($type, $validTypes)) {
    die("Tipe produk tidak valid.");
}

$table = $type;
$errors = [];
$success = false;
$product = null;

try {
    if ($type === 'products') {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die("ID produk tidak valid.");
        }
        $id = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
    } else {
        if (!isset($_GET['slug']) || empty($_GET['slug'])) {
            die("Slug produk tidak valid.");
        }
        $slug = $_GET['slug'];
        $stmt = $conn->prepare("SELECT * FROM $table WHERE slug = ?");
        $stmt->execute([$slug]);
    }

    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    $id = $product['id'] ?? null;

    if (!$product) {
        die("Produk tidak ditemukan.");
    }
} catch (PDOException $e) {
    die("Gagal mengambil data produk: " . $e->getMessage());
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $specs = $_POST['specs'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    $buy_link = $_POST['buy_link'];
    $description = $_POST['description'];

    try {
        $stmt = $conn->prepare("UPDATE $table SET title = ?, specs = ?, price = ?, old_price = ?, status = ?, category = ?, buy_link = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $specs, $price, $old_price, $status, $category, $buy_link, $description, $id]);
        $success = true;

        // Refresh data
        $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $errors[] = "Gagal mengupdate produk: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Produk</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <style>
    form {
      max-width: 700px;
      margin-top: 20px;
    }
    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }
    input[type="text"], input[type="number"], textarea, select {
      width: 100%;
      padding: 8px;
      margin-top: 4px;
      margin-bottom: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    button {
      padding: 10px 16px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
    .message.success {
      background-color: #d4edda;
      padding: 10px;
      border-left: 6px solid #28a745;
      margin-bottom: 20px;
    }
    .errors {
      background-color: #f8d7da;
      padding: 10px;
      border-left: 6px solid #dc3545;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Edit Produk (<?= htmlspecialchars($type) ?>)</h2>
  <a href="list.php?type=<?= urlencode($type) ?>">&larr; Kembali ke daftar produk</a>

  <?php if ($success): ?>
    <div class="message success"><p>Produk berhasil diperbarui.</p></div>
  <?php endif; ?>

  <?php if (!empty($errors)): ?>
    <div class="errors">
      <?php foreach ($errors as $err): ?>
        <p><?= htmlspecialchars($err) ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="post">
    <label>Judul Produk:
      <input type="text" name="title" value="<?= htmlspecialchars($product['title']) ?>" required>
    </label>
    <label>Spesifikasi Singkat:
      <input type="text" name="specs" value="<?= htmlspecialchars($product['specs']) ?>" required>
    </label>
    <label>Harga:
      <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
    </label>
    <label>Harga Lama:
      <input type="number" name="old_price" value="<?= htmlspecialchars($product['old_price']) ?>">
    </label>
    <label>Status:
      <select name="status">
        <option value="In Stock" <?= $product['status'] === 'In Stock' ? 'selected' : '' ?>>In Stock</option>
        <option value="Out of Stock" <?= $product['status'] === 'Out of Stock' ? 'selected' : '' ?>>Out of Stock</option>
      </select>
    </label>
    <label>Kategori:
      <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>">
    </label>
    <label>Link Pembelian:
      <input type="text" name="buy_link" value="<?= htmlspecialchars($product['buy_link']) ?>">
    </label>
    <label>Deskripsi Panjang:
      <textarea name="description" rows="5"><?= htmlspecialchars($product['description']) ?></textarea>
    </label>
    <button type="submit">Simpan Perubahan</button>
  </form>
</div>
</body>
</html>
