@extends('layouts.plant')
@section('content')

@if(Session::has('message')){{
    Session::get('message')
}}
@endif

<h1>Historial de inventarios</h1>

<table class="table table-hover table-bordered" width="50%" border="1">
<br>
<br>

<h6>
    @if($search)
    <div class="alert alert-primary" role="alert">
      Resultados de la busqueda '{{$search}}' son:
    </div>
    @endif
    </h6>

    
<thead class="thead-dark">
    <tr>
        <center><th>No.</th></center>
        <center><th>Serial</th></center>
        <center><th>Producto</th></center>
        <center><th>Nuevo Stock</th></center>
        <center><th>Stock Anterior</th></center>
        <center><th>Tipo De Producto</th></center>
        <center><th>Operacion Con Los Datos</th></center>
        <center><th>Fecha De La Operación</th></center>
    </tr>
</thead>
<tbody>
    @foreach($inv_logs as $invRow)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$invRow->serial}}</td>
        <td>{{$invRow->item}}</td>
        <td>{{$invRow->new_amount}}</td>
        <td>{{$invRow->old_amount}}</td>
        <td>{{$invRow->type}}</td>
        <td>{{$invRow->operation}}</td>
        <td>{{$invRow->date}}</td>
    </tr>
    @endforeach
</tbody>
</table>

<div class="row">
<div class="mx-auto">
    {{$inv_logs->links()}}
</div>
</div>


@endsection