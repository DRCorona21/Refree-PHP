<?php

    if(isset($_SESSION['usuario'])) {
      require_once 'Funciones.php';
    }
    else{
        header('Location: ../IniciarSesion.php');
    }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="CSS/MiCuenta.css">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark oscuro">
        <a class="navbar-brand" href="PagPrin.php">ShareBooks</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">

            <li class="nav-item">
              <a class="nav-link" href="MiCuenta.php">Mi cuenta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cerrarS.php">Cerrar sesion</a>
            </li>

          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Buscar</button>
          </form>
        </div>
      </nav>
  </header>
    <br><br><br>

   <div class="container centradormiddle">

     <section class="main row">

       <aside class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

         <div class="Datos">

           <p><h2>Mi Libro</h2></p>

         </div>

            <div class="izquierda">


              <div class="form-group">



              </div>

            </div>

            <div class="derechadiv">
                   <?php

                    $conexion1 = conexion();

                    $statement = $conexion1->prepare('SELECT titulo FROM libro where email=:email');
                    $statement->execute(array(':email'=>$_SESSION['usuario']));
                    $resultado = $statement->fetchAll(PDO::FETCH_COLUMN,0);

                    if (count($resultado)!=0) {
                      echo '<form action="borrar.php" method="POST" >';
                    }

                    if (is_array( $resultado )) {
                      for ($i = 0; $i < count($resultado) ; $i++) {
                        ?>
                        <label style="color:#ffc107;">
                          <input type="radio" name="archivoE" value="<?php echo $resultado[$i];?>">
                        </label>
                         <img src="Img/pdff.png" width="35px" height="35px"> <a class="nav-link" style='text-decoration:none; color:White;' href="/Shaboo/leer.php?titulo=<?php echo $resultado[$i]; ?>" id="<?php
                        echo $resultado[$i];
                        ?>"> <?php echo $resultado[$i]; ?>
                        </a>
                        <?php
                        echo "<br>";
                      }
                    } else {

                    }

                    if (count($resultado)!=0) {
                      echo '<input type="submit" class="btn btn-outline-warning" value="Borrar"></form>';
                    }

                  ?>
            </div>

            <br><br>

          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
            <div class="container">
              <input type="file" name="archivito" style="display:none" id="file-2" class="inputfile inputfile-2">
              <label for="file-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
                <span class="iborrainputfile">Seleccionar archivo</span>
              </label>
              <label class="btn btn-outline-warning">
                Añadir PDF <input type="submit" style="display:none;">
              </label>
            </div>
          </form>
          <?php if(!empty($errores)): ?>
            <ul>
              <?php echo $errores; ?>
            </ul>
          <?php endif; ?>

       </aside>

     </section>

   </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="js/jquery.custom-file-input.js"></script>
    <script src="js/jquery-v1.min.js"></script>
  </body>
</html>
