<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InfoTeams extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'title'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'sub_title'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'description'   => ['type' => 'TEXT'],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('info_teams');
    }

    public function down()
    {
        $this->forge->dropTable('info_teams');
    }
}
