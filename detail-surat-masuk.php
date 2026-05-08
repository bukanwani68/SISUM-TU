<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM surat_masuk WHERE id_surat = '$id'");
$d = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Detail Surat - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 p-8">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-emerald-800 p-6 text-white">
            <h2 class="text-xl font-bold">Rincian Surat Masuk</h2>
        </div>
        <div class="p-6">
            <table class="w-full text-left border-collapse">
                <tr class="border-b"><th class="py-3 w-1/3">No. Agenda</th><td>: <?php echo $d['no_agenda']; ?></td></tr>
                <tr class="border-b"><th class="py-3">No. Surat</th><td>: <?php echo $d['no_surat']; ?></td></tr>
                <tr class="border-b"><th class="py-3">Asal Surat</th><td>: <?php echo $d['asal_surat']; ?></td></tr>
                <tr class="border-b"><th class="py-3">Perihal</th><td>: <?php echo $d['perihal']; ?></td></tr>
                <tr class="border-b"><th class="py-3">Tgl Surat</th><td>: <?php echo date('d-m-Y', strtotime($d['tgl_surat'])); ?></td></tr>
                <tr class="border-b"><th class="py-3">Tgl Terima</th><td>: <?php echo date('d-m-Y', strtotime($d['tgl_terima'])); ?></td></tr>
            </table>
            
            <div class="mt-6 flex space-x-3">
                <a href="surat-masuk.php" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                <?php if($d['file_surat']): ?>
                    <a href="uploads/surat_masuk/<?php echo $d['file_surat']; ?>" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded">Buka Lampiran</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>