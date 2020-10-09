@extends('layouts.plant')
@section('content')

@if(Session::has('message')){{
    Session::get('message')
}}
@endif

<h1>LISTADO DE MASCOTAS</h1>
<div>@include('pets.form',['from'=>'create'])</div>

<br>
<h6>
    @if($search)
    <div class="alert alert-primary" role="alert">
      Resultados de la busqueda '{{$search}}' son:
    </div>
    @endif
    </h6>

<table class="table table-hover table-bordered" width="50%" border="1">
<thead class="thead-dark">
    <tr>
        <center><th>No.</th></center>
        <center><th>COD.</th></center>
        <center><th>Nombre</th></center>
        <center><th>Especie</th></center>
        <center><th>Edad</th></center>
        <center><th>FUNCIONES</th></center>
    </tr>
</thead>
<tbody>
    @foreach($pets as $petRow)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$petRow->unique_code}}</td>
        <td>{{$petRow->nickname}}</td>
        <td>{{$petRow->species}}</td>
        <td>{{$petRow->age." meses "}}</td>
        <td>         
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalEdit{{ $petRow->id_pet }}" 
            data-whatever="@mdo">Modificar</button>   

            <div class="modal fade" id="modalEdit{{ $petRow->id_pet }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title" id="modalLabel">Modificar registros de pacientes</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/pets/'.$petRow->id_pet) }}" method="post">
                                {{csrf_field()}}
                                {{method_field('PATCH')}}
                                <form class="form-goup">
                                    @if ($errors->any())
                                        <div class="errors">
                                            <p><strong>Datos colocados de forma incorrecta, por favor ingresarlos de nuevo<strong>
                                            </p>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <label for="unique_code">{{ 'Prevista Del Código Unico' }}</label>
                                    <input class="form-control" type="text" name="unique_code" id="unique_code"
                                        value="{{ isset($petRow->unique_code) ? $petRow->unique_code : rand(1, 999) }}"
                                        readonly required>
                                    <br />

                                    <div class="form-grup">
                                        <label class="control-label" for="nickname">{{ 'Nombre De La Mascota' }}</label>
                                        <input class="form-control" type="text" name="nickname" id="nickname"
                                            value="{{ isset($petRow->nickname) ? $petRow->nickname : '' }}" required>
                                        <br />     
                                    </div>  

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">                                
                                            <label class="input-group-text" for="species">{{ 'Especie' }}</label>
                                        </div>
                                        <Select name="species" id="species" required>
                                            <option value="{{ isset($petRow->species) ? $petRow->species : '' }}">
                                                {{ isset($petRow->species) ? $petRow->species : '--SELECCIONE--' }}</option>
                                            <option value="Canino">{{ 'Canino' }}</option>
                                            <option value="Felino">{{ 'Felino' }}</option>
                                        </Select>
                                        <br />
                                    </div>

                                    <div class="form-grup">
                                        <label for="age" class="control-label">{{ 'Edad En Meses' }}</label>
                                        <input class="form-control" type="number" name="age" id="age"
                                            value="{{ isset($petRow->age) ? $petRow->age : '' }}" required>
                                        <br />
                                    </div>

                                    <input class="btn btn-success" type="submit" value="{{ $from ?? ''=='create' ? 'AGREGAR':'MODIFICAR' }}">
            
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <form action="{{ url('/pets/'.$petRow->id_pet) }}" method="post" style="display:inline">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button class="btn btn-danger" type="submit" onclick="return confirm('¿Desea eliminar permanentemente este registro?')">Eliminar</button>
        </form>
        </td>
    </tr>
    @endforeach
</tbody>

</table>

<div class="row">
    <div class="mx-auto">
        {{$pets->links()}}
    </div>
    </div>

@endsection