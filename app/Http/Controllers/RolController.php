<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Rol;

class RolController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $roles = Rol::all();

        return view('sistema.roles.index', compact('roles'));
    }
    
    public function create() {
        return view('sistema.roles.form');
    }

    public function store(Request $request, Rol $rol) {
        $validatedData = $request->validate([
            'nombre' => [
                'required',
                'between:1,255',
                'regex:/^[\pL\s\-]+$/u',
                Rule::unique('roles')->ignore($rol),
            ],
        ]);

        $rol->nombre = $request->nombre;

        $rol->save($validatedData);

        return redirect('/roles')->with('message','El nuevo rol ha sido agregado!');
    }

    public function edit(Rol $rol) {
        return view('sistema.roles.form', compact('rol'));
    }

    public function update(Request $request, Rol $rol) {
        $validatedData = $request->validate([
            'nombre' => [
                'required',
                'between:1,255',
                'regex:/^[a-zA-Z\s]+$/',
                Rule::unique('roles')->ignore($rol),
            ],
        ]);

        $rol->update($validatedData);

        return redirect('/roles')->with('message','El rol ha sido editado!');
    }

    public function destroy(Rol $rol) {
        try {
            $rol->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return redirect('/roles')->with('pemessage','El rol esta siendo actualmente utilizado, no puede ser eliminado!');
            }
        }
    
        return redirect('/roles')->with('message','El rol ha sido eliminado!');
    }
}
