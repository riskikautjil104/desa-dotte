<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DynamicQueryService
{
    protected $conversationContext = [];

    protected $modelMappings = [
        // Population & Demographics
        'penduduk' => 'App\Models\Datapenduduk',
        'datapenduduk' => 'App\Models\Datapenduduk',
        'penduduk_sementara' => 'App\Models\PendudukSementara',
        'sementara' => 'App\Models\PendudukSementara',
        'warga' => 'App\Models\Datapenduduk',
        'masyarakat' => 'App\Models\Datapenduduk',
        'orang' => 'App\Models\Datapenduduk',

        // Village Administration
        'rt' => 'App\Models\Rt',
        'rw' => 'App\Models\Rw',
        'kematian' => 'App\Models\PendudukKematian',
        'pindah' => 'App\Models\PendudukPindah',
        'meninggal' => 'App\Models\PendudukKematian',
        'meninggal dunia' => 'App\Models\PendudukKematian',

        // Content Management
        'berita' => 'App\Models\Berita',
        'agenda' => 'App\Models\Agenda',
        'umkm' => 'App\Models\UMKM',
        'usaha' => 'App\Models\UMKM',
        'galeri' => 'App\Models\Galeri',
        'video' => 'App\Models\Video',
        'foto' => 'App\Models\Galeri',

        // Village Information
        'sambutan' => 'App\Models\SambutanLurah',
        'lurah' => 'App\Models\SambutanLurah',
        'kepala desa' => 'App\Models\SambutanLurah',
        'visi' => 'App\Models\VisiMisi',
        'misi' => 'App\Models\VisiMisi',
        'sejarah' => 'App\Models\Sejarah',
        'struktur' => 'App\Models\StrukturOrganisasi',
        'organisasi' => 'App\Models\StrukturOrganisasi',
        'gambaran' => 'App\Models\GambaranUmum',
        'umum' => 'App\Models\GambaranUmum',

        // Financial
        'pendapatan' => 'App\Models\Pendapatan',
        'belanja' => 'App\Models\Belanja',
        'pembiayaan' => 'App\Models\Pembiayaan',
        'uang' => 'App\Models\Pendapatan',
        'keuangan' => 'App\Models\Pendapatan',

        // Social Aid
        'bansos' => 'App\Models\JenisBansos',
        'penerima' => 'App\Models\PenerimaBansos',
        'pengajuan' => 'App\Models\PengajuanBansos',
        'bantuan' => 'App\Models\JenisBansos',

        // Documents
        'dokumen' => 'App\Models\Dokumen',
        'jenis_dokumen' => 'App\Models\JenisDokumen',
        'file' => 'App\Models\Dokumen',

        // Other
        'aspirasi' => 'App\Models\Aspirasi',
        'pengaduan' => 'App\Models\Pengaduan',
        'surat' => 'App\Models\SuratOnline',
        'ppid' => 'App\Models\PPID',
        'infografis' => 'App\Models\Infografis',
        'peta' => 'App\Models\Peta',
        'idm' => 'App\Models\IDM',
    ];

    protected $queryPatterns = [
        // Advanced count queries with calculations
        '/(?:berapa|jumlah|total|hitung|berapa\s+many|how\s+many)\s+(.+?)(?:\s|$)/i' => 'count',
        '/(?:ada|tersedia|available|exist)\s+(.+?)(?:\s|$)/i' => 'count',
        '/(?:hitung|calculate)\s+(.+?)(?:\s|$)/i' => 'count',

        // List queries with sorting options
        '/(?:daftar|list|semua|all|show\s+all|tampilkan|lihat)\s+(.+?)(?:\s|$)/i' => 'list',
        '/(?:apa\s+saja|what\s+are|yang\s+ada)\s+(.+?)(?:\s|$)/i' => 'list',
        '/(?:tampilkan|show)\s+(.+?)\s+(?:terbaru|terkini|latest|baru)/i' => 'list_latest',
        '/(?:tampilkan|show)\s+(.+?)\s+(?:terlama|oldest)/i' => 'list_oldest',

        // Advanced search queries
        '/(?:cari|cari\s+penduduk|ada\s+nama|find|search|cari\s+data)\s+(.+?)(?:\s|$)/i' => 'search',
        '/(?:temukan|locate|who\s+is|apa\s+nama)\s+(.+?)(?:\s|$)/i' => 'search',
        '/(?:cari\s+di|search\s+in)\s+(.+?)\s+(.+?)/i' => 'search_specific',

        // Specific data queries with context
        '/(?:siapa|apa|what|who)\s+(.+?)(?:\s|$)/i' => 'get',
        '/(?:bagaimana|dimana|how|where)\s+(.+?)(?:\s|$)/i' => 'get',
        '/(?:kapan|jam|when|time)\s+(.+?)(?:\s|$)/i' => 'get',
        '/(?:berapa\s+lama|how\s+long|sejak\s+kapan)\s+(.+?)/i' => 'get_duration',

        // Advanced comparison queries
        '/(?:bandingkan|compare|lebih\s+banyak|more)\s+(.+?)\s+(?:dengan|with|than)\s+(.+?)/i' => 'compare',
        '/(?:mana\s+lebih|which\s+is\s+more)\s+(.+?)/i' => 'compare',
        '/(?:perbandingan|comparison)\s+(.+?)\s+(?:dan|and)\s+(.+?)/i' => 'compare',

        // Statistical queries with advanced calculations
        '/(?:rata.rata|average|mean)\s+(.+?)(?:\s|$)/i' => 'stats',
        '/(?:persentase|percentage|ratio)\s+(.+?)(?:\s|$)/i' => 'stats',
        '/(?:distribusi|distribution|breakdown)\s+(.+?)(?:\s|$)/i' => 'stats',
        '/(?:statistik|statistics)\s+(.+?)(?:\s|$)/i' => 'stats',
        '/(?:persentase|percentage)\s+(.+?)\s+(?:berdasarkan|by|based\s+on)\s+(.+?)/i' => 'stats_by',

        // Trend and analysis queries
        '/(?:tren|trend|perkembangan|development)\s+(.+?)(?:\s|$)/i' => 'trend',
        '/(?:analisis|analysis)\s+(.+?)(?:\s|$)/i' => 'analysis',

        // Summary queries
        '/(?:ringkasan|summary|overview)\s+(.+?)(?:\s|$)/i' => 'summary',
        '/(?:total\s+keseluruhan|grand\s+total)\s+(.+?)/i' => 'summary',

        // Service and information queries - more flexible patterns
        '/(?:profil|tentang|about)\s*(?:desa|kotalo|website)?/i' => 'info_profil',
        '/(?:pelayanan|layanan|service)\s*(?:\s|$)/i' => 'info_pelayanan',
        '/(?:cara|how\s+to|bagaimana)\s+(?:daftar|register)\s+(.+?)/i' => 'info_cara_daftar',
        '/(?:cara|how\s+to|bagaimana)\s+(?:kirim|submit|ajukan)\s+(.+?)/i' => 'info_cara_kirim',
        '/(?:cara|how\s+to|bagaimana)\s+(?:pakai|gunakan|akses)\s+(.+?)/i' => 'info_cara_pakai',
        '/(?:apbdes|anggaran|keuangan|budget)\s*(?:\s|$)/i' => 'info_apbdes',
        '/(?:gis|peta|map|lokasi)\s*(?:\s|$)/i' => 'info_gis',
        '/(?:dokumen|document|file)\s*(?:\s|$)/i' => 'info_dokumen',
        '/(?:kontak|contact|hubungi)\s*(?:\s|$)/i' => 'info_kontak',
        '/(?:bansos|bantuan\s+sosial|social\s+aid)\s*(?:\s|$)/i' => 'info_bansos',
        '/(?:pengaduan|complaint|keluhan)\s*(?:\s|$)/i' => 'info_pengaduan',
        '/(?:aspirasi|suggestion|usulan)\s*(?:\s|$)/i' => 'info_aspirasi',
        '/(?:surat\s+online|online\s+letter)\s*(?:\s|$)/i' => 'info_surat_online',
        '/(?:ppid|informasi\s+publik)\s*(?:\s|$)/i' => 'info_ppid',
        '/(?:galeri|gallery|foto)\s*(?:\s|$)/i' => 'info_galeri',
        '/(?:video|vidio)\s*(?:\s|$)/i' => 'info_video',
        '/(?:infografis|infographic)\s*(?:\s|$)/i' => 'info_infografis',
        '/(?:idm|indeks\s+desa\s+membangun)\s*(?:\s|$)/i' => 'info_idm',
        '/(?:umkm|usaha)\s*(?:\s|$)/i' => 'info_umkm',
    ];

    protected $filterPatterns = [
        // Gender filters
        '/(?:laki|laki-laki|pria|male)/i' => ['jenis_kelamin', 'LAKI-LAKI'],
        '/(?:perempuan|wanita|female)/i' => ['jenis_kelamin', 'PEREMPUAN'],

        // Age filters
        '/(?:anak|bayi|muda)\s+(?:dibawah|di\s+bawah)\s+(\d+)/i' => ['usia', '<', '$2'],
        '/(?:tua|lansia)\s+(?:diatas|di\s+atas)\s+(\d+)/i' => ['usia', '>', '$2'],
        '/(?:umur|usia)\s+(\d+)(?:\s*-\s*(\d+))?/i' => ['usia', 'between', '$1', '$2'],

        // Location filters
        '/(?:rt|RT)\s+(\d+)/i' => ['id_rt', '=', '$1'],
        '/(?:rw|RW)\s+(\d+)/i' => ['id_rw', '=', '$1'],

        // Status filters
        '/(?:aktif|status\s+true)/i' => ['status', '=', true],
        '/(?:tidak\s+aktif|status\s+false)/i' => ['status', '=', false],

        // Date filters
        '/(?:hari\s+ini|today)/i' => ['created_at', '>=', 'today'],
        '/(?:kemarin|yesterday)/i' => ['created_at', '>=', 'yesterday'],
        '/(?:minggu\s+ini|this\s+week)/i' => ['created_at', '>=', 'week'],
        '/(?:bulan\s+ini|this\s+month)/i' => ['created_at', '>=', 'month'],
    ];

    public function processQuery($message)
    {
        $message = strtolower(trim($message));

        // Check for greetings and conversational queries first
        $helpfulResponse = $this->generateHelpfulResponse($message);
        if ($helpfulResponse !== null) {
            return $helpfulResponse;
        }

        // Check for contextual follow-up questions
        $contextualResponse = $this->handleContextualQuery($message);
        if ($contextualResponse !== null) {
            return $contextualResponse;
        }

        // Detect query type and extract subject
        $queryType = $this->detectQueryType($message);

        if ($queryType === 'compare') {
            // Handle comparison queries differently
            return $this->executeCompareQuery(null, [], $message);
        }

        $subject = $this->extractSubject($message);
        $filters = $this->extractFilters($message);

        // If no subject but has filters, assume it's about penduduk
        if (!$subject && !empty($filters)) {
            $subject = 'penduduk';
        }

        if (!$queryType || !$subject) {
            return null;
        }

        // Map subject to model
        $modelClass = $this->mapSubjectToModel($subject);
        if (!$modelClass) {
            return null;
        }

        // Execute query based on type
        $result = $this->executeQuery($queryType, $modelClass, $filters, $message);

        // Update conversation context
        if ($result) {
            $this->updateConversationContext($queryType, $subject, $filters, $result);
        }

        return $result;
    }

    protected function detectQueryType($message)
    {
        foreach ($this->queryPatterns as $pattern => $type) {
            if (preg_match($pattern, $message)) {
                return $type;
            }
        }
        return 'get'; // Default to get
    }

    protected function extractComparisonSubjects($message)
    {
        if (preg_match('/(?:bandingkan|compare|lebih\s+banyak|more)\s+(.+?)\s+(?:dengan|with|than)\s+(.+?)/i', $message, $matches)) {
            return [
                'subject1' => trim($matches[1]),
                'subject2' => trim($matches[2])
            ];
        }
        return null;
    }

    protected function handleContextualQuery($message)
    {
        // Handle follow-up questions like "dan yang perempuan?", "berapa lagi?", etc.
        if (!empty($this->conversationContext)) {
            $context = end($this->conversationContext);

            if (preg_match('/(?:dan|yang|berapa)\s+(.+?)\?/i', $message, $matches)) {
                $followUpFilter = $this->extractFilters($matches[1]);
                if (!empty($followUpFilter)) {
                    // Apply the follow-up filter to the previous query
                    $modelClass = $this->mapSubjectToModel($context['subject']);
                    if ($modelClass) {
                        $combinedFilters = array_merge($context['filters'], $followUpFilter);
                        return $this->executeQuery($context['type'], $modelClass, $combinedFilters, $message);
                    }
                }
            }
        }
        return null;
    }

    protected function generateHelpfulResponse($message)
    {
        // Try to understand what the user might be asking
        // Simple exact matches for greetings
        if (in_array($message, ['halo', 'hai', 'hi', 'hello'])) {
            return "Halo! Saya adalah asisten chatbot Desa Kotalo. Saya bisa membantu Anda dengan informasi tentang:\n\n" .
                "• Jumlah dan data penduduk\n" .
                "• Berita dan agenda desa\n" .
                "• UMKM dan usaha lokal\n" .
                "• Informasi kepala desa dan struktur organisasi\n" .
                "• Dokumen dan layanan desa\n\n" .
                "Coba tanyakan: 'berapa jumlah penduduk?' atau 'tampilkan berita terbaru'";
        }

        // Regex for more complex greetings
        if (preg_match('/^(halo|hai|hi|hello)[.!?]?$/', $message)) {
            return "Halo! Saya adalah asisten chatbot Desa Kotalo. Saya bisa membantu Anda dengan informasi tentang:\n\n" .
                "• Jumlah dan data penduduk\n" .
                "• Berita dan agenda desa\n" .
                "• UMKM dan usaha lokal\n" .
                "• Informasi kepala desa dan struktur organisasi\n" .
                "• Dokumen dan layanan desa\n\n" .
                "Coba tanyakan: 'berapa jumlah penduduk?' atau 'tampilkan berita terbaru'";
        }

        if (preg_match('/(?:terima\s+kasih|thanks|thank\s+you)/i', $message)) {
            return "Sama-sama! Ada yang bisa saya bantu lagi?";
        }

        if (preg_match('/(?:apa\s+kamu|bisa\s+apa|what\s+can\s+you\s+do)/i', $message)) {
            return "Saya bisa memberikan informasi tentang:\n\n" .
                "📊 Data penduduk (jumlah, daftar, pencarian)\n" .
                "📰 Berita dan agenda kegiatan\n" .
                "💼 UMKM dan usaha mikro\n" .
                "🏛️ Informasi desa (visi misi, sejarah, struktur)\n" .
                "📄 Dokumen dan layanan online\n" .
                "📈 Statistik dan perbandingan data\n\n" .
                "Tanyakan dengan bahasa natural seperti manusia!";
        }

        // For non-matching messages, return null to allow fallback
        return null;
    }

    protected function updateConversationContext($type, $subject, $filters, $result)
    {
        $this->conversationContext[] = [
            'type' => $type,
            'subject' => $subject,
            'filters' => $filters,
            'result' => $result,
            'timestamp' => now()
        ];

        // Keep only last 5 conversations for context
        if (count($this->conversationContext) > 5) {
            array_shift($this->conversationContext);
        }
    }

    protected function extractSubject($message)
    {
        // Remove question words and extract main subject
        $cleanMessage = preg_replace('/^(berapa|jumlah|total|ada|daftar|list|cari|siapa|apa|bagaimana|dimana|kapan|jam|hitung|semua|tampilkan|lihat|temukan|find)\s+/i', '', $message);

        // Extract potential subjects
        $subjects = [];
        foreach (array_keys($this->modelMappings) as $keyword) {
            if (strpos($cleanMessage, $keyword) !== false) {
                $subjects[] = $keyword;
            }
        }

        // Return the most specific subject found
        return $subjects ? $this->getMostSpecificSubject($subjects) : null;
    }

    protected function extractFilters($message)
    {
        $filters = [];

        foreach ($this->filterPatterns as $pattern => $filterConfig) {
            if (preg_match($pattern, $message, $matches)) {
                $column = $filterConfig[0];
                $operator = $filterConfig[1];
                $value = isset($filterConfig[2]) ? $filterConfig[2] : null;

                // Replace placeholders
                for ($i = 1; $i < count($matches); $i++) {
                    $value = str_replace('$' . $i, $matches[$i], $value);
                }

                // Handle special date values
                if ($value && strpos($value, 'today') !== false) {
                    $value = now()->toDateString();
                } elseif ($value && strpos($value, 'yesterday') !== false) {
                    $value = now()->subDay()->toDateString();
                } elseif ($value && strpos($value, 'week') !== false) {
                    $value = now()->startOfWeek()->toDateString();
                } elseif ($value && strpos($value, 'month') !== false) {
                    $value = now()->startOfMonth()->toDateString();
                }

                $filters[$column] = [$operator, $value];
            }
        }

        return $filters;
    }

    protected function mapSubjectToModel($subject)
    {
        return isset($this->modelMappings[$subject]) ? $this->modelMappings[$subject] : null;
    }

    protected function getMostSpecificSubject($subjects)
    {
        // Priority order for specificity
        $priority = [
            'datapenduduk',
            'penduduk',
            'penduduk_sementara',
            'sementara',
            'berita',
            'agenda',
            'umkm',
            'dokumen',
            'sambutan',
            'visi',
            'sejarah',
            'struktur',
            'rt',
            'rw',
            'kematian',
            'pindah'
        ];

        foreach ($priority as $specific) {
            if (in_array($specific, $subjects)) {
                return $specific;
            }
        }

        return $subjects[0];
    }

    protected function executeQuery($type, $modelClass, $filters, $originalMessage)
    {
        try {
            // Handle information queries first
            if (str_starts_with($type, 'info_')) {
                return $this->executeInfoQuery($type, $originalMessage);
            }

            $model = new $modelClass;

            switch ($type) {
                case 'count':
                    return $this->executeCountQuery($model, $filters, $originalMessage);

                case 'list':
                    return $this->executeListQuery($model, $filters, $originalMessage);

                case 'list_latest':
                    return $this->executeListLatestQuery($model, $filters, $originalMessage);

                case 'list_oldest':
                    return $this->executeListOldestQuery($model, $filters, $originalMessage);

                case 'search':
                    return $this->executeSearchQuery($model, $filters, $originalMessage);

                case 'search_specific':
                    return $this->executeSearchSpecificQuery($model, $filters, $originalMessage);

                case 'compare':
                    return $this->executeCompareQuery($model, $filters, $originalMessage);

                case 'stats':
                case 'stats_by':
                    return $this->executeStatsQuery($model, $filters, $originalMessage);

                case 'trend':
                    return $this->executeTrendQuery($model, $filters, $originalMessage);

                case 'analysis':
                    return $this->executeAnalysisQuery($model, $filters, $originalMessage);

                case 'summary':
                    return $this->executeSummaryQuery($model, $filters, $originalMessage);

                case 'get':
                case 'get_duration':
                default:
                    return $this->executeGetQuery($model, $filters, $originalMessage);
            }
        } catch (\Exception $e) {
            return "Maaf, terjadi kesalahan saat memproses pertanyaan Anda: " . $e->getMessage();
        }
    }

    protected function executeCountQuery($model, $filters, $message)
    {
        $query = $model->query();

        // Apply filters
        foreach ($filters as $column => $condition) {
            [$operator, $value] = $condition;
            if ($operator === 'between') {
                $query->whereBetween($column, [$condition[1], $condition[2]]);
            } else {
                $query->where($column, $operator, $value);
            }
        }

        $count = $query->count();

        // Generate human-readable response
        $subjectName = $this->getSubjectDisplayName($model);
        $filterDescription = $this->getFilterDescription($filters);

        if ($count == 0) {
            return "Tidak ada {$subjectName}{$filterDescription}.";
        }

        return "Jumlah {$subjectName}{$filterDescription}: {$count}";
    }

    protected function executeListQuery($model, $filters, $message)
    {
        $query = $model->query();

        // Apply filters
        foreach ($filters as $column => $condition) {
            [$operator, $value] = $condition;
            if ($operator === 'between') {
                $query->whereBetween($column, [$condition[1], $condition[2]]);
            } else {
                $query->where($column, $operator, $value);
            }
        }

        $results = $query->limit(10)->get();

        if ($results->isEmpty()) {
            $subjectName = $this->getSubjectDisplayName($model);
            $filterDescription = $this->getFilterDescription($filters);
            return "Tidak ada {$subjectName}{$filterDescription}.";
        }

        return $this->formatListResponse($results, $model);
    }

    protected function executeSearchQuery($model, $filters, $message)
    {
        // Extract search term from message
        $searchTerm = $this->extractSearchTerm($message);

        if (!$searchTerm) {
            return "Silakan sebutkan apa yang ingin dicari.";
        }

        $query = $model->query();

        // Search in common text fields
        $searchFields = $this->getSearchFields($model);
        $query->where(function ($q) use ($searchFields, $searchTerm) {
            foreach ($searchFields as $field) {
                $q->orWhere($field, 'like', "%{$searchTerm}%");
            }
        });

        // Apply additional filters
        foreach ($filters as $column => $condition) {
            [$operator, $value] = $condition;
            $query->where($column, $operator, $value);
        }

        $results = $query->limit(5)->get();

        if ($results->isEmpty()) {
            return "Tidak ditemukan hasil untuk pencarian '{$searchTerm}'.";
        }

        return $this->formatSearchResponse($results, $model, $searchTerm);
    }

    protected function executeGetQuery($model, $filters, $message)
    {
        $query = $model->query();

        // Apply filters
        foreach ($filters as $column => $condition) {
            [$operator, $value] = $condition;
            $query->where($column, $operator, $value);
        }

        $result = $query->first();

        if (!$result) {
            $subjectName = $this->getSubjectDisplayName($model);
            return "Informasi {$subjectName} tidak ditemukan.";
        }

        return $this->formatSingleResponse($result, $model);
    }

    protected function extractSearchTerm($message)
    {
        // Extract name or term after search keywords
        if (preg_match('/(?:cari|cari\s+penduduk|ada\s+nama)\s+([a-zA-Z\s]+)/i', $message, $matches)) {
            return trim($matches[1]);
        }
        return null;
    }

    protected function getSearchFields($model)
    {
        $modelName = class_basename($model);

        switch ($modelName) {
            case 'Datapenduduk':
            case 'PendudukSementara':
                return ['nama', 'alamat'];
            case 'Berita':
                return ['judul', 'isi', 'excerp'];
            case 'UMKM':
                return ['nama_umkm', 'kategori', 'alamat'];
            case 'Dokumen':
                return ['nama_dokumen', 'deskripsi'];
            default:
                return ['nama', 'judul', 'deskripsi'];
        }
    }

    protected function getSubjectDisplayName($model)
    {
        $modelName = class_basename($model);

        $displayNames = [
            'Datapenduduk' => 'penduduk tetap',
            'PendudukSementara' => 'penduduk sementara',
            'Berita' => 'berita',
            'Agenda' => 'agenda kegiatan',
            'UMKM' => 'UMKM',
            'Dokumen' => 'dokumen',
            'Rt' => 'RT',
            'Rw' => 'RW',
            'PendudukKematian' => 'penduduk meninggal',
            'PendudukPindah' => 'penduduk pindah',
            'SambutanLurah' => 'sambutan kepala desa',
            'VisiMisi' => 'visi misi desa',
            'Sejarah' => 'sejarah desa',
            'StrukturOrganisasi' => 'struktur organisasi',
            'GambaranUmum' => 'gambaran umum desa',
        ];

        return isset($displayNames[$modelName]) ? $displayNames[$modelName] : strtolower($modelName);
    }

    protected function getFilterDescription($filters)
    {
        if (empty($filters)) {
            return '';
        }

        $descriptions = [];

        foreach ($filters as $column => $condition) {
            [$operator, $value] = $condition;

            switch ($column) {
                case 'jenis_kelamin':
                    $descriptions[] = $value === 'LAKI-LAKI' ? 'laki-laki' : 'perempuan';
                    break;
                case 'id_rt':
                    $descriptions[] = "di RT {$value}";
                    break;
                case 'id_rw':
                    $descriptions[] = "di RW {$value}";
                    break;
                case 'usia':
                    if ($operator === '<') {
                        $descriptions[] = "di bawah {$value} tahun";
                    } elseif ($operator === '>') {
                        $descriptions[] = "di atas {$value} tahun";
                    }
                    break;
                case 'status':
                    $descriptions[] = $value ? 'aktif' : 'tidak aktif';
                    break;
            }
        }

        return ' ' . implode(' dan ', $descriptions);
    }

    protected function formatListResponse($results, $model)
    {
        $modelName = class_basename($model);
        $subjectName = $this->getSubjectDisplayName($model);

        $response = "Daftar {$subjectName}:\n\n";

        foreach ($results as $index => $item) {
            $response .= ($index + 1) . ". ";

            switch ($modelName) {
                case 'Datapenduduk':
                    $rtName = $item->rt ? $item->rt->nama_rt : 'N/A';
                    $rwName = $item->rw ? $item->rw->nama_rw : 'N/A';
                    $response .= "{$item->nama} (RT {$rtName}, RW {$rwName})";
                    break;
                case 'Berita':
                    $response .= "{$item->judul} - " . $item->created_at->format('d M Y');
                    break;
                case 'UMKM':
                    $response .= "{$item->nama_umkm} - {$item->kategori}";
                    break;
                case 'Agenda':
                    $response .= "{$item->judul} - " . $item->tanggal->format('d M Y');
                    break;
                default:
                    $response .= isset($item->nama) ? $item->nama : (isset($item->judul) ? $item->judul : "Item " . ($index + 1));
            }

            $response .= "\n";
        }

        if ($results->count() >= 10) {
            $response .= "\n(Menampilkan 10 hasil pertama)";
        }

        return $response;
    }

    protected function formatSearchResponse($results, $model, $searchTerm)
    {
        $modelName = class_basename($model);
        $subjectName = $this->getSubjectDisplayName($model);

        $response = "Hasil pencarian '{$searchTerm}' dalam {$subjectName}:\n\n";

        foreach ($results as $index => $item) {
            $response .= ($index + 1) . ". ";

            switch ($modelName) {
                case 'Datapenduduk':
                    $rtName = $item->rt ? $item->rt->nama_rt : 'N/A';
                    $rwName = $item->rw ? $item->rw->nama_rw : 'N/A';
                    $response .= "{$item->nama} - RT {$rtName} RW {$rwName}";
                    break;
                case 'PendudukSementara':
                    $response .= "{$item->nama} - {$item->alamat_sementara}";
                    break;
                case 'Berita':
                    $response .= "{$item->judul}";
                    break;
                case 'UMKM':
                    $response .= "{$item->nama_umkm} ({$item->kategori})";
                    break;
                default:
                    $response .= $item->nama ?? $item->judul ?? "Item " . ($index + 1);
            }

            $response .= "\n";
        }

        return $response;
    }

    protected function formatSingleResponse($result, $model)
    {
        $modelName = class_basename($model);

        switch ($modelName) {
            case 'SambutanLurah':
                return "Kepala Desa Kotalo: {$result->nama_lurah}\n\n" .
                    "Sambutan:\n" . Str::limit(strip_tags($result->sambutan_lurah), 300);

            case 'VisiMisi':
                return "Visi Desa Kotalo:\n{$result->visi}\n\n" .
                    "Misi Desa Kotalo:\n{$result->misi}";

            case 'Sejarah':
                return "Sejarah Desa Kotalo:\n\n" . Str::limit(strip_tags($result->sejarah), 400);

            case 'GambaranUmum':
                return "Gambaran Umum Desa Kotalo:\n\n" .
                    "Lokasi: " . (isset($result->lokasi) ? $result->lokasi : 'N/A') . "\n" .
                    "Luas Wilayah: " . (isset($result->luas_wilayah) ? $result->luas_wilayah : 'N/A') . " km²\n" .
                    "Topografi: " . (isset($result->topografi) ? $result->topografi : 'N/A') . "\n\n" .
                    Str::limit(strip_tags($result->gambaran_umum), 200);

            default:
                // More detailed default response based on available fields
                $modelName = class_basename($model);
                $subjectName = $this->getSubjectDisplayName($model);

                $response = "Informasi {$subjectName}:\n\n";

                // Add available fields dynamically
                $fields = ['nama', 'judul', 'deskripsi', 'alamat', 'kategori', 'status'];
                $addedFields = 0;

                foreach ($fields as $field) {
                    if (isset($result->$field) && !empty($result->$field)) {
                        $fieldName = $this->getFieldDisplayName($field);
                        $response .= "• {$fieldName}: {$result->$field}\n";
                        $addedFields++;
                    }
                }

                // Add timestamps if available
                if (isset($result->created_at)) {
                    $response .= "• Dibuat: " . $result->created_at->format('d M Y H:i') . "\n";
                    $addedFields++;
                }

                if (isset($result->updated_at) && $result->updated_at != $result->created_at) {
                    $response .= "• Diupdate: " . $result->updated_at->format('d M Y H:i') . "\n";
                    $addedFields++;
                }

                if ($addedFields == 0) {
                    $response .= "Data tersedia dalam sistem.";
                }

                return $response;
        }
    }

    protected function getFieldDisplayName($field)
    {
        $fieldNames = [
            'nama' => 'Nama',
            'judul' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'alamat' => 'Alamat',
            'kategori' => 'Kategori',
            'status' => 'Status',
            'nama_umkm' => 'Nama UMKM',
            'nama_dokumen' => 'Nama Dokumen',
            'nama_lurah' => 'Nama Kepala Desa',
            'sambutan_lurah' => 'Sambutan',
            'visi' => 'Visi',
            'misi' => 'Misi',
            'sejarah' => 'Sejarah',
            'lokasi' => 'Lokasi',
            'luas_wilayah' => 'Luas Wilayah',
            'topografi' => 'Topografi',
            'gambaran_umum' => 'Gambaran Umum'
        ];

        return isset($fieldNames[$field]) ? $fieldNames[$field] : ucfirst($field);
    }

    protected function executeListLatestQuery($model, $filters, $message)
    {
        $query = $model->query();

        // Apply filters
        foreach ($filters as $column => $condition) {
            [$operator, $value] = $condition;
            if ($operator === 'between') {
                $query->whereBetween($column, [$condition[1], $condition[2]]);
            } else {
                $query->where($column, $operator, $value);
            }
        }

        // Order by latest (created_at or updated_at)
        if (Schema::hasColumn($model->getTable(), 'created_at')) {
            $query->orderBy('created_at', 'desc');
        }

        $results = $query->limit(10)->get();

        if ($results->isEmpty()) {
            $subjectName = $this->getSubjectDisplayName($model);
            $filterDescription = $this->getFilterDescription($filters);
            return "Tidak ada {$subjectName} terbaru{$filterDescription}.";
        }

        return $this->formatListResponse($results, $model, 'terbaru');
    }

    protected function executeListOldestQuery($model, $filters, $message)
    {
        $query = $model->query();

        // Apply filters
        foreach ($filters as $column => $condition) {
            [$operator, $value] = $condition;
            if ($operator === 'between') {
                $query->whereBetween($column, [$condition[1], $condition[2]]);
            } else {
                $query->where($column, $operator, $value);
            }
        }

        // Order by oldest (created_at or updated_at)
        if (Schema::hasColumn($model->getTable(), 'created_at')) {
            $query->orderBy('created_at', 'asc');
        }

        $results = $query->limit(10)->get();

        if ($results->isEmpty()) {
            $subjectName = $this->getSubjectDisplayName($model);
            $filterDescription = $this->getFilterDescription($filters);
            return "Tidak ada {$subjectName} tertua{$filterDescription}.";
        }

        return $this->formatListResponse($results, $model, 'tertua');
    }

    protected function executeSearchSpecificQuery($model, $filters, $message)
    {
        // Extract search term and field from message
        if (preg_match('/(?:cari\s+di|search\s+in)\s+(.+?)\s+(.+?)/i', $message, $matches)) {
            $field = trim($matches[1]);
            $searchTerm = trim($matches[2]);

            $query = $model->query();

            // Search in specific field
            $query->where($field, 'like', "%{$searchTerm}%");

            // Apply additional filters
            foreach ($filters as $column => $condition) {
                [$operator, $value] = $condition;
                $query->where($column, $operator, $value);
            }

            $results = $query->limit(5)->get();

            if ($results->isEmpty()) {
                return "Tidak ditemukan hasil untuk pencarian '{$searchTerm}' di kolom {$field}.";
            }

            return $this->formatSearchResponse($results, $model, $searchTerm, $field);
        }

        return "Format pencarian tidak valid. Gunakan: 'cari di [kolom] [kata kunci]'";
    }

    protected function executeCompareQuery($model, $filters, $message)
    {
        // Extract comparison subjects
        $comparisonData = $this->extractComparisonSubjects($message);

        if (!$comparisonData) {
            return "Format perbandingan tidak valid. Gunakan: 'bandingkan [subjek1] dengan [subjek2]'";
        }

        $subject1 = $this->mapSubjectToModel($comparisonData['subject1']);
        $subject2 = $this->mapSubjectToModel($comparisonData['subject2']);

        if (!$subject1 || !$subject2) {
            return "Salah satu subjek perbandingan tidak ditemukan.";
        }

        // Get counts for both subjects
        $count1 = $subject1::count();
        $count2 = $subject2::count();

        $name1 = $this->getSubjectDisplayName($subject1);
        $name2 = $this->getSubjectDisplayName($subject2);

        $response = "Perbandingan {$name1} vs {$name2}:\n\n";
        $response .= "• {$name1}: {$count1}\n";
        $response .= "• {$name2}: {$count2}\n\n";

        if ($count1 > $count2) {
            $response .= "{$name1} lebih banyak dari {$name2} dengan selisih " . ($count1 - $count2);
        } elseif ($count2 > $count1) {
            $response .= "{$name2} lebih banyak dari {$name1} dengan selisih " . ($count2 - $count1);
        } else {
            $response .= "Jumlah {$name1} dan {$name2} sama";
        }

        return $response;
    }

    protected function executeStatsQuery($model, $filters, $message)
    {
        $modelName = class_basename($model);
        $subjectName = $this->getSubjectDisplayName($model);

        // Basic statistics
        $total = $model::count();

        if ($total == 0) {
            return "Tidak ada data {$subjectName} untuk dihitung statistik.";
        }

        $response = "Statistik {$subjectName}:\n\n";
        $response .= "• Total: {$total}\n";

        // Gender statistics for population models
        if ($modelName === 'Datapenduk' && Schema::hasColumn($model->getTable(), 'jenis_kelamin')) {
            $maleCount = $model::where('jenis_kelamin', 'LAKI-LAKI')->count();
            $femaleCount = $model::where('jenis_kelamin', 'PEREMPUAN')->count();

            $malePercent = $total > 0 ? round(($maleCount / $total) * 100, 1) : 0;
            $femalePercent = $total > 0 ? round(($femaleCount / $total) * 100, 1) : 0;

            $response .= "• Laki-laki: {$maleCount} ({$malePercent}%)\n";
            $response .= "• Perempuan: {$femaleCount} ({$femalePercent}%)\n";
        }

        // Age statistics if age column exists
        if (Schema::hasColumn($model->getTable(), 'tanggal_lahir')) {
            $avgAge = $model::selectRaw('AVG(YEAR(CURDATE()) - YEAR(tanggal_lahir)) as avg_age')->first()->avg_age;
            if ($avgAge) {
                $response .= "• Rata-rata usia: " . round($avgAge, 1) . " tahun\n";
            }
        }

        return $response;
    }

    protected function executeTrendQuery($model, $filters, $message)
    {
        $subjectName = $this->getSubjectDisplayName($model);

        // Simple trend analysis based on creation dates
        if (!Schema::hasColumn($model->getTable(), 'created_at')) {
            return "Data {$subjectName} tidak memiliki informasi waktu untuk analisis tren.";
        }

        $currentMonth = $model::whereMonth('created_at', now()->month)->count();
        $lastMonth = $model::whereMonth('created_at', now()->subMonth()->month)->count();

        $response = "Analisis Tren {$subjectName}:\n\n";
        $response .= "• Bulan ini: {$currentMonth}\n";
        $response .= "• Bulan lalu: {$lastMonth}\n\n";

        if ($currentMonth > $lastMonth) {
            $increase = $lastMonth > 0 ? round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1) : 100;
            $response .= "📈 Tren naik {$increase}% dari bulan lalu";
        } elseif ($currentMonth < $lastMonth) {
            $decrease = $lastMonth > 0 ? round((($lastMonth - $currentMonth) / $lastMonth) * 100, 1) : 100;
            $response .= "📉 Tren turun {$decrease}% dari bulan lalu";
        } else {
            $response .= "📊 Tren stabil, tidak ada perubahan";
        }

        return $response;
    }

    protected function executeAnalysisQuery($model, $filters, $message)
    {
        $subjectName = $this->getSubjectDisplayName($model);
        $total = $model::count();

        $response = "Analisis Mendalam {$subjectName}:\n\n";

        // Distribution analysis
        if (Schema::hasColumn($model->getTable(), 'created_at')) {
            $thisYear = $model::whereYear('created_at', now()->year)->count();
            $lastYear = $model::whereYear('created_at', now()->subYear()->year)->count();

            $response .= "📅 Distribusi Waktu:\n";
            $response .= "• Tahun ini: {$thisYear}\n";
            $response .= "• Tahun lalu: {$lastYear}\n";
            $response .= "• Total keseluruhan: {$total}\n\n";
        }

        // Status analysis if status column exists
        if (Schema::hasColumn($model->getTable(), 'status')) {
            $active = $model::where('status', true)->count();
            $inactive = $model::where('status', false)->count();

            $response .= "📊 Analisis Status:\n";
            $response .= "• Aktif: {$active}\n";
            $response .= "• Tidak aktif: {$inactive}\n\n";
        }

        $response .= "💡 Kesimpulan: ";
        if ($total > 100) {
            $response .= "Data {$subjectName} cukup banyak dan aktif dikelola.";
        } elseif ($total > 50) {
            $response .= "Data {$subjectName} dalam jumlah sedang.";
        } else {
            $response .= "Data {$subjectName} masih terbatas, perlu pengembangan lebih lanjut.";
        }

        return $response;
    }

    protected function executeSummaryQuery($model, $filters, $message)
    {
        $subjectName = $this->getSubjectDisplayName($model);
        $total = $model::count();

        $response = "📋 Ringkasan {$subjectName}:\n\n";

        // Basic summary
        $response .= "• Total data: {$total}\n";

        // Add time-based summary if available
        if (Schema::hasColumn($model->getTable(), 'created_at')) {
            $thisMonth = $model::whereMonth('created_at', now()->month)->count();
            $thisWeek = $model::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

            $response .= "• Ditambahkan bulan ini: {$thisMonth}\n";
            $response .= "• Ditambahkan minggu ini: {$thisWeek}\n";
        }

        // Add status summary if available
        if (Schema::hasColumn($model->getTable(), 'status')) {
            $active = $model::where('status', true)->count();
            $response .= "• Status aktif: {$active}\n";
        }

        $response .= "\n💡 Status: ";
        if ($total == 0) {
            $response .= "Belum ada data";
        } elseif ($total < 10) {
            $response .= "Data masih terbatas";
        } elseif ($total < 100) {
            $response .= "Data cukup baik";
        } else {
            $response .= "Data sangat lengkap";
        }

        return $response;
    }
}
