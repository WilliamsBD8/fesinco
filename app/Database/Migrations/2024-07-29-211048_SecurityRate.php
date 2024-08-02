<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SecurityRate extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
          'rate'              => ['type' => 'DECIMAL', 'constraint' => '7,5', 'null' => TRUE],
          'status'            => ['type' => 'ENUM("active", "inactive")', 'default' => 'active'],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('security_rates');
    }

    public function down()
    {
		$this->forge->dropTable('security_rates');
    }
}
