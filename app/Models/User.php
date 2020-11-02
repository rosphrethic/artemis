<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ticket() {
        return $this->hasMany(Ticket::class);
    }

    public function proyecto() {
        return $this->hasMany(Proyecto::class);
    }

    public function rol() {
        return $this->hasOne(Rol::class, 'id', 'rol_id');
    }

    public function ticketasignado() {
        return $this->belongsTo(Ticket::class, 'id', 'asignado_a');
    }

    public function participante() {
        return $this->hasMany(Participante::class);
    }

    public function comentario() {
        return $this->hasMany(Comentario::class);
    }
}