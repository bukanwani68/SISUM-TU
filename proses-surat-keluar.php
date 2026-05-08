<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_surat    = mysqli_real_escape_string($koneksi, $_POST['no_surat']);
    $tujuan_surat = mysqli_real_escape_string($koneksi, $_POST['tujuan_surat']);
    $perihal     = mysqli_real_escape_string($koneksi, $_POST['perihal']);
    $tgl_surat   = $_POST['tgl_surat'];
    $id_user     = $_SESSION['id_user'];

    // Logika Upload File
    $nama_file   = $_FILES['file_surat']['name'];
    $tmp_name    = $_FILES['file_surat']['tmp_name'];
    $error_file  = $_FILES['file_surat']['error'];

    if ($error_file === 0) {
        $ekstensi_file = strtolower(pathinfo($nama_file, PATHINFO_EXTENSION));
        $nama_file_baru = uniqid() . '.' . $ekstensi_file;
        // Pastikan folder ini sudah kamu buat!
        $tujuan_upload = 'uploads/surat_keluar/' . $nama_file_baru;

        if (move_uploaded_file($tmp_name, $tujuan_upload)) {
            $file_final = $nama_file_baru;
        } else {
            echo "<script>alert('Gagal upload file!'); window.history.back();</script>";
            exit;
        }
    } else {
        $file_final = null;
    }

    $sql = "INSERT INTO surat_keluar (no_surat, tujuan_surat, perihal, tgl_surat, file_surat, id_user) 
            VALUES ('$no_surat', '$tujuan_surat', '$perihal', '$tgl_surat', '$file_final', '$id_user')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Surat keluar berhasil disimpan!'); window.location='surat-keluar.php';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>