<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsisLlave extends Model
{
    protected $table = 'asis_llave';
    protected $primaryKey = 'id_llave';
    protected $fillable = [
        'codigo',
        'disponible',
        'estado',
        'orden'
    ];

    const CREATED_AT = 'fecha_registra';
    const UPDATED_AT = 'fecha_actualiza';
}
