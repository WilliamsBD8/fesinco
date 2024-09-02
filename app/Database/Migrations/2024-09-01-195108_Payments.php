<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'title'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'description'   => ['type' => 'TEXT', 'null' => TRUE],
            'link'          => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
			'logo'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE],
            'position'      => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
            'status'        => ['type' => 'ENUM("Activo", "Inactivo")', 'default' => 'Activo'],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
