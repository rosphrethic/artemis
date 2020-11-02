<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\Rol;
use App\Models\Ticket;
use App\Models\Comentario;
use App\Models\TipoTicket;
use Auth;

class TicketController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($proyecto, $ticket) {
        $ticket = Ticket::find($ticket);
        $comentarios = Comentario::where('ticket_id', $ticket->id)->get();

        return view('general.tickets.show', compact('proyecto', 'ticket', 'comentarios'));
    }
    
    public function myTickets() {
        $tickets_activos = Ticket::where([['estado', 'Activo'], ['asignado_a', Auth::user()->id]])->get();
        $tickets_finalizados = Ticket::where([['estado', 'Finalizado'], ['asignado_a', Auth::user()->id]])->get();

        return view('general.mis-tickets.index', compact('tickets_activos', 'tickets_finalizados'));
    }

    public function store(Request $request, Ticket $ticket) {
        $validatedData = $request->validate([
            'proyecto_id' => [
                'required',
            ],
            'tipo_id' => [
                'required',
            ],
            'descripcion' => [
                'required',
                'between:1,255',
            ],
            'prioridad' => [
                'required',
                'between:1,255',
            ],
        ]);

        $ticket->user_id = Auth::user()->id;
        $ticket->proyecto_id = $request->proyecto_id;
        $ticket->tipo_id = $request->tipo_id;
        $ticket->descripcion = $request->descripcion;
        $ticket->prioridad = $request->prioridad;

        $ticket->save($validatedData);

        return redirect('/proyectos/' . $request->proyecto_id)->with('message','El nuevo ticket ha sido agregado!');
    }

    public function update(Request $request, Proyecto $proyecto, Ticket $ticket) {
        $validatedData = $request->validate([
            'tipo_id' => [
                'required',
            ],
            'descripcion' => [
                'required',
                'between:1,255',
            ],
            'prioridad' => [
                'required',
                'between:1,255',
            ],
        ]);

        $ticket->update($validatedData);

        return redirect('/proyectos/' . $proyecto->id . '/tickets/' . $ticket->id)->with('message','El ticket ha sido editado!');
    }

    public function assign(Request $request, Ticket $ticket) {
        $ticket = Ticket::find($request->ticket_id);

        $ticket->asignado_a = $request->participante_id;
        $ticket->estado = 'Activo';
        
        $ticket->save();

        return redirect('/proyectos/' . $request->proyecto_id)->with('message','El ticket ha sido asignado!');
    }

    public function unassign(Request $request, Proyecto $proyecto, Ticket $ticket) {
        $ticket->asignado_a = null;
        $ticket->estado = 'Pendiente';

        $ticket->save();

        return redirect('/proyectos/' . $proyecto->id)->with('message','El ticket ha sido desasignado!');
    }

    public function finalize(Request $request, Proyecto $proyecto, Ticket $ticket) {
        $ticket->estado = 'Finalizado';
        
        $ticket->save();

        return redirect('/proyectos/' . $proyecto->id)->with('message','El ticket ha sido finalizado!');
    }

    public function anull(Request $request, Proyecto $proyecto, Ticket $ticket) {
        $ticket->estado = 'Anulado';
        
        $ticket->save();

        return redirect('/proyectos/' . $proyecto->id)->with('message','El ticket ha sido anulado!');
    }

    public function destroy(Request $request, Proyecto $proyecto, Ticket $ticket) {
        try {
            $ticket->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return redirect('/proyectos/' . $proyecto->id)->with('message','El ticket esta siendo actualmente utilizado, no puede ser eliminado!');
            }
        }
        return redirect('/proyectos/' . $proyecto->id)->with('message','El ticket ha sido eliminado!');
    }

    public function show(Proyecto $proyecto) {
        return view('general.proyectos.show', compact('proyecto', 'supervisor_asignado', 'tickets'));
    }

    public function edit(Proyecto $proyecto, Ticket $ticket) {
        $tipos_tickets = TipoTicket::where('estado', 'Activo')->get();

        return view('general.tickets.edit', compact('proyecto', 'ticket', 'tipos_tickets'));
    }
}
