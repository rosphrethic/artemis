<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participante;
use DB;

class ParticipanteController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request, Participante $participante) {
        $validatedData = $request->validate([
            'participante_id' => [
                'required',
                'between:1,255'
            ],
        ]);

        $participante->proyecto_id = $request->proyecto_id;
        $participante->participante_id = $request->participante_id;

        $participante->save($validatedData);        

        return redirect('/proyectos/' . $request->proyecto_id)->with('message','El participante ha sido agregado!');
    }

    public function destroy(Request $request, Participante $participante) {
        $ticket_estado_actual = DB::table('tickets')->where([['proyecto_id', $request->proyecto_id], ['asignado_a', $request->participante_id]])->get();

        if ($ticket_estado_actual) {
            return redirect('/proyectos/' . $request->proyecto_id)->with('message','El participante tiene tickets activos, no puede ser removido!');
        } else {

            dd($ticket_estado_actual);
            $participante = Participante::find($request->actual_participante_id);
            $participante->delete();

            $reset_asignado_a = DB::table('tickets')->where([['proyecto_id', $request->proyecto_id], ['asignado_a', $request->participante_id]])->update(['estado' => 'Pendiente']);
            $reset_asignado_a = DB::table('tickets')->where([['proyecto_id', $request->proyecto_id], ['asignado_a', $request->participante_id]])->update(['asignado_a' => null]);
        }

        return redirect('/proyectos/' . $request->proyecto_id)->with('message','El participante ha sido removido!');
    }
}