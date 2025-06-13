<?php
require_once '../auth/auth_check.php'; // Wajib login
require_once '../auth/db.php';

$errors = [];
$success = false;

// Proses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validasi dasar
    if (empty($username) || empty($nama_lengkap) || empty($email) || empty($password) || empty($role)) {
        $errors[] = "Semua field wajib diisi.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // Jika tidak ada error, simpan ke database
    if (empty($errors)) {
        try {
            // Cek apakah username sudah digunakan
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $errors[] = "Username sudah digunakan.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, nama_lengkap, email, password, role, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                $stmt->execute([$username, $nama_lengkap, $email, $hashedPassword, $role]);

                $_SESSION['message'] = "User baru berhasil ditambahkan.";
                $_SESSION['message_type'] = "success";
                header("Location: index.php"); // Kembali ke daftar user
                exit;
            }
        } catch (PDOException $e) {
            $errors[] = "Gagal menambahkan user: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<div class="container">
    <div class="header-nav">
        <h2>Tambah User Baru</h2>
        <div>
            <a href="index.php">Kembali ke Manajemen User</a>
        </div>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Role:</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>

        <button type="submit" class="btn">Simpan</button>
    </form>
</div>
</body>
</html>