<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use Illuminate\Support\Facades\Validator;

use App\Models\ArchivoSolicitudPlanMedico as Archivo;
use App\Models\SolicitudPlanMedico;

use Illuminate\Support\Facades\Storage;

class ArchivosSolicitudPlanMedico extends Controller
{
    use TieneVisibilidad;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(SolicitudPlanMedico $solicitud, Request $request)
    {
        $query = $solicitud->archivos()->orderBy('orden')->getQuery();

        // if(!session()->has("axys.listado.archivos_{$solicitud->id}_pm.orden")) {
        //     session(["axys.listado.archivos_{$solicitud->id}_pm.orden" => 'nombre']);
        //     session(["axys.listado.archivos_{$solicitud->id}_pm.sentido" => 'asc']);
        // }

        $listado=new Listado(
            "archivos_{$solicitud->id}_pm",
            $query,
            $request,
            [],
            [
                'buscando'  =>[
                    ['campo'=>'nombre','comparacion'=>'like'],
                ],
                'buscando_id' =>[
                    ['campo'=>'id','comparacion'=>'igual']
                ]
            ]
        );
        
        $archivos=$listado->get();

        return view('admin.archivos-solicitudes-plan-medico.index', compact('archivos', 'listado', 'solicitud'));
    }

    public function eliminar(SolicitudPlanMedico $solicitud, Archivo $archivo)
    {
        try {
            $archivo->delete();
            $flasher=Flasher::set("El archivo fue eliminado.", 'Archivo Eliminado', 'success');
        } catch (\Exception $e) {
            $flasher=Flasher::set('No se pudo borrar el archivo, ya tiene contenido asociado.', 'Error', 'error');
        }
        $flasher->flashear();
        return redirect()->back();
    }

    public function crear(SolicitudPlanMedico $solicitud, Request $request)
    {
        $archivo = new Archivo;
        return view('admin.archivos-solicitudes-plan-medico.crear',compact('archivo', 'solicitud'));
    }

    public function editar(SolicitudPlanMedico $solicitud, Archivo $archivo, Request $request)
    {
        return view('admin.archivos-solicitudes-plan-medico.editar',compact('archivo', 'solicitud'));
    }

    public function guardar(SolicitudPlanMedico $solicitud, $id=null, Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'archivo' => 'file|max:4096|mimes:pdf,zip,docx,xlsx,jpg,png,jpeg,gif',
        ]);
        
        if($id) {
            $archivo=Archivo::findOrFail($id);
        } else {
            $archivo=new Archivo;
            $archivo->id_solicitud = $solicitud->id;
            $archivo->ordenar([['id_solicitud',$solicitud->id]]);
        }

        $archivo->fill($request->all())
            ->subir($request->file('archivo'), 'archivo');
        $archivo->save();


        if($id) {
            Flasher::set("El archivo fue modificado exitosamente.", 'Archivo Editado', 'success')->flashear();
            return back();
        } else {
            Flasher::set("El archivo fue creado exitosamente.", 'Archivo Creado', 'success')->flashear();
            //return redirect()->route('archivos_solicitud_pm', $solicitud);
            return redirect()->route('editar_archivo_solicitud_pm', [$solicitud, $archivo]);
        }
    }
    
    public function eliminarArchivo(SolicitudPlanMedico $solicitud, Archivo $archivo)
    {
        $archivo->eliminarArchivo('archivo')->save();
        Flasher::set("Se eliminó el archivo", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function ordenar(SolicitudPlanMedico $solicitud, Request $request)
    {
        $ids = $request->all()['ids'];
        $orden = 1;
        foreach($ids as $id) {
            Archivo::where('id', $id)->update(['orden' => $orden]);
            $orden += 1;
        }
        return ['ok'=>true];
    }

    public function visibilidad(SolicitudPlanMedico $solicitud, Archivo $archivo)
    {
        return $this->cambiarVisibilidad($archivo);
    }

    
}