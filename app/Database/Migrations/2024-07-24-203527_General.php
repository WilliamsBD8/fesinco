<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class General extends Migration
{
    public function up()
    {
        $this->forge->addField([
		    'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ],
            'name'          => ['type' => 'VARCHAR','constraint' => 255, 'null' => true],
            'description'   => ['type' => 'TEXT', 'null' => true],
            'keywords'      => ['type' => 'TEXT', 'null' => true],
            'logo'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true]
        ]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('general');
    }

    public function down()
    {
        $this->forge->dropTable('general');
    }
}
