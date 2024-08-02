<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreditRates extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment'  => TRUE],
            'section_detail_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'null' => TRUE],
            'security_rates_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'null' => TRUE],
			'rate'              => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => TRUE],
			'quota_max'         => ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
		]);
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('section_detail_id', 'section_details', 'id');
		$this->forge->addForeignKey('security_rates_id', 'security_rates', 'id');
		$this->forge->createTable('credit_rates');
    }

    public function down()
    {
        $this->forge->dropTable('credit_rates');
    }
}
