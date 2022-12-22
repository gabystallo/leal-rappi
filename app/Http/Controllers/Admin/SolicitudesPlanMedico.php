<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use Illuminate\Support\Facades\Response;

use App\Models\SolicitudPlanMedico as Solicitud;

class SolicitudesPlanMedico extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Solicitud::orderBy('id', 'desc');

        $listado=new Listado(
            'solicitudes_pm',
            $query,
            $request,
            [],
            [
                'buscando'  =>[
                    ['campo'=>'nombre','comparacion'=>'like'],
                    ['campo'=>'email','comparacion'=>'like'],
                    ['campo'=>'cuit','comparacion'=>'like'],
                ],
                'buscando_id' =>[
                    ['campo'=>'id','comparacion'=>'igual']
                ],
                'buscando_vista' => [
                    ['campo'=>'vista','comparacion'=>'igual']
                ]
            ]
        );
        
        $solicitudes=$listado->paginar(50);
        //$solicitudes=$listado->get();

        return view('admin.solicitudes-plan-medico.index', compact('solicitudes', 'listado'));
    }

    public function eliminar(Solicitud $solicitud)
    {
        try {
            $solicitud->delete();
            $flasher=Flasher::set("La solicitud fue eliminada.", 'Solicitud Eliminada', 'success');
        } catch (\Exception $e) {
            $flasher=Flasher::set('No se pudo borrar la solicitud, ya tiene contenido asociado.', 'Error', 'error');
        }
        $flasher->flashear();
        return redirect()->back();
    }

    public function eliminarArchivo(Solicitud $solicitud, $campo)
    {
        $solicitud->eliminarArchivo($campo)->save();
        Flasher::set("Se eliminó el archivo $campo", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function crear(Request $request)
    {
        $solicitud = new Solicitud;

        return view('admin.solicitudes-plan-medico.crear',compact('solicitud'));
    }

    public function editar(Solicitud $solicitud, Request $request)
    {
        $solicitud->vista = true;
        $solicitud->save();

        return view('admin.solicitudes-plan-medico.editar',compact('solicitud'));
    }

    public function desver(Solicitud $solicitud)
    {
        $solicitud->vista = false;
        $solicitud->save();
        return redirect()->route('solicitudes_pm');
    }

    public function guardar(Request $request, $id=null)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'email' => 'required|email',
            'cuit' => 'required',
            'celular' => 'required',
            'id_rappi' => 'required',
            'nacionalidad' => 'required',
        ], [], [
            'id_rappi' => 'ID de usuario'
        ]);

        if($id) {
            $solicitud=Solicitud::findOrFail($id);
        } else {
            $solicitud=new Solicitud;
            $solicitud->vista = true;
        }

        $solicitud->fill($request->all());

        $solicitud->clave_fiscal = $request->input('clave_fiscal');
        $solicitud->forma_contacto = $request->input('forma_contacto');
        $solicitud->observaciones = $request->input('observaciones');
        $solicitud->solicitud_afiliacion = $request->input('solicitud_afiliacion');
        $solicitud->afiliado = $request->input('afiliado');

        foreach(['quiero_ser_contactado'] as $check) {
            $solicitud->$check = boolval($request->input($check));
        }
        
        $solicitud->save();

        if($id) {
            Flasher::set("La solicitud fue modificada exitosamente.", 'Solicitud Editada', 'success')->flashear();
            return back();
        } else {
            Flasher::set("La solicitud fue creada exitosamente.", 'Solicitud Creada', 'success')->flashear();
            return redirect()->route('solicitudes_pm');
        }
    }

    public function exportar()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . date('Y-m-d') . "-solicitudes-plan-medico.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $solicitudes = Solicitud::orderBy('id', 'desc')->get();
        $columnas = ['ID', 'Fecha', 'Nombre', 'Email', 'CUIT/CUIL', 'Celular', 'ID Rappi', 'Nacionalidad', 'Monotributista', 'Quiero ser contactado', 'Clave fiscal', 'Forma de contacto', 'Observaciones', 'Solicitud de afiliacion', 'Afiliado'];

        $callback = function() use ($solicitudes, $columnas)
        {
            $archivo = fopen('php://output', 'w');
            fputcsv($archivo, $columnas);

            foreach($solicitudes as $solicitud) {
                fputcsv($archivo, [
                    $solicitud->id,
                    $solicitud->fecha,
                    $solicitud->nombre,
                    $solicitud->email,
                    $solicitud->cuit,
                    $solicitud->celular,
                    $solicitud->id_rappi,
                    $solicitud->nacionalidad,
                    $solicitud->monotributista,
                    $solicitud->quiero_ser_contactado,
                    $solicitud->clave_fiscal,
                    $solicitud->forma_contacto,
                    $solicitud->observaciones,
                    $solicitud->solicitud_afiliacion,
                    $solicitud->afiliado,
                ]);
            }
            fclose($archivo);
        };
        
        return Response::stream($callback, 200, $headers);
    }
}