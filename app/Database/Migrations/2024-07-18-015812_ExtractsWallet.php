<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExtractsWallet extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'user_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'null' => TRUE],
			'registro'      => ['type' => 'INT', 'constraint' => 11],
			'feccorte'      => ['type' => 'DATE', 'null' => TRUE],
			'fecsolici'     => ['type' => 'DATE', 'null' => TRUE],
			'fecfinal'      => ['type' => 'DATE', 'null' => TRUE],
			'numero'        => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
			'codigo'        => ['type' => 'VARCHAR', 'constraint' => 10],
			'tasanual'      => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => TRUE],
			'tasmes'        => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => TRUE],
			'valor'         => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
			'ctapact'       => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
			'ctapend'       => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
			'valcta'        => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
			'saldo'         => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
            'fecha_cargue'  => ['type' => 'DATETIME', 'null' => TRUE],
			'status'    	=> ['type' => 'ENUM("Activo", "Inactivo")'],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->createTable('extracts_wallet');
    }

    public function down()
    {
        $this->forge->dropTable('extracts_wallet');
    }
}
