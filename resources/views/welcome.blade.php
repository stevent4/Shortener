<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/gif" href="{{ asset('roket.gif') }}">
    <link rel="shortcut icon" type="image/gif" href="{{ asset('roket.gif') }}">
    <title>Welcome | Shortener App</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ?? 'My Shortener' }}">
    <meta property="og:description" content="{{ $description ?? 'Aplikasi Short Link aman & fun!' }}">
    <meta property="og:image" content="{{ $image ?? asset('img.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">

</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Tombol Login dan Register -->
    <div class="absolute top-4 right-4 space-x-3 z-50">
        <a href="{{ route('login') }}"
            class="inline-block px-4 py-2 text-sm font-semibold text-purple-600 border border-purple-600 rounded-full hover:bg-purple-50 transition">
            Login
        </a>
    </div>

    <main class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Deskripsi Aplikasi -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">🔗 Apa Itu Shortener App?</h3>
                <p class="text-gray-600 leading-relaxed">
                    <strong>Shortener App</strong> adalah aplikasi web untuk membuat link pendek dengan mudah, aman, dan
                    cepat.
                    Bisa dibuat privat, menggunakan password, dan dapat memantau statistik klik setiap link.
                    Cocok untuk membagikan link panjang, link sensitif, atau link sementara.
                </p>
            </div>

            <!-- Fitur Saat Ini -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">✅ Fitur yang Tersedia Saat Ini</h3>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>🔹 Short link otomatis atau custom code</li>
                    <li>🔒 Private link dengan password</li>
                    <li>⏳ Setting expired date</li>
                    <li>📊 Statistik klik per link</li>
                    <li>🖥 Admin panel untuk manajemen semua link & user</li>
                    <li>🗑 Penghapusan link otomatis atau manual</li>
                </ul>
            </div>

            <!-- Fitur Mendatang -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">🚀 Fitur Mendatang (Rencana)</h3>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>📱 QR Code untuk setiap short link</li>
                    <li>🔑 Enkripsi end-to-end untuk link sensitif</li>
                    <li>📆 Integrasi dengan kalender & reminder</li>
                    <li>📊 Laporan statistik lanjutan per user/admin</li>
                    <li>🛠 Backup & restore link untuk admin</li>
                </ul>
            </div>

            <!-- Teknologi yang Digunakan -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">🧪 Teknologi yang Digunakan</h3>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>🧠 Laravel 12 (Backend Framework)</li>
                    <li>🎨 Blade + Tailwind CSS (Frontend UI)</li>
                    <li>🗃️ MySQL (Database)</li>
                    <li>🔐 Laravel Breeze untuk autentikasi</li>
                    <li>⚡ Alpine.js untuk interaktivitas ringan</li>
                    <li>🛡️ Middleware Auth + Role (Admin/User)</li>
                </ul>
            </div>

            <!-- Kelebihan & Kekurangan -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">⚖️ Kelebihan & Kekurangan</h3>
                <div class="grid md:grid-cols-2 gap-4 text-gray-600">
                    <div>
                        <h4 class="font-semibold text-green-700">👍 Kelebihan</h4>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Antarmuka sederhana & cepat digunakan</li>
                            <li>Statistik klik real-time</li>
                            <li>Private link dan password</li>
                            <li>Open source & mudah dikembangkan</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-red-700">👎 Kekurangan</h4>
                        <ul class="list-disc list-inside space-y-1">
                            <li>Jika link bocor, bisa diakses orang lain</li>
                            <li>Link yang dihapus tidak bisa dikembalikan</li>
                            <li>Belum ada versi offline</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tentang Developer -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">👨‍💻 Tentang Developer</h3>
                <p class="text-gray-600">
                    Dibuat oleh <strong class="text-purple-700">Stevent</strong>, pengembang web yang tertarik pada
                    privasi,
                    keamanan informasi, dan produktivitas digital. Proyek ini dibangun sebagai pembelajaran dan
                    eksplorasi
                    teknologi Laravel.
                </p>
                <div class="mt-3 flex items-center space-x-4 text-sm text-gray-500">
                    <a href="https://github.com/stevent4" target="_blank" class="hover:text-black underline">🌐
                        GitHub</a>
                    <a href="https://instagram.com/a.stevents" target="_blank" class="hover:text-pink-500 underline">📷
                        Instagram</a>
                </div>
            </div>

            <!-- Catatan -->
            <div class="text-center text-sm text-gray-500 mt-6">
                ✨ Terima kasih telah menggunakan Shortener App! Kritik dan saran selalu diterima 💬
            </div>

        </div>
    </main>
</body>

</html>
