<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NetworksTeams extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'team_id'   => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'icon'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'link'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'redirect'  => ['type' => 'ENUM("Si", "No")', 'default' => 'No'],
            'status'    => ['type' => 'ENUM("Activo", "Inactivo")', 'default' => 'Activo'],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('team_id', 'teams', 'id');
        $this->forge->createTable('networks_teams');
    }

    public function down()
    {
        $this->forge->dropTable('networks_teams');
    }
}
