<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExtractsContributions extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'user_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'null' => TRUE],
			'numero'        => ['type' => 'INT', 'constraint' => 10, 'null' => TRUE],
			'fecha'         => ['type' => 'DATE', 'null' => TRUE],
			'salahoper'     => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'salahopex'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => TRUE],
			'salresesp'     => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'salahovol'     => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'salahopro'     => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'salaportes'    => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'ctaahorro'     => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'ctaaportes'    => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'ctareserva'    => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'total'         => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'cartera'       => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'nivelendeu'    => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
			'salario'       => ['type' => 'VARCHAR', 'constraint' => 10, 'null' => TRUE],
            'fecha_cargue'  => ['type' => 'DATETIME', 'null' => TRUE],
			'status'    	=> ['type' => 'ENUM("Activo", "Inactivo")'],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->createTable('extracts_contributions');
    }

    public function down()
    {
        $this->forge->dropTable('extracts_contributions');
    }
}
