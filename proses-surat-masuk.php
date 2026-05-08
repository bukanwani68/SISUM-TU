<?php
session_start();
include "koneksi.php";

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $no_agenda   = mysqli_real_escape_string($koneksi, $_POST['no_agenda']);
    $no_surat    = mysqli_real_escape_string($koneksi, $_POST['no_surat']);
    $asal_surat  = mysqli_real_escape_string($koneksi, $_POST['asal_surat']);
    $perihal     = mysqli_real_escape_string($koneksi, $_POST['perihal']);
    $tgl_surat   = $_POST['tgl_surat'];
    $tgl_terima  = $_POST['tgl_terima'];
    $id_user     = $_SESSION['id_user']; // ID admin yang sedang login

    // Pengaturan Upload File
    $nama_file   = $_FILES['file_surat']['name'];
    $ukuran_file = $_FILES['file_surat']['size'];
    $error_file  = $_FILES['file_surat']['error'];
    $tmp_name    = $_FILES['file_surat']['tmp_name'];

    // Cek apakah ada file yang diupload
    if ($error_file === 0) {
        $ekstensi_valid = ['pdf', 'jpg', 'jpeg', 'png'];
        $ekstensi_file  = explode('.', $nama_file);
        $ekstensi_file  = strtolower(end($ekstensi_file));

        // Validasi ekstensi
        if (!in_array($ekstensi_file, $ekstensi_valid)) {
            echo "<script>alert('Format file tidak didukung!'); window.history.back();</script>";
            exit;
        }

        // Validasi ukuran (maks 2MB)
        if ($ukuran_file > 2000000) {
            echo "<script>alert('Ukuran file terlalu besar (Maks 2MB)!'); window.history.back();</script>";
            exit;
        }

        // Generate nama file baru agar tidak bentrok
        $nama_file_baru = uniqid() . '.' . $ekstensi_file;
        $tujuan_upload  = 'uploads/surat_masuk/' . $nama_file_baru;

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($tmp_name, $tujuan_upload)) {
            $file_final = $nama_file_baru;
        } else {
            echo "<script>alert('Gagal mengupload file!'); window.history.back();</script>";
            exit;
        }
    } else {
        $file_final = null; // Jika tidak ada lampiran
    }

    // Simpan ke Database
    $sql = "INSERT INTO surat_masuk (no_agenda, no_surat, asal_surat, perihal, tgl_surat, tgl_terima, file_surat, id_user) 
            VALUES ('$no_agenda', '$no_surat', '$asal_surat', '$perihal', '$tgl_surat', '$tgl_terima', '$file_final', '$id_user')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Surat masuk berhasil diregistrasi!'); window.location='surat-masuk.php';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
} else {
    header("Location: proses-simpan-surat.php");
    exit;
}
?>