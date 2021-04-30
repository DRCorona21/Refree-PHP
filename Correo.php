<?php session_start();

  if($_SERVER['REQUEST_METHOD'] == 'POST'){

  require 'Funciones.php';

  $email = $_POST['email'];

  $conexion = conexion();
  $statement = $conexion->prepare('SELECT * FROM usuario WHERE email = :email');
  $statement->execute(array(':email' => $email));
  $resultado = $statement->fetch();

    if($resultado != false){
      $_SESSION['Datos'] = $email;
      header('Location: RecupContra.php');
    }else{
        $errores = '<li>Datos incorrectos</li>';
    }

  }

  require 'Vistas/Correo.view.php';

?>
