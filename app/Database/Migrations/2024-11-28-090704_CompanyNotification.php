<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CompanyNotification extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'company_id'   => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'calendary_tax_id'   => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'created_at'        => ['type' => 'DATETIME', 'null' => TRUE],
            'updated_at'        => ['type' => 'DATETIME', 'null' => TRUE]
        ]);
        $this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('calendary_tax_id', 'calendary_taxes', 'id');
		$this->forge->addForeignKey('company_id', 'companies', 'id');
        // $this->forge->createTable('company_notifications');
    }

    public function down()
    {
        $this->forge->dropTable('company_notifications');
    }
}
