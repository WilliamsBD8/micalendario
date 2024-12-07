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
          <a href="<?= base_url() ?>" class="app-brand-link">
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
          <!-- <ul class="navbar-nav me-auto p-4 p-lg-0">
            <li class="nav-item">
              <a class="nav-link fw-medium" aria-current="page" href="landing-page.html#landingHero">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-medium" href="landing-page.html#landingFeatures">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-medium" href="landing-page.html#landingTeam">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-medium" href="landing-page.html#landingFAQ">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-medium text-nowrap" href="landing-page.html#landingContact">Contact us</a>
            </li>
            <li class="nav-item mega-dropdown">
              <a
                href="javascript:void(0);"
                class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium"
                aria-expanded="false"
                data-bs-toggle="mega-dropdown"
                data-trigger="hover">
                <span data-i18n="Pages">Pages</span>
              </a>
              <div class="dropdown-menu p-4 p-lg-6">
                <div class="row gy-4">
                  <div class="col-12 col-lg">
                    <div class="h6 d-flex align-items-center mb-2 mb-lg-4">
                      <div class="avatar avatar-sm flex-shrink-0 me-2">
                        <span class="avatar-initial rounded bg-label-primary"><i class="ri-layout-grid-line"></i></span>
                      </div>
                      <span class="ps-1">Other</span>
                    </div>
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link mega-dropdown-link d-flex align-items-center" href="pricing-page.html">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          <span data-i18n="Pricing">Pricing</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mega-dropdown-link d-flex align-items-center" href="payment-page.html">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          <span data-i18n="Payment">Payment</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link mega-dropdown-link d-flex align-items-center" href="checkout-page.html">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          <span data-i18n="Checkout">Checkout</span>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="help-center-landing.html">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          <span data-i18n="Help Center">Help Center</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-12 col-lg">
                    <div class="h6 d-flex align-items-center mb-2 mb-lg-4">
                      <div class="avatar avatar-sm flex-shrink-0 me-2">
                        <span class="avatar-initial rounded bg-label-primary"><i class="ri-lock-unlock-line"></i></span>
                      </div>
                      <span class="ps-1">Auth Demo</span>
                    </div>
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-login-basic.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Login (Basic)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-login-cover.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Login (Cover)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-register-basic.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Register (Basic)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-register-cover.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Register (Cover)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-register-multisteps.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Register (Multi-steps)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-forgot-password-basic.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Forgot Password (Basic)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-forgot-password-cover.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Forgot Password (Cover)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-reset-password-basic.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Reset Password (Basic)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-reset-password-cover.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Reset Password (Cover)
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-12 col-lg">
                    <div class="h6 d-flex align-items-center mb-2 mb-lg-4">
                      <div class="avatar avatar-sm flex-shrink-0 me-2">
                        <span class="avatar-initial rounded bg-label-primary"><i class="ri-image-fill"></i></span>
                      </div>
                      <span class="ps-1">Other</span>
                    </div>
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/pages-misc-error.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Error
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/pages-misc-under-maintenance.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Under Maintenance
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/pages-misc-comingsoon.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Coming Soon
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/pages-misc-not-authorized.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Not Authorized
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-verify-email-basic.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Verify Email (Basic)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-verify-email-cover.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Verify Email (Cover)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-two-steps-basic.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Two Steps (Basic)
                        </a>
                      </li>
                      <li class="nav-item">
                        <a
                          class="nav-link mega-dropdown-link d-flex align-items-center"
                          href="../vertical-menu-template/auth-two-steps-cover.html"
                          target="_blank">
                          <i class="menu-icon tf-icons ri-circle-line me-2"></i>
                          Two Steps (Cover)
                        </a>
                      </li>
                    </ul>
                  </div>
                  <div class="col-lg-4 d-none d-lg-block">
                    <div class="bg-body nav-img-col p-2">
                      <img
                        src="../../assets/img/front-pages/misc/nav-item-col-img-light.png"
                        class="img-fluid scaleX-n1-rtl w-100"
                        alt="nav item col image"
                        data-app-light-img="front-pages/misc/nav-item-col-img-light.png"
                        data-app-dark-img="front-pages/misc/nav-item-col-img-dark.png" />
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-medium" href="../vertical-menu-template/index.html" target="_blank">Admin</a>
            </li>
          </ul> -->
        </div>
        <div class="landing-menu-overlay d-lg-none"></div>
        <!-- Menu wrapper: End -->
        <!-- Toolbar: Start -->
        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- Style Switcher -->
          <!-- <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
            <a
              class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow me-sm-4"
              href="javascript:void(0);"
              data-bs-toggle="dropdown">
              <i class="ri-22px text-heading"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                  <span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Light</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                  <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Dark</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                  <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>System</span>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- / Style Switcher-->

          <!-- navbar button: Start -->
          <li>
            <?php if(!session()->get('user-calendar')): ?>
              <a
                href="javascript:void(0);"
                data-bs-toggle="offcanvas"
                data-bs-target="#canvasRegister"
                aria-controls="canvasRegister"
                id="btn-menu-register"
                class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
                ><span class="tf-icons ri-user-add-line me-md-1"></span
                ><span class="d-none d-md-block">Registrarme</span></a>
              <a
                href="javascript:void(0);"
                data-bs-toggle="offcanvas"
                data-bs-target="#canvasLogin"
                aria-controls="canvasLogin"
                class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
                ><span class="tf-icons ri-user-line me-md-1"></span
                ><span class="d-none d-md-block">Iniciar Sesion</span></a>
            <?php else: ?>
              <a
                href="javascript:void(0);"
                data-bs-toggle="offcanvas"
                data-bs-target="#canvasNotify"
                aria-controls="canvasNotify"
                class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
                ><span class="tf-icons ri-list-settings-line me-md-1"></span
                ><span class="d-none d-md-block">Notificaciones</span></a>
                <a
                href="<?= base_url(['logout']) ?>"
                class="btn btn-primary px-2 px-sm-4 px-lg-2 px-xl-4"
                ><span class="tf-icons ri-close-circle-line me-md-1"></span
                ><span class="d-none d-md-block">Cerrar Sesión</span></a>
            <?php endif ?>
          </li>
          <!-- navbar button: End -->
        </ul>
        <!-- Toolbar: End -->
      </div>
    </nav>
    <!-- Navbar: End -->