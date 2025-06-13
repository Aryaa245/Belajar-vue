<?php
require_once '../auth/auth_check.php'; // Wajib login
require_once '../auth/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = "ID user tidak valid.";
    $_SESSION['message_type'] = "error";
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];

try {
    // Ambil data user berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['message'] = "User tidak ditemukan.";
        $_SESSION['message_type'] = "error";
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Gagal mengambil data user: " . $e->getMessage();
    $_SESSION['message_type'] = "error";
    header("Location: index.php");
    exit;
}

$errors = [];

// Proses form saat disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    $password = $_POST['password'];

    // Validasi
    if (empty($username) || empty($nama_lengkap) || empty($email) || empty($role)) {
        $errors[] = "Semua field kecuali password wajib diisi.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if (empty($errors)) {
        try {
            // Cek apakah username digunakan oleh user lain
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
            $stmt->execute([$username, $id]);
            if ($stmt->fetch()) {
                $errors[] = "Username sudah digunakan oleh user lain.";
            } else {
                // Update data
                if (!empty($password)) {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare("UPDATE users SET username = ?, nama_lengkap = ?, email = ?, password = ?, role = ? WHERE id = ?");
                    $stmt->execute([$username, $nama_lengkap, $email, $hashedPassword, $role, $id]);
                } else {
                    $stmt = $conn->prepare("UPDATE users SET username = ?, nama_lengkap = ?, email = ?, role = ? WHERE id = ?");
                    $stmt->execute([$username, $nama_lengkap, $email, $role, $id]);
                }

                $_SESSION['message'] = "User berhasil diperbarui.";
                $_SESSION['message_type'] = "success";
                header("Location: index.php");
                exit;
            }
        } catch (PDOException $e) {
            $errors[] = "Gagal memperbarui user: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<div class="container">
    <div class="header-nav">
        <h2>Edit User</h2>
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
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

        <label>Nama Lengkap:</label>
        <input type="text" name="nama_lengkap" value="<?php echo htmlspecialchars($user['nama_lengkap']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label>Password (kosongkan jika tidak diubah):</label>
        <input type="password" name="password">

        <label>Role:</label>
        <select name="role" required>
            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
            <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
        </select>

        <button type="submit" class="btn">Simpan Perubahan</button>
    </form>
</div>
</body>
</html>