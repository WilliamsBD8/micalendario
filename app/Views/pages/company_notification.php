<?= $this->extend('layouts/page'); ?>

<?= $this->section('styles'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
    <!-- Gamification Card -->
        <div class="col-md-12 col-xxl-12">
            <div class="card">
                <div class="d-flex align-items-end row mb-2">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 col-md-6 col-sm-12">
                                    <h4 class="card-title mb-0">Empresa: <span class="text-muted"><?= $company->name ?></span></h4>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12 d-flex justify-content-end">
                                    <a href="<?= base_url(["table/companies"]) ?>" class="btn rounded-pill btn-label-primary btn-fab demo waves-effect">
                                        <span class="tf-icons ri-arrow-left-s-line ri-16px me-2"></span> Regresar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xxl-12">
            <div class="card">
                <div class="d-flex align-items-end row mb-2">
                    <div class="col-md-12">
                        <div class="card-body">
                            <form action="" onsubmit="saveNotification(event)">
                                <input type="hidden" name="company_id" id="company_id" value="<?= $company->id ?>">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form-floating form-floating-outline mb-5">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="email-notify-1"
                                                name="email-notify-1"
                                                disabled
                                                value="<?= session('user')->email ?>" />
                                            <label for="email-notify-1">Correo 1</label>
                                        </div>
                                    </div>
                                    <?php
                                        $emails_com = explode(" ", $company->emails);
                                        $emails = [!empty($emails_com[0]) ? $emails_com[0] : "", isset($emails_com[1]) ? $emails_com[1] : ""];
                                    ?>
                                    <?php foreach($emails as $k_email => $email): ?>
                                        <div class="col-lg-4 col-md-12 col-sm-12">
                                            <div class="form-floating form-floating-outline mb-5">
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    id="email-notify-<?= $k_email + 2 ?>"
                                                    name="email-notify-<?= $k_email + 2 ?>"
                                                    value="<?= $email ?>"
                                                    placeholder=""
                                                    onblur="changeData(this)"
                                                />
                                                <label for="email-notify-<?= $k_email + 2 ?>">Correo <?= $k_email + 2 ?></label>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                    <!-- <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form-floating form-floating-outline mb-5">
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="email-notify-3"
                                                name="email-notify-3"
                                                placeholder="" />
                                            <label for="email-notify-3">Correo 3</label>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <?php foreach($groups_tax as $group_taxes): ?>
                                        <?php foreach($group_taxes as $tax): ?>
                                            <div class="col-lg-4 col-md-6 col-sm-12 mt-1">
                                                <label class="switch">
                                                    <input type="checkbox" name="tax-<?= $tax->calendary_tax_id ?>" onchange="changeData(this)" value="<?= $tax->calendary_tax_id ?>" class="switch-input" <?= $tax->notify ? 'checked' : '' ?>>
                                                    <span class="switch-toggle-slider">
                                                        <span class="switch-on"></span>
                                                        <span class="switch-off"></span>
                                                    </span>
                                                    <span class="switch-label"><?= $tax->name_tax ?></span>
                                                </label>
                                            </div>
                                            <?php endforeach ?>
                                    <?php endforeach ?>
                                </div>
                                <!-- <div class="mb-5 d-flex justify-content-center my-6 gap-2">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" id="addEventBtn" class="btn btn-primary btn-add-event me-4">
                                            Guardar
                                        </button>
                                        <button
                                            type="reset"
                                            class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
                                            data-bs-dismiss="offcanvas">
                                            Cancelar
                                        </button>
                                    </div>
                                    <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javaScripts'); ?>
    <script src="<?= base_url(['assets/js/company-notify.js']) ?>"></script>
<?= $this->endSection(); ?>