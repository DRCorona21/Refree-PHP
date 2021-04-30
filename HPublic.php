<?php session_start();

    require 'Funciones.php';

    $errores='';

    if(isset($_SESSION['usuario'])) {
        require 'Vistas/HPublic.view.php';
    }
    else{
        header('Location: IniSes.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if (isset($_POST['tit']) && isset($_POST['autor']) && isset($_POST['edic']) && isset($_POST['edit']) && isset($_POST['desc']) && isset($_POST['tipo'])) {
        if($_FILES['archivito']['type'] == 'image/png' || $_FILES['archivito']['type']=='image/jpeg'){

        	$arrayName = array();

          $conexion1 = conexion();
          $conexion3 = conexion();
          $conexion2 = conexion();
          $conexion4 = conexion();

          $statement1 = $conexion1->prepare('SELECT categoria FROM categoria');
          $statement1->execute();
          $resultado = $statement1->fetchAll(PDO::FETCH_COLUMN,0);

          for ($i=0; $i < count($resultado); $i++) {
        		if (isset($_POST[$resultado[$i]])) {
        			$array[$i] = $resultado[$i];
        		}else{

        		}
          }

        	$titulo = filter_var($_POST['tit'],FILTER_SANITIZE_STRING);
        	$autor = filter_var($_POST['autor'],FILTER_SANITIZE_STRING);
        	$edicion = filter_var($_POST['edic'],FILTER_SANITIZE_STRING);
        	$editorial = filter_var($_POST['edit'],FILTER_SANITIZE_STRING);
        	$descrip = filter_var($_POST['desc'],FILTER_SANITIZE_STRING);
          $tipo = filter_var($_POST['tipo'],FILTER_SANITIZE_STRING);



          if ($titulo=='') {
            $errores.='<li>No ha ingresado un titulo</li>';
          }

          if ($edicion=='') {
            $errores.='<li>No ha ingresado una edicion</li>';
          }
          if ($editorial=='') {
            $errores.='<li>No ha ingresado una editorial</li>';
          }

          if ($tipo==1) {
            $tipoF=true; //es para intercambio
          }else{
            $tipoF=false; //es para prestamo
          }

        	$ebook = $_FILES['archivito']['name'];

        	$hoy = getdate();
     		  $fecha = $hoy["year"]."-".$hoy["mon"]."-".$hoy["mday"]." ".$hoy["hours"].":".$hoy["minutes"].":".$hoy["seconds"];

        	extract($_POST);
    	    $ebook = $_FILES['archivito']['tmp_name'];

    	    $correito = "fotos/".$_SESSION['usuario'];
    	      	 if (!file_exists($correito)) {
    	       		  mkdir($correito,0777,true);
    	      	 }

    	    $rutaArchivo =  'fotos/'.$_SESSION['usuario'].'/';
    	    $nombrecito = $_FILES['archivito']['name'];
    	    $rutaebook = $rutaArchivo.$nombrecito;

    	    if ($errores=='') {
            if ($_FILES['archivito']['error']!==0) {

      	    }else{
      	        if (move_uploaded_file($ebook,$rutaebook)) {


      		        $statement2 = $conexion2->prepare("INSERT INTO publicacion (tipo,foto,descripcion,fecha,email,editorial,edicion,id_autor,titulo) VALUES (:tipo,:foto,:descrip,:fecha,:email,:edit,:edic,:autor,:titulo)");
      		        $statement2->execute(array(':tipo'=>$tipoF,':foto'=>$rutaebook,':descrip'=>$descrip,':fecha'=>$fecha,':email'=>$_SESSION['usuario'],'edit'=>$editorial,':edic'=>$edicion,':autor'=>$autor,'titulo'=>$titulo));

                  $statement3 = $conexion3->prepare("SELECT id_publicacion FROM publicacion WHERE foto=:foto");
      	         	$statement3->execute(array('foto'=>$rutaebook));
      	         	$resultado3 = $statement3->fetchAll(PDO::FETCH_COLUMN,0);



      	         	$statement4 = $conexion4->prepare("INSERT INTO catpubli (id_publicacion,id_categoria) values (:idpubli,:cat)");
      		        for ($i=0; $i < count($resultado) ; $i++) {
      		        	if (isset($array[$i])) {
      		        		$statement4->execute(array(':idpubli'=>$resultado3[0],':cat'=>($i+1)));


      		        	}
      		        }

      	        }else{
                  $errores='Ya se subió :D';
      	        }

      	    }
          }else{
            echo $errores;
          }

        }else{

            $errores.='<li>Solo se pueden subir archivos de tipo png y jpg</li>';

        }
      }else{
        $errores.='deja de mover mi html >:v';
      }
  }else {
    $errores.='';
  }


?>
