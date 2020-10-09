<h1>MODIFICAR REGISTROS DE PACIENTES</h1>
<form action="{{ url('/pets/'.$petCatcher->id_pet) }}" method="post">
{{csrf_field()}}
{{method_field('PATCH')}}

@include('pets.form',['from'=>'modify'])

</form>