<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Laboratorium Sistem Informasi UNIB</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/favicon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 class="sitename">Laboratorium Sistem Informasi UNIB</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#hero" class="active">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


        @if (Route::has('login'))
            <div class="d-flex align-items-center gap-3">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-getstarted">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-getstarted">Log in</a>
                @endauth
            </div>
        @endif
    </div>
</header>

<style>
    /* Tambahan style untuk tombol login/register */
    .btn-getstarted {
        background: #4f46e5;
        padding: 8px 20px;
        margin-left: 10px;
        border-radius: 4px;
        color: #fff;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-getstarted:hover {
        background: #4338ca;
        color: #fff;
    }

    .gap-3 {
        gap: 1rem;
    }
</style>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Sistem Informasi Manajemen Praktikum Laboratorium Prodi Sistem Informasi UNIB</h1>
            <p>Selamat Datang di Sistem Informasi Manajemen Praktikum Laboratorium Prodi Sistem Informasi UNIB</p>
            <div class="d-flex">
              <a href="{{ url('/login') }}" class="btn-get-started">Get Started</a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="zoom-in">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 5,
                  "spaceBetween": 120
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p>
              Program Studi Sistem Informasi Universitas Bengkulu (UNIB) berfokus pada pengembangan keterampilan di bidang teknologi informasi, analisis data, dan manajemen sistem informasi untuk mendukung pengambilan keputusan yang efisien di organisasi. Mahasiswa dipersiapkan untuk menjadi profesional yang mampu merancang, mengimplementasikan, dan mengelola solusi teknologi yang mendukung transformasi digital.

            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> <span>Melakukan Presensi pada saat Praktikum di Sistem Informasi UNIB</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Pembuatan Laporan Harian maupun Laporan Penilaian Praktikum di Sistem Informasi UNIB</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Mampu mendata mahasiswa, asisten dosen yang melakukan praktikum di sistem informasi UNIB</span></li>
            </ul>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <p>Sistem Manajemen Laboratorium Program Studi Sistem Informasi UNIB dirancang untuk memfasilitasi kegiatan laboratorium secara efektif. Sistem ini mengatur peran Kalab, Laboran, Co-ass, dan mahasiswa, serta mempermudah manajemen jadwal, dan pengawasan kegiatan praktikum secara terintegrasi dan berbasis teknologi.</p>
            <a href="{{ url('/dashboard') }}" class="get-started"><span>Get Started</span><i class="bi bi-arrow-right"></i></a>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="section why-us light-background" data-builder="section">

      <div class="container-fluid">

        <div class="row gy-4">

          <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">

            <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
              <h3><span>Apa itu </span><strong>Sistem Manajemen Laboratorium Program Studi Sistem Informasi UNIB</strong></h3>
              <p>
                Sistem Manajemen Laboratorium Program Studi Sistem Informasi UNIB dirancang untuk memfasilitasi kegiatan laboratorium secara efektif. Sistem ini mengatur peran Kalab, Laboran, Co-ass, dan mahasiswa, serta mempermudah manajemen jadwal, dan pengawasan kegiatan praktikum secara terintegrasi dan berbasis teknologi.
             </p>
            </div>

            <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

              <div class="faq-item faq-active">

                <h3><span>01</span> Melakukan Presensi pada saat Praktikum di Sistem Informasi UNIB</h3>
                <div class="faq-content">
                  <p>Sistem ini mampu melakukan Presensi pada saat Praktikum di Sistem Informasi UNIB.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span>02</span> Pembuatan Laporan Harian maupun Laporan Penilaian Praktikum di Sistem Informasi UNIB</h3>
                <div class="faq-content">
                  <p>Sistem ini mampu membuat Laporan Praktikum secara Harian maupun Mingguan.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span>03</span> Mampu mendata mahasiswa, asisten dosen yang melakukan praktikum di sistem informasi UNIB ?</h3>
                <div class="faq-content">
                  <p>Sistem ini mampu mendata seluruh kegiatan yang ada di laboratorium</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

          <div class="col-lg-5 order-1 order-lg-2 why-us-img">
            <img src="assets/img/why-us.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>
        </div>

      </div>

    </section><!-- /Why Us Section -->



    </section><!-- /Faq 2 Section -->



  </main>

  <footer id="footer" class="footer">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <span class="sitename">Laboratorium Sistem Informasi UNIB</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jalan WR. Supratman Kandang Limun</p>
            <p>Bengkulu, 38371</p>
            <p><strong>Email:</strong> <span>siunib@unib.ac.id</span></p>
          </div>
        </div>

        <div id="contact" class="col-lg-4 col-md-6 footer-contact" style="background-color: white; padding: 20px; border-radius: 8px;">
          <h4 style="color: #333;">Contact</h4>

          <p style="margin-bottom: 15px;">
              <strong style="display: block; color: #555;">Koordinator Program Studi Sistem Informasi:</strong>
              <span style="display: block; margin-top: 5px;">Dr. Endina Putri Purwandari, S.T., M.Kom.</span>
              <strong style="display: block; color: #555; margin-top: 10px;">Email:</strong>
              <a href="mailto:endinapuput@unib.ac.id" style="color: #007bff; text-decoration: none;">endinapuput@unib.ac.id</a>
          </p>

          <p style="margin-bottom: 0;">
              <strong style="display: block; color: #555;">Kepala Laboran Program Studi Sistem Informasi:</strong>
              <span style="display: block; margin-top: 5px;">Andang Wijanarko, S.Kom., M.Kom.</span>
              <strong style="display: block; color: #555; margin-top: 10px;">Email:</strong>
              <a href="mailto:andangwijanarko@unib.ac.id" style="color: #007bff; text-decoration: none;">andangwijanarko@unib.ac.id</a>
          </p>
      </div>


        <div class="col-lg-4 col-md-12">
          <h4>Follow Us</h4>
          <p>Ikuti Media Sosial Kami</p>
          <div class="social-links d-flex">
            <a href="https://www.facebook.com/sisteminformasiunib/?locale=id_ID"><i class="bi bi-facebook"></i></a>
            <a href="https://ft.unib.ac.id/si/#:~:text=Fokus%20dari%20Sistem%20Informasi%20UNIB%20di%20antaranya%20adalah%20IS"><i class="bi bi-globe"></i></a>
            <a href="https://www.instagram.com/si_unib/"><i class="bi bi-instagram"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">2024 Sistem Informasi UNIB</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Designed by <a href="{{ url('/landingpage') }}">Sistem Informasi UNIB</a>
      </div>
    </div>
</footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
