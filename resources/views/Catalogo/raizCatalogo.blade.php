@extends('Plantillas.plantilla')
@section('titulo', 'Catálogo')
@section('barra')
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
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form method="GET" action="{{ route('catalogo.buscar') }}">
                    <div class="form-row">
                        <div class="col-sm-3 my-1">
                            <label for="id">Proveedor</label>
                            <select class="select222" name="id" id="id">
                                @if (isset($id) && $id !=0)
                                    @foreach ($proveedor as $proveedo)
                                        @if ($proveedo->id == $id)
                                            <option style="display: none" value="{{ $proveedo['id'] }}">{{ $proveedo['EmpresaProveedora'] }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option style="display: none" value="0">--Seleccione--</option>
                                @endif
                                @foreach ($proveedor as $provee)
                                    <option value="{{ $provee['id'] }}">{{ $provee['EmpresaProveedora'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <?php
                        $fecha_actual = date('d-m-Y');
                        ?>
                        <div class="col-sm-2 my-1">
                            <label for="id">Fecha desde</label>
                            <input style="width: 100%" type="date" class="form-control" name="FechaDesde" id="Fechadesde"
                                maxlength="40" value="{{ $fechadesde }}" max="<?php echo date('Y-m-d', strtotime($fecha_actual)); ?>" min="<?php echo date('Y-m-d', strtotime('2022-01-01')); ?>">
                        </div>
                        <div class="col-sm-2 my-1">
                            <label for="id">Fecha hasta</label>
                            <input style="width: 100%" type="date" class="form-control" name="FechaHasta" id="Fechahasta"
                                maxlength="40" value="{{ $fechahasta }}" max="<?php echo date('Y-m-d', strtotime($fecha_actual)); ?>" min="<?php echo date('Y-m-d', strtotime('2022-01-01')); ?>">
                        </div>

                    </div>
                    <br>
                    <input type="submit" class="btn my-8" style="background-color:gray; border-color:black; color:white" value="Buscar">
                    <a href="{{ route('catalogo.index') }}" class="btn my-8" style="background-color:gray; border-color:black; color:white"> Borrar búsqueda </a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('contenido')

    <br><br>
    <h1 class=""> Listado de catálogos </h1>
    <br><br>
    <div class="d-grid gap-2 d-md-block ">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white" href="{{route('catalogo.crear')}}"><span class="glyphicon glyphicon-plus"></span> Agregar catálogo </a>
    </div>

        <br>
        <div class="table-responsive">
            <table class="table table-bordered border-dark mt-3">
                <thead class="table table-striped table-hover">
                    <tr class="info">
                        <th scope="col">N°</th>
                        <th scope="col">Empresa proveedora</th>
                        <th scope="col">Nombre y descripción del catálogo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($catalogo as $cata)
                        <tr class="active">
                            <th scope="col">{{ $cata->id }}</th>
                            <td scope="col">{{ $cata->proveedors->EmpresaProveedora }}</td>
                            <td scope="col">{{ $cata->NombreCatálogo }}</td>
                            <td scope="col">{{ $cata->FechaDeCatalogo }}</td>
                            <td>
                                <a class="btn" style="background-color:white; border-color:black; color:black"
                                    href="Archivos/{{ $cata->Documento }}" target="blank">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                    Ver catálogo
                                </a>
    
                                <a class="btn" style="background-color:white; border-color:black; color:black"
                                    href="{{ route('catalogo.edit', ['id' => $cata->id]) }}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Editar
                                </a>
    
                                <a class="btn btn-danger" style="border-color:black; color:white;"
                                    onclick="EliminarCatalogo({{ $cata->id }})">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    Eliminar</a>
                                </a>
    
                            </td>
    
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"> No hay más catálogos </td>
                        </tr>
                    @endforelse
    
                </tbody>
            </table>
        </div>
    {{ $catalogo->links()}}

@endsection
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

        function EliminarCatalogo(id) {
            var ruta = "/destroyCatalogo/" + id;
            Swal.fire({
                title: '¿Está seguro que desea eliminar el catálogo?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    window.location = ruta;
                }


            })
        }
    </script>
@endpush
