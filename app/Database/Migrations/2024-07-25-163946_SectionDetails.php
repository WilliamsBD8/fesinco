<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SectionDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
			'section_id'   	    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'title'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
			'description_short' => ['type' => 'TEXT', 'null' => TRUE],
			'description'       => ['type' => 'TEXT', 'null' => TRUE],
			'specification'     => ['type' => 'TEXT', 'null' => TRUE],
			'img'               => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'position'          => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
			'status'            => ['type' => 'ENUM("active", "inactive")', 'default' => 'active'],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('section_id', 'sections', 'id');
		$this->forge->createTable('section_details');
    }

    public function down()
    {
        $this->forge->dropTable('section_details');
    }
}
