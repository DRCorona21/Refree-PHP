<?php

if(isset($_SESSION['usuario'])) {
    }
    else{
        header('Location: IniciarSesion.php');
    }

    if(isset($_SESSION['usuario'])) {

      $email = $_SESSION['usuario'];

      $conexion = conexion();
      $statement = $conexion->prepare('SELECT * FROM usuario WHERE email = :email');
      $statement->execute(array(':email' => $email));
      $resultado = $statement->fetch();
      $conexion2 = conexion();
      $statement2 = $conexion2->prepare('SELECT telefono.numero FROM telefono INNER JOIN usuario ON telefono.email = usuario.email WHERE usuario.email = :email');
      $statement2->execute(array(':email' => $email));
      $resultado2 = $statement2->fetchAll();

      $datetime1 = new DateTime(date('Y-m-d'));
      $datetime2 = new DateTime($resultado[6]);
      $edad = date_diff($datetime2, $datetime1);
      $n = 0;

    }
    else{
        header('Location: IniciarSesion.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>"ShareBooks"</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="CSS/Micuenta.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="CSS/EstPrincipal.css">
  <link rel="stylesheet" href="Css/bootstrap.min.css">
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

<div class="container-fluid">
  <div class="row content">
    <div class="col-12 col-md-12 col-lg-3 col-xl-3">
      <br>
      <!--Dentro de este div-->
      <div class="card" >

    <img class="card-img-top" src="Img/img_avatar1.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title mx-auto"><?php echo $resultado[1]; ?> <?php echo $resultado[2]; ?></h4>
      <p class="card-text">Dirección: <?php echo $resultado[10]; ?></p>
    </div>
    <ul class="list-group list-group-flush">
      <?php for ($i=0; $i < count($resultado2) ; $i++){
        echo '<li class="list-group-item">Telefono: ';
        echo $resultado2[$i][0];
        echo '</li>';
      }?><!-- Este php es para imprimir sus telefonos -->
      <li class="list-group-item">Edad: <?php print $edad->format('%Y'); ?> años</li>
    </ul>

      <div class="card-footer text-right">
        <small class="text-muted text-right">
            Calificacion <cite title="Source Title">4.5 Marx</cite>
          </small>
      </div>

  </div>
    </div>

    <div class="col-12 col-md-12 col-lg-8 borde centradormiddle" style="word-break: break-all;">

          <aside class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

            <div class="Datos">

              <p><h2>Datos Personales</h2></p>

            </div>

            <br>
             <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
               <div class="izquierda">

                 <div class="form-group">
                   <label for="nombre">Nombre:</label>
                   <input name="name" type="text" value="<?php echo $resultado[1]; ?>" class="form-control" id="izquierda">
                 </div>
                 <div class="form-group">
                   <label for="apellido">Apellido:</label>
                   <input name="app" type="text" value="<?php echo $resultado[2]; ?>" class="form-control" id="izquierda">
                 </div>

               </div>

               <div class="derechadiv">

                 <div class="form-group">
                   <label for="fechadn">Fecha de nacimiento:</label>
                   <input type="date" class="form-control" value="<?php echo $resultado[6]; ?>" name="nac" id="derecha">
                 </div>
                 <div class="form-group">
                  <label for="telefono">Telefono:</label>
                   <input name="tel" type="number" id="numero" class="form-control" value="<?php echo $resultado2[0][0]; ?>" class="form-control ">
                 </div>
               </div>

               <br><br>

               <button type="submit" class="btn btn-outline-warning">Guardar</button>

               <br><br>

             </form>

             <br>

               <a href="RecupCon2.php" class="btn btn-outline-warning">Cambiar contraseña</a>

               <a href="RecupPreg.php" class="btn btn-outline-warning">Cambiar pregunta de seguridad</a>

               <form action="desactivarC.php" method="Get">
                 <input type="submit" class="btn btn-outline-warning" value="Desactivar cuenta">
               </form>

             <br>

             <div class="Publicaciones">

               <p><h2>Publicaciones Personales</h2></p>

             </div>

             <br>

             <!-- Aqui empieza -->

             <?php

             $conexionC = conexion();
             $conexionN = conexion();
             $conexionA = conexion();
             $conexionCats = conexion();
             $statementC = $conexionC->prepare('SELECT * FROM publicacion where email=:email');
             $statementN = $conexionN->prepare('SELECT nombre FROM usuario where email=:email');
             $statementA = $conexionA->prepare('SELECT autor FROM autor where id_autor=:autor');
             $statementCats = $conexionC->prepare('SELECT categoria FROM categoria,catpubli where categoria.id_categoria=catpubli.id_categoria and id_publicacion=:id');
             $statementC->execute(array(':email'=>$_SESSION['usuario']));


             $resultado1 = $statementC->fetchAll();

             for ($i=0; $i < count($resultado1); $i++) { ?>

             <div class="container-fluid rounded publicacion mx-auto col-12 col-md-8 col-lg-6 col-xl-5">
               <h5><a href="/ShaBoo/Usuario?id=<?php echo $resultado1[$i][6];?>"><!--Persona que subió la pub:--> <?php

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
                 <a href="#demo<?php echo $resultado1[$i][0];?>" class="" data-toggle="collapse"><button class="btn btn-outline-dark">Mas info</button></a>
                 <button type="button" id="<?php echo $resultado1[$i][0]; ?>" class="btn btn-outline-dark" onclick="borrado(this.id)" name="Eliminar">Borrar Publicacion</button>
                </button>
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
                     ?></li>
                     <li><!--Descripcion :7--> <?php
                     echo $resultado1[$i][4];
                     ?></li>
                   </ul>
                   <br>
                 </div>
               </div>
             </div>
             <br>
             <?php
             }
             ?>

             <!-- Aqui termina -->

          </aside><br>


    </div>
  </div>
</div>
<script src="js/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script type="text/javascript">

  function cambio(numero) {

  document.getElementById('numero').value = numero;

  }

  function borrado(idPub){
    $.ajax({
      url:'borrarpubli.php?id='+idPub+'',
      method: 'GET'
    });
    location.reload(true);
  }

</script>
</body>
</html>
