<?php
// Menghubungkan ke database
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil dan membersihkan data input
    $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $nip          = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $username     = mysqli_real_escape_string($koneksi, $_POST['username']);
    $role         = mysqli_real_escape_string($koneksi, $_POST['role']);
    $password     = $_POST['password'];

    // 1. Cek apakah username sudah digunakan
    $cek_user = $koneksi->query("SELECT username FROM user WHERE username = '$username'");
    
    if ($cek_user->num_rows > 0) {
        echo "<script>alert('Username sudah ada, gunakan yang lain!'); window.history.back();</script>";
    } else {
        // 2. Hash password sebelum disimpan ke database
        $password_aman = password_hash($password, PASSWORD_DEFAULT);

        // 3. Masukkan data ke database
        $sql = "INSERT INTO user (username, password, nama_lengkap, nip, role) 
                VALUES ('$username', '$password_aman', '$nama_lengkap', '$nip', '$role')";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script>alert('Pendaftaran Berhasil! Silakan Login.'); window.location='login.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }
} else {
    header("Location: daftar.php");
    exit;
}

$koneksi->close();
?>