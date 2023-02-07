<?php

namespace App\Http\Controllers;

use App\Models\MotivosDeParada;
use Illuminate\Http\Request;

class MotivosDeParadaController extends CrudController
{
    protected $label = "Motivos de Parada";
    protected $entity = MotivosDeParada::class;

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
    ];
}
