<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudPlanMedico extends Model
{

    protected $table = 'solicitudes_plan_medico';
    protected $fillable = ['nombre', 'email', 'cuit', 'celular', 'id_rappi', 'nacionalidad', 'monotributista'];
    
    public function getFechaAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }
    
    
}
