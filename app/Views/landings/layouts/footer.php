<footer class="landing-footer">
      <div class="footer-top position-relative overflow-hidden">
        <img
          src="<?= base_url(['assets/img/front-pages/backgrounds/footer-bg.png']) ?>"
          alt="footer bg"
          class="footer-bg banner-bg-img" />
        <div class="container position-relative">
          <div class="row gx-0 gy-7 gx-sm-6 gx-lg-12">
            <div class="col-lg-6 col-sm-12">
              <a href="<?= base_url() ?>" class="app-brand-link mb-6">
                <span class="app-brand-text demo footer-link fw-semibold ms-1"><?= isset(configInfo()['name_app']) ? configInfo()['name_app'] : 'IPLANET' ?></span>
              </a>
              <?php if(isset(configInfo()['description_app'])): ?>
                <p class="footer-text footer-logo-description mb-6">
                  <?=  configInfo()['description_app'] ?>
                </p>
              <?php endif ?>
              <!-- <form>
                <div class="d-flex mt-2 gap-4">
                  <div class="form-floating form-floating-outline w-px-250">
                    <input type="text" class="form-control bg-transparent" id="newsletter-1" placeholder="Your email" />
                    <label for="newsletter-1">Subscribe to newsletter</label>
                  </div>
                  <button type="submit" class="btn btn-primary">Subscribe</button>
                </div>
              </form> -->
            </div>
            <div class="col-lg-6 col-sm-12 ">
              <h6 class="footer-title mb-4 mb-lg-6 text-center">Visitanos en:</h6>
              <a href="https://mawii.com.co" class="d-block footer-link mb-4 w-100 d-flex flex-wrap justify-content-center flex-md-row flex-column "
                ><img src="<?= base_url(['assets/img/companies/mawii.webp']) ?>" style="height:100px" alt="apple icon"
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
              , Made with <i class="tf-icons ri-heart-fill text-danger"></i> by
            </span>
            <a href="https://mawii-tech.com.co/" target="_blank" class="footer-link fw-medium footer-theme-link">Mawii.</a>
          </div>
          <div>
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
          </div>
        </div>
      </div>
    </footer>