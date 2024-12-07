<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-wide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?= base_url(['assets/']) ?>"
  data-template="vertical-menu-template"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Mi Calendario Tributario</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url(['assets/img/favicon/favicon.ico']) ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

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

    <link rel="stylesheet" href="<?= base_url(['assets/vendor/fonts/remixicon/remixicon.css']) ?>" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/node-waves/node-waves.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/toastr/toastr.css']) ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/rtl/core.css']) ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/rtl/theme-default.css']) ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url(['assets/css/demo.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/pages/front-page.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(["assets/vendor/libs/sweetalert2/sweetalert2.css"]) ?>" />
    <!-- Vendors CSS -->

    <!-- Page CSS -->

    <?= $this->renderSection('styles') ?>

    <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/pages/front-page-landing.css']) ?>" />

    <!-- Helpers -->
    <script src="<?= base_url(['assets/vendor/js/helpers.js']) ?>"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?= base_url(['assets/vendor/js/template-customizer.js']) ?>"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= base_url(['assets/js/front-config.js']) ?>"></script>
  </head>

  <body>
    <?= view('landings/layouts/menu') ?>
    <!-- Sections:Start -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?= $this->renderSection('content'); ?>
        </div>
    </div>

    <!-- / Sections:End -->

    <!-- Enable backdrop (default) Offcanvas -->

    <?= view('landings/layouts/modal-canvas') ?>
    
    <?php if(!session()->get('user-calendar')): ?>
      <div id="div_btn_floating">
          <button type="button" class="btn rounded-pill btn-icon btn-label-primary demo waves-effect btn-floating">
              <span class="tf-icons ri-notification-4-line ri-30px"></span>
          </button>
      </div>
    <?php endif ?>

    <!-- Footer: Start -->
    <?= view('landings/layouts/footer') ?>
    <!-- Footer: End -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url(['assets/vendor/libs/jquery/jquery.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/popper/popper.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/js/bootstrap.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/node-waves/node-waves.js']) ?>"></script>

    <script src="<?= base_url(['assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/hammer/hammer.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/i18n/i18n.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/typeahead-js/typeahead.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/js/menu.js']) ?>"></script>

    <script src="<?= base_url(['assets/vendor/libs/sweetalert2/sweetalert2.js']) ?>"></script>
    
    <script src="<?= base_url(['assets/vendor/libs/toastr/toastr.js']) ?>"></script>

    
    <script src="<?= base_url(['assets/js/functions.js']) ?>"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= base_url(['assets/vendor/libs/nouislider/nouislider.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/swiper/swiper.js']) ?>"></script>

    <!-- Main JS -->
    <script src="<?= base_url(['assets/js/front-main.js']) ?>"></script>

    <!-- Page JS -->
    <script src="<?= base_url(['assets/js/front-page-landing.js']) ?>"></script>
    <?= $this->renderSection('scripts'); ?>
    
    <?php if(!session()->get('user-calendar')): ?>
      <script src="<?= base_url(['assets/js/ui-popover.js']) ?>"></script>
    <?php endif ?>
    
    <script src="<?= base_url(['assets/js/main.js']) ?>"></script>
    <!-- <script src="<?= base_url(['assets/js/extended-ui-perfect-scrollbar.js']) ?>"></script> -->
  </body>
</html>
