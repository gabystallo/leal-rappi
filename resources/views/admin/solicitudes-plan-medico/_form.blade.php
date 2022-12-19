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
