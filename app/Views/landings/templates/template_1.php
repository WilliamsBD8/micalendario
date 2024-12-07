<?php
    // $data_aux = array_reduce($data->taxes, function ($result, $item) {
    //     $key = $item->description;
    //     if (!isset($result[$key])) {
    //         $result[$key] = (object)[
    //             'title' => $key,
    //             'year' => (int) date('Y', strtotime($item->date)),
    //             'month' => (int) date('m', strtotime($item->date)) - 1,
    //             'details' => []
    //         ];
    //     }
    //     $result[$key]->details[] = $item;
    //     return $result;
    // }, []);
?>

<?php foreach($data->taxes as $tax): ?>
    <div class="pb-5 w-100">
        <h5 class="card-header py-1"><?= $tax->title ?></h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-light table-sm table-borderless">
                <thead>
                    <tr class="">
                        <th colspan="<?= count($tax->details) + 1 ?>"  class="table-primary text-center">Presentación / Pago</th>
                    </tr>
                    <tr>
                        <th class="table-primary">Último dígito del NIT</th>
                        <?php foreach ($tax->details as $key => $dig): ?>
                            <th class="table-primary text-center"><?= $dig->last_digit_nit ?></th>
                        <?php endforeach ?>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <!-- <td class="table-primary">Último dígito del NIT</td>
                        <td class="table-white"></td> -->
                        <td class="table-secondary">Hasta <?= meses()[$tax->month] ?> <?= $tax->year != session('filter')->anio ? $tax->year : '' ?></td>
                        <?php foreach ($tax->details as $key => $dig): ?>
                            <td class="text-center <?= $dig->last_digit_nit == session('filter')->last_dig ? 'table-info':'table-white' ?>"><?= date('d', strtotime($dig->date)) ?></td>
                        <?php endforeach ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
<?php endforeach ?>