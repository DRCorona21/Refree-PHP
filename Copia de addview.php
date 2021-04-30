<?php session_start();

require_once('Funciones.php');

if ($_SERVER['REQUEST_METHOD']=='GET') {
  if (isset($_GET['id'])) {
    $idP = filter_var($_GET['id'],FILTER_SANITIZE_STRING);

    $conexion = conexion();
    $statement = $conexion->prepare('SELECT email FROM publicacion WHERE id_publicacion=:idpubli');
    $statement->execute(array(':idpubli'=>$idP));
    $result=$statement->fetch();
    if ($result[0]==$_SESSION['usuario']) {

    }else{
      $conexion = conexion();
      $statement = $conexion->prepare('SELECT id_vistas FROM vistas  WHERE email=:email AND id_publicacion=:idpubli');
      $statement->execute(array(':email'=>$_SESSION['usuario'],':idpubli'=>$idP));
      $result = $statement->fetch();

      if ($result!=false) {

      }else{

        $conexion1 = conexion();
        $statement1 = $conexion1->prepare('INSERT INTO vistas (id_publicacion,email) values (:idpubli,:email)');
        $statement1->execute(array(':idpubli'=>$idP,':email'=>$_SESSION['usuario']));

      }
  }
}

}

 ?>
