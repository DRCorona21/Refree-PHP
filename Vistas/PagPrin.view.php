<?php session_start();

    if(isset($_SESSION['usuario'])) {

      $email = $_SESSION['usuario'];

      $conexion = conexion();
      $statement = $conexion->prepare('SELECT * FROM usuario WHERE email = :email');
      $statement->execute(array(':email' => $email));
      $resultado = $statement->fetch();


    }
    else{
        header('Location: IniSes.php');
    }



?>
<!doctype html>
<html lang="en">

    <head>

      <title>"ShareBooks"</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="CSS/EstPrincipal.css">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="Css/bootstrap.min.css">

    </head>

    <body>
      <header>
        <nav class="navbar navbar-expand-lg navbar-dark oscuro fixed-top">
          <a class="navbar-brand" href="PagPri.php">ShareBooks</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Mi cuenta
                </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                <a class="dropdown-item" href="MiCuenta.php">Ajustes</a>

                <a class="dropdown-item" href="MiLibro.php">Mi libro</a>
              <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="cerrarS.php">Cerrar sesion</a>
              </div>

              </li>

            </ul>
            <form class="form-inline my-2 my-lg-0" action="Buscar.php
            " method="POST">
              <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search" name="busqueda">
              <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Buscar publicacion</button>
            </form>

          </div>
        </nav>
        <br>
        <br>
        <br>
    </header>
      <section class="container-fluid">

        <div class="container-fluid borde3 rounded">
                  <div class="row">
                    <div class="col">
                      <h1><a href="HPublic.php" class="btn btn-secondary btn-lg btn-block"><h3>Crear una publicacion</h3></a>
                    </div>
                  </div>
                </div>

                  <?php if(alertaShida()): ?>

                  <?php
                  echo '';
                  /*Dentro del echo va html que genere la alerta*/
                  ?>

                  <?php endif; ?>

        <div class="container-fluid" style="margin-top:2%">
          <div class="row">
            <div class="col-12 col-md-2 col-lg-3 col-xl-4 d-none d-md-block borde"></div>
            <div class="col-12 col-md-8 col-lg-6 col-xl-4 borde1">
              <br>
                <div id="demo" class=" carousel slide carousel-fade container-fluid rounded publicacion mx-auto " data-ride="carousel">

                  <?php // para lo más buscado ;V
                  $conMB = conexion();
                  $stMB = $conMB->prepare('SELECT * FROM publicaciones');
                   ?>
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
            <!--  <b style="color: black"> y pues lo siguiente es la funcion //alertaShida(); </b>  Esta es la parte del mensaje diario ;v-->
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

              <div class="container-fluid rounded publicacion mx-auto col-12 col-md-12 col-lg-11 col-xl-11" style="word-break:break-all;">
                <h5><a href="Usuario.php?id=<?php echo $resultado1[$i][6];?>"><!--Persona que subió la pub:--> <?php

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
                  <br>
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
                <div>
                  <br>
                  <a href="#demo<?php echo $resultado1[$i][0];?>" class="" data-toggle="collapse"><button class="btn btn-outline-dark" id="<?php echo $resultado1[$i][0]; ?>" onclick="addview(this.id)">Mas info</button></a>
                  <br><br>
                  <div id="demo<?php echo $resultado1[$i][0];?>" class="collapse">
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
<br>
                <div class="col">
                  <h1><a href="HPublic.php" class="btn btn-secondary btn-lg btn-block"><h3>Cargar mas publicaciones</h3></a>
                </div>

<br>

                </div>
             <div class=" row col-12 col-md-2 col-lg-3 col-xl-4 d-none d-md-block borde2"></div>
              </div>
            </div>
            <div id="addview">

            </div>
<br>
      </section>
<br>
      <script src="js/bootstrap.bundle.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
      <script type="text/javascript">

          function addview(variable) {
            $.ajax({
              url: 'addview.php?id='+variable+'',
              method: 'GET'
            });
            return true;
          }

      </script>
    </body>
</html>
