<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Extracts extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'        					=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
			'date'      					=> ['type' => 'DATE', 'null' => TRUE],
			'contributions_file'	=> ['type' => 'VARCHAR', 'constraint' => 100],
			'wallet_file'  				=> ['type' => 'VARCHAR', 'constraint' => 40],
			'status'    					=> ['type' => 'ENUM("Para cargar", "Cargado")', 'default' => 'Para cargar'],
			'observation'  				=> ['type' => 'VARCHAR', 'constraint' => 100],
			'consecutive'      		=> ['type' => 'INT', 'constraint' => 11],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('extracts');
    }

    public function down()
    {
        $this->forge->dropTable('extracts');
    }
}
