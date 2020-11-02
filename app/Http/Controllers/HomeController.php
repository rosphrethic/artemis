<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Participante;
use App\Models\Ticket;
use App\Models\Comentario;
use App\Models\Proyecto;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $proyectos_colaborados = count(Participante::where('participante_id', $user->id)->get());
        $tickets_finalizados = count(Ticket::where([['asignado_a', $user->id], ['estado', 'Finalizado']])->get());
        $comentarios_realizados = count(Comentario::where('user_id', $user->id)->get());

        $user = User::find(Auth::user()->id);

        return view('home', compact('user', 'proyectos_colaborados', 'tickets_finalizados', 'comentarios_realizados'));
    }
    
    public function update(Request $request, User $user) {
        if ($request->imagen) {
            $user->update(['imagen' => request()->imagen->store('fotos_perfiles', 'public')]);

            $path = request()->imagen->store('fotos', 'public');
    
            $user->imagen = $path;
            
            $user->save();
        }

        return redirect('/')->with('message','Tu perfil ha sido actualizado!');
    }
}
