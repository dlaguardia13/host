<h1>REGISTRO DE CLIENTES</h1>

@extends('layouts.plant')
@section('content')

<form action="{{url('/owners')}}" method="post" class="form-horizontal">

{{csrf_field()}}

@include('owners.form',['from'=>'create'])
 
</form>
@endsection