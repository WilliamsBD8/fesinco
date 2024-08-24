<?php

namespace App\Database\Seeds;

use App\Models\Menu;
use App\Models\Permission;

use CodeIgniter\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menus = [
            ['option' => 'Configuracion General','url' => 'general','icon' => 'settings','position' => '1','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'general','type_menu' => 'Pagina'],
            ['option' => 'Redes Sociales','url' => 'social_networks','icon' => 'language','position' => '2','type' => 'primario','references' => NULL,'status' => 'inactive','component' => 'table','title' => NULL,'description' => NULL,'table' => 'social_networks','type_menu' => 'Pagina'],
            ['option' => 'Afiliados','url' => 'afiliados','icon' => 'assignment_ind','position' => '1','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => 'Afiliados','description' => NULL,'table' => 'users','type_menu' => 'Sistema'],
            ['option' => 'Equipo FESINCO','url' => '','icon' => 'people_outline','position' => NULL,'type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Pagina'],
            ['option' => 'Junta Directiva','url' => 'junta_directiva','icon' => NULL,'position' => '2','type' => 'secundario','references' => '4','status' => 'inactive','component' => 'table','title' => NULL,'description' => NULL,'table' => 'users','type_menu' => 'Sistema'],
            ['option' => 'Comité','url' => 'comite','icon' => NULL,'position' => '3','type' => 'secundario','references' => '4','status' => 'inactive','component' => 'table','title' => NULL,'description' => NULL,'table' => 'users','type_menu' => 'Sistema'],
            ['option' => 'Gerente','url' => 'gerente','icon' => NULL,'position' => '4','type' => 'secundario','references' => '4','status' => 'inactive','component' => 'table','title' => NULL,'description' => NULL,'table' => 'users','type_menu' => 'Sistema'],
            ['option' => 'Nosotros','url' => 'about','icon' => 'picture_in_picture','position' => '3','type' => 'secundario','references' => '11','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'about','type_menu' => 'Pagina'],
            ['option' => 'Equipo FESINCO','url' => 'equipo_fesinco','icon' => NULL,'position' => '4','type' => 'secundario','references' => '4','status' => 'inactive','component' => 'table','title' => NULL,'description' => NULL,'table' => 'users','type_menu' => 'Pagina'],
            ['option' => 'Home','url' => '','icon' => 'bookmark','position' => '2','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Pagina'],
            ['option' => 'Slider','url' => 'home_galery','icon' => NULL,'position' => '1','type' => 'secundario','references' => '11','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'home_galery','type_menu' => 'Pagina'],
            ['option' => 'Secciones','url' => 'sections','icon' => 'assignment','position' => '6','type' => 'secundario','references' => '10','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'sections','type_menu' => 'Pagina'],
            ['option' => 'Temas de contacto','url' => 'contact_topics','icon' => 'bookmark','position' => '6','type' => 'secundario','references' => '11','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'contact_topics','type_menu' => 'Pagina'],
            ['option' => 'Convenios','url' => '','icon' => 'business','position' => NULL,'type' => 'secundario','references' => '11','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Pagina'],
            ['option' => 'Información General','url' => 'agreements','icon' => NULL,'position' => '1','type' => 'secundario','references' => '15','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'agreements','type_menu' => 'Pagina'],
            ['option' => 'Detalles','url' => 'agreement_details','icon' => NULL,'position' => '2','type' => 'secundario','references' => '15','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'agreement_details','type_menu' => 'Pagina'],
            ['option' => 'Publicaciones','url' => '','icon' => NULL,'position' => NULL,'type' => 'secundario','references' => '11','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Pagina'],
            ['option' => 'Cargar Extractos','url' => 'extracts','icon' => 'file_upload','position' => '3','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => 'Extractos','description' => NULL,'table' => 'extracts','type_menu' => 'Sistema'],
            ['option' => 'Tasa Simulador','url' => 'credit_rates','icon' => 'show_chart','position' => '2','type' => 'secundario','references' => '22','status' => 'active','component' => 'table','title' => 'Tasa para simulaciones','description' => NULL,'table' => 'credit_rates','type_menu' => 'Sistema'],
            ['option' => 'Solicitud','url' => 'credits','icon' => 'monetization_on','position' => '2','type' => 'secundario','references' => '23','status' => 'active','component' => 'controller','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Sistema'],
            ['option' => 'Simulador','url' => 'simulate_credit','icon' => 'local_atm','position' => '1','type' => 'secundario','references' => '23','status' => 'active','component' => 'controller','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Sistema'],
            ['option' => 'Config. Tasas','url' => '','icon' => 'show_chart','position' => '6','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Sistema'],
            ['option' => 'Créditos','url' => 'credits','icon' => 'local_atm','position' => '5','type' => 'primario','references' => NULL,'status' => 'active','component' => 'controller','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Sistema'],
            ['option' => 'Tasa Seguridad','url' => 'security_rates','icon' => NULL,'position' => '1','type' => 'secundario','references' => '22','status' => 'active','component' => 'table','title' => 'Tasa de seguridad','description' => NULL,'table' => 'security_rates','type_menu' => 'Sistema'],
            ['option' => 'Historial','url' => 'credits','icon' => NULL,'position' => '3','type' => 'secundario','references' => '23','status' => 'active','component' => 'table','title' => 'Historial de créditos','description' => NULL,'table' => 'credits','type_menu' => 'Sistema'],
            ['option' => 'Perfil','url' => 'users','icon' => 'person_outline','position' => '1','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => 'Perfil','description' => NULL,'table' => 'users','type_menu' => 'Sistema'],
            ['option' => 'Créditos Solicitados','url' => 'credits','icon' => NULL,'position' => '4','type' => 'secundario','references' => '26','status' => 'inactive','component' => 'table','title' => NULL,'description' => NULL,'table' => 'credits','type_menu' => 'Sistema'],
            ['option' => 'PQRS','url' => 'pqrs','icon' => 'question_answer','position' => '6','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => 'PQRS','description' => NULL,'table' => 'pqrs','type_menu' => 'Sistema'],
            ['option' => 'Extractos','url' => 'extracts','icon' => 'insert_drive_file','position' => '5','type' => 'primario','references' => NULL,'status' => 'active','component' => 'controller','title' => NULL,'description' => NULL,'table' => NULL,'type_menu' => 'Sistema']
        ];

        foreach ($menus as $key => $menu) {
            $m_model = new Menu();
            $m_model->save($menu);
        }

        $permissions = [
            ['role_id' => '3','menu_id' => '26'],
            ['role_id' => '3','menu_id' => '28'],
            ['role_id' => '3','menu_id' => '29'],
            ['role_id' => '3','menu_id' => '23'],
            ['role_id' => '3','menu_id' => '21'],
            ['role_id' => '3','menu_id' => '20'],
            ['role_id' => '3','menu_id' => '25']
        ];

        $p_model = new Permission();
        foreach ($permissions as $key => $permission) {
            $p_model->save($permission);
        }
    }
}
