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
                'date'                  => $extract['fecha'],
                'contributions_file'    => $extract['archivo_aportes'],
                'wallet_file'           => $extract['archivo_cartera'],
                'status'                => $extract['estado'] == 'CARGADO' ? 'Cargado' : 'Para cargar',
                'observation'           => $extract['observacion'],
                'consecutive'           => ++$key
            ]);
        }
    }
}
