# TODO List - Implementasi Fitur GIS

## Phase 1: Database & Model ✓
- [x] 1. Buat migration untuk menambahkan kolom latitude/longitude ke tabel rt
- [x] 2. Buat migration untuk menambahkan kolom latitude/longitude ke tabel rw
- [x] 3. Update model Rt - tambahkan fillable untuk latitude/longitude
- [x] 4. Update model Rw - tambahkan fillable untuk latitude/longitude

## Phase 2: Controller & Routes ✓
- [x] 5. Buat GisController dengan method:
  - [x] index() - halaman peta GIS
  - [x] apiRtData() - API data statistik RT
  - [x] apiRwData() - API data statistik RW
  - [x] apiAllData() - API semua data RT/RW
- [x] 6. Update routes/web.php - tambahkan route GIS

## Phase 3: Admin Panel - Kelola Koordinat ✓
- [x] 7. Update halaman admin RT/RW dengan input koordinat dan peta Leaflet
- [x] 8. Update infoKelurahanController untuk update koordinat RT/RW
- [x] 9. Update sidebar admin - tambahkan menu GIS RT/RW

## Phase 4: Frontend - Peta GIS Interaktif ✓
- [x] 10. Buat view halaman GIS (Leaflet.js + OpenStreetMap)
- [x] 11. Implementasi peta dengan marker RT/RW
- [x] 12. Popup dengan statistik: total penduduk, gender, kelompok usia, KK
- [x] 13. Chart.js untuk visualisasi gender
- [x] 14. Detail pendidikan dan pekerjaan

## Phase 5: Testing & Refinement
- [ ] 15. Testing fitur GIS di browser
- [ ] 16. Refinement UI/UX

---

## Cara Menggunakan:

### 1. Admin (Input Koordinat):
- Login sebagai admin
- Menu: Info Desa → GIS RT/RW atau langsung klik menu GIS RT/RW di sidebar
- Klik tombol "Edit" pada RT/RW yang ingin ditentukan lokasinya
- Klik pada peta untuk memilih lokasi (auto-fill latitude/longitude)
- Klik "Simpan Perubahan"

### 2. User (Lihat Peta GIS):
- Akses: /gis atau klik menu "GIS Desa" di homepage
- Klik marker RT (biru) atau RW (hijau) untuk melihat detail
- Panel kanan menampilkan statistik lengkap:
  - Total penduduk
  - Jenis kelamin (dengan chart)
  - Kelompok usia (0-14, 15-59, 60+)
  - Jumlah KK
  - Pendidikan tertinggi
  - Pekerjaan utama

### 3. Filter Peta:
- Tombol "Semua" - tampilkan RT dan RW
- Tombol "RT Saja" - hanya tampilkan RT
- Tombol "RW Saja" - hanya tampilkan RW

---

## Catatan:
- Menggunakan Leaflet.js (gratis, open-source)
- Maps: OpenStreetMap (gratis)
- Chart.js untuk visualisasi data

