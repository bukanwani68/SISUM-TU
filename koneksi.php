<?php
$host = "localhost";    // Nama host (default XAMPP: localhost)
$user = "root";         // Username database (default XAMPP: root)
$pass = "";             // Password database (default XAMPP: kosong)
$db   = "sisum-tu";     // Nama database yang kamu buat tadi

// Membuat koneksi
$koneksi = new mysqli($host, $user, $pass, $db);

// Cek apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// Set charset ke utf8 agar karakter khusus aman
$koneksi->set_charset("utf8");

// Jika berhasil, tidak perlu tampilkan apa-apa (biar bersih)
?>