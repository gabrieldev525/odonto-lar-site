<?php
	session_start();
	$id = $_SESSION["id"];
	
	require_once("connection.php");
	$conn = mysqli_connect($my_host, $my_user, $my_password, $my_db) or die ("failed to connect");
	
	$query = "DELETE FROM usuarios WHERE id='$id'";
	$result = mysqli_query($conn, $query);
	
	if($result) {
		header("location: logout.php");
	} else {
		echo "failed to delete user";
	}
?>