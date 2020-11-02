<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(Proyecto::class);
    }

    public function ticket() {
        return $this->hasMany(Ticket::class);
    }

    public function participante() {
        return $this->hasMany(Participante::class);
    }
}
