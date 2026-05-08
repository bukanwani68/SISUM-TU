<?php
session_start();
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_user = $_SESSION['id_user'];
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
    $nip  = mysqli_real_escape_string($koneksi, $_POST['nip']);

    $sql = "UPDATE user SET nama_lengkap = '$nama', nip = '$nip' WHERE id_user = '$id_user'";

    if ($koneksi->query($sql) === TRUE) {
        // Update juga data di session supaya nama di header langsung berubah
        $_SESSION['nama_lengkap'] = $nama;
        echo "<script>alert('Profil berhasil diperbarui!'); window.location='pengaturan.php';</script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>