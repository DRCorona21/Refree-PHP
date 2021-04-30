<?php session_start();

if (!isset($_SESSION['usuario'])) {
  header('Location: IniSes.php');
}

  require_once 'funciones.php';

if ($_SERVER['REQUEST_METHOD']=='GET') {

  $conexion = conexion();
  $statement = $conexion->prepare('SELECT estado FROM usuario WHERE email=:email');
  $statement->execute(array(':email'=>$_SESSION['usuario']));
  $resultado = $statement->fetch();
  if ($resultado[0]==0) {
    $conexion = conexion();
    $statement = $conexion->prepare('UPDATE usuario SET estado=true WHERE email=:email');
    $statement->execute(array(':email'=>$_SESSION['usuario']));
    session_destroy();
    $_SESSION = array();
    header('Location: cerrarS.php');
  }

}
?>
