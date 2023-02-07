<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\isNull;

class UserController extends CrudController
{
    protected $label = "usuários";
    protected $entity = User::class;
    // protected $index_page = 'Users/Index';

    public function __construct()
    {
        parent::__construct();
        $this->model_columns = [
            [
                'label' => 'id',
                'type' => 'integer',
                'store' => false,
                'showInIndex' => [
                    'enabled' => true,
                    'width' => '75px',
                ],
                'showInEdit' => [
                    'enabled' => false,
                ],
            ],
            [
                'label' => 'name',
                'type' => 'string',
                'store' => true,
                'showInIndex' => [
                    'enabled' => true
                ],
                'showInEdit' => [
                    'enabled' => true,
                ],
            ],
            [
                'label' => 'username',
                'type' => 'string',
                'store' => true,
                'showInIndex' => [
                    'enabled' => true
                ],
                'showInEdit' => [
                    'enabled' => true,
                ],
            ],
            [
                'label' => 'email',
                'type' => 'string',
                'store' => true,
                'showInIndex' => [
                    'enabled' => true
                ],
                'showInEdit' => [
                    'enabled' => true,
                ],
            ],
            [
                'label' => 'password',
                'type' => 'password',
                'store' => true,
                'showInIndex' => [
                    'enabled' => false
                ],
                'showInEdit' => [
                    'enabled' => true,
                ],
            ],
            [
                'label' => 'roles',
                'format' => "(el) => { return el.map(e => e.name) }",
                'type' => 'select',
                'store' => true,
                'options' => Role::all(['id', 'name'])->toArray(),
                'showInIndex' => [
                    'enabled' => true,
                    'width' => '150px',
                ],
                'showInEdit' => [
                    'enabled' => true,
                ],
            ],
            [
                'label' => 'empresa',
                'format' => "(el) => { return el.name }",
                'type' => 'select',
                'store' => true,
                'options' => Empresa::all(['id', 'name'])->toArray(),
                'showInIndex' => [
                    'enabled' => true,
                    'width' => '300px',
                ],
                'showInEdit' => [
                    'enabled' => true,
                ],
            ],
        ];
    }

    public function store(Request $request)
    {
        $role = null;
        $attrs = $request->all();
        $model = new $this->entity;
        $columnsToStore = array_filter($this->model_columns, function ($column) {
            return $column['store'];
        });
        foreach ($columnsToStore as $column) {
            $key = $column['label'];
            $value = $attrs[$column['label']] ?? null;
            if (isset($column['type']) && $column['type'] === 'select') {
                if($key === 'roles'){
                    $role = $value['name'];
                    continue;
                }
                $key = $key . '_id';
                $value = $value['id'] ?? null;
            }
            $model[$key] = $value;
        }
        $model->save();
        $model->assignRole($role);
        return Redirect::route($this->routeName . '.index');
    }

    public function update(Request $request, $id)
    {
        $role = null;
        $attrs = $request->all();
        $model = $this->entity::find($id);
        $columnsToStore = array_filter($this->model_columns, function ($column) {
            return $column['store'];
        });
        foreach ($columnsToStore as $column) {
            $key = $column['label'];
            $value = $attrs[$column['label']] ?? null;
            if (isset($column['type']) && $column['type'] === 'password'){
                if(is_null($attrs['password'])){
                    continue;
                }else{
                    $value = Hash::make($attrs['password']);
                }
            }
            if (isset($column['type']) && $column['type'] === 'select') {
                if($key === 'roles'){
                    $role = $value['name'];
                    continue;
                }
                $key = $key . '_id';
                $value = $value['id'] ?? null;
            }
            $model[$key] = $value;
        }
        $model->save();
        $model->syncRoles($role);
        return Redirect::route($this->routeName . '.index');
    }

}
