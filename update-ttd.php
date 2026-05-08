<?php
session_start();
include "koneksi.php";

// Proteksi: Hanya pimpinan/admin yang bisa akses (opsional)
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
// Ambil data surat untuk ditampilkan infonya
$query = $koneksi->query("SELECT * FROM surat_keluar WHERE id_surat_keluar = '$id'");
$data = $query->fetch_assoc();

// Proses Update File
if (isset($_POST['update'])) {
    $nama_file = $_FILES['file_surat']['name'];
    $source    = $_FILES['file_surat']['tmp_name'];
    $folder    = 'uploads/surat_keluar/';

    // Jika ada file yang diunggah
    if ($nama_file != "") {
        // Hapus file lama jika ada agar tidak memenuhi storage
        if (!empty($data['file_surat']) && file_exists($folder . $data['file_surat'])) {
            unlink($folder . $data['file_surat']);
        }
        
        move_uploaded_file($source, $folder . $nama_file);
        // Cari bagian query UPDATE di update-ttd.php dan ubah jadi begini:
        $update = $koneksi->query("UPDATE surat_keluar SET 
            file_surat = '$nama_file', 
            status_ttd = 1 
            WHERE id_surat_keluar = '$id'");

        if ($update) {
            echo "<script>alert('Surat berhasil ditandatangani digital!'); window.location='surat-keluar.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Update Tanda Tangan - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-emerald-50 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden border border-emerald-100">
        <div class="bg-emerald-800 p-6 text-white">
            <h2 class="text-xl font-bold flex items-center">
                <i class="fas fa-file-signature mr-3"></i> Pengesahan Surat
            </h2>
            <p class="text-emerald-200 text-xs mt-1 italic">Unggah berkas yang sudah ditandatangani</p>
        </div>

        <form action="" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 text-sm">
                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest">No. Surat</p>
                <p class="font-mono text-emerald-700 font-bold mb-2"><?php echo $data['no_surat']; ?></p>
                
                <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest">Perihal</p>
                <p class="text-gray-700 leading-tight"><?php echo $data['perihal']; ?></p>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-bold text-gray-700">Pilih File Scan (PDF/JPG)</label>
                <input type="file" name="file_surat" required
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-emerald-100 rounded-lg p-2">
            </div>

            <div class="flex space-x-3 pt-4">
                <a href="surat-keluar.php" class="flex-1 text-center py-2 text-sm font-bold text-gray-400 hover:text-gray-600 transition">Batal</a>
                <button type="submit" name="update" 
                    class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-lg font-bold shadow-lg transition transform hover:scale-105">
                    Selesai
                </button>
            </div>
        </form>
    </div>

</body>
</html>