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

// Cegah user menghapus dirinya sendiri
if ($id === $_SESSION['user_id']) {
    $_SESSION['message'] = "Anda tidak dapat menghapus akun Anda sendiri.";
    $_SESSION['message_type'] = "error";
    header("Location: index.php");
    exit;
}

try {
    // Periksa apakah user dengan ID ini ada
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['message'] = "User tidak ditemukan.";
        $_SESSION['message_type'] = "error";
    } else {
        // Hapus user
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);

        $_SESSION['message'] = "User berhasil dihapus.";
        $_SESSION['message_type'] = "success";
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Terjadi kesalahan saat menghapus user: " . $e->getMessage();
    $_SESSION['message_type'] = "error";
}

header("Location: index.php");
exit;