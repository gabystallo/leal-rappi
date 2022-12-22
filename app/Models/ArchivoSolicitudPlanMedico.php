<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\TieneArchivos;

class ArchivoSolicitudPlanMedico extends Model
{
	use EsOrdenable, TieneArchivos;

    protected $table = 'archivos_solicitud_plan_medico';

    protected $fillable = ['nombre'];

    protected $dir = ['archivo' => 'solicitudes/plan-medico/archivos'];

    protected $eliminarConArchivos = ['archivo'];

    public function solicitud()
    {
        return $this->belongsTo(SolicitudPlanMedico::class, 'id_solicitud');
    }
}
