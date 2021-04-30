<?php session_start();

$email = $_SESSION['usuario'];

require_once 'Funciones.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $errores='';

  $tipoTel;

  $nombre = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
  $app = filter_var($_POST['app'],FILTER_SANITIZE_STRING);
  $telefono = filter_var($_POST['tel'],FILTER_SANITIZE_STRING);
  $nac = $_POST['nac'];


    if (validateNom($nombre)==false) {
      $errores.='<li>Su nombre no cumple con el formato aducuado (no puede llevar números)</li>';
    }


    if (validateApe($app)==false) {
      $errores.='<li>Su apellido no cumple con el formato adecuado (no puede llevar número)</li>';
    }


  if (strlen($telefono)>8) {
    $tipoTel=false;
  }else{
    $tipoTel=true;
  }

  if (valDateNac($nac)==false) {
    $errores.='<li>Debes de ser mayor a 12 años y tener menos de 100 :v</li>';
  }

  if ($errores=='') {
    $conexion=conexion();
    $statement = $conexion->prepare('SELECT nombre FROM usuario WHERE email=:email');
    $statement->execute(array(':email'=>$email));
    $result = $statement->fetch();

    if ($result[0]!=$nombre) {
      $conexion=conexion();
      $statement = $conexion->prepare('UPDATE usuario SET nombre=:nombre WHERE email=:email');
      $statement->execute(array(':nombre'=>$nombre,':email'=>$email));
    }

    $conexion=conexion();
    $statement = $conexion->prepare('SELECT apellido FROM usuario WHERE email=:email');
    $statement->execute(array(':email'=>$email));
    $result = $statement->fetch();

    if ($result[0]!=$app) {
      $conexion=conexion();
      $statement = $conexion->prepare('UPDATE usuario SET apellido=:app WHERE email=:email');
      $statement->execute(array(':app'=>$app,':email'=>$email));
    }
    $conexion=conexion();
    $statement = $conexion->prepare('SELECT Fnacimiento FROM usuario WHERE email=:email');
    $statement->execute(array(':email'=>$email));
    $result = $statement->fetch();

    if ($result[0]!=$nac) {
      $conexion=conexion();
      $statement = $conexion->prepare('UPDATE usuario SET Fnacimiento=:nac WHERE email=:email');
      $statement->execute(array(':nac'=>$nac,':email'=>$email));
    }
    $conexion=conexion();
    $statement = $conexion->prepare('SELECT numero FROM telefono WHERE email=:email');
    $statement->execute(array(':email'=>$email));
    $result = $statement->fetch();

    if ($result[0]!=$telefono) {
      $conexion=conexion();
      $statement = $conexion->prepare('UPDATE telefono SET numero=:num WHERE email=:email');
      $statement->execute(array(':num'=>$telefono,':email'=>$email));
    }
  }else{
    echo $errores;
  }





}


  require 'Vistas/MiCuenta.view.php';

?>
