<h1>REGISTRO DE PACIENTES</h1>
<br/>
<form action="{{url('/pets')}}" method="post">
{{csrf_field()}}

@include('pets.form',['from'=>'create'])
 
</form>