<?php
require_once '../auth/auth_check.php';
require_once '../auth/db.php';

$products = [];
$bestSellers = [];
$onSale=[];
$error = null;

try {
    $stmt = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Gagal mengambil data produk New Arrival: " . $e->getMessage();
}

try {
    $stmt = $conn->query("SELECT * FROM best_seller ORDER BY created_at DESC");
    $bestSellers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error .= "<br>Gagal mengambil data produk Best Seller: " . $e->getMessage();
}
try {
    $stmt = $conn->query("SELECT * FROM on_sale ORDER BY created_at DESC");
    $onSale = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error .= "<br>Gagal mengambil data produk On Sale: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<div class="container">
    <div class="header-nav">
        <h2>Manajemen Produk</h2>
        <div>
            <span>Halo, <?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?> (<?php echo htmlspecialchars($_SESSION['role']); ?>) | </span>
            <a href="http://localhost:5173/">Halaman Utama</a> |
        </div>
    </div>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="message success">Produk berhasil dihapus.</div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="errors"><?php echo $error; ?></div>
    <?php endif; ?>

    <p><a href="create_product.php" class="btn">Tambah Produk Baru</a></p>

    <h3>Produk New Arrival</h3>
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
                            <a href="edit_product.php?id=<?php echo $p['id']; ?>&type=products" class="btn-edit">Edit</a>
                            <a href="delete_product.php?id=<?php echo $p['id']; ?>&type=product" class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada produk New Arrival.</p>
    <?php endif; ?>

    <h3>Produk Best Seller</h3>
    <?php if (count($bestSellers) > 0): ?>
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
                <?php foreach ($bestSellers as $p): ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td><?php echo htmlspecialchars($p['title']); ?></td>
                        <td><?php echo htmlspecialchars($p['slug']); ?></td>
                        <td>Rp<?php echo number_format($p['price'], 0, ',', '.'); ?></td>
                        <td><?php echo $p['status']; ?></td>
                        <td><?php echo $p['created_at']; ?></td>
                        <td>
                            <!-- Ganti ID di URL jika kamu punya file edit/delete khusus -->
                            <a href="edit_product.php?slug=<?= urlencode($p['slug']) ?>&type=best_seller" class="btn-edit">Edit</a>
                           <a href="delete_product.php?slug=<?php echo urlencode($p['slug']); ?>&type=best_seller" class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk best seller ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada produk Best Seller.</p>
    <?php endif; ?>

    
    <h3>Produk On Sale</h3>
<?php if (count($onSale) > 0): ?>
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
            <?php foreach ($onSale as $p): ?>
                <tr>
                    <td><?php echo $p['id']; ?></td>
                    <td><?php echo htmlspecialchars($p['title']); ?></td>
                    <td><?php echo htmlspecialchars($p['slug']); ?></td>
                    <td>Rp<?php echo number_format($p['price'], 0, ',', '.'); ?></td>
                    <td><?php echo $p['status']; ?></td>
                    <td><?php echo $p['created_at']; ?></td>
                    <td>
                        <a href="edit_product.php?slug=<?= urlencode($p['slug']) ?>&type=on_sale" class="btn-edit">Edit</a>
                        <a href="delete_product.php?slug=<?php echo urlencode($p['slug']); ?>&type=on_sale" class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk on sale ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Belum ada produk On Sale.</p>
<?php endif; ?>

</div>
</body>
</html>
