@extends('vendor.adminlte.page')

@section('content_header')
    <h1>Solicitudes plan médico</h1>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Crear solicitud</h3>
        </div>
        <form method="post" enctype="multipart/form-data" action="{{ route('guardar_solicitud_pm') }}">
            {{ csrf_field() }}
            <div class="box-body">
                @include('admin.solicitudes-plan-medico._form')
            </div>
            <div class="box-footer text-right">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('solicitudes_pm') }}" class="btn btn-info">Volver</a>
            </div>
        </form>
    </div>
@endsection

