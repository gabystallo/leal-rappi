<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ColHorarioContacto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitudes_plan_medico', function (Blueprint $table) {
            $table->string('horario_contacto')->nullable()->after('quiero_ser_contactado');
        });

        Schema::table('solicitudes_monotributo', function (Blueprint $table) {
            $table->string('horario_contacto')->nullable()->after('quiero_ser_contactado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('solicitudes_plan_medico', function (Blueprint $table) {
            $table->dropColumn('horario_contacto');
        });
        Schema::table('solicitudes_monotributo', function (Blueprint $table) {
            $table->dropColumn('horario_contacto');
        });
    }
}
