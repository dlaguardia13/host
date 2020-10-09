<h1>NUEVA CONSULTA</h1>
<br/>
<form action="{{url('/medical_records')}}" method="post">
{{csrf_field()}}

@include('medical_records.form',['from'=>'create'])
 


</form>