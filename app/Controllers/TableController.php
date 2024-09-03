<?php


namespace App\Controllers;


use App\Traits\Grocery;
use App\Models\Menu;
use App\Models\General;
use App\Models\About;
use App\Models\AboutDetail;
use App\Models\Agreement;
use App\Models\Password;
use App\Models\Extract;
use App\Models\Section;
use App\Models\SectionDetail;
use App\Models\CreditRate;
use App\Models\User;
use App\Models\Pqr;
use App\Models\InfoTeam;

use App\Models\ExtractsContributions;
use App\Models\ExtractsWallet;

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
                    $e_model = new Extract();
                    $extract = $e_model
                        ->whereIn('status', ['Para cargar', 'Cargado'])
                        ->where(['date' => date('Y-m-d')])->countAllResults();
                    if($extract != 0)
                        $this->crud->unsetAdd();
                    $this->crud->displayAs([
                        'date'                  => 'Fecha de carga',
                        'contributions_file'    => 'Archivo Aportes',
                        'wallet_file'           => 'Archivo Cartera',
                        'status'                => 'Estado',
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
                    $this->crud->unsetAddFields(['status', 'date', 'consecutive']);
                    $this->crud->unsetEditFields(['status', 'date', 'consecutive']);
                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['date'] = date('Y-m-d');
                        $e_model = new Extract();
                        $extract_last = $e_model->orderby('id', 'DESC')->first();
                        $stateParameters->data['consecutive'] = empty($extract_last) ? 1 : ++$extract_last->consecutive;
                        return $stateParameters;
                    });

                    $this->crud->callbackDelete(function ($stateParameters) {
                        $e_model = new Extract();
                        $extract = $e_model->where(['id' => $stateParameters->primaryKeyValue])->first();

                        $ec_model = new ExtractsContributions();
                        $ew_model = new ExtractsWallet();

                        $ec_model->like('fecha_cargue', "{$extract->date}")->delete();
                        $ew_model->like('fecha_cargue', "{$extract->date}")->delete();

                        $e_model->save([
                            'id'        => $stateParameters->primaryKeyValue,
                            'status'    => 'Anulado'
                        ]);
                        
                        return $stateParameters;
                    });

                    $this->crud->callbackUpload(function ($uploadData)  {
                        // Hardcoded paths. Please make sure that in case you just copy the below code 
                        // that you replace these two variables with yours
                        $uploadPath = 'upload/extracts'; // directory of the drive
                        $publicPath = base_url(['upload/extracts']); // public directory (at the URL)
                    
                        $fieldName = $uploadData->field_name;
                    
                        $storage = new \Upload\Storage\FileSystem($uploadPath);
                        $file = new \Upload\File($fieldName, $storage);
                    
                        $filename = isset($_FILES[$fieldName]) ? $_FILES[$fieldName]['name'] : null;
                    
                        if ($filename === null) {
                            return false;
                        }
                    
                        // The library that we are using want us to remove the file 
                        // extension as it is adding it by itself!
                        $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
                        // Replace illegal characters with an underscore
                        $filename = preg_replace("/([^a-zA-Z0-9\-\_]+?){1}/i", '_', $filename);

                        $filename = generarCodigoRandom(5)."_{$filename}";
                    
                        $file->setName($filename);
                    
                        // Validate file upload
                        $file->addValidations([
                            new \Upload\Validation\Extension(['csv']),
                            new \Upload\Validation\Size('20M')
                        ]);
                    
                        // Work around so the try catch will work as expected.
                        // Upload file will not yield any error if the error_reporting is 0
                        $display_errors = ini_get('display_errors');
                        $error_reporting = error_reporting();
                        ini_set('display_errors', 'on');
                        error_reporting(E_ALL);
                    
                        // Upload file
                        try {
                            // Success!
                            $file->upload();
                    
                        } catch (\Upload\Exception\UploadException $e) {
                            // Upload error, return a custom message
                            $errors = print_r($file->getErrors(), true);
                            return (new \GroceryCrud\Core\Error\ErrorMessage())
                                         ->setMessage("There was an error with the upload:\n" . $errors);
                        } catch (\Exception $e) {
                            throw $e;
                        }
                    
                        $filename = $file->getNameWithExtension();
                    
                        // Make sure that you return the results
                        $uploadData->filePath = $publicPath . '/' . $filename;
                        $uploadData->filename = $filename;
                    
                        return $uploadData;
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
                    $this->crud->defaultOrdering('created_at', 'DESC');
                    if(session('user')->role_id == 3){
                        $this->crud->where(['user_id' => session('user')->id]);
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }else{
                        $this->crud->unsetOperations();
                    }
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
                        'file'              => 'Archivo',
                        'co_signer'         => 'Codeudor',
                        'observation'       => 'Observación',
                        'updated_at'        => 'Acciones'
                    ]);

                    $this->crud->callbackColumn('file', function ($value, $row) {
                        if(!empty($value))
                            return "<a target='_blank' href='".base_url(['upload/credits', $value])."'><i class='material-icons'>attach_file</i></a>";
                        return "";
                    });

                    $this->crud->callbackColumn('updated_at', function ($value, $row) {
                        $buttons = '
                            <a href="'.base_url(['dashboard/credits/pdf', $row->id]).'" class="pink-text tooltipped" data-position="bottom" data-tooltip="Descargar Archivo"><i class="material-icons">picture_as_pdf</i></a>
                            <a href="'.base_url(['dashboard/credits/solicity', $row->id]).'" class="indigo-text tooltipped" data-position="bottom" data-tooltip="Descargar solicitud"><i class="material-icons">insert_drive_file</i></a>
                        ';
                        if(session('user')->id == $row->user_id && $row->credit_status_id == 1){
                            $buttons .= '<a onclick="credit_solicit('.$row->id.')" class="indigo-text tooltipped" data-position="bottom" data-tooltip="Solicitar Crédito" href="javascript:void(0);"><i class="material-icons">send</i></a>';
                        }else if((session('user')->role_id == 2 || session('user')->role_id == 1) && $row->credit_status_id == 2){
                            $buttons .= '
                                <a onclick="credit_solicit('.$row->id.', 3)" class="green-text tooltipped" data-position="bottom" data-tooltip="Aprobar Crédito" href="javascript:void(0);"><i class="material-icons">check</i></a>
                                <a onclick="credit_solicit('.$row->id.', 4)" class="red-text tooltipped" data-position="bottom" data-tooltip="Rechazar Crédito" href="javascript:void(0);"><i class="material-icons">close</i></a>
                            ';
                        }
                        return $buttons;
                    });

                    
                    $this->crud->setFieldUpload('file', 'upload/credits', base_url(['upload/credits']));
                    
                    $this->crud->editFields(['quota', 'value', 'file', 'co_signer', 'observation']);

                    break;
                case 'users':
                    $this->crud->displayAs([
                        'name'              => 'Nombre',
                        'email'             => 'Correo Electrónico',
                        'username'          => 'Usuario',
                        'phone'             => 'Teléfono',
                        'status'            => 'Estado',
                        'identification'    => 'Cédula',
                        'photo'             => 'Foto',
                        'created_at'        => 'Fecha de Creación'
                    ]);
                    $this->crud->setFieldUpload('photo', 'assets/img/users', base_url(['assets/img/users']));
                    $this->crud->unsetColumns(['position', 'status', 'role_id', 'updated_at']);
                    $this->crud->unsetAdd();
                    $this->crud->unsetDelete();
                    $this->crud->unsetEditFields(['position', 'status', 'role_id', 'identification', 'created_at', 'updated_at']);
                    $this->crud->where(['id' => session('user')->id]);
                    $this->crud->uniqueFields(['phone', 'username', 'email']);
                    $this->crud->requiredFields(['name', 'email', 'username']);
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
                    $this->crud->callbackBeforeUpdate(function ($info){
                        $info->data['updated_at']   = date('Y-m-d H:i:s');
                        $errorMessage = new \GroceryCrud\Core\Error\ErrorMessage();
                        $name = trim($info->data['name']);
                        $email = trim($info->data['email']);
                        if($name == 'NN')
                            return $errorMessage->setMessage("El Nombre no puede ser <b>NN</b>");
                        else if($email == 'NN')
                            return $errorMessage->setMessage("El Email no puede ser <b>NN</b>");
                        return $info;
                    });
                    break;

                case 'pqrs':
                    if(session('user')->role_id == 3){
                        $this->crud->unsetDelete();
                        $this->crud->where(['user_id' => session('user')->id]);
                    }else{
                        $this->crud->unsetOperations();
                    }
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'pqrs', $row->id]);
                    }, false);


                    
                    $this->crud->addFields(['type', 'observation']);
                    $this->crud->editFields(['type', 'observation']);
                    
                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['created_at'] = date('Y-m-d H:i:s');
                        $stateParameters->data['updated_at'] = date('Y-m-d H:i:s');
                        $stateParameters->data['user_id'] = session('user')->id;
                        return $stateParameters;
                    });

                    $this->crud->callbackBeforeUpdate(function ($info){
                        $info->data['updated_at']   = date('Y-m-d H:i:s');
                        return $info;
                    });
                    
                    $this->crud->displayAs([
                        'user_id'       => 'Usuario',
                        'observation'   => 'PQRs',
                        'status'        => 'Estado',
                        'type'          => 'Motivo',
                        'created_at'   => 'Fecha de creación',
                        'updated_at'    => 'Fecha de respuesta'
                    ]);

                    $this->crud->unsetColumns(['updated_at']);

                    // $this->crud->callbackColumn('updated_at', function($value, $row){
                    //     if($row->status == 'Por revisar')
                    //         return 'Sin revisar';
                    //     return $value;
                    // });

                    
                    $this->crud->setRelation('user_id', 'users', 'name');
                    $this->crud->setTexteditor(['observation']);
                    

                    break;


                // Info Pagina
                case 'general':
                    $this->crud->displayAs([
                        'name'              => 'Titulo',
                        'description'       => 'Descripción',
                        'keywords'          => 'Palabras Claves',
                        'addres'            => 'Dirección',
                        'phone'             => 'N° Telefono',
                        'message_whatsapp'  => 'Mensaje de whatsapp',
                        'entity'            => 'Entidad',
                        'entity_img'        => 'Logo Entidad',
                    ]);
                    
                    $g_model = new General();
                    $general = $g_model->first();
                    if(!empty($general)){
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    $this->crud->setFieldUpload('logo', 'page/img/logos', base_url(['page/img/logos']));
                    $this->crud->setFieldUpload('entity_img', 'page/img/entity', base_url(['page/img/entity']));
                    $this->crud->setTexteditor(['addres']);
                    break;

                case 'config_creditos':
                    $this->crud->where(['id' => 1]);
                    $this->crud->displayAs([
                        'name'  => 'Titulo',
                        'title' => 'Sub Titulo',
                    ]);
                    $this->crud->unsetAdd();
                    $this->crud->unsetDelete();
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'info_creditos']);
                    }, false);
                    break;
                case 'info_creditos':
                    $this->crud->where(['category_id' => 1]);
                    $this->crud->displayas([
                        'title'             => 'Titulo',
                        'sub_title'         => 'Sub Titulo',
                        'description'       => 'Descrpción',
                        'img'               => 'Imagen',
                        'position'          => 'Posición',
                        'status'            => 'Estado',
                        'credit_simulation' => 'Simular Créditos'
                    ]);
                    $this->crud->setFieldUpload('img', 'page/img/sections', base_url(['page/img/sections']));
                    $this->crud->setTexteditor(['description']);
                    $this->crud->unsetDelete();
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'info_creditos', $row->id]);
                    }, false);

                    $this->crud->columns(['title','sub_title', 'description', 'img', 'position', 'status', 'credit_simulation']);
                    $this->crud->unsetEditFields(['category_id']);
                    $this->crud->unsetAddFields(['category_id']);

                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['category_id'] = 1;
                        return $stateParameters;
                    });

                    break;

                case 'convenios':
                    $this->crud->where(['category_id' => 2]);
                    $this->crud->columns(['title', 'sub_title', 'description', 'img', 'status']);
                    $this->crud->displayas([
                        'title'             => 'Titulo',
                        'sub_title'         => 'Sub Titulo',
                        'description'       => 'Descrpción',
                        'img'               => 'Imagen',
                        'position'          => 'Posición',
                        'status'            => 'Estado'
                    ]);
                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['category_id'] = 2;
                        return $stateParameters;
                    });
                    
                    $this->crud->setFieldUpload('img', 'page/img/agreements', base_url(['page/img/agreements']));
                    
                    $this->crud->unsetEditFields(['category_id', 'credit_simulation', 'position', 'status']);
                    $this->crud->unsetAddFields(['category_id', 'credit_simulation', 'position', 'status']);

                    $s_model = new Section();
                    $section = $s_model->where(['category_id' => 2])->countAllResults();

                    if($section == 1)
                        $this->crud->unsetAdd();
                    $this->crud->unsetDelete();
                    $this->crud->setTexteditor(['description']);
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'convenios', $row->id]);
                    }, false);
                    break;
                case 'publications':
                    $this->crud->where(['id' => 4]);
                    $this->crud->displayAs([
                        'name'  => 'Titulo',
                        'title' => 'Sub Titulo',
                    ]);
                    $this->crud->unsetAdd();
                    $this->crud->unsetDelete();
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'publication']);
                    }, false);
                    break;
                case 'publication':
                    $this->crud->where(['category_id' => 4]);
                    $this->crud->columns(['title', 'description', 'img', 'position', 'status']);
                    $this->crud->displayas([
                        'title'             => 'Titulo',
                        'description'       => 'Descrpción',
                        'img'               => 'Imagen',
                        'position'          => 'Posición',
                        'status'            => 'Estado'
                    ]);
                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['category_id'] = 4;
                        return $stateParameters;
                    });
                    
                    $this->crud->setFieldUpload('img', 'page/img/publications', base_url(['page/img/publications']));
                    
                    $this->crud->unsetEditFields(['category_id', 'credit_simulation']);
                    $this->crud->unsetAddFields(['category_id', 'credit_simulation']);

                    $this->crud->unsetDelete();
                    $this->crud->setTexteditor(['description']);
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'publicaciones', $row->id]);
                    }, false);
                    break;

                case 'noticy':
                    $s_model = new Section();
                    $section = $s_model->where(['category_id' => 3])->countAllResults();
                    if($section)
                        $this->crud->unsetAdd();
                    $this->crud->where(['category_id' => 3]);
                    $this->crud->columns(['title', 'description', 'img', 'position', 'status']);
                    $this->crud->displayas([
                        'title'             => 'Titulo',
                        'sub_title'         => 'Sub Titulo',
                        'description'       => 'Descrpción',
                        'img'               => 'Imagen',
                        'position'          => 'Posición',
                        'status'            => 'Estado'
                    ]);
                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['category_id'] = 3;
                        return $stateParameters;
                    });
                    
                    $this->crud->setFieldUpload('img', 'page/img/sections', base_url(['page/img/sections']));

                    $this->crud->unsetEditFields(['category_id', 'credit_simulation', 'status', 'img', 'position']);
                    $this->crud->unsetAddFields(['category_id', 'credit_simulation', 'status', 'img', 'position']);

                    $this->crud->unsetDelete();
                    $this->crud->setTexteditor(['description']);
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'noticy', $row->id]);
                    }, false);

                    break;
                
                case 'info_teams':
                    $this->crud->displayAs([
                        'title'         => 'Titulo',
                        'sub_title'     => 'Sub Titulo',
                        'description'   => 'Descripción',
                        'img'           => 'Imagen de fondo'
                    ]);
                    $this->crud->setFieldUpload('img', 'page/img/team', base_url(['page/img/team']));
                    $it_model = new InfoTeam();
                    $info_team = $it_model->countAllResults();
                    if($info_team){
                        $this->crud->unsetAdd();
                        $this->crud->unsetDelete();
                    }
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'info_teams', 'team']);
                    }, false);
                    break;

                case 'afiliarme':
                    $s_model = new Section();
                    $section = $s_model->where(['category_id' => 5])->countAllResults();
                    if($section)
                        $this->crud->unsetAdd();
                    $this->crud->unsetDelete();
                    $this->crud->where(['category_id' => 5]);
                    $this->crud->displayas([
                        'title'             => 'Titulo',
                        'sub_title'         => 'Sub Titulo',
                        'description'       => 'Descrpción',
                        'img'               => 'Imagen',
                        'position'          => 'Posición',
                    ]);
                    // $this->crud->setFieldUpload('img', 'page/img/sections', base_url(['page/img/sections']));
                    $this->crud->setTexteditor(['description']);
                    $this->crud->unsetDelete();
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'afiliarme', $row->id]);
                    }, false);

                    $this->crud->columns(['title','sub_title', 'description']);
                    $this->crud->unsetEditFields(['category_id', 'credit_simulation', 'position', 'status']);
                    $this->crud->unsetAddFields(['category_id', 'credit_simulation', 'position', 'status']);

                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['category_id'] = 5;
                        return $stateParameters;
                    });
                    break;
                
                case 'payments':
                    $this->crud->displayAs([
                        'title'         => 'Titulo',
                        'description'   => 'Descripción',
                        'position'      => 'Posición',
                        'status'        => 'Estado'
                    ]);
                    
                    $this->crud->setFieldUpload('logo', 'page/img/payments', base_url(['page/img/payments']));
                    $this->crud->setTexteditor(['description']);
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
                        'sub_title'     => 'Sub Titulo',
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
                    $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'about', 'details']);
                    }, false);
                    break;
                case 'home_galery':
                    $this->crud->displayas([
                        'img'           => 'Imagen',
                        'position'      => 'Posición',
                        'title'         => 'Titulo',
                        'description'   => 'Descripción',
                        'status'        => 'Estado'
                    ]);
                    $this->crud->setFieldUpload('img', 'page/img/sliders', base_url(['page/img/sliders']));
                    $this->crud->setTexteditor(['description']);
                    break;
                // case 'sections':
                //     $this->crud->displayas([
                //         'title'         => 'Titulo',
                //         'description'   => 'Descrpción',
                //         'img'           => 'Imagen',
                //         'position'      => 'Posición',
                //         'status'        => 'Estado'
                //     ]);
                //     $this->crud->setFieldUpload('img', 'page/img/sections', base_url(['page/img/sections']));
                //     $this->crud->setTexteditor(['description']);
                //     $this->crud->unsetDelete();
                //     $this->crud->setActionButton('Avatar', 'fa fa-bars', function ($row) {
                //         return base_url(['table', 'sections', $row->id]);
                //     }, false);
                //     break;
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
                case 'info_creditos':
                case 'convenios':
                case 'publicaciones':
                case 'noticy':
                case 'afiliarme':
                    $this->crud->setTable('section_details');
                    $s_model = new Section();
                    $section = $s_model->where(['id' => $this->id])->first();
                    $title = $section->title;
                    $this->crud->setRelation('section_id', 'sections', 'title', ['id' => $id]);
                    $this->crud->displayas([
                        'section_id'        => 'Sección',
                        'title'             => 'Titulo',
                        'description'       => 'Descripción',
                        'specification'     => 'Especificaciones',
                        'img'               => 'Imagen',
                        'position'          => 'Posición',
                        'status'            => 'Estado'
                    ]);
                    $this->crud->setTexteditor(['description_short', 'description', 'specification']);
                    $this->crud->setFieldUpload('img', 'page/img/sections', base_url(['page/img/sections']));
                    $this->crud->setFieldUpload('file', 'upload/sections', base_url(['upload/sections']));
                    $this->crud->callbackColumn('file', function ($value, $row) {
                        return "<a href='".base_url(['upload/sections', $value])."'>$value</a>";
                    });
                    if($data == 'afiliarme'){
                        $sd_model = new SectionDetail();
                        $section_detail = $sd_model->where(['section_id' => $section->id])->countAllResults();
                        if($section_detail){
                            $this->crud->unsetAdd();
                            $this->crud->unsetDelete();
                        }
                    }
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
                    if(session('user')->role_id == 3)
                        $this->crud->unsetOperations();

                    break;
                
                case 'about':
                    // $ad_model = new AboutDetail();
                    // $about = $ad_model->where(['status' => 'active'])->countAllResults();
                    // if($about == 3){
                    //     $this->crud->unsetAdd();
                    // }
                    $this->crud->setTable('about_details');
                    $this->crud->displayAs([
                        'title'         => 'Titulo',
                        'sub_title'     => 'Sub Titulo',
                        'description'   => 'Descripción',
                        'position'      => 'Posición',
                        'status'        => 'Estado'
                    ]);
                    $this->crud->setTexteditor(['description']);
                    break;
                case 'info_teams':
                    $title = "Información del equipo";
                    $this->crud->setTable('teams');
                    $this->crud->setFieldUpload('img', 'page/img/team', base_url(['page/img/team']));
                    $this->crud->displayAs([
                        'name'      => 'Nombre',
                        'rol'       => 'Cargo',
                        'phone'     => 'Telefono',
                        'email'     => 'Correo',
                        'position'  => 'Posición',
                        'status'    => 'Estado'
                    ]);
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
