<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Axys\AxysListado as Listado;
use App\Axys\AxysFlasher as Flasher;

//use App\Notifications\NuevaSolicitud;

use App\Models\SolicitudPlanMedico;
use App\Models\SolicitudMonotributo;

class General extends Controller
{

	public function planMedico()
	{
		$seccion = 'plan-medico';
		return view('plan-medico', compact('seccion'));
	}


	public function guardarSolicitudPlanMedico(Request $request)
	{
		$reglas = [
		    'nombre' => 'required',
            'email' => 'required|email',
            'cuit' => 'required',
            'celular' => 'required',
            'id_rappi' => 'required',
            'nacionalidad' => 'required',
            'monotributista' => 'required',
		];

		//Ejecutar validaciones /////////
        $validator = Validator::make($request->all(), $reglas);
        $validator -> setAttributeNames([
            'id_rappi' => 'ID Soy Rappi',
            'monotributista' => 'Sos monotributista',
        ]);

        if ($validator->fails()) {
        	Flasher::set('No se pudo enviar la solicitud, revisar que se hayan ingresado correctamente todos los campos.', 'Error', 'error')->flashear();
            return redirect(\URL::previous()."#solicitud")->withInput($request->all());
        }

		if(!validar_recaptcha($request)) {
			//Flasher::set('No tildaste la opción -No soy un robot-.', 'Error', 'error')->flashear();
		    return redirect(\URL::previous()."#solicitud")->withInput($request->all())->withErrors(['captcha' => "No tildaste la opción -No soy un robot-."]);
		}

		$solicitud = new SolicitudPlanMedico;
		$solicitud->fill($request->all());
		foreach(['quiero_ser_contactado'] as $check) {
		    $solicitud->$check = boolval($request->input($check));
		}
		$solicitud->save();

		//$contacto->notify(new NuevaSolicitudPlanMedico($solicitud));

		Flasher::set("Tu solicitud fue enviada exitosamente. Próximamente nos comunicaremos con vos.", "Solicitud enviada", "success")->flashear();
		return back();
	}


		public function monotributo()
		{
			$seccion = 'monotributo';
			return view('monotributo', compact('seccion'));
		}


		public function guardarSolicitudMonotributo(Request $request)
		{
			$reglas = [
			    'nombre' => 'required',
	            'email' => 'required|email',
	            'cuit' => 'required',
	            'celular' => 'required',
	            'id_rappi' => 'required',
	            'nacionalidad' => 'required',
	            'monotributista' => 'required',
			];

			//Ejecutar validaciones /////////
	        $validator = Validator::make($request->all(), $reglas);
	        $validator -> setAttributeNames([
	            'id_rappi' => 'ID Soy Rappi',
	            'monotributista' => 'Sos monotributista',
	        ]);

	        if ($validator->fails()) {
	        	Flasher::set('No se pudo enviar la solicitud, revisar que se hayan ingresado correctamente todos los campos.', 'Error', 'error')->flashear();
	            return redirect(\URL::previous()."#solicitud")->withInput($request->all());
	        }

			if(!validar_recaptcha($request)) {
				//Flasher::set('No tildaste la opción -No soy un robot-.', 'Error', 'error')->flashear();
			    return redirect(\URL::previous()."#solicitud")->withInput($request->all())->withErrors(['captcha' => "No tildaste la opción -No soy un robot-."]);
			}

			$solicitud = new SolicitudMonotributo;
			$solicitud->fill($request->all());
			foreach(['quiero_ser_contactado'] as $check) {
			    $solicitud->$check = boolval($request->input($check));
			}
			$solicitud->save();

			//$contacto->notify(new NuevaSolicitudPlanMedico($solicitud));

			Flasher::set("Tu solicitud fue enviada exitosamente. Próximamente nos comunicaremos con vos.", "Solicitud enviada", "success")->flashear();
			return back();
		}
}