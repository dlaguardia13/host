<h1>REGISTRO DE SUMINISTROS MEDICOS</h1>
<br/>
<form action="{{url('/medical_supplies')}}" method="post">
{{csrf_field()}}

@include('medical_supplies.form',['from'=>'create'])
 


</form>