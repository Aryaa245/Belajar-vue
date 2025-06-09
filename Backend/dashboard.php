<?php
session_start();
include "db.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? 'user';

    if ($username && $password && $nama && $email) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password, nama_lengkap, email, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $hashed, $nama, $email, $role);

        if ($stmt->execute()) {
            $success = "Akun berhasil dibuat.";
        } else {
            $error = "Gagal membuat akun: " . $stmt->error;
        }
    } else {
        $error = "Semua field harus diisi.";
    }
}

$users = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <style>
        body { font-family: sans-serif; margin: 2em; }
        input, select { margin-bottom: 0.5em; padding: 0.5em; width: 100%; }
        table { width: 100%; border-collapse: collapse; margin-top: 1em; }
        th, td { border: 1px solid #ccc; padding: 0.5em; text-align: left; }
        .form-box { max-width: 400px; margin-bottom: 2em; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, <?= htmlspecialchars($_SESSION['user']['nama_lengkap']) ?></p>
    <a href="logout.php">Logout</a>

    <div id="app">
        <div class="form-box">
            <h2>Buat Akun Baru</h2>
            <form method="POST">
                <input name="username" v-model="username" placeholder="Username" required />
                <input type="password" name="password" v-model="password" placeholder="Password" required />
                <input name="nama" v-model="nama" placeholder="Nama Lengkap" required />
                <input name="email" v-model="email" placeholder="Email" required />
                <select name="role" v-model="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit">Simpan</button>
            </form>
            <p class="success"><?= $success ?></p>
            <p class="error"><?= $error ?></p>
        </div>

        <h2>Daftar User</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php while($u = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($u['username']) ?></td>
                    <td><?= htmlspecialchars($u['nama_lengkap']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['role']) ?></td>
                    <td><?= $u['created_at'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        Vue.createApp({
            data() {
                return {
                    username: '',
                    password: '',
                    nama: '',
                    email: '',
                    role: 'user'
                }
            }
        }).mount('#app');
    </script>
</body>
</html>
