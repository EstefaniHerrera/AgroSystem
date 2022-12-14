<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('titulo')</title>

    <!-- Librerias-->
    {{-- <link href="../../css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.3/dist/css/tom-select.css" rel="stylesheet">

    <style>
        .select2-container {
            width: 100% !important;
        }

        .select2-search--dropdown .select2-search__field {
            width: 98%;
        }

        {{-- DEMO STYLE --}} @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

        body {
            font-family: Century Gothic;
            background: #ffffff;
            font-size: small;
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-size: 1.1em;
            font-weight: 300;
            line-height: 1.7em;
            color: #999;
        }

        a,
        a:hover,
        a:focus {
            color: inherit;
            text-decoration: none;
            transition: all 0.3s;
        }

        .navbar {
            padding: 15px 10px;
            background: rgb(255, 255, 255);
            border: none;
            border-radius: 0;
            margin-bottom: 40px;
            box-shadow: 6px 6px 8px #90c8ac;
            ;
        }


        .navbar-btn {
            box-shadow: none;
            outline: none !important;
            border: none;
        }

        .line {
            width: 100%;
            height: 1px;
            border-bottom: 1px dashed #ddd;
            margin: 40px 0;
        }

        i,
        span {
            display: inline-block;
        }

        {{-- /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */ --}} .wrapper {
            display: flex;
            align-items: stretch;
        }

        #button1 {
            height: 35px;
            width: 200px;
            margin: -5px -25px;
            position: relative;
            top: 30%;
            left: 50%;
        }

        #sidebar {
            flex-wrap: wrap;
            min-width: 15%;
            max-width: 15%;
            background: #90c8ac;
            color: #fff;
            transition: all 0.3s;
        }

        #sidebar.active {
            min-width: 80px;
            max-width: 80px;
            text-align: center;
        }

        #sidebar.active .sidebar-header h3,
        #sidebar.active .CTAs {
            display: none;
        }

        #sidebar.active .sidebar-header strong {
            display: block;
        }

        #sidebar ul li a {
            text-align: left;
        }

        #sidebar.active ul li a {
            padding: 20px 10px;
            text-align: center;
            font-size: 0.85em;
        }

        #sidebar.active ul li a i {
            margin-right: 0;
            display: block;
            font-size: 1.8em;
            margin-bottom: 5px;
        }

        #sidebar.active ul ul a {
            padding: 10px !important;
        }

        #sidebar.active .dropdown-toggle::after {
            top: auto;
            bottom: 10px;
            right: 50%;
            -webkit-transform: translateX(50%);
            -ms-transform: translateX(50%);
            transform: translateX(50%);
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: rgb(65, 145, 126);
        }

        #sidebar .sidebar-header strong {
            display: none;
            font-size: 1.8em;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul li a {
            padding: 10px;
            font-size: 1.0em;
            display: block;
        }

        #sidebar ul li a:hover {
            color: #0a0509;
            background: #fff;
        }

        #sidebar ul li a i {
            margin-right: 10px;
        }

        #sidebar ul li.active>a,
        a[aria-expanded="true"] {
            color: #fff;
            background: #90c8ac;
        }

        a[data-toggle="collapse"] {
            position: relative;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
        }

        ul ul a {
            font-size: 0.9em !important;
            padding-left: 30px !important;
            background: #5fc481;
        }

        ul.CTAs {
            padding: 20px;
        }

        ul.CTAs a {
            text-align: center;
            font-size: 0.9em !important;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        {{-- /* ---------------------------------------------------
            CONTENT STYLE
        ----------------------------------------------------- */ --}} .wrapper {
            width: 100%;
            /* max-width: 1000px;*/
            min-height: 100vh;
            transition: all 0.3s;
        }

        #content {
            /* PARA QUE NO SALGA LA OTRA BARRA */
            overflow: hidden;
            width: 100%;
            padding: 2%;
            min-height: 40vh;
            transition: all 0.3s;
        }

        .ContenidoBarra2 {
            display: none;
        }

        .ContenidoBarra {
            width: 100%;

            height: 5%;
            padding: 5px;
            min-height: 5vh;
            transition: all 0.3s;
        }

        #barras {
            width: 95%;
            height: 45px;
            padding: 5px;
            margin-left: 50px;
            min-height: 5vh;
            transition: all 0.3s;
        }

            /*Boton al hacer las dos pantallas*/
            .navbar-default .navbar-toggle {
            border-color: black;
            color: #fff !important;
        }

        {{-- /* ---------------------------------------------------
            MEDIAQUERIES
        ----------------------------------------------------- */ --}} @media (max-width: 868px) {
            #sidebar {
                min-width: 80px;
                max-width: 80px;
                text-align: center;
            }

            .dropdown-toggle::after {
                top: auto;
                bottom: 10px;
                right: 50%;
                -webkit-transform: translateX(50%);
                -ms-transform: translateX(50%);
                transform: translateX(50%);
            }

            #sidebar.active {
                margin-left: 0 !important;
            }

            #sidebar .sidebar-header h3,
            #sidebar .CTAs {
                display: none;
            }

            #sidebar .sidebar-header strong {
                display: block;
            }

            #sidebar ul li a {
                padding: 20px 10px;
            }

            #sidebar ul li a span {
                font-size: 0.85em;
            }

            #sidebar ul li a i {
                margin-right: 0;
                display: block;
            }

            #sidebar ul ul a {
                padding: 10px !important;
            }

            #sidebar ul li a i {
                font-size: 1.3em;
            }

            #sidebar {
                margin-left: 0;
            }

            #sidebarCollapse span {
                display: none;
            }

            /* ///////////////////////////////// */
            /* .ContenidoBarra2{
    display: block;
    width: 70%
    }
    .ContenidoBarra{
    display: none;
    } */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar">
            <div class="sidebar-header" id="nombre">
                <h3>AGRO System</h3>
                <strong>AS</strong>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href='/principal' aria-expanded="true">
                        <i class="glyphicon glyphicon-home"></i>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="/cargos" aria-expanded="true">
                        <i class="glyphicon glyphicon-briefcase"></i>
                        Cargos
                    </a>
                </li>

                <li>
                    <a href="/personals" aria-expanded="true">
                        <i class="glyphicon glyphicon-user"></i>
                        Personal
                    </a>
                </li>

                <li>
                    <a href="/proveedors" aria-expanded="true">
                        <i class="glyphicon glyphicon-log-in"></i>
                        Proveedores
                    </a>
                </li>
                <li>
                    <a href="/clientes" aria-expanded="true">
                        <i class="glyphicon glyphicon-user"></i>
                        Clientes
                    </a>
                </li>
                <li>
                    <a href="/categorias" aria-expanded="true">
                        <i class="glyphicon glyphicon-tags"></i>
                        Categor??as
                    </a>
                </li>
                <li>
                    <a href="/productos" aria-expanded="true">
                        <i class="glyphicon glyphicon-qrcode"></i>
                        Productos
                    </a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        Compras
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="/compras">Lista de compras</a>
                        </li>
                        <li>
                            <a href="/pedidosProveedor">Lista de pedidos</a>
                        </li>
                        <li>
                            <a href="/compra">Facturas por vencer</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="glyphicon glyphicon-piggy-bank"></i>
                        Ventas
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu1">
                        <li>
                            <a href="/ventas">Lista de ventas</a>
                        </li>
                        <li>
                            <a href="/pedidosClientes">Lista de pedidos</a>
                        </li>
                        <li>
                            <a href="/pedidosProductoNuevoClientes">Lista de pedidos nuevos</a>
                        </li>
                        <li>
                            <a href="/devolucioncliente">Lista de devoluciones</a>
                        </li>
                        <li>
                            <a href="/cotizaciones/crear">Cotizaciones</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="glyphicon glyphicon-list-alt"></i>
                        Inventario
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu2">
                        <li>
                            <a href="/inventario"> Lista de inventario </a>
                        </li>
                        <li>
                            <a href="/Inventarios"> Productos por agotar</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="/Servicio" aria-expanded="true">
                        <i class="glyphicon glyphicon-tasks"></i>
                        Servicio T??cnico
                    </a>
                </li>

                <li>
                    <a href="/gasto" aria-expanded="true">
                        <i class="glyphicon glyphicon-usd"></i>
                        Gastos
                    </a>
                </li>
                <li>
                    <a href="/catalogo" aria-expanded="true">
                        <i class="glyphicon glyphicon-book"></i>
                        Cat??logos
                    </a>
                </li>
                <li>
                    <a href="/usuarios" aria-expanded="true">
                        <i class="glyphicon glyphicon-user"></i>
                        Usuarios
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">
            <div class="">
                <button type="button" id="sidebarCollapse" class="btn"
                    style="background-color:rgb(65, 145, 126); border-color:black; color:white">
                    <i class="glyphicon glyphicon-align-left"></i>
                    <span></span>
                </button>
            </div>
            <nav class="navbar" id="barras">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            {{-- <li><a href="#">Page</a></li> --}}
                            <li>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#Informacion">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Informaci??n
                                </a>
                            </li>
                            <li>
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600">{{ Auth::user()->name }}</span>
                                    <img class="img-profile rounded-circle" src="" alt="">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#Contrasena">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cambiar contrase??a
                                    </a>
                                    <br>
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Cerrar sesi??n
                                    </a>
                                </div>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </nav>

            <section class="ContenidoBarra">
                @yield('barra')
                @if (session('errorcontra'))
                    <div class="alert alert-danger">
                        {{ session('errorcontra') }}
                    </div>
                @endif
                @yield('contenido')

            </section>

            <section class="ContenidoBarra2">
                @yield('barra2')

                @yield('contenido2')

            </section>

            {{-- Modal de Informacion --}}
            <div class="modal fade" id="Informacion" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="POST">
                            @csrf
                            <div class="modal-header">
                                <br>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <center>
                                    <h5 class="modal-title" id="exampleModalLabel"> <em> <strong> Agropecuaria El
                                                Arriero del Valle
                                                <br>San Diego, Jamastr??n, El Para??so
                                            </strong> </em> </h5>
                                </center>
                            </div>

                            <div class="modal-body">
                                <div class="row" style="width: 100%">
                                    <div>
                                        <div class="text-center">
                                            <h5>
                                                La agropecuaria El Arriero del Valle es una empresa que se dedica a la<br>
                                                venta de productos agr??colas, silv??colas, pecuarias, frutales,hort??colas, <br>
                                                forestales y otros productos alimenticios para satisfacer las necesidades <br>
                                                de la poblaci??n de San Diego y sus alrededores. <br> <br>

                                                El sistema AgroSystem versi??n 1, fue creado con fines educativos durante el <br>
                                                curso de las clases: An??lisis y Dise??o de Sistemas y Programaci??n e <br>
                                                Implementaci??n de Sistemas, a finales del a??o 2021 e inicios del a??o 2022, <br>
                                                bajo supervisi??n de la magister Gladys Melissa Nolasco. <br><br>

                                                Este sistema fue elaborado por las estudiantes de UNAH-TEC DANL??: <br>
                                                Belsy Danitza Mairena Garmendia <br>
                                                Estefani Celeste Herrera Valladares <br>
                                                Karla Abigail Sierra Paztrana<br>
                                                Maryury Virsai Chac??n L??pez<br>
                                                Marilyn Jorleny Molina Rodr??guez
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Modal de cambiar contrse??a --}}
            <div class="modal fade" id="Contrasena" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- PARA LOS ERRORES -->

                        <form id="form_guardar" name="form_guardar" method="POST"
                            action="{{ route('usuarios.update_contrasena2', ['user' => Auth::user()->id]) }}"
                            onsubmit="fConfirmar()">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Datos de seguridad para cambio de
                                    contrase??a</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">

                                <label for="contrasenaAnterior">Ingrese su contrase??a actual</label>
                                <input id="contrasenaAnterior" type="password"
                                    class="form-control @error('contrasenaAnterior') is-invalid @enderror"
                                    name="contrasenaAnterior" value="{{ old('contrasenaAnterior') }}"
                                    autocomplete="contrasenaAnterior" style="text-transform: capitalize"
                                    maxlength="20" minlength="8" required>
                                <br>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="password"> Nueva contrase??a </label>
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder=""
                                            autocomplete="new-password" required maxlength="20" minlength="8">
                                    </div>

                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="password-confirm"> Confirmaci??n de contrase??a </label>
                                        <input id="password-confirm" name="password_confirmation" type="password"
                                            class="form-control" placeholder="" required autocomplete="new-password" maxlength="20" minlength="8">
                                    </div>
                                </div>

                                <br>
                                <input type="submit" class="btn btn-primary" value="Actualizar">
                                <input type="button" class="btn btn-danger" value="Limpiar" onclick="fRestaurar()">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>

                        </form>

                        @push('alertas')
                            <script>
                                function fRestaurar() {
                                    $("#contrasenaAnterior").val('');
                                    $("#password").val('');
                                    $("#password-confirm").val('');
                                }

                                function fConfirmar() {
                                    var formul = document.getElementById("form_guardar");
                                    Swal.fire({
                                        title: '??Est?? seguro que desea cambiar la contrase??a?',
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
                        @endpush
                    </div>
                </div>
            </div>



        </div>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: white; color: black">
                    <h5 class="modal-title" id="exampleModalLabel"><br><strong>Cerrar sesi??n</strong></h5>
                </div>
                <div class="modal-body">??Est?? seguro que desea cerrar la sesi??n? <br>
                    Presione si para salir o presione no para cancelar
                </div>
                <div class="modal-footer">
                    <div class="row" style="width: 78%">
                        <div class="col-sm-6">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button id="button1" class="btn btn-primary  btn-block" type="submit">
                                    {{ __('Si') }}
                                </button>
                        </div>
                        <div class="col-sm-6">
                            <button id="button1" class="btn btn-danger btn-block" type="button"
                                data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <!-- Bootstrap Js CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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

</body>

</html>
