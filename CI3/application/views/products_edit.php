<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="<?php echo base_url('../CSS/style.css'); ?>">
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
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Produk Laptop</h2>
    <a href="<?php echo base_url('index.php/products/list'); ?>">&larr; Kembali ke daftar produk</a>

    <form method="post" action="<?php echo base_url('index.php/products/edit/' . $product['id']); ?>">

        <label>Slug/ID Produk:
            <input type="text" name="slug" value="<?php echo htmlspecialchars($product['slug']); ?>" required>
        </label>

        <label>Judul Produk:
            <input type="text" name="title" value="<?php echo htmlspecialchars($product['title']); ?>" required>
        </label>

        <label>Spesifikasi Singkat:
            <input type="text" name="specs" value="<?php echo htmlspecialchars($product['specs']); ?>" required>
        </label>

        <label>Harga:
            <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
        </label>

        <label>Harga Lama:
            <input type="number" name="old_price" value="<?php echo $product['old_price']; ?>">
        </label>

        <label>Status:
            <select name="status">
                <option value="In Stock" <?php if ($product['status'] == 'In Stock') echo 'selected'; ?>>In Stock</option>
                <option value="Out of Stock" <?php if ($product['status'] == 'Out of Stock') echo 'selected'; ?>>Out of Stock</option>
            </select>
        </label>

        <label>Kategori:
            <input type="text" name="category" value="<?php echo htmlspecialchars($product['category']); ?>">
        </label>

        <label>Link Pembelian:
            <input type="text" name="buy_link" value="<?php echo htmlspecialchars($product['buy_link']); ?>">
        </label>

        <label>Deskripsi (pisah pakai "|"):
            <textarea name="description" rows="5"><?php echo htmlspecialchars($product['description']); ?></textarea>
        </label>

        <button type="submit">Update Produk</button>

    </form>
</div>

</body>
</html>
