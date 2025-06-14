<?php
require_once '../auth/auth_check.php';
require_once '../auth/db.php';

try {
    $stmt = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $products = [];
    $error = "Gagal mengambil data produk: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<div class="container">
    <h2>Daftar Produk</h2>
    <a href="create_product.php">+ Tambah Produk Baru</a>

    <?php if (isset($error)): ?>
        <div class="errors"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (count($products) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Slug</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo htmlspecialchars($p['title']); ?></td>
                    <td><?php echo htmlspecialchars($p['slug']); ?></td>
                    <td>Rp<?php echo number_format($p['price'], 0, ',', '.'); ?></td>
                    <td><?php echo $p['status']; ?></td>
                    <td><?php echo $p['created_at']; ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $p['id']; ?>">Edit</a> |
                        <a href="delete_product.php?id=<?php echo $p['id']; ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada produk.</p>
    <?php endif; ?>
</div>
</body>
</html>
