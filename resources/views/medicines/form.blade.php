<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal"
    data-whatever="@mdo">Nuevo</button>


<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modalLabel">Registro de medicamentos</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/medicines') }}" method="post">
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
                        <div>
                            <label class="control-label" for="serial">{{ 'Serial' }}</label>
                            <input class="form-control" type="number" name="serial" id="serial" placeholder="Ej. 1234" required>
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="medical_name" class="control-label">{{ 'Nombre Comercial' }}</label>
                            <input class="form-control" type="text" name="medical_name" id="medical_name" placeholder="Ej. aspirina" required>
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="expiry_date" class="control-label">{{ 'Fecha De Vencimiento' }}</label>
                            <input class="form-control" type="date" name="expiry_date" id="expiry_date" required>
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="brand" class="control-label">{{ 'Marca' }}</label>
                            <input class="form-control" type="text" name="brand" id="brand" placeholder="Ej. bayer" required>
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="presentation" class="control-label">{{ 'Presentación Por Dosis' }}</label>
                            <input type="text" name="presentation" id="presentation" class="form-control" placeholder="20 ml" required
                                pattern="[0-9]{1,3}[ ](ml|mg|uni|tbt)"
                                title="Se debe colocar a lo sumo 3 dígitos, un espacio y la unidad de medida ml, mg, uni (unidad) o tbt (tabletas)">
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="stock" class="control-label">{{ 'Stock' }}</label>
                            <input class="form-control" type="number" name="stock" id="stock" placeholder="Ej. 20" required>
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
