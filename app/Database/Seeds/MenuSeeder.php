<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = array(
            ['option' => 'Impuestos','url' => 'category_taxes','icon' => 'ri-exchange-2-line','position' => '1','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => 'Categoria de impuestos','description' => NULL,'table' => 'category_taxes'],
            ['option' => 'Empresas','url' => 'companies','icon' => NULL,'position' => '1','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'companies']
        );
        $m_model = new Menu();
        foreach ($menus as $key => $menu) {
            $m_model->save($menu);
        }
    }
}
