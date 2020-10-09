<h1>REGISTRO DE MEDICAMENTOS VETERINARIOS</h1>
<br/>
<form action="{{url('/medicines')}}" method="post">
{{csrf_field()}}

@include('medicines.form',['from'=>'create'])
 


</form>