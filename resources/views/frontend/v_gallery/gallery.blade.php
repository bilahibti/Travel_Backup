<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Gallery - TravelTime</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('frontend/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('frontend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: TravelTime
  * Template URL: https://bootstrapmade.com/traveltime-bootstrap-travel-template/
  * Updated: Jul 28 2025 with Bootstrap v5.3.7
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="gallery-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">TravelTime</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('v1.frontend.beranda') }}">Home</a></li>
          <li><a href="{{ route('v1.frontend.about') }}">About</a></li>
          <li><a href="{{ route('v1.frontend.destinasi') }}">Destinations</a></li>
          <li><a href="{{ route('v1.frontend.tours') }}">Tours</a></li>
          <li><a href="hotel.html">Hotel</a></li>
          <li><a href="transportation.html">Transportation</a></li>
          <li><a href="travel-packages.html">Travel Packages</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('v1.frontend.login.login') }}">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" style="background-image: url({{ asset('frontend/img/travel/showcase-11.webp') }});">
      <div class="container position-relative">
        <h1>Gallery</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Gallery</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Gallery Slider Section -->
    <section id="gallery-slider" class="gallery-slider section">

      <div class="container">

        <div class="gallery-container">
          <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 800,
                "autoplay": {
                  "delay": 4000
                },
                "effect": "coverflow",
                "grabCursor": true,
                "centeredSlides": true,
                "slidesPerView": "auto",
                "coverflowEffect": {
                  "rotate": 50,
                  "stretch": 0,
                  "depth": 100,
                  "modifier": 1,
                  "slideShadows": true
                },
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "navigation": {
                  "nextEl": ".swiper-button-next",
                  "prevEl": ".swiper-button-prev"
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 1,
                    "spaceBetween": 10
                  },
                  "768": {
                    "slidesPerView": 2,
                    "spaceBetween": 20
                  },
                  "1024": {
                    "slidesPerView": 3,
                    "spaceBetween": 30
                  }
                }
              }
            </script>
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="gallery-item">
                  <div class="gallery-img">
                    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-3.webp') }}">
                      <img src="{{ asset('frontend/img/gallery/gallery-3.webp') }}" class="img-fluid" alt="">
                      <div class="gallery-overlay">
                        <i class="bi bi-plus-circle"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="gallery-item">
                  <div class="gallery-img">
                    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-1.webp') }}">
                      <img src="{{ asset('frontend/img/gallery/gallery-1.webp') }}" class="img-fluid" alt="">
                      <div class="gallery-overlay">
                        <i class="bi bi-plus-circle"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="gallery-item">
                  <div class="gallery-img">
                    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-5.webp') }}">
                      <img src="{{ asset('frontend/img/gallery/gallery-5.webp') }}" class="img-fluid" alt="">
                      <div class="gallery-overlay">
                        <i class="bi bi-plus-circle"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="gallery-item">
                  <div class="gallery-img">
                    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-7.webp') }}">
                      <img src="{{ asset('frontend/img/gallery/gallery-7.webp') }}" class="img-fluid" alt="">
                      <div class="gallery-overlay">
                        <i class="bi bi-plus-circle"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="gallery-item">
                  <div class="gallery-img">
                    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-2.webp') }}">
                      <img src="{{ asset('frontend/img/gallery/gallery-2.webp') }}" class="img-fluid" alt="">
                      <div class="gallery-overlay">
                        <i class="bi bi-plus-circle"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="gallery-item">
                  <div class="gallery-img">
                    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-4.webp') }}">
                      <img src="{{ asset('frontend/img/gallery/gallery-4.webp') }}" class="img-fluid" alt="">
                      <div class="gallery-overlay">
                        <i class="bi bi-plus-circle"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="gallery-item">
                  <div class="gallery-img">
                    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-6.webp') }}">
                      <img src="{{ asset('frontend/img/gallery/gallery-6.webp') }}" class="img-fluid" alt="">
                      <div class="gallery-overlay">
                        <i class="bi bi-plus-circle"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="gallery-item">
                  <div class="gallery-img">
                    <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-8.webp') }}">
                      <img src="{{ asset('frontend/img/gallery/gallery-8.webp') }}" class="img-fluid" alt="">
                      <div class="gallery-overlay">
                        <i class="bi bi-plus-circle"></i>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        </div>

      </div>

    </section><!-- /Gallery Slider Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <div class="container">

        <div class="gallery-grid">
          <div class="gallery-item">
            <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-3.webp') }}">
              <img src="{{ asset('frontend/img/gallery/gallery-3.webp') }}" class="img-fluid" alt="">
              <div class="gallery-overlay">
                <i class="bi bi-plus-lg"></i>
              </div>
            </a>
          </div>

          <div class="gallery-item featured">
            <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-1.webp') }}">
              <img src="{{ asset('frontend/img/gallery/gallery-1.webp') }}" class="img-fluid" alt="">
              <div class="gallery-overlay">
                <i class="bi bi-plus-lg"></i>
              </div>
            </a>
          </div>

          <div class="gallery-item">
            <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-5.webp') }}">
              <img src="{{ asset('frontend/img/gallery/gallery-5.webp') }}" class="img-fluid" alt="">
              <div class="gallery-overlay">
                <i class="bi bi-plus-lg"></i>
              </div>
            </a>
          </div>

          <div class="gallery-item">
            <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-7.webp') }}">
              <img src="{{ asset('frontend/img/gallery/gallery-7.webp') }}" class="img-fluid" alt="">
              <div class="gallery-overlay">
                <i class="bi bi-plus-lg"></i>
              </div>
            </a>
          </div>

          <div class="gallery-item">
            <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-2.webp') }}">
              <img src="{{ asset('frontend/img/gallery/gallery-2.webp') }}" class="img-fluid" alt="">
              <div class="gallery-overlay">
                <i class="bi bi-plus-lg"></i>
              </div>
            </a>
          </div>

          <div class="gallery-item featured">
            <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-6.webp') }}">
              <img src="{{ asset('frontend/img/gallery/gallery-6.webp') }}" class="img-fluid" alt="">
              <div class="gallery-overlay">
                <i class="bi bi-plus-lg"></i>
              </div>
            </a>
          </div>

          <div class="gallery-item">
            <a class="glightbox" data-gallery="images-gallery" href="{{ asset('frontend/img/gallery/gallery-8.webp') }}">
              <img src="{{ asset('frontend/img/gallery/gallery-8.webp') }}" class="img-fluid" alt="">
              <div class="gallery-overlay">
                <i class="bi bi-plus-lg"></i>
              </div>
            </a>
          </div>
        </div>

        <div class="text-center mt-5">
          <a href="#" class="btn-view-more">View More <i class="bi bi-arrow-right"></i></a>
        </div>

      </div>

    </section><!-- /Gallery Section -->

  </main>

  <footer id="footer" class="footer position-relative dark-background">

    <div class="container">
      <div class="row gy-5">

        <div class="col-lg-4">
          <div class="footer-content">
            <a href="index.html" class="logo d-flex align-items-center mb-4">
              <span class="sitename">TravelTime</span>
            </a>
            <p class="mb-4">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae. Donec velit neque auctor sit amet aliquam vel ullamcorper sit amet ligula.</p>

            <div class="newsletter-form">
              <h5>Stay Updated</h5>
              <form action="forms/newsletter.php" method="post" class="php-email-form">
                <div class="input-group">
                  <input type="email" name="email" class="form-control" placeholder="Enter your email" required="">
                  <button type="submit" class="btn-subscribe">
                    <i class="bi bi-send"></i>
                  </button>
                </div>
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Thank you for subscribing!</div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-6">
          <div class="footer-links">
            <h4>Company</h4>
            <ul>
              <li><a href="#"><i class="bi bi-chevron-right"></i> About</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Careers</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Press</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Blog</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Contact</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-2 col-6">
          <div class="footer-links">
            <h4>Solutions</h4>
            <ul>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Digital Strategy</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Cloud Computing</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Data Analytics</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> AI Solutions</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i> Cybersecurity</a></li>
            </ul>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="footer-contact">
            <h4>Get in Touch</h4>
            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="contact-info">
                <p>2847 Maple Avenue<br>Los Angeles, CA 90210<br>United States</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-telephone"></i>
              </div>
              <div class="contact-info">
                <p>+1 (555) 987-6543</p>
              </div>
            </div>

            <div class="contact-item">
              <div class="contact-icon">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="contact-info">
                <p>contact@example.com</p>
              </div>
            </div>

            <div class="social-links">
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-twitter-x"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
              <a href="#"><i class="bi bi-youtube"></i></a>
              <a href="#"><i class="bi bi-github"></i></a>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="copyright">
              <p>© <span>Copyright</span> <strong class="px-1 sitename">MyWebsite</strong> <span>All Rights Reserved</span></p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="footer-bottom-links">
              <a href="#">Privacy Policy</a>
              <a href="#">Terms of Service</a>
              <a href="#">Cookie Policy</a>
            </div>
            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you've purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('frontend/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('frontend/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('frontend/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('frontend/js/main.js') }}"></script>

</body>

</html>