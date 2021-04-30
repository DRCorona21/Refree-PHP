<?php

if(isset($_SESSION['usuario'])) {
        header('Location: Vistas/PaginaPrincipal.view.php');
    }
    else{
    }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="CSS/EstReg.css"><!-- Este link va a jalar hasta que se haga el Registrar.php -->
    <link rel="stylesheet" href="Css/bootstrap.min.css">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  </head>
  <body>
    <header><!-- Aqui va la barra de busqueda y otras opciones dentro del header -->
      <nav class="navbar navbar-expand-lg navbar-light oscuro">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#" style="color:white;"><h2>¡Bienvenido a Sharebooks!</h2><span class="sr-only">(current)</span></a>
              </li>
          </ul>
      </nav>
    </header><!-- Aqui finaliza la barra de busqueda y otras opciones dentro header -->

   <div class="container centradormiddle">

     <section class="main row">

       <article class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 centradortext centradormiddle">
         <div class="container centradormiddle" style="height: 100%">
           <p>
             <h1 class="centradortext">
               !Si te registras con Sharebooks podras contactarte con los diversos usuarios para
               intercambiar tus libros favoritos!
             </h1>
           </p>
         </div>
       </article>

       <aside class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
         <br>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
            <div class="izquierda">

              <div class="form-group">
                <label for="email">Correo:</label>
                <input type="email" name="email" class="form-control" id="izquierda">
              </div>
              <div class="form-group">
                <label for="nom">Nombre:</label>
                <input type="text" name="nom" class="form-control" id="izquierda">
              </div>
              <div class="form-group">
                <label for="ape">Apellido:</label>
                <input type="text" name="ape" class="form-control" id="izquierda">
              </div>
              <div class="form-group">
                <label for="pass">Contraseña:</label>
                <input type="password" name="pass" class="form-control" id="izquierda">
              </div>
              <div class="form-group">
                <label for="pass2">Confirma tu contraseña:</label>
                <input type="password" name="pass2" class="form-control" id="izquierda">
              </div>

            </div>

            <div class="derechadiv">

              <div class="form-group">
                <label for="tel">Telefono:</label>
                <input type="number" name="tel" class="form-control " id="derecha">
              </div>
              <div class="form-group">
                <label for="naci">Fecha de nacimiento:</label>
                <input type="date" name="naci" class="form-control " id="derecha">
              </div>
              <div class="form-group">
                <label for="pregS">Pregunta de seguridad:</label>
                <select name="option" name="preg" class="form-control">
                 <option value="1" selected>¿Nombre de tu primera mascota?</option>
                 <option value="2" >¿Cual es el codigo postal de tus padres?</option>
                 <option value="3" >¿Nombre de tu primer novio o novia?</option>
                </select>
              </div>
              <div class="form-group">
                <label for="resp">Respuesta:</label>
                <input type="password" name="resp" class="form-control " id="derecha">
              </div>
              <div class="form-group">
                <label for="resp2">Verifique su respuesta:</label>
                <input type="password" name="resp2" class="form-control " id="derecha">
              </div>

            </div>
              <div class="form-group form-check">
                <label for="dom" id="centradormiddle">Domicilio:</label>
                <input type="text" name="dom" class="form-control " id="customControlAutosizing">
              </div>
            <div class="bnt-group">
              <button type="submit" class="btn btn-outline-warning">Registrate</button>
              <a href="index.php" class="btn btn-outline-warning">Regresar</a>
            </div>
          </form>
          <br>
          <?php if(!empty($errores)): ?>
            <ul>
              <?php echo $errores; ?>
            </ul>
          <?php endif; ?>
          <br>
       </aside>

     </section>

   </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </body>
</html>
