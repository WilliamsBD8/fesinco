<?php namespace App\Database\Seeds;

use App\Models\User;
use App\Models\Password;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $user = [
            'nombre'            => 'Administrador',
            'correo'            => 'iplanet@iplanetcolombia.com',
            'username'          => 'root',
            'status'            => 'active',
            'photo'             => '',
            'role_id'           => 1,
            'cedula'            => 123456789,
            'clave'             => 'M49bx3kk!!'
        ];

        
        helper('load_users');
        $data = load_user();
        array_unshift($data, $user);

        foreach ($data as $item):
            $u_model = new User();
            $u_model->save([
                'name'              => $item['nombre'],
                'email'             => $item['correo'],
                'username'          => isset($item['username']) ? $item['username'] : $item['cedula'],
                'identification'    => $item['cedula'],
                'status'            => 'active',
                'photo'             => '',
                'role_id'           => isset($item['role_id']) ? $item['role_id'] : 3
            ]);
            $user_id = $u_model->insertID();
            $p_model = new Password();
            $p_model->save([
                'user_id'   => $user_id,
                'password'  => password_hash($item['clave'], PASSWORD_DEFAULT)
            ]);
        endforeach;
    }
}