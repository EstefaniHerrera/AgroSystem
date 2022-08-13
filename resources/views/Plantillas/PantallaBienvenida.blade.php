<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Theme Made By www.w3schools.com -->
    <title>Pantalla de Bienvenida</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
          font: 40 15px italic;
          line-height: 1.8;
          color: rgb(31, 28, 28);
        }
        h1, h2 {
          font-size: 30px;
          font: 400 30px italic;
          text-transform: uppercase;
          color:#f5f2f2;
          font-weight: 600;
          margin-bottom: 30px;
        }
        h3, h4 {
          font-size: 14px;
          line-height: 1.375em;
          color: rgb(11, 11, 11);
          font-weight: 400;
          margin-bottom: 30px;
        }  
        h5{
          font-size: 28px;
          color:#faf6f6;
          font: 400 28px italic;
          text-transform: uppercase;
        }
        .jumbotron {
          background-color:rgb(105, 173, 157); 
          border-color:black; 
          color:white"
          padding: 100px 25px;
          font-family: Montserrat, sans-serif;
        }
        .container-fluid {
          padding: 60px 50px;
        }
        .bg-grey {
          background-color: #f6f6f6;
        }
        .logo-small {
          color:rgb(105, 173, 157);
          font-size: 40px;
        }
        .logo {
          color:rgb(105, 173, 157);
          font-size: 200px;
        }
        .thumbnail {
          padding: 0 0 15px 0;
          border: none;
          border-radius: 0;
        }
        .thumbnail img {
          width: 100%;
          height: 100%;
          margin-bottom: 10px;
        }
        .carousel-control.right, .carousel-control.left {
          background-image: none;
          color:rgb(105, 173, 157);
        }
        .carousel-indicators li {
          border-color:rgb(105, 173, 157);
        }
        .carousel-indicators li.active {
          background-color:rgb(105, 173, 157);
        }
        .item h4 {
          font-size: 19px;
          line-height: 1.375em;
          font-weight: 400;
          font-style: italic;
          margin: 70px 0;
        }
        .item span {
          font-style: normal;
        }
        .panel {
          border: 1px solid rgb(105, 173, 157);
          border-radius:0 !important;
          transition: box-shadow 0.5s;
        }
        .panel:hover {
          box-shadow: 5px 0px 40px rgba(0,0,0, .2);
        }
        .panel-footer .btn:hover {
          border: 1px solid rgb(105, 173, 157);
          background-color: #fff !important;
          color:rgb(105, 173, 157);;
        }
        .panel-heading {
          color: #fff !important;
          background-color: rgb(105, 173, 157) !important;
          padding: 25px;
          border-bottom: 1px solid transparent;
          border-top-left-radius: 0px;
          border-top-right-radius: 0px;
          border-bottom-left-radius: 0px;
          border-bottom-right-radius: 0px;
        }
        .panel-footer {
          background-color: white !important;
        }
        .panel-footer h3 {
          font-size: 32px;
        }
        .panel-footer h4 {
          color: #aaa;
          font-size: 14px;
        }
        .panel-footer .btn {
          margin: 15px 0;
          background-color: rgb(105, 173, 157);
          color: #fff;
        }
        .navbar {
          margin-bottom: 0;
          background-color: rgb(255, 255, 255);
          z-index: 9999;
          border: 0;
          font-size: 14px !important;
          line-height: 4 !important;
          letter-spacing: 2px;
          border-radius: 0;
          font-family: Montserrat, sans-serif;
        }
        .navbar li a, .navbar .navbar-brand {
          color: rgb(105, 173, 157) !important;
        }
        .navbar-nav li a:hover, .navbar-nav li.active a {
          color: rgb(255, 255, 255) !important;
          background-color: rgb(105, 173, 157) !important;
        }
        .navbar-default .navbar-toggle {
          border-color: transparent;
          color: #fff !important;
        }
        footer .glyphicon {
          font-size: 20px;
          margin-bottom: 20px;
          color: rgb(105, 173, 157);
        }
        .slideanim {visibility:hidden;}
        .slide {
          animation-name: slide;
          -webkit-animation-name: slide;
          animation-duration: 1s;
          -webkit-animation-duration: 1s;
          visibility: visible;
        }
        @keyframes slide {
          0% {
            opacity: 0;
            transform: translateY(70%);
          } 
          100% {
            opacity: 1;
            transform: translateY(0%);
          }
        }
        @-webkit-keyframes slide {
          0% {
            opacity: 0;
            -webkit-transform: translateY(70%);
          } 
          100% {
            opacity: 1;
            -webkit-transform: translateY(0%);
          }
        }
        @media screen and (max-width: 768px) {
          .col-sm-4 {
            text-align: center;
            margin: 25px 0;
          }
          .btn-lg {
            width: 100%;
            margin-bottom: 35px;
          }
        }
        @media screen and (max-width: 480px) {
          .logo {
            font-size: 150px;
          }
        }
        </style>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#agreagar_detalleI">INFORMACIÓN</a></li>
                <li>
                    @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/principal') }}">INICIO</a>
                            @else
                                <a href="{{ route('login') }}">INICIAR SESIÓN</a>
                            @endauth
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
<br> 
<div class="jumbotron text-center">
    <div class="modal-body">
        <div class="row" style="width: 100%">
            <div>
                <div class="form-group">
                    <h5 class="text-center"><em> <strong> Agropecuaria El Arriero del Valle
                                <br> San Diego, Jamastrán, El Paraíso </strong> </em><br><br>
                        <div href="#" class="text-center">
                            <img src="/Imagenes/logo1.jpeg" class="img-circle person" alt="Random Name" width="255"
                                 height="255">
                        </div>

                    </h5>


                </div>
            </div>
        </div>
    </div>

    <div id="portfolio" class="container-fluid text-center bg-grey">

        <div class="row text-center slideanim">
            <div class="col-sm-4">
                <div class="thumbnail">
                    <img src="Imagenes/img1.jpeg" alt="Arriero" width="400" height="300">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail">
                    <img src="Imagenes/agro2.jpeg" alt="Arriero" width="400" height="300">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail">
                    <img src="Imagenes/img2.jpeg" alt="Arriero" width="400" height="300">
                </div>
            </div>
        </div>
        <br>

        <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <h4>"Nos encontramos ubicados en San Diego, Jamastrán, El Paraíso"</h4>
                </div>
                <div class="item">
                    <h4>"Ofreciendo productos de calidad desde el año 2014"</h4>
                </div>
                <div class="item">
                    <h4>"Contamos con servicios técnico y todos los productos necesarios para nuestros clientes"</h4>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>

        {{-- Modal de Informacion  --}}
        <div class="modal fade" id="agreagar_detalleI" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST">
                        @csrf
                        <div class="modal-header">
                            <br>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title" id="exampleModalLabel"> <em> <strong> Agropecuaria El Arriero del Valle
                                <br>San Diego, Jamastrán, El Paraíso
                            </strong> </em> </h3>
                        </div>

                        <div class="modal-body">
                            <div class="row" style="width: 100%">
                                <div>
                                    <div class="text-center">
                                       {{--  <h3 class="text-center"><em> <strong> Agropecuaria El Arriero del Valle
                                                    <br>San Diego, Jamastrán, El Paraíso<br>
                                                </strong> </em> --}}
                                          {{--   <div href="#" class="text-center">
                                                <img src="/Imagenes/logo1.jpeg" class="img-circle person" alt="Random Name"
                                                     width="255" height="255">
                                            </div> --}}
                                        <h3>
                                            La agropecuaria El Arriero del Valle es una empresa que se dedica a la <br>
                                            venta de productos agrícolas, silvícolas, pecuarias, frutales, hortícolas, <br>
                                            forestales y otros productos alimenticios para satisfacer las necesidades <br>
                                            de la población de San Diego y sus alrededores. <br> <br>    

                                            {{--  Garantizamos el crecimiento sostenible de las producciones con alto valor <br>
                                            agregado, reduciendo los costos de producción para un desarrollo <br>
                                            económico, seguridad alimentaria y el mejoramiento del medio ambiente. <br>
                                             --}}
                                            El sistema AgroSystem versión 1, fue creado con fines educativos durante el <br>
                                            curso de las clases: Análisis y Diseño de Sistemas y Programación e <br>
                                            Implementación de Sistemas, a finales del año 2021 e inicios del año 2022, <br>
                                            bajo supervisión de la magister Gladys Melissa Nolasco. <br><br>

                                            Este sistema fue elaborado por las estudiantes de UNAH-TEC DANLÍ: <br>
                                            Belsy Danitza Mairena Garmendia <br>
                                            Estefani Celeste Herrera Valladares <br>
                                            Karla Abigail Sierra Paztrana<br>
                                            Maryury Virsai Chacón López<br>
                                            Marilyn Jorleny Molina Rodríguez
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
 </div>

</body>

</html>
