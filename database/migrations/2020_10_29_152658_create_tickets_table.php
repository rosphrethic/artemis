<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('asignado_a')->nullable();
            $table->string('descripcion');
            $table->string('prioridad');
            $table->string('estado')->default('Pendiente');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            $table->foreign('tipo_id')->references('id')->on('tipos_tickets');
            $table->foreign('asignado_a')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
