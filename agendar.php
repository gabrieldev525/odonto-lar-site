<?php
	session_start();
	
	if(isset($_COOKIE["logged"])) {
		$id = $_SESSION["id"];
		echo $id;

		$consulta = isset($_POST["tipodeconsulta"]) ? $_POST["tipodeconsulta"] : "";
		$horario = isset($_POST["horario"]) ? $_POST["horario"] : "";
		$dia = isset($_POST["dia"]) ? $_POST["dia"] : "";
		$mes = isset($_POST["mes"]) ? $_POST["mes"] : "";
		$doutor = isset($_POST["doutor"]) ? $_POST["doutor"] : "";
		
		require_once("connection.php");
	
		//make connection with mysqli db server
		$conn = mysqli_connect($my_host, $my_user, $my_password, $my_db) or die ("failed to connect");
		
		//protect mysql injection
		/*
		$consulta = mysqli_real_scape_string($conn, $consulta);
		$horario = mysqli_real_scape_string($conn, $horario);
		$dia = mysqli_real_scape_string($conn, $dia);
		$mes = mysqli_real_scape_string($conn, $mes);
		$doutor = mysqli_real_scape_string($conn, $doutor);*/
		
		//(userid, consulta, horario, dia, mes, doutor)
		$query = "INSERT INTO consultas(id_usuario, consulta, horario, dia, mes, doutor) VALUES ('" . $_SESSION["id"] . "', '$consulta', '$horario', '$dia', '$mes', '$doutor')";
		$result = mysqli_query($conn, $query);
		
		if($result) {
			header("location: client-perfil.php");
		} else {
			echo "deu errado";
		}
	} else {
		//user not logged, redirect to login screen
		header("location: _login.php");
	}
?>