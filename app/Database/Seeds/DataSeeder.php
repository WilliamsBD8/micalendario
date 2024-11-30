<?php namespace App\Database\Seeds;

class DataSeeder extends \CodeIgniter\Database\Seeder
{
    public function  run()
    {
        $this->call('RoleSeeder');
        $this->call('UserSeeder');
        $this->call('CategoryTaxSeeder');
        $this->call('CalendaryTaxSeeder');
    }
}