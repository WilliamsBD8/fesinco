<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sections extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
			'category_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'title'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
			'description'       => ['type' => 'TEXT', 'null' => TRUE],
			'img'               => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'position'          => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
			'credit_simulation' => ['type' => 'ENUM("Si", "No")', 'default' => 'No'],
			'status'            => ['type' => 'ENUM("active", "inactive")', 'default' => 'active'],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('category_id', 'categories', 'id');
		$this->forge->createTable('sections');
    }

    public function down()
    {
        $this->forge->dropTable('sections');
    }
}
