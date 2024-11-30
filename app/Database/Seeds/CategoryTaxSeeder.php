<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CategoryTax;

class CategoryTaxSeeder extends Seeder
{
    public function run()
    {
        $ct_model = new CategoryTax();
        $categories = [
            ['name' => 'Renta'],
            ['name' => 'Cambiar Nombre'],
            ['name' => 'IVA'],
            ['name' => 'PES'],
            ['name' => 'Retefuente'],
            ['name' => 'RST'],
            ['name' => 'Ipoconsumo'],
            ['name' => 'ICA'],
            ['name' => 'Informacion']
        ];
        foreach ($categories as $key => $category) {
            $ct_model->save($category);
        }
    }
}
