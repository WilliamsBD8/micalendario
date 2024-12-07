<div
    class="offcanvas offcanvas-end"
    tabindex="-1"
    id="canvasLogin"
    aria-labelledby="canvasRegisterLabel">
    <div class="offcanvas-header">
    <h5 id="canvasRegisterLabel" class="offcanvas-title">Iniciar Sesion</h5>
    <button
        type="button"
        class="btn-close text-reset"
        data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
    <form class="event-form pt-0" id="eventForm" onsubmit="login(event)">
        
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

        <div class="form-floating form-floating-outline mb-5">
        <input type="text" class="form-control" id="captcha-login" name="captcha-login"
            placeholder="Ingresar la respuesta"/>
        <label for="captcha-login">
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
        <div class="mb-5 d-flex justify-content-center my-6 gap-2">
        <div class="d-flex justify-content-center">
            <button type="submit" id="btn-send-login" class="btn btn-primary btn-add-event me-4">
            Iniciar Sesión
            </button>
            <button
            type="reset"
            class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
            id="btn-cancel-login"
            data-bs-dismiss="offcanvas">
            Cancelar
            </button>
        </div>
        <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
        </div>
    </form>
    </div>
</div>

<div
    class="offcanvas offcanvas-end"
    tabindex="-1"
    id="canvasRegister"
    aria-labelledby="canvasRegisterLabel">
    <div class="offcanvas-header">
    <h5 id="canvasRegisterLabel" class="offcanvas-title">Registrame</h5>
    <button
        type="button"
        class="btn-close text-reset"
        data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
    <form class="event-form pt-0" id="eventFormRegister" onsubmit="register(event)">
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
            value=""
            placeholder="" />
            <label for="register-nit">Nit</label>
        </div>
        <!-- <div class="divider my-5">
            <div class="divider-text">Registrate con</div>
        </div> -->

        <div class="form-floating form-floating-outline mb-5">
        <input type="text" class="form-control" id="captcha-register" name="captcha-register"
            placeholder="Ingresar la respuesta"/>
        <label for="captcha-register">
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
            <span class="switch-label"><a href="https://mawii.com.co/tyc" target="_blank">Acepto T&C</a></span>
            </label>
        </div>
        <div class="mb-5 d-flex justify-content-center my-6 gap-2">
        <div class="d-flex justify-content-center">
            <button type="submit" id="btn-send-register" class="btn btn-primary btn-add-event me-4">
            Registrarme
            </button>
            <button
            type="reset"
            class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
            id="btn-cancel-register"
            data-bs-dismiss="offcanvas">
            Cancelar
            </button>
        </div>
        <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
        </div>
    </form>
    </div>
</div>

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
        <input type="hidden" name="company-id" id="company-id" value="">
        <div class="form-floating form-floating-outline mb-5">
            <input
            type="text"
            class="form-control"
            id="name-company"
            name="name-company"
            value=""
            placeholder="" />
            <label for="name-company">Nombre de la empresa</label>
        </div>
        <div class="form-floating form-floating-outline mb-5">
            <input
            type="text"
            class="form-control"
            id="email-notify"
            name="email-notify"
            value=""
            disabled
            placeholder="" />
            <label for="email-notify">Correo de notificación</label>
        </div>
        <?php for ($i=2; $i <= 3 ; $i++): ?>
            <div class="form-floating form-floating-outline mb-5">
                <input
                    type="email"
                    class="form-control"
                    id="email-notify-<?= $i ?>"
                    name="email-notify-<?= $i ?>"
                    value=""
                    placeholder=""
                />
                <label for="email-notify-<?= $i ?>">Correo de notificación <?= $i ?></label>
            </div>
        <?php endfor ?>
        <div class="form-floating form-floating-outline mb-5">
            <input
            type="text"
            class="form-control"
            id="nit-notify"
            name="nit-notify"
            onkeyup="formatNumeric(this, 10)"
            value=""
            placeholder="" />
            <label for="nit-notify">Nit</label>
        </div>
        
        <div class="col-sm-12 p-6 pt-0">
            <label class="switch">
            <input type="checkbox" id="first_working_day" class="switch-input">
            <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
            </span>
            <span class="switch-label">Vencimiento del mes</span>
            </label>
        </div>

        <div class="col-sm-12 p-6 pt-0">
            <label class="switch">
            <input type="checkbox" id="three_days_due" class="switch-input">
            <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
            </span>
            <span class="switch-label">3 días del vencimiento</span>
            </label>
        </div>

        <div class="col-sm-12 p-6 pt-0">
            <label class="switch">
            <input type="checkbox" id="due_date" class="switch-input">
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