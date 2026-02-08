/**
 * Advanced Chatbot for Desa Oyalo
 * Features: Intent-based responses, rich cards, quick actions, feedback, sentiment detection
 */

class AdvancedChatbot {
    constructor() {
        this.isOpen = false;
        this.isTyping = false;
        this.sessionId = this.getOrCreateSessionId();
        this.conversationHistory = this.loadConversationHistory();
        this.sentiment = 'neutral';
        this.lastIntent = null;

        this.intents = this.initializeIntents();
        this.knowledgeBase = this.initializeKnowledgeBase();
        this.quickActions = this.initializeQuickActions();
        this.suggestedQuestions = this.initializeSuggestedQuestions();

        this.init();
    }

    /**
     * Get or create session ID
     */
    getOrCreateSessionId() {
        let sessionId = localStorage.getItem('chatbot_session_id');
        if (!sessionId) {
            sessionId = 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('chatbot_session_id', sessionId);
        }
        return sessionId;
    }

    /**
     * Load conversation history from localStorage
     */
    loadConversationHistory() {
        try {
            const history = localStorage.getItem('chatbot_history');
            return history ? JSON.parse(history) : [];
        } catch (e) {
            return [];
        }
    }

    /**
     * Save conversation history to localStorage
     */
    saveConversationHistory() {
        try {
            // Keep only last 20 conversations
            const trimmedHistory = this.conversationHistory.slice(-20);
            localStorage.setItem('chatbot_history', JSON.stringify(trimmedHistory));
        } catch (e) {
            console.warn('Failed to save conversation history');
        }
    }

    /**
     * Initialize intents for classification
     */
    initializeIntents() {
        return {
            greeting: { patterns: ['halo', 'hai', 'hi', 'hello', 'assalamualaikum', 'pagi', 'siang', 'malam', 'selamat'], confidence: 0.95 },
            informasi_desa: { patterns: ['desa', 'kotalo', 'tentang', 'profil', 'info', 'oyalo'], confidence: 0.85 },
            kepala_desa: { patterns: ['kepala desa', 'lurah', 'kades', 'sambutan', 'pemimpin', 'leader'], confidence: 0.9 },
            visi_misi: { patterns: ['visi', 'misi', 'tujuan', 'cita-cita', 'mission', 'vision', 'goals'], confidence: 0.9 },
            struktur: { patterns: ['struktur', 'organisasi', 'pengurus', 'ketua', 'sekretaris', 'bendahara'], confidence: 0.85 },
            data_penduduk: { patterns: ['penduduk', 'warga', 'jumlah', 'data', 'demografi', 'total'], confidence: 0.85 },
            statistik: { patterns: ['statistik', 'grafik', 'chart', 'persentase', 'percentage', 'statistic'], confidence: 0.9 },
            gender: { patterns: ['laki', 'perempuan', 'pria', 'wanita', 'laki-laki', 'gender', 'jk'], confidence: 0.9 },
            surat_online: { patterns: ['surat', 'surat online', 'pengajuan', 'ktp', 'kk', 'dokumen'], confidence: 0.85 },
            bansos: { patterns: ['bansos', 'bantuan sosial', 'bpnt', 'pkh', 'blt', 'bantuan', 'social aid'], confidence: 0.85 },
            umkm: { patterns: ['umkm', 'usaha', 'bisnis', 'wirausaha', 'entrepreneur', 'shop', 'store'], confidence: 0.85 },
            apbdes: { patterns: ['apbdes', 'anggaran', 'keuangan', 'dana', 'budget', 'apb'], confidence: 0.85 },
            gis: { patterns: ['gis', 'peta', 'map', 'lokasi', 'wilayah', 'geographic'], confidence: 0.85 },
            lokasi: { patterns: ['lokasi', 'alamat', 'dimana', 'letak', 'address', 'where'], confidence: 0.85 },
            kontak: { patterns: ['kontak', 'hubungi', 'whatsapp', 'email', 'telepon', 'phone'], confidence: 0.85 },
            jam: { patterns: ['jam', 'buka', 'tutup', 'operasional', 'jadwal', 'waktu', 'time', 'hours'], confidence: 0.85 },
            thank: { patterns: ['terima kasih', 'thanks', 'makasih', 'thx', 'terima', 'kasih'], confidence: 0.95 },
            goodbye: { patterns: ['dadah', 'bye', 'selamat tinggal', 'sampai jumpa', 'see you'], confidence: 0.95 },
            help: { patterns: ['bantuan', 'help', 'tolong', 'bisa', 'can you', 'what can'], confidence: 0.85 },
            search: { patterns: ['cari', 'search', 'find', 'temukan', 'looking for'], confidence: 0.85 }
        };
    }

    /**
     * Initialize knowledge base responses
     */
    initializeKnowledgeBase() {
        return {
            greeting: {
                responses: [
                    "Halo! 👋 Selamat datang di Website Desa Oyalo. Saya asisten virtual yang siap membantu Anda.\n\nAda yang bisa saya bantu hari ini?",
                    "Hai! Senang bertemu dengan Anda! Saya bisa membantu menjawab pertanyaan tentang Desa Oyalo.\n\nMau tahu apa?",
                    "Assalamualaikum! Welcome to Desa Oyalo Chatbot! 😊\n\nSilakan tanya apapun tentang layanan desa kami."
                ]
            },
            informasi_desa: {
                responses: [
                    "Desa Oyalo berlokasi di Kecamatan Morotai Selatan, Kabupaten Pulau Morotai, Maluku Utara.\n\nDesa kami tersebar di beberapa RT/RW dengan jumlah penduduk yang terus berkembang. Kami berkomitmen untuk memberikan pelayanan terbaik kepada masyarakat.",
                    "Desa Oyalo terus berkembang dengan berbagai program pembangunan dan pelayanan.\n\nJika Anda membutuhkan informasi spesifik, silakan tanya!"
                ]
            },
            kepala_desa: {
                responses: [
                    "Kepala Desa Oyalo memimpin dengan prinsip transparansi dan akuntabilitas.\n\nBeliau berkomitmen untuk meningkatkan kualitas pelayanan kepada masyarakat dan mengembangkan potensi desa.",
                    "Pemimpin Desa Oyalo berfokus pada pembangunan berkelanjutan dan pemberdayaan masyarakat.\n\nAda yang ingin ditanyakan tentang kepemimpinan desa?"
                ]
            },
            visi_misi: {
                responses: [
                    "📋 **VISI DESA OYALO:**\n\"Mewujudkan Desa Oyalo yang maju, sejahtera, mandiri, dan berbudaya\"\n\n🎯 **MISI DESA OYALO:**\n1. Meningkatkan kualitas sumber daya manusia\n2. Mengembangkan ekonomi lokal dan UMKM\n3. Meningkatkan tata kelola pemerintahan yang baik\n4. Memelihara budaya dan kearifan lokal\n5. Meningkatkan infrastruktur dan fasilitas umum"
                ]
            },
            struktur: {
                responses: [
                    "🏛️ **Struktur Organisasi Desa Oyalo:**\n\n• Kepala Desa\n• Sekretaris Desa\n• Bendahara Desa\n• Kaur Umum\n• Kaur Keuangan\n• Kepala RW\n• Ketua RT\n\nKunjungi menu Profil untuk informasi lengkap!",
                    "Tim pengelola Desa Oyalo terdiri dari:\n\n- Kepala Desa\n- Sekretaris\n- Bendahara\n- Kaur (Kepala Urusan)\n- Kepala RT/RW\n\nSemua bekerja untuk melayani masyarakat!"
                ]
            },
            data_penduduk: {
                responses: [
                    "📊 **Data Penduduk Desa Oyalo**\n\nSilakan查看 Data Penduduk untuk informasi lengkap:\n• Total jumlah penduduk\n• Distribusi jenis kelamin\n• Peringkat RT/RW\n• Tingkat pendidikan\n• Jenis pekerjaan\n• Agama",
                    "Statistik penduduk mencakup:\n- Jumlah total warga\n- Komposisi usia\n- Tingkat pendidikan\n- Mata pencaharian\n\nTanyakan spesifik jika butuh info tertentu!"
                ]
            },
            statistik: {
                responses: [
                    "📈 **Statistik Desa Oyalo**\n\nKami menyediakan statistik lengkap meliputi:\n• Demografi penduduk\n• Tingkat pendidikan\n• Jenis pekerjaan\n• Agama dan kepercayaan\n• UMKM dan ekonomi\n\nKunjungi menu Data Desa untuk detailnya!"
                ]
            },
            gender: {
                responses: [
                    "Distribusi jenis kelamin di Desa Oyalo dapat dilihat di dashboard Data Penduduk.\n\nTanyakan 'berapa jumlah laki-laki' atau 'berapa perempuan' untuk informasi spesifik!",
                    "Data男女 (jenis kelamin) tersedia dengan detail per RT/RW.\n\nSilakan akses menu Statistik untuk informasi lengkap!"
                ]
            },
            surat_online: {
                responses: [
                    "📄 **Layanan Surat Online Desa Oyalo**\n\n**Jenis surat yang tersedia:**\n• Surat Keterangan Domisili\n• Surat Keterangan Tidak Mampu (SKTM)\n• Surat Keterangan Usaha\n• Surat Pengantar SKCK\n• Surat Keterangan Lahir\n• Surat Keterangan Meninggal\n• Surat Pindah\n\n**📝 Cara mengajukan:**\n1. Klik menu Surat Online\n2. Pilih jenis surat\n3. Isi formulir yang diperlukan\n4. Submit dan tunggu verifikasi\n5. Ambil surat di kantor desa\n\n⏱️ **Proses: 1-3 hari kerja**"
                ]
            },
            bansos: {
                responses: [
                    "💰 **Program Bantuan Sosial Desa Oyalo**\n\n**Jenis bansos yang tersedia:**\n• BPNT (Bantuan Pangan Non Tunai)\n• PKH (Program Keluarga Harapan)\n• BLT Dana Desa\n• Bantuan langsung lainnya\n\n**📋 Syarat umum:**\n• Warga Desa Oyalo\n• Memenuhi kriteria ekonomi\n• Terdata di DTKS\n\n**📞 Info lebih lanjut:** Kantor Desa"
                ]
            },
            umkm: {
                responses: [
                    "💼 **UMKM Desa Oyalo**\n\nKami mendukung pelaku UMKM lokal dengan kategori:\n• Kuliner (makanan tradisional, jajanan)\n• Fashion (konveksi, tenun)\n• Kerajinan (anyaman, ukir)\n• Pertanian (hasil bumi)\n• Jasa (各种 layanan)\n\n🏪 Kunjungi menu UMKM untuk melihat daftar lengkap dan produk yang tersedia!"
                ]
            },
            apbdes: {
                responses: [
                    "💰 **APBDes Desa Oyalo**\n\n**📥 PENDAPATAN:**\n• Dana Desa\n• Alokasi Dana Desa\n• Pendapatan Asli Desa\n\n**📤 BELANJA:**\n• Bidang Penyelenggaraan Pemerintah\n• Bidang Pembangunan\n• Bidang Pembinaan Kemasyarakatan\n• Bidang Pemberdayaan Masyarakat\n\n**📊 PEMBIAYAAN:**\n• SilPA tahun sebelumnya\n\nKunjungi menu APBDes untuk detail lengkap!"
                ]
            },
            gis: {
                responses: [
                    "🗺️ **GIS Desa Oyalo**\n\n**Fitur peta interaktif kami:**\n• Peta wilayah RT/RW\n• Lokasi fasilitas publik\n• Peta infrastruktur desa\n• Batas wilayah desa\n\nGunakan menu GIS/Peta untuk menjelajahi wilayah desa secara interaktif!"
                ]
            },
            lokasi: {
                responses: [
                    "📍 **Lokasi Desa Oyalo**\n\n🏛️ **Kantor Desa Oyalo**\nKecamatan Morotai Selatan\nKabupaten Pulau Morotai\nProvinsi Maluku Utara\n\n🕐 **Jam Operasional:**\n• Senin - Kamis: 07:30 - 16:00 WIT\n• Jumat: 07:30 - 11:30 WIT\n• Sabtu - Minggu: Tutup"
                ]
            },
            kontak: {
                responses: [
                    "📞 **Kontak Desa Oyalo**\n\n🏛️ **Alamat:**\nKantor Desa Oyalo\nKec. Morotai Selatan\nKab. Pulau Morotai\nMaluku Utara\n\n📱 **WhatsApp:** 0822-XXXX-XXXX\n📧 **Email:** info@desaotalo.com\n🌐 **Website:** www.desaotalo.com\n\nKami siap membantu Anda!"
                ]
            },
            jam: {
                responses: [
                    "🕐 **Jam Operasional Kantor Desa Oyalo**\n\n📅 **Hari Kerja:**\n• Senin - Kamis: 07:30 - 16:00 WIT\n• Jumat: 07:30 - 11:30 WIT\n\n🛑 **Tutup:**\n• Sabtu - Minggu\n• Hari Libur Nasional\n\n💡 **Tips:** Datanglah di jam kerja untuk pelayanan optimal!"
                ]
            },
            thank: {
                responses: [
                    "Sama-sama! 😊\n\nSenang bisa membantu Anda. Ada yang bisa saya bantu lagi?\n\n💬 **Anda juga bisa:**\n• Menghubungi kami via WhatsApp\n• Mengisi formulir aspirasi\n• Mengajukan pengaduan\n\nTerima kasih telah mengunjungi Website Desa Oyalo!"
                ]
            },
            goodbye: {
                responses: [
                    "Sampai jumpa! 👋\n\nTerima kasih telah menghubungi kami.\n\nJika membutuhkan bantuan lain, jangan ragu untuk kembali.\n\nKami siap melayani Anda kapan saja!\n\n💬 **Hotline WhatsApp:** 0822-XXXX-XXXX"
                ]
            },
            help: {
                responses: [
                    "Saya bisa membantu Anda dengan informasi tentang:\n\n📊 **Data & Statistik**\n- Jumlah penduduk\n- Demografi\n- Statistik RT/RW\n\n🏛️ **Profil Desa**\n- Visi Misi\n- Sejarah\n- Struktur Organisasi\n\n📄 **Layanan**\n- Surat Online\n- Bansos\n- Dokumen\n\n💼 **Ekonomi**\n- UMKM\n- APBDes\n\n🗺️ **Informasi**\n- Lokasi & Peta\n- Jam Operasional\n- Kontak\n\nTanyakan dengan bahasa natural!"
                ]
            },
            default: {
                responses: [
                    "Maaf, saya belum memahami pertanyaan Anda. 🤔\n\n**Coba tanyakan tentang:**\n\n📊 Data Penduduk\n🏛️ Profil Desa (visi misi, sejarah)\n📄 Layanan surat online\n💰 Bansos dan bantuan sosial\n💼 UMKM dan usaha lokal\n💰 APBDes dan keuangan\n🗺️ GIS dan peta desa\n📞 Kontak dan jam operasional\n\n**Contoh:** 'Berapa jumlah penduduk?' atau 'Cara membuat SKTM'",
                    "Sedang belajar... 😅\n\nSaya bisa membantu menjawab pertanyaan tentang Desa Oyalo.\n\nSilakan coba dengan pertanyaan yang lebih spesifik atau pilih dari menu di bawah!"
                ]
            }
        };
    }

    /**
     * Initialize quick action buttons
     */
    initializeQuickActions() {
        return [
            { label: '📊 Data Penduduk', action: 'data_penduduk', icon: 'people' },
            { label: '🏛️ Profil Desa', action: 'profil_desa', icon: 'building' },
            { label: '📄 Surat Online', action: 'surat_online', icon: 'file-text' },
            { label: '💰 Bansos', action: 'bansos', icon: 'gift' },
            { label: '💼 UMKM', action: 'umkm', icon: 'shop' },
            { label: '📞 Kontak', action: 'kontak', icon: 'phone' },
        ];
    }

    /**
     * Initialize suggested questions
     */
    initializeSuggestedQuestions() {
        return [
            'Berapa jumlah penduduk desa?',
            'Cara membuat SKTM?',
            'Apa saja program bansos?',
            'UMKM有哪些 di desa?',
            'Jam berapa kantor desa buka?',
            'Dimana lokasi kantor desa?',
            'Apa visi dan misi desa?',
            'Cara mendaftarkan UMKM?',
            'Bagaimana cara mengajukan surat?',
            'Apa itu APBDes?'
        ];
    }

    /**
     * Initialize chatbot
     */
    init() {
        this.createChatbotUI();
        this.bindEvents();
        this.loadConversation();
    }

    /**
     * Create chatbot UI elements
     */
    createChatbotUI() {
        // Remove existing chatbot if any
        const existingChatbot = document.getElementById('advanced-chatbot');
        if (existingChatbot) {
            existingChatbot.remove();
        }

        // Create HTML structure
        const html = `
            <div class="advanced-chatbot" id="advanced-chatbot">
                <div class="chatbot-header">
                    <div class="chatbot-header-info">
                        <div class="chatbot-avatar">🤖</div>
                        <div class="chatbot-title">
                            <h4>Asisten Desa Oyalo</h4>
                            <span class="status">Online</span>
                        </div>
                    </div>
                    <button class="chatbot-close" id="chatbot-close" aria-label="Close">×</button>
                </div>
                <div class="chatbot-messages" id="chatbot-messages">
                    <!-- Messages will be inserted here -->
                    <div class="typing-indicator" id="typing-indicator" style="display: none;">
                        <div class="message bot">
                            <div class="message-content">
                                <div class="typing-dots">
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                    <div class="dot"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chatbot-quick-actions" id="chatbot-quick-actions" style="display: none;">
                    <!-- Quick action buttons -->
                </div>
                <div class="chatbot-suggestions" id="chatbot-suggestions" style="display: none;">
                    <!-- Suggested questions -->
                </div>
                <div class="chatbot-input-area">
                    <input type="text" class="chatbot-input" id="chatbot-input" placeholder="Ketik pertanyaan Anda...">
                    <button class="chatbot-send" id="chatbot-send">➤</button>
                </div>
                <button class="chatbot-toggle" id="chatbot-toggle">💬</button>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', html);

        // Get DOM elements
        this.container = document.getElementById('advanced-chatbot');
        this.messagesContainer = document.getElementById('chatbot-messages');
        this.input = document.getElementById('chatbot-input');
        this.sendButton = document.getElementById('chatbot-send');
        this.toggleButton = document.getElementById('chatbot-toggle');
        this.closeButton = document.getElementById('chatbot-close');
        this.typingIndicator = document.getElementById('typing-indicator');
        this.quickActionsContainer = document.getElementById('chatbot-quick-actions');
        this.suggestionsContainer = document.getElementById('chatbot-suggestions');
    }

    /**
     * Bind event listeners
     */
    bindEvents() {
        this.toggleButton.addEventListener('click', () => this.toggleChatbot());
        this.closeButton.addEventListener('click', () => this.closeChatbot());
        this.sendButton.addEventListener('click', () => this.sendMessage());
        this.input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.sendMessage();
        });

        // Quick actions click handler (delegated)
        this.quickActionsContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('quick-action-btn')) {
                this.handleQuickAction(e.target.dataset.action);
            }
        });

        // Suggestions click handler (delegated)
        this.suggestionsContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('suggestion-btn')) {
                this.sendMessage(e.target.textContent);
            }
        });

        // Feedback click handler (delegated)
        this.messagesContainer.addEventListener('click', (e) => {
            if (e.target.classList.contains('feedback-btn')) {
                this.handleFeedback(e.target.dataset.helpful, e.target.closest('.message'));
            }
        });
    }

    /**
     * Toggle chatbot visibility
     */
    toggleChatbot() {
        if (this.isOpen) {
            this.closeChatbot();
        } else {
            this.openChatbot();
        }
    }

    /**
     * Open chatbot
     */
    openChatbot() {
        this.container.style.display = 'flex';
        this.toggleButton.classList.add('active');
        this.isOpen = true;
        this.input.focus();

        // Scroll to bottom
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
    }

    /**
     * Close chatbot
     */
    closeChatbot() {
        this.container.style.display = 'none';
        this.toggleButton.classList.remove('active');
        this.isOpen = false;
    }

    /**
     * Load previous conversation
     */
    loadConversation() {
        if (this.conversationHistory.length === 0) {
            // Show welcome message for new users
            setTimeout(() => {
                this.showWelcomeMessage();
            }, 800);
        } else {
            // Show last few messages
            const recentMessages = this.conversationHistory.slice(-5);
            recentMessages.forEach(msg => {
                this.addMessageToUI(msg.text, msg.sender, msg.type);
            });
        }
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
    }

    /**
     * Show welcome message
     */
    showWelcomeMessage() {
        const welcomeMsg = this.knowledgeBase.greeting.responses[0];
        this.addMessage(welcomeMsg, 'bot', 'greeting');
        this.renderQuickActions(this.quickActions.slice(0, 4));
        this.renderSuggestions(this.suggestedQuestions.slice(0, 4));
    }

    /**
     * Classify intent from message
     */
    classifyIntent(message) {
        const lower = message.toLowerCase();
        let best = 'unknown';
        let highest = 0;

        for (const [name, data] of Object.entries(this.intents)) {
            for (const pattern of data.patterns) {
                if (lower.includes(pattern.toLowerCase())) {
                    if (data.confidence > highest) {
                        highest = data.confidence;
                        best = name;
                    }
                    break;
                }
            }
        }

        return best === 'unknown' ? 'default' : best;
    }

    /**
     * Detect sentiment from message
     */
    detectSentiment(message) {
        const lower = message.toLowerCase();

        const positiveWords = ['terima kasih', 'bagus', 'mantap', 'keren', 'baik', 'senang', 'puas', 'happy', 'good', 'thanks', 'sip', 'okee'];
        const negativeWords = ['gagal', 'buruk', 'kecewa', 'salah', 'problem', 'error', 'bad', 'angry', 'tidak puas', 'gimana', 'kok'];

        for (const word of positiveWords) {
            if (lower.includes(word)) return 'positive';
        }

        for (const word of negativeWords) {
            if (lower.includes(word)) return 'negative';
        }

        return 'neutral';
    }

    /**
     * Send message
     */
    async sendMessage(overrideMessage = null) {
        const message = overrideMessage || this.input.value.trim();
        if (!message || this.isTyping) return;

        this.input.value = '';

        // Add user message to conversation history
        this.conversationHistory.push({ text: message, sender: 'user' });
        this.saveConversationHistory();

        this.addMessage(message, 'user');
        this.showTypingIndicator();
        this.isTyping = true;

        // Detect sentiment
        this.sentiment = this.detectSentiment(message);

        // Classify intent
        const intent = this.classifyIntent(message);
        this.lastIntent = intent;

        try {
            const res = await fetch('/api/chatbot/respond', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    message,
                    intent,
                    session_id: this.sessionId,
                    context: this.conversationHistory.slice(-3)
                })
            });

            const data = await res.json();

            this.hideTypingIndicator();
            this.isTyping = false;

            // Add bot response to conversation history
            this.conversationHistory.push({ text: data.response, sender: 'bot' });
            this.saveConversationHistory();

            this.addMessage(data.response, 'bot', data.type, data.intent);

            // Show quick actions and suggestions
            if (data.quick_actions && data.quick_actions.length > 0) {
                this.renderQuickActions(data.quick_actions);
            }

            if (data.suggestions && data.suggestions.length > 0) {
                this.renderSuggestions(data.suggestions);
            }

            // Store conversation ID for feedback
            this.lastConversationId = data.conversation_id;

        } catch (e) {
            console.error('Chatbot error:', e);
            this.hideTypingIndicator();
            this.isTyping = false;

            // Fallback response
            const fallbackMsg = this.knowledgeBase.default.responses[0];
            this.addMessage(fallbackMsg, 'bot', 'default');
        }
    }

    /**
     * Handle quick action click
     */
    handleQuickAction(action) {
        const actionMessages = {
            'data_penduduk': 'Saya ingin melihat data penduduk',
            'profil_desa': 'Tell me about the village profile',
            'surat_online': 'Cara membuat surat online',
            'bansos': 'Apa saja program bansos?',
            'umkm': 'Daftar UMKM di desa',
            'kontak': 'Kontak kantor desa',
            'dashboard_penduduk': 'Lihat dashboard penduduk',
            'cari_penduduk': 'Cari penduduk',
            'statistik_penduduk': 'Statistik penduduk',
            'ajuansurat': 'Ajukan surat',
            'status_surat': 'Cek status surat',
            'penerima_bansos': 'Daftar penerima bansos',
            'daftar_bansos': 'Cara daftar bansos',
            'daftar_umkm': 'Lihat daftar UMKM',
            'daftar_umkm_baru': 'Daftar UMKM baru',
            'apbdes_detail': 'Lihat APBDes lengkap',
            'apbdes_grafik': 'Lihat grafik APBDes',
            'buka_peta': 'Buka peta desa',
            'cari_lokasi': 'Cari lokasi',
            'peta_lokasi': 'Lihat peta lokasi',
            'whatsapp': 'Hubungi via WhatsApp',
            'email': 'Kirim email',
            'beranda': 'Kembali ke beranda',
            'pengaduan': 'Ajukan pengaduan',
        };

        const message = actionMessages[action] || action;
        this.sendMessage(message);
    }

    /**
     * Handle feedback
     */
    handleFeedback(isHelpful, messageElement) {
        const helpful = isHelpful === 'true';

        // Update UI
        const feedbackContainer = messageElement.querySelector('.feedback-container');
        if (feedbackContainer) {
            feedbackContainer.innerHTML = helpful ? '👍 Terima kasih!' : '👎 Maaf atas ketidaknyamanannya';
        }

        // Send feedback to server
        fetch('/api/chatbot/feedback', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                conversation_id: this.lastConversationId,
                is_helpful: helpful,
                sentiment: this.sentiment
            })
        }).catch(e => console.error('Feedback error:', e));
    }

    /**
     * Add message to UI
     */
    addMessage(text, sender, type = 'text', intent = null) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;
        messageDiv.dataset.intent = intent || '';

        // Format text with markdown-like syntax
        const formattedText = this.formatMessage(text);

        let contentHtml = `<div class="message-content">${formattedText}</div>`;

        // Add feedback buttons for bot messages
        if (sender === 'bot') {
            contentHtml += `
                <div class="feedback-container">
                    <button class="feedback-btn" data-helpful="true" title="Bermanfaa">👍</button>
                    <button class="feedback-btn" data-helpful="false" title="Tidak bermanfaat">👎</button>
                </div>
            `;
        }

        messageDiv.innerHTML = contentHtml;

        // Insert before typing indicator
        this.messagesContainer.insertBefore(messageDiv, this.typingIndicator);
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
    }

    /**
     * Add message to UI (internal)
     */
    addMessageToUI(text, sender, type = 'text') {
        this.addMessage(text, sender, type);
    }

    /**
     * Format message with basic styling
     */
    formatMessage(text) {
        // Escape HTML first
        let formatted = text.replace(/</g, '<').replace(/>/g, '>');

        // Bold text
        formatted = formatted.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

        // Italic text
        formatted = formatted.replace(/\*(.*?)\*/g, '<em>$1</em>');

        // Line breaks
        formatted = formatted.replace(/\n/g, '<br>');

        // Bullet points
        formatted = formatted.replace(/^• /gm, '• ');
        formatted = formatted.replace(/^[-*] /gm, '• ');

        // Numbered lists
        formatted = formatted.replace(/^(\d+)\. /gm, '$1. ');

        return formatted;
    }

    /**
     * Show typing indicator
     */
    showTypingIndicator() {
        this.typingIndicator.style.display = 'block';
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
    }

    /**
     * Hide typing indicator
     */
    hideTypingIndicator() {
        this.typingIndicator.style.display = 'none';
    }

    /**
     * Render quick action buttons
     */
    renderQuickActions(actions) {
        if (!actions || actions.length === 0) {
            this.quickActionsContainer.style.display = 'none';
            return;
        }

        const html = actions.map(action => {
            if (typeof action === 'string') {
                return `<button class="quick-action-btn" data-action="${action}">${action}</button>`;
            }
            return `<button class="quick-action-btn" data-action="${action.action}">${action.label}</button>`;
        }).join('');

        this.quickActionsContainer.innerHTML = `<div class="quick-actions-label">Pilihan cepat:</div>${html}`;
        this.quickActionsContainer.style.display = 'block';
    }

    /**
     * Render suggested questions
     */
    renderSuggestions(questions) {
        if (!questions || questions.length === 0) {
            this.suggestionsContainer.style.display = 'none';
            return;
        }

        const html = questions.map(q =>
            `<button class="suggestion-btn">${q}</button>`
        ).join('');

        this.suggestionsContainer.innerHTML = `<div class="suggestions-label">Pertanyaan terkait:</div>${html}`;
        this.suggestionsContainer.style.display = 'block';
    }
}

// Initialize chatbot when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.chatbot = new AdvancedChatbot();
});

