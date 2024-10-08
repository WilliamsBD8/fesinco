<?php

use App\Models\Menu;
use App\Models\Permission;


function menu($type_menu = 'Sistema')
{
    $menu = new Menu();
    if (session()->get('user')->role_id == 1) {
        $data = $menu->where(['type' => 'primario', 'status' => 'active', 'type_menu' => $type_menu])
            ->orderBy('position', 'ASC')
            ->get()
            ->getResult();
    } else {
        $permission = new Permission();
        $data = $permission->select('menus.*')
            ->where('role_id', session()->get('user')->role_id)
            ->where('menus.type', 'primario')
            ->where('menus.type_menu', $type_menu)
            ->join('menus', 'menus.id = permissions.menu_id')
            ->join('roles', 'roles.id = permissions.role_id')
            ->orderBy('menus.position', 'ASC')
            ->get()
            ->getResult();
    }
    return $data;
}

function submenu($refences)
{
    $menu = new Menu();
    if (session()->get('user')->role_id == 1) {
        $data = $menu->where(['type' => 'secundario', 'status' => 'active', 'references' => $refences])
        ->orderBy('menus.position', 'ASC')
            ->get()
                ->getResult();
    } else {
        $permission = new Permission();
        $data = $permission->select('menus.*')
            ->where('role_id', session()->get('user')->role_id)
            ->where(['type' => 'secundario', 'status' => 'active', 'references' => $refences])
            ->join('menus', 'menus.id = permissions.menu_id')
            ->join('roles', 'roles.id = permissions.role_id')
            ->orderBy('menus.position', 'ASC')
            ->get()
            ->getResult();
    }
    return $data;
}

function countMenu($references)
{
    $menu = new Menu();
    $data = $menu->where(['type' => 'secundario', 'status' => 'active', 'references' => $references])
        ->get()
        ->getResult();
    if (count($data) > 0) {
        return true;
    }
    return false;
}

function urlOption($references = null)
{
    if ($references) {
        $menu = new Menu();
        $data = $menu->find($references);
        if ($data['component'] == 'table') {
            return base_url(["table", $data['url']]);
        } else if ($data['component'] == 'controller') {
            return base_url(["dashboard", $data['url']]);
        }
    } else {
        return 'JavaScript:void(0)';
    }

}

function isActive($data)
{
    if(base_url(uri_string()) == base_url([$data])) {
        return 'active';
    }
}

