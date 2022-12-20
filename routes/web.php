<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\General;

if (config('app.env') === 'production') {
    \URL::forceScheme('https');
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
	require __DIR__.'/admin-auth.php';

	require __DIR__.'/admin-rutas.php';
});

Route::get('/', [General::class, 'planMedico']);
Route::post('solicitud-plan-medico', [General::class, 'guardarSolicitudPlanMedico'])->name('guardarSolicitudPlanMedico');
Route::get('obtene-tu-monotributo', [General::class, 'monotributo']);
Route::post('solicitud-monotributo', [General::class, 'guardarSolicitudMonotributo'])->name('guardarSolicitudMonotributo');


