<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SocialNetworks extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
			'name'      => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => TRUE],
			'link'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE],
			'icon'      => ['type' => 'VARCHAR', 'constraint' => 40, 'null' => TRUE],
			'_blank'    => ['type' => 'ENUM("Si", "No")', 'default' => 'No'],
			'status'    => ['type' => 'ENUM("active", "inactive")', 'default' => 'active'],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('social_networks');
    }

    public function down()
    {
        $this->forge->dropTable('social_networks');
    }
}
