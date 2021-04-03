<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinicas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'logo',
        'subDescripcion',
        'descripcion',
        'apr1',
        'apr2',
        'userId',
        'categoriaId',
        'estado'
    ];
}
