<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursales extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'ubicacion',
        'puntosReferencia',
        'horarioI',
        'horarioF',
        'descripcion',
        'telefono',
        'municipio',
        'departamento',
        'clinicaId',
        'estado'
    ];

}
