<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'secciones';
    protected $fillable = [
        'nombre',
        'id_categoria',
    ];
}
