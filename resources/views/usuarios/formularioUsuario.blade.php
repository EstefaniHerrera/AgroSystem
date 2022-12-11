@extends('Plantillas.plantilla')
@section('titulo', 'Registrar usuario')
@section('contenido')

    <h1> Registro de usuario </h1>
    <br><br>
    <!-- PARA LOS ERRORES -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif

    <form id="form_guardar" name="form_guardar" method="POST" action="{{ route('usuarios.guardar') }}" onsubmit="fConfirmarU()">
        @csrf
        <script>
            function fCompletar() {
                var select = document.getElementById("personal");
                var valor = select.value;
                @foreach ($personals as $personal)
                    if (valor == {{ $personal->id }}) {
                        var name = document.getElementById("name");
                        name.value = "{{ $personal->NombresDelEmpleado }} {{ $personal->ApellidosDelEmpleado }}";
                        var email = document.getElementById("email");
                        email.value = "{{ $personal->CorreoElectrónico }}";
                    }
                @endforeach
            }
        </script>

        <h3>Datos personales</h3>
        <hr>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="personal"> Empleado: </label>
                <select class="select222" name="personal" id="personal" onchange="fCompletar()" required>
                    <option value="">Seleccione un empleado</option>
                    @foreach ($personals as $personal)
                        <option value="{{ $personal->id }}" @if (old('personal') == $personal->id) @selected(true) @endif>{{ $personal['NombresDelEmpleado'] }}
                            {{ $personal['ApellidosDelEmpleado'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="username">Nombre de usuario:</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                    name="username" value="{{ old('username') }}" autocomplete="username"
                    onkeypress="return fSoloLetras(event);" style="text-transform: lowercase" maxlength="40" minlength="3"
                    required placeholder="Ingrese un nombre corto para usar como usuario">
            </div>

        </div>

        <h3>Datos de seguridad</h3>
        <hr>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="password"> Contraseña </label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="" autocomplete="new-password" required minlength="8" maxlength="20">
                
            </div>

            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="password-confirm"> Confirmación de contraseña </label>
                <input id="password-confirm" name="password_confirmation" type="password" class="form-control"
                    placeholder="" required autocomplete="new-password" minlength="8" maxlength="20">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="pregunta_a">1.-¿Cúal fue el nombre de su primer mascota? </label>
                <input id="pregunta_a" type="text" class="form-control @error('pregunta_a') is-invalid @enderror"
                    name="pregunta_a" value="{{ old('pregunta_a') }}" autocomplete="pregunta_a"
                    onkeypress="return fSoloLetras(event);" style="text-transform: capitalize" maxlength="40" minlength="3"
                    required>
            </div>

            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="pregunta_b"> 2.- ¿Cuál es tu color favorito? </label>
                <input id="pregunta_b" type="text" class="form-control @error('pregunta_b') is-invalid @enderror"
                    name="pregunta_b" value="{{ old('pregunta_b') }}" autocomplete="pregunta_b"
                    onkeypress="return fSoloLetras(event);" style="text-transform: capitalize" maxlength="40" minlength="3"
                    required>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="pregunta_c"> 3.- ¿Cuál es la religión a la que perteneces? </label>
                <input id="pregunta_c" type="text" class="form-control @error('pregunta_c') is-invalid @enderror"
                    name="pregunta_c" value="{{ old('pregunta_c') }}" autocomplete="pregunta_c"
                    onkeypress="return fSoloLetras(event);" style="text-transform: capitalize" maxlength="40" minlength="3"
                    required>
            </div>

            <div class="col-sm-6 mb-3 mb-sm-0" style="display: none">
                <label for="name"> Nombre </label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" autocomplete="email" autofocus readonly>
            </div>
        </div>

        <br>
        <input type="submit" class="btn btn-primary" value="Guardar">
        <a class="btn btn-danger" href="{{ route('usuarios.crear') }}">Limpiar</a>
        <a class="btn btn-info" href="{{ route('usuarios.index') }}">Cerrar</a>

        {{--  --}}

    </form>

@endsection

@section('js')
    @push('alertas')
        <script>
            $(document).ready(function() {

                new TomSelect(".select222", {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            });

            function fConfirmarU() {
                var formul = document.getElementById("form_guardar");
                Swal.fire({
                    title: '¿Está seguro que desea guardar los datos del nuevo usuario?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        formul.submit();
                    }
                })
                event.preventDefault()
            }

            function fSoloLetras(evt) {
                var code = (evt.which) ? evt.which : evt.keyCode;
                if (code == 45 || code == 46) {
                    return true;
                } else if (code >= 65) {
                    return true;
                } else {
                    return false;
                }
            }
        </script>
    @endpush
@endsection
