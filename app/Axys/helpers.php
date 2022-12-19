<?php

/**
 * Agrega la clase active (o lo q se le pase en el 2do param) si en la URI
 * aparece lo que se le pase en el 1er param (puede ser un array de strings).
 * $embeber: si embeber en class='..' o devolver la clase directamente
 * $nouri: que NO aparezca en la URI (puede ser un array de strings)
 */
function active_si_uri($queSi,$embeber=true,$queNo='',$active=null)
{
	if(!$active) {
		$active='active';
	}
	if(!is_array($queSi)) {
		$queSi=[$queSi];
	}
	if(!is_array($queNo)) {
		$queNo=[$queNo];
	}
	$uriActual=parse_url(url()->current(),PHP_URL_PATH);
	$enUri=true;
	foreach($queSi as $uri) {
		if(!empty($uri)) {
			$enUri = $enUri && strpos($uriActual, $uri)!==false;
		}
	}
	foreach($queNo as $uri) {
		if(!empty($uri)) {
			$enUri = $enUri && strpos($uriActual, $uri)===false;
		}
	}
	
    if ($enUri) {
    	if ($embeber) {
    		return ' class="'.$active.'"';
    	} else {
    		return ' '.$active;
    	}
    }
}

/**
 * Devuelve una instancia de flasher.
 */
function flasher()
{
	return new App\Axys\AxysFlasher();
}

/**
 * Agrega la clase has-error de bootstrap, si el campo está en el array de errores.
 */
function has_error($errors,$campo)
{
	if($errors->has($campo)) return(' has-error');
}

/**
 * Genera el link de visible/invisible
 */
function accion_visibilidad($visible, $url)
{
	if($visible) {
		$html = sprintf('<a href="%s" role="button" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-eye-open"></i></a>',
				$url);
	} else {
		$html = sprintf('<a href="%s" role="button" class="btn btn-danger btn-circle"><i class="glyphicon glyphicon-eye-close"></i></a>',
				$url);
	}

	return $html;
}

/**
 * Devuelve ' selected' si se cumple la condición
 */
function selected($condicion)
{
	return $condicion?' selected':'';
}

/**
 * Devuelve ' checked' si se cumple la condición
 */
function checked($condicion)
{
	return $condicion?' checked':'';
}

/**
 * Valida si es un email válido
 */
function validar_email($email)
{
	$email = trim($email);

	if(empty($email)) {
		return false;
	}

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    if (substr_count($email, '@') != 1) {
        return false;
    }

    return true;
}

function validar_recaptcha($request)
{
	//validar captcha (esto podría y debería abstraerse a otra parte)
	$respuesta = $request->input('g-recaptcha-response');
	$http = new \GuzzleHttp\Client(['http_errors' => false]);
	$resultado = $http->post('https://www.google.com/recaptcha/api/siteverify', [
	    'multipart' => [
	        ['name' => 'secret', 'contents' => config('google.recaptcha.secret')],
	        ['name' => 'response', 'contents' => $respuesta],
	        ['name' => 'remoteip', 'contents' => request()->ip()]
	    ]
	]);
	
	$j=json_decode($resultado->getBody()->getContents(),true);
	if($j&&is_array($j)) {
	    if(isset($j['success'])&&$j['success']) {
	        return true;
	    }
	}
	
	return false;
}

/**
 * Devuelve un array de nombres de columnas de spreadsheet indexadas
 */
function columnasSpreadsheet()
{
	return [
	    'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
	    'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ',
	    'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ',
	];
}

/**
 * Función que genera un título para el tag <title>
 */
function titulo($titulo)
{
	$titulo = trim($titulo);
	if(empty($titulo)) return config('app.name');
	return config('app.name') . ' - ' . $titulo;
}