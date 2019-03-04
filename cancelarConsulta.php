<?php
	session_start();
	$consultaId = isset($_GET["id"]) ? $_GET["id"] : null;
	
	if($consultaId != null) {
		require_once("connection.php");
		$conn = mysqli_connect($my_host, $my_user, $my_password, $my_db) or die ("failed to connect");
		
		$allIds = [];

		while (strpos($consultaId, "-") != false) {
			array_push($allIds, substr($consultaId, strpos($consultaId, ":") + 1, strpos($consultaId, "-") - 1));
			$consultaId = substr($consultaId, strpos($consultaId, "-") + 1, strlen($consultaId));
		}
	
		if(count($allIds) > 0) {
			foreach($allIds as $value) {
				$query = "DELETE FROM consultas WHERE id='$value'";
				$result = mysqli_query($conn, $query);
			}
			if(!isset($_GET["app"])) {
				header("location: client-perfil.php");
			} else {
				header("location: client-perfil.php?app=1");
			}
		}
	}
?>