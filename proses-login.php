<?php
// Memulai session untuk menyimpan data login
session_start();

// Menghubungkan ke database
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form login
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Mencari user berdasarkan username
    $query  = "SELECT * FROM user WHERE username = '$username'";
    $result = $koneksi->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password yang di-hash
        if (password_verify($password, $row['password'])) {
            
            // Login Berhasil! Simpan data ke session
            $_SESSION['login']       = true;
            $_SESSION['id_user']     = $row['id_user'];
            $_SESSION['username']    = $row['username'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['role']        = $row['role'];

            // Update waktu login terakhir (opsional)
            $id_user = $row['id_user'];
            $koneksi->query("UPDATE user SET last_login = NOW() WHERE id_user = '$id_user'");

            // Alihkan ke halaman dashboard
            header("Location: index.php");
            exit;
        } else {
            // Password salah
            echo "<script>alert('Password salah!'); window.location='login.php';</script>";
        }
    } else {
        // Username tidak ditemukan
        echo "<script>alert('Username tidak terdaftar!'); window.location='login.php';</script>";
    }
} else {
    // Jika diakses tanpa submit form, kembalikan ke login
    header("Location: login.php");
    exit;
}
?>