<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Teams extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'name'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'rol'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'phone'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'email'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'status'    => ['type' => 'ENUM("Activo", "Inactivo")', 'default' => 'Activo'],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('teams');
    }

    public function down()
    {
        $this->forge->dropTable('teams');
    }
}
