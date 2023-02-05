<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends CrudController
{
    protected $label = "empresa";
    protected $entity = Empresa::class;

    protected $model_columns = [
        [
            'label' => 'id',
            'type' => 'integer',
            'store' => false,
            'showInIndex' => [
                'enabled' => true,
                'width' => '130px',
            ],
            'showInEdit' => [
                'enabled' => false,
            ],
        ],
        [
            'label' => 'name',
            'store' => true,
            'showInIndex' => [
                'enabled' => true
            ],
            'showInEdit' => [
                'enabled' => true,
            ],
        ],
        [
            'label' => 'usuarios_por_empresa',
            'store' => false,
            'type' => 'integer',
            'showInIndex' => [
                'enabled' => true,
                'width' => '130px',
            ],
            'showInEdit' => [
                'enabled' => false,
            ],
        ],
    ];
}
