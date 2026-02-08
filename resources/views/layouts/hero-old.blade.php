<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-content-center align-items-center parallax-hero">

    <div class="hero-overlay"></div>

    <div class="container hero-container">
        <div class="hero-content">
            <h1 class="hero-title">
                <span class="typing-text" id="typing-text">|</span>
                <span class="cursor"></span>
            </h1>
            <h2 class="hero-title animate__animated animate__fadeInUp animate__delay-3s">Desa Dotte</h2>
            <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-2s">
                Kecamatan Weda Timur, Kabupaten Halmahera Tengah, Maluku Utara
            </p>
            <div class="hero-stats animate__animated animate__fadeInUp animate__delay-3s">
                <div class="stat-item">
                    <span class="stat-number" style="color: #ffffff;">{{ isset($total_penduduk_all) ? number_format($total_penduduk_all) : '0' }}</span>
                    <span class="stat-label" style="color: #FFFFFF">Penduduk</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" style="color: #FFFFFF">{{ isset($jumlah_kk) ? number_format($jumlah_kk) : '0' }}</span>
                    <span class="stat-label" style="color: #FFFFFF">Kepala Keluarga</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" style="color: #FFFFFF;">{{ isset($jumlah_penduduk_sementara) ? number_format($jumlah_penduduk_sementara) : '0' }}</span>
                    <span class="stat-label" style="color: #FFFFFF">Penduduk Sementara</span>
                </div>
            </div>
            <div class="hero-buttons animate__animated animate__fadeInUp animate__delay-4s">
                {{-- <a href="{{ route('visimisi') }}" class="btn-get-started scrollto">
                    <i class="bi bi-chevron-down"></i> Visi Misi
                </a> --}}
                {{-- <a href="{{ route('pelayanan') }}" class="btn-secondary">
                    <i class="bi bi-gear"></i> Layanan
                </a> --}}
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const text = "Selamat Datang Di Website";
    const typingText = document.getElementById('typing-text');
    let index = 0;

    function typeWriter() {
        if (index < text.length) {
            typingText.innerHTML += text.charAt(index);
            index++;
            setTimeout(typeWriter, 100);
        } else {
            // Start blinking cursor after typing is done
            document.querySelector('.cursor').style.animation = 'blink 1s infinite';
        }
    }

    // Start typing animation after a short delay
    setTimeout(typeWriter, 1000);
});
</script>
