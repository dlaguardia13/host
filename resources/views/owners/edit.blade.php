

<h1>Modificar registro</h1>
<form action="{{ url('/owners/'.$ownerCatcher->id_owner) }}" class="form-horizontal"  method="post">

{{csrf_field()}}
{{method_field('PATCH')}}
@include('owners.form',['from'=>'modify'])
</form>




