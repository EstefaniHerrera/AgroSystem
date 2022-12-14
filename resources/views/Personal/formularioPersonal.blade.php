@extends('Plantillas.plantilla')

@section('titulo', 'Formulario Del Personal')

@section('contenido')

    <h1> Registro de personal </h1>
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

    <form id="form_guardar" name="form_guardar" method="POST" action="{{ route('personal.guardar') }}"
        onsubmit="confirmar()">
        @csrf
        <div class="form-group">
            <label for="cargo">Cargo</label>
            <select class="form-control" name="Cargo" id="Cargo" required>
                <option value="">--Seleccione--</option>
                @foreach ($cargos as $cargo)
                    {{-- # 10 Se agrego la opcion para que la seleccion no se borre cuando exista un error en el formulario--}}
                    <option value="{{ $cargo['id'] }}" @if (old('Cargo') == $cargo->id) @selected(true) @endif>
                        {{ $cargo['NombreDelCargo'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="IdentidadDelEmpleado"> Identidad </label>
            <input type="tel" class="form-control" name="IdentidadDelEmpleado" id="IdentidadDelEmpleado"
                placeholder="Identidad del empleado sin guiones" pattern="[0-1][0-8][0-2][0-9]{10}" required
                value="{{ old('IdentidadDelEmpleado') }}" maxlength="13" title="La identidad debe comenzar con 0 o con 1. Debe ingresar 13 caracteres"
                {{-- # 6 Llamada a la funcion para que solo tome numeros  --}}
                onkeypress="return valideKey(event);">
        </div>

        <div class="form-group">
            <label for="NombresDelEmpleado"> Nombres </label>
            <input type="text" class="form-control" name="NombresDelEmpleado" id="NombresDelEmpleado" required title="No ingrese n??meros ni signos"
                placeholder="Nombres del empleado" pattern="[a-zA-Z?????????????? ]+" maxlength="30" value="{{ old('NombresDelEmpleado') }}">
        </div>

        <div class="form-group">
            <label for="ApellidosDelEmpleado"> Apellidos </label>
            <input type="text" class="form-control" name="ApellidosDelEmpleado" id="ApellidosDelEmpleado" required title="No ingrese n??meros ni signos"
                placeholder="Apellidos del empleado" pattern="[a-zA-Z?????????????? ]+" maxlength="40" value="{{ old('ApellidosDelEmpleado') }}">
        </div>
        
        {{-- # 8 Se corrigio el maxlength para que coincida con lo establecido en el controlador --}}
        <div class="form-group">
            <label for="">Correo electr??nico:</label>
            <input type="email" name="CorreoElectr??nico"
                pattern="^[a-zA-Z0-9.!#$%&+/=?^_`{|}~]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$"
                class="form-control {{ $errors->has('CorreoElectr??nico') ? 'is-invalid' : '' }}"
                value="{{ old('CorreoElectr??nico') }}" id="CorreoElectr??nico" placeholder="hola@ejemplo.com" required
                title="por favor ingrese un correo valido" maxlength="40">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="Tel??fono"> Tel??fono </label>
            <input type="tel" class="form-control" name="Tel??fono" id="Tel??fono" placeholder="00000000"
                pattern="([2-3, 8-9][0-9]{7})" required value="{{ old('Tel??fono') }}" maxlength="8" title="El tel??fono debe comenzar con 2, 3, 8 o 9. Debe ingresar 8 caracteres"
                 {{-- # 7 Llamada a la funcion para que solo tome numeros  --}}
                onkeypress="return valideKey(event);">
        </div>

        <?php
        $fecha_actual = date('d-m-Y');
        ?>
        
        <div class="form-group">
            <label for="FechaDeNacimiento">Fecha nacimiento:</label>
            <input require type="date" class="form-control" name="FechaDeNacimiento" id="FechaDeNacimiento"
                value="{{ old('FechaDeNacimiento') }}" min="<?php echo date('Y-m-d', strtotime($fecha_actual . '- 70 year')); ?>" max="<?php echo date('Y-m-d', strtotime($fecha_actual . '- 18 year')); ?>">
        </div>

        {{-- # 9 Se establecio un limite en la fecha --}}
        <div class="form-group">
            <label for="FechaDeIngreso">Fecha ingreso:</label>
            <input require type="date" class="form-control " name="FechaDeIngreso" id="FechaDeIngreso"
                value="{{ old('FechaDeIngreso') }}" max="<?php echo date('Y-m-d', strtotime($fecha_actual)); ?>" min="<?php echo date('Y-m-d', strtotime('2014-01-01')); ?>">
        </div>


        <div class="form-group">
            <label for="Ciudad"> Ciudad </label>
            <input type="text" class="form-control" name="Ciudad" id="Ciudad" placeholder="Ciudad del empleado"
                maxlength="20" value="{{ old('Ciudad') }}" required>
        </div>

        <div class="form-group">
            <label for="Direcci??n"> Direcci??n </label>
            <input type="text" class="form-control" name="Direcci??n" id="Direcci??n" placeholder="Direcci??n del empleado"
                maxlength="150" value="{{ old('Direcci??n') }}" required>
        </div>

        <br>
        <input type="submit" class="btn btn-primary" value="Guardar">
        <input type="button" class="btn btn-danger" value="Limpiar" onclick="restaurar()">
        <a class="btn btn-info" href="{{ route('personal.index') }}">Cerrar</a>

    </form>

@endsection

@section('js')
    @push('alertas')

    {{-- #6, 7 Funcion para que solo tome numeros --}}
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
                $("#Direcci??n").val('');
                $("#ApellidosDelEmpleado").val('');
                $("#NombresDelEmpleado").val('');
                $("#Ciudad").val('');
                $("#FechaDeIngreso").val('');
                $("#FechaDeNacimiento").val('');
                $("#Tel??fono").val('');
                $("#CorreoElectr??nico").val('');
                $("#IdentidadDelEmpleado").val('');
                $("#Cargo").val('');
            }

            function confirmar() {
                var formul = document.getElementById("form_guardar");


                Swal.fire({
                    title: '??Est?? seguro que desea guardar los datos del nuevo empleado?',
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
