<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoTicketController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\PerfilController;

Auth::routes();

// General ------------------------------------------------------------------------------------------------------

    // Logout
        Route::get('logout', 'LoginController@logout');

    // Home
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::patch('/{user}/update', [App\Http\Controllers\HomeController::class, 'update']);
        

// Sistema ------------------------------------------------------------------------------------------------------

    // Roles Controller
        Route::get('/roles', [RolController::class, 'index']);
        Route::get('/roles/create', [RolController::class, 'create']);
        Route::post('/roles/store', [RolController::class, 'store']);
        Route::get('/roles/edit/{rol}', [RolController::class, 'edit']);
        Route::patch('/roles/update/{rol}', [RolController::class, 'update']);
        Route::delete('/roles/delete/{rol}', [RolController::class, 'destroy']);

    // Users Controller
        Route::get('/usuarios', [UserController::class, 'index']);
        Route::get('/usuarios/create', [UserController::class, 'create']);
        Route::post('/usuarios/store', [UserController::class, 'store']);
        Route::get('/usuarios/edit/{user}', [UserController::class, 'edit']);
        Route::patch('/usuarios/update/{user}', [UserController::class, 'update']);
        Route::patch('/usuarios/deactivate/{user}', [UserController::class, 'deactivate']);
        Route::patch('/usuarios/reactivate/{user}', [UserController::class, 'reactivate']);
        Route::delete('/usuarios/delete/{user}', [UserController::class, 'destroy']);

    // Tipos de Tickets Controller
        Route::get('/tipos-tickets', [TipoTicketController::class, 'index']);
        Route::get('/tipos-tickets/create', [TipoTicketController::class, 'create']);
        Route::post('/tipos-tickets/store', [TipoTicketController::class, 'store']);
        Route::get('/tipos-tickets/edit/{tipo_ticket}', [TipoTicketController::class, 'edit']);
        Route::patch('/tipos-tickets/update/{tipo_ticket}', [TipoTicketController::class, 'update']);
        Route::delete('/tipos-tickets/delete/{tipo_ticket}', [TipoTicketController::class, 'destroy']);

// General ------------------------------------------------------------------------------------------------------

    // Proyectos Controller
        Route::get('/proyectos', [ProyectoController::class, 'index']);
        Route::get('/proyectos/create', [ProyectoController::class, 'create']);
        Route::post('/proyectos/store', [ProyectoController::class, 'store']);
        Route::get('/proyectos/{proyecto}', [ProyectoController::class, 'show']);
        Route::get('/proyectos/edit/{proyecto}', [ProyectoController::class, 'edit']);
        Route::patch('/proyectos/update/{proyecto}', [ProyectoController::class, 'update']);
        Route::patch('/proyectos/finalize/{proyecto}', [ProyectoController::class, 'finalize']);
        Route::patch('/proyectos/anull/{proyecto}', [ProyectoController::class, 'anull']);
        Route::delete('/proyectos/delete/{proyecto}', [ProyectoController::class, 'destroy']);

    // Tickets Controller
        Route::get('/proyectos/{proyecto}/tickets/{ticket}', [TicketController::class, 'index']);
        Route::get('/proyectos/{proyecto}/tickets/{ticket}/edit', [TicketController::class, 'edit']);
        Route::patch('/proyectos/{proyecto}/tickets/{ticket}/update', [TicketController::class, 'update']);
        Route::patch('/proyectos/{proyecto}/tickets/{ticket}/unassign', [TicketController::class, 'unassign']);
        Route::patch('/proyectos/{proyecto}/tickets/{ticket}/finalize', [TicketController::class, 'finalize']);
        Route::patch('/proyectos/{proyecto}/tickets/{ticket}/anull', [TicketController::class, 'anull']);
        Route::delete('/proyectos/{proyecto}/tickets/{ticket}/delete', [TicketController::class, 'destroy']);

        Route::post('/proyectos/{proyecto}/create-ticket', [TicketController::class, 'store']);
        Route::patch('/proyectos/assign/{proyecto}', [TicketController::class, 'assign']);

    // Participante Controller
        Route::post('/proyectos/add/{proyecto}', [ParticipanteController::class, 'store']);
        Route::delete('/proyectos/remove/{proyecto}', [ParticipanteController::class, 'destroy']);

    // Comentario Controller
        Route::post('/proyectos/{proyecto}/tickets/{ticket}/comment', [ComentarioController::class, 'store']);

    // Mis Tickets Controller
        Route::get('/tickets', [TicketController::class, 'myTickets']);