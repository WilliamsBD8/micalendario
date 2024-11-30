<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Companies extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'user_id'           => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'municipality_id'   => ['type' => 'BIGINT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'name'              => ['type' => 'VARCHAR', 'constraint' => 255],
            'nit'               => ['type' => 'VARCHAR', 'constraint' => 9],
            'emails'            => ['type' => 'TEXT', 'null' => TRUE],
            'first_working_day' => ['type' => 'BOOLEAN', 'default' => FALSE],
            'three_days_due'    => ['type' => 'BOOLEAN', 'default' => FALSE],
            'due_date'          => ['type' => 'BOOLEAN', 'default' => FALSE],
            'status'            => ['type' => 'ENUM("active", "inactive")', 'default' => 'active'],
            'created_at'        => ['type' => 'DATETIME', 'null' => TRUE],
            'updated_at'        => ['type' => 'DATETIME', 'null' => TRUE]
        ]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->addForeignKey('municipality_id', 'municipalities', 'id');
		$this->forge->createTable('companies');
    }

    public function down()
    {
        $this->forge->dropTable('companies');
    }
}
