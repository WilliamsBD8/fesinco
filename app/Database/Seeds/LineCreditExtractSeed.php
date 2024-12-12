<?php

namespace App\Database\Seeds;

use App\Models\LineCreditExtract;

use CodeIgniter\Database\Seeder;

class LineCreditExtractSeed extends Seeder
{
    public function run()
    {
        $linea_credito_extractos = [
            array('name' => 'TRANSITORIO','code' => '101A','status' => 'Activo'),
            array('name' => 'LIBRE INVERSION','code' => '105A','status' => 'Activo'),
            array('name' => 'COMPRA CARTERA','code' => '106A','status' => 'Activo'),
            array('name' => 'CREDITO DE NAVIDAD','code' => '107A','status' => 'Activo'),
            array('name' => 'TURISMO','code' => '109A','status' => 'Activo'),
            array('name' => 'INVERSION TASA PREFERENCIAL','code' => '110A','status' => 'Activo'),
            array('name' => 'VEHICULO','code' => '115A','status' => 'Activo'),
            array('name' => 'EDUCATIVO','code' => '120A','status' => 'Activo'),
            array('name' => 'MERCANCIA','code' => '125A','status' => 'Activo'),
            array('name' => 'BOLETAS','code' => '126A','status' => 'Activo'),
            array('name' => 'MEJORAS','code' => '130A','status' => 'Activo'),
            array('name' => 'CALAMIDAD','code' => '135A','status' => 'Activo'),
            array('name' => 'POLIZAS Y SEGUROS','code' => '140A','status' => 'Activo'),
            array('name' => 'COLSANITAS','code' => '145A','status' => 'Activo'),
            array('name' => 'EMERMEDICA','code' => '146A','status' => 'Activo'),
            array('name' => 'POLIZA EXEQUIAL','code' => '150A','status' => 'Activo'),
            array('name' => 'PIGNORACION VACACIONES','code' => '171A','status' => 'Activo'),
            array('name' => 'PIGNORACION BONIFICACION','code' => '172A','status' => 'Activo'),
            array('name' => 'PIGNORACION PRIMA SEMESTRAL','code' => '173A','status' => 'Activo'),
            array('name' => 'PIGNORACION PRIMA NAVIDAD','code' => '174A','status' => 'Activo'),
            array('name' => 'PIGNORACION CESANTIAS','code' => '175A','status' => 'Activo'),
            array('name' => 'CREDIYA','code' => '108A','status' => 'Activo'),
            array('name' => 'credito','code' => '106B','status' => 'Activo'),
            array('name' => 'CREDIALIVIO','code' => '104A','status' => 'Activo'),
            array('name' => 'SALUD','code' => '136A','status' => 'Activo')
        ];
        $lce_model = new LineCreditExtract();
        foreach ($linea_credito_extractos as $key => $data) {
            $lce_model->save($data);
        }
    }
}
