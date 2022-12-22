<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use App\Axys\Traits\TieneVisibilidad;
use Illuminate\Support\Facades\Validator;

use App\Models\ArchivoSolicitudMonotributo as Archivo;
use App\Models\SolicitudMonotributo;

use Illuminate\Support\Facades\Storage;

class ArchivosSolicitudMonotributo extends Controller
{
    use TieneVisibilidad;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(SolicitudMonotributo $solicitud, Request $request)
    {
        $query = $solicitud->archivos()->orderBy('orden')->getQuery();

        // if(!session()->has("axys.listado.archivos_{$solicitud->id}_mtb.orden")) {
        //     session(["axys.listado.archivos_{$solicitud->id}_mtb.orden" => 'nombre']);
        //     session(["axys.listado.archivos_{$solicitud->id}_mtb.sentido" => 'asc']);
        // }

        $listado=new Listado(
            "archivos_{$solicitud->id}_mtb",
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

        return view('admin.archivos-solicitudes-monotributo.index', compact('archivos', 'listado', 'solicitud'));
    }

    public function eliminar(SolicitudMonotributo $solicitud, Archivo $archivo)
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

    public function crear(SolicitudMonotributo $solicitud, Request $request)
    {
        $archivo = new Archivo;
        return view('admin.archivos-solicitudes-monotributo.crear',compact('archivo', 'solicitud'));
    }

    public function editar(SolicitudMonotributo $solicitud, Archivo $archivo, Request $request)
    {
        return view('admin.archivos-solicitudes-monotributo.editar',compact('archivo', 'solicitud'));
    }

    public function guardar(SolicitudMonotributo $solicitud, $id=null, Request $request)
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
            //return redirect()->route('archivos_solicitud_mtb', $solicitud);
            return redirect()->route('editar_archivo_solicitud_mtb', [$solicitud, $archivo]);
        }
    }
    
    public function eliminarArchivo(SolicitudMonotributo $solicitud, Archivo $archivo)
    {
        $archivo->eliminarArchivo('archivo')->save();
        Flasher::set("Se eliminó el archivo", 'Archivo Eliminado', 'success')->flashear();
        return back();
    }

    public function ordenar(SolicitudMonotributo $solicitud, Request $request)
    {
        $ids = $request->all()['ids'];
        $orden = 1;
        foreach($ids as $id) {
            Archivo::where('id', $id)->update(['orden' => $orden]);
            $orden += 1;
        }
        return ['ok'=>true];
    }

    public function visibilidad(SolicitudMonotributo $solicitud, Archivo $archivo)
    {
        return $this->cambiarVisibilidad($archivo);
    }

    
}