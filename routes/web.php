<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\VProductoController;
use App\Http\Controllers\AsisLlaveController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/menu', function () {
    return Inertia::render('Menu');
});

Route::get('/menu/submenucito', function () {
    return Inertia::render('Submenucito');
});

// Rutas de configuración agrupadas con middleware de autenticación
Route::prefix('configuration')
    ->middleware(['auth', 'verified']) // Protege todas las rutas con autenticación
    ->group(function () {
        Route::get('/tipo-documento', function () {
            return Inertia::render('configuration/tipo-documento/TipoDocumento');
        });
        
        // Aquí puedes añadir más rutas de configuración
    });
 

Route::get('/hola-mundo', function () {
    return Inertia::render('HolaMundo');
})->name('hola-mundo');

Route::get('/webtest', function () {
    return view('web.web'); // Asumiendo que tu vista está en resources/views/web/web.blade.php
})->name('webtest');


//Creando rutas en laravel
Route::get('/aplicaciones/actividades', function(){
    return Inertia::render('Actividades');
});

Route::get('/aplicaciones/yesno', function(){
    return Inertia::render('YesNo');
});

//Rutas para productos
Route::get('/senati/productos',[VProductoController::class,'listarProductos']);


//Rutas para llaves
Route::get('/configuracion/llaves',[AsisLlaveController::class,'index'])->name('configuracion.llaves');
Route::post('/configuracion/crear-llave',[AsisLlaveController::class,'store'])->name('configuracion.crear-llave');
Route::delete('/configuracion/eliminar-llave/{id_llave}',[AsisLlaveController::class,'destroy'])->name('configuracion.eliminar-llave');
Route::get('/configuracion/llaves-pdf',[AsisLlaveController::class,'llavePdf'])->name('configuracion.llave-pdf');
Route::put('/configuracion/llave/{id_llave}',[AsisLlaveController::class,'update'])->name('configuracion.llave.update');

//hemos mejorados algo
Route::get('diego',[AsisLlaveController::class,'diego'])->name('diego');

// API para obtener usuarios
Route::get('/api/users',[UserController::class,'index'])->middleware(['auth'])->name('api.users');
Route::get('/api/users/search',[UserController::class,'search'])->middleware(['auth'])->name('api.users.search');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
