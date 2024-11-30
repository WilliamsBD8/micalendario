<?= $this->extend("landings/layouts/new_main") ?>

<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/typeahead-js/typeahead.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/quill/katex.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/quill/editor.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />

    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/tagify/tagify.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/bootstrap-select/bootstrap-select.css']) ?>" />

<link rel="stylesheet" href="<?= base_url(['assets/vendor/css/pages/app-email.css']) ?>" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="layout-page">
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                

                <div class="app-email card">
                    <div class="border-0">
                        <div class="row g-0">
                            <!-- Email Sidebar -->


                            <div class="col app-email-sidebar border-end flex-grow-0" id="app-email-sidebar">
                                <div class="btn-compost-wrapper d-grid py-0 pt-4">
                                    <h6 class="mt-5">Consulta el calendario de tu empresa</h6>
                                    <form action="<?= base_url() ?>" method="POST" onsubmit="validateForm(event)"> <!-- onSubmit="findNit(event)" -->
                                        <div class="input-group">
                                            <input type="text" onkeyup="formatNumeric(this, 10)" onblur="$('#btn-send-filter').click()" value="<?= session('filter')->nit->number ?>" class="form-control" placeholder="Nit" aria-label="Nit" name="nit" id="nit" aria-describedby="button-addon2">
                                        </div>
                                        <br>
                                        <!-- <hr> -->
                                        <div class="form-floating form-floating-outline">
                                            <select id="anio-tax" class="select2 form-select form-select-lg" name="anio" onchange="$('#btn-send-filter').click()">
                                                <?php foreach ($dates as $key => $date): ?>
                                                    <option <?= isset(session('filter')->anio) ? (session('filter')->anio == $date->anio ? 'selected' : '') : '' ?> value="<?= $date->anio ?>"><?= $date->anio ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <label for="anio-tax">Año</label>
                                        </div>
                                        <br>
                                        <div class="form-floating form-floating-outline" id="div-select-mounth">
                                            <select
                                                id="mes-tax"
                                                class="select2 form-select form-select-lg"
                                                data-allow-clear="true" data-default="Seleccionar mes" name="mes" onchange="$('#btn-send-filter').click()">
                                                <option value="" selected>Seleccionar mes</option>
                                                <?php foreach($dates as $date): ?>
                                                    <?php if($date->anio == session('filter')->anio): ?>
                                                        <?php foreach($date->meses as $mes): ?>
                                                            <option <?= isset(session('filter')->mes) ? (session('filter')->mes == $mes ? 'selected' : '') : '' ?> value="<?= $mes ?>"><?= meses()[$mes - 1] ?></option>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                <?php endforeach ?>
                                            </select>
                                            <label for="mes-tax">Mes</label>
                                        </div>
                                        <div class="d-grid gap-2 col-lg-12 mx-auto mt-4 d-none">
                                            <button type="submit" class="btn btn-outline-primary waves-effect mx-0" id="btn-send-filter"><i class="tf-icons ri-search-line me-md-0"></i> Buscar</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Email Filters -->
                                <div class="email-filters pt-4 pb-2">
                                    <!-- Email Filters: Folder -->

                                    <div class="nav-align-left border-top">
                                        <ul class="nav nav-tabs w-100 ul-primary" role="tablist">
                                            <li class="nav-item d-flex justify-content-between align-items-center mb-1">
                                                <button
                                                type="button"
                                                class="nav-link active d-flex flex-wrap align-items-center"
                                                role="tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#navs-left-home"
                                                aria-controls="navs-left-home"
                                                aria-selected="true">
                                                    <!-- <i class="ri-mail-line ri-20px"></i> -->
                                                    <span class="align-middle ms-2">General</span>
                                                </button>
                                                <?php 
                                                    $count_total = 0;
                                                    foreach($category_taxes as $key => $tax){
                                                        $count_total += count($tax->calendary);
                                                    }
                                                ?>
                                                <div class="badge bg-label-primary rounded-pill mx-2"><?= $count_total ?></div>
                                            </li>
                                            <?php foreach($category_taxes as $key => $tax): ?>
                                                <li class="nav-item d-flex justify-content-between align-items-center mb-1">
                                                    <button
                                                    type="button"
                                                    class="nav-link d-flex flex-wrap <?= count($tax->calendary) == 0 ? 'disabled' : '' ?> align-items-center"
                                                    role="tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#tax-<?= $tax->id ?>"
                                                    aria-controls="tax-<?= $tax->id ?>"
                                                    aria-selected="true">
                                                        <!-- <i class="ri-mail-line ri-20px"></i> -->
                                                        <span class="align-middle ms-2"><?= $tax->name ?></span>
                                                    </button>
                                                    <div class="badge bg-label-primary rounded-pill mx-2"><?= count($tax->calendary) ?></div>
                                                </li>
                                            <?php endforeach ?>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--/ Email Sidebar -->

                            <!-- Emails List -->
                            <div class="col app-emails-list" style="width: 70%" >
                                <div class="card shadow-none border-0 rounded-0 w-80">
                                    <div class="card-body emails-list-header p-3 py-2">
                                        <!-- Email List: Search -->
                                        <div class="d-flex justify-content-between align-items-center px-3 mt-2">
                                            <div class="d-flex align-items-center w-100">
                                                <i class="ri-menu-line ri-24px cursor-pointer d-block d-lg-none me-4 mb-4"
                                                    data-bs-toggle="sidebar"
                                                    data-target="#app-email-sidebar"
                                                    data-overlay></i>
                                                <div class="w-100 slide-in">
                                                        
                                                    <div class="col-md-12 col-xxl-12 mb-5">
                                                        <div class="">
                                                            <div class="d-flex row">
                                                                <div class="col-lg-8 col-sm-12 order-2 order-md-1">
                                                                    <div class="card-body">
                                                                        <h4 class="text-center text-primary fw-semibold"><?= session()->get('user-calendar') ? "Hola ".session('user-calendar')->name : "" ?> Bienvenido a <span class="fw-bold">Micalendario Tributario</span></h4>
                                                                        <h5 class="card-title mb-4"><?= isset(configInfo()['description']) ? configInfo()['description'] : 'Donde encontrará el calendario de todos los impuestos de Colombia.' ?></h5>
                                                                        <?php if(session('filter')->nit->number != ''): ?>
                                                                            <h5 class="card-title">Este es el calendario tributario para el <span class="fw-bold">NIT <?= session('filter')->nit->number ?></span></h5>
                                                                        <?php endif ?>
                                                                        <!-- <p>Check your new badge in your profile.</p> -->
                                                                        <!-- <a href="javascript:;" class="btn btn-primary waves-effect waves-light">View Profile</a> -->
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4 col-sm-12 text-center text-md-end order-1 order-md-2">
                                                                    <div class="bg-label-primary text-center mb-6 pt-2 rounded-3">
                                                                        <img class="img-fluid w-px-120" src="<?= base_url(['assets/img/illustrations/faq-illustration.png']) ?>" alt="Boy card image">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr class="container-m-nx m-0" /> 
                                                    </div>
                                                    <div id="title-tab" class="text-center container section-title aos-init aos-animate pb-0" data-aos="fade-up">
                                                        <h2>General</h2>
                                                        <p><?= session('filter')->mes != "" ? meses()[session('filter')->mes - 1]." - " : '' ?><?= session('filter')->anio ?> </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <hr class="container-m-nx m-0" /> -->
                                    <!-- Email List: Items -->
                                    <div class="pt-0 w-80">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="navs-left-home">
                                                <?php foreach($category_taxes as $key => $tax): ?>
                                                    <?php foreach($tax->calendary as $calendary): ?>
                                                        <div class="card mb-5">
                                                            <div class="card-body">
                                                                <div class="slide-in" id="title-tab">
                                                                    <div class="divider my-0">
                                                                        <div class="divider-text">
                                                                            <div class="text-center container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                                                                <h2><?= $calendary->name ?></h2>
                                                                                <p><?= $calendary->description ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php switch ($calendary->template):
                                                                    case '1': ?>
                                                                        <?= view('landings/templates/template_2', [
                                                                            'data' => $calendary
                                                                        ]) ?>
                                                                        <?php break; ?>
                                                                    
                                                                <?php default: ?>
                                                                        <?= view('landings/templates/template_1', [
                                                                            'data' => $calendary
                                                                        ]) ?>
                                                                        <?php break; ?>
                                                                <?php endswitch ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>
                                                <?php endforeach ?>
                                            </div>
                                            <?php foreach($category_taxes as $key => $tax): ?>
                                                <div class="tab-pane fade"id="tax-<?= $tax->id ?>">
                                                    <?php foreach($tax->calendary as $calendary): ?>
                                                        <div class="card mb-5">
                                                            <div class="card-body">
                                                                <div class="slide-in" id="title-tab">
                                                                    <div class="divider my-0">
                                                                        <div class="divider-text">
                                                                            <div class="text-center container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                                                                <h2><?= $calendary->name ?></h2>
                                                                                <p><?= $calendary->description ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php switch ($calendary->template):
                                                                    case '1': ?>
                                                                        <?= view('landings/templates/template_2', [
                                                                            'data' => $calendary
                                                                        ]) ?>
                                                                        <?php break; ?>
                                                                    
                                                                <?php default: ?>
                                                                        <?= view('landings/templates/template_1', [
                                                                            'data' => $calendary
                                                                        ]) ?>
                                                                        <?php break; ?>
                                                                <?php endswitch ?>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="app-overlay"></div>
                            </div>
                            <!-- /Emails List -->
                        </div>
                    </div>

                    <!-- Compose Email -->
                    <div
                    class="app-email-compose modal"
                    id="emailComposeSidebar"
                    tabindex="-1"
                    aria-labelledby="emailComposeSidebar"
                    aria-hidden="true">
                        <div class="modal-dialog m-0 me-md-6 mb-6 modal-lg">
                            <div class="modal-content p-0">
                            <div class="modal-header py-5 justify-content-between">
                                <h5 class="modal-title text-body fs-5">Compose Mail</h5>
                                <div class="d-flex align-items-center gap-2">
                                <span class="btn btn-sm btn-icon btn-text-secondary"
                                    ><i class="ri-subtract-line ri-20px"></i
                                ></span>
                                <button
                                    type="button"
                                    class="btn-close me-2"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                            </div>
                            <div class="modal-body flex-grow-1 pb-sm-0 p-5 py-2">
                                <form class="email-compose-form">
                                <div class="email-compose-to d-flex justify-content-between align-items-center">
                                    <label class="fw-medium mb-1 text-muted" for="emailContacts">To:</label>
                                    <div class="select2-primary border-0 shadow-none flex-grow-1 mx-2">
                                    <select
                                        class="select2 select-email-contacts form-select"
                                        id="emailContacts"
                                        name="emailContacts"
                                        multiple>
                                        <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                                        <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                                        <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                                        <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                                        <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                                        <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
                                    </select>
                                    </div>
                                    <div class="email-compose-toggle-wrapper">
                                    <a class="email-compose-toggle-cc text-body" href="javascript:void(0);">Cc |</a>
                                    <a class="email-compose-toggle-bcc text-body" href="javascript:void(0);">Bcc</a>
                                    </div>
                                </div>

                                <div class="email-compose-cc d-none">
                                    <hr class="mx-n5 my-0" />
                                    <div class="d-flex align-items-center">
                                    <label for="email-cc" class="fw-medium text-muted">Cc:</label>
                                    <input
                                        type="text"
                                        class="form-control border-0 shadow-none flex-grow-1 mx-2"
                                        id="email-cc"
                                        placeholder="someone@email.com" />
                                    </div>
                                </div>
                                <div class="email-compose-bcc d-none">
                                    <hr class="mx-n5 my-0" />
                                    <div class="d-flex align-items-center">
                                    <label for="email-bcc" class="fw-medium text-muted">Bcc:</label>
                                    <input
                                        type="text"
                                        class="form-control border-0 shadow-none flex-grow-1 mx-2"
                                        id="email-bcc"
                                        placeholder="someone@email.com" />
                                    </div>
                                </div>
                                <hr class="mx-n5 my-0" />
                                <div class="email-compose-subject d-flex align-items-center">
                                    <label for="email-subject" class="fw-medium text-muted">Subject:</label>
                                    <input
                                    type="text"
                                    class="form-control border-0 shadow-none flex-grow-1 mx-2"
                                    id="email-subject" />
                                </div>
                                <div class="email-compose-message">
                                    <hr class="mx-n5 my-0" />
                                    <div class="d-flex justify-content-end mx-n1">
                                    <div class="email-editor-toolbar border-0 w-100 px-0">
                                        <span class="ql-formats me-0">
                                        <button class="ql-bold"></button>
                                        <button class="ql-italic"></button>
                                        <button class="ql-underline"></button>
                                        <button class="ql-list" value="ordered"></button>
                                        <button class="ql-list" value="bullet"></button>
                                        <button class="ql-link"></button>
                                        <button class="ql-image"></button>
                                        </span>
                                    </div>
                                    </div>
                                    <hr class="mx-n5 my-0" />
                                    <div class="email-editor border-0 mx-n5"></div>
                                </div>
                                <hr class="mx-n5 mt-0 mb-2" />
                                <div class="email-compose-actions d-flex justify-content-between align-items-center my-4">
                                    <div class="d-flex align-items-center">
                                    <div class="btn-group">
                                        <button type="reset" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">
                                        Send
                                        </button>
                                        <button
                                        type="button"
                                        class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">Schedule send</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Save draft</a></li>
                                        </ul>
                                    </div>
                                    <label for="attach-file" class="btn btn-sm btn-icon btn-text-secondary rounded-pill ms-4"
                                        ><i class="ri-attachment-2 ri-20px cursor-pointer"></i
                                    ></label>
                                    <input type="file" name="file-input" class="d-none" id="attach-file" />
                                    </div>
                                    <div class="d-flex align-items-center gap-4">
                                    <div class="dropdown">
                                        <button
                                        class="btn btn-sm btn-icon btn-text-secondary rounded-pill p-0"
                                        type="button"
                                        id="dropdownMoreActions"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="ri-more-2-line ri-20px"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMoreActions">
                                        <li><button type="button" class="dropdown-item">Add Label</button></li>
                                        <li><button type="button" class="dropdown-item">Plain text mode</button></li>
                                        <li>
                                            <hr class="dropdown-divider" />
                                        </li>
                                        <li><button type="button" class="dropdown-item">Print</button></li>
                                        <li><button type="button" class="dropdown-item">Check Spelling</button></li>
                                        </ul>
                                    </div>
                                    <button
                                        type="reset"
                                        class="btn btn-sm btn-icon btn-text-secondary rounded-pill"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i class="ri-delete-bin-7-line ri-20px"></i>
                                    </button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Compose Email -->
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

    <!-- Vendors JS -->
    <script src="<?= base_url(['assets/vendor/libs/quill/katex.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/quill/quill.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/select2/select2.js']) ?>"></script>
    <script src="<?= base_url(['assets/vendor/libs/block-ui/block-ui.js']) ?>"></script>

    <!-- Page JS -->
    <!-- <script src="<?= base_url(['assets/js/app-email.js']) ?>"></script> -->

    <script>
        const filter = <?= json_encode(session('filter')) ?>;
        const dates = <?= json_encode($dates) ?>;
    </script>
    <script src="<?= base_url(['assets/js/forms-selects.js']) ?>"></script>
    <script src="<?= base_url(['assets/js/calendar.js']) ?>"></script>
<?= $this->endSection() ?>