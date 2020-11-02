<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function asignadoa() {
        return $this->hasOne(User::class, 'id', 'asignado_a');
    }

    public function proyecto() {
        return $this->belongsTo(Proyecto::class);
    }

    public function tipoticket() {
        return $this->hasOne(TipoTicket::class, 'id', 'tipo_id');
    }

    public function comentario() {
        return $this->hasMany(Comentario::class);
    }
}
