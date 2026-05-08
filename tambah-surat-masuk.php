<?php
session_start();
include "koneksi.php";

// Proteksi halaman
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
    <title>Registrasi Surat Masuk - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-emerald-50 font-sans">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-emerald-800 text-white hidden md:block shadow-xl">
            <div class="p-6 text-center border-b border-emerald-700">
                <h1 class="text-2xl font-bold tracking-wider">SISUM <span class="font-light text-emerald-300">TU</span></h1>
            </div>
            <nav class="mt-6 px-4">
                <a href="index.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>
                <a href="surat-masuk.php" class="flex items-center p-3 bg-emerald-700 rounded-lg mb-2 shadow-inner">
                    <i class="fas fa-envelope-open-text mr-3 text-emerald-300 text-emerald-300"></i> Surat Masuk
                </a>
                <a href="surat-keluar.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-paper-plane mr-3"></i> Surat Keluar
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

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="text-sm mb-4">
                    <a href="surat-masuk.php" class="text-emerald-600 hover:underline">Surat Masuk</a>
                    <span class="text-gray-400 mx-2">/</span>
                    <span class="text-gray-500">Registrasi Baru</span>
                </nav>

                <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                    <div class="bg-emerald-700 p-6 text-white text-white">
                        <h2 class="text-xl font-bold flex items-center">
                            <i class="fas fa-file-import mr-3"></i> Registrasi Surat Masuk Baru
                        </h2>
                        <p class="text-emerald-100 text-sm">Pastikan semua data surat terisi dengan benar sesuai fisik surat.</p>
                    </div>

                    <!-- Form mulai di sini -->
                    <!-- Kunci utama upload file: enctype="multipart/form-data" -->
                    <form action="proses-surat-masuk.php" method="POST" enctype="multipart/form-data" class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Nomor Agenda -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">No. Agenda Internal</label>
                                <input type="text" name="no_agenda" placeholder="Contoh: 001/TU-M/2026" class="w-full px-4 py-2 border border-emerald-100 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
                            </div>
                            <!-- Nomor Surat -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">No. Surat (Dari Pengirim)</label>
                                <input type="text" name="no_surat" placeholder="Masukkan nomor asli surat" class="w-full px-4 py-2 border border-emerald-100 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
                            </div>
                            <!-- Tanggal Surat -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Surat</label>
                                <input type="date" name="tgl_surat" class="w-full px-4 py-2 border border-emerald-100 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
                            </div>
                            <!-- Tanggal Diterima -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Diterima</label>
                                <input type="date" name="tgl_terima" value="<?php echo date('Y-m-d'); ?>" class="w-full px-4 py-2 border border-emerald-100 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Asal Surat / Pengirim</label>
                            <input type="text" name="asal_surat" placeholder="Contoh: Kemendikbudristek atau PT. Maju Bersama" class="w-full px-4 py-2 border border-emerald-100 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition" required>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Perihal Surat</label>
                            <textarea name="perihal" rows="3" placeholder="Ringkasan isi surat..." class="w-full px-4 py-2 border border-emerald-100 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none transition" required></textarea>
                        </div>

                        <!-- Upload Lampiran -->
                        <div class="mb-8 p-4 bg-emerald-50 border-2 border-dashed border-emerald-200 rounded-xl text-center">
                            <label class="block text-sm font-bold text-emerald-800 mb-2">Lampiran Digital (Scan Surat)</label>
                            <input type="file" name="file_surat" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-100 file:text-emerald-700 hover:file:bg-emerald-200 cursor-pointer" accept=".pdf,.jpg,.jpeg,.png">
                            <p class="mt-2 text-xs text-emerald-600 italic">*Format: PDF, JPG, atau PNG (Maks 2MB)</p>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="surat-masuk.php" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition font-medium text-gray-600">Batal</a>
                            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-bold shadow-md">Simpan Data Surat</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>