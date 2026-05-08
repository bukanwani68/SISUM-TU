<?php
session_start();
include "koneksi.php";

// Proteksi halaman: jika belum login, tendang ke login.php
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Ambil data user terbaru dari database berdasarkan session
$id_user = $_SESSION['id_user'];
$query   = $koneksi->query("SELECT * FROM user WHERE id_user = '$id_user'");
$data    = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-emerald-50 font-sans text-gray-800">

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
                <a href="surat-masuk.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-envelope-open-text mr-3"></i> Surat Masuk
                </a>
                <a href="#" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-paper-plane mr-3"></i> Surat Keluar
                </a>
                <a href="arsip-digital.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-archive mr-3"></i> Arsip Digital
                </a>
                <?php if ($_SESSION['role'] == 'pimpinan') : ?>
                <div class="mt-4 mb-2 px-3 text-[10px] uppercase tracking-widest text-emerald-400 font-bold">
                    Administrator
                </div>
                <a href="pengaturan.php" class="flex items-center p-3 bg-emerald-700 rounded-lg mb-2 shadow-inner">
                    <i class="fas fa-user-cog mr-3"></i>
                    <span>Pengaturan Akun</span>
                </a>
                <?php endif; ?>
                <hr class="my-4 border-emerald-700">
                <a href="logout.php" class="flex items-center p-3 hover:bg-red-600 rounded-lg transition text-emerald-200 hover:text-white">
                    <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center border-b border-emerald-100">
                <div class="flex items-center">
                    <h2 class="text-xl font-bold text-emerald-800 italic"><i class="fas fa-user-cog mr-3"></i> Pengaturan Akun</h2>
                </div>
            </header>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- Kiri: Info Profil Ringkas -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border-t-4 border-emerald-600 text-center">
                        <div class="w-24 h-24 bg-emerald-100 rounded-full mx-auto flex items-center justify-center text-emerald-700 text-3xl font-bold mb-4">
                            <?php echo strtoupper(substr($data['nama_lengkap'], 0, 1)); ?>
                        </div>
                        <h3 class="font-bold text-lg text-gray-800"><?php echo $data['nama_lengkap']; ?></h3>
                        <p class="text-sm text-emerald-600 font-medium mb-4 uppercase tracking-wider"><?php echo $data['role']; ?></p>
                        <p class="text-xs text-gray-400 italic">Terakhir login: <br> <?php echo $data['last_login'] ?? '-'; ?></p>
                    </div>

                    <!-- Kanan: Form Update -->
                    <div class="md:col-span-2 space-y-6">
                        
                        <!-- Form Ubah Data Diri -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm">
                            <h4 class="font-bold text-gray-700 mb-4 border-b pb-2">Informasi Pribadi</h4>
                            <form action="proses-update-profil.php" method="POST" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">NIP / Identitas</label>
                                        <input type="text" name="nip" value="<?php echo $data['nip']; ?>" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                                    </div>
                                </div>
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg text-sm font-bold transition">Simpan Perubahan</button>
                            </form>
                        </div>

                        <!-- Form Ubah Password -->
                        <div class="bg-white p-8 rounded-2xl shadow-sm">
                            <h4 class="font-bold text-gray-700 mb-4 border-b pb-2 text-red-600">Keamanan & Password</h4>
                            <form action="proses-update-password.php" method="POST" class="space-y-4">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Password Baru</label>
                                    <input type="password" name="password_baru" placeholder="Minimal 8 karakter" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Konfirmasi Password Baru</label>
                                    <input type="password" name="konfirmasi_password" placeholder="Ulangi password baru" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none" required>
                                </div>
                                <button type="submit" class="bg-gray-800 hover:bg-black text-white px-6 py-2 rounded-lg text-sm font-bold transition">Ganti Password</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>s