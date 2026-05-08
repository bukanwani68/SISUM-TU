<?php
session_start();
include "koneksi.php";

// Proteksi halaman
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID dari URL
$id = $_GET['id'];

// 1. Cari nama file lampiran dulu sebelum datanya dihapus
$query_file = $koneksi->query("SELECT file_surat FROM surat_masuk WHERE id_surat = '$id'");
$data_file = $query_file->fetch_assoc();
$nama_file = $data_file['file_surat'];

// 2. Hapus file fisik dari folder jika ada
if ($nama_file != null) {
    $lokasi_file = "uploads/surat_masuk/" . $nama_file;
    if (file_exists($lokasi_file)) {
        unlink($lokasi_file); // Menghapus file di folder
    }
}

// 3. Hapus data dari database
$hapus = $koneksi->query("DELETE FROM surat_masuk WHERE id_surat = '$id'");

if ($hapus) {
    echo "<script>
            alert('Data dan file lampiran berhasil dihapus!');
            window.location='surat-masuk.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data!');
            window.location='surat-masuk.php';
          </script>";
}
?>