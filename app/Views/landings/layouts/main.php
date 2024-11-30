<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-wide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url(['assets/']) ?>"
  data-template="front-pages"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Landing Page - Front Pages | Materialize - Material Design HTML Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url(['assets/vendor/fonts/remixicon/remixicon.css']) ?>" />

    <?php
      $color_primary = isset(configInfo()['primary_color']) && !empty(configInfo()['primary_color']) ? (string) configInfo()['primary_color'] : '8e24aa';
      $secondary_color = isset(configInfo()['secundary_color']) && !empty(configInfo()['secundary_color']) ? (string) configInfo()['secundary_color'] : 'ff6e40';
      $color_primary = "$color_primary";
    ?>

    <script>
      console.log("#<?= $color_primary ?>");
    </script>

    <style>
      :root {
        --primary-color: #<?= $color_primary ?>;
        --secondary-color: #<?= $secondary_color ?>;
        --primary-rgb: <?= hexToRgb($color_primary)?>;
        --secondary-rgb: <?= hexToRgb($secondary_color) ?>;

        --primary-ligth: <?= lightenColor($color_primary, 90) ?>;
        --primary-ligth-2: <?= lightenColor($color_primary, 80) ?>;
        --primary-ligth-3: <?= lightenColor($color_primary, 70) ?>;
        
        --primary-darken: <?= darkenColor($color_primary, 50) ?>;
        --primary-darken-2: <?= darkenColor($color_primary, 60) ?>;
        --primary-darken-3: <?= darkenColor($color_primary, 70) ?>;
        --primary-darken-4: <?= darkenColor($color_primary, 80) ?>;
      }   
    </style>

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/node-waves/node-waves.css']) ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/rtl/core.css']) ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/rtl/theme-default.css']) ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url(['assets/css/demo.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/css/colors-materialize.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/css/colors-styles.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/pages/front-page.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css']) ?>" />
    <!-- Vendors CSS -->

    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/nouislider/nouislider.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/swiper/swiper.css']) ?>" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/pages/front-page-landing.css']) ?>" />

    <?= $this->renderSection('styles') ?>

    <!-- Helpers -->
    <script src="<?= base_url(['assets/vendor/js/helpers.js']) ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?= base_url(['assets/vendor/js/template-customizer.js']) ?>"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <!-- <script src="<?= base_url(['assets/js/front-config.js']) ?>"></script> -->
  </head>

  <body>
    <script src="<?= base_url(['assets/vendor/js/dropdown-hover.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/js/mega-dropdown.js']) ?>"></script>

    <!-- Navbar: Start -->
    <nav class="layout-navbar container shadow-none py-0">
      <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-4 px-md-8">
        <!-- Menu logo wrapper: Start -->
        <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-6">
          <!-- Mobile menu toggle: Start-->
          <button
            class="navbar-toggler border-0 px-0 me-2"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="tf-icons ri-menu-fill ri-24px align-middle"></i>
          </button>
          <!-- Mobile menu toggle: End-->
          <a href="landing-page.html" class="app-brand-link">
            <span class="app-brand-logo demo">
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2 ps-1"><?= isset(configInfo()['name_app']) ? configInfo()['name_app'] : 'IPLANET' ?></span>
          </a>
        </div>
        <!-- Menu logo wrapper: End -->
        <!-- Menu wrapper: Start -->
        <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
          <button
            class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="tf-icons ri-close-fill"></i>
          </button>
        </div>
        <div class="landing-menu-overlay d-lg-none"></div>
        <!-- Menu wrapper: End -->
        <!-- Toolbar: Start -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- Style Switcher -->
            <li class="nav-item">
                <a class="nav-link fw-medium" href="<?= base_url() ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-medium" href="<?= base_url('calendar') ?>">Calendario</a>
            </li>
          <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
            <a
              class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow me-sm-4"
              href="javascript:void(0);"
              data-bs-toggle="dropdown">
              <i class="ri-22px text-heading"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                  <span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Claro</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                  <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Oscuro</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                  <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>Sistema</span>
                </a>
              </li>
            </ul>
          </li>
          <!-- / Style Switcher-->

          <!-- navbar button: Start -->
          <li>
            <a
              href="<?= base_url(["login"]) ?>"
              class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
              target="_blank"
              ><span class="tf-icons ri-user-line me-md-1"></span
              ><span class="d-none d-md-block">Iniciar Sesion</span></a
            >
          </li>
          <!-- navbar button: End -->
        </ul>
        <!-- Toolbar: End -->
      </div>
    </nav>

    <?= $this->renderSection('content'); ?>

    <div id="div_btn_floating">
        <button type="button" class="btn rounded-pill btn-icon btn-label-primary demo waves-effect btn-floating">
            <span class="tf-icons ri-notification-4-line ri-30px"></span>
        </button>
    </div>

    <!-- Navbar: End -->
         <!-- Footer: Start -->
    <footer class="landing-footer">
      <div class="footer-top position-relative overflow-hidden">
        <img
          src="<?= base_url(['assets/img/front-pages/backgrounds/footer-bg.png']) ?>"
          alt="footer bg"
          class="footer-bg banner-bg-img" />
        <div class="container position-relative">
          <div class="row gx-0 gy-7 gx-sm-6 gx-lg-12">
            <div class="col-lg-5">
              <a href="landing-page.html" class="app-brand-link mb-6">
                <span class="app-brand-logo demo me-2">
                </span>
                <span class="app-brand-text demo footer-link fw-semibold ms-1"><?= isset(configInfo()['name_app']) ? configInfo()['name_app'] : 'IPLANET' ?></span>
              </a>
              <p class="footer-text footer-logo-description mb-6">
                Most Powerful & Comprehensive 🤩 React NextJS Admin Template with Elegant Material Design & Unique
                Layouts.
              </p>
            <div class="d-flex mt-2 gap-4">
                <button
                    class="btn btn-primary btn-toggle-sidebar"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#register"
                    aria-controls="register">
                    <span class="align-middle">Registrame</span>
                </button>
            </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <h6 class="footer-title mb-4 mb-lg-6">Demos</h6>
              <ul class="list-unstyled mb-0">
                <li class="mb-4">
                  <a href="../vertical-menu-template/" target="_blank" class="footer-link">Vertical Layout</a>
                </li>
                <li class="mb-4">
                  <a href="../horizontal-menu-template/" target="_blank" class="footer-link">Horizontal Layout</a>
                </li>
                <li class="mb-4">
                  <a href="../vertical-menu-template-bordered/" target="_blank" class="footer-link">Bordered Layout</a>
                </li>
                <li class="mb-4">
                  <a href="../vertical-menu-template-semi-dark/" target="_blank" class="footer-link"
                    >Semi Dark Layout</a
                  >
                </li>
                <li>
                  <a href="../vertical-menu-template-dark/" target="_blank" class="footer-link">Dark Layout</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6">
              <h6 class="footer-title mb-4 mb-lg-6">Pages</h6>
              <ul class="list-unstyled mb-0">
                <li class="mb-4">
                  <a href="pricing-page.html" class="footer-link">Pricing</a>
                </li>
                <li class="mb-4">
                  <a href="payment-page.html" class="footer-link"
                    >Payment<span class="badge rounded-pill bg-primary ms-2">New</span></a
                  >
                </li>
                <li class="mb-4">
                  <a href="checkout-page.html" class="footer-link">Checkout</a>
                </li>
                <li class="mb-4">
                  <a href="help-center-landing.html" class="footer-link">Help Center</a>
                </li>
                <li>
                  <a href="../vertical-menu-template/auth-login-cover.html" target="_blank" class="footer-link"
                    >Login/Register</a
                  >
                </li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-4">
              <h6 class="footer-title mb-4 mb-lg-6">Download our app</h6>
              <a href="javascript:void(0);" class="d-block footer-link mb-4"
                ><img src="../../assets/img/front-pages/landing-page/apple-icon.png" alt="apple icon"
              /></a>
              <a href="javascript:void(0);" class="d-block footer-link"
                ><img src="../../assets/img/front-pages/landing-page/google-play-icon.png" alt="google play icon"
              /></a>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom py-5">
        <div
          class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
          <div class="mb-2 mb-md-0">
            <span class="footer-text"
              >©
              <script>
                document.write(new Date().getFullYear());
              </script>
              , Hecho por <i class="tf-icons ri-heart-fill text-danger"></i>
            </span>
            <a href="https://www.iplanetcolombia.com/" target="_blank" class="footer-link fw-medium footer-theme-link"
              >IplanetColombia</a
            >
          </div>
          <!-- <div>
            <a href="https://github.com/pixinvent" class="footer-link me-4" target="_blank"
              ><i class="ri-github-fill"></i
            ></a>
            <a href="https://www.facebook.com/pixinvents/" class="footer-link me-4" target="_blank"
              ><i class="ri-facebook-circle-fill"></i
            ></a>
            <a href="https://twitter.com/pixinvents" class="footer-link me-4" target="_blank"
              ><i class="ri-twitter-fill"></i
            ></a>
            <a href="https://www.instagram.com/pixinvents/" class="footer-link" target="_blank"
              ><i class="ri-instagram-line"></i
            ></a>
          </div> -->
        </div>
      </div>
    </footer>
    <!-- Footer: End -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url(['assets/vendor/libs/jquery/jquery.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/popper/popper.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/js/bootstrap.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/node-waves/node-waves.js']) ?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url(['assets/vendor/libs/nouislider/nouislider.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/swiper/swiper.js']) ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= base_url(['assets/js/ui-popover.js']) ?>"></script>
    
    <!-- Main JS -->
    <script src="<?= base_url(['assets/js/front-main.js']) ?>"></script>
    <script src="<?= base_url(['assets/js/functions.js']) ?>"></script>

    <!-- Page JS -->
    <script src="<?= base_url(['assets/js/front-page-landing.js']) ?>"></script>

    <script src="<?= base_url(['assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js']) ?>"></script>

    <?= $this->renderSection('javascript') ?>
    
  </body>
</html>