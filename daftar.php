<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SISUM TU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-emerald-50 flex items-center justify-center min-h-screen py-10">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg border-b-8 border-emerald-700">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-emerald-800">Registrasi Akun Baru</h1>
            <p class="text-gray-500 text-sm">Lengkapi data diri untuk akses tata usaha.</p>
        </div>

        <form action="proses-daftar.php" method="POST" class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="w-full px-4 py-2 border rounded-md focus:border-emerald-500 outline-none" required>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-400 mb-1">NIP (Opsional)</label>
                <input type="text" name="nip" class="w-full px-4 py-2 border rounded-md focus:border-emerald-500 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Username</label>
                    <input type="text" name="username" class="w-full px-4 py-2 border rounded-md focus:border-emerald-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Role</label>
                    <select name="role" class="w-full px-4 py-2 border rounded-md focus:border-emerald-500 outline-none bg-white">
                        <option value="staff">Staff TU</option>
                        <option value="admin">Admin</option>
                        <option value="pimpinan">Pimpinan</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-md focus:border-emerald-500 outline-none" required>
            </div>

            <button type="submit" class="mt-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-lg transition shadow-md">
                DAFTARKAN AKUN
            </button>
        </form>

        <div class="mt-6 text-center border-t pt-4">
            <a href="login.php" class="text-sm text-emerald-600 hover:text-emerald-800 italic">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
            </a>
        </div>
    </div>

</body>
</html>