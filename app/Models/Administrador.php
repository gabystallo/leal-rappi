<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Notifications\ReiniciarPasswordAdmin;
use App\Axys\Traits\TieneArchivos;

class Administrador extends Authenticatable
{
    use Notifiable, TieneArchivos;

    protected $table = 'administradores';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dir=[
        'foto'=>'contenido/administradores/fotos'
    ];

    protected $thumbnails = [
        'foto' => [
            'tn' => [160, 160],
        ]
    ];

    protected $eliminarConArchivos = ['foto'];

    public function tnPerfil()
    {
        if($this->tiene('tn')) {
            return $this->url('tn');
        }

        return url('img/usuario.svg');
    }

    //reescribo este método, para customizar el email del reseteo del password
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ReiniciarPasswordAdmin($token));
    }

    // public static function roles()
    // {
    //     return ['Administrador', 'Operador'];
    // }

    // public function admin()
    // {
    //     return $this->rol=='Administrador';
    // }
    // public function operador()
    // {
    //     return $this->rol=='Operador';
    // }
}
