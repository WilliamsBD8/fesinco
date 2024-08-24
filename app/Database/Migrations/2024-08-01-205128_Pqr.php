<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pqr extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'user_id'           => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'observation'       => ['type' => 'TEXT'],
            'status'            => ['type' => 'ENUM("Por revisar", "Revisado")', 'default' => 'Por revisar'],
            'type'              => ['type' => 'ENUM("Petición", "Queja", "Reclamo", "Sugerencia")', 'default' => 'Petición'],
            'created_at'        => ['type' => 'DATETIME', 'null' => TRUE],
            'updated_at'        => ['type' => 'DATETIME', 'null' => TRUE]
        ]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->createTable('pqrs');
    }

    public function down()
    {
		$this->forge->dropTable('pqrs');
    }
}
