<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AboutDetails extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'title'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'sub_title'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'description'   => ['type' => 'TEXT'],
            'position'      => ['type' => 'INT', 'constraint' => 11, 'null' => true],
			'status'        => ['type' => 'ENUM("active", "inactive")', 'default' => 'active']
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('about_details');
    }

    public function down()
    {
        $this->forge->dropTable('about_details');
    }
}
