# 🔗 Shortener — URL Shortener Modern

**Shortener** adalah aplikasi web pemendek URL yang bikin link panjang jadi **lebih pendek**, **lebih rapi**, dan tentu saja **lebih kece**.  
Cocok buat kamu yang suka berbagi link tapi males lihat URL sepanjang rel kereta. 🚆✨

---

## 🚀 Fitur Utama

- ✂️ Potong URL panjang jadi super pendek
- 🧩 Custom short code (opsional)
- 📊 Hitung jumlah klik otomatis
- 🌍 Shortlink bisa dibuka tanpa login
- 📋 Tombol copy link
- 🗑️ Hapus link kapan pun
- ⏳ Kadaluarsa link (opsional)
- 🔒 Password-protected link (opsional)
- 📄 QR Code generator (opsional)
- 🧠 Statistik klik (IP, device, browser – opsional)

---

## 🛡️ Fitur Admin

- 🧑‍💼 Dashboard admin lengkap
- 👀 Lihat semua shortlink dari semua user
- 🪪 Lihat siapa pembuat setiap link
- 🛠️ Hapus atau nonaktifkan link
- 🧹 Bersihkan link kadaluarsa
- 👥 Manajemen user (opsional)
- 📈 Statistik global (opsional)

---

## 🧪 Teknologi yang Digunakan

- 🧠 Laravel 12
- 🎨 Blade + Tailwind CSS
- 🔐 Laravel Breeze (Autentikasi)
- 🗃️ MySQL
- 🪙 Alpine.js (opsional)
- 🛡️ Middleware Auth + Role Admin

---

## 📦 Instalasi & Penggunaan

```bash
git clone https://github.com/stevent4/shortener.git
cd shortener

composer install
npm install && npm run build

cp .env.example .env
php artisan key:generate

php artisan migrate

php artisan serve
```

---

## 📁 Struktur Folder Penting

- `app/Models/ShortLink.php` – Model shortlink
- `app/Http/Controllers/ShortLinkController.php` – Shorten & redirect
- `app/Http/Controllers/AdminLinkController.php` – Panel admin
- `resources/views/dashboard/` – UI user
- `resources/views/admin/links/` – UI admin
- `routes/web.php` – Routing aplikasi

---

## 👨‍💻 Tentang Developer

Dibuat oleh **Stevent**, developer yang suka bikin aplikasi kecil tapi berguna, rapi, dan fun.

- 🌐 GitHub: https://github.com/stevent4
- 📷 Instagram: https://instagram.com/a.stevents

---

## 📃 Lisensi

Proyek ini bersifat open-source.  
Silakan digunakan, dipelajari, dan dikembangkan sesuka hati! 🚀✨
