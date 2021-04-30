<?php

  require_once 'Funciones.php';

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>"ShareBooks"</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="Css/MiCuenta.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="CSS/EstPrincipal.css">
  <link rel="stylesheet" href="Css/bootstrap.min.css">
</head><!-- Aqui finaliza la barra de busqueda y otras opciones dentro header -->

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
   <div class="container centradormiddle mx-auto">

     <section class="main row centradormiddle mx-auto">

       <aside class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto">
         <br>
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="izquierda centradormiddle">
              <div class="form-group">
                <label for="pass">Inserte su contraseña:</label>
                <input type="password" name="pass" class="form-control" id="izquierda">
              </div>
              <div class="form-group">
                <label for="pregN">Seleccione su nueva pregunta de seguridad</label>
                <select name="option" name="preg" class="form-control">
                 <option value="1" selected>¿Nombre de tu primera mascota?</option>
                 <option value="2" >¿Cual es el codigo postal de tus padres?</option>
                 <option value="3" >¿Nombre de tu primer novio o novia?</option>
               </select>
              </div>
              <div class="form-group">
                <label for="resp">Introduzca su nueva respuesta:</label>
                <input type="password" name="resp" class="form-control" id="izquierda">
              </div>
              <div class="form-group">
                <label for="resp2">Verifique su respuesta:</label>
                <input type="password" name="resp2" class="form-control" id="izquierda">
              </div>
            </div>

            <div class="botones">
                <button type="submit" class="btn btn-outline-warning">Continuar</button>
                <a href="MiCuenta.php" class="btn btn-outline-warning">Cancelar</a>
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
