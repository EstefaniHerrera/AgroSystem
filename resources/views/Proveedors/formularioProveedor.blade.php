@extends('Plantillas.plantilla')

@section('titulo', 'Formulario Del Proveedor')

@section('contenido')

    <h1> Registro de proveedor </h1>
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

    <form id="form_guardar" name="form_guardar" method="POST" action="{{ route('proveedor.guardar') }}"
        onsubmit="confirmar()">
        @csrf
        <div class="form-group">
            <label for="EmpresaProveedora"> Empresa proveedora </label>
            <input type="text" class="form-control" name="EmpresaProveedora" id="EmpresaProveedora" required
                placeholder="Nombres de la empresa proveedora" maxlength="40" value="{{ old('EmpresaProveedora') }}">
        </div>

        <div class="form-group">
            <label for="DirecciónDeLaEmpresa"> Dirección </label>
            <input type="text" class="form-control" name="DirecciónDeLaEmpresa" id="DirecciónDeLaEmpresa"
                placeholder="Dirección de la empresa" required maxlength="150" value="{{ old('DirecciónDeLaEmpresa') }}">
        </div>

        <div class="form-group">
            <label for=""> Correo electrónico </label>
            <input type="email" name="CorreoElectrónicoDeLaEmpresa"
                pattern="^[a-zA-Z0-9.!#$%&+/=?^_`{|}~]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$"
                class="form-control {{ $errors->has('CorreoElectrónicoDeLaEmpresa') ? 'is-invalid' : '' }}"
                value="{{ old('CorreoElectrónicoDeLaEmpresa') }}" id="CorreoElectrónicoDeLaEmpresa"
                 {{-- # 18 se corrigio el maxlength para que coincida con los establecido en el controlador --}}
                placeholder="hola@ejemplo.com" maxlength="40" title="Por favor ingrese un correo válido">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="TeléfonoDeLaEmpresa"> Teléfono de la empresa </label>
            <input type="tel" class="form-control" name="TeléfonoDeLaEmpresa" id="TeléfonoDeLaEmpresa"
                placeholder="00000000" pattern="([2-3, 8-9][0-9]{7})" required value="{{ old('TeléfonoDeLaEmpresa') }}" 
                maxlength="8" title="El teléfono debe comenzar con 2, 3, 8 o 9. Debe ingresar 8 caracteres"
                 {{-- # 19 Llamada a la funcion para que solo tome numeros  --}}
                        onkeypress="return valideKey(event);">
        </div>

        <div class="form-group">
            <label for="NombresDelEncargado"> Nombres del encargado </label>
            <input type="text" class="form-control" name="NombresDelEncargado" id="NombresDelEncargado" required title="No ingrese números ni signos"
                placeholder="Nombres del encargado en la empresa" pattern="[a-zA-ZñÑáéíóú ]+" maxlength="30" value="{{ old('NombresDelEncargado') }}">
        </div>

        <div class="form-group">
            <label for="ApellidosDelEncargado"> Apellidos del encargado </label>
            <input type="text" class="form-control" name="ApellidosDelEncargado" id="ApellidosDelEncargado" required title="No ingrese números ni signos"
                placeholder="Apellidos del encargado en la empresa" maxlength="40"
                value="{{ old('ApellidosDelEncargado') }}" pattern="[a-zA-ZñÑáéíóú ]+">
        </div>

        <div class="form-group">
            <label for="TeléfonoDelEncargado"> Teléfono del encargado </label>
            <input type="tel" class="form-control" name="TeléfonoDelEncargado" id="TeléfonoDelEncargado"
                placeholder="00000000" pattern="([2-3, 8-9][0-9]{7})" required value="{{ old('TeléfonoDelEncargado') }}" 
                maxlength="8" title="El teléfono debe comenzar con 2, 3, 8 o 9. Debe ingresar 8 caracteres">
                {{-- # 20 Llamada a la funcion para que solo tome numeros  --}}
                onkeypress="return valideKey(event);">
        </div>

        <br>
        <input type="submit" class="btn btn-primary" value="Guardar">
        <input type="reset" class="btn btn-danger" value="Limpiar">
        <a class="btn btn-info" href="{{ route('proveedor.index') }}">Cerrar</a>

    </form>

@endsection

@section('js')
    @push('alertas')
    
        {{-- # 19, 20 Funcion para que solo tome numeros --}}
        <script type="text/javascript"> 
            function valideKey(evt){    
                // code is the decimal ASCII representation of the pressed key.
                    var code = (evt.which) ? evt.which : evt.keyCode;
                if(code==8) { // backspace.
                    return true;
                } else if(code>=48 && code<=57) { // is a number.
                    return true;
                } else{ // other keys.
                    return false;
                }
            }
        </script>
        
        <script>
            function restaurar() {
                $("#EmpresaProveedora").val('');
                $("#DirecciónDeLaEmpresa").val('');
                $("#CorreoElectrónicoDeLaEmpresa").val('');
                $("#TeléfonoDeLaEmpresa").val('');
                $("#NombresDelEncargado").val('');
                $("#ApellidosDelEncargado").val('');
                $("#TeléfonoDelEncargado").val('');
            }

            function confirmar() {
                var formul = document.getElementById("form_guardar");
                Swal.fire({
                    title: '¿Está seguro que desea guardar los datos del nuevo proveedor?',
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
        </script>
    @endpush
@endsection
