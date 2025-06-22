<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk CI3</title>
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
        input[type="text"], input[type="number"], textarea, select, input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Tambah Produk Laptop (CI3)</h2>
    <a href="<?php echo site_url('index.php/products'); ?>">Kembali ke daftar produk</a>

    <?php if (isset($success) && $success): ?>
        <div class="message success"><p>Produk berhasil ditambahkan.</p></div>
    <?php endif; ?>

    <form method="post" action="<?php echo base_url('index.php/products/create_form'); ?>" enctype="multipart/form-data">

        <label>Slug/ID Produk:
            <input type="text" name="slug" required>
        </label>
        <label>Judul Produk:
            <input type="text" name="title" required>
        </label>
        <label>Spesifikasi Singkat:
            <input type="text" name="specs" required>
        </label>
        <label>Harga:
            <input type="number" name="price" required>
        </label>
        <label>Harga Lama:
            <input type="number" name="old_price">
        </label>
        <label>Status:
            <select name="status">
                <option value="In Stock">In Stock</option>
                <option value="Out of Stock">Out of Stock</option>
            </select>
        </label>
        <label>Gambar 1:
            <input type="file" name="image_1_file">
        </label>
        <label>Gambar 2:
            <input type="file" name="image_2_file">
        </label>
        <label>Gambar 3:
            <input type="file" name="image_3_file">
        </label>
        <label>Kategori:
            <input type="text" name="category">
        </label>
        <label>Link Pembelian:
            <input type="text" name="buy_link">
        </label>
        <label>Deskripsi (pisah pakai "|"):
            <textarea name="description" rows="5"></textarea>
        </label>
        <label>QR Code:
            <input type="file" name="qr_code_file">
        </label>
        <button type="submit">Simpan Produk</button>
    </form>
</div>
</body>
</html>
