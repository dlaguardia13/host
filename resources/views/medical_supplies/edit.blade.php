<h1>MODIFICAR STOCK</h1>
<form action="{{ url('/medical_supplies/'.$medicalSupplyCatcher->id_medical_supply) }}" method="post">
{{csrf_field()}}
{{method_field('PATCH')}}

@include('medical_supplies.form',['from'=>'modify'])

</form>