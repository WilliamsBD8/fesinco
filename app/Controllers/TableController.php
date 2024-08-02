<?php


namespace App\Controllers;


use App\Traits\Grocery;
use App\Models\Menu;
use App\Models\General;
use App\Models\About;
use App\Models\Agreement;
use App\Models\Password;
use App\Models\Extract;
use App\Models\Section;
use App\Models\SectionDetail;
use App\Models\CreditRate;
use App\Models\User;
use App\Models\Pqr;

use CodeIgniter\Exceptions\PageNotFoundException;

class TableController extends BaseController
{
    use Grocery;

    private $crud;
    private $id;

    public function __construct()
    {
        $this->crud = $this->_getGroceryCrudEnterprise();
        $this->crud->setSkin('bootstrap-v3');
        $this->crud->setLanguage('Spanish');
    }

    public function index($data)
    {
        $menu = new Menu();
        $component = $menu->where(['url' => $data, 'component' => 'table'])->get()->getResult();

        if($component) {
            $this->crud->setTable($component[0]->table);
            switch ($component[0]->url) {

                case 'general':
                    $g_model = new General();
                    $general = $g_model->first();
                    if(!empty($general)){
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    $this->crud->setFieldUpload('logo', 'page/img/general', base_url(['page/img/general']));
                    break;
                case 'afiliados':
                    $this->crud->displayAs([
                        'name'              => 'Nombre',
                        'email'             => 'Correo',
                        'username'          => 'Usuario',
                        'identification'    => 'Cédula',
                        'phone'             => 'Telefono',
                        'status'            => 'Estado',
                        'photo'             => 'Foto',
                        'phone'             => 'Telefono',
                    ]);
                    $this->crud->unsetColumns(['position', 'role']);
                    $this->crud->setActionButton('Avatar', 'fa fa-lock', function ($row) {
                        return base_url(['table', 'afiliados', $row->id]);
                    }, false);
                    $this->crud->unsetDelete();
                    $this->crud->setRelation('role_id', 'roles', 'name', ['id' => 3]);
                    $this->crud->unsetAddFields(['position','role_id']);
                    $this->crud->unsetEditFields(['position','role_id']);
                    $this->crud->setFieldUpload('photo', 'assets/upload/images', base_url(['assets/upload/images']));
                    break;
                case 'extracts':
                    $this->crud->displayAs([
                        'date'                  => 'Fecha de carga',
                        'contributions_file'    => 'Archivo Aportes',
                        'wallet_file'           => 'Archivo Cartera',
                        'status'                => 'Status',
                        'observation'           => 'Observación',
                        'consecutive'           => 'N° Consecutivo'
                    ]);
                    $this->crud->defaultOrdering('id', 'desc');
                    $this->crud->setFieldUpload('contributions_file', 'upload/extracts', base_url(['upload/extracts']));
                    $this->crud->setFieldUpload('wallet_file', 'upload/extracts', base_url(['upload/extracts']));
                    $this->crud->readFields(['consecutive']);
                    $this->crud->setTexteditor(['observation']);
                    $this->crud->callbackColumn('contributions_file', function ($value, $row) {
                        return "<a href='".base_url(['upload/extracts', $value])."'>$value</a>";
                    });
                    $this->crud->callbackColumn('wallet_file', function ($value, $row) {
                        return "<a href='".base_url(['upload/extracts', $value])."'>$value</a>";
                    });
                    $this->crud->unsetAddFields(['date', 'consecutive']);
                    $this->crud->unsetEditFields(['date', 'consecutive']);
                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['date'] = date('Y-m-d');
                        $e_model = new Extract();
                        $extract_last = $e_model->orderby('id', 'DESC')->first();
                        $stateParameters->data['consecutive'] = ++$extract_last->consecutive;
                        return $stateParameters;
                    });
                    // $this->crud->unsetDelete();
                    break;
                case 'security_rates':
                    $this->crud->displayAs([
                        'rate'      => 'Tasa',
                        'status'    => 'Estado'
                    ]);
                    $this->crud->fieldType('rate', 'float');
                    $this->crud->unsetDelete();
                    break;
                case 'credit_rates':
                    $this->crud->displayAs([
                        'section_detail_id' => 'Detalle',
                        'security_rates_id' => 'Tasa de seguridad',
                        'rate'              => 'Tasa',
                        'quota_max'         => 'Cuota Maxíma'
                    ]);
                    $s_model = new Section();
                    $sections = $s_model->where(['status' => 'active', 'credit_simulation' => 'Si'])->findAll();
                    if(!empty($sections)){
                        $sections_id = array_map(function($section){
                            return $section->id;
                        }, $sections);
                        $this->crud->setRelation('section_detail_id', 'section_details', '{title} - {status}', ['section_id' => $sections_id]);
                    }else{
                        $this->crud->unsetAdd();
                    }
                    $this->crud->fieldType('rate', 'float');
                    $this->crud->setRelation('security_rates_id', 'security_rates', '{rate} - {status}');

                    break;
                case 'credits':
                    if(session('user')->role_id == 3){
                        $this->crud->where(['user_id' => session('user')->id]);
                        $this->crud->unsetOperations();
                    }else{
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    $this->crud->unsetColumns(['updated_at']);
                    $this->crud->setRelation('user_id', 'users', 'name');
                    $this->crud->setRelation('credit_status_id', 'credit_status', 'name');
                    $this->crud->callbackColumn('credit_rate_id', function($value, $row){
                        $cr_model = new CreditRate();
                        $credit = $cr_model
                            ->select('section_details.title')
                            ->where(['credit_rates.id' => $value])
                            ->join('section_details', 'section_details.id = credit_rates.section_detail_id', 'left')
                        ->first();
                        return $credit->title;
                    });
                    $this->crud->callbackColumn('value', function($value, $row){
                        return "$ ".number_format($value, 2, '.', ',');
                    });
                    $this->crud->displayAs([
                        'user_id'           => 'Afiliado',
                        'credit_rate_id'    => 'Tipo de crédito',
                        'credit_status_id'  => 'Estado',
                        'quota'             => 'Cuota',
                        'security_rate'     => 'Tasa de seguridad',
                        'rate'              => 'Tasa',
                        'value'             => 'Valor',
                        'created_at'        => 'Fecha de creación',
                        'pledge'            => 'Pignoración',
                        'co_signer'         => 'Codeudor',
                        'observation'       => 'Observación'
                    ]);
                    break;
                case 'users':
                    $this->crud->displayAs([
                        'name'              => 'Nombre',
                        'email'             => 'Correo Electrónico',
                        'username'          => 'Usuario',
                        'phone'             => 'Teléfono',
                        'status'            => 'Estado',
                        'identification'    => 'Cédula',
                        'photo'             => 'Foto'
                    ]);
                    $this->crud->setFieldUpload('photo', 'assets/img/users', base_url(['assets/img/users']));
                    $this->crud->unsetColumns(['position', 'status', 'role_id']);
                    $this->crud->unsetAdd();
                    $this->crud->unsetDelete();
                    $this->crud->unsetEditFields(['position', 'status', 'role_id']);
                    $this->crud->where(['id' => session('user')->id]);
                    $this->crud->uniqueFields(['phone', 'username', 'email']);
                    $this->crud->requiredFields(['name', 'email', 'username', 'identification']);
                    $this->crud->callbackAfterUpdate(function($stateParameters) {
                        $stateParameters->data['id'] = $stateParameters->primaryKeyValue;
                        $user = new User();
                        $data = $user
                            ->select(['users.*', 'roles.name as role_name'])
                            ->join('roles', 'roles.id = users.role_id')
                            ->where(['users.id' => session('user')->id])->first();
                        $password = session('user')->password;
                        $data->password = $user->getPassword($data->id);
                        $session = session();
                        $session->set('user', $data);
                        return $stateParameters;
                    });
                    break;

                case 'pqrs':
                    $this->crud->unsetOperations();
                    $this->crud->displayAs([
                        'user_id'       => 'Usuario',
                        'observation'   => 'PQR',
                        'status'        => 'Estado',
                        'creadted_at'   => 'Fecha de creación',
                        'updated_at'    => 'Fecha de respuesta'
                    ]);

                    $this->crud->callbackColumn('updated_at', function($value, $row){
                        if($row->status == 'Por revisar')
                            return 'Sin revisar';
                        return $value;
                    });
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'pqrs', $row->id]);
                    }, false);
                    
                    $this->crud->setRelation('user_id', 'users', 'name');

                    break;


                case 'junta_directiva':
                case 'comite':
                case 'gerente':
                case 'equipo_fesinco':
                    $this->crud->displayAs([
                        'name'              => 'Nombre',
                        'username'          => 'Usuario',
                        'identification'    => 'Cédula',
                        'status'            => 'Estado',
                        'photo'             => 'Foto',
                        'role_id'           => 'Rol',
                        'phone'             => 'Telefono',
                        'position'          => 'Cargo'
                    ]);
                    if($component[0]->url == 'afiliados')
                        $rol = 3;
                    else if($component[0]->url == 'junta_directiva')
                        $rol = 4;
                    else if($component[0]->url == 'comite')
                        $rol = 5;
                    else if($component[0]->url == 'gerente')
                        $rol = 6;
                    else
                        $rol = 7;
                    $this->crud->setRelation('role_id', 'roles', 'name', ['id' => $rol]);
                    $this->crud->setFieldUpload('photo', 'assets/upload/images', base_url(['assets/upload/images']));
                    break;
                case 'about':
                    $this->crud->displayAs([
                        'title'         => 'Titulo',
                        'description'   => 'Descripicción',
                        'img'           => 'Imagen'
                    ]);
                    $this->crud->setFieldUpload('img', 'page/img/about', base_url(['page/img/about']));
                    $a_model = new About();
                    $about = $a_model->first();
                    if(!empty($about)){
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    $this->crud->setTexteditor(['description', 'mision', 'vision']);
                    break;
                case 'home_galery':
                    $this->crud->displayas([
                        'img'       => 'Imagen',
                        'position'  => 'Posición',
                        'status'    => 'Estado'
                    ]);
                    $this->crud->setFieldUpload('img', 'page/img/sliders', base_url(['page/img/sliders']));
                    break;
                case 'sections':
                    $this->crud->displayas([
                        'title'         => 'Titulo',
                        'description'   => 'Descrpción',
                        'img'           => 'Imagen',
                        'position'      => 'Posición',
                        'status'        => 'Estado'
                    ]);
                    $this->crud->setFieldUpload('img', 'page/img/sections', base_url(['page/img/sections']));
                    $this->crud->setTexteditor(['description']);
                    $this->crud->unsetDelete();
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'sections', $row->id]);
                    }, false);
                    break;
                case 'contact_topics':
                    $this->crud->displayAs([
                        'title'         => 'Titulo',
                        'description'   => 'Descripción',
                        'email'         => 'Correo',
                        'position'      => 'Posición',
                        'status'        => 'Estado'
                    ]);
                    $this->crud->setTexteditor(['description']);
                    break;
                case 'agreements':
                    $a_model = new Agreement();
                    $agreement = $a_model->first();
                    if(!empty($agreement)){
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    $this->crud->displayAs([
                        'title'         => 'Titulo',
                        'description'   => 'Descripción'
                    ]);
                    $this->crud->setTexteditor(['description']);
                    break;
                case 'agreement_details':
                    $this->crud->displayAs([
                        'title'             => 'Titulo',
                        'description_short' => 'Descripción Corta',
                        'description'       => 'Descripción',
                        'specification'     => 'Especificaciones',
                        'img'               => 'Imagen',
                        'position'          => 'Posición',
                        'status'            => 'Estado',
                    ]);
                    $this->crud->setTexteditor(['description_short', 'description', 'specification']);
                    $this->crud->setFieldUpload('img', 'page/img/agreements', base_url(['page/img/agreements']));
                    break;
                default:
                    break;   
            }
            $output = $this->crud->render();
            if (isset($output->isJSONResponse) && $output->isJSONResponse) {
                header('Content-Type: application/json; charset=utf-8');
                echo $output->output;
                exit;
            }

            $this->viewTable($output, $component[0]->title, $component[0]->description);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function detail($data, $id)
    {
        $title = '';
        $description = '';
        $this->id = $id;
        if($data) {
            $this->crud->setTable($data);
            switch ($data) {
                case 'sections':
                    $this->crud->setTable('section_details');
                    $title = 'Detalles';
                    $this->crud->setRelation('section_id', 'sections', 'title', ['id' => $id]);
                    $this->crud->displayas([
                        'section_id'        => 'Sección',
                        'title'             => 'Titulo',
                        'description_short' => 'Descripción Corta',
                        'description'       => 'Descripción',
                        'specification'     => 'Especificaciones',
                        'img'               => 'Imagen',
                        'position'          => 'Posición',
                        'status'            => 'Estado'
                    ]);
                    $this->crud->setTexteditor(['description_short', 'description', 'specification']);
                    $this->crud->setFieldUpload('img', 'page/img/sections', base_url(['page/img/sections']));
                    break;
                case 'afiliados':
                    $this->crud->setTable('passwords');
                    $this->crud->where(['user_id' => $this->id]);
                    $this->crud->unsetDelete();
                    $this->crud->unsetEdit();
                    $this->crud->unsetColumns(['password', 'user_id', 'updated_at']);
                    $this->crud->fieldType('password', 'password');
                    $this->crud->addFields(['password']);
                    $this->crud->callbackBeforeInsert(function ($info){
                        $info->data['created_at']   = date('Y-m-d H:i:s');
                        $info->data['updated_at']   = date('Y-m-d H:i:s');
                        $info->data['user_id']      = $this->id;
                        $info->data['password']     = password_hash($info->data['password'], PASSWORD_DEFAULT);
                        $p_model = new Password();
                        $passwords = $p_model->where(['user_id' => $this->id, 'status' => 'active'])->findAll();
                        foreach ($passwords as $key => $password) {
                            $p_model->save([
                                'id'        => $password->id,
                                'status'    => 'inactive'
                            ]);
                        }
                        return $info;
                    });

                    $this->crud->displayAs([
                        'attempts'      => 'N° Intentos',
                        'status'        => 'Estado',
                        'created_at'    => 'Fecha de creación',
                        'password'      => 'Contraseña'
                    ]);
                    break;
                case 'pqrs':
                    $this->crud->setTable('pqr_details');
                    $pqr_model = new Pqr();
                    $pqr = $pqr_model->where(['id' => $this->id])->first();
                    $title = 'PQR';
                    $description = $pqr->observation;
                    $this->crud->addFields(['observation']);
                    $this->crud->editFields(['observation']);
                    $this->crud->setTexteditor(['observation']);
                    $this->crud->callbackBeforeInsert(function ($info){
                        $pqr_model = new Pqr();
                        $pqr_model->save([
                            'id'        => $this->id,
                            'status'    => 'Revisado'
                        ]);
                        $info->data['created_at']   = date('Y-m-d H:i:s');
                        $info->data['updated_at']   = date('Y-m-d H:i:s');
                        $info->data['user_id']      = session('user')->id;
                        $info->data['pqr_id']       = $this->id;
                        return $info;
                    });
                    $this->crud->displayAs([
                        'observation' => 'Respuesta'
                    ]);
                    $this->crud->columns(['observation']);
                    $this->crud->callbackBeforeUpdate(function ($info){
                        $info->data['updated_at']   = date('Y-m-d H:i:s');
                        return $info;
                    });
                    $this->crud->unsetDelete();
                    break;
                default:
                break;   
            }
            $output = $this->crud->render();
            if (isset($output->isJSONResponse) && $output->isJSONResponse) {
                header('Content-Type: application/json; charset=utf-8');
                echo $output->output;
                exit;
            }

            $this->viewTable($output, $title, $description);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }
}
