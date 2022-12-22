@extends('vendor.adminlte.page')

@section('content_header')
    <h4><a href="{{ route('solicitudes_mtb') }}">Solicitudes monotributo</a> > <a href="{{ route('editar_solicitud_mtb', $solicitud) }}">{{ $solicitud->nombre }}</a></h4>
    <h1>Archivos</h1>
@stop

@section('content')
    
    <div class="row">
        
        <div class="col-md-4">
            <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Acciones</h3>
                </div>
                <div class="box-body">
                    <a href="{{ route('crear_archivo_solicitud_mtb', $solicitud) }}" class="btn btn-primary">Crear archivo</a>
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
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" class="form-control" name="buscando" placeholder="Buscar archivo..." value="{{ $listado->old('buscando') }}">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="hidden">
                </form>    
            </div>
        </div>
    </div>

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">Listado</h3>
            <p>* Para modificar el orden de los elementos, arrastralos con el mouse.</p>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="tabla-ordenable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Archivo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($archivos as $archivo)
                        <tr>
                            <td class="hidden">{{ $archivo->orden }}</td>
                            <td>{{ $archivo->id }}</td>
                            <td>{{ $archivo->nombre }}</td>
                            <td>
                                @if($archivo->tiene('archivo'))
                                    <a href="{{ $archivo->url('archivo') }}" target="_blank" class="btn btn-xs btn-success" title="Descargar" download><span class="glyphicon glyphicon-download"></span> Descargar</a>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('editar_archivo_solicitud_mtb', compact('solicitud', 'archivo')) }}" role="button" class="btn btn-warning btn-circle"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{{ route('eliminar_archivo_solicitud_mtb', compact('solicitud', 'archivo')) }}" role="button" class="btn btn-danger btn-circle axys-confirmar-eliminar"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                            <td class="hidden">{{ $archivo->id }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No se encontraron archivos.</td>
                        </tr>
                    @endforelse
                    <?php $archivo = null; ?>
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <a href="{{ route('editar_solicitud_mtb', $solicitud) }}" class="btn btn-info">Volver</a>
        </div>
    </div>
@endsection

@section('script.abajo')
    <script type="text/javascript" src="/js/lib/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/lib/jquery-ui/jquery-ui.touch-punch.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#tabla-ordenable tbody").sortable({
                update:function(){
                    array=[];
                    $(this).children().each(function(i){
                        array.push($(this).children().last().html());
                    });
                    $.ajax({
                        url:'{{ route("ordenar_archivos_solicitud_mtb", $solicitud) }}',
                        method:'post',
                        data:{'ids':array},
                        success:function(ret){
                            if(ret.ok) {
                                orden=1;
                                $('#tabla-ordenable tbody').children().each(function(i){
                                    $(this).children().first().html(orden);
                                    orden+=1;
                                });
                            } else {
                                sweetAlert('Error', 'Hubo un error al actualizar el orden de los elementos, por favor intentá nuevamente.', 'error');
                            }
                        },
                        error:function(){ sweetAlert('Error', 'Hubo un error al actualizar el orden de los elementos, por favor recargá la página e intentá nuevamente.', 'error'); }
                    });
                }
            });
        });
    </script>
@endsection
