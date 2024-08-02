<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\User;
use App\Models\ExtractsWallet;

class ExtractsWalletSeeder extends Seeder
{
    public function run()
    {
			$u_model = new User();

			$users_data = $u_model->select(['id', 'identification'])->findAll();
			$users = [];
			foreach ($users_data as $key => $user) {
				$users[$user->identification] = $user->id;
			}

			$jsonFilePath = WRITEPATH . 'uploads/data/extracto_cartera.json';

			// Leer el contenido del archivo JSON
			$jsonContent = file_get_contents($jsonFilePath);

			// Decodificar el contenido JSON en un array asociativo de PHP
			$data = json_decode($jsonContent, true);

			// Acceder a los datos específicos del JSON
			$records = $data[0]['data'] ?? [];

			foreach ($records as $key => $data) {
				$identification = $data['cedula'] ?? null;
				if (isset($identification) && isset($users[$identification])) {
						$data['user_id'] = $users[$identification];
				} else {
						$data['user_id'] = null; // O manejar esto de acuerdo a tus requisitos
				}
				$data['status'] = $data['estado'] == 'activo' ? 'Activo' : 'Inactivo';
				$data['tasanual'] = str_replace(',', '.', $data['tasanual']);
				$data['tasmes'] = str_replace(',', '.', $data['tasmes']);
				unset($data['cedula']);
				unset($data['estado']);
				unset($data['id_cartera']);
				$ew_model = new ExtractsWallet();
				$ew_model->save($data);
				// var_dump($data); die;
			}

    }
}
