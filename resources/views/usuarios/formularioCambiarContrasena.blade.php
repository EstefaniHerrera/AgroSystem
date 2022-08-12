<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de contraseña</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            flex-direction: column;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(to right, rgb(65, 145, 126), #5fc481);
        }

        form {
            display: flex;
            flex-direction: column;
            background: #fff;
            text-align: center;
            padding: 20px 25px;
            box-shadow: 0 5px 10px rgba(71, 3, 6, 0.7);
            margin-top: 10px;
            margin-bottom: 10px;
        }

        h1 {
            font: italic display: initial;
            flex-direction: column;
            text-align: center;
            padding: 80px 100px;
        }

        .btnf {
            color: #fff;
            border: none;
            background: linear-gradient(to right, rgb(65, 145, 126), #5fc481);
            padding: 10px 80px;
            cursor: pointer;
            font-size: 20px;
            margin-top: 5px;
            text-align: center;


        }

        .form-control {
            outline: none;
            border: none;
            color: #252525;
            border-bottom: solid 1px rgb(65, 145, 126);
            padding: 0 5px;
            font-size: 15px;
        }
    </style>
</head>

<body>

    <form id="form_guardar" name="form_guardar" method="POST" action="{{ route('usuarios.update_contrasena') }}" onsubmit="fConfirmarmarContrasena()">
        @csrf

        <!-- PARA LOS ERRORES -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <h3>Datos de seguridad para cambiar contraseña</h3>
        <br><br>


        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="Empleado"> Seleccione su usuario </label><br>
                <select name="Empleado" id="Empleado" class="form-control" required style="width: 100%">
                    <option value="" style="display:none">Seleccione</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @if (old('Empleado') == $user->id) @selected(true) @endif >{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="pregunta_a">1.-¿Cúal fue el nombre de su primer mascota? </label>
                <input id="pregunta_a" type="text" class="form-control @error('pregunta_a') is-invalid @enderror"
                    name="pregunta_a" value="{{ old('pregunta_a') }}" autocomplete="pregunta_a"
                    onkeypress="return fSoloLetras(event);" style="text-transform: capitalize" maxlength="40"
                    minlength="3" required>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="pregunta_b"> 2.- ¿Cuál es tu color favorito? </label><br>
                <input id="pregunta_b" type="text" class="form-control @error('pregunta_b') is-invalid @enderror"
                    name="pregunta_b" value="{{ old('pregunta_b') }}" autocomplete="pregunta_b"
                    onkeypress="return fSoloLetras(event);" style="text-transform: capitalize" maxlength="40"
                    minlength="3" required>
            </div>

            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="pregunta_c"> 3.- ¿Cuál es la religión a la que perteneces? </label>
                <input id="pregunta_c" type="text" class="form-control @error('pregunta_c') is-invalid @enderror"
                    name="pregunta_c" value="{{ old('pregunta_c') }}" autocomplete="pregunta_c"
                    onkeypress="return fSoloLetras(event);" style="text-transform: capitalize" maxlength="40"
                    minlength="3" required>
            </div>

        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="password"> Nueva contraseña </label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="" autocomplete="new-password" required maxlength="20" minlength="8">
            </div>

            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="password-confirm"> Confirmación de contraseña </label>
                <input id="password-confirm" name="password_confirmation" type="password" class="form-control"
                    placeholder="" required autocomplete="new-password" maxlength="20" minlength="8">
            </div>
        </div>
        <br>
        <div class="row" style="width: 100%">
            <div class="col-sm-12">
                <input type="submit" class="btn btn-primary btnf" value="Actualizar">
                <a class="btn btn-danger btnf" href="{{ route('usuarios.cambiar_contrasena') }}">Limpiar</a>
                <a class="btn btn-info btnf" href="{{ route('login') }}">Cerrar</a>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
            </div>

        </div>

        {{--  --}}

    </form>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<!-- Bootstrap Js CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
{{-- <script src="tail.select-full.min.js"></script> --}}
<!-- Hierarchy Select Js -->
{{-- <script src="js/hierarchy-select.min.js"></script> --}}

<script type="text/javascript">
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/js/tom-select.complete.min.js"></script>
@stack('alertas')

<script>
    function fRestaurar() {
        $("#pregunta_a").val('');
        $("#pregunta_b").val('');
        $("#pregunta_c").val('');
        $("#password").val('');
        $("#password-confirm").val('');
    }

    function fConfirmarContrasena() {
        var formul = document.getElementById("form_guardar");
        Swal.fire({
            title: '¿Está seguro que desea cambiar la contraseña?',
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
        if (code == 8 || code == 32) {
            return true;
        } else if (code >= 65) {
            return true;
        } else {
            return false;
        }
    }
</script>
</body>

</html>
