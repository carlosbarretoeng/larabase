<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamentos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $with = ['empresa'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
