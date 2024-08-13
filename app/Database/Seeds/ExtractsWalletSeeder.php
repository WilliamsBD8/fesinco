<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\User;
use App\Models\LineCreditExtract;
use App\Models\ExtractsWallet;

class ExtractsWalletSeeder extends Seeder
{
    public function run()
    {
			$u_model = new User();
			$lce_model = new LineCreditExtract();

			$line_credit_extracts = $lce_model->where(['status' => 'Activo'])->findAll();

			$users_data = $u_model->select(['id', 'identification'])->findAll();
			$users = [];
			foreach ($users_data as $key => $user) {
				$users[$user->identification] = $user->id;
			}
			$jsonFilePath = WRITEPATH . 'uploads/data/extracto_cartera.json';
			$jsonContent = file_get_contents($jsonFilePath);
			$data = json_decode($jsonContent, true);
			$records = $data[0]['data'] ?? [];
			foreach ($records as $key => $data) {
				$identification = $data['cedula'] ?? null;
				if (isset($identification) && isset($users[$identification])) {
						$data['user_id'] = $users[$identification];
				} else {
						$data['user_id'] = null; // O manejar esto de acuerdo a tus requisitos
				}

				foreach($line_credit_extracts as $line_credit){
					if($line_credit->code == $data['codigo']){
						$data['line_credit_extract_id'] = $line_credit->id;
					}
				}

				$data['status'] = $data['estado'] == 'activo' ? 'Activo' : 'Inactivo';
				$data['tasanual'] = str_replace(',', '.', $data['tasanual']);
				$data['tasmes'] = str_replace(',', '.', $data['tasmes']);
				unset($data['cedula']);
				unset($data['estado']);
				unset($data['id_cartera']);
				unset($data['codigo']);
				$ew_model = new ExtractsWallet();
				$ew_model->save($data);
			}

    }
}
