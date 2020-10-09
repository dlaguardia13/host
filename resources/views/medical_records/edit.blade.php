<h1>MODIFICAR CONSULTA</h1>
<form action="{{ url('/medical_records/'.$medicalRecordCatcher->id_medical_record) }}" method="post">
{{csrf_field()}}
{{method_field('PATCH')}}

@include('medical_records.form',['from'=>'modify'])

</form>