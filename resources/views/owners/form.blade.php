<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal"
    data-whatever="@mdo">Nuevo</button>


<!-- modal ----------------------------------------->

<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="modalLabel">Registro de clientes</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/owners') }}" method="post" class="form-horizontal">
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
                            <label for="dpi" class="control-label">{{ 'DPI' }}</label>
                            <input class="form-control" placeholder="12345678" type="number" name="dpi" id="dpi">
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="owner_name" class="control-label">{{ 'Nombre' }}</label>
                            <input class="form-control" placeholder="Ej. Francisco" type="text" name="owner_name"
                                id="owner_name">
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="owner_lastname" class="control-label">{{ 'Apellido' }}</label>
                            <input class="form-control" placeholder="Ej. Perez" type="text" name="owner_lastname"
                                id="owner_lastname">
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="telephone" class="control-label">{{ 'Telefono' }}</label>
                            <input class="form-control" placeholder="Ej. 1234565" type="text" name="telephone"
                                id="telephone">
                            <br />
                        </div>

                        <div class="form-grup">
                            <label for="e_mail_address" class="control-label">{{ 'Correo Eléctronico' }}</label>
                            <input class="form-control" placeholder="Ej. example@gmail.com" type="email"
                                name="e_mail_address" id="e_mail_address">
                            <br />
                        </div>


                        <input class="btn btn-success" type="submit"
                            value="{{ $from == 'create' ? 'AGREGAR' : 'MODIFICAR' }}">

                        <a class="btn btn-secondary" data-dismiss="modal">CANCELAR</a>
                    </form>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal ----------------------------------------->
