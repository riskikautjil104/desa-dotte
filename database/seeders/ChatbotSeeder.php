<?php

namespace Database\Seeders;

use App\Models\ChatbotFAQ;
use App\Models\ChatbotConversation;
use App\Models\ChatbotFeedback;
use App\Models\ChatbotIntent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatbotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ChatbotFeedback::truncate();
        ChatbotConversation::truncate();
        ChatbotFAQ::truncate();
        ChatbotIntent::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create Intents
        $intents = [
            [
                'name' => 'greeting',
                'display_name' => 'Sapaan',
                'description' => 'Respons untuk sapaan dan salam',
                'response_template' => "Halo! 👋 Selamat datang di Website Desa Oyalo. Saya asisten virtual yang siap membantu Anda.\n\nAda yang bisa saya bantu hari ini?",
                'response_type' => 'suggestions',
                'quick_actions' => [
                    ['label' => '📊 Data Penduduk', 'action' => 'data_penduduk'],
                    ['label' => '🏛️ Profil Desa', 'action' => 'profil_desa'],
                    ['label' => '📄 Layanan', 'action' => 'layanan'],
                    ['label' => '💼 UMKM', 'action' => 'umkm']
                ],
                'suggested_questions' => [
                    'Berapa jumlah penduduk desa?',
                    'Bagaimana cara membuat surat?',
                    'Apa saja program bansos?',
                    'Dimana lokasi kantor desa?'
                ],
                'priority' => 100,
                'is_active' => true,
            ],
            [
                'name' => 'informasi_desa',
                'display_name' => 'Informasi Desa',
                'description' => 'Informasi umum tentang desa',
                'response_template' => "Desa Oyalo berlokasi di Kecamatan Morotai Selatan, Kabupaten Pulau Morotai, Provinsi Maluku Utara.\n\nDesa kami tersebar di beberapa RT/RW dengan jumlah penduduk yang terus berkembang. Kami berkomitmen untuk memberikan pelayanan terbaik kepada masyarakat.",
                'response_type' => 'card',
                'quick_actions' => [
                    ['label' => '👨‍💼 Kepala Desa', 'action' => 'kepala_desa'],
                    ['label' => '📜 Sejarah', 'action' => 'sejarah'],
                    ['label' => '🎯 Visi Misi', 'action' => 'visi_misi'],
                    ['label' => '🏗️ Struktur', 'action' => 'struktur']
                ],
                'suggested_questions' => [
                    'Siapa kepala desa?',
                    'Apa sejarah desa?',
                    'Apa visi dan misi desa?',
                    'Bagaimana struktur organisasi?'
                ],
                'priority' => 90,
                'is_active' => true,
            ],
            [
                'name' => 'kepala_desa',
                'display_name' => 'Kepala Desa',
                'description' => 'Informasi kepala desa',
                'response_template' => "Kepala Desa Oyalo memimpin dengan prinsip transparansi dan akuntabilitas.\n\nBeliau berkomitmen untuk meningkatkan kualitas pelayanan kepada masyarakat dan mengembangkan potensi desa.",
                'response_type' => 'card',
                'quick_actions' => [
                    ['label' => '📜 Sambutan', 'action' => 'sambutan'],
                    ['label' => '📞 Kontak', 'action' => 'kontak']
                ],
                'suggested_questions' => [
                    'Apa pesan kepala desa?',
                    'Jam kerja kantor desa?'
                ],
                'priority' => 85,
                'is_active' => true,
            ],
            [
                'name' => 'visi_misi',
                'display_name' => 'Visi Misi',
                'description' => 'Visi dan misi desa',
                'response_template' => "📋 VISI DESA OYALO:\n\"Mewujudkan Desa Oyalo yang maju, sejahtera, mandiri, dan berbudaya\"\n\n🎯 MISI DESA OYALO:\n1. Meningkatkan kualitas sumber daya manusia\n2. Mengembangkan ekonomi lokal dan UMKM\n3. Meningkatkan tata kelola pemerintahan yang baik\n4. Memelihara budaya dan kearifan lokal\n5. Meningkatkan infrastruktur dan fasilitas umum",
                'response_type' => 'list',
                'quick_actions' => [
                    ['label' => '📜 Sejarah', 'action' => 'sejarah'],
                    ['label' => '🏗️ Struktur', 'action' => 'struktur']
                ],
                'suggested_questions' => [
                    'Apa sejarah desa?',
                    'Siapa pengurus desa?'
                ],
                'priority' => 80,
                'is_active' => true,
            ],
            [
                'name' => 'data_penduduk',
                'display_name' => 'Data Penduduk',
                'description' => 'Informasi data penduduk',
                'response_template' => "📊 Data Penduduk Desa Oyalo\n\nSilakan查看 Data Penduduk untuk informasi lengkap:\n• Total jumlah penduduk\n• Distribusi jenis kelamin\n• Peringkat RT/RW\n• Tingkat pendidikan\n• Jenis pekerjaan\n• Agama",
                'response_type' => 'suggestions',
                'quick_actions' => [
                    ['label' => '📊 Lihat Dashboard', 'action' => 'dashboard_penduduk'],
                    ['label' => '👥 Cari Penduduk', 'action' => 'cari_penduduk'],
                    ['label' => '📈 Statistik', 'action' => 'statistik_penduduk']
                ],
                'suggested_questions' => [
                    'Berapa jumlah penduduk laki-laki?',
                    'Berapa jumlah penduduk perempuan?',
                    'Penduduk di RT berapa yang paling banyak?',
                    'Cari penduduk dengan nama...'
                ],
                'priority' => 95,
                'is_active' => true,
            ],
            [
                'name' => 'statistik',
                'display_name' => 'Statistik',
                'description' => 'Statistik dan data',
                'response_template' => "📈 Statistik Desa Oyalo\n\nKami menyediakan statistik lengkap meliputi:\n• Demografi penduduk\n• Tingkat pendidikan\n• Jenis pekerjaan\n• Agama dan kepercayaan\n• UMKM dan ekonomi\n\nKunjungi menu Data Desa untuk detailnya!",
                'response_type' => 'stats',
                'quick_actions' => [
                    ['label' => '📊 Data Penduduk', 'action' => 'data_penduduk'],
                    ['label' => '💼 UMKM', 'action' => 'umkm'],
                    ['label' => '📈 IDM', 'action' => 'idm']
                ],
                'suggested_questions' => [
                    'Berapa rata-rata usia penduduk?',
                    'Apa tingkat pendidikan dominan?',
                    'Pekerjaan apa yang paling banyak?'
                ],
                'priority' => 70,
                'is_active' => true,
            ],
            [
                'name' => 'surat_online',
                'display_name' => 'Surat Online',
                'description' => 'Layanan surat online',
                'response_template' => "📄 Layanan Surat Online Desa Oyalo\n\nJenis surat yang tersedia:\n• Surat Keterangan Domisili\n• Surat Keterangan Tidak Mampu (SKTM)\n• Surat Keterangan Usaha\n• Surat Pengantar SKCK\n• Surat Keterangan Lahir\n• Surat Keterangan Meninggal\n• Surat Pindah\n\n📝 Cara mengajukan:\n1. Klik menu Surat Online\n2. Pilih jenis surat\n3. Isi formulir yang diperlukan\n4. Submit dan tunggu verifikasi\n5. Ambil surat di kantor desa\n\n⏱️ Proses: 1-3 hari kerja",
                'response_type' => 'list',
                'quick_actions' => [
                    ['label' => '📝 Ajukan Surat', 'action' => 'ajuansurat'],
                    ['label' => '📋 Cek Status', 'action' => 'status_surat']
                ],
                'suggested_questions' => [
                    'Cara membuat SKTM?',
                    'Berapa lama proses surat?',
                    'Dokumen apa yang diperlukan?'
                ],
                'priority' => 88,
                'is_active' => true,
            ],
            [
                'name' => 'bansos',
                'display_name' => 'Bantuan Sosial',
                'description' => 'Informasi bansos',
                'response_template' => "💰 Program Bantuan Sosial Desa Oyalo\n\nJenis bansos yang tersedia:\n• BPNT (Bantuan Pangan Non Tunai)\n• PKH (Program Keluarga Harapan)\n• BLT Dana Desa\n• Bantuan langsung lainnya\n\n📋 Syarat umum:\n• Warga Desa Oyalo\n• Memenuhi kriteria ekonomi\n• Terdata di DTKS\n\n📞 Info lebih lanjut: Kantor Desa",
                'response_type' => 'card',
                'quick_actions' => [
                    ['label' => '📋 Daftar Penerima', 'action' => 'penerima_bansos'],
                    ['label' => '📝 Cara Daftar', 'action' => 'daftar_bansos']
                ],
                'suggested_questions' => [
                    'Siapa saja penerima bansos?',
                    'Bagaimana cara daftar bansos?',
                    'Kapan bansos dicairkan?'
                ],
                'priority' => 87,
                'is_active' => true,
            ],
            [
                'name' => 'umkm',
                'display_name' => 'UMKM',
                'description' => 'Informasi UMKM',
                'response_template' => "💼 UMKM Desa Oyalo\n\nKami mendukung pelaku UMKM lokal dengan kategori:\n• Kuliner (makanan tradisional, jajanan)\n• Fashion (konveksi, tenun)\n• Kerajinan (anyaman, ukir)\n• Pertanian (hasil bumi)\n• Jasa (各种 услуги)\n\n🏪 Kunjungi menu UMKM untuk melihat daftar lengkap dan produk yang tersedia!",
                'response_type' => 'list',
                'quick_actions' => [
                    ['label' => '🏪 Daftar UMKM', 'action' => 'daftar_umkm'],
                    ['label' => '➕ Daftar Baru', 'action' => 'daftar_umkm_baru']
                ],
                'suggested_questions' => [
                    'UMKM apa saja di desa?',
                    'Cara mendaftarkan UMKM?',
                    'Produk UMKM有哪些?'
                ],
                'priority' => 75,
                'is_active' => true,
            ],
            [
                'name' => 'apbdes',
                'display_name' => 'APBDes',
                'description' => 'APBDes dan keuangan desa',
                'response_template' => "💰 APBDes Desa Oyalo\n\nAPBDes (Anggaran Pendapatan dan Belanja Desa) mencakup:\n\n📥 PENDAPATAN:\n• Dana Desa\n• Alokasi Dana Desa\n• Pendapatan Asli Desa\n\n📤 BELANJA:\n• Bidang Penyelenggaraan Pemerintah\n• Bidang Pembangunan\n• Bidang Pembinaan Kemasyarakatan\n• Bidang Pemberdayaan Masyarakat\n\n📊 PEMBIAYAAN:\n• SilPA tahun sebelumnya\n• Pembiayaan lainnya\n\nKunjungi menu APBDes untuk detail lengkap!",
                'response_type' => 'stats',
                'quick_actions' => [
                    ['label' => '📊 Lihat APBDes', 'action' => 'apbdes_detail'],
                    ['label' => '📈 Grafik', 'action' => 'apbdes_grafik']
                ],
                'suggested_questions' => [
                    'Berapa total APBDes tahun ini?',
                    'Dana desa berapa?',
                    'Apa saja program kerja?'
                ],
                'priority' => 72,
                'is_active' => true,
            ],
            [
                'name' => 'gis',
                'display_name' => 'Peta/GIS',
                'description' => 'Informasi GIS dan peta',
                'response_template' => "🗺️ GIS Desa Oyalo\n\nFitur peta interaktif kami:\n• Peta wilayah RT/RW\n• Lokasi fasilitas publik\n• Peta infrastruktur desa\n• Batas wilayah desa\n\nGunakan menu GIS/Peta untuk menjelajahi wilayah desa secara interaktif!",
                'response_type' => 'card',
                'quick_actions' => [
                    ['label' => '🗺️ Buka Peta', 'action' => 'buka_peta'],
                    ['label' => '📍 Cari Lokasi', 'action' => 'cari_lokasi']
                ],
                'suggested_questions' => [
                    'Dimana kantor desa?',
                    'Lokasi Puskesmas?',
                    'Peta RT saya?'
                ],
                'priority' => 65,
                'is_active' => true,
            ],
            [
                'name' => 'lokasi',
                'display_name' => 'Lokasi & Alamat',
                'description' => 'Lokasi dan alamat',
                'response_template' => "📍 Lokasi Desa Oyalo\n\n🏛️ Kantor Desa Oyalo\nKecamatan Morotai Selatan\nKabupaten Pulau Morotai\nProvinsi Maluku Utara\n\n🕐 Jam Operasional:\n• Senin - Kamis: 07:30 - 16:00 WIT\n• Jumat: 07:30 - 11:30 WIT\n• Sabtu - Minggu: Tutup\n\n📞 Hotline: [Nomor Telepon]\n📧 Email: [Email Desa]",
                'response_type' => 'card',
                'quick_actions' => [
                    ['label' => '📞 Hubungi', 'action' => 'kontak'],
                    ['label' => '🗺️ Peta', 'action' => 'peta_lokasi']
                ],
                'suggested_questions' => [
                    'Jam kerja kantor desa?',
                    'Nomor WhatsApp?',
                    'Email desa?'
                ],
                'priority' => 78,
                'is_active' => true,
            ],
            [
                'name' => 'kontak',
                'display_name' => 'Kontak',
                'description' => 'Kontak dan komunikasi',
                'response_template' => "📞 Kontak Desa Oyalo\n\n🏛️ Alamat:\nKantor Desa Oyalo\nKec. Morotai Selatan\nKab. Pulau Morotai\nMaluku Utara\n\n📱 WhatsApp: 0822-XXXX-XXXX\n📧 Email: info@desaotalo.com\n🌐 Website: www.desaotalo.com\n\nKami siap membantu Anda!",
                'response_type' => 'card',
                'quick_actions' => [
                    ['label' => '💬 WhatsApp', 'action' => 'whatsapp'],
                    ['label' => '📧 Email', 'action' => 'email']
                ],
                'suggested_questions' => [
                    'Chat WhatsApp',
                    'Kirim email',
                    'Pengaduan'
                ],
                'priority' => 77,
                'is_active' => true,
            ],
            [
                'name' => 'jam_operasional',
                'display_name' => 'Jam Operasional',
                'description' => 'Jam operasional',
                'response_template' => "🕐 Jam Operasional Kantor Desa Oyalo\n\n📅 Hari Kerja:\n• Senin - Kamis: 07:30 - 16:00 WIT\n• Jumat: 07:30 - 11:30 WIT\n\n🛑 Tutup:\n• Sabtu - Minggu\n• Hari Libur Nasional\n\n💡 Tips: Datanglah di jam kerja untuk pelayanan optimal!",
                'response_type' => 'text',
                'quick_actions' => [
                    ['label' => '📞 Hubungi', 'action' => 'kontak']
                ],
                'suggested_questions' => [
                    'Buka hari Sabtu?',
                    'Malam hari ada pelayanan?'
                ],
                'priority' => 76,
                'is_active' => true,
            ],
            [
                'name' => 'thank',
                'display_name' => 'Terima Kasih',
                'description' => 'Respons terima kasih',
                'response_template' => "Sama-sama! 😊\n\nSenang bisa membantu Anda. Ada yang bisa saya bantu lagi?\n\n💬 Anda juga bisa:\n• Menghubungi kami via WhatsApp\n• Mengisi formulir aspirasi\n• Mengajukan pengaduan\n\nTerima kasih telah mengunjungi Website Desa Oyalo!",
                'response_type' => 'suggestions',
                'quick_actions' => [
                    ['label' => '🏠 Beranda', 'action' => 'beranda'],
                    ['label' => '📞 WhatsApp', 'action' => 'whatsapp']
                ],
                'suggested_questions' => [
                    'Lainnya',
                    'Pengaduan'
                ],
                'priority' => 99,
                'is_active' => true,
            ],
            [
                'name' => 'goodbye',
                'display_name' => 'Perpisahan',
                'description' => 'Respons perpisahan',
                'response_template' => "Sampai jumpa! 👋\n\nTerima kasih telah menghubungi kami.\n\nJika membutuhkan bantuan lain, jangan ragu untuk kembali.\n\nKami siap melayani Anda kapan saja!\n\n💬 Hotline WhatsApp: 0822-XXXX-XXXX",
                'response_type' => 'text',
                'quick_actions' => [
                    ['label' => '💬 Hubungi WA', 'action' => 'whatsapp']
                ],
                'suggested_questions' => [],
                'priority' => 98,
                'is_active' => true,
            ],
            [
                'name' => 'default',
                'display_name' => 'Default/Fallback',
                'description' => 'Respons default saat tidak paham',
                'response_template' => "Maaf, saya belum memahami pertanyaan Anda. 🤔\n\nCoba tanyakan tentang:\n\n📊 Data Penduduk\n🏛️ Profil Desa (visi misi, sejarah, struktur)\n📄 Layanan Surat Online\n💰 Bansos dan bantuan sosial\n💼 UMKM dan usaha lokal\n💰 APBDes dan keuangan\n🗺️ GIS dan peta desa\n📞 Kontak dan jam operasional\n\nContoh: 'Berapa jumlah penduduk?' atau 'Cara membuat SKTM'",
                'response_type' => 'suggestions',
                'quick_actions' => [
                    ['label' => '📊 Data Penduduk', 'action' => 'data_penduduk'],
                    ['label' => '📄 Surat Online', 'action' => 'surat_online'],
                    ['label' => '💰 Bansos', 'action' => 'bansos'],
                    ['label' => '💼 UMKM', 'action' => 'umkm']
                ],
                'suggested_questions' => [
                    'Berapa jumlah penduduk?',
                    'Cara membuat surat',
                    'Apa saja bansos?',
                    'UMKM有哪些?'
                ],
                'priority' => 1,
                'is_active' => true,
            ],
        ];

        foreach ($intents as $intent) {
            ChatbotIntent::create($intent);
        }

        // Create FAQs
        $faqs = [
            [
                'question' => 'Berapa jumlah penduduk desa Oyalo?',
                'answer' => 'Silakan查看 menu Data Penduduk untuk informasi jumlah penduduk termasuk distribusi terkini, jenis kelamin, usia, dan lainnya.',
                'intent' => 'data_penduduk',
                'keywords' => 'jumlah,penduduk,warga,total,berapa,banyak',
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara membuat surat keterangan tidak mampu?',
                'answer' => 'Cara membuat SKTM:\n1. Datang ke kantor desa\n2. Ambil formulir permohonan\n3. Isi dan lengkapi persyaratan\n4. Serahkan ke petugas\n5. Tunggu verifikasi (1-2 hari)\n6. Ambil surat yang sudah ditandatangani\n\nPersyaratan: KTP, KK, dan surat pengantar RT/RW',
                'intent' => 'surat_online',
                'keywords' => 'sktm,tidak mampu,surat keterangan,poverty,letter',
                'is_active' => true,
            ],
            [
                'question' => 'Apa saja program bansos yang tersedia?',
                'answer' => 'Program Bansos di Desa Oyalo:\n• BPNT (Bantuan Pangan Non Tunai)\n• PKH (Program Keluarga Harapan)\n• BLT Dana Desa\n\nSyarat: Warga Desa Oyalo, terdata di DTKS, memenuhi kriteria ekonomi.',
                'intent' => 'bansos',
                'keywords' => 'bansos,bantuan sosial,bpnt,pkh,blt,sosial',
                'is_active' => true,
            ],
            [
                'question' => 'Jam berapa kantor desa buka?',
                'answer' => 'Jam Operasional:\n• Senin - Kamis: 07:30 - 16:00 WIT\n• Jumat: 07:30 - 11:30 WIT\n• Sabtu - Minggu: Tutup',
                'intent' => 'jam_operasional',
                'keywords' => 'jam,buka,tutup,operasional,jadwal,service hours',
                'is_active' => true,
            ],
            [
                'question' => 'Dimana lokasi kantor desa?',
                'answer' => 'Kantor Desa Oyalo berlokasi di:\nKecamatan Morotai Selatan\nKabupaten Pulau Morotai\nProvinsi Maluku Utara\n\nGunakan menu GIS/Peta untuk lokasi akurat!',
                'intent' => 'lokasi',
                'keywords' => 'lokasi,alamat,dimana,kantor,dimana letak,address',
                'is_active' => true,
            ],
            [
                'question' => 'Siapa kepala desa Oyalo?',
                'answer' => 'Kepala Desa Oyalo memimpin dengan prinsip transparansi dan akuntabilitas. Untuk informasi lengkap, silakan查看 menu Profil Desa.',
                'intent' => 'kepala_desa',
                'keywords' => 'kepala desa,lurah,kades,leader,village head',
                'is_active' => true,
            ],
            [
                'question' => 'Apa visi dan misi desa?',
                'answer' => "VISI: Mewujudkan Desa Oyalo yang maju, sejahtera, mandiri, dan berbudaya.\n\nMISI:\n1. Meningkatkan kualitas SDM\n2. Mengembangkan ekonomi lokal\n3. Meningkatkan tata kelola\n4. Memelihara budaya lokal\n5. Meningkatkan infrastruktur",
                'intent' => 'visi_misi',
                'keywords' => 'visi,misi,tujuan,cita-cita,mission,vision,goals',
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara mendaftarkan UMKM?',
                'answer' => 'Cara mendaftarkan UMKM:\n1. K menu UMKM\n2. Klik \"Daftar UMKM\"\n3. Isi formulir data usaha\n4. Upload foto produk/usaha\n5. Submit dan tunggu verifikasi\n\nUMKM yang terdaftar akan ditampilkan di menu publik.',
                'intent' => 'umkm',
                'keywords' => 'umkm,usaha,daftar,bisnis,registrasi,business,register',
                'is_active' => true,
            ],
            [
                'question' => 'Dimana saya bisa melihat APBDes?',
                'answer' => 'APBDes Desa Oyalo dapat dilihat di menu APBDes pada website. Di sana Anda akan menemukan informasi lengkap tentang:\n• Pendapatan desa\n• Belanja desa\n• Pembiayaan\n• Grafik dan statistik',
                'intent' => 'apbdes',
                'keywords' => 'apbdes,anggaran,keuangan,dana,budget,budget village',
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana cara mengajukan pengaduan?',
                'answer' => 'Cara mengajukan pengaduan:\n1. Klik tombol Pengaduan atau menu Aspirasi\n2. Isi formulir pengaduan\n3. Jelaskan keluhan Anda\n4. Submit pengaduan\n5. Tim akan merespons dalam 1x24 jam\n\nAtau hubungi langsung via WhatsApp.',
                'intent' => 'default',
                'keywords' => 'pengaduan,keluhan,complaint,aspirasi,saran,feedback',
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            ChatbotFAQ::create($faq);
        }

        $this->command->info('Chatbot intents and FAQs seeded successfully!');
    }
}
