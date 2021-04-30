<?php session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: IniSes.php');
}

if ($_SERVER['REQUEST_METHOD']=='GET') {
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $email = $_SESSION['usuario'];
    require 'funciones.php';
    $conexion = conexion();
    $statement = $conexion->prepare('SELECT email FROM publicacion WHERE id_publicacion=:id');
    $statement->execute(array(':id'=>$id));
    $resultado = $statement->fetch();
    if ($resultado[0] == $email) {

      $conexionC = conexion();
      $statementC = $conexion->prepare('DELETE FROM catpubli WHERE id_publicacion=:id');
      $statementC->execute(array(':id'=>$id));
      $conexionV = conexion();
      $statementV = $conexionV->prepare('DELETE FROM vistas WHERE id_publicacion=:id');
      $statementV->execute(array(':id'=>$id));
      $conexion = conexion();
      $statement = $conexion->prepare('DELETE FROM publicacion WHERE id_publicacion = :id');
      $statement->execute(array(':id'=>$id));

    }else{

    }

  }
}
 ?>
