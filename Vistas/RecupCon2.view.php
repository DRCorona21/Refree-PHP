<?php

  require_once 'Funciones.php';
  $email = $_SESSION['usuario'];

  $conexion = conexion();
  $statement = $conexion->prepare('SELECT PreguntaS FROM usuario WHERE email = :email');
  $statement->execute(array(':email'=>$email));
  $pregS = $statement->fetch();

  if($pregS[0] == 1){
    $pregS = "¿Nombre de tu primera mascota?";
  }
  elseif ($pregS[0] == 2){
    $pregS = "¿Cual es el codigo postal de tus padres?";
  }
  elseif ($pregS[0] == 3){
    $pregS = "¿Nombre de tu primer novio o novia?";
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Css/RecupContra.css"><!-- Este link va a jalar hasta que se haga el Registrar.php -->
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
              <a class="nav-link" href="MiLibro.php">Mi libro</a>
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
   <div class="container centradormiddle">

     <section class="main row">

       <aside class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
         <br>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="izquierda centradormiddle">

              <div class="form-group">
                <label for="pregS" id="izquierda">Pregunta de seguridad:</label>

                <input type="text" value="<?php echo $pregS; ?>" readonly="readonly"  class="form-control" name id="izquierda">
              </div>
              <div class="form-group">
                <label for="resp" id="izquierda">Respuesta:</label>
                <input type="password" name="resp" class="form-control" id="izquierda">
              </div>
              <div class="form-group">
                <label for="pass" id="izquierda">Introduzca su nueva contraseña:</label>
                <input type="password" name="pass" class="form-control" id="izquierda">
              </div>
              <div class="form-group">
                <label for="pass2" id="izquierda">Verifique su contraseña:</label>
                <input type="password" name="pass2" class="form-control" id="izquierda">
              </div>
            </div>

            <div class="botones">
                <button type="submit" class="btn btn-outline-warning">Continuar</button>
                <a href="Correo.php" class="btn btn-outline-warning">Regresar</a>
            </div>

          </form>
          <br>
       </aside>

     </section>
     <br>

   </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>
