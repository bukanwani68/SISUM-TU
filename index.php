<?php
session_start();
include "koneksi.php";

// Proteksi halaman: Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// 1. Ambil Data Statistik secara Real-time
// Hitung total surat masuk
$query_masuk = $koneksi->query("SELECT COUNT(*) as total FROM surat_masuk");
$data_masuk = $query_masuk->fetch_assoc();
$total_masuk = $data_masuk['total'];

// Hitung total surat keluar
$query_keluar = $koneksi->query("SELECT COUNT(*) as total FROM surat_keluar");
$data_keluar = $query_keluar->fetch_assoc();
$total_keluar = $data_keluar['total'];

// Hitung total arsip (Gabungan masuk + keluar)
$total_arsip = $total_masuk + $total_keluar;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard TU Kampus - SISUM</title>
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
                <a href="index.php" class="flex items-center p-3 bg-emerald-700 rounded-lg mb-2 shadow-inner">
                    <i class="fas fa-home mr-3 text-emerald-300"></i> Dashboard
                </a>
                <a href="surat-masuk.php" class="flex items-center p-3 hover:bg-emerald-700 rounded-lg mb-2 transition">
                    <i class="fas fa-envelope-open-text mr-3"></i> Surat Masuk
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

        <main class="flex-1">
            <header class="bg-white shadow-sm p-4 flex justify-between items-center border-b border-emerald-100">
                <div class="flex items-center px-2">
                    <h2 class="text-xl font-bold text-emerald-800 italic">
                        Selamat Datang, <span class="italic font-semibold text-emerald-700">di Dashboard SISUM TU 👋</span>
                    </h2>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right mr-2">
                        <p class="text-xs text-gray-400 leading-none">Role:</p>
                        <p class="text-sm font-bold text-emerald-700"><?php echo $_SESSION['role']; ?></p>
                    </div>
                    <div class="w-9 h-9 bg-emerald-600 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-sm">
                        <?php echo substr($_SESSION['nama_lengkap'], 0, 1); ?>
                    </div>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 p-6 mb-2">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-emerald-500">
                    <h3 class="text-x font-bold text-gray-500 uppercase">Surat Masuk</h3>
                    <p class="text-4xl font-black text-emerald-800 mt-2"><?php echo $total_masuk; ?></p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                    <h3 class="text-x font-bold text-gray-500 uppercase">Surat Keluar</h3>
                    <p class="text-4xl font-black text-emerald-800 mt-2"><?php echo $total_keluar; ?></p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-amber-500">
                    <h3 class="text-x font-bold text-gray-500 uppercase">Menunggu TTD</h3>
                    <p class="text-4xl font-black text-emerald-800 mt-2">
                        <?php
                        // 1. Jalankan Query
                        $query_ttd = $koneksi->query("SELECT COUNT(*) as total FROM surat_keluar WHERE status_ttd = 0");
                        $data_ttd  = $query_ttd->fetch_assoc();
                        $total_keluar = $data_ttd['total']; 

                        // 2. Tampilkan hasilnya (Penting!)
                        echo $total_keluar; 
                        ?>
                    </p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-gray-500">
                    <h3 class="text-x font-bold text-gray-500 uppercase">Arsip Selesai</h3>
                    <p class="text-4xl font-black text-emerald-800 mt-2"><?php echo $total_arsip; ?></p>
                </div>
            </div>

            <div class="px-6">
                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-emerald-900 text-lg">Aktivitas Surat Terbaru</h3>
                        <a href="pilih-tipe-surat.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition flex items-center shadow-md">
                            <i class="fas fa-plus mr-2 text-xs"></i> Surat Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-400 text-xs uppercase tracking-widest border-b">
                                    <th class="pb-4">No. Surat</th>
                                    <th class="pb-4">Perihal</th>
                                    <th class="pb-4">Tujuan/Asal</th>
                                    <th class="pb-4">Tipe</th>
                                    <th class="pb-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php
                                // Mengambil 5 aktivitas terbaru dari kedua tabel
                                $sql_terbaru = "(SELECT no_surat, perihal, asal_surat as pihak, 'masuk' as tipe, id_surat as id FROM surat_masuk)
                                                UNION
                                                (SELECT no_surat, perihal, tujuan_surat as pihak, 'keluar' as tipe, id_surat_keluar as id FROM surat_keluar)
                                                ORDER BY id DESC LIMIT 5";
                                $result = $koneksi->query($sql_terbaru);

                                while($row = $result->fetch_assoc()) :
                                ?>
                                <tr class="hover:bg-emerald-50/50 transition">
                                    <td class="py-4 font-mono text-sm text-emerald-700 font-bold"><?php echo $row['no_surat']; ?></td>
                                    <td class="py-4 text-sm text-gray-700"><?php echo $row['perihal']; ?></td>
                                    <td class="py-4 text-sm italic text-gray-500"><?php echo $row['pihak']; ?></td>
                                    <td class="py-4">
                                        <span class="px-2 py-1 rounded text-[10px] font-bold uppercase <?php echo $row['tipe'] == 'masuk' ? 'bg-blue-100 text-blue-600' : 'bg-purple-100 text-purple-600'; ?>">
                                            <?php echo $row['tipe']; ?>
                                        </span>
                                    </td>
                                    <td class="py-4 text-center">
                                        <a href="detail-surat-<?php echo $row['tipe']; ?>.php?id=<?php echo $row['id']; ?>" class="text-emerald-600 hover:text-emerald-800 font-bold text-sm">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>