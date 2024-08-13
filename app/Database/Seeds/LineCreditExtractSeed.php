<?php

namespace App\Database\Seeds;

use App\Models\LineCreditExtract;

use CodeIgniter\Database\Seeder;

class LineCreditExtractSeed extends Seeder
{
    public function run()
    {
        $linea_credito_extractos = [
            ['code' => '101A','name' => 'TRANSITORIO','status' => 'Activo'],
            ['code' => '102A','name' => 'PIGNORACION ','status' => 'Activo'],
            ['code' => '105A','name' => 'LIBRE INVERSION','status' => 'Activo'],
            ['code' => '106A','name' => 'COMPRA CARTERA','status' => 'Activo'],
            ['code' => '107A','name' => 'CREDITO DE NAVIDAD','status' => 'Activo'],
            ['code' => '109A','name' => 'TURISMO','status' => 'Activo'],
            ['code' => '110A','name' => 'VIVIENDA','status' => 'Activo'],
            ['code' => '115A','name' => 'VEHICULO','status' => 'Activo'],
            ['code' => '120A','name' => 'EDUCACION','status' => 'Activo'],
            ['code' => '125A','name' => 'MERCANCIA','status' => 'Activo'],
            ['code' => '126A','name' => 'BOLETAS','status' => 'Activo'],
            ['code' => '130A','name' => 'MEJORAS','status' => 'Activo'],
            ['code' => '135A','name' => 'CALAMIDAD','status' => 'Activo'],
            ['code' => '140A','name' => 'POLIZAS Y SEGUROS','status' => 'Activo'],
            ['code' => '145A','name' => 'COLSANITAS','status' => 'Activo'],
            ['code' => '146A','name' => 'EMERMEDICA','status' => 'Activo'],
            ['code' => '150A','name' => 'POLIZA EXEQUIAL','status' => 'Activo'],
            ['code' => '171A','name' => 'PIGNORACION VACACIONES','status' => 'Activo'],
            ['code' => '172A','name' => 'PIGNORACION BONIFICACION','status' => 'Activo'],
            ['code' => '173A','name' => 'PIGNORACION PRIMA SEMESTRAL','status' => 'Activo'],
            ['code' => '174A','name' => 'PIGNORACION NAVIDAD','status' => 'Activo'],
            ['code' => '175A','name' => 'PIGNORACION CESANTIAS','status' => 'Activo']
        ];
        $lce_model = new LineCreditExtract();
        foreach ($linea_credito_extractos as $key => $data) {
            $lce_model->save($data);
        }
    }
}
