@extends('layouts.plant')
@section('content')

@if(Session::has('message')){{
    Session::get('message')
}}
@endif

<h1>Cartera de clientes</h1>
<div>    
    @include('owners.form',['from'=>'create'])
<!--<a class="btn btn-success" class="dropdown-item" href="{{ url('owners/create') }}">NUEVO</a>-->
</div>
<br>

<h5>
@if($search)
<div class="alert alert-primary" role="alert" class="col.sm-6">
  Resultados de la busqueda '{{$search}}' son:
</div>
@endif
</h5>

<table  class="table table-hover table-bordered" width="50%" border="1">
<thead class="thead-dark">
    <tr>
        <center><th>No.</th></center>
        <center><th>DPI</th></center>
        <center><th>Nombre</th></center>
        <center><th>Apellido</th></center>
        <center><th>Telefono</th></center>
        <center><th>Correo Eléctronico</th></center>
        <center><th>Fecha De Registro</th></center>
        <center><th>FUNCIONES</th></center>
    </tr>
</thead>
<tbody id="tbl_owner">
    @foreach($owners as $ownerRow)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$ownerRow->dpi}}</td>
        <td>{{$ownerRow->owner_name}}</td>
        <td>{{$ownerRow->owner_lastname}}</td>
        <td>{{$ownerRow->telephone}}</td>
        <td>{{$ownerRow->e_mail_address}}</td>
        <td>{{$ownerRow->registration_date}}</td>
        <td>   
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit{{ $ownerRow->id_owner }}" 
          data-whatever="@mdo">Modificar</button>            
          
          <div class="modal fade" id="modalEdit{{ $ownerRow->id_owner }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title" id="modalLabel">Modificar registro</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ url('/owners/'.$ownerRow->id_owner) }}" class="form-horizontal"  method="post">

                        {{csrf_field()}}
                        {{method_field('PATCH')}}
                    <form class="form-goup">
                        @if ($errors->any())
                            <div class="errors">
                                <p><strong>Datos colocados de forma incorrecta, por favor ingresarlos de nuevo<strong></p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="form-grup">
                        <label for="dpi"  class="control-label">{{'DPI'}}</label>
                        <input class="form-control" type="number" name="dpi" id="dpi" 
                        value="{{ isset($ownerRow->dpi)?$ownerRow->dpi:'' }}" required>
                        <br/>
                      </div>
                        
                        <div class="form-grup">
                          <label for="owner_name" class="control-label">{{'Nombre'}}</label>
                          <input class="form-control" type="text" name="owner_name" id="owner_name" 
                          value="{{ isset($ownerRow->owner_name)?$ownerRow->owner_name:'' }}">
                          <br/>
                          </div>
                          
                          <div class="form-grup">
                          <label for="owner_lastname"  class="control-label">{{'Apellido'}}</label>
                          <input class="form-control" type="text" name="owner_lastname" id="owner_lastname" 
                          value="{{ isset($ownerRow->owner_lastname)?$ownerRow->owner_lastname:'' }}">
                          <br/>
                          </div>
                          
                          <div class="form-grup">
                          <label for="telephone"  class="control-label">{{'Telefono'}}</label>
                          <input class="form-control" type="text" name="telephone" id="telephone" 
                          value="{{ isset($ownerRow->telephone)?$ownerRow->telephone:'' }}">
                          <br/>
                          </div>
                          
                          <div class="form-grup">
                          <label for="e_mail_address"  class="control-label">{{'Correo Eléctronico'}}</label>
                          <input class="form-control"  type="email" name="e_mail_address" id="e_mail_address" 
                          value="{{ isset($ownerRow->e_mail_address)?$ownerRow->e_mail_address:'' }}">
                          <br/>
                          </div>
                        
                        
                        <input class="btn btn-success" type="submit" value="{{ $from ?? ''=='create' ? 'AGREGAR':'MODIFICAR' }}">
                        
                        <a class="btn btn-secondary" data-dismiss="modal">CANCELAR</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

        <form action="{{ url('/owners/'.$ownerRow->id_owner) }}" method="post" style="display:inline" >
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" onclick="return confirm('¿Desea eliminar permanentemente este registro?')" class="btn btn-danger" >Eliminar</button>
        </form>
        </td>
    </tr>
    @endforeach
</tbody>
</table>

<div class="row">
    <div class="mx-auto">
        {{$owners->links()}}
    </div>
    </div>


@endsection