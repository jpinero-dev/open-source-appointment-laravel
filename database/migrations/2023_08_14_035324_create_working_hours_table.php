<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends  Migration
{
    public function up()
    {
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->string('day_of_week'); // Día de la semana (Ej: Lunes, Martes, etc.)
            $table->time('start_time'); // Hora de inicio del horario
            $table->time('end_time'); // Hora de fin del horario
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('working_hours');
    }
};