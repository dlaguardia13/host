@extends('layouts.plant')
@section('content')

    @if (Session::has('message')){{ Session::get('message') }}
    @endif

    <h1>Consultas vigentes</h1>
    <div> @include('medical_records.form',['from'=>'create']) </div>
    <br>
    <br>

    <h5>
        @if ($search)
            <div class="alert alert-primary" role="alert" class="col.sm-6">
                Resultados de la busqueda '{{ $search }}' son:
            </div>
        @endif
    </h5>

    <table class="table table-hover table-bordered" width="50%" border="1">
        <thead class="thead-dark">
            <tr>
                <center>
                    <th>No.</th>
                </center>
                <center>
                    <th>Cód De Mascota</th>
                </center>
                <center>
                    <th>Nombre Del Dueño</th>
                </center>
                <center>
                    <th>Fecha De Cita</th>
                </center>
                <center>
                    <th>Peso Actual</th>
                </center>
                <center>
                    <th>Motivo De Consulta</th>
                </center>
                <center>
                    <th>Notas</th>
                </center>
                <center>
                    <th>FUNCIONES</th>
                </center>
            </tr>
        </thead>
        <tbody>
            @foreach ($medical_records as $medicalRow)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $medicalRow->pet }}</td>
                    <td>{{ $medicalRow->owner }}</td>
                    <td>{{ $medicalRow->consultation_date }}</td>
                    <td>{{ $medicalRow->actual_weight . ' Kg' }}</td>
                    <td>{{ $medicalRow->reason }}</td>
                    <td>{{ $medicalRow->description }}</td>
                    <td>

                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#modalEdit{{ $medicalRow->id_medical_record }}"
                            data-whatever="@mdo">Modificar</button>


                        <div class="modal fade" id="modalEdit{{ $medicalRow->id_medical_record }}" tabindex="-1"
                            aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title" id="modalLabel">Modificar consulta</h1>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form
                                            action="{{ url('/medical_records/' . $medicalRow->id_medical_record) }}"
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

                                                <div class="form-grup">
                                                    <label class="control-label" for="pet">{{ 'Código De Mascota' }}</label>
                                                    <input class="form-control" type="text" name="pet" id="pet"
                                                        value="{{ isset($medicalRow->pet) ? $medicalRow->pet : '' }}"
                                                        required pattern="(CAN|FEL)[-][0-9]{3}"
                                                        title="El formato de codigo unico no corresponde">
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label class="control-label"
                                                        for="owner">{{ 'Nombre Del Dueño' }}</label>
                                                    <input class="form-control" type="text" name="owner" id="owner"
                                                        value="{{ isset($medicalRow->owner) ? $medicalRow->owner : '' }}"
                                                        required>
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label class="control-label"
                                                        for="consultation_date">{{ 'Fecha De Consulta' }}</label>
                                                    <input class="form-control" type="date" name="consultation_date"
                                                        id="consultation_date"
                                                        value="{{ isset($medicalRow->consultation_date) ? $medicalRow->consultation_date : '' }}"
                                                        required>
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label class="control-label"
                                                        for="actual_weight">{{ 'Peso De La Mascota En Kilogramos' }}</label>
                                                    <input class="form-control" type="number" name="actual_weight"
                                                        id="actual_weight"
                                                        value="{{ isset($medicalRow->actual_weight) ? $medicalRow->actual_weight : '' }}"
                                                        required>
                                                    <br />
                                                </div>


                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="reason">
                                                            {{ 'Motivo De Consulta' }} </label>
                                                    </div>
                                                    <Select name="reason" id="reason" required>
                                                        <option
                                                            value="{{ isset($medicalRow->reason) ? $medicalRow->reason : '' }}">
                                                            {{ isset($medicalRow->reason) ? $medicalRow->reason : '--SELECCIONE--' }}
                                                        </option>
                                                        <option value="Ordinaria">{{ 'Ordinaria' }}</option>
                                                        <option value="Reconsulta">{{ 'Reconsulta' }}</option>
                                                        <option value="Cirugía">{{ 'Cirugía' }}</option>
                                                    </Select>
                                                    <br />
                                                </div>

                                                <div class="form-grup">
                                                    <label class="control-label"
                                                        for="description">{{ 'Notas De La Consulta' }}</label>
                                                    <br>
                                                    <textarea name="description" id="description" cols="30" rows="10"
                                                        required>
                                                    {{ isset($medicalRow->description) ? $medicalRow->description : '' }}
                                                    </textarea>
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

                        <form action="{{ url('/medical_records/' . $medicalRow->id_medical_record) }}" method="post"
                            style="display:inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" onclick="return confirm('¿Desea eliminar permanentemente este registro?')"
                                class=" btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="row">
        <div class="mx-auto">
            {{ $medical_records->links() }}
        </div>
    </div>

@endsection
