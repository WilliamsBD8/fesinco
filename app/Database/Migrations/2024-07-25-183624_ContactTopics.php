<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ContactTopics extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'title'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
			'description'       => ['type' => 'TEXT', 'null' => TRUE],
			'email'             => ['type' => 'VARCHAR', 'constraint' => 255,'null' => TRUE],
            'position'          => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
			'status'            => ['type' => 'ENUM("active", "inactive")', 'default' => 'active'],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('contact_topics');
    }

    public function down()
    {
        $this->forge->dropTable('contact_topics');
    }
}
