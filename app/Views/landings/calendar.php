<?= $this->extend("landings/layouts/main") ?>

<?= $this->section('styles') ?>
<!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css']) ?>" />
  <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/typeahead-js/typeahead.css']) ?>" />
  <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/fullcalendar/fullcalendar.css']) ?>" />
  <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.css']) ?>" />
  <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />
  <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/quill/editor.css']) ?>" />
  <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/@form-validation/form-validation.css']) ?>" />

  <!-- Page CSS -->

  <link rel="stylesheet" href="<?= base_url(['assets/vendor/css/pages/app-calendar.css']) ?>" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container mt-5">
      <div class="content-wrapper mt-10">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="card app-calendar-wrapper">
            <div class="row g-0">
              <!-- Calendar Sidebar -->
              <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
                <div class="px-4">
                  <h6 class="mt-5">Consulta el calendario de tu empresa</h6>
                  <!-- <div class="input-group form-floating form-floating-outline">
                    <input type="text" class="form-control" placeholder="" aria-describedby="button-addon2">
                    <button class="btn btn-outline-primary waves-effect" type="button" id="button-addon2">Button</button>
                  </div> -->
                  <form onSubmit="findNit(event)">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Nit" aria-label="Nit" name="nit" id="nit" aria-describedby="button-addon2">
                      <button type="submit" class="btn btn-outline-primary waves-effect mx-0" type="button" id="button-addon2"><i class="tf-icons ri-search-line me-md-0"></i></button>
                    </div>
                  </form>
                  <hr>

                  <div class="d-flex justify-content-between flex-column nav-align-left">
                    <ul class="nav nav-pills flex-column flex-nowrap">
                      <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#calendar_nacional">
                          <i class="ri-calendar-todo-line me-2"></i>
                          <span class="align-middle">Calendario Nacional</span>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#calendario_cambiario">
                          <i class="ri-calendar-2-line me-2"></i>
                          <span class="align-middle">Calendario Cambiario</span>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#calendar_distrital">
                          <i class="ri-calendar-todo-fill me-2"></i>
                          <span class="align-middle">Calendario Distrital</span>
                        </button>
                      </li>
                    </ul>
                  </div>
                  <hr>

                  <div class="mb-4 ms-1">
                    <h5>Impuestos / Retenciones</h5>
                  </div>

                  <div class="form-check form-check-secondary mb-5 ms-3">
                    <input
                      class="form-check-input select-all"
                      type="checkbox"
                      id="selectAll"
                      data-value="all"
                      checked />
                    <label class="form-check-label" for="selectAll">Ver Todos</label>
                  </div>

                  <div class="app-calendar-events-filter text-heading">
                    <?php foreach ($calendary_taxes as $key => $calendary_tax): ?>
                      <!-- <div class="form-check mb-5 ms-3">
                        <input
                          class="form-check-input <?= $calendary_tax->color ?>-color input-filter"
                          type="checkbox"
                          id="select-<?= $calendary_tax->id ?>"
                          data-value="<?= $calendary_tax->id ?>"
                          data-color="cyan"
                          checked />
                        <label class="form-check-label" for="select-<?= $calendary_tax->id ?>"><?= $calendary_tax->name ?></label>
                      </div> -->
                    <?php endforeach ?>
                  </div>
                </div>
              </div>
              <!-- /Calendar Sidebar -->

              <!-- Calendar & Modal -->
              <div class="col app-calendar-content">
                <div class="card shadow-none border-0">
                  <div class="card-body pb-0 prueba">
                    <!-- FullCalendar -->
                    <div id="calendar"></div>
                  </div>
                </div>
                <div class="app-overlay"></div>


                <!-- FullCalendar Offcanvas -->
                <div
                  class="offcanvas offcanvas-end event-sidebar"
                  tabindex="-1"
                  id="addEventSidebar"
                  aria-labelledby="addEventSidebarLabel">
                  <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="addEventSidebarLabel">Add Event</h5>
                    <button
                      type="button"
                      class="btn-close text-reset"
                      data-bs-dismiss="offcanvas"
                      aria-label="Close"></button>
                  </div>

                  <div class="offcanvas-body">
                    <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                      <div class="form-floating form-floating-outline mb-5">
                        <input
                          type="text"
                          class="form-control"
                          id="eventTitle"
                          name="eventTitle"
                          placeholder="Event Title" />
                        <label for="eventTitle">Title</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-5">
                        <select class="select2 select-event-label form-select" id="eventLabel" name="eventLabel">
                          <option data-label="primary" value="Business" selected>Business</option>
                          <option data-label="danger" value="Personal">Personal</option>
                          <option data-label="warning" value="Family">Family</option>
                          <option data-label="success" value="Holiday">Holiday</option>
                          <option data-label="info" value="ETC">ETC</option>
                        </select>
                        <label for="eventLabel">Label</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-5">
                        <input
                          type="text"
                          class="form-control"
                          id="eventStartDate"
                          name="eventStartDate"
                          placeholder="Start Date" />
                        <label for="eventStartDate">Start Date</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-5">
                        <input
                          type="text"
                          class="form-control"
                          id="eventEndDate"
                          name="eventEndDate"
                          placeholder="End Date" />
                        <label for="eventEndDate">End Date</label>
                      </div>
                      <div class="mb-5">
                        <div class="form-check form-switch">
                          <input type="checkbox" class="form-check-input allDay-switch" id="allDaySwitch" />
                          <label class="form-check-label" for="allDaySwitch">All Day</label>
                        </div>
                      </div>
                      <div class="form-floating form-floating-outline mb-5">
                        <input
                          type="url"
                          class="form-control"
                          id="eventURL"
                          name="eventURL"
                          placeholder="https://www.google.com" />
                        <label for="eventURL">Event URL</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-5 select2-primary">
                        <select
                          class="select2 select-event-guests form-select"
                          id="eventGuests"
                          name="eventGuests"
                          multiple>
                          <option data-avatar="1.png" value="Jane Foster">Jane Foster</option>
                          <option data-avatar="3.png" value="Donna Frank">Donna Frank</option>
                          <option data-avatar="5.png" value="Gabrielle Robertson">Gabrielle Robertson</option>
                          <option data-avatar="7.png" value="Lori Spears">Lori Spears</option>
                          <option data-avatar="9.png" value="Sandy Vega">Sandy Vega</option>
                          <option data-avatar="11.png" value="Cheryl May">Cheryl May</option>
                        </select>
                        <label for="eventGuests">Add Guests</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-5">
                        <input
                          type="text"
                          class="form-control"
                          id="eventLocation"
                          name="eventLocation"
                          placeholder="Enter Location" />
                        <label for="eventLocation">Location</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-5">
                        <textarea class="form-control" name="eventDescription" id="eventDescription"></textarea>
                        <label for="eventDescription">Description</label>
                      </div>
                      <div class="mb-5 d-flex justify-content-sm-between justify-content-start my-6 gap-2">
                        <div class="d-flex">
                          <button type="submit" id="addEventBtn" class="btn btn-primary btn-add-event me-4">
                            Add
                          </button>
                          <button
                            type="reset"
                            class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
                            data-bs-dismiss="offcanvas">
                            Cancel
                          </button>
                        </div>
                        <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
                      </div>
                    </form>
                  </div>
                </div>


                <!-- FullCalendar Offcanvas -->
                <div
                  class="offcanvas offcanvas-end event-sidebar"
                  tabindex="-1"
                  id="register"
                  aria-labelledby="registerLabel">
                  <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="registerLabel">Registrarme</h5>
                    <button
                      type="button"
                      class="btn-close text-reset"
                      data-bs-dismiss="offcanvas"
                      aria-label="Close"></button>
                  </div>

                  <div class="offcanvas-body">
                    <form class="event-form pt-0" id="eventForm" onsubmit="return false">
                      <div class="form-floating form-floating-outline mb-5">
                        <input
                          type="text"
                          class="form-control"
                          id="name"
                          name="name"
                          placeholder="" />
                        <label for="name">Nombre</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-5">
                        <input
                          type="text"
                          class="form-control"
                          id="email"
                          name="email"
                          placeholder="" />
                        <label for="email">Correo</label>
                      </div>
                      <div class="form-floating form-floating-outline mb-5">
                        <input
                          type="text"
                          class="form-control"
                          id="nit"
                          name="nit"
                          placeholder="" />
                        <label for="nit">Nit</label>
                      </div>
                      <div class="divider my-5">
                        <div class="divider-text">Registrate con</div>
                      </div>

                      <div class="d-flex justify-content-center gap-2">
                        <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-facebook">
                          <i class="tf-icons ri-facebook-fill"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-google-plus">
                          <i class="tf-icons ri-google-fill"></i>
                        </a>
                      </div>
                      <div class="mb-5 d-flex justify-content-sm-between justify-content-start my-6 gap-2">
                        <div class="d-flex">
                          <button type="submit" id="addEventBtn" class="btn btn-primary btn-add-event me-4">
                            Registrame
                          </button>
                          <button
                            type="reset"
                            class="btn btn-outline-secondary btn-cancel me-sm-0 me-1"
                            data-bs-dismiss="offcanvas">
                            Cancelar
                          </button>
                        </div>
                        <button class="btn btn-outline-danger btn-delete-event d-none">Delete</button>
                      </div>
                    </form>
                  </div>
                </div>

              </div>
              <!-- /Calendar & Modal -->
               
            </div>
          </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
  <script src="<?= base_url(['assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/libs/hammer/hammer.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/libs/i18n/i18n.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/libs/typeahead-js/typeahead.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/js/menu.js']) ?>"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="<?= base_url(['assets/vendor/libs/fullcalendar/fullcalendar.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/libs/@form-validation/popular.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/libs/@form-validation/bootstrap5.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/libs/@form-validation/auto-focus.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/libs/select2/select2.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/libs/moment/moment.js']) ?>"></script>
  <script src="<?= base_url(['assets/vendor/libs/flatpickr/flatpickr.js']) ?>"></script>

  <script>
    const tax_events = () => <?= json_encode($tax_calendar) ?>;
    // console.log(tax_events());
  </script>

  <!-- Page JS -->
  <!-- <script src="<?= base_url(['assets/js/multimonth/index.global.js']) ?>"></script> -->
  <script src="<?= base_url(['assets/js/app-calendar-events.js']) ?>"></script>
  <script src="<?= base_url(['assets/js/app-calendar.js']) ?>"></script>
  <script src="<?= base_url(['assets/js/calendar.js']) ?>"></script>
<?= $this->endSection() ?>