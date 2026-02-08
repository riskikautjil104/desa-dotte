# TODO - Fitur Dokumen

## Rencana Implementasi

### 1. Database
- [ ] Buat migration untuk tabel `dokumens` dan `jenis_dokumens`
- [ ] Buat Model `Dokumen` dan `JenisDokumen`
- [ ] Buat Seeder untuk kategori dokumen

### 2. Controller
- [ ] Buat `DokumenController` dengan CRUD operations
- [ ] Route untuk frontend dan admin

### 3. Admin Views
- [ ] Index page untuk list dokumen
- [ ] Create page untuk upload dokumen
- [ ] Edit page untuk edit dokumen
- [ ] Delete functionality
- [ ] Kategori management

### 4. Frontend Views
- [ ] Page untuk menampilkan daftar dokumen
- [ ] Filter berdasarkan kategori
- [ ] Download functionality

### 5. Sidebar
- [ ] Tambah menu "Dokumen" di sidebar admin

### 6. Bottom Navigation
- [ ] Tambah menu "Dokumen" di bottom navigation mobile

---

## Struktur Tabel

### Tabel: dokumens
- id (bigint, primary key)
- nama_dokumen (string)
- deskripsi (text)
- jenis_dokumen_id (bigint, foreign key)
- file_path (string)
- ukuran_file (string)
- created_at (timestamp)
- updated_at (timestamp)

### Tabel: jenis_dokumens
- id (bigint, primary key)
- nama_jenis (string) - contoh: PDF, Excel, Word, PPT
- icon (string) - Bootstrap Icons class
- created_at (timestamp)
- updated_at (timestamp)

---

## Kategori Dokumen Default
1. PDF - bi-file-earmark-pdf
2. Excel - bi-file-earmark-excel
3. Word - bi-file-earmark-word
4. PowerPoint - bi-file-earmark-ppt
5. ZIP - bi-file-earmark-zip
6. Gambar - bi-file-earmark-image
7. Lainnya - bi-file-earmark

