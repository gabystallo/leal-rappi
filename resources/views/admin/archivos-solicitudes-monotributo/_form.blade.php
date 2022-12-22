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
<div class="col-md-6 form-group{{ has_error($errors,'nombre') }}">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" value="{{ old('nombre',$archivo->nombre) }}">
</div>
<div class="col-md-6 form-group{{ has_error($errors,'archivo') }}">
    <label>Archivo</label>
    @if($archivo->tiene('archivo'))
        <p>
            <a href="{{ route('eliminar_archivo_archivo_solicitud_mtb', ['solicitud' => $solicitud->id, 'archivo' => $archivo->id]) }}" class="btn btn-sm btn-danger" title="Eliminar"><span class="glyphicon glyphicon-remove"></span> Eliminar</a>
            <a href="{{ $archivo->url('archivo') }}" target="_blank" class="btn btn-sm btn-success" title="Descargar" download><span class="glyphicon glyphicon-download"></span> Descargar</a>
        </p>
    @else
        <input type="file" class="form-control" name="archivo" value="{{ old('archivo',$archivo->archivo) }}" accept=".pdf,.zip,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg">
    @endif
</div>