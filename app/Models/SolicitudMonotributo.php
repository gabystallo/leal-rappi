<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudMonotributo extends Model
{

    protected $table = 'solicitudes_monotributo';
    protected $fillable = ['nombre', 'email', 'cuit', 'celular', 'id_rappi', 'nacionalidad', 'monotributista'];
    
    public function getFechaAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }
    
    public function archivos()
    {
        return $this->hasMany(ArchivoSolicitudMonotributo::class, 'id_solicitud');
    }
}
