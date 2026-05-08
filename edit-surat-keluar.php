<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM surat_keluar WHERE id_surat_keluar = '$id'");
$d = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Edit Surat Keluar - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 p-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-md p-8">
        <h2 class="text-2xl font-bold text-emerald-800 mb-6">Edit Surat Keluar</h2>
        
        <form action="proses-edit-surat-keluar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_surat_keluar" value="<?php echo $d['id_surat_keluar']; ?>">

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">No. Surat</label>
                <input type="text" name="no_surat" value="<?php echo $d['no_surat']; ?>" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Tujuan Surat</label>
                <input type="text" name="tujuan_surat" value="<?php echo $d['tujuan_surat']; ?>" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-2">Perihal</label>
                <textarea name="perihal" class="w-full border p-2 rounded" required><?php echo $d['perihal']; ?></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold mb-2">Ganti Lampiran (PDF/JPG)</label>
                <input type="file" name="file_surat" class="w-full text-sm">
                <p class="text-xs text-gray-500 mt-1 italic">File lama: <?php echo $d['file_surat']; ?></p>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="surat-keluar.php" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition font-medium">Batal</a>
                <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-bold shadow-md">Update Data</button>
            </div>
        </form>
    </div>
</body>
</html>