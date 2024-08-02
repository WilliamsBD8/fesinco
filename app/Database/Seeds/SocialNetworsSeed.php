<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\SocialNetwork;

class SocialNetworsSeed extends Seeder
{
    public function run()
    {
        $networks = [
            ['name' => 'Facebook', 'icon' => 'fa fa-facebook'],
            ['name' => 'LinkedIn', 'icon' => 'fa fa-linkedin'],
            ['name' => 'Twitter', 'icon' => 'fa fa-twitter'],
        ];

        foreach ($networks as $key => $network) {
            $sn_model = new SocialNetwork();
            $sn_model->save($network);
        }
    }
}
