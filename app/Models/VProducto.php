<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VProducto extends Model
{
    use HasFactory;
    protected $table = 'v_producto';
    protected $primaryKey = 'id_producto';
    protected $fillable = [
        'nombre_producto',
        'estado',
        'descripcion',
        'stock'
    ];
    //omitir timestamps
    public $timestamps = false;
}
