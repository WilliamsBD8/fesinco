<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Extract;

class ExtractsSeed extends Seeder
{
    public function run()
    {
        helper('load_users');
        $data = load_extracts();
        $e_model = new Extract();
        foreach ($data as $key => $extract) {
            $e_model->save([
                'date' => $extract[0],
                'contributions_file' => $extract[1],
                'wallet_file' => $extract[2],
                'status' => $extract[3] == 'CARGADO' ? 'Cargado' : 'Para cargar',
                'observation' => $extract[4],
                'consecutive' => ++$key
            ]);
        }
    }
}
