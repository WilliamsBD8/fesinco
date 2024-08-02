<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Credits extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'user_id'           => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'credit_rate_id'    => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'credit_status_id'  => ['type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, 'null' => TRUE],
            'quota'             => ['type' => 'INT', 'constraint' => 3, 'default' => 0],
            'security_rate'     => ['type' => 'DECIMAL', 'constraint' => '7,4', 'default' => 0],
            'rate'              => ['type' => 'DECIMAL', 'constraint' => '7,2', 'default' => 0],
            'value'             => ['type' => 'DECIMAL', 'constraint' => '20,2', 'default' => 0],
            'pledge'            => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'co_signer'         => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
            'observation'       => ['type' => 'TEXT', 'null' => TRUE],
            'created_at'        => ['type' => 'DATETIME', 'null' => TRUE],
            'updated_at'        => ['type' => 'DATETIME', 'null' => TRUE]
        ]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('user_id', 'users', 'id');
		$this->forge->addForeignKey('credit_rate_id', 'credit_rates', 'id');
		$this->forge->addForeignKey('credit_status_id', 'credit_status', 'id');
		$this->forge->createTable('credits');
    }

    public function down()
    {
		$this->forge->dropTable('credits');
    }
}
