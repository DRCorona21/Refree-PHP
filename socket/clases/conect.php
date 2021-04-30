<?php

	function conexion(){
    try {
      $conexion = new PDO('mysql:host=127.0.0.1;port=3306;dbname=sharebooks','root','726894513');
      return $conexion;
    } catch (PDOException $e) {
      return false;
    }
  }

?>
