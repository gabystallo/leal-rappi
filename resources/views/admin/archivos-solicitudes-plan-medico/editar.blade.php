@extends('vendor.adminlte.page')

@section('content_header')
    <h4><a href="{{ route('solicitudes_pm') }}">Solicitudes plan médico</a> > <a href="{{ route('editar_solicitud_pm', $solicitud) }}">{{ $solicitud->nombre }}</a></h4>
    <h1>Archivos</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar archivo</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_archivo_solicitud_pm', compact('solicitud', 'archivo')) }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.archivos-solicitudes-plan-medico._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('archivos_solicitud_pm', $solicitud) }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
@endsection