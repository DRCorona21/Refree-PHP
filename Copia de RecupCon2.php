<?php session_start();

  require_once 'Funciones.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = $_SESSION['usuario'];
        $resp = $_POST['resp'];
        $resp = hash('sha512',$resp);
        $password = $_POST['pass'];
        $password = hash('sha512',$password);
        $password2 = $_POST['pass2'];
        $password2 = hash('sha512',$password2);

        $errores = '';

        if ($password2!=$password) {

          $errores.='<li>las contraseñas no coinciden</li>';

        }

        $conexion2 = conexion();
        $statement2 = $conexion2->prepare('SELECT respuesta FROM usuario WHERE email=:email');
        $statement2 ->execute(array(':email'=>$_SESSION['usuario']));
        $respuesta2 = $statement2->fetch();

        if ($resp!=$respuesta2[0]) {

          $errores.='<li>la respuesta no concuerda</li>';

        }


        //supongo que esa es la validación
        /*if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email){
          $errores .= '<li>No se está ingresando un email</li>'
        }*/

        if ($errores=='') {

          $conexion = conexion();
          $statement = $conexion->prepare('SELECT * FROM usuario WHERE email = :email AND Respuesta = :Respuesta');
          $statement->execute(array(':email' => $email,':Respuesta' => $respuesta2[0]));
          $resultado = $statement->fetch();

          if($resultado != false){

            $conexion3 = conexion();
            $statement3 = $conexion3->prepare('UPDATE usuario SET password=:password WHERE email=:email');
		        $statement3->execute(array(':password'=>$password, ':email'=>$_SESSION['Datos']));

            header('Location: PagPrin.php');

          }else{

              $errores .= '<li>Datos incorrectos</li>';

          }

        }else{

        }


    }

require 'Vistas/RecupCon2.view.php';

?>
