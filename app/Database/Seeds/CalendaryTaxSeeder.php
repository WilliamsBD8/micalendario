<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CalendaryTaxes;

class CalendaryTaxSeeder extends Seeder
{
    public function run()
    {
        $ct_model = new CalendaryTaxes();
        $calendary_taxes = [
            ['name' => 'Renta PN','description' => 'Renta y Complementarios PN','period' => 'Anual','code' => '001','color' => 'red'],
            ['name' => 'Renta GC','description' => 'Renta y Complementarios GC','period' => 'Anual','code' => '002','color' => 'pink'],
            ['name' => 'Renta PJ','description' => 'Renta y Complementarios PJ','period' => 'Anual','code' => '003','color' => 'purple'],
            ['name' => 'Patrimonio','description' => 'Impuesto al patrimonio','period' => 'Anual','code' => '011','color' => 'deep-purple'],
            ['name' => 'Normalizacion','description' => 'Impuesto de normalización tributaria','period' => 'Anual','code' => '012','color' => 'indigo'],
            ['name' => 'Riqueza','description' => 'Impuesto a la Riqueza y su Complementario de Normalización Tributaria','period' => 'Anual','code' => '013','color' => 'blue'],
            ['name' => 'Activos Exterior PJ','description' => 'Activos en el exterior','period' => 'Anual','code' => '014','color' => 'light-blue'],
            ['name' => 'Activos Exterior PN','description' => 'Activos en el exterior','period' => 'Anual','code' => '015','color' => 'cyan'],
            ['name' => 'Activos Exterior GC','description' => 'Activos en el exterior','period' => 'Anual','code' => '016','color' => 'teal'],
            ['name' => 'Activos Exterior RS','description' => 'Activos en el exterior','period' => 'Anual','code' => '017','color' => 'green'],
            ['name' => 'Beneficiarios Finales','description' => 'Declaracion de beneficiarios finales','period' => 'Trimestral','code' => '018','color' => 'light-green'],
            ['name' => 'Precios transferencia Info','description' => 'Declaracion de precios de transferencia Informativa','period' => 'Anual','code' => '019','color' => 'lime'],
            ['name' => 'Precios transferencia Comp','description' => 'Declaracion de precios de transferencia Comprobatoria','period' => 'Anual','code' => '020','color' => 'yellow'],
            ['name' => 'IVA Bimestral','description' => 'Impuesto a las ventas (IVA) Bimestral','period' => 'Bimestral','code' => '021','color' => 'green'],
            ['name' => 'IVA Cuatrimestral','description' => 'Impuesto a las ventas (IVA) Cuatrimestral','period' => 'Cuatrimestral','code' => '022','color' => 'orange'],
            ['name' => 'IVA Anual RST','description' => 'Impuesto a las ventas (IVA) Anual','period' => 'Anual','code' => '023','color' => 'deep-orange'],
            ['name' => 'IVA Prestadores Exterior','description' => 'Impuesto a las ventas (IVA) prestación de servicios desde el Exterior','period' => 'Bimestral','code' => '024','color' => 'brown'],
            ['name' => 'PES_Declaracion','description' => 'PRESENCIA ECONÓMICA SIGNIFICATIVA - PES','period' => 'Anual','code' => '031','color' => 'grey'],
            ['name' => 'PES_Anticipo','description' => 'PRESENCIA ECONÓMICA SIGNIFICATIVA - PES','period' => 'Bimestral','code' => '032','color' => 'blue-grey'],
            ['name' => 'Retefuente','description' => 'Retención Renta y Autorretenciones Renta','period' => 'mensual','code' => '041','color' => 'red'],
            ['name' => 'Anticipo RS','description' => 'Anticipo Regimen Simple de Tributación','period' => 'Bimestral','code' => '051','color' => 'pink'],
            ['name' => 'Simple Consolidado Anual','description' => 'Impuesto  unificado  bajo  el  régimen  simple  de tributación - Simple','period' => 'Anual','code' => '052','color' => 'purple'],
            ['name' => 'Ipoconsumo R. Ordinario','description' => 'Impuesto al Consumo','period' => 'Bimestral','code' => '061','color' => 'deep-purple'],
            ['name' => 'Ipoconsumo R. Simple','description' => 'Impuesto al Consumo Anual Régimen Simplificado','period' => 'Anual','code' => '062','color' => 'indigo'],
            ['name' => 'Ipoconsumo Immuebles','description' => 'Retención impuesto nacional al consumo de bienes inmuebles','period' => 'mensual','code' => '063','color' => 'blue'],
            ['name' => 'ICA Bimestral','description' => 'Industria y comercio Bogotá','period' => 'Bimestral','code' => '0101','color' => 'light-blue'],
            ['name' => 'ICA Anual preferencial','description' => 'Industria y comercio Bogotá','period' => 'Anual','code' => '0102','color' => 'cyan'],
            ['name' => 'ICA Anual Reg Comun','description' => 'Industria y comercio Bogotá','period' => 'Anual','code' => '0103','color' => 'teal'],
            ['name' => 'Informacion Exogena Nal','description' => 'Informacion Exogena Nacional','period' => 'Anual','code' => '0201','color' => 'green'],
            ['name' => 'Informacion Nal Cambiaria Ctas Compensacion','description' => 'Informacion Nacional Cambiaria','period' => 'Anual','code' => '0202','color' => 'light-green'],
            ['name' => 'Informacion Exogena Distrital','description' => 'Informacion Exogena Distrital','period' => 'Anual','code' => '0203','color' => 'lime'],
            ['name' => 'Informacion Exogena Medellin','description' => 'Informacion Exogena Medellin','period' => 'Anual','code' => '0204','color' => 'yellow'],
            ['name' => 'Informacion Exogena Cali','description' => 'Informacion Exogena Cali','period' => 'Anual','code' => '0205','color' => 'amber'],
            ['name' => 'Retencion en la fuente ICA','description' => 'Retencion en la fuente ICA','period' => 'Bimestral','code' => '0206','color' => 'orange']
        ];

        $category = [
            '001' => 1,
            '002' => 1,
            '003' => 1,
            '011' => 2,
            '012' => 2,
            '013' => 2,
            '014' => 2,
            '015' => 2,
            '016' => 2,
            '017' => 2,
            '018' => 2,
            '019' => 2,
            '020' => 2,
            '021' => 3,
            '022' => 3,
            '023' => 3,
            '024' => 3,
            '031' => 4,
            '032' => 4,
            '041' => 5,
            '051' => 6,
            '052' => 6,
            '061' => 7,
            '062' => 7,
            '063' => 7,
            '0101' => 8,
            '0102' => 8,
            '0103' => 8,
            '0201' => 9,
            '0202' => 9,
            '0203' => 9,
            '0204' => 9,
            '0205' => 9,
            '0206' => 9,
        ];

        foreach ($calendary_taxes as $key => $tax) {
            $tax['category_tax_id'] = $category[$tax['code']];
            $ct_model->save($tax);
        }
    }
}
