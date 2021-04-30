<?php 

require "clases/conect.php";

$con1 = conexion();
$con2 = conexion();
$con3 = conexion();
$con4 = conexion();

$statement1 = $con1->prepare("SELECT * FROM mensajes WHERE tipo = '1' ");
$statement2 = $con2->prepare("SELECT * FROM mensajes WHERE tipo = '2' ");
$statement3 = $con3->prepare("SELECT * FROM mensajes WHERE tipo = '3' ");
$statement4 = $con4->prepare("SELECT * FROM mensajes WHERE tipo = '4' ");

$statement1->execute();
$statement2->execute();
$statement3->execute();
$statement4->execute();

$res1 = $statement1->fetchAll();
$res2 = $statement2->fetchAll();
$res3 = $statement3->fetchAll();
$res4 = $statement4->fetchAll();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/fancywebsocket.js"></script>
</head>

<body>
<div style="width:300px; height:200px; border:solid 1px #999999;float:left;">Martin<br />
<div id="1"><?php while($arr = $res1){ echo $arr['timestamp']." : ".$arr['mensaje']."<br>";}?></div></div>
<div style="width:300px; height:200px; border:solid 1px #999999;float:left;">Fernanda<br />
<div id="2"><?php while($arr = $res2){ echo $arr['timestamp']." : ".$arr['mensaje']."<br>";}?></div></div>
<div style="width:300px; height:200px; border:solid 1px #999999;float:left;">Laura<br />
<div id="3"><?php while($arr = $res3){ echo $arr['timestamp']." : ".$arr['mensaje']."<br>";}?></div></div>
<div style="width:300px; height:200px; border:solid 1px #999999;float:left;">Cesar<br />
<div id="4"><?php while($arr = $res4){ echo $arr['timestamp']." : ".$arr['mensaje']."<br>";}?></div></div>
</body>
</html>
