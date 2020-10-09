<h1>MODIFICAR STOCK</h1>
<form action="{{ url('/medicines/'.$medicineCatcher->id_medical) }}" method="post">
{{csrf_field()}}
{{method_field('PATCH')}}

@include('medicines.form',['from'=>'modify'])

</form>