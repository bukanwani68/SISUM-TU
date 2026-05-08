<?php 
// Wajib menjalankan session di baris paling atas
session_start(); 
include "koneksi.php"; 

// Proteksi: Jika belum login, dialihkan ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keluar - SISUM TU</title>
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
                <a href="surat-keluar.php" class="flex items-center p-3 bg-emerald-700 rounded-lg mb-2 shadow-inner">
                    <i class="fas fa-paper-plane mr-3 text-emerald-300"></i> Surat Keluar
                </a>
                <a href="arsip-digital.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-archive mr-3"></i> Arsip Digital
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
                <a href="logout.php" class="flex items-center p-3 hover:bg-red-700 rounded-lg transition text-emerald-200 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                </a>
            </nav>
        </aside>

        <main class="flex-1">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center border-b border-emerald-100">
                <h2 class="text-xl font-bold text-emerald-800 italic">Daftar Surat Keluar</h2>
                <div class="flex items-center space-x-4">
                    <div class="text-right mr-2">
                        <p class="text-xs text-gray-400 leading-none">Role:</p>
                        <p class="text-sm font-bold text-emerald-700"><?php echo $_SESSION['role']; ?></p>
                    </div>
                    <div class="w-9 h-9 bg-emerald-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-sm uppercase">
                        <?php echo substr($_SESSION['username'], 0, 1); ?>
                    </div>
                </div>
            </header>

            <div class="p-6"> 
            <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                
                <?php if ($_SESSION['role'] !== 'staff') : ?>
                    <a href="tambah-surat-keluar.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg shadow-md transition flex items-center">
                        <i class="fas fa-plus mr-2 text-xs"></i> Registrasi Surat Keluar Baru
                    </a>
                <?php else: ?>
                    <div></div> <?php endif; ?>

                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400 text-xs"></i>
                    </span>
                    <input type="text" class="pl-10 pr-4 py-2 border border-emerald-100 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 outline-none w-full" placeholder="Cari surat...">
                </div>
            </div>

                <div class="py-4"> 
                <div class="bg-white rounded-xl shadow-md border border-emerald-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-emerald-800 text-white text-xs uppercase tracking-wider">
                            <tr>
                                <th class="p-4 font-semibold">Tgl Surat</th>
                                <th class="p-4 font-semibold">No. Surat</th>
                                <th class="p-4 font-semibold">Tujuan</th>
                                <th class="p-4 font-semibold">Perihal</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-emerald-50 text-sm">
                            <?php
                                // Ubah id_surat menjadi id_surat_keluar
                                $tampil = $koneksi->query("SELECT * FROM surat_keluar ORDER BY id_surat_keluar DESC");
                                while($data = $tampil->fetch_assoc()) :
                            ?>
                            <tr class="hover:bg-emerald-50/50 transition">
                                <td class="p-4 text-gray-600"><?php echo date('d M Y', strtotime($data['tgl_surat'])); ?></td>
                                <td class="p-4 font-mono font-bold text-emerald-700"><?php echo $data['no_surat']; ?></td>
                                <td class="p-4 italic text-gray-500"><?php echo $data['tujuan_surat']; ?></td>
                                <td class="p-4"><?php echo $data['perihal']; ?></td>
                                <td class="p-4">
                                    <?php if ($data['status_ttd'] == 0) : ?>
                                        <a href="update-ttd.php?id=<?php echo $data['id_surat_keluar']; ?>" 
                                        class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-bold uppercase hover:bg-amber-200 transition-all shadow-sm border border-amber-200 group">
                                            <i class="fas fa-file-signature mr-2 group-hover:animate-bounce"></i>
                                            Menunggu TTD
                                        </a>
                                    <?php else : ?>
                                        <div class="inline-flex items-center px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-bold uppercase border border-emerald-200">
                                            <i class="fas fa-check-circle mr-2"></i>
                                            Sudah TTD
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-center space-x-2">
                                        
                                        <?php if($_SESSION['role'] == 'pimpinan') : ?>
                                            <a href="edit-surat-keluar.php?id=<?php echo $data['id_surat_keluar']; ?>" 
                                               class="bg-amber-100 text-amber-600 w-8 h-8 rounded flex items-center justify-center hover:bg-amber-600 hover:text-white transition" title="Edit">
                                                <i class="fas fa-edit text-xs"></i>
                                            </a>
                                            <a href="hapus-surat-keluar.php?id=<?php echo $data['id_surat_keluar']; ?>" 
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus data surat keluar ini?')"
                                               class="bg-red-100 text-red-600 w-8 h-8 rounded flex items-center justify-center hover:bg-red-600 hover:text-white transition" title="Hapus">
                                                <i class="fas fa-trash text-xs"></i>
                                            </a>
                                        <?php endif; ?>

                                        <a href="detail-surat-keluar.php?id=<?php echo $data['id_surat_keluar']; ?>" 
                                           class="bg-blue-100 text-blue-600 w-8 h-8 rounded flex items-center justify-center hover:bg-blue-600 hover:text-white transition" title="Detail">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>

                                    </div>
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