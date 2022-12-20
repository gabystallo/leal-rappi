@extends('vendor.adminlte.page')

@section('css')
    <style type="text/css">
        .sinver td { font-weight:600; }
    </style>
@endsection

@section('content_header')
    <h1>Solicitudes monotributo</h1>
@stop

@section('content')
    
    <div class="row">
        
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Acciones</h3>
                </div>
                <div class="box-body">
                    <a href="{{ route('crear_solicitud_mtb') }}" class="btn btn-primary">Crear solicitud</a>
                    <a href="{{ route('exportar_solicitudes_pm') }}" class="btn btn-success">Exportar todo</a>
                </div>
            </div>
        </div>
        

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Filtros</h3>
                </div>
                <form>
                    <div class="box-body">
                        <div class="col-md-3">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
                                <input type="text" class="form-control" name="buscando_id" placeholder="ID#" value="{{ $listado->old('buscando_id') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" class="form-control" name="buscando" placeholder="Buscar solicitud..." value="{{ $listado->old('buscando') }}">
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <select class="form-control" name="buscando_vista" onchange="$(this).closest('form').submit()">
                                <option value="">Todas</option>
                                <option value="0" {{ selected($listado->old('buscando_vista') === "0") }}>Sin ver</option>
                            </select>
                        </div>
                    </div>
                    <input type="submit" class="hidden">
                </form>    
            </div>
        </div>
    </div>

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">Listado (Total: {{$solicitudes->total()}})</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Nacionalidad</th>
                        <th>ID Rappi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($solicitudes as $solicitud)
                        <tr{!! !$solicitud->vista ? ' class="sinver"' : '' !!}>
                            <td>{{ $solicitud->id }}</td>
                            <td>{{ $solicitud->fecha }}</td>
                            <td>{{ $solicitud->nombre }}</td>
                            <td>{{ $solicitud->email }}</td>
                            <td>{{ $solicitud->nacionalidad }}</td>
                            <td>{{ $solicitud->id_rappi }}</td>
                            <td class="text-right">
                                <a href="{{ route('editar_solicitud_mtb', compact('solicitud')) }}" role="button" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ route('eliminar_solicitud_mtb', compact('solicitud')) }}" role="button" class="btn btn-danger btn-circle axys-confirmar-eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="99">No se encontraron solicitudes.</td>
                        </tr>
                    @endforelse
                    <?php $solicitud = null; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix text-center">
            {{ $solicitudes->links() }}
        </div>
    </div>
@endsection