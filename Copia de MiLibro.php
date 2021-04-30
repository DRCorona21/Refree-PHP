<?php session_start();

  if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_FILES['archivito']) ) {
      if ($_FILES['archivito']['type']=='application/pdf') {

              extract($_POST);
              $ebook = $_FILES['archivito']['tmp_name'];


              $correito = "archivospdf/".$_SESSION['usuario'];
              if (!file_exists($correito)) {
                mkdir($correito,0777,true);
              }

              $rutaArchivo =  'archivospdf/'.$_SESSION['usuario'].'/';
              $nombrecito = $_FILES['archivito']['name'];
              $rutaebook = $rutaArchivo.$nombrecito;


              $numerito = 1;
              while (file_exists($rutaebook)) {

                $nombrecito = $numerito.$nombrecito;
                $rutaebook = $rutaArchivo.$nombrecito;
                $numerito++;
                //echo $numerito."<br>";

              }





              if ($_FILES['archivito']['error']!==0) {



                switch ($_FILES['archivito']['error']) {

                  case 1:
                    $errores = "<li>El archivo que intenta subir pesa más del que es soportado</li>";
                    break;

                  default:
                    $errores = "<br>";
                    $errores .= "<li>No se subió el archivo (quizá porque no se seleccionó o el archivo está corrupto)</li>";
                    break;
                }
              }else{
                if (move_uploaded_file($ebook,$rutaebook)) {

                  try {
                   $conexion2 = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sharebooks','root','726894513');
                  } catch (PDOException $e) {
                    $errores = "<li>Error: ".$e->getMessage()."</li>";
                  }
                  $statement2 = $conexion2->prepare('INSERT INTO libro (titulo,URL,email) values (:titulo,:URL,:email)');
                  $statement2->execute(array(':titulo'=>$nombrecito,':URL'=>$rutaebook,':email'=>$_SESSION['usuario']));
                  $respuesta = $statement2->fetch();

                }else{

                }

              }
      }else{
        $errores = "Solo se permite la subida de archivos pdf";
      }

    }else{
      ;
    }
    //726894513

require 'Vistas/Milibro.view.php';

?>
