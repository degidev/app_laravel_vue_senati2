<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        // Obtener todos los usuarios de la base de datos
        $users = User::select('id', 'name', 'email')
            ->orderBy('name')
            ->get();
            
        // Siempre devolver JSON para las peticiones API
        return response()->json($users);
    }

    public function search(Request $request)
    {
        $query = $request->input('query', '');
        
        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->select('id', 'name', 'email')
            ->orderBy('name')
            ->limit(10)
            ->get();
            
        // Siempre devolver JSON para las peticiones API
        return response()->json($users);
    }
}
