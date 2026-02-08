# TODO - Halaman Frontend Dokumen dengan Download Count & Detail

## ✅ Task List

### Step 1: Database Migration
- [x] 1.1. Create migration untuk menambahkan kolom `download_count` ke tabel `dokumens`

### Step 2: Update Model
- [x] 2.1. Update `app/Models/Dokumen.php` - tambahkan `download_count` ke `$fillable`
- [x] 2.2. Tambahkan accessor `formatted_download_count`

### Step 3: Update Controller
- [x] 3.1. Update `DokumenController.php` - tambahkan method `show($id)` untuk detail view
- [x] 3.2. Update method `download($id)` untuk increment download count
- [x] 3.3. Update `frontendIndex()` untuk passing `jenisDokumens` ke view

### Step 4: Update Routes
- [x] 4.1. Tambah route `frontend.dokumen.show` untuk detail dokumen

### Step 5: Create Views
- [x] 5.1. Create `resources/views/pages/dokumen/show.blade.php` - halaman detail dokumen
- [x] 5.2. Update `resources/views/pages/dokumen/index.blade.php` - tampilkan download count & link ke detail

### Step 6: Update Admin View
- [x] 6.1. Update `resources/views/admin/dokumen/index.blade.php` - tampilkan download count

### Step 7: Update Homepage
- [x] 7.1. Update `resources/views/pages/index.blade.php` - tambah link ke halaman dokumen

### Step 8: Testing
- [ ] 8.1. Test migration
- [ ] 8.2. Test download count increment
- [ ] 8.3. Test detail view page
- [ ] 8.4. Test frontend page dengan download count

---

## 📝 Catatan Implementasi

### Fitur yang akan ditambahkan:
1. **Download Count** - Menghitung berapa kali dokumen di-download
2. **Detail View** - Halaman khusus untuk melihat detail lengkap dokumen
3. **Enhanced Card** - Tampilan kartu dokumen dengan informasi lebih lengkap di frontend
4. **Filter by Jenis** - Filter dokumen berdasarkan jenis di halaman frontend

### Route yang akan ditambahkan:
```php
// Frontend Detail
Route::get('/dokumen/{dokumen}', [DokumenController::class, 'show'])->name('frontend.dokumen.show');
```

### Migration:
```php
Schema::table('dokumens', function (Blueprint $table) {
    $table->integer('download_count')->default(0)->after('is_published');
});
```

---

