<?php

  function conexion(){
    try {
      $conexion = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sharebooks','root','726894513');
      return $conexion;
    } catch (PDOException $e) {
      return false;
    }
  }

  function filtrado($datos){
      $datos = trim($datos); // Elimina espacios antes y después de los datos
      $datos = stripslashes($datos); // Elimina backslashes \
      $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
      return $datos;
  }

  function validateEmpty($array){
    $errores = '';
    for ($i=0; $i < count($array); $i++) {
      if (empty($array[$i])) {
        $errores .= '<li>Por favor rellena todos los datos</li>';
        return $errores;
      }
    }
    if ($errores != '') {
      return true;//No hay errores
    }
  }

  function validateCorreo($email){
    $errores = '';
    if (!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)) {
      $errores .= '<li>Tu correo no cumple con el formato adecuado</li>';
      return $errores;
    } else {
      return true;
    }
  }

  function compareString($string1,$string2){
    $errores = '';
    if($srting1 != $string2){
      $errores .= '<li>Las contraseñas no son iguales</li>';
      return $errores;
    }
    return true;
  }

  function validateNumTel($tel){
    $errores = '';
    $expresion = '/([5]{2})?[0-9]{1,10}/'; //Ya con el tuyo xd
    if(!preg_match($expresion, $tel)==1){
      $errores.='<li>Tu numero de telefono no cumple con el formato adecuado</li>';
      return false;
    }else{
      if (strlen($tel)!=10 || strlen($tel)!=8 || strlen($tel)!=12) {
        $errores.='<li>Tu numero de telefono no tiene el número de digitos necesarios/correctos</li>';
        return false;
      }else{
        return true;
      }
    }
  }

  function validateNom($nom){
    $errores = '';
    if(preg_match("/[0-9]{1,}/",$nom)==1){
      $errores.='<li>Tu nombre no cumple con el formato adecuado</li>';
      return false;
    }
    return true;
  }

  function validateApe($ape){
    $errores = '';
    if(!preg_match("/^[A-ZÑÁÉÍÓÚ]{1}[a-zñÑáéíóúÁÉÍÓÚÄËÏÖÜäëïöüàèìòùÀÈÌÔÙA-Z, ]{2,20}/",$ape)==1){
      $errores.='<li>Tu apellido no cumple con el formato adecuado</li>';
      return false;
    }
    return true;
  }

  function validateEmail(){
    $errores = '';
    if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email)==1){
      $errores.='<li>Tu email no cumple con el formato adecuado</li>';
      return false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errores.='<li>Tu email no cumple con el formato adecuado</li>';
      return false;
    }
    return true;
  }

  function validateDate($date, $format = 'Y-m-d H:i:s'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
  }

  function valDateNac($fecha){
    $CT = new DateTime(date('Y-m-d'));
    $fecha2 = new DateTime(date($fecha));
    if ((date_diff($fecha2,$CT, true)->format('%Y'))<=12 || (date_diff($fecha2,$CT, true)->format('%Y'))>=100) {
      return false;
    }else{
      return true;
    }
  }



  /*Crear funcion de vaidateFecha OSCAR*/
  /*RECOMENDACION DE ALONSO --> USAR CHECKDATE*/
  /*ADVETENCIA - Todo despues de esto son pruebas*/


  function envCorreo($email,$asunto,$nom,$men){
    require 'Smtp/class.phpmailer.php'; // Requiere PHPMAILER para poder enviar el formulario desde el SMTP de google
    $mail = new PHPMailer();
    $mail->From     = "charliedgr14@gmail.com";
    $mail->FromName = "ShareBooks";
    $mail->AddAddress($email); // Dirección a la que llegaran los mensajes.
    // Aquí van los datos que apareceran en el correo que reciba
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject  =  $asunto; // Asunto del mensaje.
    $mail->Body     =  "Nombre: $nom \n<br />". // Nombre del usuario
    "Email: $email \n<br />".    // Email del usuario
    "Mensaje: $men \n<br />"; // Mensaje del usuario
    // Datos del servidor SMTP, podemos usar el de Google, Outlook, etc...
    $mail->IsSMTP();
    $mail->Host = "ssl://smtp.gmail.com:576";  // Servidor de Salida. 465 es uno de los puertos que usa Google para su servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = "charliedgr14@gmail.com";  // Correo Electrónico
    $mail->Password = ""; // Contraseña del correo

    if ($mail->Send()){
      return true;
    } else {
      $errores.='<li>El correo no se envio</li>';
      return $errores;
    }
  }

  function alertaShida()
  {

    if (isset($_SESSION)) {
      if (!isset($_SESSION['last_access'])) {
        $_SESSION['last_access'] = time();
      }

      if ((time()-$_SESSION['last_access'])<2) {
        return true;
      }else{
        return false;
      }
    }

  }

  function addview($q,$s){

    $conexion = conexion();
    $statement = $conexion->prepare('SELECT email FROM publicacion WHERE id_publicacion=:idpubli');
    $statement->execute(array(':idpubli'=>$s));
    $result=$statement->fetch();
    if ($result[0]==$q) {

    }else{
      $conexion = conexion();
      $statement = $conexion->prepare('SELECT id_vistas FROM vistas  WHERE email=:email AND id_publicacion=:idpubli');
      $statement->execute(array(':email'=>$q,':idpubli'=>$s));
      $result = $statement->fetch();

      if ($result!=false) {

      }else{

        $conexion1 = conexion();
        $statement1 = $conexion1->prepare('INSERT INTO vistas (id_publicacion,email) values (:idpubli,:email)');
        $statement1->execute(array(':idpubli'=>$s,':email'=>$q));

      }
    }
  }

  function burbuja($array)
  {
      for($i=1;$i<count($array);$i++)
      {
          for($j=0;$j<count($array)-$i;$j++)
          {
              if($array[$j]>$array[$j+1])
              {
                  $k=$array[$j+1];
                  $array[$j+1]=$array[$j];
                  $array[$j]=$k;
              }
          }
      }

      return $array;
  }

  /*LO DE ABAJO ES UN EJEMPLO*/

?>
