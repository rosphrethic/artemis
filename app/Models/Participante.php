<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    use HasFactory;

    protected $table = 'participantes';

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'participante_id');
    }

    public function proyecto() {
        return $this->belongsTo(Proyecto::class);
    }
}
