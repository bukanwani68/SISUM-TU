<?php
session_start();
include "koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_SESSION['id_user'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // 1. Validasi minimal karakter (contoh: minimal 8 karakter)
    if (strlen($password_baru) < 8) {
        echo "<script>alert('Password minimal 8 karakter!'); window.history.back();</script>";
        exit;
    }

    // 2. Cek apakah password baru dan konfirmasi cocok
    if ($password_baru !== $konfirmasi_password) {
        echo "<script>alert('Konfirmasi password tidak cocok!'); window.history.back();</script>";
        exit;
    }

    // 3. Hash password baru
    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

    // 4. Update ke database
    $sql = "UPDATE user SET password = '$password_hash' WHERE id_user = '$id_user'";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Password berhasil diperbarui!'); window.location='pengaturan.php';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
} else {
    header("Location: pengaturan.php");
    exit;
}

$koneksi->close();
?>