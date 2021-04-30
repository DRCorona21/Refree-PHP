<?php session_start();

    if(isset($_SESSION['usuario'])){
        header('Location: PaginaPrincipal.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

      require 'Funciones.php';

        if (isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['nom']) && isset($_POST['ape']) && isset($_POST['naci']) && isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST['option'])) {
          $email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
          $tel = filter_var($_POST['tel'],FILTER_SANITIZE_STRING);
          $nom = filter_var($_POST['nom'],FILTER_SANITIZE_STRING);
          $ape = filter_var($_POST['ape'],FILTER_SANITIZE_STRING);
          $naci = $_POST['naci'];
          $pass = $_POST['pass'];
          $pass2 = $_POST['pass2'];
          $preg = $_POST['option'];
          // if(preg == 1) => ¿Nombre de tu primera mascota?
          // elseif (preg == 2) => ¿Cual es el codigo postal de tus padres?
          // else => ¿Nombre de tu primer novio o novia?
          $resp = $_POST['resp'];
          $resp2 = $_POST['resp2'];
          $dom = filter_var($_POST['dom'],FILTER_SANITIZE_STRING);
          $errores = '';



          /*if (preg_match("/^([a-zA-Z]?+[0-9]{1,})/"),$nom) {
            $errores .= '<li>El nombre no debe de llevar numeros</li>';
          }

          if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))
            {

            }else{
              $errores .= '<li></li>';
            }

          if (preg_match("/^\5{2}?+[0-9]{1,4}+\32+[0-9]{1,4}/")) {
            // code...
          }else{
            $errores .= '<li>El número de telefono no está bien escrito</li>'
          }*/
          $email = filtrado($email);//hola xD
          $tel = filtrado($tel);
          $nom = filtrado($nom);
          $ape = filtrado($ape);
          $dom = filtrado($dom);

          if(empty($email) or empty($tel) or empty($nom) or empty($ape) or empty($pass) or empty($pass2) or empty($preg) or empty($resp) or empty($resp2) or empty($dom)){

              $errores .= '<li>Por favor rellena todos los datos</li>';

          }elseif (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)) {

             $errores .= '<li>Tu correo no cumple con el formato adecuado</li>';

          }else{

              $conexion = conexion();
              if ($conexion) {
              $statement = $conexion->prepare('SELECT * FROM usuario Where email = :email LIMIT 1');
              $statement->execute(array(':email' => $email));
              $resultado = $statement->fetch();
            } else {
              echo 'No se realizo la conexion con la base';
            }

              if($resultado != false){

                  $errores .= '<li>El corre ya es usado por otra cuenta existente</li>';

              }

              $pass = hash('sha512', $pass);
              $pass2 = hash('sha512', $pass2);

              if($pass != $pass2){

                  $errores .= '<li>Las contraseñas no son iguales</li>';

              }

              $resp = hash('sha512', $resp);
              $resp2 = hash('sha512', $resp2);

              if($pass != $pass2){

                  $errores .= '<li>Las respuestas no son iguales</li>';

              }

              $expresion = '/^[5|+|0][0-9]{7,12}$/'; //Ya con el tuyo xd
              if(preg_match($expresion, $tel)!=1){
                $errores.='<li>Tu numero de telefono no cumple con el formato adecuado</li>';
              }
              if(preg_match("/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]{2,15}+[\s]*)+$/",$nom)!=1){
                  $errores.='<li>Tu nombre no cumple con el formato adecuado</li>';
                }
              if(preg_match("/^[A-ZÑÁÉÍÓÚ]{1}[a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙA-Z, ]{2,20}/",$ape)!=1){
                    $errores.='<li>Tu apellido no cumple con el formato adecuado</li>';
              }


              if (filter_var($email, FILTER_VALIDATE_EMAIL)!=false){

               }else{
                 $errores.='<li>Tu email no cumple con el formato adecuado</li>';
               }



                 /* if(!preg_match("/^(\d{4})(\/|-)(0[1-9]|1[0-2])(\/|-)([0-2][0-9]|3[0-1])$/",$naci)){
                                    $errores.='<li>Tu fecha no cumple con el formato adecuado</li>';
                                  }
                 if (empty($naci)) {
                   $errores.='<li>Esa fecha no existe</li>';
                 } elseif (!var_dump(validateDate($naci, 'd-m-Y'))) {
                   $errores.='<li>Esa fecha no existe</li>';
                 }*/


                 //Sirve para convertir el string en array  $partes= explode("-", $naci);
                 /*if (!checkdate ($partes[1]mes,$partes[2]dia,$partes[0]año))
                 {
                   $errores.='<li>Esa fecha no existe</li>';
                   if ($partes[1]==2 && $partes[2]>29){
                     $errores.='<li>Esa fecha no existe</li>';
                   }
                   if ($partes[0]>2005) {
                     $errores.='<li>No cumples con la edad necesaria para registrarte</li>';
                     // code...
                   }
                   if ($partes[0]<1900) {
                     $errores.='<li>No cumples con la edad necesaria para registrarte</li>';
                     // code...
                  }
                }*/



              //Aqui w a ameterlo  7w7
              if (valDateNac($naci)==false) {
                $errores.='<li>No cumples con la edad necesaria. Debes ser mayor de 12 años.</li>';
              }

          }

          if($errores == ''){

              $conexion2 = conexion();
              if ($conexion2) {
              $statement2 = $conexion2->prepare('INSERT INTO usuario (email, nombre, apellido, password, Fnacimiento, Fcreacion, PreguntaS, Respuesta, domicilio) VALUES (:email, :nombre, :ape, :pass, :Fnacimiento, :Fcreacion, :PreguntaS, :Respuesta, :domicilio)');
              $statement2->execute(array(':email' => $email, ':nombre' => $nom, ':ape' => $ape,':pass' => $pass, ':Fnacimiento' => $naci, ':Fcreacion' => date("Y-m-d"), 'PreguntaS' => $preg, ':Respuesta' => $resp, ':domicilio' => $dom));
              } else {
                echo "No se realizo la conexion";
                $errores.='<li>No se realizo la conexion</li>';
              }

              //conexion con la BD
              $conexion3 = conexion();
              if ($conexion3) {
              $tipotel = true;//1 - teledono fijo
              if(strlen($tel)>8){
                $tipotel = false;//0 - telefono celular
              }
              //peticiones sql                                                                       variables
              $statement3 = $conexion3->prepare('INSERT INTO telefono (tipo, numero, email) VALUES (:tipo, :numero, :email)');
              $statement3->execute(array(':tipo' => $tipotel ,':numero' => $tel,':email' => $email));
              //                           así se da el valor
              } else {
                  echo "No se realizo la conexion";
                  $errores.='<li>No se realizo la conexion</li>';
              }

              if ($errores == '') {
                //$errores.='<li>No hay error :V</li>';
                header('Location: IniSes.php');
              }
          }

      }else{
        $errores.="<li>Deja la consola >:v</li>";
      }
      }

    require 'Vistas/Registrar.view.php';

?>
