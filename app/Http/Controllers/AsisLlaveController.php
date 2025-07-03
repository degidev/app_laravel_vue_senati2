<?php

namespace App\Http\Controllers;

use App\Models\AsisLlave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AsisLlaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $llaves = AsisLlave::all();
        //return response()->json($llaves);
        return Inertia::render('configuracion/AsisLlaves',[
            'llaves'=>$llaves,
            'estudiante'=>[
                'nombre'=>'Diego Lipa',
                'institucion'=>'SENATI',
            ],
            'datos_academicos'=>[
                
            ],
            'flash'=>[
                'success'=>session('success'),
                'error'=>session('error'),
            ],
        ]);
    }

    //Generar pdf para mostrar la lista de laves disponibles
    public function llavePdf(){
        $llaves = AsisLlave::all();
        $pdf = \PDF::loadView('pdf.llaves_pdf', compact('llaves'));
        return $pdf->stream('llaves.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validador = $request->validate([
            'codigo'=>'required',
            'disponible'=>'required',
            'estado'=>'required',
            'orden'=>'required',
        ]);

        AsisLlave::create($validador);
        return Redirect::route('configuracion.llaves')
        ->with('success','Llave creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_llave)
    {
        $validador = $request->validate([
            'codigo'=>'required',
            'disponible'=>'required',
            'estado'=>'required',
            'orden'=>'required',
        ]);

        $llave = AsisLlave::findOrFail($id_llave);
        dd($llave);

        $llave->update($validador);
        return Redirect::route('configuracion.llaves')
        ->with('success','Llave actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $llave = AsisLlave::findOrFail($id);
        $llave->delete();
        return Redirect::route('configuracion.llaves')
        ->with('success','Llave elinada correctamente');
    }
}
