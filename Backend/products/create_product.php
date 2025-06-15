<?php
require_once '../auth/auth_check.php';
require_once '../auth/db.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $slug = $_POST['slug'];
    $title = $_POST['title'];
    $specs = $_POST['specs'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    $buy_link = $_POST['buy_link'];
    $description = $_POST['description'];

    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/technologia/vue-project/public/Images/';

    function uploadImage($fieldName, &$pathVar, &$errors, $label) {
        global $upload_dir;
        $pathVar = '';
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
            $filename = basename($_FILES[$fieldName]['name']);
            $target_path = $upload_dir . $filename;
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $target_path)) {
                $pathVar = '/Images/' . $filename;
            } else {
                $errors[] = "Gagal mengupload $label.";
            }
        }
    }

    uploadImage('image_1_file', $image_1, $errors, 'Gambar 1');
    uploadImage('image_2_file', $image_2, $errors, 'Gambar 2');
    uploadImage('image_3_file', $image_3, $errors, 'Gambar 3');
    uploadImage('qr_code_file', $qr_code, $errors, 'QR Code');

    if (empty($image_1)) $errors[] = "Gambar 1 wajib diupload.";

    if (empty($errors)) {
        try {
            $stmt = $conn->prepare("INSERT INTO products (slug, title, specs, price, old_price, status, image_1, image_2, image_3, category, buy_link, description, qr_code)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $slug, $title, $specs, $price, $old_price, $status,
                $image_1, $image_2, $image_3, $category, $buy_link, $description, $qr_code
            ]);
            $success = true;
        } catch (PDOException $e) {
            $errors[] = "Gagal menambahkan produk: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="../CSS/style.css">
<style>
  .form-container {
    max-width: 900px;
    margin-top: 30px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px 40px;
  }

  .form-group {
    display: flex;
    flex-direction: column;
  }

  .form-group label {
    font-weight: bold;
    margin-bottom: 6px;
  }

  .form-group input,
  .form-group textarea,
  .form-group select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
  }

  .full-width {
    grid-column: span 2;
  }

  button {
    grid-column: span 2;
    padding: 12px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
  }

  button:hover {
    background-color: #45a049;
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
  <h2>Tambah Produk Laptop</h2>
  <a href="list.php">&larr; Kembali ke daftar produk</a>

  <?php if ($success): ?>
    <div class="message success"><p>Produk berhasil ditambahkan.</p></div>
  <?php endif; ?>

  <?php if (!empty($errors)): ?>
    <div class="errors">
      <?php foreach ($errors as $err): ?>
        <p><?php echo htmlspecialchars($err); ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="form-container">
  <div class="form-group">
    <label>Slug/ID Produk:</label>
    <input type="text" name="slug" required>
  </div>

  <div class="form-group">
    <label>Judul Produk:</label>
    <input type="text" name="title" required>
  </div>

  <div class="form-group">
    <label>Spesifikasi Singkat:</label>
    <input type="text" name="specs" required>
  </div>

  <div class="form-group">
    <label>Harga:</label>
    <input type="number" name="price" required>
  </div>

  <div class="form-group">
    <label>Harga Lama:</label>
    <input type="number" name="old_price">
  </div>

  <div class="form-group">
    <label>Status:</label>
    <select name="status">
      <option value="In Stock">In Stock</option>
      <option value="Out of Stock">Out of Stock</option>
    </select>
  </div>

  <div class="form-group">
    <label>Kategori (dipisah koma):</label>
    <input type="text" name="category">
  </div>

  <div class="form-group">
    <label>Link Pembelian:</label>
    <input type="text" name="buy_link">
  </div>

  <div class="form-group">
    <label>Gambar 1 (wajib):</label>
    <input type="file" name="image_1_file" required>
  </div>

  <div class="form-group">
    <label>Gambar 2:</label>
    <input type="file" name="image_2_file">
  </div>

  <div class="form-group">
    <label>Gambar 3:</label>
    <input type="file" name="image_3_file">
  </div>

  <div class="form-group">
    <label>QR Code:</label>
    <input type="file" name="qr_code_file">
  </div>

  <div class="form-group full-width">
    <label>Deskripsi Panjang/Detail (pisahkan pakai '|'):</label>
    <textarea name="description" rows="5"></textarea>
  </div>

  <button type="submit">Simpan Produk</button>
</form>

</div>
</body>
</html>
