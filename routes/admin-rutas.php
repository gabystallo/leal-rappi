<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Administradores;


Route::get('/', [Dashboard::class, 'index']);

Route::get('administradores', [Administradores::class, 'index'])->name('administradores');
Route::get('administradores/crear', [Administradores::class, 'crear'])->name('crear_administrador');
Route::get('administradores/{administrador}/editar', [Administradores::class, 'editar'])->name('editar_administrador');
Route::post('administradores/guardar/{administrador?}', [Administradores::class, 'guardar'])->name('guardar_administrador');
Route::get('administradores/{administrador}/eliminar', [Administradores::class, 'eliminar'])->name('eliminar_administrador');
Route::get('administradores/{administrador}/eliminar-archivo/{campo}', [Administradores::class, 'eliminarArchivo'])->name('eliminar_archivo_administrador');