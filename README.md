# Web Desa Dotte

## Panduan Hosting di hPanel (Tanpa PHP Artisan Storage:Link)

Jika hosting Anda (seperti hPanel) tidak support `php artisan storage:link`, berikut adalah solusinya:

### Cara 1: Gunakan Route Otomatis (Recommended)

Aplikasi sudah dilengkapi dengan route alternatif yang otomatis mengarahkan semua file dari storage. 

1. Upload semua file ke hosting
2. Import database ke MySQL
3. Setup `.env` file dengan benar
4. Aplikasi akan otomatis bekerja karena route `/storage/{path}` sudah dibuat untuk serve files

### Cara 2: Buat Symlink Manual via Browser

Jika hosting support PHP tapi tidak support symlink via SSH:

1. Upload aplikasi ke hosting
2. Buka URL: `https://domain-anda.com/create-storage-link`
3. Jika berhasil, akan muncul pesan: "✅ Symlink berhasil dibuat!"
4. Hapus atau comment route `/create-storage-link` di `routes/web.php` setelah symlink terbuat

### Catatan Penting

- Semua gambar yang di-upload admin akan tersimpan di `storage/app/public/`
- Route `/storage/{path}` akan secara otomatis serve file dari folder tersebut
- Cache browser perlu di-clear setelah deploy

---

## Instalasi Lokal

```bash
# Clone repository
git clone https://github.com/wahyuumaternate/webDesaSabala.git
cd webDesaSabala

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --seed

# Buat symlink storage (untuk local development)
php artisan storage:link

# Run development server
npm run dev
php artisan serve
```

## Fitur

- Manajemen Berita
- Agenda Desa
- UMKM
- Galeri & Video
- Layanan Surat Online
- Aspirasi Warga
- Bansos (Bantuan Sosial)
- PPID (Pejabat Pengelola Informasi dan Dokumentasi)
- Data Statistik Desa
- dan lainnya...

