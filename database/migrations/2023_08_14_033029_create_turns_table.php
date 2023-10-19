<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('turns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('turn_type_id'); // Relación con tipos de turnos
            $table->unsignedBigInteger('module_id'); // Relación con módulos
           
            $table->integer('number');
            $table->string('identification')->nullable(); 
            $table->string('name')->nullable(); 

            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->timestamps();


            $table->string('status')->default('pending'); // Estado del turno
            $table->string('cancellation_reason')->nullable(); // Motivo de cancelación

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('turn_type_id')->references('id')->on('turn_types')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('turns');
    }
};
