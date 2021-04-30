<?php session_start();
  if(isset($_SESSION['usuario'])) {
    header('Location: PagPrin.php');
  }
require 'Funciones.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>"ShareBooks"</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="CSS/EstPrincipal.css">
    <link rel="stylesheet" href="Css/bootstrap.min.css">

  </head>
  <body>
    <header><!-- Aqui va la barra de busqueda y otras opciones dentro del header -->
      <nav class="navbar navbar-expand-lg navbar-dark oscuro fixed-top">
        <a class="navbar-brand" href="javascript:void(0)">ShareBooks</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="IniSes.php">Iniciar sesion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Registrar.php">Registrarse</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </header><!-- Aqui finaliza la barra de busqueda y otras opciones dentro header -->
    <section>
      <div class="container-fluid" style="margin-top:80px">
        <div class="row">
          <div class="col-12 col-md-2 col-lg-3 col-xl-4 d-none d-md-block borde"></div>
          <div class="col-12 col-md-8 col-lg-6 col-xl-4 borde1">
            <br>
              <div id="demo" class=" carousel slide carousel-fade container-fluid rounded publicacion mx-auto " data-ride="carousel">
      <h3>Lo mas Buscado</h3>
      <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ul>
      <div class="carousel-inner" >
        <div class="carousel-item active" >
          <img src="Img/resnic.jpg" class="img-responsive" alt="Resnick" height="400">
          <div class="carousel-caption">
            <h3>Resnick</h3>
            <p>Matemáticas y ciencias naturales</p>
          </div>
        </div>
        <div class="carousel-item" >
          <img src="Img/orange.jpg" class=" img-responsive" alt="Resnick" height="400">
          <div class="carousel-caption">
            <h3>La Naranja Mecanica</h3>
            <p>Ciencias sociales Literatura</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="Img/1984.jpg" class="  img-responsive" alt="Resnick" height="400">
          <div class="carousel-caption">
            <h3>1984</h3>
            <p>Ciencias sociales Literatura</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
      </div>

    <br>

    <?php

    $conexionC = conexion();
    $conexionN = conexion();
    $conexionA = conexion();
    $conexionCats = conexion();
    $statementC = $conexionC->prepare('SELECT * FROM publicacion ORDER BY fecha DESC LIMIT 5');
    $statementN = $conexionN->prepare('SELECT nombre FROM usuario where email=:email');
    $statementA = $conexionA->prepare('SELECT autor FROM autor where id_autor=:autor');
    $statementCats = $conexionC->prepare('SELECT categoria FROM categoria,catpubli where categoria.id_categoria=catpubli.id_categoria and id_publicacion=:id');
    $statementC->execute();


    $resultado1 = $statementC->fetchAll();

    for ($i=0; $i < count($resultado1); $i++) { ?>

    <div class="container-fluid rounded publicacion mx-auto col-12 col-md-12 col-lg-11 col-xl-11">
      <h5><a href="IniSes.php"><!--Persona que subió la pub:--> <?php

        $statementN->execute(array(':email'=>$resultado1[$i][6]));
        $resultadoN = $statementN->fetch();

        echo $resultadoN[0];

      ?></a></h5>

      <h2><!--Titulo:--> <?php
      echo $resultado1[$i][10];
      ?></h2>
      <div class="w3-display-container">
        <img src="<?php
        echo $resultado1[$i][3];
        ?>"  class=" img-fluid rounded img-responsive"><!--(foto de la pub)-->

        <div class="w3-display-topright w3-container"><h6><i><!--Fecha de la publicacion: --><?php
        echo $resultado1[$i][5];
        ?></i></h6></div>

        <div class="w3-display-bottomright w3-container"><!--Tipo de la publicacion: --> <?php
        if ($resultado1[$i][2]==0) {
          echo "Prestamo";
        }else{
          echo "Intercambio";
        }
        ?></div>
      </div>

      <br><br>
      <div>
        <a href="IniSes.php" class="" data-toggle="collapse"><button class="btn btn-outline-dark">Mas info</button></a>
        <br><br>
        <div id="" class="collapse">
          <ul>
            <li><h4>Autor: <?php
            $statementA->execute(array(':autor'=>$resultado1[$i][9]));
            $resultadoA = $statementA->fetch();
            echo $resultadoA[0];
            ?></h4></li>
            <li>Categorias: <?php

    $statementCats->execute(array(':id'=>$resultado1[$i][0]));
    $resultadoCats = $statementCats->fetchAll(PDO::FETCH_COLUMN,0);

    for ($j=0; $j < count($resultadoCats); $j++) {
      echo "-".$resultadoCats[$j]." ";
    }

            ?></li>
            <li>Edicion: <?php
            echo $resultado1[$i][8];
            ?></li>
            <li>Editorial: <?php
            echo $resultado1[$i][7];
            ?></</li>
            <li><!--Descripcion :7--> <?php
            echo $resultado1[$i][4];
            ?></</li>
          </ul>
          <br>
        </div>
      </div>
    </div>
    <br>
    <?php
    }
    ?>
              </div>
              <br>
           <div class="col-12 col-md-2 col-lg-3 col-xl-4 d-none d-md-block borde2"></div>
           <br>
            </div>
          </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>
