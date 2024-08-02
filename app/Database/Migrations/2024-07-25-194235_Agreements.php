<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Agreements extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'title'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
			'description'       => ['type' => 'TEXT', 'null' => TRUE]
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('agreements');
    }

    public function down()
    {
        $this->forge->dropTable('agreements');
    }
}
