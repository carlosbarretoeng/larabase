<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CrudController extends Controller
{
    protected $entity = null;
    protected $label = null;
    protected $routeName = null;
    protected $index_page = 'Crud/Index';
    protected $edit_page = 'Crud/Edit';
    protected $model_columns = null;

    public function __construct()
    {
        if (empty($this->entity)) {
            throw new \Error("Entity not defined");
        }
        $array = explode('\\', strtolower($this->entity));
        $this->routeName = end($array);
    }

    protected function populateColumns($column): array
    {
        $arr = [
            'label' => '',
            'translate' => 'A',
            'type' => 'string',
            'store' => true,
            'showInIndex' => [
                'enabled' => true,
                'width' => '1px'
            ],
            'showInEdit' => [
                'enabled' => true,
            ],
        ];
        return array_merge($arr, $column);
    }

    protected function getCrudInfos($context)
    {
        $columns = [];
        $columnsNames = array_keys($this->entity::first()->toArray());
        foreach ($columnsNames as $columnsName) {
            $columns[$columnsName] = $this->populateColumns([
                'label' => $columnsName,
                'translate' => __(strtolower(str_replace('\\', '.', $this->entity)) . '.' . $columnsName)
            ]);
        }
        if ($this->model_columns != null) {
            $model_columns_filtered = array_filter($this->model_columns, function ($column) use ($context) {
                return $column['showIn' . $context]['enabled'];
            });

            $model_columns_filtered_names = array_column($model_columns_filtered, 'label');
            $columns = array_filter($columns, function ($column) use ($model_columns_filtered_names) {
                return in_array($column['label'], $model_columns_filtered_names);
            });
            foreach ($model_columns_filtered as $mcf) {
                if (!isset($columns[$mcf['label']])) {
                    $columns[$mcf['label']] = array_merge($this->populateColumns([
                        'label' => $mcf['label'],
                        'translate' => __(strtolower(str_replace('\\', '.', $this->entity)) . '.' . $mcf['label'])
                    ]), $mcf);
                }else{
                    $columns[$mcf['label']] = $mcf;
                }
            }
            $orderLabels = array_column($model_columns_filtered, 'label');
            $newCols = [];
            foreach ($orderLabels as $orderLabel) {
                $newOne = array_filter($columns, function ($column) use ($orderLabel) {
                    return $column['label'] === $orderLabel;
                });
                reset($newOne);
                $newCols[$orderLabel] = current($newOne);
            }
            $columns = $newCols;
        }
        return [
            'label' => __($this->label ?? strtolower(str_replace('\\', '.', $this->entity)) . '.label'),
            'columns' => $columns,
            'routeName' => $this->routeName
        ];
    }

    protected function getIndexData()
    {
        $queryData = $this->entity::query()->paginate(5)->toArray();
        return array_merge(
            $queryData,
            $this->getCrudInfos('Index')
        );
    }

    protected function responseIndex($data)
    {
        return Inertia::render($this->index_page, $data);
    }

    public function index()
    {
        $data = $this->getIndexData();
        return $this->responseIndex($data);
    }

    protected function getCreateData($id = null)
    {
        $queryData = is_null($id) ? [] : $this->entity::query()->where('id', $id)->paginate(5)->toArray();
        return array_merge(
            $queryData,
            $this->getCrudInfos('Edit')
        );
    }

    protected function responseCreate($data)
    {
        return Inertia::render($this->edit_page, $data);
    }

    public function create()
    {
        $data = $this->getCreateData();
        return $this->responseCreate($data);
    }

    public function store(Request $request)
    {
        $attrs = $request->all();
        $model = new $this->entity;
        $columnsToStore = array_filter($this->model_columns, function ($column) {
            return $column['store'];
        });
        foreach ($columnsToStore as $column) {
            $key = $column['label'];
            $value = $attrs[$column['label']];
            if ($column['type'] === 'select') {
                continue;
            }
            $model[$key] = $value;
        }
        $model->save();
        return Redirect::route($this->routeName . '.index');
    }

    public function show($id)
    {
        $data = $this->getCreateData($id);
        return $this->responseCreate($data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    protected function executeDestroy($id)
    {
        $entity = $this->entity::find($id);
        $entity->delete();
    }

    protected function responseDestroy()
    {
        return Redirect::route($this->routeName . '.index');
    }

    public function destroy($id)
    {
        $this->executeDestroy($id);
        return $this->responseDestroy();
    }
}
