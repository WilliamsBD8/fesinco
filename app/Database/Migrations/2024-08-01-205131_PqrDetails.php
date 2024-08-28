<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PqrDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'user_id'           => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'pqr_id'            => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'observation'       => ['type' => 'TEXT'],
            'created_at'        => ['type' => 'DATETIME', 'null' => TRUE],
            'updated_at'        => ['type' => 'DATETIME', 'null' => TRUE]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->addForeignKey('pqr_id', 'pqrs', 'id');
        $this->forge->createTable('pqr_details');
    }

    public function down()
    {
		$this->forge->dropTable('pqr_details');
    }
}
