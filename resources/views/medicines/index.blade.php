@extends('layouts.plant')
@section('content')

    @if (Session::has('message')){{ Session::get('message') }}
    @endif


    <h1>Inventario de medicamentos</h1>
    <div>@include('medicines.form',['from'=>'create'])</div>
    <br>

    <h6>
        @if ($search)
            <div class="alert alert-primary" role="alert">
                Resultados de la busqueda '{{ $search }}' son:
            </div>
        @endif
    </h6>

    <table class="table table-hover table-bordered" width="50%" border="1">
        <thead class="thead-dark">
            <tr>
                <center>
                    <th>No.</th>
                </center>
                <center>
                    <th>Serial</th>
                </center>
                <center>
                    <th>Nombre Comercial</th>
                </center>
                <center>
                    <th>Fecha De Vencimiento</th>
                </center>
                <center>
                    <th>Marca</th>
                </center>
                <center>
                    <th>Presentación Por Dosis</th>
                </center>
                <center>
                    <th>Stock</th>
                </center>
                <center>
                    <th>FUNCIONES</th>
                </center>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicines as $medicineRow)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $medicineRow->serial }}</td>
                    <td>{{ $medicineRow->medical_name }}</td>
                    <td>{{ $medicineRow->expiry_date }}</td>
                    <td>{{ $medicineRow->brand }}</td>
                    <td>{{ $medicineRow->presentation }}</td>
                    <td>{{ $medicineRow->stock }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#modalEdit{{ $medicineRow->id_medical }}" data-whatever="@mdo">Modificar</button>

                        <div class="modal fade" id="modalEdit{{ $medicineRow->id_medical }}" tabindex="-1"
                            aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title" id="modalLabel">Modificar stock</h1>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/medicines/' . $medicineRow->id_medical) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <form class="form-goup">
                                                @if ($errors->any())
                                                    <div class="errors">
                                                        <p><strong>Datos colocados de forma incorrecta, por favor
                                                                ingresarlos de nuevo<strong>
                                                        </p>
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <div>
                                                    <label class="control-label" for="serial">{{ 'Serial' }}</label>
                                                    <input class="form-control" type="number" name="serial" id="serial"
                                                        value="{{ isset($medicineRow->serial) ? $medicineRow->serial : '' }}"
                                                        required>
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label for="medical_name"
                                                        class="control-label">{{ 'Nombre Comercial' }}</label>
                                                    <input class="form-control" type="text" name="medical_name"
                                                        id="medical_name"
                                                        value="{{ isset($medicineRow->medical_name) ? $medicineRow->medical_name : '' }}"
                                                        required>
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label for="expiry_date"
                                                        class="control-label">{{ 'Fecha De Vencimiento' }}</label>
                                                    <input class="form-control" type="date" name="expiry_date"
                                                        id="expiry_date"
                                                        value="{{ isset($medicineRow->expiry_date) ? $medicineRow->expiry_date : '' }}"
                                                        required>
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label for="brand" class="control-label">{{ 'Marca' }}</label>
                                                    <input class="form-control" type="text" name="brand" id="brand"
                                                        value="{{ isset($medicineRow->brand) ? $medicineRow->brand : '' }}"
                                                        required>
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label for="presentation"
                                                        class="control-label">{{ 'Presentación Por Dosis' }}</label>
                                                    <input type="text" name="presentation" id="presentation"
                                                        class="form-control"
                                                        value="{{ isset($medicineRow->presentation) ? $medicineRow->presentation : '' }}"
                                                        required pattern="[0-9]{1,3}[ ](ml|mg|uni|tbt)"
                                                        title="Se debe colocar a lo sumo 3 dígitos, un espacio y la unidad de medida ml, mg, uni (unidad) o tbt (tabletas)">
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label for="stock" class="control-label">{{ 'Stock' }}</label>
                                                    <input class="form-control" type="number" name="stock" id="stock"
                                                        value="{{ isset($medicineRow->stock) ? $medicineRow->stock : '' }}"
                                                        required>
                                                    <br />
                                                </div>

                                                <input class="btn btn-success" type="submit"
                                                    value="{{ $from ?? '' == 'create' ? 'AGREGAR' : 'MODIFICAR' }}">

                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                            </form>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ url('/medicines/' . $medicineRow->id_medical) }}" method="post"
                            style="display:inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit"
                                onclick="return confirm('¿Desea dar de baja permanentemente este medicamento?')">Dar De
                                Baja</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="row">
        <div class="mx-auto">
            {{ $medicines->links() }}
        </div>
    </div>

@endsection
