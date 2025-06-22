<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link rel="stylesheet" href="<?php echo base_url('CSS/style.css'); ?>">
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
  <a href="<?php echo site_url('index.php/products/manage'); ?>">&larr; Kembali ke daftar produk</a>

  <?php if (isset($success) && $success): ?>
    <div class="message success"><p>Produk berhasil ditambahkan.</p></div>
  <?php endif; ?>

  <?php if (!empty($errors)): ?>
    <div class="errors">
      <?php foreach ($errors as $err): ?>
        <p><?php echo htmlspecialchars($err); ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data" action="<?php echo site_url('index.php/products/create_form'); ?>" class="form-container">
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
