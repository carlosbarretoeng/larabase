<?php

namespace App\Http\Controllers;

use App\Models\Departamentos;
use App\Models\Empresa;
use Illuminate\Http\Request;

class DepartamentosController extends CrudController
{
    protected $label = "Departamentos";
    protected $entity = Departamentos::class;

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
                    'width' => '130px',
                ],
                'showInEdit' => [
                    'enabled' => false,
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
        ];
    }
}
