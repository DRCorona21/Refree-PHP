<?php session_start();

if(isset($_SESSION['usuario'])) {

    }
    else{
      header('Location: IniSes.php');
    }

    if(isset($_SESSION['usuario'])) {

      if ($_SERVER['REQUEST_METHOD']!='GET') {
        header('Location: PagPrin.php');
      }


      $email = $_GET['id'];

      if ($_GET['id']===$_SESSION['usuario']) {
        header('Location: MiCuenta.php');
      }

      $conexion = conexion();
      $statement = $conexion->prepare('SELECT * FROM usuario WHERE email = :email');
      $statement->execute(array(':email' => $email));
      $resultado = $statement->fetch();

      if ($_GET['id']!=$resultado[0]) {
        header('Location: PagPrin.php');
      }

      $conexion2 = conexion();
      $statement2 = $conexion2->prepare('SELECT telefono.numero FROM telefono INNER JOIN usuario ON telefono.email = usuario.email WHERE usuario.email = :email');
      $statement2->execute(array(':email' => $email));
      $resultado2 = $statement2->fetch();

      $datetime1 = new DateTime(date('Y-m-d'));
      $datetime2 = new DateTime($resultado[6]);
      $edad = date_diff($datetime2, $datetime1);

    }
    else{
        header('Location: IniSes.php');
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
        <form action="/Shaboo/Buscar.php" class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Buscar</button>
        </form>
      </div>
    </nav>
  </header>

<div class="container-fluid">
  <div class="row content">
    <div class="col-12 col-md-4 col-lg-3 col-xl-3 borde">
      <br>
      <!--Dentro de este div-->
      <div class="card" >

    <img class="card-img-top" src="Img/img_avatar1.png" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title mx-auto"><?php echo $resultado[1]; ?></h4>
      <p class="card-text">Dirección: <?php echo $resultado[10]; ?></p>
    </div>
    <ul class="list-group list-group-flush">
      <?php for ($i=0; $i < count($resultado2)-1 ; $i++){
        echo '<li class="list-group-item">Telefono: ';
        echo $resultado2[$i];
        echo '</li>';
      }?><!-- Este php es para imprimir sus telefonos -->
      <li class="list-group-item">Edad: <?php print $edad->format('%Y'); ?> años</li>
    </ul>
    <div class="card-body">
      <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Calificar</button>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ayudanos calificando a   <?php echo $resultado[1]; ?>  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
            <div class="modal-body">
              <form>
                <h5 class="modal-title" id="exampleModalLabel">Calificación:</h5>
                <br>

                <div class="form-group">
      <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
<div class="btn-group" role="group" aria-label="First group">
  <table border="1">
    <tr>
      <td>1</td>
      <td>2</td>
      <td>3</td>
      <td>4</td>
      <td>5</td>
    </tr>
    <tr>
      <td><input type="radio" name="calificacion" value="1"><a href="#" data-value="1" title="Votar con 1 estrellas" style="text-decoration:none; color:white;" >&#9733;</a></td>
      <td><input type="radio" name="calificacion" value="2"><a href="#" data-value="1" title="Votar con 2 estrellas" style="text-decoration:none; color:white;" >&#9733;</a></td>
      <td><input type="radio" name="calificacion" value="3"><a href="#" data-value="1" title="Votar con 3 estrellas" style="text-decoration:none; color:white;" >&#9733;</a></td>
      <td><input type="radio" name="calificacion" value="4"><a href="#" data-value="1" title="Votar con 4 estrellas" style="text-decoration:none; color:white;" >&#9733;</a></td>
      <td><input type="radio" name="calificacion" value="5"><a href="#" data-value="1" title="Votar con 5 estrellas" style="text-decoration:none; color:white;" >&#9733;</a></td>
    </tr>
  </table>
</div>

</div>

      </div>
                <br>
                <div class="form-group">
                  <h5 class="modal-title" id="exampleModalLabel">Deja un comentario:</h5>
                  <br>
                  <textarea class="form-control" name="comentario" id="message-text"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
              <?php
              $conUp = conexion();
              $stUp = $conUp->prepare('SELECT * FROM calif WHERE calificado=:calificado AND calificador=:email');
              $stUp->execute(array(':calificado'=>$email,':email'=>$_SESSION['usuario']));
              $rsUp = $stUp->fetchAll();

              if ($rsUp!=false) {
                ?><button type="button" data-dismiss="modal" onclick="actualizarComentario()" class="btn btn-outline-dark">Actualizar</button>  <?php
              }else{
                ?><button type="button" data-dismiss="modal" onclick="enviarComentario()" class="btn btn-outline-dark">Enviar</button><?php
              } ?>
            </div>
          </div>
        </div>
      </div>
      <a href="#" class="card-link btn-outline-dark">Chat</a>
    </div>

      <div class="card-footer text-right">
        <small class="text-muted text-right">
        <?php
        $cuenta=0;
        $conCalif = conexion();
        $stCalif = $conCalif->prepare('SELECT cal_asi FROM calif WHERE calificado=:email');
        $stCalif->execute(array(':email'=>$email));
        $rsCalif = $stCalif->fetchAll();
        $cantidad = count($rsCalif);
        for ($i=0; $i < count($rsCalif); $i++) {
          $cuenta = $cuenta+$rsCalif[$i][0];
        }
        if (count($rsCalif)==0) {
          $cantidad=1;
        }
         ?>
            Calificacion <cite title="Source Title"><?php echo $cuenta/$cantidad  ; ?> Marx</cite>
        </small>
      </div>
      <div class="card-footer text-right">
</nav>

      </div>
  </div>
    </div>

    <div class="col-12 col-md-8 col-lg-9">
      <div class="container centradormiddle">

        <section class="main row">

          <aside class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

            <div class="Datos">

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

             <div class="container-fluid rounded publicacion mx-auto col-12 col-md-12 col-lg-11 col-xl-11">
               <h5><a href="/Proyecto/Usuario?id=<?php echo $resultado1[$i][6];?>"><!--Persona que subió la pub:--> <?php

                 $statementN->execute(array(':email'=>$resultado1[$i][6]));
                 $resultadoN = $statementN->fetch();

                 echo $resultadoN[0];

               ?></a></h5>

               <h2><!--Titulo:--> <?php
               echo $resultado1[$i][10];
               ?></h2>
               <div class="w3-display-container">
                 <img src="../ShaBoo/<?php
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
                 <button type="button" class="btn btn-outline-dark" name="Eliminar">Borrar Publicacion</button>
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
             <?php
             }
             ?>

             <!-- Aqui termina -->
             <br>
          </aside>
        </section>


      </div>
    </div>
  </div>
</div>
<script src="js/bootstrap.bundle.js"></script>
      <script src="js/bootstrap.js"></script>
      <script src="js/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script type="text/javascript">

  function enviarComentario() {

    var calif = 0;
    var calificaciones = document.getElementsByName('calificacion');
    for (var i = 0; i < calificaciones.length; i++) {
      if (calificaciones[i].checked) {
        calif = calificaciones[i].value;
      }
    }

    var coment = document.getElementById('message-text').value;
    var calificado = "<?php echo $resultado[0]; ?>";
    var calificador = "<?php echo $_SESSION['usuario']; ?>";
    var datos = {
      "calificacion" : calif,
      "comentario" : coment,
      "calificado" : calificado,
      "calificador" : calificador
    };

    $.ajax({
       method: 'POST',
       url:'calificar.php',
       data: datos
    });
    alert('Se ha enviado tu comentario, gracias por ayudarnos a hacer de ShareBooks un mejor lugar');
  }

  function actualizarComentario() {
    var calif = 0;
    var calificaciones = document.getElementsByName('calificacion');
    for (var i = 0; i < calificaciones.length; i++) {
      if (calificaciones[i].checked) {
        calif = calificaciones[i].value;
      }
    }

    var comentAc = document.getElementById('message-text').value;
    var califF = "<?php echo $resultado[0]; ?>";
    var califr = "<?php echo $_SESSION['usuario']; ?>";
    var datos = {
      "calificacion" : calif,
      "comentario" : comentAc,
      "califF" : califF,
      "califr" : califr
    };

    $.ajax({
       method: 'POST',
       url:'calificar.php',
       data: datos
    });
    alert('Se ha enviado tu comentario, gracias por ayudarnos a hacer de ShareBooks un mejor lugar');
  }

</script>
</body>
</html>
