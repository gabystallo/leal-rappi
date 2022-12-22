<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Axys\Traits\EsOrdenable;
use App\Axys\Traits\TieneArchivos;

class ArchivoSolicitudMonotributo extends Model
{
	use EsOrdenable, TieneArchivos;

    protected $table = 'archivos_solicitud_monotributo';

    protected $fillable = ['nombre'];

    protected $dir = ['archivo' => 'solicitudes/monotributo/archivos'];

    protected $eliminarConArchivos = ['archivo'];

    public function solicitud()
    {
        return $this->belongsTo(SolicitudMonotributo::class, 'id_solicitud');
    }
}
