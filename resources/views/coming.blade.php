@extends('layouts.main', ['title' => 'Coming Soon'])

@section('body')
@section('outmain')
    @include('layouts.header')
    @include('layouts.page-hero', [
        'title' => 'Coming Soon',
        'subtitle' => 'Kami sedang mempersiapkan sesuatu yang luar biasa untuk Anda',
        'breadcrumb' => 'Coming Soon',
        'showBreadcrumb' => true
    ])
@endsection

<style>
    .coming-soon-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .countdown-container {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin: 3rem 0;
        flex-wrap: wrap;
    }

    .countdown-item {
        background: white;
        border-radius: 10px;
        padding: 2rem 2.5rem;
        min-width: 120px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .countdown-item:hover {
        transform: translateY(-5px);
    }

    .countdown-number {
        font-size: 3rem;
        font-weight: 700;
        display: block;
        margin-bottom: 0.5rem;
        color: #47b2e4;
    }

    .countdown-label {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #6c757d;
    }

    .notify-box {
        background: white;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 2rem auto;
    }

    .notify-form {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .notify-form input {
        flex: 1;
        padding: 12px 20px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 1rem;
        outline: none;
    }

    .notify-form input:focus {
        border-color: #47b2e4;
    }

    .notify-form button {
        padding: 12px 30px;
        background: #47b2e4;
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .notify-form button:hover {
        background: #3a9dd1;
    }

    .social-links {
        margin-top: 2rem;
        text-align: center;
    }

    .social-links a {
        color: #47b2e4;
        font-size: 1.5rem;
        margin: 0 15px;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .social-links a:hover {
        color: #3a9dd1;
        transform: translateY(-3px);
    }

    .coming-soon-description {
        text-align: center;
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
        .countdown-item {
            padding: 1.5rem 2rem;
            min-width: 100px;
        }

        .countdown-number {
            font-size: 2rem;
        }

        .notify-form {
            flex-direction: column;
        }
    }
</style>

<section class="coming-soon-section">
    <div class="container" data-aos="fade-up">
        
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body text-center py-5">
                <div class="card-title mb-4">
                    <h2>🚀 Sedang Dalam Pengembangan</h2>
                    <p class="coming-soon-description">
                        Kami sedang bekerja keras untuk menghadirkan fitur dan layanan terbaik untuk masyarakat Desa Kotalo. 
                        Pantau terus countdown di bawah ini!
                    </p>
                </div>

                <div class="countdown-container">
                    <div class="countdown-item">
                        <span class="countdown-number" id="days">00</span>
                        <span class="countdown-label">Hari</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="hours">00</span>
                        <span class="countdown-label">Jam</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="minutes">00</span>
                        <span class="countdown-label">Menit</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="seconds">00</span>
                        <span class="countdown-label">Detik</span>
                    </div>
                </div>

                <div class="notify-box">
                    <h5>Ingin Mendapat Notifikasi?</h5>
                    <p class="text-muted mb-3">Daftarkan email Anda dan kami akan memberitahu ketika website sudah diluncurkan</p>
                    
                  

                    <div class="social-links">
                        <a href="#" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#" title="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <div class="mt-4">
                    <small class="text-muted">
                        <i class="bi bi-info-circle"></i> 
                        Jika ada pertanyaan, silakan hubungi kami melalui kontak yang tersedia
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')

<script>
    // Set tanggal target countdown (ubah sesuai kebutuhan)
    const countdownDate = new Date("Feb 1, 2026 00:00:00").getTime();

    const countdownFunction = setInterval(function() {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerHTML = String(days).padStart(2, '0');
        document.getElementById("hours").innerHTML = String(hours).padStart(2, '0');
        document.getElementById("minutes").innerHTML = String(minutes).padStart(2, '0');
        document.getElementById("seconds").innerHTML = String(seconds).padStart(2, '0');

        if (distance < 0) {
            clearInterval(countdownFunction);
            document.querySelector(".countdown-container").innerHTML = 
                '<div class="alert alert-success"><h4>🎉 Website Sudah Diluncurkan!</h4></div>';
        }
    }, 1000);
</script>

@endsection