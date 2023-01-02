<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Axys\AxysFlasher as Flasher;
use App\Axys\AxysListado as Listado;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

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
        $columnas = ['ID', 'Fecha', 'Nombre', 'Email', 'CUIT/CUIL', 'Celular', 'ID Rappi', 'Nacionalidad', 'Monotributista', 'Quiero ser contactado', 'Horario de contacto', 'Clave fiscal', 'Forma de contacto', 'Observaciones', 'Solicitud de afiliacion', 'Afiliado'];

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
                    $solicitud->horario_contacto,
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

    public function importar(Request $request)
    {
        $this->validate($request, [
            'archivo' => 'required|file'
        ]);
        $registros = array_map('str_getcsv', file($request->file('archivo')->getRealPath()));
        array_shift($registros); //le saco la primera fila de títulos
        $c_registros = 0;
        $c_nuevas = 0;

        foreach($registros as $registro) {
            if(!is_array($registro) || !in_array(count($registro), [16])) continue;
            if(empty($registro[1])) continue;

            for($i = 0  ;  $i <= (count($registro)-1)  ;  $i++) {
                //$registro[$i] =  preg_replace("/ +/", ' ', trim(utf8_encode($registro[$i])));
                $registro[$i] =  preg_replace("/ +/", ' ', trim($registro[$i]));
            }

            $solicitud = new Solicitud;
            $c_nuevas += 1;

            $fecha = null;
            try {
                $fecha = Carbon::createFromFormat('d/m/Y H:i:s', $registro[1]);
            } catch(\Exception $e) { }
            if($fecha) $solicitud->created_at = $fecha;
            $solicitud->nombre = $registro[2];
            $solicitud->email = $registro[3];
            $solicitud->cuit = $registro[4];
            $solicitud->celular = $registro[5];
            $solicitud->id_rappi = $registro[6];
            $solicitud->nacionalidad = $registro[7];
            $solicitud->monotributista = $registro[8];
            $contactado = true; if(!$registro[9] || mb_strtolower($registro[9])=='no') $contactado = false;
            $solicitud->quiero_ser_contactado = $contactado;
            $solicitud->horario_contacto = $registro[10];
            $solicitud->clave_fiscal = $registro[11];
            $solicitud->forma_contacto = $registro[12];
            $solicitud->observaciones = $registro[13];
            $solicitud->solicitud_afiliacion = $registro[14];
            $solicitud->afiliado = $registro[15];

            $solicitud->save();
            
            $c_registros += 1;
        }
        Flasher::set("Se procesaron $c_registros registros, y se crearon $c_nuevas solicitudes nuevas.", 'Archivo Importado', 'success')->flashear();
        return back();
    }
}