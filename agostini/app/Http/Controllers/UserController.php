<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Spatie\Permission\Models\Role;

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
}
