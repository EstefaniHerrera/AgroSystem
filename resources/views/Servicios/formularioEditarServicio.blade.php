@extends('Plantillas.plantilla')
@section('titulo', 'Editar servicio técnico')
@section('contenido')

    <h1> Editar servicio técnico</h1>
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

    <form id="form_editar" name="form_editar" method="POST" action="{{ route('servicio.update', $servicio->id) }}" onsubmit="confirmar()">
        @method('put')
        @csrf <!-- PARA PODER ENVIAR EL FORMULARIO -->

        <div class="form-group">
            <label for="tecnico">Técnico</label>
            <select class="form-control" name="tecnico" id="tecnico" required>
                <option value="">--Seleccione--</option>
                @foreach ($personals as $personal)
                    <option @if ($servicio->empleado_id == $personal['id'])
                                selected
                            @endif
                            value="{{$personal['id']}}">{{$personal['NombresDelEmpleado']}} {{$personal['ApellidosDelEmpleado']}}-{{$personal->NombreDelCargo}}</option>
                @endforeach
            </select>
        </div>
    <div class="form-group">
        <label for="Cliente"> Cliente </label>
            <select name="Cliente" id="Cliente" class="select2222" required>
                <option style="display: none;" value="">Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option @if ($servicio->cliente_id == $cliente['id'])
                                selected
                            @endif
                            value="{{$cliente['id']}}">{{$cliente['NombresDelCliente']}} {{$cliente['ApellidosDelCliente']}}</option>
                @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="Teléfono"> Teléfono del cliente</label>
        <input type="tel" class="form-control" name="TeléfonoCliente" id="TeléfonoCliente"
            pattern="([2-3, 8-9][0-9]{7})" required placeholder="00000000"
            value="{{ old('TeléfonoCliente', $servicio->TeléfonoCliente) }}" maxlength="8"
            title="El teléfono debe comenzar con 2, 3, 8 o 9. Debe ingresar 8 caracteres"
            {{--#65 Corrección para que no se ingresen caracteres no numéricos--}}
            {{-- Llamada a la funcion para que solo tome numeros  --}}
            onkeypress="return valideKey(event);">
    </div>

    <?php $fecha_actual = date('d-m-Y'); ?>

        <div class="form-group">
            <label style="width: 100%" for=""> Fecha en que se realizará el servicio </label>
            <input style="width: 100%" type="date" name="FechaDeRealizacion"
                   class="form-control {{ $errors->has('FechaDeRealizacion') ? 'is-invalid' : '' }}"
                   value="{{ old('FechaDeRealizacion', $servicio->FechaDeRealizacion) }}" id="FechaDeRealizacion" title="Ingrese la fecha en la que hara el servicio" min="<?php echo date('Y-m-d', strtotime($fecha_actual . '+ 1 day')); ?>">
        </div>

        <div class="form-group">
            <label for="DescripciónDelServicio"> Descripción </label>
            <textarea required class="form-control" name="DescripciónDelServicio" maxlength="200" id="DescripciónDelServicio" cols="30" rows="10" placeholder="Breve descripción de la función del servicio">{{old('DescripciónDelServicio', $servicio->DescripciónDelServicio)}}</textarea>
        </div>

        <div class="form-group">
            <label for="Dirección"> Dirección </label>
            <input type="text" class="form-control" name="Dirección" id="Dirección" maxlength="150" required
                   placeholder="Dirección donde se hará el servicio" value="{{old('Dirección', $servicio->Dirección)}}" >
        </div>


        <br>
        <input type="submit" class="btn btn-primary" value="Actualizar" >
        <a class="btn btn-danger" href="{{route('servicio.edit', ['id' => $servicio->id])}}">Restaurar</a>
        <a class="btn btn-info" href="{{route('servicio.index')}}">Cerrar</a>

    </form>
@endsection



@push('alertas')
{{--#65 Corrección para que no se ingresen caracteres no numéricos--}}
    {{-- Funcion para que solo tome numeros --}}
    <script type="text/javascript">
        function valideKey(evt) {
            // code is the decimal ASCII representation of the pressed key.
            var code = (evt.which) ? evt.which : evt.keyCode;
            if (code == 8) { // backspace.
                return true;
            } else if (code >= 48 && code <= 57) { // is a number.
                return true;
            } else { // other keys.
                return false;
            }
        }
    </script>
    <script>
        $('#tecnico').val({{$servicio->cargo_id}});
    </script>

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

        $(document).ready(function() {

        new TomSelect(".select2222", {
            create: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
        });

        function confirmar(id) {
            var formul = document.getElementById("form_editar");
            Swal.fire({
                title: '¿Está seguro que desea actualizar los datos del servicio técnico?',
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