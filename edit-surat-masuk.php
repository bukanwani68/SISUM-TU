<?php
session_start();
include "koneksi.php";

// 1. Ambil ID dari URL
$id = $_GET['id'];

// 2. Ambil data lama dari database
$query = $koneksi->query("SELECT * FROM surat_masuk WHERE id_surat = '$id'");
$d = $query->fetch_assoc();

if (!$d) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='surat-masuk.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Surat Masuk - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 p-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-8">
        <h2 class="text-2xl font-bold text-emerald-800 mb-6">Edit Data Surat</h2>
        
        <form action="proses-edit-surat.php" method="POST" enctype="multipart/form-data">
            <!-- ID Surat disembunyikan (Hidden) agar bisa diproses PHP -->
            <input type="hidden" name="id_surat" value="<?php echo $d['id_surat']; ?>">

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">No. Surat</label>
                <input type="text" name="no_surat" value="<?php echo $d['no_surat']; ?>" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Asal Surat</label>
                <input type="text" name="asal_surat" value="<?php echo $d['asal_surat']; ?>" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Perihal</label>
                <textarea name="perihal" class="w-full border p-2 rounded"><?php echo $d['perihal']; ?></textarea>
            </div>

            <div class="mb-8 p-4 bg-emerald-50 border-2 border-dashed border-emerald-200 rounded-xl text-center">
                <label class="block text-sm font-bold text-emerald-800 mb-2">Ganti Lampiran (Scan Surat)</label>
                <input type="file" name="file_surat" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png">
                <p class="text-xs text-gray-500 mt-1 italic">File saat ini: <?php echo $d['file_surat'] ?: 'Tidak ada lampiran'; ?></p>
            </div>

            <div class="flex justify-end space-x-3">
                <!-- Tombol Batal -->
                <a href="surat-masuk.php" 
                class="px-6 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition font-medium">
                Batal
                </a>
                
                <!-- Tombol Update Data -->
                <button type="submit" 
                        class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-bold shadow-md">
                        Update Data
                </button>
            </div>
        </form>
    </div>
</body>
</html>