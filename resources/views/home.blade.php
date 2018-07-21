@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Peticiones pendientes
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><b>Fecha petición</b></div>
                        <div class="col-md-5"><b>Dirección</b></div>
                        <div class="col-md-3"><b>Conductor</b></div>
                    </div>
                    @foreach($peticiones as $index=>$peticion)
                        <div class="row" data-id="{{$peticion->id}}">
                            <div class="col-md-3 laFecha">{{$peticion->fecha_entrega}}</div>
                            <div class="col-md-5 laDireccion">{{$peticion->direccion}}</div>
                            <div class="col-md-3 elNombre">{{$peticion->conductor->nombre}}</div>
                            <div class="col-md-1 p-0"><a href="#" class="btnDetalle">Detalle</a></div>
                        </div>
                    @endforeach
                    <div class="form-group">
                        {{$peticiones->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal edición -->
<div class="modal fade" id="peticionModal" tabindex="-1" role="dialog" aria-labelledby="peticionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="peticionModalLabel">Petición</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(array('route' => 'accionPeticion', 'id'=>'formPeticion', 'class'=>'ajaxSubmit')) !!}
            <div class="modal-body">
                <input name="id" value="" type="hidden" />
                <input name="accion" value="" type="hidden" />
                <div class="form-group">
                    <label for="product">Dirección</label>
                    <input type="text" class="form-control" name="direccion" >
                </div>

                <div class="form-group">
                    <label for="product">Fecha de entrega (dd/mm/YYYY)</label>
                    <input type="text" class="form-control" name="fecha_entrega" >
                </div>

                <div class="form-group">
                    <div class="col-md-6 p-0 m-0" style="float: left">
                        <label for="product">Horario desde</label>
                        <select class="form-control" name="hora_desde">
                            @for($i=1; $i<=24; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-6 p-0 m-0" style="float: left">
                        <label for="product">Horario hasta</label>
                        <select class="form-control" name="hora_hasta">
                            @for($i=1; $i<=24; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="product">Conductor</label>
                    <select class="form-control" name="conductor_id">
                        @foreach($conductores as  $conductor)
                            <option value="{{$conductor->id}}">{{$conductor->nombre}}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-sm btn-primary" data-accion="save" value="Guardar" />
                <input type="submit" class="btn btn-sm btn-danger" data-accion="delete" value="Borrar" />
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>





@endsection


@section('javascript')
    <script src="{{asset('js/peticiones.js')}}"></script>
@endsection