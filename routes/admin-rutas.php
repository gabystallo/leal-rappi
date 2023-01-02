<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Administradores;
use App\Http\Controllers\Admin\SolicitudesPlanMedico;
use App\Http\Controllers\Admin\SolicitudesMonotributo;
use App\Http\Controllers\Admin\ArchivosSolicitudPlanMedico;
use App\Http\Controllers\Admin\ArchivosSolicitudMonotributo;

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
Route::post('solicitudes/plan-medico/importar', [SolicitudesPlanMedico::class, 'importar'])->name('importar_solicitudes_pm');
// archivos
Route::get('solicitudes/plan-medico/{solicitud}/archivos', [ArchivosSolicitudPlanMedico::class, 'index'])->name('archivos_solicitud_pm');
Route::get('solicitudes/plan-medico/{solicitud}/archivos/crear', [ArchivosSolicitudPlanMedico::class, 'crear'])->name('crear_archivo_solicitud_pm');
Route::get('solicitudes/plan-medico/{solicitud}/archivos/{archivo}/editar', [ArchivosSolicitudPlanMedico::class, 'editar'])->name('editar_archivo_solicitud_pm');
Route::post('solicitudes/plan-medico/{solicitud}/archivos/guardar/{archivo?}', [ArchivosSolicitudPlanMedico::class, 'guardar'])->name('guardar_archivo_solicitud_pm');
Route::get('solicitudes/plan-medico/{solicitud}/archivos/{archivo}/eliminar', [ArchivosSolicitudPlanMedico::class, 'eliminar'])->name('eliminar_archivo_solicitud_pm');
Route::post('solicitudes/plan-medico/{solicitud}/archivos/ordenar', [ArchivosSolicitudPlanMedico::class, 'ordenar'])->name('ordenar_archivos_solicitud_pm');
Route::get('solicitudes/plan-medico/{solicitud}/archivos/{archivo}/eliminar-archivo', [ArchivosSolicitudPlanMedico::class, 'eliminarArchivo'])->name('eliminar_archivo_archivo_solicitud_pm');


// solicitudes/monotributo
Route::get('solicitudes/monotributo', [SolicitudesMonotributo::class, 'index'])->name('solicitudes_mtb');
Route::get('solicitudes/monotributo/exportar', [SolicitudesMonotributo::class, 'exportar'])->name('exportar_solicitudes_mtb');
Route::get('solicitudes/monotributo/crear', [SolicitudesMonotributo::class, 'crear'])->name('crear_solicitud_mtb');
Route::get('solicitudes/monotributo/{solicitud}/editar', [SolicitudesMonotributo::class, 'editar'])->name('editar_solicitud_mtb');
Route::post('solicitudes/monotributo/guardar/{solicitud?}', [SolicitudesMonotributo::class, 'guardar'])->name('guardar_solicitud_mtb');
Route::get('solicitudes/monotributo/{solicitud}/eliminar', [SolicitudesMonotributo::class, 'eliminar'])->name('eliminar_solicitud_mtb');
Route::get('solicitudes/monotributo/{solicitud}/desver', [SolicitudesMonotributo::class, 'desver'])->name('desver_solicitud_mtb');
Route::post('solicitudes/monotributo/importar', [SolicitudesMonotributo::class, 'importar'])->name('importar_solicitudes_mtb');
// archivos
Route::get('solicitudes/monotributo/{solicitud}/archivos', [ArchivosSolicitudMonotributo::class, 'index'])->name('archivos_solicitud_mtb');
Route::get('solicitudes/monotributo/{solicitud}/archivos/crear', [ArchivosSolicitudMonotributo::class, 'crear'])->name('crear_archivo_solicitud_mtb');
Route::get('solicitudes/monotributo/{solicitud}/archivos/{archivo}/editar', [ArchivosSolicitudMonotributo::class, 'editar'])->name('editar_archivo_solicitud_mtb');
Route::post('solicitudes/monotributo/{solicitud}/archivos/guardar/{archivo?}', [ArchivosSolicitudMonotributo::class, 'guardar'])->name('guardar_archivo_solicitud_mtb');
Route::get('solicitudes/monotributo/{solicitud}/archivos/{archivo}/eliminar', [ArchivosSolicitudMonotributo::class, 'eliminar'])->name('eliminar_archivo_solicitud_mtb');
Route::post('solicitudes/monotributo/{solicitud}/archivos/ordenar', [ArchivosSolicitudMonotributo::class, 'ordenar'])->name('ordenar_archivos_solicitud_mtb');
Route::get('solicitudes/monotributo/{solicitud}/archivos/{archivo}/eliminar-archivo', [ArchivosSolicitudMonotributo::class, 'eliminarArchivo'])->name('eliminar_archivo_archivo_solicitud_mtb');