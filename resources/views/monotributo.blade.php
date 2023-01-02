@extends('layout')


@section('contenido')
	<div class="formulario fondo-azul" id="solicitud">
		<div class="contenedor">
			<h2>¿Querés que te ayudamos a obtener tu monotributo sin costo?</h2>
			
			<form method="post" action="{{ route('guardarSolicitudMonotributo') }}">
				{{ csrf_field() }}
				@if(count($errors)>0)
					<div class="col col-100">
					    <div class="errores">
					        <ul>
					            @foreach($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					</div>
				@endif
				<div class="col col-50">
					<div class="campo">
						<input type="text" name="nombre" placeholder="Nombre y apellido" value="{{ old('nombre') }}" required>
					</div>
				</div>
				<div class="col col-50">
					<div class="campo">
						<input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
					</div>
				</div>
				<div class="col col-50">
					<div class="campo">
						<input type="text" name="cuit" placeholder="CUIT/CUIL" value="{{ old('cuit') }}" required>
					</div>
				</div>
				<div class="col col-50">
					<div class="campo">
						<input type="text" name="celular" placeholder="Celular/Whatsapp" value="{{ old('celular') }}" required>
					</div>
				</div>
				<div class="col col-50">
					<div class="campo">
						<input type="text" name="id_rappi" placeholder="ID de usuario de Soy Rappi" value="{{ old('id_rappi') }}" required>
					</div>
				</div>
				<div class="col col-50">
					<div class="campo">
						<input type="text" name="nacionalidad" placeholder="Nacionalidad" value="{{ old('nacionalidad') }}" required>
					</div>
				</div>
				<div class="col col-50">
					<div class="campo">
						<select name="monotributista" class="form-control">
						    <option value="">¿Sos Monotributista?</option>
						    <option value="Sí"{{ selected("Sí"==old('monotributista')) }}>Sí</option>
						    <option value="No"{{ selected("No"==old('monotributista')) }}>No</option>
						</select>
					</div>
				</div>
				<div class="col col-50">
					<div class="campo">
						<select name="horario_contacto" class="form-control">
						    <option value="">Horario de contacto</option>
						    <option value="09 a 12 hs"{{ selected("09 a 12 hs"==old('horario_contacto')) }}>09 a 12 hs</option>
						    <option value="15 a 18 hs"{{ selected("15 a 18 hs"==old('horario_contacto')) }}>15 a 18 hs</option>
						    <option value="19 a 22 hs"{{ selected("19 a 22 hs"==old('horario_contacto')) }}>19 a 22 hs</option>
						</select>
					</div>
				</div>
				<div class="col col-50">
					<div class="campo">
						<div class="check">
							<input type="checkbox" value="1" name="quiero_ser_contactado" id="quiero_ser_contactado" {{ checked(old('quiero_ser_contactado')) }}>
							<label for="quiero_ser_contactado">Quiero ser contactado por Leal Médica y obtener el alta en el monotributo sin costo alguno.</label>
						</div>
					</div>
				</div>
				<div class="col col-50">
					<div class="recaptcha">
					    <div class="g-recaptcha" data-sitekey="{{ config('google.recaptcha.sitekey') }}"></div>
					</div>
				</div>
				<div class="col col-100">
					<div class="boton">
						<button type="submit">ENVIAR</button>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection