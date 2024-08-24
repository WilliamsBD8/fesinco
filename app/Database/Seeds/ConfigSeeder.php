<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\Configuration;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        $c_model = new Configuration();
        $c_model->save([
            'name_app'                  => 'Fesinco',
            'register'                  => 'inactive',
            'background_image'          => 'fondo_login.jpg',
            'background_img_vertical'   => 'fondo_menu.jpg',
            'primary_color'             => '1a8001',
            'secundary_color'           => 'f3ff00'
        ]);
    }
}
