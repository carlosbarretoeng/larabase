<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends ModelCrud
{
    protected $appends = [
        'usuarios_por_empresa',
    ];

    function getUsuariosPorEmpresaAttribute(){
        $id = $this->attributes['id'] ?? null;
        if(is_null($id)){
            return 0;
        }
        $val = User::where('empresa_id', $id)->count() ?? 0;
        return $val;
    }

//    public function usuarios()
//    {
//        return $this->hasMany(User::class);
//    }
}
