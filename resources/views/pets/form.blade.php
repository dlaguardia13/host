<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal"
    data-whatever="@mdo">Nuevo</button>


<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modalLabel">Registro de pacientes</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/pets') }}" method="post">
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
                        
                        <label class="control-label" for="unique_code">{{ 'Prevista Del Código Unico' }}</label>
                        <input class="form-control" type="text" name="unique_code" id="unique_code" 
                            value="{{ isset($petCatcher->unique_code) ? $petCatcher->unique_code : rand(1, 999) }}"
                            readonly required>
                        <br />

                        <div class="form-grup">
                            <label class="control-label" for="nickname">{{ 'Nombre De La Mascota' }}</label>
                            <input class="form-control" type="text" name="nickname" id="nickname" placeholder="Ej. Firulais"
                                value="{{ isset($petCatcher->nickname) ? $petCatcher->nickname : '' }}" required>
                            <br />     
                        </div>                        

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">                                
                                <label class="input-group-text" for="species">{{ 'Especie' }}</label>
                            </div>
                            <Select name="species" id="species" required>
                                <option value="{{ isset($petCatcher->species) ? $petCatcher->species : '' }}">
                                    {{ isset($petCatcher->species) ? $petCatcher->species : '--SELECCIONE--' }}</option>
                                <option value="Canino">{{ 'Canino' }}</option>
                                <option value="Felino">{{ 'Felino' }}</option>
                            </Select>
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="age" class="control-label">{{ 'Edad En Meses' }}</label>
                            <input class="form-control" type="number" name="age" id="age" placeholder="Ej. 15"
                                value="{{ isset($petCatcher->age) ? $petCatcher->age : '' }}" required>
                            <br />
                        </div>

                        <input class="btn btn-success" type="submit" value="{{ $from == 'create' ? 'AGREGAR' : 'MODIFICAR' }}">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
