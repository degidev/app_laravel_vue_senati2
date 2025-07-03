<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VProducto;

class VProductoController extends Controller
{
    public function listarProductos(){
        //"select * from v_producto";
        //$productos = VProducto::all();
        //$productos = VProducto::first();
        $productos = VProducto::where('estado',0)->get();
        //dd($productos);
        //var_dump($productos);
        //print_r($productos);
        //imprimir en json
        return response()->json($productos);
    }
}
