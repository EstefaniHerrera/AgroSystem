@extends('Plantillas.plantilla')

@section('titulo', 'Registro de Clientes')

@section('contenido')

<h1> Registro de cliente </h1>
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

<form id="form_guardarC" name="form_guardarC" method="POST" action="{{ route('cliente.guardar') }}" onsubmit="confirmar()">
    @csrf

    <div class="form-group">
        <label for="IdentidadDelCliente"> Identidad </label>
        <input type="tel" class="form-control" name="IdentidadDelCliente" maxlength="13" id="IdentidadDelCliente"
        placeholder="Identidad del cliente sin guiones" pattern="[0-1][0-8][0-2][0-9]{10}" 
        required value="{{old('IdentidadDelCliente')}}" title="La identidad debe comenzar con 0 o con 1. Debe ingresar 13 caracteres"
        {{-- # 25 Llamada a la funcion para que solo tome numeros  --}}
        onkeypress="return valideKey(event);">
    </div>

    <div class="form-group">
        <label for="NombresDelCliente"> Nombres </label>
        <input type="text" class="form-control" name="NombresDelCliente" id="NombresDelCliente" required
        placeholder="Nombres del cliente" maxlength="30" pattern="[a-zA-ZñÑáéíóú ]+" value="{{old('NombresDelCliente')}}" title="No ingrese números ni signos">
    </div>

    <div class="form-group">
        <label for="ApellidosDelCliente"> Apellidos </label>
        <input type="text" class="form-control" name="ApellidosDelCliente" id="ApellidosDelCliente" required
        placeholder="Apellidos del cliente" maxlength="40" pattern="[a-zA-ZñÑáéíóú ]+" value="{{old('ApellidosDelCliente')}}" title="No ingrese números ni signos">
    </div>

    <div class="form-group">
        <label for="Telefono"> Teléfono </label>
        <input type="tel" class="form-control" name="Telefono" id="Telefono" placeholder="00000000"
        pattern="([2-3, 8-9][0-9]{7})" value="{{old('Telefono')}}" maxlength="8" title="El teléfono debe comenzar con 2, 3, 8 o 9. Debe ingresar 8 caracteres"
        {{-- # 26 Llamada a la funcion para que solo tome numeros  --}}
        onkeypress="return valideKey(event);">
    </div>

    <div class="form-group">
        <label for="LugarDeProcedencia"> Dirección </label>
        <input type="text" class="form-control" name="LugarDeProcedencia" id="LugarDeProcedencia"
        {{-- # 27 se corrigio el maxlength para que coincida con los establecido en el controlador --}}
        placeholder="Lugar de Procedencia" maxlength="70" minlength="10" value="{{old('LugarDeProcedencia')}}" required>
    </div>

    <br>
    <input type="submit" class="btn btn-primary" value="Guardar">
    <input type="button" class="btn btn-danger" value="Limpiar" onclick="restaurar()">
    <a class="btn btn-info" href="{{route('cliente.index')}}">Cerrar</a>

</form>

@endsection
@push('alertas')

    {{-- # 25, 26 Funcion para que solo tome numeros --}}
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
            $("#IdentidadDelCliente").val('');
            $("#NombresDelCliente").val('');
            $("#ApellidosDelCliente").val('');
            $("#Telefono").val('');
            $("#LugarDeProcedencia").val('');
        }

        function confirmar() {
           var formul = document.getElementById("form_guardarC");
            Swal.fire({
                title: '¿Está seguro que desea guardar los datos del nuevo cliente?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then((result)=>{
                if (result.isConfirmed) {
                    formul.submit();
                }
            })
            event.preventDefault()
        }
    </script>
@endpush
