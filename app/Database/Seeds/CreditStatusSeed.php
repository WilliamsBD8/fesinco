<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\CreditStatus;

class CreditStatusSeed extends Seeder
{
    public function run()
    {
        $statuses = [
            ['name' => 'Simulado'],
            ['name' => 'Solicitado'],
            ['name' => 'Aprobado'],
            ['name' => 'Rechazado'],
        ];
        $cs_model = new CreditStatus();
        foreach ($statuses as $key => $status) {
            $cs_model->save($status);
        }
    }
}
