<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Línea de Tiempo</title>
    <?php
        $color_primary = isset(configInfo()['primary_color']) && !empty(configInfo()['primary_color']) ? (string) configInfo()['primary_color'] : '8e24aa';
        $secondary_color = isset(configInfo()['secundary_color']) && !empty(configInfo()['secundary_color']) ? (string) configInfo()['secundary_color'] : 'ff6e40';
        $color_primary = "$color_primary";
    ?>
  <style>.timeline,.timeline .container,.timeline-group{position:relative}.timeline-date,h1{text-align:center}body{font-family:Arial,sans-serif;margin:0;padding:0;background-color:#f5f5f5;color:#333}.timeline-event h3,h1{color:#<?= $color_primary ?>}h1{margin:20px 0;font-size:1.8em}.timeline{max-width:700px;margin:0 auto;padding:20px}.timeline-group{margin-bottom:20px}.timeline-date,.timeline-event{margin-bottom:10px}.timeline-date{color: #<?= $color_primary ?>;padding:5px 10px;border-radius:5px;font-weight:700;display:inline-block; background: rgba(<?= hexToRgb($color_primary)?>, .05)}.timeline-events{background:#fff;border:1px solid #ddd;padding:10px 15px;border-radius:5px;box-shadow:0 2px 4px rgba(0,0,0,.1)}.timeline-event:last-child{margin-bottom:0}.timeline-event h3{font-size:1.1em;margin:0 0 5px}.timeline-event p{font-size:.9em;margin:0;color:#555}.timeline .container::before{content:'';position:absolute;width:3px;background:#ddd;top:0;bottom:0;left:50%;transform:translateX(-50%);z-index:0}</style>
</head>
<body>
    <section class="timeline">
        <h1>Próximas fechas de pago</h1>
        <p style="
    font-size: 18px;
">Hola <b><?= $company->user_name ?></b>, ten presente las siguientes fechas para pagar tus impuestos.</p>
        <div class="container">
            <!-- Grupo de eventos para una fecha -->
            <?php foreach($taxes as $dte => $taxs): ?>
                <?php
                    $datetime = new DateTime($dte);

                    // Extraer d��a y mes
                    $diaSemana = $dias[$datetime->format('w')];
                    $dia = $datetime->format('d');
                    $mes = meses()[(int) $datetime->format('m') - 1];
                    $anio = $datetime->format('Y');   
                ?>
                <div class="timeline-group">
                    <div class="timeline-date" style="padding: 10px 15px;"><?= "{$diaSemana}, {$dia} de {$mes} de {$anio}" ?></div>
                    <div class="timeline-events">
                    <?php foreach($taxs as $tax): ?>
                        <div class="timeline-event">
                            <h3><b>Impuesto: </b><?= $tax->name ?></h3>
                            <p><b>Descripción: </b><?= $tax->description ?></p>
                            <p><b>Periodo:</b> <?= $tax->detail_period ?></p>
                        </div>
                    <?php endforeach ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
</body>
</html>
