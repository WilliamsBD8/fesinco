<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HomeGalery extends Migration
{
    public function up()
    {
        $this->forge->addField([
		    'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ],
            'img'           => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'position'      => ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'status'        => ['type' => 'ENUM("active", "inactive")', 'default' => 'active']
        ]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('home_galery');
    }

    public function down()
    {
        $this->forge->dropTable('home_galery');
    }
}
