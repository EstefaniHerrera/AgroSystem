<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Pantalla Principal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>

  /* Titulo principal */
  h1 {
    font: Helvetica;
    margin: 10px 0 30px 0;
    letter-spacing: 10px;
    font-size: 28px;
    color: #111;
  }

  /* Letra de los accesos */
  h2 {
    font: sans-serif;
    text-align: center;
    letter-spacing: 2.2px;
    font-size: 17px;
    color: #111;
  }

  /* fondo de los accesos */
  .bg-grey {
    background-color: #f6f6f6;
    margin: auto;
  }

  /* contenedor del titulo */
  .container {
    padding: 50px 10px;
  }

  /* Seccion de los iconos */
  .person {
    border: 10px solid transparent;
    margin-bottom: 25px;
    width: 95%;
    height: 75%;
    opacity: 0.7;
  }

  button{
    height:35px; 
    width:50px; 
    margin: -5px -5px; 
    position:relative;
    top:30%; 
    left:40%;
  }

  .person:hover {
    border-color: #a1b8ac;
  }

  /* Seccion del carrusel */
  .imgnormalizada img {
    width: 120%;
    height: 120px;
    max-height: 440px;
  }

  .bg-1 {
    background: #2d2d30;
    color: #bdbdbd;
  }

  /* Seccion de la barra */
  .navbar {
    margin-bottom: 0;
    background-color: rgb(71, 146, 128);
    z-index: 9999;
    border: 0;
    font-size: 14px !important;
    line-height: 4 !important;
    letter-spacing: 2px;
    border-radius: 0;
    font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
    color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
    color: rgb(105, 173, 157) !important;

  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
    color: #fff !important;
  }

  .dropdown-menu li a {
    color: #000 !important;
  }

  footer {
    background-color:rgb(65, 145, 126);
    /* color: #f5f5f5; */
    padding: 20px;
  }
  /* footer a {
    color: #f5f5f5;
  }
  footer a:hover {
    color: #777;
    text-decoration: none;
  }
  .form-control {
    border-radius: 0;
  }
  textarea {
    resize: none;
  } */
  </style>
</head>

<body id="Pantalla" data-spy="scroll" data-target=".navbar" data-offset="50">

  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#myCarousel">Inicio </a></li>
          <li><a href="#Accesos">Accesos</a></li>
          <li class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600" >{{ Auth::user()->name }}</span>
            {{-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE --}}
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" >
                Cerrar sesión
              </a>
            </li> 
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container" id="myCarousel">
    <div class="row">
      <div class="col-sm-8">
        <br><br><br>
        <div  class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
          </ol>
  
          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item imgnormalizada active">
              <img src="Imagenes/saco4.jpg">
              <div class="carousel-caption">
              </div>      
            </div>

            <div class="item imgnormalizada">
              <img src="Imagenes/saco2.jpg" width="100" height="100" >
              <div class="carousel-caption">
              </div>      
            </div>

            <div class="item imgnormalizada">
              <img src="Imagenes/saco3.jpg" width="100" height="100" >
              <div class="carousel-caption">
              </div>      
            </div>

            <div class="item imgnormalizada">
              <img src="Imagenes/saco1.jpg" width="100" height="100" >
              <div class="carousel-caption">
              </div>      
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
      </div>
      <div class="col-sm-4">
        <br><br><br><br>
          <h1 class="text-center">Agropecuaria "El Arriero del Valle"</h1>
          <center><img src="Imagenes/logo.jpeg" alt="" width="160" height="180"></center>
          <h3 class="text-center">Bienvenidos al sistema "AgroSystem"</h3>
      </div> 
  </div>

</div>

<div id="Accesos" class="row bg-grey">
    <div class="col-sm-2">
      <h2 class=""><strong>Usuarios</strong></h2>
        <a href="/usuarios" >
          <img src="Imagenes/usuario.jpeg" class="img-circle person">
        </a>
    </div>

    <div class="col-sm-2">
      <h2 class=""><strong>Personal</strong></h2>
          <a href="/personals">
            <img src="Imagenes/personal.jpeg" class="img-circle person">
          </a>
    </div>
    <div class="col-sm-2">
      <h2 class=""><strong>Proveedores</strong></h2>
        <a href="/proveedors" >
          <img src="Imagenes/proveedores.jpeg" class="img-circle person">
        </a>
  </div>

  <div class="col-sm-2">
      <h2 class=""><strong>Clientes</strong></h2>
        <a href="/clientes" >
          <img src="Imagenes/clientes.jpeg" class="img-circle person">
        </a>
  </div>




  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">

          <div class="modal-header" style="background: white; color: black">
              <h5 class="modal-title" id="exampleModalLabel" ><br><strong>Cerrar sesión</strong></h5>
          </div>
          <div class="modal-body">¿Está seguro que desea cerrar la sesión? <br>
            Presione si para salir o presione no para cancelar</div>
          <div class="modal-footer">
            <div class="row" style="width: 78%">
              <div class="col-sm-6">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="btn btn-primary  btn-block" type="submit">
                      {{ __('Si') }}
                  </button>
              </div>
              <div class="col-sm-6">
                <button id="Boton1" class="btn btn-danger btn-block" type="button" data-dismiss="modal">No</button>
              </div>
            </div>
      </div>
  </div>
</div>
</div>
 

<!-- Footer -->
<footer class="text-center">
  {{-- <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="ARRIBA">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
  <p><a  data-toggle="tooltip"> Agropecuaria Arriero del Valle </a></p> --}}
</footer>

<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip();

  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>
</body>
</html>
