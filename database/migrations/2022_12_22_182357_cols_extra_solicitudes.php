<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ColsExtraSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitudes_plan_medico', function (Blueprint $table) {
            $table->string('clave_fiscal')->nullable();
            $table->string('forma_contacto')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('solicitud_afiliacion')->nullable();
            $table->string('afiliado')->nullable();
        });

        Schema::table('solicitudes_monotributo', function (Blueprint $table) {
            $table->string('clave_fiscal')->nullable();
            $table->string('forma_contacto')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('solicitud_afiliacion')->nullable();
            $table->string('afiliado')->nullable();
        });

        Schema::create('archivos_solicitud_plan_medico', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->boolean('visible')->default(true);
            $table->integer('orden')->unsigned();

            $table->bigInteger('id_solicitud')->unsigned();
            $table->foreign('id_solicitud')->references('id')->on('solicitudes_plan_medico');

            $table->string('nombre');
            $table->string('archivo')->nullable();
        });

        Schema::create('archivos_solicitud_monotributo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->boolean('visible')->default(true);
            $table->integer('orden')->unsigned();

            $table->bigInteger('id_solicitud')->unsigned();
            $table->foreign('id_solicitud')->references('id')->on('solicitudes_monotributo');

            $table->string('nombre');
            $table->string('archivo')->nullable();
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
            $table->dropColumn('clave_fiscal');
            $table->dropColumn('forma_contacto');
            $table->dropColumn('observaciones');
            $table->dropColumn('solicitud_afiliacion');
            $table->dropColumn('afiliado');
        });

        Schema::table('solicitudes_monotributo', function (Blueprint $table) {
            $table->dropColumn('clave_fiscal');
            $table->dropColumn('forma_contacto');
            $table->dropColumn('observaciones');
            $table->dropColumn('solicitud_afiliacion');
            $table->dropColumn('afiliado');
        });

        Schema::dropIfExists('archivos_solicitud_plan_medico');
        Schema::dropIfExists('archivos_solicitud_monotributo');
    }
}
