<footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
    <div class="footer-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <div class="div-img-footer">
                        <img class="img-fluid img-footer" src="{{ asset('assets/img/logoMorotai.png') }}" alt="Logo Desa Dotte">
                    </div>
                </div>
                
                <div class="col-lg-9 col-md-8">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 footer-links">
                            <h4>Menu</h4>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('pelayanan') }}"><i class="bx bx-chevron-right"></i> Pelayanan</a></li>
                                <li><a href="{{ route('berita') }}"><i class="bx bx-chevron-right"></i> Berita</a></li>
                                <li><a href="{{ route('visimisi') }}"><i class="bx bx-chevron-right"></i> Visi Misi</a></li>
                            </ul>
                        </div>

                        <div class="col-md-4 col-sm-6 footer-links">
                            <h4>&nbsp;</h4>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('sejarah') }}"><i class="bx bx-chevron-right"></i> Sejarah</a></li>
                                <li><a href="{{ route('pengaduan') }}"><i class="bx bx-chevron-right"></i> Pengaduan</a></li>
                            </ul>
                        </div>

                        <div class="col-md-4 footer-contact">
                            <h4>Kontak</h4>
                            <address>
                                Desa Dotte<br>
                                Kec. Weda Timur<br>
                                Kab. Halmahera Tengah<br>
                                Maluku Utara<br>
                                <abbr title="Phone"><strong>Telp:</strong></abbr> +1 5589 55488 55
                            </address>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-12 footer-info">
                            <h5>Fungsi Website Desa</h5>
                            <p class="mb-2">Sarana akuntabilitas, transparansi publik, dan promosi potensi desa.</p>
                            <div class="social-links">
                                <a href="#!" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#!" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#!" class="instagram"><i class="bx bxl-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright text-center py-3">
            &copy; Copyright <strong><span>Desa Dotte</span></strong> {{ date('Y') }}. All Rights Reserved
        </div>
    </div>
</footer>