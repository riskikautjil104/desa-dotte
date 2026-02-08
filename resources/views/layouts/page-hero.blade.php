{{-- Page Hero Section - Premium Modern Design --}}
{{-- Usage: @include('layouts.page-hero', ['title' => 'Judul Halaman', 'breadcrumb' => 'Breadcrumb']) --}}

<section id="page-hero" class="page-hero">
   <!-- Geometric Pattern Background -->
   <div class="hero-pattern">
       <div class="pattern-grid"></div>
       <div class="floating-elements">
           <span class="float-element el-1"></span>
           <span class="float-element el-2"></span>
           <span class="float-element el-3"></span>
           <span class="float-element el-4"></span>
           <span class="float-element el-5"></span>
       </div>
   </div>

   <!-- Gradient Overlay -->
   <div class="hero-overlay"></div>

   <div class="container position-relative hero-container" data-aos="fade-up" data-aos-delay="100">
       <div class="row">
           <div class="col-lg-11 col-xl-10 mx-auto">
               
               <!-- Modern Breadcrumb -->
               @if(isset($breadcrumb) || isset($showBreadcrumb))
               <nav aria-label="breadcrumb" class="hero-breadcrumb">
                   <ol class="breadcrumb modern-breadcrumb">
                       <li class="breadcrumb-item">
                           <a href="{{ route('home') }}" class="breadcrumb-link">
                               <i class="bi bi-house-door-fill"></i>
                               <span>Beranda</span>
                           </a>
                       </li>
                       @if(isset($breadcrumbParent))
                       <li class="breadcrumb-item">
                           <a href="{{ $breadcrumbParentUrl ?? '#' }}" class="breadcrumb-link">
                               {{ $breadcrumbParent }}
                           </a>
                       </li>
                       @endif
                       <li class="breadcrumb-item active" aria-current="page">
                           {{ $breadcrumb ?? $title }}
                       </li>
                   </ol>
               </nav>
               @endif

               <!-- Hero Content with Split Design -->
               <div class="hero-content-wrapper">
                   <div class="row align-items-center">
                       <div class="col-lg-8">
                           <div class="hero-text-content">
                               <!-- Title with Accent -->
                               <div class="title-section">
                                   <div class="title-accent"></div>
                                   <h1 class="hero-main-title">
                                       {{ $title ?? 'Halaman' }}
                                   </h1>
                               </div>
                               
                               @if(isset($subtitle))
                               <div class="subtitle-wrapper">
                                   <p class="hero-main-subtitle">
                                       {{ $subtitle }}
                                   </p>
                               </div>
                               @endif
                           </div>
                       </div>
                       
                       <!-- Decorative Graphic Element -->
                       <div class="col-lg-4 d-none d-lg-block">
                           <div class="hero-graphic">
                               <div class="graphic-circle circle-1"></div>
                               <div class="graphic-circle circle-2"></div>
                               <div class="graphic-circle circle-3"></div>
                               <div class="graphic-dots">
                                   <span></span><span></span><span></span>
                                   <span></span><span></span><span></span>
                                   <span></span><span></span><span></span>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>

           </div>
       </div>
   </div>
   
   <!-- Smooth Multi-Layer Wave -->
   <div class="hero-wave-container">
       <svg class="wave-layer wave-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
           <path fill="rgba(255, 255, 255, 0.2)" d="M0,60 C240,100 480,100 720,60 C960,20 1200,20 1440,60 L1440,120 L0,120 Z">
               <animate attributeName="d" dur="8s" repeatCount="indefinite"
                   values="M0,60 C240,100 480,100 720,60 C960,20 1200,20 1440,60 L1440,120 L0,120 Z;
                           M0,40 C240,80 480,80 720,40 C960,0 1200,0 1440,40 L1440,120 L0,120 Z;
                           M0,60 C240,100 480,100 720,60 C960,20 1200,20 1440,60 L1440,120 L0,120 Z" />
           </path>
       </svg>
       
       <svg class="wave-layer wave-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
           <path fill="rgba(255, 255, 255, 0.4)" d="M0,80 C360,40 720,40 1080,80 C1260,100 1440,100 1440,80 L1440,120 L0,120 Z">
               <animate attributeName="d" dur="10s" repeatCount="indefinite"
                   values="M0,80 C360,40 720,40 1080,80 C1260,100 1440,100 1440,80 L1440,120 L0,120 Z;
                           M0,60 C360,20 720,20 1080,60 C1260,80 1440,80 1440,60 L1440,120 L0,120 Z;
                           M0,80 C360,40 720,40 1080,80 C1260,100 1440,100 1440,80 L1440,120 L0,120 Z" />
           </path>
       </svg>
       
       <svg class="wave-layer wave-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
           <path fill="rgba(255, 255, 255, 0.6)" d="M0,50 C320,90 640,90 960,50 C1200,20 1440,20 1440,50 L1440,120 L0,120 Z">
               <animate attributeName="d" dur="12s" repeatCount="indefinite"
                   values="M0,50 C320,90 640,90 960,50 C1200,20 1440,20 1440,50 L1440,120 L0,120 Z;
                           M0,70 C320,110 640,110 960,70 C1200,40 1440,40 1440,70 L1440,120 L0,120 Z;
                           M0,50 C320,90 640,90 960,50 C1200,20 1440,20 1440,50 L1440,120 L0,120 Z" />
           </path>
       </svg>
       
       <svg class="wave-layer wave-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
           <path fill="#ffffff" d="M0,70 C480,30 960,30 1440,70 L1440,120 L0,120 Z">
               <animate attributeName="d" dur="15s" repeatCount="indefinite"
                   values="M0,70 C480,30 960,30 1440,70 L1440,120 L0,120 Z;
                           M0,50 C480,10 960,10 1440,50 L1440,120 L0,120 Z;
                           M0,70 C480,30 960,30 1440,70 L1440,120 L0,120 Z" />
           </path>
       </svg>
   </div>
</section>

<style>
/* ===================================
   PREMIUM PAGE HERO - MODERN DESIGN
   =================================== */

/* Main Hero Section */
#page-hero {
   width: 100%;
   min-height: 500px;
   background: linear-gradient(135deg, #08a693 0%, #0dcdbd 45%, #12e0d0 100%);
   position: relative;
   padding: 140px 0 120px;
   overflow: hidden;
}

/* Gradient Overlay for Depth */
.hero-overlay {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
               radial-gradient(circle at 80% 80%, rgba(13, 205, 189, 0.3) 0%, transparent 50%);
   z-index: 1;
}

/* Geometric Pattern Background */
.hero-pattern {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   z-index: 0;
}

.pattern-grid {
   position: absolute;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   background-image: 
       linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
       linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
   background-size: 50px 50px;
   animation: gridSlide 20s linear infinite;
}

@keyframes gridSlide {
   0% {
       transform: translate(0, 0);
   }
   100% {
       transform: translate(50px, 50px);
   }
}

/* Floating Elements */
.floating-elements {
   position: absolute;
   width: 100%;
   height: 100%;
   top: 0;
   left: 0;
}

.float-element {
   position: absolute;
   background: rgba(255, 255, 255, 0.1);
   border-radius: 50%;
   backdrop-filter: blur(2px);
}

.el-1 {
   width: 120px;
   height: 120px;
   top: 10%;
   right: 15%;
   animation: floatDiagonal 15s ease-in-out infinite;
}

.el-2 {
   width: 80px;
   height: 80px;
   top: 60%;
   left: 10%;
   animation: floatVertical 12s ease-in-out infinite 2s;
}

.el-3 {
   width: 60px;
   height: 60px;
   top: 30%;
   left: 20%;
   animation: floatHorizontal 18s ease-in-out infinite 1s;
}

.el-4 {
   width: 100px;
   height: 100px;
   bottom: 20%;
   right: 25%;
   animation: floatCircle 20s ease-in-out infinite 3s;
}

.el-5 {
   width: 140px;
   height: 140px;
   top: 50%;
   right: 5%;
   animation: floatDiagonal 16s ease-in-out infinite 1.5s;
}

@keyframes floatVertical {
   0%, 100% { transform: translateY(0) scale(1); }
   50% { transform: translateY(-40px) scale(1.1); }
}

@keyframes floatHorizontal {
   0%, 100% { transform: translateX(0) scale(1); }
   50% { transform: translateX(30px) scale(0.9); }
}

@keyframes floatDiagonal {
   0%, 100% { transform: translate(0, 0) rotate(0deg); }
   50% { transform: translate(-30px, -30px) rotate(180deg); }
}

@keyframes floatCircle {
   0%, 100% { transform: translate(0, 0); }
   25% { transform: translate(20px, -20px); }
   50% { transform: translate(0, -40px); }
   75% { transform: translate(-20px, -20px); }
}

/* Container */
.hero-container {
   z-index: 2;
}

/* Modern Breadcrumb */
.hero-breadcrumb {
   margin-bottom: 35px;
   animation: slideDown 0.7s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.modern-breadcrumb {
   background: rgba(255, 255, 255, 0.15);
   backdrop-filter: blur(20px);
   padding: 14px 28px;
   border-radius: 60px;
   margin: 0;
   display: inline-flex;
   align-items: center;
   border: 2px solid rgba(255, 255, 255, 0.25);
   box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
}

.modern-breadcrumb .breadcrumb-item {
   display: flex;
   align-items: center;
   gap: 8px;
   font-weight: 600;
   font-size: 0.95rem;
}

.modern-breadcrumb .breadcrumb-item + .breadcrumb-item::before {
   content: "›";
   color: rgba(255, 255, 255, 0.6);
   font-size: 1.3rem;
   font-weight: 400;
   padding: 0 10px;
}

.breadcrumb-link {
   color: rgba(255, 255, 255, 0.95);
   text-decoration: none;
   display: flex;
   align-items: center;
   gap: 6px;
   transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
   padding: 4px 8px;
   border-radius: 20px;
}

.breadcrumb-link:hover {
   color: #fff;
   background: rgba(255, 255, 255, 0.15);
   transform: translateY(-2px);
}

.breadcrumb-link i {
   font-size: 1rem;
}

.modern-breadcrumb .breadcrumb-item.active {
   color: #fff;
   font-weight: 700;
}

/* Hero Content */
.hero-content-wrapper {
   margin-top: 20px;
}

.hero-text-content {
   animation: slideUp 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) 0.2s both;
}

/* Title Section */
.title-section {
   position: relative;
   margin-bottom: 25px;
}

.title-accent {
   width: 80px;
   height: 6px;
   background: linear-gradient(90deg, #fff 0%, rgba(255, 255, 255, 0.5) 100%);
   border-radius: 10px;
   margin-bottom: 20px;
   box-shadow: 0 0 20px rgba(255, 255, 255, 0.4);
   animation: slideRight 0.8s ease-out 0.3s both;
}

.hero-main-title {
   font-size: 4rem;
   font-weight: 900;
   color: #fff;
   line-height: 1.1;
   margin: 0;
   letter-spacing: -2px;
   text-shadow: 
       0 2px 10px rgba(0, 0, 0, 0.15),
       0 5px 25px rgba(0, 0, 0, 0.1);
   position: relative;
   display: inline-block;
}

.hero-main-title::after {
   content: '';
   position: absolute;
   bottom: -10px;
   left: 0;
   width: 0;
   height: 4px;
   background: rgba(255, 255, 255, 0.4);
   border-radius: 2px;
   animation: underlineExpand 1.2s ease-out 0.5s forwards;
}

@keyframes underlineExpand {
   to { width: 50%; }
}

/* Subtitle */
.subtitle-wrapper {
   margin-top: 25px;
   animation: fadeInUp 0.8s ease-out 0.6s both;
}

.hero-main-subtitle {
   font-size: 1.35rem;
   color: rgba(255, 255, 255, 0.95);
   font-weight: 400;
   line-height: 1.7;
   max-width: 650px;
   margin: 0;
   text-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
}

/* Decorative Graphic */
.hero-graphic {
   position: relative;
   height: 300px;
   animation: fadeIn 1s ease-out 0.8s both;
}

.graphic-circle {
   position: absolute;
   border: 3px solid rgba(255, 255, 255, 0.2);
   border-radius: 50%;
   animation: pulse 3s ease-in-out infinite;
}

.circle-1 {
   width: 200px;
   height: 200px;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   animation-delay: 0s;
}

.circle-2 {
   width: 150px;
   height: 150px;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   border-width: 4px;
   border-color: rgba(255, 255, 255, 0.3);
   animation-delay: 0.5s;
}

.circle-3 {
   width: 100px;
   height: 100px;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   border-width: 5px;
   border-color: rgba(255, 255, 255, 0.4);
   animation-delay: 1s;
}

.graphic-dots {
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   display: grid;
   grid-template-columns: repeat(3, 1fr);
   gap: 15px;
}

.graphic-dots span {
   width: 12px;
   height: 12px;
   background: rgba(255, 255, 255, 0.6);
   border-radius: 50%;
   animation: dotPulse 2s ease-in-out infinite;
}

.graphic-dots span:nth-child(1) { animation-delay: 0s; }
.graphic-dots span:nth-child(2) { animation-delay: 0.2s; }
.graphic-dots span:nth-child(3) { animation-delay: 0.4s; }
.graphic-dots span:nth-child(4) { animation-delay: 0.6s; }
.graphic-dots span:nth-child(5) { animation-delay: 0.8s; }
.graphic-dots span:nth-child(6) { animation-delay: 1s; }
.graphic-dots span:nth-child(7) { animation-delay: 1.2s; }
.graphic-dots span:nth-child(8) { animation-delay: 1.4s; }
.graphic-dots span:nth-child(9) { animation-delay: 1.6s; }

@keyframes pulse {
   0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
   50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.8; }
}

@keyframes dotPulse {
   0%, 100% { transform: scale(1); opacity: 0.5; }
   50% { transform: scale(1.3); opacity: 1; }
}

/* Wave Container */
.hero-wave-container {
   position: absolute;
   bottom: 0;
   left: 0;
   width: 100%;
   height: 150px;
   overflow: hidden;
   line-height: 0;
   z-index: 2;
}

.wave-layer {
   position: absolute;
   bottom: 0;
   left: 0;
   width: 100%;
   height: 100%;
   opacity: 1;
}

.wave-1 {
   z-index: 4;
   opacity: 0.8;
}

.wave-2 {
   z-index: 3;
   opacity: 0.9;
}

.wave-3 {
   z-index: 2;
   opacity: 0.95;
}

.wave-4 {
   z-index: 1;
   opacity: 1;
}

/* Keyframe Animations */
@keyframes slideDown {
   from {
       opacity: 0;
       transform: translateY(-60px);
   }
   to {
       opacity: 1;
       transform: translateY(0);
   }
}

@keyframes slideUp {
   from {
       opacity: 0;
       transform: translateY(60px);
   }
   to {
       opacity: 1;
       transform: translateY(0);
   }
}

@keyframes slideRight {
   from {
       opacity: 0;
       width: 0;
   }
   to {
       opacity: 1;
       width: 80px;
   }
}

@keyframes fadeIn {
   from { opacity: 0; }
   to { opacity: 1; }
}

@keyframes fadeInUp {
   from {
       opacity: 0;
       transform: translateY(30px);
   }
   to {
       opacity: 1;
       transform: translateY(0);
   }
}

/* Alternative Themes */
#page-hero.theme-ocean {
   background: linear-gradient(135deg, #069688 0%, #0dcdbd 50%, #26d0c0 100%);
}

#page-hero.theme-deep {
   background: linear-gradient(135deg, #047a70 0%, #0ba39a 40%, #0dcdbd 80%, #1fd9c9 100%);
}

#page-hero.theme-sky {
   background: linear-gradient(-45deg, #0dcdbd 0%, #0ba39a 35%, #0dcdbd 70%, #1ae0cf 100%);
}

/* Responsive Design */
@media (max-width: 1199px) {
   .hero-main-title {
       font-size: 3.5rem;
   }
   
   .hero-main-subtitle {
       font-size: 1.2rem;
   }
}

@media (max-width: 991px) {
   #page-hero {
       min-height: 420px;
       padding: 120px 0 100px;
   }
   
   .hero-main-title {
       font-size: 3rem;
       letter-spacing: -1.5px;
   }
   
   .hero-main-subtitle {
       font-size: 1.15rem;
   }
   
   .title-accent {
       width: 60px;
       height: 5px;
   }
}

@media (max-width: 768px) {
   #page-hero {
       min-height: 380px;
       padding: 100px 0 80px;
   }
   
   .hero-main-title {
       font-size: 2.5rem;
       letter-spacing: -1px;
   }
   
   .hero-main-subtitle {
       font-size: 1.05rem;
   }
   
   .modern-breadcrumb {
       padding: 12px 20px;
       font-size: 0.9rem;
   }
   
   .hero-wave-container {
       height: 100px;
   }
   
   .el-1, .el-2, .el-3, .el-4, .el-5 {
       width: 60px;
       height: 60px;
   }
}

@media (max-width: 576px) {
   #page-hero {
       min-height: 340px;
       padding: 90px 0 70px;
   }
   
   .hero-main-title {
       font-size: 2rem;
       letter-spacing: -0.5px;
   }
   
   .hero-main-subtitle {
       font-size: 1rem;
   }
   
   .title-accent {
       width: 50px;
       height: 4px;
   }
   
   .modern-breadcrumb {
       padding: 10px 16px;
       font-size: 0.85rem;
   }
   
   .breadcrumb-link i {
       font-size: 0.9rem;
   }
   
   .hero-wave-container {
       height: 80px;
   }
}

/* High Performance Mode */
@media (prefers-reduced-motion: reduce) {
   *,
   *::before,
   *::after {
       animation-duration: 0.01ms !important;
       animation-iteration-count: 1 !important;
       transition-duration: 0.01ms !important;
   }
}
</style>