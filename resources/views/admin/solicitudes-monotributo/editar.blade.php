@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Solicitudes monotributo</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar solicitud</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_solicitud_mtb', $solicitud) }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.solicitudes-monotributo._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('desver_solicitud_mtb', $solicitud) }}" class="btn btn-warning">Marcar como no vista</a>
                <a href="{{ route('solicitudes_mtb') }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Acciones</h3>
                </div>
                <div class="box-body">
                    <a href="{{ route('archivos_solicitud_mtb', $solicitud) }}" class="btn btn-primary">Cargar archivos adjuntos ({{ $solicitud->archivos()->count() }})</a>
                </div>
            </div>
        </div>
    </div>
@endsection

