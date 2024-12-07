<?php

    // $last_digit_nit = array_reduce($data->taxes, function ($result, $item) {
    //     $key = $item->last_digit_nit;
    //     $result[$key] = $key;
    //     return $result;
    // }, []);

    // $data_aux = array_reduce($data->taxes, function ($result, $item) {
    //     if($item->calendary_tax_id != 28){
    //         $key = $item->detail_period;
    //     }else{
    //         $key = $item->detail_period." (".$item->ubication.")";
    //     }
    //     if (!isset($result[$key])) {
    //         $result[$key] = (object)[
    //             'title' => $key,
    //             'year' => (int) date('Y', strtotime($item->date)),
    //             'month' => (int) date('m', strtotime($item->date)) - 1,
    //             'details' => []
    //         ];
    //         // $result['last_digit_nit_2'] = [];
    //     }
    //     // $result['last_digit_nit_2'][$item->last_digit_nit] = $item->last_digit_nit;
    //     $result[$key]->details[] = $item;
    //     return $result;
    // }, []);
    // var_dump($data_aux);
?>

    <div class="pb-5 w-100">
        <!-- <h5 class="card-header py-1"><= $tax->title ?></h5> -->
        <div class="table-responsive text-nowrap">
            <table class="table table-light table-sm table-borderless">
                <thead>
                    <tr class="">
                        <th rowspan="2" class="center-celda table-primary"><b>Periodo</b></th>
                        <th rowspan="2" class="table-white"></th>
                        <th colspan="<?= count($data->last_digit_nit) + 1 ?>"  class="table-primary text-center">Presentación / Pago</th>
                    </tr>
                    <tr>
                        <th class="table-primary">Último dígito del NIT</th>
                        <?php foreach ($data->last_digit_nit as $key => $dig): ?>
                            <th class="table-primary"><?= $dig ?></th>
                        <?php endforeach ?>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php foreach($data->taxes as $tax): ?>
                        <tr>
                            <td class="table-primary"><?= $tax->title ?></td>
                            <td class="table-white"></td>
                            <td class="table-secondary">Hasta <?= meses()[$tax->month] ?>  <?= $tax->year != session('filter')->anio ? $tax->year : '' ?></td>
                            <?php foreach ($tax->details as $key => $dig): ?>
                                <td class="table-white"><?= date('d', strtotime($dig->date)) ?></td>
                            <?php endforeach ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <br>