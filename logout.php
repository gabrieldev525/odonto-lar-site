<?php
	session_start();
	session_destroy();
	
	unset($_COOKIE["logged"]);
	setcookie("logged", "", time() - 3600);
	header("location: index.php")
?>