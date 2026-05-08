<?php
include "koneksi.php";

$id = $_GET['id'];

// Ambil nama file lama untuk dihapus dari folder
$cari_file = $koneksi->query("SELECT file_surat FROM surat_keluar WHERE id_surat_keluar = '$id'");
$data = $cari_file->fetch_assoc();

if ($data['file_surat'] != "") {
    unlink("uploads/surat_keluar/" . $data['file_surat']);
}

$query = $koneksi->query("DELETE FROM surat_keluar WHERE id_surat_keluar = '$id'");

if ($query) {
    echo "<script>alert('Surat keluar berhasil dihapus!'); window.location='surat-keluar.php';</script>";
}
?>