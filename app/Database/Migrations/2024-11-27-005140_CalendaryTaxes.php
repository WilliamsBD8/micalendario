<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CalendaryTaxes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'category_tax_id'   => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'name'              => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'       => ['type' => 'TEXT'],
            'period'            => ['type' => 'ENUM("Mensual","Bimestral","Trimestral","Cuatrimestral","Anual")'],
            'code'              => ['type' => 'VARCHAR', 'constraint' => 255],
            'color'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'template'          => ['type' => 'INT', 'constraint' => 3, 'default' => 0],
            'created_at'        => ['type' => 'DATETIME', 'null' => TRUE],
            'updated_at'        => ['type' => 'DATETIME', 'null' => TRUE]
        ]);
        $this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('category_tax_id', 'category_taxes', 'id');
        $this->forge->createTable('calendary_taxes');
    }

    public function down()
    {
        $this->forge->dropTable('calendary_taxes');
    }
}
