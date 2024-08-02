<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AgreementDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'title'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
			'description_short' => ['type' => 'TEXT', 'null' => TRUE],
			'description'       => ['type' => 'TEXT', 'null' => TRUE],
			'specification'     => ['type' => 'TEXT', 'null' => TRUE],
			'img'               => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'position'          => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
			'status'            => ['type' => 'ENUM("active", "inactive")', 'default' => 'active'],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('agreement_details');
    }

    public function down()
    {
        $this->forge->dropTable('agreement_details');
    }
}
