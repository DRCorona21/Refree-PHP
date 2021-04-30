<?php session_start();
if(isset($_SESSION['usuario'])) {
}
else{
    header('Location: IniSes.php');
}

  if (!isset($_POST['archivoE'])) {
    echo "No se ha borrado nada, porque no había nada seleccionado para borrar";
    header ('Location: Milibro.php');

  }else{


    $value = filter_var($_POST['archivoE'],FILTER_SANITIZE_STRING);
    $rutaArchivo = 'archivospdf/'.$_SESSION['usuario'].'/';
    $rutaebook = $rutaArchivo.$_POST['archivoE'];

    if (unlink($rutaebook)) {
      //se borró
    }else{
      //no se borró
    }

    try {
     $conexion1 = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sharebooks','root','726894513');

     } catch (PDOException $e) {
      echo "Error: ".$e->getMessage();
    }
    $statement = $conexion1->prepare('DELETE FROM libro where titulo=:titulo');
    $statement->execute(array(':titulo'=>$value));

    header ('Location: Milibro.php');

  }
?>
