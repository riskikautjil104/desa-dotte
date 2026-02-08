<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ @$title != '' ? "$title - " : '' }}{{ config('app.name') }}</title>
    <meta name="description" content="@yield('meta-description', 'Website resmi Desa Dotte - Profil, layanan, statistik, dan informasi publik.')">

    <meta content="Website Desa Dotte" name="description">
    <meta content="Desa Dotte" name="keywords">
    <meta name="author" content="Desa Dotte">
    <meta name="google-site-verification" content="D2PNntJweEByiV4CSZUbbPQUsozwyGwepi4r9J5vRvY" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('assets/ico/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/ico/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/ico/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/ico/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Dotte WebDes" />
    <link rel="manifest" href="{{ asset('assets/ico/site.webmanifest') }}" />


    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">


    {{-- lafleat --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/modern-enhancements.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/dropdown-fix.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/navbar-fix.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/chatbot.css') }}" rel="stylesheet">

    <style>
        /* ========================================
           FLOATING BUTTONS - FIXED VERSION
           ======================================== */
        
        /* Base button style */
        .floating-btn {
            position: fixed !important;
            width: 50px !important;
            height: 50px !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
            transition: all 0.3s ease !important;
            z-index: 9999 !important;
            cursor: pointer !important;
            border: none !important;
            text-decoration: none !important;
        }
        
        .floating-btn:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25) !important;
        }

        /* 1. WhatsApp Button - BOTTOM LEFT */
        #btnWhatsApp {
            bottom: 20px !important;
            left: 20px !important;
            background: #25D366 !important;
            color: white !important;
        }
        
        #btnWhatsApp:hover {
            background: #128C7E !important;
        }
        
        #btnWhatsApp i {
            font-size: 24px !important;
        }

        /* 2. Pengaduan Button - MIDDLE LEFT */
        #btnPengaduan {
            bottom: 85px !important;
            left: 20px !important;
            background: #0dcdbd !important;
            color: white !important;
        }
        
        #btnPengaduan:hover {
            background: #0aaa9a !important;
        }
        
        #btnPengaduan img {
            width: 22px !important;
            filter: brightness(0) invert(1) !important;
        }

        /* 3. Chatbot Toggle Button - TOP LEFT */
        #chatbotToggle {
            bottom: 150px !important;
            left: 20px !important;
            background: linear-gradient(135deg, #6c5ce7 0%, #a29bfe 100%) !important;
            color: white !important;
            animation: pulse-chatbot 2s infinite !important;
        }
        
        #chatbotToggle:hover {
            animation: none !important;
        }
        
        #chatbotToggle.active {
            background: #dc3545 !important;
            animation: none !important;
        }
        
        #chatbotToggle i {
            font-size: 24px !important;
        }
        
        @keyframes pulse-chatbot {
            0%, 100% { 
                box-shadow: 0 0 0 0 rgba(108, 92, 231, 0.7);
            }
            50% { 
                box-shadow: 0 0 0 15px rgba(108, 92, 231, 0);
            }
        }

        /* 4. Back to Top Button - BOTTOM RIGHT */
        #backToTop {
            bottom: 20px !important;
            right: 20px !important;
            background: #0dcdbd !important;
            color: white !important;
            opacity: 0 !important;
            visibility: hidden !important;
            pointer-events: none !important;
        }
        
        #backToTop.visible {
            opacity: 1 !important;
            visibility: visible !important;
            pointer-events: auto !important;
        }
        
        #backToTop:hover {
            background: #0aaa9a !important;
        }
        
        #backToTop i {
            font-size: 26px !important;
        }

        /* ========================================
           RESPONSIVE
           ======================================== */
        
@media (max-width: 768px) {
            .floating-btn {
                width: 45px !important;
                height: 45px !important;
            }
            
            #btnWhatsApp { 
                bottom: 80px !important;
                left: 15px !important; 
            }
            
            #btnPengaduan { 
                bottom: 140px !important;
                left: 15px !important; 
            }
            
#chatbotToggle { 
                bottom: 200px !important;
                left: 15px !important; 
            }
            
            #backToTop {
                bottom: 80px !important;
                right: 15px !important; 
            }
            
            /* Chatbot Mobile - Full width */
            #advanced-chatbot {
                bottom: 10px !important;
                left: 10px !important;
                right: 10px !important;
                width: auto !important;
                height: calc(100vh - 100px) !important;
                max-height: none !important;
                min-height: 400px !important;
            }
            
            /* Overlay Panel Mobile */
            #overlay-panel {
                bottom: auto !important;
                top: 100px !important;
                left: 10px !important;
                right: 10px !important;
    </style>
</head>

    @yield('outmain')

    <main id="main">
        @yield('body')
    </main><!-- End #main -->

    <!-- ========== FLOATING BUTTONS ========== -->
    
    <!-- WhatsApp Button -->
    <a href="https://wa.me/6285589554885?text=Halo%20Admin%20Desa%20Dotte" 
       id="btnWhatsApp" 
       class="floating-btn" 
       target="_blank" 
       aria-label="WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>
    
    <!-- Pengaduan Button -->
    <a href="{{ route('pengaduan') }}" 
       id="btnPengaduan" 
       class="floating-btn" 
       aria-label="Pengaduan">
        <img src="{{ asset('assets/img/headset-solid.svg') }}" alt="Pengaduan">
    </a>
    
    <!-- Chatbot Toggle Button -->
    <button type="button" 
            id="chatbotToggle" 
            class="floating-btn" 
            style="background: linear-gradient(135deg, #6c5ce7, #a29bfe) !important; color: white !important;"
            aria-label="Chatbot">
        <i class="bi bi-chat-dots-fill"></i>
    </button>
    
    <!-- Back to Top Button -->
    <a href="#" 
       id="backToTop" 
       class="floating-btn" 
       aria-label="Kembali ke atas">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Chatbot will be initialized automatically by AdvancedChatbot class -->
    <!-- See public/assets/js/chatbot.js -->
    
<!-- Chatbot Container - DRAGGABLE -->
    <div id="advanced-chatbot" class="draggable-container" style="
        position: fixed !important;
        bottom: 30px !important;
        left: 20px !important;
        width: 400px !important;
        max-width: calc(100vw - 40px) !important;
        height: 500px !important;
        max-height: calc(100vh - 100px) !important;
        min-height: 400px !important;
        background: white !important;
        border-radius: 20px !important;
        box-shadow: 0 10px 50px rgba(0, 0, 0, 0.3) !important;
        display: none !important;
        flex-direction: column !important;
        z-index: 999999 !important;
        overflow: hidden !important;
        cursor: default !important;
        touch-action: none !important;
    ">
        <!-- Drag Handle -->
        <div id="chatbot-drag-handle" style="
            background: linear-gradient(135deg, #0dcdbd, #0aaa9a) !important;
            color: white !important;
            padding: 12px 14px !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            flex-shrink: 0 !important;
            cursor: grab !important;
            user-select: none !important;
        " onmousedown="startDrag(event, 'advanced-chatbot')" ontouchstart="startDrag(event, 'advanced-chatbot')">
            <div style="display: flex; align-items: center; gap: 8px;">
                <div style="
                    width: 32px; height: 32px;
                    background: rgba(255,255,255,0.2);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 18px;
                    flex-shrink: 0;
                ">🤖</div>
                <div>
                    <h4 style="margin: 0; font-size: 14px; font-weight: 600;">Asisten Desa Oyalo</h4>
                    <span style="font-size: 10px; opacity: 0.9;">← Geser sini untuk pindahkan</span>
                </div>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="
                    background: rgba(255,255,255,0.2);
                    padding: 4px 8px;
                    border-radius: 10px;
                    font-size: 10px;
                ">ONLINE</span>
                <button id="chatbot-close" style="
                    background: rgba(255,255,255,0.2);
                    border: none;
                    color: white;
                    font-size: 20px;
                    cursor: pointer;
                    width: 28px;
                    height: 28px;
                    border-radius: 50%;
                    line-height: 1;
                    padding: 0;
                    flex-shrink: 0;
                ">×</button>
            </div>
        </div>
        <div class="chatbot-messages" id="chatbot-messages" style="
            flex: 1 !important;
            min-height: 200px !important;
            max-height: none !important;
            padding: 12px 14px !important;
            overflow-y: auto !important;
            background: #f8f9fa !important;
            cursor: text !important;
        ">
            <div class="message bot" style="
                display: flex !important;
                margin-bottom: 10px !important;
            ">
                <div class="message-content" style="
                    max-width: 100% !important;
                    padding: 12px 14px !important;
                    background: white !important;
                    color: #2d3748 !important;
                    border-radius: 16px !important;
                    border-bottom-left-radius: 4px !important;
                    font-size: 13px !important;
                    line-height: 1.5 !important;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.05) !important;
                ">
                    Halo! 👋 Selamat datang di Website Desa Oyalo.<br><br>
                    Saya asisten virtual yang siap membantu Anda.<br><br>
                    <strong>Coba tanyakan:</strong><br>
                    • Berapa jumlah penduduk?<br>
                    • Cara membuat SKTM?<br>
                    • Program bansos apa saja?
                </div>
            </div>
        </div>
        <div class="chatbot-input-area" style="
            padding: 12px 14px !important;
            border-top: 1px solid #e2e8f0 !important;
            background: white !important;
            display: flex !important;
            gap: 8px !important;
            flex-shrink: 0 !important;
        ">
            <input type="text" id="chatbot-input" placeholder="Ketik pertanyaan Anda..." style="
                flex: 1 !important;
                padding: 10px 14px !important;
                border: 2px solid #e2e8f0 !important;
                border-radius: 20px !important;
                outline: none !important;
                font-size: 13px !important;
                background: #f8f9fa !important;
                min-width: 0 !important;
            " onfocus="this.style.borderColor='#0dcdbd'; this.style.background='white';" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8f9fa';">
            <button id="chatbot-send" style="
                width: 40px !important;
                height: 40px !important;
                background: linear-gradient(135deg, #0dcdbd, #0aaa9a) !important;
                color: white !important;
                border: none !important;
                border-radius: 50% !important;
                cursor: pointer !important;
                font-size: 18px !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                flex-shrink: 0 !important;
            ">➤</button>
</div>
    </div>

<!-- Bottom Navigation for Mobile -->
    <nav class="bottom-nav d-lg-none">
        <a href="{{ url('/') }}" class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('visimisi') }}" class="nav-item {{ Request::is('profil*') ? 'active' : '' }}">
            <i class="bi bi-info-circle"></i>
            <span>Profil</span>
        </a>
        <a href="{{ route('pelayanan') }}" class="nav-item {{ Request::is('pelayanan*') || Request::is('surat-online*') || Request::is('bansos*') ? 'active' : '' }}">
            <i class="bi bi-gear"></i>
            <span>Layanan</span>
        </a>
        <a href="{{ route('berita') }}" class="nav-item {{ Request::is('publikasi*') || Request::is('agenda') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i>
            <span>Berita</span>
        </a>
        <a href="{{ route('apbdes') }}" class="nav-item {{ Request::is('apbdes') ? 'active' : '' }}">
            <i class="bi bi-cash-stack"></i>
            <span>APBDes</span>
        </a>
        <a href="{{ route('frontend.umkm') }}" class="nav-item {{ Request::is('umkm') ? 'active' : '' }}">
            <i class="bi bi-shop"></i>
            <span>UMKM</span>
        </a>
        <a href="{{ route('frontend.aspirasi') }}" class="nav-item {{ Request::is('aspirasi') ? 'active' : '' }}">
            <i class="bi bi-chat-dots"></i>
            <span>Aspirasi</span>
        </a>
        <a href="{{ route('jenis_kelamin') }}" class="nav-item {{ Request::is('statistik*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i>
            <span>Statistik</span>
        </a>
        <a href="{{ route('peta') }}" class="nav-item {{ Request::is('peta') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i>
            <span>Peta</span>
        </a>
    </nav>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    
    <!-- Advanced Chatbot JS -->
    <script src="{{ asset('assets/js/chatbot.js') }}"></script>
    
    <script>
        // Simple direct toggle with input handling
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const toggleBtn = document.getElementById('chatbotToggle');
                const chatbotContainer = document.getElementById('advanced-chatbot');
                const closeBtn = document.getElementById('chatbot-close');
                const input = document.getElementById('chatbot-input');
                const sendBtn = document.getElementById('chatbot-send');
                
                if (toggleBtn && chatbotContainer) {
                    console.log('✅ Toggle button and container found');
                    
                    // Toggle on button click
                    toggleBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const isVisible = chatbotContainer.style.display === 'flex';
                        
                        if (isVisible) {
                            chatbotContainer.style.display = 'none';
                            toggleBtn.classList.remove('active');
                            console.log('🔒 Chatbot closed');
                        } else {
                            // Force display
                            chatbotContainer.style.cssText = `
                                display: flex !important;
                                position: fixed !important;
                                bottom: 215px !important;
                                left: 20px !important;
                                width: 380px !important;
                                height: 520px !important;
                                background: white !important;
                                border-radius: 24px !important;
                                box-shadow: 0 10px 60px rgba(0, 0, 0, 0.4) !important;
                                z-index: 9999999 !important;
                                flex-direction: column !important;
                                overflow: hidden !important;
                                visibility: visible !important;
                                opacity: 1 !important;
                                border: 4px solid #0dcdbd !important;
                            `;
                            toggleBtn.classList.add('active');
                            
                            console.log('🔓 Chatbot opened - CHECK VISUALLY!');
                            console.log('Position check:', {
                                display: chatbotContainer.style.display,
                                bottom: chatbotContainer.style.bottom,
                                left: chatbotContainer.style.left,
                                zIndex: chatbotContainer.style.zIndex
                            });
                            
                            // Visual feedback
                            setTimeout(() => {
                                alert('Chatbot seharusnya muncul sekarang!\nLihat kiri bawah layar (kotak biru dengan avatar robot)');
                            }, 100);
                        }
                    });
                    
                    // Close on close button click
                    if (closeBtn) {
                        closeBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            
                            chatbotContainer.style.display = 'none';
                            toggleBtn.classList.remove('active');
                            console.log('🔒 Chatbot closed via close button');
                        });
                    }
                    
            // Send message on Enter
                    if (input) {
                        input.addEventListener('keypress', function(e) {
                            if (e.key === 'Enter') {
                                e.preventDefault();
                                console.log('Enter pressed, sending message...');
                                if (this.value.trim()) {
                                    sendMessage(this.value.trim());
                                    this.value = '';
                                }
                            }
                        });
                    }
                    
                    // Send message on button click
                    if (sendBtn) {
                        sendBtn.addEventListener('click', function(e) {
                            e.preventDefault();
                            console.log('Send button clicked');
                            if (input && input.value.trim()) {
                                sendMessage(input.value.trim());
                                input.value = '';
                            } else {
                                console.log('Input is empty');
                            }
                        });
                    }
                    
                    console.log('✅ All handlers attached');
                } else {
                    console.log('❌ Elements not found:', { 
                        toggleBtn: !!toggleBtn, 
                        chatbotContainer: !!chatbotContainer 
                    });
                }
            }, 500);
            
// Function to send message
            function sendMessage(text) {
                console.log('Sending message:', text);
                const messagesContainer = document.getElementById('chatbot-messages');
                
                if (!messagesContainer) {
                    console.error('Messages container not found!');
                    return;
                }
                
                // Add user message
                const userMsg = document.createElement('div');
                userMsg.className = 'message user';
                userMsg.innerHTML = '<div class="message-content">' + text + '</div>';
                messagesContainer.appendChild(userMsg);
                
                // Scroll to bottom
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                
                // Get CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                
                // Send to server
                fetch('/api/chatbot/respond', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || ''
                    },
                    body: JSON.stringify({ message: text })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response data:', data);
                    
                    // Create bot message wrapper
                    const msgWrapper = document.createElement('div');
                    msgWrapper.className = 'message bot';
                    
                    // Bot response content
                    let contentHTML = '<div class="message-content">' + (data.response || 'Maaf, terjadi kesalahan.') + '</div>';
                    
                    // Add Quick Actions - SIMPLE FORMAT
                    if (data.quick_actions && data.quick_actions.length > 0) {
                        contentHTML += '<div class="chatbot-quick-actions">';
                        contentHTML += '<div class="quick-actions-label">Pilihan cepat:</div>';
                        data.quick_actions.forEach(action => {
                            contentHTML += '<button class="quick-action-btn" data-action="' + (action.action || '') + '">' + (action.label || action) + '</button>';
                        });
                        contentHTML += '</div>';
                    }
                    
                    // Add Suggestions - SIMPLE FORMAT
                    if (data.suggestions && data.suggestions.length > 0) {
                        contentHTML += '<div class="chatbot-suggestions">';
                        contentHTML += '<div class="suggestions-label">Pertanyaan terkait:</div>';
                        data.suggestions.forEach(sugg => {
                            contentHTML += '<button class="suggestion-btn">' + sugg + '</button>';
                        });
                        contentHTML += '</div>';
                    }
                    
                    msgWrapper.innerHTML = contentHTML;
                    messagesContainer.appendChild(msgWrapper);
                    
                    // Scroll to bottom
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    
                    // Attach event listeners to new buttons
                    msgWrapper.querySelectorAll('.quick-action-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const action = this.getAttribute('data-action');
                            sendMessage(action);
                        });
                    });
                    
                    msgWrapper.querySelectorAll('.suggestion-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            sendMessage(this.textContent);
                        });
                    });
                })
                .catch(error => {
                    console.error('Chatbot error:', error);
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'message bot';
                    errorMsg.innerHTML = '<div class="message-content">❌ Maaf, terjadi kesalahan. Silakan coba lagi.</div>';
                    messagesContainer.appendChild(errorMsg);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                });
            }
        });
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // ========== BACK TO TOP ==========
            const backToTop = document.getElementById('backToTop');
            
            function toggleBackToTop() {
                if (window.scrollY > 300) {
                    backToTop.classList.add('visible');
                } else {
                    backToTop.classList.remove('visible');
                }
            }
            
            window.addEventListener('scroll', toggleBackToTop);
            toggleBackToTop();
            
            backToTop.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({ 
                    top: 0, 
                    behavior: 'smooth' 
                });
            });
            
            // ========== NAVBAR DROPDOWN (Mobile) ==========
            document.querySelectorAll('.navbar .dropdown > a').forEach(el => {
                el.addEventListener('click', function(e) {
                    if (document.querySelector('.navbar').classList.contains('navbar-mobile')) {
                        e.preventDefault();
                        this.nextElementSibling.classList.toggle('dropdown-active');
                    }
                });
            });
        });
    </script>

    @yield('js')

</body>

</html>
