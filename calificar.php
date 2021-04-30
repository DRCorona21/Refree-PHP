<?php session_start();
if ($_SERVER['REQUEST_METHOD']=='POST') {
  require_once 'funciones.php';

  if (isset($_POST['calificador']) && isset($_POST['calificado'])) {

    $calificacion = $_POST['calificacion'];
    $coment = $_POST['comentario'];
    $calificado = $_POST['calificado'];
    $calificador = $_POST['calificador'];

    $conexionU = conexion();
    $statement = $conexionU->prepare('SELECT nombre FROM usuario WHERE email=:email');
    $statement->execute(array(':email'=>$calificado));
    $resultado = $statement->fetch();

    if ($resultado!=false) {

        if ($_SESSION['usuario']==$calificador) {
            if ($_SESSION['usuario']!=$calificado) {
            $conexion = conexion();
            $statement = $conexion->prepare('INSERT INTO calif (cal_asi,descp,calificador,calificado) VALUES (:cal,:des,:calificador,:calificado)');
            $statement->execute(array(':cal'=>$calificacion,':des'=>$coment,':calificador'=>$calificador,':calificado'=>$calificado));
            }
        }

    }


  }else{
    $calificacion = $_POST['calificacion'];
    $coment = $_POST['comentario'];
    $calificado = $_POST['califF'];
    $calificador = $_POST['califr'];

    $conexionU = conexion();
    $statement = $conexionU->prepare('SELECT nombre FROM usuario WHERE email=:email');
    $statement->execute(array(':email'=>$calificado));
    $resultado = $statement->fetch();

    if ($resultado!=false) {

        if ($_SESSION['usuario']==$calificador) {
            if ($_SESSION['usuario']!=$calificado) {
            $conexion = conexion();
            $statement = $conexion->prepare('UPDATE calif SET descp=:des, cal_asi=:cal WHERE calificador=:calificador AND calificado=:calificado');
            $statement->execute(array(':cal'=>$calificacion,':des'=>$coment,':calificador'=>$calificador,':calificado'=>$calificado));
            }
        }

    }
  }

}else{
  header('Location: PagPrin.php');
}
 ?>
