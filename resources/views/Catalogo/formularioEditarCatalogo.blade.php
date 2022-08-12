@extends('Plantillas.plantilla')
@section('titulo', 'Editar catálogo')
@section('contenido')

    <h1> Editar catálogo </h1>
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

    <form id="form_guardar" name="form_guardar" method="POST" action="{{ route('catalogo.update', $catalogo->id) }}" enctype="multipart/form-data" onsubmit="confirmar()">
        @method('put')
        @csrf 
        <div class="form-group">
            <label for="Proveedor"> Proveedor </label>
                <select name="Proveedor" id="Proveedor" class="select222" data-live-search="true" required
                style="width: 100%">
                    <option style="display: none;" value="">Seleccione un proveedor</option>
                        @foreach ($proveedor as $p)
                            <option value="{{ $p->id }}" @if (old('Proveedor') == $p->id) @selected(true) @endif>
                                {{ $p->EmpresaProveedora }}
                            </option>
                        @endforeach
                </select>
        </div>
        
        <div class="form-group">
            <label for="NombreCatálogo"> Nombre y descripción del catálogo </label>
            <textarea class="form-control" name="NombreCatálogo" id="NombreCatálogo" cols="30" rows="10" 
            placeholder="Agregue un nombre y una breve descripción para el catálogo" maxlength="150" required>{{old('NombreCatálogo', $catalogo->NombreCatálogo)}}
        </textarea>
        </div>

        <?php
        $fecha_actual = date('d-m-Y');
        ?>
        <div class="form-group">
            <label for="FechaDeCatalogo"> Fecha </label>
            <input type="date" class="form-control" name="FechaDeCatalogo" id="FechaDeCatalogo" 
            value="{{old('FechaDeCatalogo', $catalogo->FechaDeCatalogo)}}" required 
            min="<?php echo date('Y-m-d', strtotime($fecha_actual . '- 2 month')); ?>"
            max="<?php echo date('Y-m-d', strtotime($fecha_actual)); ?>">
        </div>

        <div class="form-group">
            <label  for="Documento"> Adjuntar archivo del catálogo </label>
            <input class="form-control" type="file" name="pdf" class="form-control-file">
        </div>

        <br>
        <input type="submit" class="btn btn-primary" value="Actualizar">
        <a class="btn btn-danger"  href="{{route('catalogo.edit', ['id' => $catalogo->id])}}"> Restaurar </a>
        <a class="btn btn-info" href="{{route('catalogo.index')}}" >Cerrar</a>
                
    </form>
@endsection
@section('js')
@push('alertas')
    <script>
        $('#Proveedor').val({{$catalogo->proveedor_id}});
    </script>

    <script>
        $('#Documento').val({{$catalogo->Archivos}});
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
        function confirmar($id) {
            var formul = document.getElementById("form_guardar");
            Swal.fire({
                title: '¿Está seguro que desea actualizar los datos del catálogo?',
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
@endsection
