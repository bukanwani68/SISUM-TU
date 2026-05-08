<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Tipe Surat - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-emerald-50 font-sans min-h-screen flex items-center justify-center p-6">

    <div class="max-w-2xl w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-emerald-800 tracking-wider">SISUM <span class="font-light text-emerald-600">TU</span></h1>
            <p class="text-gray-500 mt-2">Silakan pilih jenis registrasi surat yang ingin Anda buat</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="tambah-surat-masuk.php" class="group bg-white p-8 rounded-2xl shadow-sm border border-emerald-100 hover:border-emerald-500 hover:shadow-xl transition-all duration-300 text-center">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-envelope-open-text text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-emerald-900">Surat Masuk</h3>
                <p class="text-sm text-gray-400 mt-2">Registrasi surat yang diterima dari pihak luar/internal.</p>
                <div class="mt-6 text-blue-600 font-bold text-sm flex items-center justify-center">
                    Pilih <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                </div>
            </a>

            <a href="tambah-surat-keluar.php" class="group bg-white p-8 rounded-2xl shadow-sm border border-emerald-100 hover:border-emerald-500 hover:shadow-xl transition-all duration-300 text-center">
                <div class="w-16 h-16 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas fa-paper-plane text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-emerald-900">Surat Keluar</h3>
                <p class="text-sm text-gray-400 mt-2">Registrasi surat yang dikirimkan ke pihak luar/internal.</p>
                <div class="mt-6 text-purple-600 font-bold text-sm flex items-center justify-center">
                    Pilih <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                </div>
            </a>
        </div>

        <div class="text-center mt-8">
            <a href="index.php" class="text-gray-400 hover:text-emerald-700 transition flex items-center justify-center text-sm">
                <i class="fas fa-times mr-2"></i> Batalkan dan Kembali ke Dashboard
            </a>
        </div>
    </div>

</body>
</html>