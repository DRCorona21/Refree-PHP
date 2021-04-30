<?php
require 'funciones.php';

$conexion = conexion();
$st = $conexion->prepare('SELECT id_publicacion FROM publicacion ORDER BY id_publicacion ASC');
$st->execute();
$rs = $st->fetchAll();
$vistas = array();
$mb = array();
$j = 0;

for ($i=0; $i < count($rs); $i++) {

  $con = conexion();
  $stA = $con->prepare('SELECT count(*),id_publicacion FROM vistas WHERE id_publicacion = :id');
  $stA->execute(array(':id'=>$rs[$i][0]));
  $rsA = $stA->fetchAll();

    $vistas[$i][0]=$rsA[0][0];
    $vistas[$i][1]=$rsA[0][1];
}

$vistas2 = burbuja($vistas);

for ($i=count($vistas2)-1; $i>count($vistas2)-4; $i--) {
  $mb[$j] = $vistas2[$i][1];
  $j++;
}
for ($i=0; $i < count($mb); $i++) {

}
$conMB = conexion();
$stMB = $conMB->prepare('')

 ?>
