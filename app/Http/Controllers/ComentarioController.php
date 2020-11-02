<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use Auth;
use Illuminate\Support\Facades\Storage;

class ComentarioController extends Controller
{
    public function store(Request $request, Comentario $comentario) {

        $validatedData = $request->validate([
            'ticket_id' => [
                'required',
            ],
            'mensaje' => [
                'required',
                'between:1,1024',
            ],
            'archivo' => [
                'file',
            ],
        ]);



        $comentario->user_id = Auth::user()->id;
        $comentario->ticket_id = $request->ticket_id;
        $comentario->mensaje = $request->mensaje;

        $comentario->save();

        if ($request->archivo) {
            $comentario->update(['archivo' => request()->archivo->store('archivos', 'public')]);
        }

        return redirect('/proyectos/' . $request->proyecto_id . '/tickets/' . $request->ticket_id)->with('message','El nuevo comentario ha sido agregado!');
    }
}
