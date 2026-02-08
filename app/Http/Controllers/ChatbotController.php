<?php

namespace App\Http\Controllers;

use App\Models\ChatbotConversation;
use App\Models\ChatbotFAQ;
use App\Models\ChatbotFeedback;
use App\Models\ChatbotIntent;
use App\Services\DynamicQueryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChatbotController extends Controller
{
    protected $dynamicQueryService;

    public function __construct(DynamicQueryService $dynamicQueryService)
    {
        $this->dynamicQueryService = $dynamicQueryService;
    }

    /**
     * Main chatbot response endpoint
     */
    public function respond(Request $request)
    {
        $message = $request->input('message', '');
        $sessionId = $request->input('session_id', $this->generateSessionId());
        $intent = $request->input('intent', null);
        $context = $request->input('context', []);

        // Get intent from message if not provided
        if (!$intent) {
            $intentData = $this->classifyIntent($message);
            $intent = $intentData['intent'];
        }

        // Try to get rich response from intents/FAQs
        $richResponse = $this->getRichResponse($intent, $message);

        if ($richResponse) {
            // Save conversation
            $this->saveConversation($sessionId, $message, $richResponse, $intent);

            return response()->json([
                'response' => $richResponse['text'],
                'type' => $richResponse['type'],
                'quick_actions' => $richResponse['quick_actions'] ?? [],
                'suggestions' => $richResponse['suggestions'] ?? [],
                'intent' => $intent,
                'sentiment' => $this->detectSentiment($message),
            ]);
        }

        // Fall back to dynamic query service
        $dynamicResponse = $this->dynamicQueryService->processQuery($message);

        if ($dynamicResponse) {
            $richResponse = [
                'text' => $dynamicResponse,
                'type' => 'text',
                'quick_actions' => $this->getDefaultQuickActions(),
                'suggestions' => $this->getDefaultSuggestions(),
            ];

            // Save conversation
            $this->saveConversation($sessionId, $message, $richResponse, 'dynamic_query');

            return response()->json([
                'response' => $dynamicResponse,
                'type' => 'text',
                'quick_actions' => $richResponse['quick_actions'],
                'suggestions' => $richResponse['suggestions'],
                'intent' => 'dynamic_query',
                'sentiment' => $this->detectSentiment($message),
            ]);
        }

        // Final fallback - default response
        $defaultResponse = $this->getDefaultFallbackResponse();

        $this->saveConversation($sessionId, $message, $defaultResponse, 'default', true);

        return response()->json([
            'response' => $defaultResponse['text'],
            'type' => $defaultResponse['type'],
            'quick_actions' => $defaultResponse['quick_actions'],
            'suggestions' => $defaultResponse['suggestions'],
            'intent' => 'default',
            'sentiment' => $this->detectSentiment($message),
            'was_unanswered' => true,
        ]);
    }

    /**
     * Submit feedback for a conversation
     */
    public function submitFeedback(Request $request)
    {
        $request->validate([
            'conversation_id' => 'nullable|exists:chatbot_conversations,id',
            'is_helpful' => 'required|boolean',
            'comment' => 'nullable|string',
            'sentiment' => 'nullable|in:positive,negative,neutral',
        ]);

        ChatbotFeedback::create([
            'conversation_id' => $request->conversation_id,
            'is_helpful' => $request->is_helpful,
            'user_comment' => $request->comment,
            'sentiment' => $request->sentiment ?? $this->detectSentiment($request->comment ?? ''),
        ]);

        // Update conversation if ID provided
        if ($request->conversation_id) {
            ChatbotConversation::where('id', $request->conversation_id)
                ->update(['was_helpful' => $request->is_helpful]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas feedback Anda!'
        ]);
    }

    /**
     * Get popular queries
     */
    public function getPopularQueries(Request $request)
    {
        $limit = $request->input('limit', 10);
        $queries = ChatbotConversation::getPopularQueries($limit);

        return response()->json([
            'success' => true,
            'data' => $queries
        ]);
    }

    /**
     * Get conversation history for a session
     */
    public function getConversationHistory(Request $request)
    {
        $sessionId = $request->input('session_id');

        if (!$sessionId) {
            return response()->json([
                'success' => false,
                'message' => 'Session ID required'
            ], 400);
        }

        $conversations = ChatbotConversation::forSession($sessionId)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $conversations
        ]);
    }

    /**
     * Get analytics data
     */
    public function getAnalytics(Request $request)
    {
        $days = $request->input('days', 7);

        $totalConversations = ChatbotConversation::recent($days)->count();
        $unansweredCount = ChatbotConversation::recent($days)->where('was_unanswered', true)->count();
        $sentimentStats = ChatbotConversation::getSentimentStats();
        $popularQueries = ChatbotConversation::getPopularQueries(10);

        return response()->json([
            'success' => true,
            'data' => [
                'total_conversations' => $totalConversations,
                'unanswered_count' => $unansweredCount,
                'unanswered_percentage' => $totalConversations > 0
                    ? round(($unansweredCount / $totalConversations) * 100, 1)
                    : 0,
                'sentiment_distribution' => $sentimentStats,
                'popular_queries' => $popularQueries,
            ]
        ]);
    }

    /**
     * Classify intent from message
     */
    protected function classifyIntent($message)
    {
        $lowerMessage = strtolower($message);

        $intentPatterns = [
            'greeting' => ['halo', 'hai', 'hi', 'hello', 'assalamualaikum', 'pagi', 'siang', 'malam', 'selamat'],
            'informasi_desa' => ['desa', 'kotalo', 'tentang', 'profil', 'info'],
            'kepala_desa' => ['kepala desa', 'lurah', 'kades', 'sambutan', 'pemimpin'],
            'visi_misi' => ['visi', 'misi', 'tujuan', 'cita-cita'],
            'struktur' => ['struktur', 'organisasi', 'pengurus', 'ketua', 'sekretaris'],
            'data_penduduk' => ['penduduk', 'warga', 'jumlah', 'data', 'demografi'],
            'statistik' => ['statistik', 'grafik', 'chart', 'persentase'],
            'gender' => ['laki', 'perempuan', 'pria', 'wanita'],
            'surat_online' => ['surat', 'surat online', 'pengajuan', 'ktp', 'kk'],
            'bansos' => ['bansos', 'bantuan sosial', 'bpnt', 'pkh', 'blt', 'bantuan'],
            'umkm' => ['umkm', 'usaha', 'bisnis', 'wirausaha', 'entrepreneur'],
            'apbdes' => ['apbdes', 'anggaran', 'keuangan', 'dana', 'budget'],
            'gis' => ['gis', 'peta', 'map', 'lokasi', 'wilayah'],
            'lokasi' => ['lokasi', 'alamat', 'dimana', 'letak'],
            'kontak' => ['kontak', 'hubungi', 'whatsapp', 'email', 'telepon'],
            'jam' => ['jam', 'buka', 'tutup', 'operasional', 'jadwal'],
            'thank' => ['terima kasih', 'thanks', 'makasih', 'thx'],
            'goodbye' => ['dadah', 'bye', 'selamat tinggal', 'sampai jumpa'],
        ];

        $bestMatch = 'default';
        $highestScore = 0;

        foreach ($intentPatterns as $intent => $patterns) {
            $score = 0;
            foreach ($patterns as $pattern) {
                if (strpos($lowerMessage, $pattern) !== false) {
                    $score++;
                }
            }

            if ($score > $highestScore) {
                $highestScore = $score;
                $bestMatch = $intent;
            }
        }

        return [
            'intent' => $bestMatch,
            'confidence' => $highestScore > 0 ? min(1, $highestScore * 0.3) : 0.1,
        ];
    }

    /**
     * Get rich response from database
     */
    protected function getRichResponse($intent, $message)
    {
        $intentModel = ChatbotIntent::where('name', $intent)
            ->where('is_active', true)
            ->first();

        if (!$intentModel) {
            // Try to find matching FAQ
            $faq = ChatbotFAQ::where('is_active', true)
                ->where(function ($query) use ($message) {
                    $query->where('question', 'like', "%{$message}%")
                        ->orWhere('keywords', 'like', "%{$message}%");
                })
                ->first();

            if ($faq) {
                $faq->incrementViewCount();
                return [
                    'text' => $faq->answer,
                    'type' => 'text',
                    'suggestions' => $this->getDefaultSuggestions(),
                ];
            }

            return null;
        }

        return [
            'text' => $intentModel->response_template,
            'type' => $intentModel->response_type,
            'quick_actions' => $intentModel->quick_actions ?? [],
            'suggestions' => $intentModel->suggested_questions ?? [],
        ];
    }

    /**
     * Get default fallback response
     */
    protected function getDefaultFallbackResponse()
    {
        $intentModel = ChatbotIntent::where('name', 'default')->first();

        return [
            'text' => $intentModel?->response_template ??
                "Maaf, saya belum memahami pertanyaan Anda. 🤔\n\nSilakan coba tanyakan tentang:\n\n• Data penduduk\n• Profil desa (visi misi, sejarah)\n• Layanan surat online\n• Bansos dan bantuan sosial\n• UMKM dan usaha lokal\n• APBDes dan keuangan\n• GIS dan peta desa\n• Kontak dan jam operasional",
            'type' => 'suggestions',
            'quick_actions' => $intentModel?->quick_actions ?? [
                ['label' => '📊 Data Penduduk', 'action' => 'data_penduduk'],
                ['label' => '📄 Surat Online', 'action' => 'surat_online'],
                ['label' => '💰 Bansos', 'action' => 'bansos'],
                ['label' => '💼 UMKM', 'action' => 'umkm'],
            ],
            'suggestions' => $intentModel?->suggested_questions ?? [
                'Berapa jumlah penduduk?',
                'Cara membuat surat',
                'Apa saja bansos?',
                'UMKM apa saja?',
            ],
        ];
    }

    /**
     * Get default quick actions
     */
    protected function getDefaultQuickActions()
    {
        return [
            ['label' => '📊 Data Penduduk', 'action' => 'data_penduduk'],
            ['label' => '📄 Surat Online', 'action' => 'surat_online'],
            ['label' => '💰 Bansos', 'action' => 'bansos'],
            ['label' => '💼 UMKM', 'action' => 'umkm'],
            ['label' => '📞 Kontak', 'action' => 'kontak'],
        ];
    }

    /**
     * Get default suggestions
     */
    protected function getDefaultSuggestions()
    {
        return [
            'Berapa jumlah penduduk desa?',
            'Cara membuat surat keterangan?',
            'Apa saja program bansos?',
            'UMKM有哪些 di desa?',
            'Jam berapa kantor desa buka?',
            'Dimana lokasi kantor desa?',
        ];
    }

    /**
     * Save conversation to database
     */
    protected function saveConversation($sessionId, $message, $response, $intent, $wasUnanswered = false)
    {
        try {
            ChatbotConversation::create([
                'session_id' => $sessionId,
                'user_message' => $message,
                'bot_response' => $response['text'],
                'intent' => $intent,
                'confidence_score' => $this->classifyIntent($message)['confidence'],
                'response_type' => $response['type'] ?? 'text',
                'was_unanswered' => $wasUnanswered,
                'sentiment' => $this->detectSentiment($message),
            ]);
        } catch (\Exception $e) {
            // Log error but don't break the flow
            \Log::error('Failed to save chatbot conversation: ' . $e->getMessage());
        }
    }

    /**
     * Detect sentiment from message
     */
    protected function detectSentiment($message)
    {
        $lowerMessage = strtolower($message);

        $positiveWords = ['terima kasih', 'bagus', 'mantap', 'keren', 'baik', 'senang', 'puas', 'happy', 'good', 'thanks'];
        $negativeWords = ['gagal', 'buruk', 'kecewa', 'salah', 'problem', 'error', 'bad', 'angry', 'tidak puas'];

        foreach ($positiveWords as $word) {
            if (strpos($lowerMessage, $word) !== false) {
                return 'positive';
            }
        }

        foreach ($negativeWords as $word) {
            if (strpos($lowerMessage, $word) !== false) {
                return 'negative';
            }
        }

        return 'neutral';
    }

    /**
     * Generate unique session ID
     */
    protected function generateSessionId()
    {
        return 'chat_' . now()->timestamp . '_' . Str::random(8);
    }
}
