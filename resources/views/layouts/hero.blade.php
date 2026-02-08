
<style>
    /* ===== HERO CAROUSEL - MODERN STYLE ===== */
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap');

#hero {
  width: 100%;
  height: 90vh;
  min-height: 600px;
  overflow: hidden;
  position: relative;
}

#heroCarousel {
  width: 100%;
  height: 100%;
}

.carousel-item {
  height: 90vh;
  min-height: 600px;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  position: relative;
}

/* Overlay gradient modern */
.carousel-item::before {
  content: "";
  position: absolute;
  inset: 0;
  background: linear-gradient(
    135deg,
    hsla(207, 90%, 30%, 0.75),
    hsla(195, 60%, 25%, 0.65)
  );
  z-index: 1;
}

/* Content wrapper */
.carousel-container {
  position: absolute;
  inset: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  text-align: center;
  z-index: 2;
  padding: 0 20px;
}

.hero-content {
  max-width: 850px;
  margin: 0 auto;
  opacity: 0;
  transform: translateY(30px);
  transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.carousel-item.active .hero-content {
  opacity: 1;
  transform: translateY(0);
}

/* Typography */
.hero-title-main {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 3.5rem;
  font-weight: 700;
  color: #fff;
  letter-spacing: -0.02em;
  line-height: 1.1;
  text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
  margin-bottom: 0.25rem;
}

.hero-title-sub {
  font-family: 'Space Grotesk', sans-serif;
  font-size: 2.5rem;
  font-weight: 700;
  color: #fff;
  text-shadow: 0 2px 15px rgba(0, 0, 0, 0.25);
  margin-top: 0.5rem;
}

.hero-subtitle {
  font-family: 'Plus Jakarta Sans', sans-serif;
  font-size: 1.1rem;
  color: rgba(255, 255, 255, 0.9);
  max-width: 600px;
  margin: 1rem auto 0;
  line-height: 1.7;
}

/* Typing cursor */
.typing-cursor {
  display: inline-block;
  width: 3px;
  height: 1em;
  background: #fff;
  margin-left: 4px;
  vertical-align: text-bottom;
  animation: cursorBlink 1s step-end infinite;
}

@keyframes cursorBlink {
  0%, 50% { opacity: 1; }
  51%, 100% { opacity: 0; }
}

/* Glass stat cards */
.hero-stats {
  display: flex;
  justify-content: center;
  gap: 1.5rem;
  margin-top: 2.5rem;
  flex-wrap: wrap;
}

.stat-card {
  text-align: center;
  padding: 1.25rem 1.5rem;
  background: rgba(255, 255, 255, 0.12);
  border-radius: 1rem;
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  min-width: 160px;
  transition: all 0.3s ease;
}

.stat-card:hover {
  background: rgba(255, 255, 255, 0.18);
  transform: translateY(-4px);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.stat-number {
  font-family: 'Space Grotesk', sans-serif;
  display: block;
  font-size: 2.25rem;
  font-weight: 700;
  color: #fff;
  line-height: 1;
  margin-bottom: 0.5rem;
  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.stat-label {
  font-family: 'Plus Jakarta Sans', sans-serif;
  display: block;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 2px;
  color: rgba(255, 255, 255, 0.85);
}

/* Hero buttons */
.hero-buttons {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-top: 2.5rem;
  flex-wrap: wrap;
}

.btn-hero-primary {
  font-family: 'Plus Jakarta Sans', sans-serif;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.875rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  font-size: 1rem;
  background: #fff;
  /* color: hsl(207, 90%, 54%); */
  border: none;
  text-decoration: none;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease;
}

.btn-hero-primary:hover {
  /* background: hsl(207, 90%, 54%); */
  color: #fff;
  transform: translateY(-3px);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
}

.btn-hero-secondary {
  font-family: 'Plus Jakarta Sans', sans-serif;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.875rem 2rem;
  border-radius: 50px;
  font-weight: 600;
  font-size: 1rem;
  background: rgba(255, 255, 255, 0.1);
  color: #fff;
  border: 2px solid rgba(255, 255, 255, 0.4);
  text-decoration: none;
  backdrop-filter: blur(8px);
  transition: all 0.3s ease;
}

.btn-hero-secondary:hover {
  background: #fff;
  color: hsl(207, 90%, 54%);
  border-color: #fff;
  transform: translateY(-3px);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
}

/* Carousel controls */
.carousel-control-prev,
.carousel-control-next {
  width: 48px;
  height: 48px;
  top: 50%;
  transform: translateY(-50%);
  z-index: 5;
  opacity: 0.8;
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(8px);
  border-radius: 50%;
  border: 1px solid rgba(255, 255, 255, 0.25);
  transition: all 0.3s ease;
}

.carousel-control-prev { left: 1.5rem; }
.carousel-control-next { right: 1.5rem; }

.carousel-control-prev:hover,
.carousel-control-next:hover {
  opacity: 1;
  background: rgba(255, 255, 255, 0.25);
  transform: translateY(-50%) scale(1.1);
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
  width: 20px;
  height: 20px;
}

/* Carousel indicators */
.carousel-indicators {
  z-index: 5;
  bottom: 2rem;
  gap: 0.75rem;
}

.carousel-indicators button {
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: 2px solid rgba(255, 255, 255, 0.5);
  background: rgba(255, 255, 255, 0.4);
  opacity: 1;
  transition: all 0.3s ease;
  padding: 0;
}

.carousel-indicators button.active {
  background: #fff;
  border-color: #fff;
  transform: scale(1.25);
  box-shadow: 0 0 12px rgba(255, 255, 255, 0.5);
}

/* Progress bar */
.slide-progress-bar {
  position: absolute;
  bottom: 0;
  left: 0;
  height: 4px;
  width: 0%;
  z-index: 10;
  background: linear-gradient(90deg, hsl(157, 90%, 54%), hsl(170, 60%, 45%));
  transition: width 0.1s linear;
}

/* Stagger animations */
.carousel-item.active .hero-title-main { transition-delay: 0.2s; }
.carousel-item.active .hero-title-sub { transition-delay: 0.4s; }
.carousel-item.active .hero-subtitle { transition-delay: 0.5s; }
.carousel-item.active .hero-stats { transition-delay: 0.7s; }
.carousel-item.active .hero-buttons { transition-delay: 0.8s; }

.hero-title-main, .hero-title-sub, .hero-subtitle, .hero-stats, .hero-buttons {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}

.carousel-item.active .hero-title-main,
.carousel-item.active .hero-title-sub,
.carousel-item.active .hero-subtitle,
.carousel-item.active .hero-stats,
.carousel-item.active .hero-buttons {
  opacity: 1;
  transform: translateY(0);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
  #hero, .carousel-item { height: 85vh; min-height: 550px; }
  .hero-title-main { font-size: 2.75rem; }
  .hero-title-sub { font-size: 2rem; }
  .stat-card { min-width: 140px; padding: 1rem 1.25rem; }
  .stat-number { font-size: 1.75rem; }
}

@media (max-width: 768px) {
  #hero, .carousel-item { height: 80vh; min-height: 500px; }
  .hero-title-main { font-size: 2rem; }
  .hero-title-sub { font-size: 1.5rem; }
  .hero-subtitle { font-size: 0.95rem; }
  .hero-stats { gap: 1rem; }
  .stat-card { min-width: 110px; padding: 0.875rem 1rem; }
  .stat-number { font-size: 1.5rem; }
  .stat-label { font-size: 0.65rem; }
  .carousel-control-prev, .carousel-control-next { width: 40px; height: 40px; }
  .hero-buttons { flex-direction: column; align-items: center; }
  .btn-hero-primary, .btn-hero-secondary { width: 100%; max-width: 280px; justify-content: center; }
}

@media (max-width: 576px) {
  #hero, .carousel-item { height: 75vh; min-height: 450px; }
  .hero-title-main { font-size: 1.75rem; }
  .hero-title-sub { font-size: 1.25rem; }
  .hero-stats { flex-direction: column; align-items: center; }
  .stat-card { width: 80%; max-width: 240px; }
}

</style>
<section id="hero">
  <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
    
    <!-- Indicators -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
      
      <!-- Slide 1 -->
      <div class="carousel-item active" style="background-image: url('{{ asset('assets/img/bg3.jpg') }}');">
        <div class="carousel-container">
          <div class="hero-content">
            <h1 class="hero-title-main">
              <span id="typingText"></span><span class="typing-cursor"></span>
            </h1>
            <h2 class="hero-title-sub">Desa Dotte</h2>
            <p class="hero-subtitle">Kecamatan Weda Timur, Kabupaten Halmahera Tengah, Maluku Utara</p>
            <div class="hero-stats">
              <div class="stat-card">
                <span class="stat-number" data-target="{{ $total_penduduk_all ?? 1250 }}">0</span>
                <span class="stat-label">Penduduk</span>
              </div>
              <div class="stat-card">
                <span class="stat-number" data-target="{{ $jumlah_kk ?? 320 }}">0</span>
                <span class="stat-label">Kepala Keluarga</span>
              </div>
              <div class="stat-card">
                <span class="stat-number" data-target="{{ $jumlah_penduduk_sementara ?? 45 }}">0</span>
                <span class="stat-label">Penduduk Sementara</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item" style="background-image: url('{{ asset('assets/img/banner123.png') }}');">
        <div class="carousel-container">
          <div class="hero-content">
            <h1 class="hero-title-main">Keindahan Alam & Budaya</h1>
            <p class="hero-subtitle">Menyajikan pesona alam yang memukau dengan keasrian lingkungan dan kekayaan budaya lokal</p>
            <div class="hero-buttons">
              <a href="{{ route('galeri') }}" class="btn-hero-primary">
                <i class="bi bi-images"></i> Lihat Galeri
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item" style="background-image: url('{{ asset('assets/img/bg1.jpg') }}');">
        <div class="carousel-container">
          <div class="hero-content">
            <h1 class="hero-title-main">Pelayanan Masyarakat</h1>
            <p class="hero-subtitle">Memberikan pelayanan terbaik untuk kesejahteraan masyarakat Desa Dotte</p>
            <div class="hero-buttons">
              <a href="{{ route('pelayanan') }}" class="btn-hero-primary">
                <i class="bi bi-gear"></i> Layanan Publik
              </a>
              <a href="#kontak" class="btn-hero-secondary">
                <i class="bi bi-telephone"></i> Hubungi Kami
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

    <!-- Progress bar -->
    <div class="slide-progress-bar" id="slideProgress"></div>
  </div>
</section>

<script>
    // Initialize carousel

document.addEventListener('DOMContentLoaded', function () {
  const heroCarousel = document.getElementById('heroCarousel');
  if (!heroCarousel) return;

  const carousel = new bootstrap.Carousel(heroCarousel, {
    interval: 6000, wrap: true, touch: true, pause: 'hover'
  });

  // === TYPING EFFECT ===
  const fullText = 'Selamat Datang Di Website';
  const typingEl = document.getElementById('typingText');
  let charIndex = 0;

  function typeWriter() {
    if (!typingEl) return;
    if (charIndex <= fullText.length) {
      typingEl.textContent = fullText.slice(0, charIndex);
      charIndex++;
      setTimeout(typeWriter, 80);
    }
  }

  function resetTyping() {
    charIndex = 0;
    if (typingEl) typingEl.textContent = '';
    setTimeout(typeWriter, 600);
  }

  setTimeout(typeWriter, 600);

  // === COUNT UP ANIMATION ===
  function animateCountUp(el) {
    const target = parseInt(el.getAttribute('data-target')) || 0;
    const duration = 2000;
    const startTime = performance.now();

    function update(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
      el.textContent = Math.floor(eased * target).toLocaleString('id-ID');

      if (progress < 1) {
        requestAnimationFrame(update);
      } else {
        el.textContent = target.toLocaleString('id-ID');
      }
    }

    requestAnimationFrame(update);
  }

  // Start count-up on first slide
  document.querySelectorAll('.carousel-item.active .stat-number[data-target]').forEach(animateCountUp);

  // === PROGRESS BAR ===
  const progressBar = document.getElementById('slideProgress');
  const INTERVAL = 6000;
  let progressStart;

  function startProgress() {
    progressStart = Date.now();
    if (progressBar) progressBar.style.width = '0%';
  }

  function updateProgress() {
    if (!progressBar) return;
    const elapsed = Date.now() - progressStart;
    const pct = Math.min((elapsed / INTERVAL) * 100, 100);
    progressBar.style.width = pct + '%';
    if (pct < 100) requestAnimationFrame(updateProgress);
  }

  startProgress();
  requestAnimationFrame(updateProgress);

  // === SLIDE EVENTS ===
  heroCarousel.addEventListener('slide.bs.carousel', function (e) {
    startProgress();
    requestAnimationFrame(updateProgress);

    // Reset typing on slide 1
    if (e.to === 0) resetTyping();
  });

  heroCarousel.addEventListener('slid.bs.carousel', function () {
    // Re-run count-up on active slide
    document.querySelectorAll('.carousel-item.active .stat-number[data-target]').forEach(animateCountUp);
  });

  // === KEYBOARD NAV ===
  document.addEventListener('keydown', function (e) {
    if (e.key === 'ArrowLeft') carousel.prev();
    if (e.key === 'ArrowRight') carousel.next();
  });
});
</script>

