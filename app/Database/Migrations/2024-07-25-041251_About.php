<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class About extends Migration
{
    public function up()
    {
        $this->forge->addField([
		    'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ],
            'title'         => ['type' => 'VARCHAR','constraint' => 255, 'null' => true],
            'description'   => ['type' => 'TEXT', 'null' => true],
            'img'           => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'mision'        => ['type' => 'TEXT', 'null' => true],
            'vision'        => ['type' => 'TEXT', 'null' => true],
        ]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('about');
    }

    public function down()
    {
        $this->forge->dropTable('about');
    }
}
