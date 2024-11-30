<?php


namespace App\Controllers;


use App\Traits\Grocery;
use App\Models\Menu;
use App\Models\Company;
use App\Models\CategoryTax;
use CodeIgniter\Exceptions\PageNotFoundException;

class TableController extends BaseController
{
    use Grocery;

    private $crud;

    public function __construct()
    {
        $this->crud = $this->_getGroceryCrudEnterprise();
        // $this->crud->setSkin('bootstrap-v3');
        $this->crud->setLanguage('Spanish');
    }

    public function index($data)
    {
        $menu = new Menu();
        $component = $menu->where(['url' => $data, 'component' => 'table'])->get()->getResult();



        if($component) {
            $this->crud->setTable($component[0]->table);
            switch ($component[0]->url) {
                case 'usuarios':
                    $this->crud->setActionButton('Algo mas que aqeullo', 'fa fa-bars', function ($row) {
                        return base_url(['table', 'info_creditos', $row->id]);
                    }, false);
                    
                    $this->crud->setFieldUpload('photo', 'assets/upload/images', '/assets/upload/images');
                    $this->crud->setRelation('role_id', 'roles', 'name');
                    $this->crud->displayAs([
                        'name'  => 'Nombre',
                        'photo' => 'Foto'
                    ]);
                    break;
                case 'menus':
                    $this->crud->setTexteditor(['description']);
                    break;
                case 'category_taxes':
                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['created_at'] = date('Y-m-d h:i:s');
                        $stateParameters->data['updated_at'] = date('Y-m-d h:i:s');
                        return $stateParameters;
                    });
                    $this->crud->callbackBeforeUpdate(function ($stateParameters) {
                        $stateParameters->data['updated_at'] = date('Y-m-d h:i:s');
                        return $stateParameters;
                    });
                    $this->crud->displayAs([
                        'name'          => 'Nombre',
                        'created_at'    => 'Creado',
                        'updated_at'    => 'Ultima Actualización'
                    ]);
                    $this->crud->setActionButton('Impuestos', 'fa fa-align-left', function ($row) use ($component) {
                        return base_url(['table', $component[0]->table, $row->id]);
                    }, false);
                    break;
                case 'companies':
                    $this->crud->displayAs([
                        'user_id'           => 'Usuario',
                        'name'              => 'Empresa',
                        'municipality_id'   => 'Municipio',
                        'status'            => 'Estado',
                        'created_at'        => 'Creado',
                        'updated_at'        => 'Ultima Actualización'
                    ]);
                    $this->crud->setRelation('user_id', 'users', 'name');
                    $this->crud->setRelation('municipality_id', 'municipalities', 'name');
                    $notData = ['created_at', 'updated_at'];
                    if(session('user')->role_id == 3){
                        $this->crud->where(['user_id' => session('user')->id]);
                        $c_model = new Company();
                        $count_companies = $c_model->where(['user_id' => session('user')->id])->countAllResults();
                        if($count_companies >= 3){
                            $this->crud->unsetAdd();
                        }
                        $this->crud->unsetColumns(['updated_at']);
                        $notData[] = 'user_id';
                    }
                    $this->crud->unsetAddFields($notData);
                    $this->crud->unsetEditFields($notData);
                    $this->crud->callbackBeforeInsert(function ($stateParameters) {
                        $stateParameters->data['created_at'] = date('Y-m-d h:i:s');
                        $stateParameters->data['updated_at'] = date('Y-m-d h:i:s');
                        if(session('user')->role_id == 3)
                            $stateParameters->data['user_id'] = session('user')->id;
                        return $stateParameters;
                    });
                    $this->crud->callbackBeforeUpdate(function ($stateParameters) {
                        $stateParameters->data['updated_at'] = date('Y-m-d h:i:s');
                        return $stateParameters;
                    });

                    $this->crud->setActionButton('Notificaciones', 'fa fa-envelope-o fa-fw', function ($row) use ($component) {
                        return base_url(['table', $component[0]->url, 'notification', $row->id]);
                    }, false);
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

    public function detail($url, $id)
    {
        $menu = new Menu();
        $component = $menu->where(['url' => $url, 'component' => 'table'])->first();

        $title = "";
        $description = "";
        $url_back = $url;

        if($component) {
            switch ($component->url) {
                case 'category_taxes':
                    $this->crud->setTable('calendary_taxes');
                    $this->crud->where(['category_tax_id' => $id]);
                    $ct_model = new CategoryTax();
                    $category = $ct_model->find($id);
                    $title          = 'Tipo de impuesto: <span class="text-muted mb-0">'.$category->name.'</span>';
                    $this->crud->callbackBeforeInsert(function ($stateParameters) use ($id) {
                        $stateParameters->data['created_at']        = date('Y-m-d h:i:s');
                        $stateParameters->data['updated_at']        = date('Y-m-d h:i:s');
                        $stateParameters->data['category_tax_id']   = $id;
                        return $stateParameters;
                    });
                    $this->crud->callbackBeforeUpdate(function ($stateParameters) {
                        $stateParameters->data['updated_at'] = date('Y-m-d h:i:s');
                        return $stateParameters;
                    });

                    $this->crud->displayAs([
                        'name'          => 'Nombre',
                        'description'   => 'descripción',
                        'period'        => 'periodo',
                        'code'          => 'codigo',
                        'template'      => 'plantilla',
                        'created_at'    => 'Creado',
                        'updated_at'    => 'Ultima Actualización'
                    ]);

                    $this->crud->setTexteditor(['description']);

                    $this->crud->unsetColumns(['category_tax_id']);

                    $notData = ['category_tax_id', 'created_at', 'updated_at'];
                    $this->crud->unsetAddFields($notData);
                    $this->crud->unsetEditFields($notData);
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

            $this->viewTable($output, $title, $description, $url);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }
}
