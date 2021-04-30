<?php session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if (isset($_POST['usuario']) && isset($_POST['pass'])) {
          $email = filter_var($_POST['usuario'],FILTER_SANITIZE_STRING);
          $password = $_POST['pass'];
          $password = hash('sha512',$password);

          $errores = '';
          //supongo que esa es la validación
          /*if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email){
            $errores .= '<li>No se está ingresando un email</li>'
          }*/

          if ($errores=='') {

            try{

                $conexion = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sharebooks','root','726894513');

            }catch(PDOException $e){

                echo "Error: " . $e->getMessage();

            }

            $statement = $conexion->prepare('SELECT * FROM usuario WHERE email = :email AND password = :password');
            $statement->execute(array(':email' => $email,'password' => $password));
            $resultado = $statement->fetch();


            if($resultado != false){

              if ($resultado[5][0]==0) {

                $_SESSION['usuario'] = $email;
                header('Location: PagPrin.php');

              }else{
                $errores.='<li>La cuenta se encuentra desactivada</li>';
              }

            }else{

                $errores .= '<li>Datos incorrectos</li>';

            }

          }else{

          }
        }


    }

    require 'Vistas/IniSes.view.php';

?>
