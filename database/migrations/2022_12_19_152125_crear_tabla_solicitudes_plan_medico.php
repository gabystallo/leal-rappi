<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaSolicitudesPlanMedico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_plan_medico', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('nombre');
            $table->string('email')->nullable();
            $table->string('cuit')->nullable();
            $table->string('celular')->nullable();
            $table->string('id_rappi')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('monotributista')->nullable();
            $table->boolean('quiero_ser_contactado')->nullable();

            $table->boolean('vista')->default(false);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes_plan_medico');
    }
}
