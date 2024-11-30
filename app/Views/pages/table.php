<?= $this->extend('layouts/page'); ?>

<?= $this->section('styles'); ?>
    <link rel="stylesheet" href="<?= base_url(["grocery-crud/css/jquery-ui/jquery-ui.css"]) ?> ">
    <link rel="stylesheet" href="<?= base_url(["grocery-crud/css/grocery-crud-v2.8.1.0659b25.css"]) ?> ">
    <!-- <link rel="stylesheet" href="<?= base_url(["grocery-crud/css/bootstrap/bootstrap.css"]) ?> "> -->
    <script src="<?= base_url(["assets/ckeditor/ckeditor.js"]) ?> "></script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-6">
    <!-- Gamification Card -->
        <?php if(!empty($title) || !empty($dubtitle)): ?>
            <div class="col-md-12 col-xxl-12">
                <div class="card">
                    <div class="d-flex align-items-end row mb-2">
                        <div class="col-md-12">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-<?= $back != '' ? '10' : '12' ?> col-md-<?= $back != '' ? '6' : '12' ?> col-sm-12">
                                        <h4 class="card-title mb-0"><?= $title ?></h4>
                                        <p class="mb-0"><?= $subtitle ?></p>
                                    </div>
                                    <?php if(!empty($back)): ?>
                                        <div class="col-lg-2 col-md-6 col-sm-12 d-flex justify-content-end">
                                            <a href="<?= base_url(["table", $back]) ?>" class="btn rounded-pill btn-label-primary btn-fab demo waves-effect">
                                                <span class="tf-icons ri-arrow-left-s-line ri-16px me-2"></span> Regresar
                                            </a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <?=  $output ?>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->section('javaScripts'); ?>

    <script src="<?= base_url(["grocery-crud/js/libraries/ckeditor/ckeditor.adapter-jquery.js"]) ?>"></script>
    <script src="<?= base_url(["grocery-crud/js/libraries/jquery-ui.js"]) ?>"></script>
    <script src="<?= base_url(["grocery-crud/js/build/grocery-crud-v2.8.1.0659b25.js"]) ?>"></script>
    <script src="<?= base_url(["grocery-crud/js/build/load-grocery-crud.js"]) ?>"></script>
<?= $this->endSection(); ?>

<!-- <= view('layouts/header') ?>
<= view('layouts/navbar_horizontal') ?>
<= view('layouts/navbar_vertical') ?> -->

<!-- BEGIN: Page Main-->
<!-- <div id="main">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title"><?= $title ?></h4>
                            <p><?= $subtitle ?></p>
                                <?=  $output ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<= view('layouts/footer') ?> -->
