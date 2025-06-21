<?php
require_once '../auth/auth_check.php';
require_once '../auth/db.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $success = false;

    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/technologia/vue-project/public/Images/';

    function uploadImage($fieldName, &$pathVar, &$errors, $label) {
        global $upload_dir;
        $pathVar = '';
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
            $filename = time() . '_' . basename($_FILES[$fieldName]['name']);
            $target_path = $upload_dir . $filename;
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $target_path)) {
                $pathVar = '/Images/' . $filename;
            } else {
                $errors[] = "Gagal upload $label.";
            }
        }
    }

    $conn->beginTransaction();

    try {
        // ✅ Jika admin isi produk New Arrival
        if (!empty($_POST['na_slug'])) {
            $na_slug = $_POST['na_slug'];
            $na_title = $_POST['na_title'];
            $na_specs = $_POST['na_specs'];
            $na_price = $_POST['na_price'];
            $na_old_price = $_POST['na_old_price'];
            $na_status = $_POST['na_status'];
            $na_category = $_POST['na_category'];
            $na_buy_link = $_POST['na_buy_link'];
            $na_description = $_POST['na_description'];

            uploadImage('na_image_1', $na_img1, $errors, 'Gambar 1 - New Arrival');
            uploadImage('na_image_2', $na_img2, $errors, 'Gambar 2 - New Arrival');
            uploadImage('na_image_3', $na_img3, $errors, 'Gambar 3 - New Arrival');
            uploadImage('na_qr_code', $na_qr, $errors, 'QR Code - New Arrival');

            $stmt1 = $conn->prepare("INSERT INTO products (slug, title, specs, price, old_price, status, image_1, image_2, image_3, category, buy_link, description, qr_code)
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->execute([
                $na_slug, $na_title, $na_specs, $na_price, $na_old_price, $na_status,
                $na_img1, $na_img2, $na_img3, $na_category, $na_buy_link, $na_description, $na_qr
            ]);
        }

        // ✅ Jika admin isi produk Best Seller
        if (!empty($_POST['bs_slug'])) {
            $bs_slug = $_POST['bs_slug'];
            $bs_title = $_POST['bs_title'];
            $bs_specs = $_POST['bs_specs'];
            $bs_price = $_POST['bs_price'];
            $bs_old_price = $_POST['bs_old_price'];
            $bs_status = $_POST['bs_status'];
            $bs_category = $_POST['bs_category'];
            $bs_buy_link = $_POST['bs_buy_link'];
            $bs_description = $_POST['bs_description'];

            uploadImage('bs_image_1', $bs_img1, $errors, 'Gambar 1 - Best Seller');
            uploadImage('bs_image_2', $bs_img2, $errors, 'Gambar 2 - Best Seller');
            uploadImage('bs_image_3', $bs_img3, $errors, 'Gambar 3 - Best Seller');
            uploadImage('bs_qr_code', $bs_qr, $errors, 'QR Code - Best Seller');

            $stmt2 = $conn->prepare("INSERT INTO best_seller (slug, title, specs, price, old_price, status, image_1, image_2, image_3, category, buy_link, description, qr_code)
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt2->execute([
                $bs_slug, $bs_title, $bs_specs, $bs_price, $bs_old_price, $bs_status,
                $bs_img1, $bs_img2, $bs_img3, $bs_category, $bs_buy_link, $bs_description, $bs_qr
            ]);
        }

        // ✅ Jika admin isi produk On Sale
if (!empty($_POST['os_slug'])) {
    $os_slug = $_POST['os_slug'];
    $os_title = $_POST['os_title'];
    $os_specs = $_POST['os_specs'];
    $os_price = $_POST['os_price'];
    $os_old_price = $_POST['os_old_price'];
    $os_status = $_POST['os_status'];
    $os_category = $_POST['os_category'];
    $os_buy_link = $_POST['os_buy_link'];
    $os_description = $_POST['os_description'];

    uploadImage('os_image_1', $os_img1, $errors, 'Gambar 1 - On Sale');
    uploadImage('os_image_2', $os_img2, $errors, 'Gambar 2 - On Sale');
    uploadImage('os_image_3', $os_img3, $errors, 'Gambar 3 - On Sale');
    uploadImage('os_qr_code', $os_qr, $errors, 'QR Code - On Sale');

    $stmt3 = $conn->prepare("INSERT INTO on_sale (slug, title, specs, price, old_price, status, image_1, image_2, image_3, category, buy_link, description, qr_code)
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt3->execute([
        $os_slug, $os_title, $os_specs, $os_price, $os_old_price, $os_status,
        $os_img1, $os_img2, $os_img3, $os_category, $os_buy_link, $os_description, $os_qr
    ]);
}


        $conn->commit();
        $success = true;

    } catch (PDOException $e) {
        $conn->rollBack();
        $errors[] = "Gagal menyimpan produk: " . $e->getMessage();
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
    body {
      font-family: sans-serif;
      padding: 20px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group.full-width textarea {
      width: 100%;
    }
    label {
      display: block;
      font-weight: bold;
    }
    input[type="text"], input[type="number"], input[type="file"], select, textarea {
      width: 100%;
      padding: 8px;
      margin-top: 4px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    h3 {
      border-bottom: 2px solid #007bff;
      padding-bottom: 5px;
      margin-top: 30px;
    }
    button {
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <h1>Tambah Produk</h1>
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


  <form method="POST" enctype="multipart/form-data">
    
    <!-- ✅ NEW ARRIVAL -->
    <h3>Produk New Arrival</h3>
    <div class="form-group">
      <label>Slug/ID:</label>
      <input type="text" name="na_slug">
    </div>
    <div class="form-group">
      <label>Judul Produk:</label>
      <input type="text" name="na_title">
    </div>
    <div class="form-group full-width">
      <label>Spesifikasi:</label>
      <textarea name="na_specs" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label>Harga:</label>
      <input type="number" name="na_price">
    </div>
    <div class="form-group">
      <label>Harga Lama:</label>
      <input type="number" name="na_old_price">
    </div>
    <div class="form-group">
      <label>Status:</label>
      <select name="na_status">
        <option value="In Stock">In Stock</option>
        <option value="Out of Stock">Out of Stock</option>
      </select>
    </div>
    <div class="form-group">
      <label>Kategori (pisahkan koma):</label>
      <input type="text" name="na_category">
    </div>
    <div class="form-group">
      <label>Link Pembelian:</label>
      <input type="text" name="na_buy_link">
    </div>
    <div class="form-group">
      <label>Gambar 1 (wajib):</label>
      <input type="file" name="na_image_1">
    </div>
    <div class="form-group">
      <label>Gambar 2:</label>
      <input type="file" name="na_image_2">
    </div>
    <div class="form-group">
      <label>Gambar 3:</label>
      <input type="file" name="na_image_3">
    </div>
    <div class="form-group">
      <label>QR Code:</label>
      <input type="file" name="na_qr_code">
    </div>
    <div class="form-group full-width">
      <label>Deskripsi (pakai | untuk pisah paragraf):</label>
      <textarea name="na_description" rows="5"></textarea>
    </div>

    <!-- ✅ BEST SELLER -->
    <h3>Produk Best Seller</h3>
    <div class="form-group">
      <label>Slug/ID:</label>
      <input type="text" name="bs_slug">
    </div>
    <div class="form-group">
      <label>Judul Produk:</label>
      <input type="text" name="bs_title">
    </div>
    <div class="form-group full-width">
      <label>Spesifikasi:</label>
      <textarea name="bs_specs" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label>Harga:</label>
      <input type="number" name="bs_price">
    </div>
    <div class="form-group">
      <label>Harga Lama:</label>
      <input type="number" name="bs_old_price">
    </div>
    <div class="form-group">
      <label>Status:</label>
      <select name="bs_status">
        <option value="In Stock">In Stock</option>
        <option value="Out of Stock">Out of Stock</option>
      </select>
    </div>
    <div class="form-group">
      <label>Kategori (pisahkan koma):</label>
      <input type="text" name="bs_category">
    </div>
    <div class="form-group">
      <label>Link Pembelian:</label>
      <input type="text" name="bs_buy_link">
    </div>
    <div class="form-group">
      <label>Gambar 1 (wajib):</label>
      <input type="file" name="bs_image_1">
    </div>
    <div class="form-group">
      <label>Gambar 2:</label>
      <input type="file" name="bs_image_2">
    </div>
    <div class="form-group">
      <label>Gambar 3:</label>
      <input type="file" name="bs_image_3">
    </div>
    <div class="form-group">
      <label>QR Code:</label>
      <input type="file" name="bs_qr_code">
    </div>
    <div class="form-group full-width">
      <label>Deskripsi (pakai | untuk pisah paragraf):</label>
      <textarea name="bs_description" rows="5"></textarea>
    </div>

    <!-- ✅ ON SALE -->
    <h3>Produk On Sale</h3>
    <div class="form-group">
      <label>Slug/ID:</label>
      <input type="text" name="os_slug">
    </div>
    <div class="form-group">
      <label>Judul Produk:</label>
      <input type="text" name="os_title">
    </div>
    <div class="form-group full-width">
      <label>Spesifikasi:</label>
      <textarea name="os_specs" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label>Harga:</label>
      <input type="number" name="os_price">
    </div>
    <div class="form-group">
      <label>Harga Lama:</label>
      <input type="number" name="os_old_price">
    </div>
    <div class="form-group">
      <label>Status:</label>
      <select name="os_status">
        <option value="In Stock">In Stock</option>
        <option value="Out of Stock">Out of Stock</option>
      </select>
    </div>
    <div class="form-group">
      <label>Kategori (pisahkan koma):</label>
      <input type="text" name="os_category">
    </div>
    <div class="form-group">
      <label>Link Pembelian:</label>
      <input type="text" name="os_buy_link">
    </div>
    <div class="form-group">
      <label>Gambar 1 (wajib):</label>
      <input type="file" name="os_image_1">
    </div>
    <div class="form-group">
      <label>Gambar 2:</label>
      <input type="file" name="os_image_2">
    </div>
    <div class="form-group">
      <label>Gambar 3:</label>
      <input type="file" name="os_image_3">
    </div>
    <div class="form-group">
      <label>QR Code:</label>
      <input type="file" name="os_qr_code">
    </div>
    <div class="form-group full-width">
      <label>Deskripsi (pakai | untuk pisah paragraf):</label>
      <textarea name="os_description" rows="5"></textarea>
    </div>

    <button type="submit">Simpan Produk</button>
  </form>

</body>
</html>
