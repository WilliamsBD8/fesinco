<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LineCreditExtract extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
			'name'	    => ['type' => 'VARCHAR', 'constraint' => 255],
			'code'      => ['type' => 'VARCHAR', 'constraint' => 255],
			'status'    => ['type' => 'ENUM("Activo", "Inactivo")', 'default' => 'Activo'],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('line_credit_extracts');
    }

    public function down()
    {
		$this->forge->dropTable('line_credit_extracts');
    }
}
