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

  
  <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/typeahead-js/typeahead.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/select2/select2.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/tagify/tagify.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/bootstrap-select/bootstrap-select.css']) ?>" />
    <link rel="stylesheet" href="<?= base_url(['assets/vendor/libs/typeahead-js/typeahead.css']) ?>" />

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
              <div class="col-lg-3 col-md-12 col-sm-12 app-calendar-sidebar border-end" id="app-calendar-sidebar">
                <div class="px-4">
                  <h6 class="mt-5">Consulta el calendario de tu empresa</h6>
                  <form onSubmit="findNit(event)">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Nit" aria-label="Nit" name="nit" id="nit" aria-describedby="button-addon2">
                      <button type="submit" class="btn btn-outline-primary waves-effect mx-0" type="button" id="button-addon2"><i class="tf-icons ri-search-line me-md-0"></i></button>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                          <select id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default">
                            <option>2024</option>
                            <option>2023</option>
                          </select>
                          <label for="selectpickerBasic">Año</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                          <select id="mes" class="selectpicker w-100" data-style="btn-default">
                            <?php
                              $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                              ];
                            ?>
                            <option>Ver Todos</option>
                            <?php foreach($meses as $mes): ?>
                              <option><?= $mes ?></option>
                            <?php endforeach ?>
                          </select>
                          <label for="mes">Mes</label>
                        </div>
                      </div>
                    </div>
                  </form>
                  <hr>
                  <div class="d-flex justify-content-between flex-column nav-align-left">
                    <ul class="nav nav-pills flex-column flex-nowrap">
                      <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tax-general">
                          <i class="tf-icons ri-list-indefinite me-2"></i>
                          <span class="align-middle">General - Mes</span>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tax-general-mes">
                          <i class="tf-icons ri-list-indefinite me-2"></i>
                          <span class="align-middle">General - Año</span>
                        </button>
                      </li>
                      <?php foreach ($taxs as $key => $tax): ?>
                        <li class="nav-item">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tax-<?= $tax->id ?>">
                            <?php if(isset($tax->icon)): ?>
                              <i class="tf-icons <?= $tax->icon ?> me-2"></i>
                            <?php endif ?> 
                            <span class="align-middle"><?= $tax->title ?></span>
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger ms-2 pt-50"><?= count($tax->details) ?></span>
                          </button>
                        </li>
                      <?php endforeach ?>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /Calendar Sidebar -->

              <!-- Calendar & Modal -->
              <div class="col-lg-9 col-md-12 col-sm-12">
                <div class="card shadow-none border-0">
                  <div class="card-body pb-0">

                    <div class="tab-content p-0">

                      <div class="tab-pane fade" id="tax-general-mes" role="tabpanel">
                        <div class="text-center container section-title aos-init aos-animate" data-aos="fade-up">
                          <h2>General</h2>
                          <p>2024</p>
                        </div>
                        <?php
                          $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                          ];
                          $renta = (object)[
                            'id' 		=> 1,
                            'title'		=> 'Renta',
                            'icon'		=> 'ri-home-smile-line',
                            'details' 	=> [
                              (object) [
                                'id'	=> 2,
                                'title'	=> 'Retención en la fuente',
                                'sub_details' => [
                                  (object) [
                                    'title' 	=> 'Declaración mensual y pago',
                                    'range'		=> [1, 2, 3, 4, 5, 6, 7, 8, 9, 0],
                                    'tables'	=> [
                                      (object) [
                                        'start' 	=> $meses[0],
                                        'finish'	=> $meses[1],
                                        'dates'		=> explode(" ", "9 12 13 14 15 16 19 20 21 22")
                                      ],
                                      (object) [
                                        'start' 	=> $meses[1],
                                        'finish'	=> $meses[2],
                                        'dates'		=> explode(" ", "11 12 13 14 15 18 19 20 21 22")
                                      ],
                                      (object) [
                                        'start' 	=> $meses[2],
                                        'finish'	=> $meses[3],
                                        'dates'		=> explode(" ", "9 10 11 12 15 16 17 18 19 22")
                                      ],
                                      (object) [
                                        'start' 	=> $meses[3],
                                        'finish'	=> $meses[4],
                                        'dates'		=> explode(" ", "10 14 15 16 17 20 21 22 23 24"),
                                      ],
                                      (object) [
                                        'start' 	=> $meses[4],
                                        'finish'	=> $meses[5],
                                        'dates'		=> explode(" ", "13 14 17 18 19 20 21 24 25 26"),
                                      ],
                                      (object) [
                                        'start' 	=> $meses[5],
                                        'finish'	=> $meses[6],
                                        'dates'		=> explode(" ", "10 11 12 15 16 17 18 19 22 23"),
                                      ],
                                      (object) [
                                        'start' 	=> $meses[6],
                                        'finish'	=> $meses[7],
                                        'dates'		=> explode(" ", "12 13 14 15 16 20 21 22 23 26"),
                                      ],
                                      (object) [
                                        'start' 	=> $meses[7],
                                        'finish'	=> $meses[8],
                                        'dates'		=> explode(" ", "10 11 12 13 16 17 18 19 20 23"),
                                      ],
                                      (object) [
                                        'start' 	=> $meses[8],
                                        'finish'	=> $meses[9],
                                        'dates'		=> explode(" ", "9 10 11 15 16 17 18 21 22 23"),
                                      ],
                                      (object) [
                                        'start' 	=> $meses[9],
                                        'finish'	=> $meses[10],
                                        'dates'		=> explode(" ", "13 14 15 18 19 20 21 22 25 26"),
                                      ],
                                      (object) [
                                        'start' 	=> $meses[10],
                                        'finish'	=> $meses[11],
                                        'dates'		=> explode(" ", "10 11 12 13 16 17 18 19 20 23"),
                                      ],
                                      (object) [
                                        'start' 	=> $meses[11],
                                        'finish'	=> $meses[0],
                                        'dates'		=> explode(" ", "13 14 15 16 17 20 21 22 23 24"),
                                      ]
                                    ]
                                  ]
                                ]
                              ]
                            ]
                          ]
                        ?>
                        <div class="tab-content p-0">
                          <?php foreach($renta->details as $key => $detail): ?>
                            <div class="tab-pane fade <?= $key == 0 ? 'show active' : '' ?>" id="tax-detail-<?= $detail->id ?>" role="tabpanel">
                              <?php foreach ($detail->sub_details as $key => $sub_detail): ?>
                                <div class="col-lg-12 ">
                                  <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                    <h2><?= isset($sub_detail->sub_title) ? $sub_detail->title : $detail->title ?></h2>
                                    <p></p>
                                  </div>
                                  <p><b><?= isset($sub_detail->sub_title) ? $sub_detail->sub_title : $sub_detail->title ?></b></p>
                                  <!-- <p>Declaración mensual y pago</p> -->
                                </div>
                                <div class="row">
                                  <div class="col-lg-<?= $detail->id != 5 ? '12':'9' ?> col-md-12 col-sm-12">
                                    <div class="table-responsive mb-3 text-nowrap">
                                      <table class="table centered table-sm">
                                        <thead class="table-light">
                                          <tr>
                                            <th rowspan="2" class="center-celda"><b>Periodo</b></th>
                                            <th rowspan="2" class="table-white"></th>
                                            <th colspan="<?= count($sub_detail->range) + 1 ?>"  class="table-primary text-center">Presentación / Pago</th>
                                          </tr>
                                          <tr>
                                            <th class="table-primary">Último dígito del NIT</th>
                                            <?php foreach ($sub_detail->range as $key => $dig): ?>
                                              <th class="table-primary"><?= $dig ?></th>
                                            <?php endforeach ?>
                                          </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                          <?php foreach ($sub_detail->tables as $i => $table): ?>
                                            <tr>
                                              <td ><?= $table->start ?></td>
                                              <td class="table-white"></td>
                                              <?php if(isset($table->finish)): ?>
                                                <td class="table-secondary">Hasta <?= $table->finish ?></td>
                                              <?php endif ?>
                                              <?php foreach ($table->dates as $key => $dig): ?>
                                                <td><?= $dig ?></td>
                                              <?php endforeach ?>
                                            </tr>
                                          <?php endforeach ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                              <?php endforeach ?>
                            </div>
                          <?php endforeach ?>
                          <hr>
                          <div class="col-lg-12 ">
                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                              <h2>IVA prestadores de Servicios en el exterior</h2>
                              <p></p>
                            </div>
                            <p>
                              <b>Declaración y pago bimestral:</b><br>Independientemente del Número de Identificación Tributaria - NIT</p>
                          </div>
                          <div class="row g-6">
                            <div class="col-md-6 col-xl-4">
                              <div class="table-responsive mb-3 text-nowrap">
                                <table class="table text-center table-sm">
                                  <thead class="table-light">
                                    <tr class="table-primary">
                                      <th colspan="2">Enero - Febrero</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      <tr>
                                        <td class="table-secondary w-50">Hasta Marzo</td>
                                        <td>14</td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                              <div class="table-responsive mb-3 text-nowrap">
                                <table class="table text-center table-sm">
                                  <thead class="table-light">
                                    <tr class="table-primary">
                                      <th colspan="2">Marzo - Abril</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      <tr>
                                        <td class="table-secondary w-50">Hasta Abril</td>
                                        <td>16</td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                              <div class="table-responsive mb-3 text-nowrap">
                                <table class="table text-center table-sm">
                                  <thead class="table-light">
                                    <tr class="table-primary">
                                      <th colspan="2">Mayo - Junio</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      <tr>
                                        <td class="table-secondary w-50">Hasta Julio</td>
                                        <td>15</td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                              <div class="table-responsive mb-3 text-nowrap">
                                <table class="table text-center table-sm">
                                  <thead class="table-light">
                                    <tr class="table-primary">
                                      <th colspan="2">Julio - Agosto</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      <tr>
                                        <td class="table-secondary w-50">Hasta Septiembre</td>
                                        <td>13</td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                              <div class="table-responsive mb-3 text-nowrap">
                                <table class="table text-center table-sm">
                                  <thead class="table-light">
                                    <tr class="table-primary">
                                      <th colspan="2">Septiembre - Octubre</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      <tr>
                                        <td class="table-secondary w-50">Hasta Noviembre</td>
                                        <td>18</td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                              <div class="table-responsive mb-3 text-nowrap">
                                <table class="table text-center table-sm">
                                  <thead class="table-light">
                                    <tr class="table-primary">
                                      <th colspan="2">Noviembre - Diciembre</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      <tr>
                                        <td class="table-secondary w-50">Hasta Enero</td>
                                        <td>16</td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <hr>
                          <div class="col-lg-12 ">
                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                              <h2>RST (Régimen Simple de Tributación)</h2>
                              <p>Anticipo Bimestral</p>
                            </div>
                            <p><b>Declaración y pago</b></p>
                          </div>
                          <div class="tab-pane fade show active" id="tax-detail-5" role="tabpanel">
                            <div class="row text-center">
                              <div class="col-lg-2">
                                <h5><b>Periodo</b></h5>
                              </div>
                              <div class="col-lg-10">
                                <h5><b>Presentación / Pago</b></h5>
                              </div>
                            </div>
                            <div class="row">
                                            
                                    <div class="col-lg-2 col-md-12 col-sm-12 border-end">
                                      <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                        <h2></h2>
                                        <!-- <br> -->
                                        <p>Enero-Febrero</p>
                                      </div>
                                    </div>
                                    <div class="col-lg-10 col-md-12 col-sm-12">
                                      <div class="table-responsive mb-3 text-nowrap">
                                              <table class="table centered table-sm">
                                                <thead class="table-light">
                                                  <tr class="table-primary">
                                                    <th colspan="2">Último dígito del NIT</th>
                                                                                                          <th>1</th>
                                                                                                          <th>2</th>
                                                                                                          <th>3</th>
                                                                                                          <th>4</th>
                                                                                                          <th>5</th>
                                                                                                          <th>6</th>
                                                                                                          <th>7</th>
                                                                                                          <th>8</th>
                                                                                                          <th>9</th>
                                                                                                          <th>0</th>
                                                                                                      </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                                                                      <tr>
                                                                                                                                                                    <td class="table-secondary" colspan="2">Hasta Marzo</td>
                                                                                                                                                                    <td>11</td>
                                                                                                              <td>12</td>
                                                                                                              <td>13</td>
                                                                                                              <td>14</td>
                                                                                                              <td>15</td>
                                                                                                              <td>18</td>
                                                                                                              <td>19</td>
                                                                                                              <td>20</td>
                                                                                                              <td>21</td>
                                                                                                              <td>22</td>
                                                                                                          </tr>
                                                                                                  </tbody>
                                              </table>
                                            </div>
                                                                                  </div>
                                        <hr>
                                      </div>
                                                                          <div class="row">
                                                                                  <div class="col-lg-2 col-md-12 col-sm-12 border-end">
                                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                              <h2></h2>
                                              <p>Marzo-Abril</p>
                                            </div>
                                          </div>
                                                                                <div class="col-lg-10 col-md-12 col-sm-12">
                                                                                      <div class="table-responsive mb-3 text-nowrap">
                                              <table class="table centered table-sm">
                                                <thead class="table-light">
                                                  <tr class="table-primary">
                                                    <th colspan="2">Último dígito del NIT</th>
                                                                                                          <th>1</th>
                                                                                                          <th>2</th>
                                                                                                          <th>3</th>
                                                                                                          <th>4</th>
                                                                                                          <th>5</th>
                                                                                                          <th>6</th>
                                                                                                          <th>7</th>
                                                                                                          <th>8</th>
                                                                                                          <th>9</th>
                                                                                                          <th>0</th>
                                                                                                      </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                                                                      <tr>
                                                                                                                                                                    <td class="table-secondary" colspan="2">Hasta Mayo</td>
                                                                                                                                                                    <td>10</td>
                                                                                                              <td>14</td>
                                                                                                              <td>15</td>
                                                                                                              <td>16</td>
                                                                                                              <td>17</td>
                                                                                                              <td>20</td>
                                                                                                              <td>21</td>
                                                                                                              <td>23</td>
                                                                                                              <td>24</td>
                                                                                                          </tr>
                                                                                                  </tbody>
                                              </table>
                                            </div>
                                                                                  </div>
                                        <hr>
                                      </div>
                                                                          <div class="row">
                                                                                  <div class="col-lg-2 col-md-12 col-sm-12 border-end">
                                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                              <h2></h2>
                                              <p>Mayo-Junio</p>
                                            </div>
                                          </div>
                                                                                <div class="col-lg-10 col-md-12 col-sm-12">
                                                                                      <div class="table-responsive mb-3 text-nowrap">
                                              <table class="table centered table-sm">
                                                <thead class="table-light">
                                                  <tr class="table-primary">
                                                    <th colspan="2">Último dígito del NIT</th>
                                                                                                          <th>1</th>
                                                                                                          <th>2</th>
                                                                                                          <th>3</th>
                                                                                                          <th>4</th>
                                                                                                          <th>5</th>
                                                                                                          <th>6</th>
                                                                                                          <th>7</th>
                                                                                                          <th>8</th>
                                                                                                          <th>9</th>
                                                                                                          <th>0</th>
                                                                                                      </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                                                                      <tr>
                                                                                                                                                                    <td class="table-secondary" colspan="2">Hasta Julio</td>
                                                                                                                                                                    <td>10</td>
                                                                                                              <td>11</td>
                                                                                                              <td>12</td>
                                                                                                              <td>15</td>
                                                                                                              <td>16</td>
                                                                                                              <td>17</td>
                                                                                                              <td>18</td>
                                                                                                              <td>19</td>
                                                                                                              <td>22</td>
                                                                                                              <td>23</td>
                                                                                                          </tr>
                                                                                                  </tbody>
                                              </table>
                                            </div>
                                                                                  </div>
                                        <hr>
                                      </div>
                                                                          <div class="row">
                                                                                  <div class="col-lg-2 col-md-12 col-sm-12 border-end">
                                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                              <h2></h2>
                                              <p>Julio-Agosto</p>
                                            </div>
                                          </div>
                                                                                <div class="col-lg-10 col-md-12 col-sm-12">
                                                                                      <div class="table-responsive mb-3 text-nowrap">
                                              <table class="table centered table-sm">
                                                <thead class="table-light">
                                                  <tr class="table-primary">
                                                    <th colspan="2">Último dígito del NIT</th>
                                                                                                          <th>1</th>
                                                                                                          <th>2</th>
                                                                                                          <th>3</th>
                                                                                                          <th>4</th>
                                                                                                          <th>5</th>
                                                                                                          <th>6</th>
                                                                                                          <th>7</th>
                                                                                                          <th>8</th>
                                                                                                          <th>9</th>
                                                                                                          <th>0</th>
                                                                                                      </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                                                                      <tr>
                                                                                                                                                                    <td class="table-secondary" colspan="2">Hasta Septiembre</td>
                                                                                                                                                                    <td>10</td>
                                                                                                              <td>11</td>
                                                                                                              <td>12</td>
                                                                                                              <td>13</td>
                                                                                                              <td>16</td>
                                                                                                              <td>17</td>
                                                                                                              <td>18</td>
                                                                                                              <td>19</td>
                                                                                                              <td>20</td>
                                                                                                              <td>23</td>
                                                                                                          </tr>
                                                                                                  </tbody>
                                              </table>
                                            </div>
                                                                                  </div>
                                        <hr>
                                      </div>
                                                                          <div class="row">
                                                                                  <div class="col-lg-2 col-md-12 col-sm-12 border-end">
                                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                              <h2></h2>
                                              <p>Septiembre-Octubre</p>
                                            </div>
                                          </div>
                                                                                <div class="col-lg-10 col-md-12 col-sm-12">
                                                                                      <div class="table-responsive mb-3 text-nowrap">
                                              <table class="table centered table-sm">
                                                <thead class="table-light">
                                                  <tr class="table-primary">
                                                    <th colspan="2">Último dígito del NIT</th>
                                                                                                          <th>1</th>
                                                                                                          <th>2</th>
                                                                                                          <th>3</th>
                                                                                                          <th>4</th>
                                                                                                          <th>5</th>
                                                                                                          <th>6</th>
                                                                                                          <th>7</th>
                                                                                                          <th>8</th>
                                                                                                          <th>9</th>
                                                                                                          <th>0</th>
                                                                                                      </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                                                                      <tr>
                                                                                                                                                                    <td class="table-secondary" colspan="2">Hasta Noviembre</td>
                                                                                                                                                                    <td>13</td>
                                                                                                              <td>14</td>
                                                                                                              <td>15</td>
                                                                                                              <td>18</td>
                                                                                                              <td>19</td>
                                                                                                              <td>20</td>
                                                                                                              <td>21</td>
                                                                                                              <td>22</td>
                                                                                                              <td>25</td>
                                                                                                              <td>26</td>
                                                                                                          </tr>
                                                                                                  </tbody>
                                              </table>
                                            </div>
                                                                                  </div>
                                        <hr>
                                      </div>
                                                                          <div class="row">
                                                                                  <div class="col-lg-2 col-md-12 col-sm-12 border-end">
                                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                              <h2></h2>
                                              <p>Noviembre-Diciembre</p>
                                            </div>
                                          </div>
                                                                                <div class="col-lg-10 col-md-12 col-sm-12">
                                                                                      <div class="table-responsive mb-3 text-nowrap">
                                              <table class="table centered table-sm">
                                                <thead class="table-light">
                                                  <tr class="table-primary">
                                                    <th colspan="2">Último dígito del NIT</th>
                                                                                                          <th>1</th>
                                                                                                          <th>2</th>
                                                                                                          <th>3</th>
                                                                                                          <th>4</th>
                                                                                                          <th>5</th>
                                                                                                          <th>6</th>
                                                                                                          <th>7</th>
                                                                                                          <th>8</th>
                                                                                                          <th>9</th>
                                                                                                          <th>0</th>
                                                                                                      </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                                                                      <tr>
                                                                                                                                                                    <td class="table-secondary" colspan="2">Hasta Enero</td>
                                                                                                                                                                    <td>13</td>
                                                                                                              <td>14</td>
                                                                                                              <td>15</td>
                                                                                                              <td>16</td>
                                                                                                              <td>17</td>
                                                                                                              <td>20</td>
                                                                                                              <td>21</td>
                                                                                                              <td>22</td>
                                                                                                              <td>23</td>
                                                                                                              <td>24</td>
                                                                                                          </tr>
                                                                                                  </tbody>
                                              </table>
                                            </div>
                                                                                  </div>
                                        <hr>
                                      </div>
                                                                      </div>
                        </div>
                      </div>

                      <div class="tab-pane fade active show" id="tax-general" role="tabpanel">
                        <div class="text-center container section-title aos-init aos-animate" data-aos="fade-up">
                          <h2>General</h2>
                          <p>Noviembre - 2024</p>
                        </div>
                        <?php
                          $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
                          ];
                          $renta = (object)[
                            'id' 		=> 1,
                            'title'		=> 'Renta',
                            'icon'		=> 'ri-home-smile-line',
                            'details' 	=> [
                              (object) [
                                'id'	=> 1,
                                'title'	=> 'Retención en la fuente',
                                'sub_details' => [
                                  (object) [
                                    'title' 	=> 'Declaración mensual y pago',
                                    'range'		=> [1, 2, 3, 4, 5, 6, 7, 8, 9, 0],
                                    'tables'	=> [
                                      (object) [
                                        'start' 	=> $meses[9],
                                        'finish'	=> $meses[10],
                                        'dates'		=> explode(" ", "13 14 15 18 19 20 21 22 25 26"),
                                      ],
                                    ]
                                  ]
                                ]
                              ]
                            ]
                          ]
                        ?>
                        <div class="tab-content p-0">
                          <?php foreach($renta->details as $key => $detail): ?>
                            <div class="tab-pane fade <?= $key == 0 ? 'show active' : '' ?>" id="tax-detail-<?= $detail->id ?>" role="tabpanel">
                              <?php foreach ($detail->sub_details as $key => $sub_detail): ?>
                                <div class="row">
                                  <div class="col-lg-12 ">
                                    <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                      <h2><?= isset($sub_detail->sub_title) ? $sub_detail->title : $detail->title ?></h2>
                                      <p></p>
                                    </div>
                                    <p><b><?= isset($sub_detail->sub_title) ? $sub_detail->sub_title : $sub_detail->title ?></b></p>
                                  </div>
                                  <div class="col-lg-<?= $detail->id != 5 ? '12':'9' ?> col-md-12 col-sm-12">
                                    <div class="table-responsive mb-3 text-nowrap">
                                      <table class="table centered table-sm">
                                        <thead class="table-light">
                                          <tr class="table-primary">
                                            <th>Último dígito del NIT</th>
                                            <?php foreach ($sub_detail->range as $key => $dig): ?>
                                              <th><?= $dig ?></th>
                                            <?php endforeach ?>
                                          </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                          <?php foreach ($sub_detail->tables as $i => $table): ?>
                                            <tr>
                                              <?php if(isset($table->finish)): ?>
                                                <td class="table-secondary">Hasta <?= $table->finish ?></td>
                                              <?php endif ?>
                                              <?php foreach ($table->dates as $key => $dig): ?>
                                                <td><?= $dig ?></td>
                                              <?php endforeach ?>
                                            </tr>
                                          <?php endforeach ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                              <?php endforeach ?>
                            </div>
                          <?php endforeach ?>
                          <hr>
                          <hr>

                          <div class="col-lg-12 ">
                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                              <h2>IVA prestadores de Servicios en el exterior</h2>
                              <p></p>
                            </div>
                            <p>
                              <b>Declaración y pago bimestral:</b><br>Independientemente del Número de Identificación Tributaria - NIT</p>
                          </div>

                          <div class="row g-6">
                            <div class="col-md-6 col-xl-12">
                              <div class="table-responsive mb-3 text-nowrap">
                                <table class="table text-center table-sm">
                                  <thead class="table-light">
                                    <tr class="table-primary">
                                      <th colspan="2">Septiembre - Octubre</th>
                                    </tr>
                                  </thead>
                                  <tbody class="table-border-bottom-0">
                                      <tr>
                                        <td class="table-secondary w-50">Hasta Noviembre</td>
                                        <td>18</td>
                                      </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <hr>
                        <hr>

                        <div class="col-lg-12 ">
                                  <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                    <h2>Retención en la fuente</h2>
                                    <p></p>
                                  </div>
                                  <p><b>Declaración mensual y pago</b></p>
                                  <!-- <p>Declaración mensual y pago</p> -->
                                </div>

                        <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="table-responsive mb-3 text-nowrap">
                                      <table class="table centered table-sm">
                                        <thead class="table-light">
                                          <tr>
                                            <th rowspan="2" class="center-celda"><b>Periodo</b></th>
                                            <th rowspan="2" class="table-white"></th>
                                            <th colspan="11" class="table-primary text-center">Presentación / Pago</th>
                                          </tr>
                                          <tr>
                                            <th class="table-primary">Último dígito del NIT</th>
                                                                                          <th class="table-primary">1</th>
                                                                                          <th class="table-primary">2</th>
                                                                                          <th class="table-primary">3</th>
                                                                                          <th class="table-primary">4</th>
                                                                                          <th class="table-primary">5</th>
                                                                                          <th class="table-primary">6</th>
                                                                                          <th class="table-primary">7</th>
                                                                                          <th class="table-primary">8</th>
                                                                                          <th class="table-primary">9</th>
                                                                                          <th class="table-primary">0</th>
                                                                                      </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                                                                      
                                                                                      <tr>
                                              <td>Octubre</td>
                                              <td class="table-white"></td>
                                                                                              <td class="table-secondary">Hasta Noviembre</td>
                                                                                                                                            <td>13</td>
                                                                                              <td>14</td>
                                                                                              <td>15</td>
                                                                                              <td>18</td>
                                                                                              <td>19</td>
                                                                                              <td>20</td>
                                                                                              <td>21</td>
                                                                                              <td>22</td>
                                                                                              <td>25</td>
                                                                                              <td>26</td>
                                                                                          </tr>
                                                                                  </tbody>
                                      </table>
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                      </div>

                      <?php foreach ($taxs as $key => $tax): ?>
                        <div class="tab-pane fade " id="tax-<?= $tax->id ?>" role="tabpanel">
                          <div class="text-center container section-title aos-init aos-animate" data-aos="fade-up">
                            <h2><?= isset($tax->sub_title) ? $tax->title : '' ?></h2>
                            <p><?= isset($tax->sub_title) ? $tax->sub_title : $tax->title ?></p>
                          </div>
                          <div class="col-xl-12">
                            <div class="nav-align-top mb-6">
                              <ul class="nav nav-pills mb-4" role="tablist">
                                <?php foreach($tax->details as $key => $detail): ?>
                                  <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link <?= $key == 0 ? 'active' : '' ?> waves-effect waves-light" role="tab" data-bs-toggle="tab" data-bs-target="#tax-detail-<?= $detail->id ?>" aria-controls="navs-pills-top-home" aria-selected="true">
                                      <?= $detail->title ?>
                                    </button>
                                  </li>
                                <?php endforeach ?>
                              </ul>
                              <hr>
                              <div class="tab-content p-0">
                                <?php foreach($tax->details as $key => $detail): ?>
                                  <div class="tab-pane fade <?= $key == 0 ? 'show active' : '' ?>" id="tax-detail-<?= $detail->id ?>" role="tabpanel">
                                    <?php foreach ($detail->sub_details as $key => $sub_detail): ?>
                                      <div class="row">
                                        <?php if($detail->id != 5): ?>
                                          <div class="col-lg-12 ">
                                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                              <h2><?= isset($sub_detail->sub_title) ? $sub_detail->title : $detail->title ?></h2>
                                              <p><?= isset($sub_detail->sub_title) ? $sub_detail->sub_title : $sub_detail->title ?></p>
                                            </div>
                                          </div>
                                        <?php else: ?>
                                          <div class="col-lg-3 col-md-12 col-sm-12 border-end">
                                            <div class="container section-sub_title aos-init aos-animate" data-aos="fade-up">
                                              <h2></h2>
                                              <p><?= $sub_detail->title ?></p>
                                            </div>
                                          </div>
                                        <?php endif ?>
                                        <div class="col-lg-<?= $detail->id != 5 ? '12':'9' ?> col-md-12 col-sm-12">
                                          <?php if($detail->id == 6): ?>
                                            <div class="row g-6">
                                              <?php foreach($sub_detail->tables as $table): ?>
                                                <div class="col-md-6 col-xl-4">
                                                  <div class="table-responsive mb-3 text-nowrap">
                                                    <table class="table text-center table-sm">
                                                      <thead class="table-light">
                                                        <tr class="table-primary">
                                                          <th colspan="2"><?= $table->title ?></th>
                                                        </tr>
                                                      </thead>
                                                      <tbody class="table-border-bottom-0">
                                                          <tr>
                                                            <td class="table-secondary w-50">Hasta <?= $table->finish ?></td>
                                                            <td><?= $table->dates ?></td>
                                                          </tr>
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                </div>
                                              <?php endforeach ?>
                                            </div>
                                          <?php else: ?>
                                            <div class="table-responsive mb-3 text-nowrap">
                                              <table class="table centered table-sm">
                                                <thead class="table-light">
                                                  <tr class="table-primary">
                                                    <th colspan="2">Último dígito del NIT</th>
                                                    <?php foreach ($sub_detail->range as $key => $dig): ?>
                                                      <th><?= $dig ?></th>
                                                    <?php endforeach ?>
                                                  </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                  <?php foreach ($sub_detail->tables as $i => $table): ?>
                                                    <tr>
                                                      <?php if(isset($table->start)): ?>
                                                        <td class="table-active" <?= isset($table->start) && !isset($table->finish) ? 'colspan="2"' : '' ?>><?= $table->start ?></td>
                                                      <?php endif ?>
                                                      <?php if(isset($table->finish)): ?>
                                                        <td class="table-secondary" <?= !isset($table->start) && isset($table->finish) ? 'colspan="2"' : '' ?>>Hasta <?= $table->finish ?></td>
                                                      <?php endif ?>
                                                      <?php foreach ($table->dates as $key => $dig): ?>
                                                        <td><?= $dig ?></td>
                                                      <?php endforeach ?>
                                                    </tr>
                                                  <?php endforeach ?>
                                                </tbody>
                                              </table>
                                            </div>
                                          <?php endif ?>
                                        </div>
                                        <hr>
                                      </div>
                                    <?php endforeach ?>
                                  </div>
                                <?php endforeach ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php endforeach ?>
                    </div>

                  </div>
                </div>
              </div>
              <!-- /Calendar & Modal -->
               
            </div>
          </div>
        </div>
        <div class="content-backdrop fade"></div>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<script src="<?= base_url([' assets/vendor/libs/select2/select2.js']) ?>"></script>
<script src="<?= base_url([' assets/vendor/libs/tagify/tagify.js']) ?>"></script>
<script src="<?= base_url([' assets/vendor/libs/bootstrap-select/bootstrap-select.js']) ?>"></script>
<script src="<?= base_url([' assets/vendor/libs/typeahead-js/typeahead.js']) ?>"></script>
<script src="<?= base_url([' assets/vendor/libs/bloodhound/bloodhound.js']) ?>"></script>

<script src="<?= base_url(['assets/js/forms-selects.js']) ?>"></script>
<script src="<?= base_url(['assets/js/calendar.js']) ?>"></script>

  <!-- Page JS -->
<?= $this->endSection() ?>