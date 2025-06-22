<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Admin</title>
    <link rel="stylesheet" href="<?php echo base_url('CSS/style.css'); ?>">

</head>
<body>
    <div class="container">
        <div class="header-nav">
            <h2>Manajemen Admin</h2>
            <div>
                <span>Halo, <?php echo htmlspecialchars($this->session->userdata('nama_lengkap')); ?> (<?php echo htmlspecialchars($this->session->userdata('role')); ?>) | </span>
                <a href="<?php echo site_url('index.php/products/manage'); ?>">Manajemen Produk</a> |
                <a href="http://localhost:5173/">Halaman Utama</a> |
                <a href="<?php echo base_url('index.php/auth/logout'); ?>">Logout</a>


            </div>
        </div>

        <?php if (isset($message)): ?>
            <div class="message <?php echo $message_type ?? 'success'; ?>">
                <p><?php echo htmlspecialchars($message); ?></p>
            </div>
        <?php endif; ?>

        <p><a href="<?php echo site_url('index.php/users/create'); ?>" class="btn">Tambah Admin Baru</a></p>

        <?php if (count($users) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['nama_lengkap']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars(ucfirst($user['role'])); ?></td>
                            <td><?php echo htmlspecialchars(date('d M Y, H:i', strtotime($user['created_at']))); ?></td>
                            <td>
                                <a href="<?php echo site_url('index.php/users/edit/' . $user['id']); ?>" class="btn-edit">Edit</a>
                                <?php if ($this->session->userdata('user_id') != $user['id']): ?>
                                    <a href="<?php echo site_url('index.php/users/delete/' . $user['id']); ?>" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?');">Hapus</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Belum ada user terdaftar.</p>
        <?php endif; ?>
    </div>
</body>
</html>
