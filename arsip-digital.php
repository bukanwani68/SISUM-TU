<?php
session_start();
include "koneksi.php";

// Proteksi halaman
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil data arsip (gabungan surat masuk dan keluar) yang memiliki lampiran file
$query_arsip = "(SELECT no_surat, perihal, asal_surat as instansi, 'masuk' as tipe, file_surat, tgl_terima as tanggal FROM surat_masuk WHERE file_surat IS NOT NULL)
                UNION
                (SELECT no_surat, perihal, tujuan_surat as instansi, 'keluar' as tipe, file_surat, tgl_surat as tanggal FROM surat_keluar WHERE file_surat IS NOT NULL)
                ORDER BY tanggal DESC";
$tampil_arsip = $koneksi->query($query_arsip);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Digital - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-emerald-50 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-emerald-800 text-white hidden md:block shadow-xl">
            <div class="p-6 text-center border-b border-emerald-700">
                <h1 class="text-2xl font-bold tracking-wider">SISUM <span class="font-light text-emerald-300">TU</span></h1>
            </div>
            <nav class="mt-6 px-4">
                <a href="index.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
                <a href="surat-masuk.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-envelope-open-text mr-3"></i> Surat Masuk
                </a>
                <a href="surat-keluar.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-paper-plane mr-3"></i> Surat Keluar
                </a>
                <a href="arsip-digital.php" class="flex items-center p-3 bg-emerald-700 rounded-lg mb-2 shadow-inner">
                    <i class="fas fa-archive mr-3 text-emerald-300"></i> Arsip Digital
                </a>
                <?php if ($_SESSION['role'] == 'pimpinan') : ?>
                <div class="mt-4 mb-2 px-3 text-[10px] uppercase tracking-widest text-emerald-400 font-bold">
                    Administrator
                </div>
                <a href="pengaturan.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-user-cog mr-3"></i>
                    <span>Pengaturan Akun</span>
                </a>
                <?php endif; ?>
                <div class="border-t border-emerald-700 my-4"></div>
                <a href="logout.php" class="flex items-center p-3 hover:bg-red-700 rounded-lg transition text-emerald-200">
                    <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                </a>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center border-b border-emerald-100">
                <h2 class="text-xl font-bold text-emerald-800 italic">Pusat Arsip Digital</h2>
                <div class="w-9 h-9 bg-emerald-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-sm">Admin</div>
            </header>

            <div class="p-6">
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0"><i class="fas fa-info-circle text-blue-500"></i></div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">Halaman ini hanya menampilkan surat yang telah memiliki <strong>lampiran digital (scan)</strong>.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-emerald-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-emerald-900">Daftar Berkas Terarsip</h3>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-search text-gray-400 text-xs"></i>
                            </span>
                            <input type="text" class="pl-10 pr-4 py-2 border border-emerald-100 rounded-full text-sm focus:ring-2 focus:ring-emerald-500 outline-none w-64" placeholder="Cari arsip...">
                        </div>
                    </div>

                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase tracking-widest">
                            <tr>
                                <th class="p-4">Tanggal Berkas</th>
                                <th class="p-4">No. Surat</th>
                                <th class="p-4">Perihal</th>
                                <th class="p-4">Instansi</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4 text-center">Unduh / Lihat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-sm">
                            <?php while($arsip = $tampil_arsip->fetch_assoc()) : ?>
                            <tr class="hover:bg-emerald-50/50 transition">
                                <td class="p-4 text-gray-600"><?php echo date('d/m/Y', strtotime($arsip['tanggal'])); ?></td>
                                <td class="p-4 font-mono font-bold text-emerald-700"><?php echo $arsip['no_surat']; ?></td>
                                <td class="p-4 text-gray-700"><?php echo $arsip['perihal']; ?></td>
                                <td class="p-4 italic text-gray-500"><?php echo $arsip['instansi']; ?></td>
                                <td class="p-4">
                                    <span class="px-2 py-1 rounded text-[9px] font-bold uppercase <?php echo $arsip['tipe'] == 'masuk' ? 'bg-blue-100 text-blue-600' : 'bg-purple-100 text-purple-600'; ?>">
                                        Surat <?php echo $arsip['tipe']; ?>
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="uploads/surat_<?php echo $arsip['tipe']; ?>/<?php echo $arsip['file_surat']; ?>" target="_blank" class="inline-flex items-center justify-center w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full hover:bg-emerald-600 hover:text-white transition">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>