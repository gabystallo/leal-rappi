<div class="col-md-12">
    @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="col-md-4 form-group{{ has_error($errors,'nombre') }}">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre',$solicitud->nombre) }}">
</div>
<div class="col-md-4 form-group{{ has_error($errors,'email') }}">
    <label>Email</label>
    <input type="email" class="form-control" name="email" value="{{ old('email',$solicitud->email) }}">
</div>
<div class="col-md-4 form-group{{ has_error($errors,'cuit') }}">
    <label>CUIT/CUIL</label>
    <input type="text" class="form-control" name="cuit" value="{{ old('cuit',$solicitud->cuit) }}">
</div>
<div class="col-md-4 form-group{{ has_error($errors,'celular') }}">
    <label>Celular</label>
    <input type="text" class="form-control" name="celular" value="{{ old('celular',$solicitud->celular) }}">
</div>
<div class="col-md-4 form-group{{ has_error($errors,'id_rappi') }}">
    <label>ID Soy Rappi</label>
    <input type="text" class="form-control" name="id_rappi" value="{{ old('id_rappi',$solicitud->id_rappi) }}">
</div>
<div class="col-md-4 form-group{{ has_error($errors,'nacionalidad') }}">
    <label>Nacionalidad</label>
    <input type="text" class="form-control" name="nacionalidad" value="{{ old('nacionalidad',$solicitud->nacionalidad) }}">
</div>

<div class="col-md-4 form-group{{ has_error($errors,'monotributista') }}">
    <label>Monotributista</label>
    <select name="monotributista" class="form-control">
        <option value="">Seleccionar</option>
        <option value="Sí"{{ selected("Sí"==old('monotributista', $solicitud->monotributista)) }}>Sí</option>
        <option value="No"{{ selected("No"==old('monotributista', $solicitud->monotributista)) }}>No</option>
    </select>
</div>
<div class="col-md-4 form-group{{ has_error($errors,'quiero_ser_contactado') }}">
    <label>Quiere ser contactado</label>
    <div>
        <input type="checkbox" data-toggle="toggle" data-on="Sí" data-off="No" name="quiero_ser_contactado" value="1" {{ old('quiero_ser_contactado', $solicitud->quiero_ser_contactado) ? 'checked' : '' }}>
    </div>
</div>
<div class="col-md-4 form-group{{ has_error($errors,'horario_contacto') }}">
    <label>Horario de contacto</label>
    <select name="horario_contacto" class="form-control">
        <option value="">Seleccionar</option>
        <option value="09 a 12 hs"{{ selected("09 a 12 hs"==old('horario_contacto', $solicitud->horario_contacto)) }}>09 a 12 hs</option>
        <option value="15 a 18 hs"{{ selected("15 a 18 hs"==old('horario_contacto', $solicitud->horario_contacto)) }}>15 a 18 hs</option>
        <option value="19 a 22 hs"{{ selected("19 a 22 hs"==old('horario_contacto', $solicitud->horario_contacto)) }}>19 a 22 hs</option>
    </select>
</div>

<div class="col-md-12"><hr></div>

<div class="col-md-6 form-group{{ has_error($errors,'clave_fiscal') }}">
    <label>Clave fiscal</label>
    <input type="text" class="form-control" name="clave_fiscal" value="{{ old('clave_fiscal',$solicitud->clave_fiscal) }}">
</div>
<div class="col-md-6 form-group{{ has_error($errors,'forma_contacto') }}">
    <label>Forma de contacto</label>
    <input type="text" class="form-control" name="forma_contacto" value="{{ old('forma_contacto',$solicitud->forma_contacto) }}">
</div>

<div class="col-md-12 form-group{{ has_error($errors,'observaciones') }}">
    <label>Observaciones</label>
    <textarea class="form-control" name="observaciones" style="height:180px;">{{ old('observaciones',$solicitud->observaciones) }}</textarea>
</div>

<div class="col-md-6 form-group{{ has_error($errors,'solicitud_afiliacion') }}">
    <label>Solicitud de afiliacion</label>
    <select name="solicitud_afiliacion" class="form-control">
        <option value="">Seleccionar</option>
        <option value="Sí"{{ selected("Sí"==old('solicitud_afiliacion', $solicitud->solicitud_afiliacion)) }}>Sí</option>
        <option value="No"{{ selected("No"==old('solicitud_afiliacion', $solicitud->solicitud_afiliacion)) }}>No</option>
    </select>
</div>
<div class="col-md-6 form-group{{ has_error($errors,'afiliado') }}">
    <label>Afiliado</label>
    <select name="afiliado" class="form-control">
        <option value="">Seleccionar</option>
        <option value="Sí"{{ selected("Sí"==old('afiliado', $solicitud->afiliado)) }}>Sí</option>
        <option value="No"{{ selected("No"==old('afiliado', $solicitud->afiliado)) }}>No</option>
    </select>
</div>