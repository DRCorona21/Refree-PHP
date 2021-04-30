<?php

if(isset($_SESSION['usuario'])) {
    }
    else{
        header('Location: IniSes.view.php');
    }

?>
<!doctype html>
<html lang="en">

    <?php
    $conexion1 = conexion();
    ?>

    <head>

      <title>Haz tu publicacion</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="Css/HPublic.css">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="Css/bootstrap.min.css">

    </head>

    <body>
      <header>
        <nav class="navbar navbar-expand-lg navbar-dark oscuro fixed-top">
          <a class="navbar-brand" href="PagPrin.php">ShareBooks</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Ajustes
                </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="MiCuenta.php">Mi cuenta</a>
              <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="MiLibro.php">Mi libro</a>
              </div>
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
    <br>
    <div class="container" style="margin-top:30px; background-color: rgba(25, 25, 25, 0.7); color: white;" >
      <form enctype="multipart/form-data" method="POST"  style="margin-top:9%" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">

      <div class="row">
        <div class="col-sm-4">
          <h3>Sube una foto de tu libro para que todos puedan verlo</h3>

          <div class="fakeimg" id="file-preview-zone" style="background-color: rgba(25, 25, 25, 0.0);">
            <!-- Aqui va la foto -->
        	</div>

<br>

        <input type="file" name="archivito" style="display:none" id="file-2" class="inputfile inputfile-2">
        <label for="file-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="iborrainputfile" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg>
          <span class="iborrainputfile">Seleccionar archivo</span>
        </label>
        </div>
        <div class="col-sm-8">
          <h2>Sube tu propio libro</h2>
          <div class="form-group">
    <label for="formGroupExampleInput">Titulo</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Titulo del libro" name="tit">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput">Editorial</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Editorial" name="edit">
    </div>
    <div class="form-group">
    <label for="formGroupExampleInput">Edicion</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Edicion" name="edic">
    </div>
    <br>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Hablanos sobre tu libro</span>
      </div>
      <textarea name="desc" class="form-control" aria-label="With textarea"></textarea>
    </div>
    <br>
      <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Autor</label>

      <select class="custom-select my-1 mr-sm-2" name="autor" id="inlineFormCustomSelectPref">
        <?php
        $statement1 = $conexion1->prepare('SELECT autor, id_autor FROM autor');
        $statement1->execute();
        $resultado = $statement1->fetchAll();
        for ($i=0; $i < count($resultado); $i++) {
            echo "<option value='";
            echo $resultado[$i][1];
            echo "'> ";
            echo $resultado[$i][0]."</option>";
        }

        ?>
      </select>
    <br>
    <?php
    $statement1 = $conexion1->prepare('SELECT categoria FROM categoria');
    $statement1->execute();
    $resultado = $statement1->fetchAll(PDO::FETCH_COLUMN,0);
    for ($i=0; $i < count($resultado); $i++) {
        echo " <input type='radio' name='".$resultado[$i]."' value='".$i."'> ".$resultado[$i];
    }

    ?>
    <br>
    <br>
    <input type="radio" name="tipo" value="0" checked="checked"> Prestamo
    <input type="radio" name="tipo" value="1"> Intercambio
    <br>
    <?php if(!empty($errores)): ?>
      <ul>
        <?php echo $errores; ?>
      </ul>
    <?php endif; ?>
    <br>
    <button type="submit" class="btn btn-outline-warning ">Cargar Publicacion</button><br>

      <br>
      </div>

          </div>
      </form>

              <br><br>

              <script>
                  function readFile(input) {
                      if (input.files && input.files[0]) {
                          var reader = new FileReader();

                          reader.onload = function (e) {

                              //e.target.result contents the base64 data from the image uploaded

                              //console.log(e.target.result);
                              var previewZone = document.getElementById('file-preview-zone');
                              previewZone.innerHTML = "<img src='"+e.target.result+"' class='img-fluid img-responsive centradormiddle' style='height: 100%;'></img>";
                          }

                          reader.readAsDataURL(input.files[0]);

                      }
                  }

                  var fileUpload = document.getElementById('file-2');
                  fileUpload.onchange = function (e) {
                      readFile(e.srcElement);
                  }

              </script>
              <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
              <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
              <script src="js/jquery.custom-file-input.js"></script>
              <script src="js/jquery-v1.min.js"></script>
    </body>

</html>
