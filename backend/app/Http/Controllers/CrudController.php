<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CrudController extends Controller
{
    protected $entity = null;
    protected $index_page = 'Crud/Index';

    public function __construct()
    {
        if(empty($this->entity)){
            throw new \Error("Entity not defined");
        }
    }

    protected function getIndexData(){
        return $this->entity::query()->paginate(5)->toArray();
    }

    protected function responseIndex($data){
        return Inertia::render($this->index_page, $data);
    }

    public function index()
    {
        $data = $this->getIndexData();
        return $this->responseIndex($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
