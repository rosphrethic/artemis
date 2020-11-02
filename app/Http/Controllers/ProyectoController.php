<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\Rol;
use App\Models\Ticket;
use App\Models\TipoTicket;
use App\Models\Participante;
use Auth;

class ProyectoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    // Ayudantes
    public function getActiveProyectos() {
        return Proyecto::all();
    }

    public function getActiveUsuarios() {
        return User::where('status', 'Activo')->get();
    }
    
    public function index() {
        $proyectos = $this->getActiveProyectos();
        
        return view('general.proyectos.index', compact('proyectos'));
    }
    
    public function create() {
        $usuarios = $this->getActiveUsuarios();

        return view('general.proyectos.create', compact('usuarios'));
    }

    public function store(Request $request, Proyecto $proyecto) {
        $validatedData = $request->validate([
            'supervisor_id' => [
                'required',
            ],
            'nombre' => [
                'required',
                'between:1,255',
            ],
            'descripcion' => [
                'required',
                'between:1,255',
            ],
        ]);

        $proyecto->user_id = Auth::user()->id;
        $proyecto->supervisor_id = $request->supervisor_id;
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;

        $proyecto->save($validatedData);

        return redirect('/proyectos')->with('message','El nuevo proyecto ha sido agregado!');
    }

    public function show(Proyecto $proyecto) {
        $tickets_activos_porcentaje = 0;
        $tickets_pendientes_porcentaje = 0;
        $tickets_finalizados_porcentaje = 0;
        $tickets_anulados_porcentaje = 0;

        $usuarios = User::where('status', 'Activo')->get();

        $participantes_id_array = Participante::where('proyecto_id', $proyecto->id)->pluck('participante_id')->toArray();

        $supervisor_asignado = User::where('id', $proyecto->supervisor_id)->first();

        $supervisor_asignado_array = User::where('id', $proyecto->supervisor_id)->first()->toArray();

        $participantes_filtrados = User::all()->except($participantes_id_array)->except($supervisor_asignado_array);
        

        $tickets = Ticket::where('proyecto_id', $proyecto->id)->get();
        $tickets_para_asignar = Ticket::where([['proyecto_id', $proyecto->id], ['estado', 'Pendiente']])->get();

        $tickets_activos = count(Ticket::where([['proyecto_id', $proyecto->id], ['estado', 'Activo']])->get());
        $tickets_pendientes = count(Ticket::where([['proyecto_id', $proyecto->id], ['estado', 'Pendiente']])->get());
        $tickets_finalizados = count(Ticket::where([['proyecto_id', $proyecto->id], ['estado', 'Finalizado']])->get());
        $tickets_anulados = count(Ticket::where([['proyecto_id', $proyecto->id], ['estado', 'Anulado']])->get());

        $tickets_total = count(Ticket::where('proyecto_id', $proyecto->id)->get());

        if ($tickets_total != 0) {
            $tickets_activos_porcentaje = ($tickets_activos * 100) / $tickets_total;
            $tickets_pendientes_porcentaje = ($tickets_pendientes * 100) / $tickets_total;
            $tickets_finalizados_porcentaje = ($tickets_finalizados * 100) / $tickets_total;
            $tickets_anulados_porcentaje = ($tickets_anulados * 100) / $tickets_total;
        }

        $tipos_tickets = TipoTicket::where('estado', 'Activo')->get();

        $participantes = Participante::where('proyecto_id', $proyecto->id)->get();
        
        return view('general.proyectos.show', compact('proyecto', 'supervisor_asignado', 'tickets_activos', 'tickets_pendientes', 'tickets', 'tickets_para_asignar',
        'tickets_finalizados', 'tickets_total', 'tickets_activos_porcentaje', 'tickets_pendientes_porcentaje', 'tickets_finalizados_porcentaje', 
        'tipos_tickets', 'participantes', 'usuarios', 'participantes_filtrados', 'tickets_anulados', 'tickets_anulados_porcentaje'));
    }

    public function edit(Proyecto $proyecto) {
        $usuarios = $this->getActiveUsuarios();

        $supervisor_actual = User::find($proyecto->supervisor_id);

        return view('general.proyectos.edit', compact('proyecto', 'usuarios', 'supervisor_actual'));
    }

    public function update(Request $request, Proyecto $proyecto) {
        $validatedData = $request->validate([
            'supervisor_id' => [
                'required',
            ],
            'nombre' => [
                'required',
                'between:1,255',
            ],
            'descripcion' => [
                'required',
                'between:1,255',
            ],
        ]);

        $proyecto->supervisor_id = $request->supervisor_id;
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;

        $proyecto->update($validatedData);

        return redirect('/proyectos/' . $proyecto->id)->with('message','El proyecto ha sido editado!');
    }

    public function finalize(Request $request, Proyecto $proyecto) {
        $proyecto->update(['estado' => 'Finalizado']);

        return redirect('/proyectos')->with('message','El proyecto ha sido finalizado!');
    }

    public function anull(Request $request, Proyecto $proyecto) {
        $proyecto->update(['estado' => 'Anulado']);

        return redirect('/proyectos')->with('message','El proyecto ha sido anulado!');
    }

    public function destroy(Proyecto $proyecto) {
        try {
            $proyecto->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return redirect('/proyectos/' . $proyecto->id)->with('message','El proyecto esta siendo actualmente utilizado, no puede ser eliminado!');
            }
        }
    
        return redirect('/proyectos')->with('message','El proyecto ha sido eliminado!');
    }
}
