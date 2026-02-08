# TODO - Menambah Statistik Penduduk Sementara di Beranda

## Langkah 1: Update BerandaController.php
- [x] Tambah use statement untuk PendudukSementara model
- [x] Tambah variabel jumlah_penduduk_sementara (hitung data dengan status = true)
- [x] Tambah variabel total_penduduk_all (jumlah penduduk + penduduk sementara)

## Langkah 2: Update pages/index.blade.php
- [x] Tambah kartu statistik "Penduduk Sementara" di Statistics Section
- [x] Tambah CSS style untuk stat-card-success (warna hijau)
- [x] Tambah CSS untuk icon sukses (bi-person-badge)
- [x] Tambah kartu "Total Penduduk" (gabungan penduduk tetap + sementara)
- [x] Tambah CSS style untuk stat-card-dark (warna gelap)

## Langkah 3: Halaman Baru - Perkembangan Penduduk
- [x] Buat PerkembanganPendudukController.php
- [x] Tambah route /perkembangan-penduduk di web.php
- [x] Buat view pages/perkembangan-penduduk/index.blade.php

## Isi Halaman Perkembangan Penduduk:
- [x] Summary Cards (Penduduk Tetap, Sementara, Laki-Laki, Perempuan)
- [x] Perkembangan Penduduk (Bulan Ini vs Bulan Lalu) - Kelahiran, Masuk, Keluar, Kematian
- [x] Pie Chart - Jenis Kelamin Penduduk Sementara
- [x] Doughnut Chart - Agama Penduduk Sementara
- [x] Bar Chart - Tujuan Tinggal
- [x] Bar Chart - Kelompok Umur
- [x] Line/Bar Chart - Trend 6 Bulan
- [x] Tabel - Data Penduduk Sementara Terbaru
