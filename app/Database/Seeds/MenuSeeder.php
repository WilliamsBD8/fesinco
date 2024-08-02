<?php

namespace App\Database\Seeds;

use App\Models\Menu;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            ['option' => 'Configuracion General','url' => 'general','icon' => 'settings','position' => '1','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'general','type_menu' => 'Pagina'],
            ['option' => 'Redes Sociales','url' => 'social_networks','icon' => 'language','position' => '2','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'social_networks','type_menu' => 'Pagina'],
            ['option' => 'Afiliados','url' => 'afiliados','icon' => 'assignment_ind','position' => '1','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => 'Afiliados','description' => NULL,'table' => 'users','type_menu' => 'Sistema'],
            ['option' => 'Usuarios','url' => '','icon' => 'people_outline','position' => NULL,'type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Pagina'],
            ['option' => 'Junta Directiva','url' => 'junta_directiva','icon' => NULL,'position' => '2','type' => 'secundario','references' => '4','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'users','type_menu' => 'Sistema'],
            ['option' => 'Comité','url' => 'comite','icon' => NULL,'position' => '3','type' => 'secundario','references' => '4','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'users','type_menu' => 'Sistema'],
            ['option' => 'Gerente','url' => 'gerente','icon' => NULL,'position' => '4','type' => 'secundario','references' => '4','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'users','type_menu' => 'Sistema'],
            ['option' => 'Nosotros','url' => 'about','icon' => 'picture_in_picture','position' => '3','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'about','type_menu' => 'Pagina']
        ];

        foreach ($menus as $key => $menu) {
            $m_model = new Menu();
            $m_model->save($menu);
        }
    }
}
