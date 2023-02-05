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
        return User::query()->where('empresa_id', $this->attributes['id'])->count();
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
