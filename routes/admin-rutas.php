<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Administradores;
use App\Http\Controllers\Admin\SolicitudesPlanMedico;

Route::get('/', [Dashboard::class, 'index']);

Route::get('administradores', [Administradores::class, 'index'])->name('administradores');
Route::get('administradores/crear', [Administradores::class, 'crear'])->name('crear_administrador');
Route::get('administradores/{administrador}/editar', [Administradores::class, 'editar'])->name('editar_administrador');
Route::post('administradores/guardar/{administrador?}', [Administradores::class, 'guardar'])->name('guardar_administrador');
Route::get('administradores/{administrador}/eliminar', [Administradores::class, 'eliminar'])->name('eliminar_administrador');
Route::get('administradores/{administrador}/eliminar-archivo/{campo}', [Administradores::class, 'eliminarArchivo'])->name('eliminar_archivo_administrador');


// solicitudes/plan-medico
Route::get('solicitudes/plan-medico', [SolicitudesPlanMedico::class, 'index'])->name('solicitudes_pm');
Route::get('solicitudes/plan-medico/exportar', [SolicitudesPlanMedico::class, 'exportar'])->name('exportar_solicitudes_pm');
Route::get('solicitudes/plan-medico/crear', [SolicitudesPlanMedico::class, 'crear'])->name('crear_solicitud_pm');
Route::get('solicitudes/plan-medico/{solicitud}/editar', [SolicitudesPlanMedico::class, 'editar'])->name('editar_solicitud_pm');
Route::post('solicitudes/plan-medico/guardar/{solicitud?}', [SolicitudesPlanMedico::class, 'guardar'])->name('guardar_solicitud_pm');
Route::get('solicitudes/plan-medico/{solicitud}/eliminar', [SolicitudesPlanMedico::class, 'eliminar'])->name('eliminar_solicitud_pm');
Route::get('solicitudes/plan-medico/{solicitud}/desver', [SolicitudesPlanMedico::class, 'desver'])->name('desver_solicitud_pm');