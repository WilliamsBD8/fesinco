<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreditsStatus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'name'      => ['type' => 'VARCHAR', 'constraint' => 255,  'null' => TRUE],
            'created_at'=> ['type' => 'DATETIME', 'null' => TRUE],
            'updated_at'=> ['type' => 'DATETIME', 'null' => TRUE]
        ]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('credit_status');
    }

    public function down()
    {
		$this->forge->dropTable('credit_status');
    }
}
