@extends('layouts.plant')
@section('content')

    @if (Session::has('message')){{ Session::get('message') }}
    @endif

    <h1>Inventario de suministros medicos</h1>

    <div>@include('medical_supplies.form',['from'=>'create'])</div>
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
                    <th>Nombre Del Suministro</th>
                </center>
                <center>
                    <th>Presentación</th>
                </center>
                <center>
                    <th>Marca</th>
                </center>
                <center>
                    <th>Fecha De Expiración</th>
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
            @foreach ($medical_supplies as $medicalRow)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $medicalRow->serial }}</td>
                    <td>{{ $medicalRow->supply_name }}</td>
                    <td>{{ $medicalRow->presentation }}</td>
                    <td>{{ $medicalRow->brand }}</td>
                    <td>{{ $medicalRow->expiry_date }}</td>
                    <td>{{ $medicalRow->stock }}</td>
                    <td>

                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#modalEdit{{ $medicalRow->id_medical_supply }}"
                            data-whatever="@mdo">Modificar</button>

                        <div class="modal fade" id="modalEdit{{ $medicalRow->id_medical_supply }}" tabindex="-1"
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
                                        <form action="{{ url('/medical_supplies/' . $medicalRow->id_medical_supply) }}"
                                            method="post">
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
                                                    <label for="serial" class="control-label">{{ 'Serial' }}</label>
                                                    <input class="form-control" type="number" name="serial" id="serial"
                                                        value="{{ isset($medicalRow->serial) ? $medicalRow->serial : '' }}"
                                                        required>
                                                    <br />
                                                </div>


                                                <div class="form-grup">
                                                    <label class="control-label"
                                                        for="supply_name">{{ 'Nombre Del Suministro' }}</label>
                                                    <input class="form-control" type="text" name="supply_name"
                                                        id="supply_name"
                                                        value="{{ isset($medicalRow->supply_name) ? $medicalRow->supply_name : '' }}"
                                                        required>
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label for="presentation"
                                                        class="control-label">{{ 'Presentación' }}</label>
                                                    <input class="form-control" type="text" name="presentation"
                                                        id="presentation"
                                                        value="{{ isset($medicalRow->presentation) ? $medicalRow->presentation : '' }}"
                                                        required pattern="[0-9]{1,3}[ ](ml|mg|uni|tbt)"
                                                        title="Se debe colocar a lo sumo 3 dígitos, un espacio y la unidad de medida ml, mg, uni (unidad) o tbt (tabletas)">
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label for="brand" class="control-label">{{ 'Marca' }}</label>
                                                    <input class="form-control" type="text" name="brand" id="brand"
                                                        value="{{ isset($medicalRow->brand) ? $medicalRow->brand : '' }}"
                                                        required>
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label for="expiry_date"
                                                        class="control-label">{{ 'Fecha De Caducidad' }}</label>
                                                    <input class="form-control" type="date" name="expiry_date"
                                                        id="expiry_date"
                                                        value="{{ isset($medicalRow->expiry_date) ? $medicalRow->expiry_date : '' }}">
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label class="control-label" for="stock">{{ 'Stock' }}</label>
                                                    <input class="form-control" type="number" name="stock" id="stock"
                                                        value="{{ isset($medicalRow->stock) ? $medicalRow->stock : '' }}"
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

                        <form action="{{ url('/medical_supplies/' . $medicalRow->id_medical_supply) }}" method="post"
                            style="display:inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" onclick="return confirm('¿Desea eliminar permanentemente este registro?')"
                                class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="row">
        <div class="mx-auto">
            {{ $medical_supplies->links() }}
        </div>
    </div>
@endsection
