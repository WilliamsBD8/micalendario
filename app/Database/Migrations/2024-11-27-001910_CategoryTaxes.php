<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoryTaxes extends Migration
{
    public function up()
    {
      $this->forge->addField([
          'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
          'name'          => ['type' => 'VARCHAR', 'constraint' => 100],
          'created_at'    => ['type' => 'DATETIME', 'null' => TRUE],
          'updated_at'    => ['type' => 'DATETIME', 'null' => TRUE]
      ]);
      $this->forge->addKey('id', TRUE);
      $this->forge->createTable('category_taxes');
    }

    public function down()
    {
		  $this->forge->dropTable('category_taxes');
    }
}
