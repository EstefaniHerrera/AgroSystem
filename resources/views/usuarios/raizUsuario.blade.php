@extends('Plantillas.plantilla')
@section('titulo', 'Usuario')
@section('barra')
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form action="{{ route('usuarios.index2') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-6 my-1">
                            <input type="search" class="form-control" name="texto" value="{{ $texto }}"
                                placeholder="Buscar por nombre del usuario o del empleado">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" class="btn"
                                style="background-color:gray; border-color:black; color:white" value="Buscar">
                            <a href="{{ route('usuarios.index') }}" class="btn my-8"
                                style="background-color:gray; border-color:black; color:white"> Borrar búsqueda</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('contenido')
    <style>
        @media (max-width: 868px) {

            /* ///////////////////////////////// */
            .ContenidoBarra2 {
                display: block;
                width: 100%;
                height: 5%;
                padding: 5px;
                min-height: 5vh;
                transition: all 0.3s;
            }

            .ContenidoBarra {
                display: none;
            }
        }
    </style>

    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
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
    <br><br>

    <h1 class=""> Listado de usuarios </h1>
    <br><br>
    <div class="d-grid gap-2 d-md-block ">
        <a class="btn" style="background-color:rgb(65, 145, 126); border-color:black; color:white"
            href="{{ route('usuarios.crear') }}"><span class="glyphicon glyphicon-plus"></span> Agregar usuario </a>
    </div>
    <br>
    <table class="table table-bordered border-dark">
        <thead class="table-dark">
            <tr class="info">
                <th scope="col">N°</th>
                <th scope="col">Nombre del empleado</th>
                <th scope="col">Nombre de usuario</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $item => $user)
                <tr class="active">
                    <th scope="col"><strong>{{ $item + $users->firstItem() }}</strong></th>
                    <td scope="col">{{ $user->name }}</td>
                    <td scope="col">{{ $user->username }}</td>
                    <td>
                        <a class="btn btn-danger" style="border-color:black; color:white;"
                            onclick="EliminarUsuario({{ $user->id }})">
                            <span class="glyphicon glyphicon-trash"></span>
                            Eliminar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"> No hay más usuarios </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $users->links() }}


@endsection
@section('contenido2')
    @if (session('mensaje'))
        <div class="alert alert-success">
            {{ session('mensaje') }}
        </div>
    @endif
    <br>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <form action="{{ route('usuarios.index') }}" method="GET">
                    <div class="form-row">
                        <div class="col-sm-6 my-1">
                            <input type="search" class="form-control" name="texto" value=""
                                placeholder="Buscar por nombre" title="Buscar por nombre">
                        </div>
                        <div class="col-auto my-1">
                            <input type="submit" class="btn btn-secondary" value="Buscar">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-success my-8">Borrar Búsqueda</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>



    <h1 class=""> Listado Del Usuarios </h1>
    <br>
    <div class="d-grid gap-2 d-md-block ">
        <a class="btn btn-success float-" href="{{ route('usuarios.crear') }}"> Agregar usuario </a>
        <a class="btn btn-success float-end me-md-2" href=""> Regresar </a>
    </div>

    <br>

    <table class="table table-bordered border-dark mt-3">
        <thead class="table table-striped table-hover">
            <tr class="success">
                <th scope="col">N°</th>
                <th scope="col">Identidad</th>
                <th scope="col">Nombre Completo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $item => $user)
                <tr class="active">
                    <th scope="row"><strong>{{ $item + $users->firstItem() }}</strong></th>
                    <td scope="col">{{ $user->name }}</td>
                    <td scope="col">{{ $user->username }}</td>
                    <td scope="col"></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4"> No hay más usuarios </td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $users->links() }}

@endsection


@push('alertas')
    <script>
        function EliminarUsuario(id) {
            var ruta = "/destroyUsuario/" + id;
            Swal.fire({
                title: '¿Está seguro que desea eliminar el usuario?',
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
