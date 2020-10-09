<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal"
    data-whatever="@mdo">Nuevo</button>

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modalLabel">Nueva consulta</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/medical_records') }}" method="post">
                    {{ csrf_field() }}
                    <form class="form-goup">
                        @if ($errors->any())
                            <div class="errors">
                                <p><strong>Datos colocados de forma incorrecta, por favor ingresarlos de nuevo<strong>
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
                            <input class="form-control" type="text" name="pet" id="pet" placeholder="Ej. CAN-000" required
                                pattern="(CAN|FEL)[-][0-9]{3}" title="El formato de codigo unico no corresponde">
                            <br />
                        </div>

                        <div class="form-grup">
                            <label class="control-label" for="owner">{{ 'Nombre Del Dueño' }}</label>
                            <input class="form-control" type="text" name="owner" id="owner" placeholder="Ej. Juan Perez" required>
                            <br />
                        </div>

                        <div class="form-grup">
                            <label class="control-label" for="consultation_date">{{ 'Fecha De Consulta' }}</label>
                            <input class="form-control" type="date" name="consultation_date" id="consultation_date"
                                required>
                            <br />
                        </div>

                        <div class="form-grup">
                            <label class="control-label"
                                for="actual_weight">{{ 'Peso De La Mascota En Kilogramos' }}</label>
                            <input class="form-control" type="number" name="actual_weight" id="actual_weight" placeholder="Ej. 5" required>
                            <br />
                        </div>


                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="reason"> {{ 'Motivo De Consulta' }} </label>
                            </div>
                            <Select name="reason" id="reason" required>
                                <option
                                    value="{{ isset($medicalRecordCatcher->reason) ? $medicalRecordCatcher->reason : '' }}">
                                    {{ isset($medicalRecordCatcher->reason) ? $medicalRecordCatcher->reason : '--SELECCIONE--' }}
                                </option>
                                <option value="Ordinaria">{{ 'Ordinaria' }}</option>
                                <option value="Reconsulta">{{ 'Reconsulta' }}</option>
                                <option value="Cirugía">{{ 'Cirugía' }}</option>
                            </Select>
                            <br />
                        </div>

                        <div class="form-grup">
                            <label class="control-label" for="description">{{ 'Notas De La Consulta' }}</label>
                            <br>
                            <textarea name="description" id="description" cols="30" rows="10" required>
                            </textarea>
                            <br />
                        </div>

                        <input class="btn btn-success" type="submit"
                            value="{{ $from == 'create' ? 'AGREGAR' : 'MODIFICAR' }}">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
