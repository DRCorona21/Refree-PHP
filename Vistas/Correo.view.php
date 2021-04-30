<?php

if(isset($_SESSION['usuario'])) {
        header('Location: PagPrin.php');
    }
    else{
    }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="Css/Correo.css"><!-- Este link va a jalar hasta que se haga el Registrar.php -->
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/bootstrap.min.css">
  </head>
  <body>
    <header><!-- Aqui va la barra de busqueda y otras opciones dentro del header -->
      <nav class="navbar navbar-expand-lg navbar-light oscuro">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#" style="color:white;"><h2>¡Bienvenido nuevamente a Sharebooks!</h2><span class="sr-only">(current)</span></a>
              </li>
          </ul>
      </nav>
    </header><!-- Aqui finaliza la barra de busqueda y otras opciones dentro header -->

   <div class="container centradormiddle">

     <section class="main row">

       <aside class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
         <br>

          <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="izquierda">

              <div class="form-group">
                <label for="email">Correo:</label>
                <input type="email" name="email" class="form-control" id="izquierda">
              </div>

              <?php if(!empty($errores)): ?>

                <?php echo $errores; ?>

              <?php endif; ?>

              <br>

            <div class="botones">
                <button type="submit" class="btn btn-outline-warning">Continuar</button>
                <a href="index.php" class="btn btn-outline-warning">Regresar</a>
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
