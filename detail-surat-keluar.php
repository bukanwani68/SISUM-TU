<?php
include "koneksi.php";
$id = $_GET['id'];
$query = $koneksi->query("SELECT * FROM surat_keluar WHERE id_surat_keluar = '$id'");
$d = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Detail Surat Keluar - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-emerald-50 p-8 text-gray-800">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-emerald-800 p-6 text-white">
            <h2 class="text-xl font-bold italic">Rincian Surat Keluar</h2>
        </div>
        <div class="p-6">
            <table class="w-full text-left">
                <tr class="border-b"><th class="py-3 w-1/3 text-emerald-700">No. Surat</th><td>: <?php echo $d['no_surat']; ?></td></tr>
                <tr class="border-b"><th class="py-3 text-emerald-700">Tujuan</th><td>: <?php echo $d['tujuan_surat']; ?></td></tr>
                <tr class="border-b"><th class="py-3 text-emerald-700">Perihal</th><td>: <?php echo $d['perihal']; ?></td></tr>
                <tr class="border-b"><th class="py-3 text-emerald-700">Tanggal</th><td>: <?php echo date('d-m-Y', strtotime($d['tgl_surat'])); ?></td></tr>
            </table>
            
            <div class="mt-8 flex space-x-3">
                <a href="surat-keluar.php" class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition">Kembali</a>
                <?php if($d['file_surat']): ?>
                    <a href="uploads/surat_keluar/<?php echo $d['file_surat']; ?>" target="_blank" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">Lihat Lampiran</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>