<?php
require_once '../auth/auth_check.php';
require_once '../auth/db.php';

$errors = [];
$success = false;

// Proses saat form dikirim
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

    // Direktori upload absolut
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/technologia/vue-project/public/Images/';

    // Upload Gambar 1
    $image_1 = '';
    if (isset($_FILES['image_1_file']) && $_FILES['image_1_file']['error'] === UPLOAD_ERR_OK) {
        $filename1 = basename($_FILES['image_1_file']['name']);
        $target_path1 = $upload_dir . $filename1;
        if (move_uploaded_file($_FILES['image_1_file']['tmp_name'], $target_path1)) {
            $image_1 = '/Images/' . $filename1;
        } else {
            $errors[] = "Gagal mengupload Gambar 1.";
        }
    } else {
        $errors[] = "Gambar 1 wajib diupload.";
    }

    // Upload Gambar 2
    $image_2 = '';
    if (isset($_FILES['image_2_file']) && $_FILES['image_2_file']['error'] === UPLOAD_ERR_OK) {
        $filename2 = basename($_FILES['image_2_file']['name']);
        $target_path2 = $upload_dir . $filename2;
        if (move_uploaded_file($_FILES['image_2_file']['tmp_name'], $target_path2)) {
            $image_2 = '/Images/' . $filename2;
        } else {
            $errors[] = "Gagal mengupload Gambar 2.";
        }
    }

    // Upload Gambar 3
    $image_3 = '';
    if (isset($_FILES['image_3_file']) && $_FILES['image_3_file']['error'] === UPLOAD_ERR_OK) {
        $filename3 = basename($_FILES['image_3_file']['name']);
        $target_path3 = $upload_dir . $filename3;
        if (move_uploaded_file($_FILES['image_3_file']['tmp_name'], $target_path3)) {
            $image_3 = '/Images/' . $filename3;
        } else {
            $errors[] = "Gagal mengupload Gambar 3.";
        }
    }

    // Upload QR Code
    $qr_code = '';
    if (isset($_FILES['qr_code_file']) && $_FILES['qr_code_file']['error'] === UPLOAD_ERR_OK) {
        $filenameQR = basename($_FILES['qr_code_file']['name']);
        $target_pathQR = $upload_dir . $filenameQR;
        if (move_uploaded_file($_FILES['qr_code_file']['tmp_name'], $target_pathQR)) {
            $qr_code = '/Images/' . $filenameQR;
        } else {
            $errors[] = "Gagal mengupload QR Code.";
        }
    }

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

    <form method="post" enctype="multipart/form-data">
        <label>Slug/ID Produk: <input type="text" name="slug" required></label>
        <label>Judul Produk: <input type="text" name="title" required></label>
        <label>Spesifikasi Singkat: <input type="text" name="specs" required></label>
        <label>Harga: <input type="number" name="price" required></label>
        <label>Harga Lama: <input type="number" name="old_price"></label>
        <label>Status: 
            <select name="status">
                <option value="In Stock">In Stock</option>
                <option value="Out of Stock">Out of Stock</option>
            </select>
        </label>
        <label>Gambar 1 (upload): <input type="file" name="image_1_file" required></label>
        <label>Gambar 2 (upload): <input type="file" name="image_2_file"></label>
        <label>Gambar 3 (upload): <input type="file" name="image_3_file"></label>
        <label>Kategori (dipisah koma): <input type="text" name="category"></label>
        <label>Link Pembelian: <input type="text" name="buy_link"></label>
        <label>Deskripsi Panjang/Detail (pisahkan pakai '|'): <textarea name="description" rows="5"></textarea></label>
        <label>QR Code (upload): <input type="file" name="qr_code_file"></label>

        <button type="submit">Simpan Produk</button>
    </form>
</div>
</body>
</html>
