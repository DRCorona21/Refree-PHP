<?php session_start();

	if (!isset($_SESSION['usuario'])) {
		header('Location: IniSes.php');
	}

	if (isset($_GET['titulo'])) {
		$nombre = $_GET['titulo'];
		require_once 'funciones.php';
		$conexion2 = conexion();
		$statement2 = $conexion2->prepare('SELECT email FROM libro WHERE titulo=:titulo');
		$statement2->execute(array(':titulo'=>$nombre));
		$resultado2 = $statement2->fetch();
		echo $_SESSION['usuario'];
		echo $resultado2[0];
		if ($_SESSION['usuario']==$resultado2[0]) {


			$conexion = conexion();
			$statement = $conexion->prepare('SELECT URL FROM libro where titulo=:titulo');
			$statement->execute(array(':titulo'=>$nombre));
			$resultado = $statement->fetchAll(PDO::FETCH_COLUMN,0);

			echo $resultado[0];

			header('content-type: application/pdf');
			readfile($resultado[0]);

		}else{
			header('Location: PagPrin.php');
		}
	}else{
		header('Location: Milibro.php');
	}

?>
