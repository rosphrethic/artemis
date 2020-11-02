<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoTicket;
use Illuminate\Validation\Rule;

class TipoTicketcontroller extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $tipos_tickets = TipoTicket::all();
        
        return view('sistema.tipos-tickets.index', compact('tipos_tickets'));
    }
    
    public function create() {
        return view('sistema.tipos-tickets.form');
    }

    public function store(Request $request, TipoTicket $tipo_ticket) {
        $validatedData = $request->validate([
            'nombre' => [
                'required',
                'between:1,255',
                'regex:/^[\pL\s\-]+$/u',
                Rule::unique('tipos_tickets')->ignore($tipo_ticket),
            ],
        ]);

        $tipo_ticket->nombre = $request->nombre;

        $tipo_ticket->save($validatedData);

        return redirect('/tipos-tickets')->with('message','El nuevo tipo de ticket ha sido agregado!');
    }

    public function edit(TipoTicket $tipo_ticket) {
        return view('sistema.tipos-tickets.form', compact('tipo_ticket'));
    }

    public function update(Request $request, TipoTicket $tipo_ticket) {
        $validatedData = $request->validate([
            'nombre' => [
                'required',
                'between:1,255',
                'regex:/^[a-zA-Z\s]+$/',
                Rule::unique('tipos_tickets')->ignore($tipo_ticket),
            ],
        ]);

        $tipo_ticket->update($validatedData);

        return redirect('/tipos-tickets')->with('message','El tipo de ticket ha sido editado!');
    }

    public function destroy(TipoTicket $tipo_ticket) {
        try {
            $tipo_ticket->delete();
        }
        catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000)
            {
                return redirect('/tipos-tickets')->with('pemessage','El tipo de ticket esta siendo actualmente utilizado, no puede ser eliminado!');
            }
        }
    
        return redirect('/tipos-tickets')->with('message','El tipo de ticket ha sido eliminado!');
    }
}
