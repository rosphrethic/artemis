<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    // Ayudantes
    public function getActiveRoles() {
        return Rol::where('estado', 'Activo')->get();
    }

    public function getAllUsuarios() {
        return User::all();
    }
    
    // Acciones
    public function index() {
        $usuarios = $this->getAllUsuarios();

        $usuarios_roles_array = $usuarios->toArray();

        return view('sistema.usuarios.index', compact('usuarios', 'usuarios_roles_array'));
    }
    
    public function create() {
        $roles = $this->getActiveRoles();

        return view('sistema.usuarios.form', compact('roles'));
    }

    public function store(Request $request, User $user) {
        $validatedData = $request->validate([
            'nombre' => [
                'required',
                'regex:/^[\pL\s\-]+$/u',
            ],
            'apellido' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user),
            ],
            'rol_id' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ]);

        $passwordHash = Hash::make($request->password);

        $user->name = $request->nombre;
        $user->lastname = $request->apellido;
        $user->email = $request->email;
        $user->rol_id = $request->rol_id;
        $user->password = $passwordHash;

        $user->save();

        return redirect('/usuarios')->with('message','El nuevo usuario ha sido agregado!');
    }

    public function edit(User $user) {
        $roles = $this->getActiveRoles();

        return view('sistema.usuarios.form', compact('user', 'roles'));
    }

    public function update(Request $request, User $user) {
        $validatedData = $request->validate([
            'nombre' => [
                'required',
                'regex:/^[\pL\s\-]+$/u',
            ],
            'apellido' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user),
            ],
            'rol_id' => [
                'required',
            ],
        ]);
    
        $user->rol_id = $request->rol_id;
        $user->name = $request->nombre;
        $user->lastname = $request->apellido;
        $user->email = $request->email;

        $user->save();

        return redirect('/usuarios')->with('message','El usuario ha sido editado!');
    }

    public function deactivate(User $user) {
        $user->status = 'Inactivo';
        
        $user->save();
        
        return redirect('/usuarios')->with('message','El usuario ha sido desactivado!');
    }

    public function reactivate(User $user) {
        $user->status = 'Activo';
        
        $user->save();
        
        return redirect('/usuarios')->with('message','El usuario ha sido reactivado!');
    }

    public function destroy(User $user) {
        try {
            $user->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return redirect('/usuarios')->with('pemessage','El usuario esta siendo actualmente utilizado, no puede ser eliminado!');
            }
        }
        return redirect('/usuarios')->with('message','El usuario ha sido eliminado!');
    }
}
