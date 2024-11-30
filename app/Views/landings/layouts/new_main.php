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
    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="canvasRegister"
      aria-labelledby="canvasRegisterLabel">
      <div class="offcanvas-header">
        <h5 id="canvasRegisterLabel" class="offcanvas-title"><?= session('filter')->nit->status ? 'Iniciar Sesion' : 'Registro' ?></h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0">
        <form class="event-form pt-0" id="eventForm" onSubmit="<?= session('filter')->nit->status ? 'login(event)' : 'register(event)' ?>">
          <?php if(!session('filter')->nit->status): ?>
            <div class="form-floating form-floating-outline mb-5">
              <input
                type="text"
                class="form-control"
                id="register-name"
                name="register-name"
                placeholder="" />
              <label for="register-name">Nombre del dueño</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input
                type="text"
                class="form-control"
                id="register-name-company"
                name="register-name-company"
                placeholder="" />
              <label for="register-name-company">Nombre de la empresa</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input
                type="text"
                class="form-control"
                id="register-email"
                name="register-email"
                placeholder="" />
              <label for="register-email">Correo</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input
                type="text"
                class="form-control"
                id="register-nit"
                name="register-nit"
                onkeyup="formatNumeric(this, 10)"
                value="<?= session('filter')->nit->number ?>"
                placeholder="" />
              <label for="register-nit">Nit</label>
            </div>
            <!-- <div class="divider my-5">
              <div class="divider-text">Registrate con</div>
            </div> -->
          <?php else: ?>
            <div class="form-floating form-floating-outline mb-5">
              <input
                type="text"
                class="form-control"
                id="login-email"
                name="login-email"
                placeholder="" />
              <label for="login-email">Correo</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input
                type="password"
                class="form-control"
                id="login-password"
                name="login-password"
                placeholder="" />
              <label for="login-password">Contraseña</label>
            </div>
          <?php endif ?>

          <div class="form-floating form-floating-outline mb-5">
            <input type="text" class="form-control" id="captcha" name="captcha"
                placeholder="Ingresar la respuesta"/>
            <label for="captcha">
                Cuanto es: <?= 
                session('captcha')->number_a
                ." ".
                    (session('captcha')->operacion == 'mas' ? "+" : (session('captcha')->operacion == 'menos' ? "-" : '*'))
                ." ".
                session('captcha')->number_b
                ?></label>
          </div>

          <!-- <div class="d-flex justify-content-center gap-2">
            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-facebook">
              <i class="tf-icons ri-facebook-fill"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-google-plus">
              <i class="tf-icons ri-google-fill"></i>
            </a>
          </div> -->
          <?php if(!session('filter')->nit->status): ?>
            <div class="col-sm-12 p-6">
              <label class="switch switch-primary">
                <input type="checkbox" class="switch-input" name="accept-tc" id="accept-tc" checked onchange="validTC()">
                <span class="switch-toggle-slider">
                  <span class="switch-on">
                    <i class="ri-check-line"></i>
                  </span>
                  <span class="switch-off">
                    <i class="ri-close-line"></i>
                  </span>
                </span>
                <span class="switch-label"><a href="">Acepto T&C</a></span>
              </label>
            </div>
          <?php endif ?>
          <div class="mb-5 d-flex justify-content-center my-6 gap-2">
            <div class="d-flex justify-content-center">
              <button type="submit" id="btn-send-register-login" class="btn btn-primary btn-add-event me-4">
              <?= session('filter')->nit->status ? 'Iniciar Sesion' : 'Registrarme' ?>
              </button>
              <button
                type="reset"
                class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
                id="btn-cancel-login-register"
                data-bs-dismiss="offcanvas">
                Cancelar
              </button>
            </div>
            <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
          </div>
        </form>
      </div>
    </div>
    <?php if(session()->get('user-calendar')): ?>
      <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="canvasNotify"
        aria-labelledby="canvasNotifyLabel">
        <div class="offcanvas-header">
          <h5 id="canvasNotifyLabel" class="offcanvas-title">Configuración de Notificaciones</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0">
          <form class="event-form pt-0" id="form-notify" onsubmit="notify(event)">
            <input type="hidden" name="company-id" id="company-id" value="<?= session('user-calendar')->company->id ?>">
            <div class="form-floating form-floating-outline mb-5">
              <input
                type="text"
                class="form-control"
                id="name-company"
                name="name-company"
                value="<?= session('user-calendar')->company->name ?>"
                placeholder="" />
              <label for="name-company">Nombre de la empresa</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
              <input
                type="text"
                class="form-control"
                id="email-notify"
                name="email-notify"
                value="<?= session('user-calendar')->email ?>"
                disabled
                placeholder="" />
              <label for="email-notify">Correo de notificación</label>
            </div>
            <?php
                $emails_com = explode(" ", session('user-calendar')->company->emails);
                $emails = [!empty($emails_com[0]) ? $emails_com[0] : "", isset($emails_com[1]) ? $emails_com[1] : ""];
            ?>
            <?php foreach($emails as $k_email => $email): ?>
              <div class="form-floating form-floating-outline mb-5">
                  <input
                      type="email"
                      class="form-control"
                      id="email-notify-<?= $k_email + 2 ?>"
                      name="email-notify-<?= $k_email + 2 ?>"
                      value="<?= $email ?>"
                      placeholder=""
                  />
                  <label for="email-notify-<?= $k_email + 2 ?>">Correo <?= $k_email + 2 ?></label>
              </div>
            <?php endforeach ?>
            <div class="form-floating form-floating-outline mb-5">
              <input
                type="text"
                class="form-control"
                id="nit-notify"
                name="nit-notify"
                onkeyup="formatNumeric(this, 10)"
                value="<?= session('user-calendar')->company->nit ?>"
                placeholder="" />
              <label for="nit-notify">Nit</label>
            </div>
            
            <div class="col-sm-12 p-6 pt-0">
              <label class="switch">
                <input type="checkbox" id="first_working_day" <?= session('user-calendar')->company->first_working_day ? 'checked': '' ?> class="switch-input">
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">Vencimiento del mes</span>
              </label>
            </div>

            <div class="col-sm-12 p-6 pt-0">
              <label class="switch">
                <input type="checkbox" id="three_days_due" <?= session('user-calendar')->company->three_days_due ? 'checked': '' ?> class="switch-input">
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">3 días del vencimiento</span>
              </label>
            </div>

            <div class="col-sm-12 p-6 pt-0">
              <label class="switch">
                <input type="checkbox" id="due_date" <?= session('user-calendar')->company->due_date ? 'checked': '' ?> class="switch-input">
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">Dias del vencimiento</span>
              </label>
            </div>

            <div class="mb-5 d-flex justify-content-center my-6 gap-2">
              <div class="d-flex justify-content-center">
                <button type="submit" id="btn-notify-save" class="btn btn-primary btn-add-event me-4">
                  Guardar
                </button>
                <button
                  type="reset"
                  class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
                  id="btn-cancel-notify"
                  data-bs-dismiss="offcanvas">
                  Cancelar
                </button>
              </div>
              <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
            </div>
          </form>
        </div>
      </div>
    <?php endif ?>
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
