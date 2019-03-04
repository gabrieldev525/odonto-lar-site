<?php
	session_start();
	
	if(isset($_COOKIE["logged"])){ //already logged
		header("location: index.php");
	} else if(!isset($_COOKIE["logged"])) {
		$email = isset($_POST["email"]) ? $_POST["email"] : "user email";
		$senha = md5(isset($_POST["senha"]) ? $_POST["senha"] : "user name");

		echo $senha;
		
		require_once("connection.php");
	
		//make connection with mysqli db server
		$conn = mysqli_connect($my_host, $my_user, $my_password, $my_db) or die ("failed to connect");
		
		//protect mysql injection
		/*$email = mysqli_real_scape_string($conn, $email);
		$senha = md5(mysqli_real_scape_string($conn, $senha));
		*/

		//query
		$query = "SELECT * FROM usuarios WHERE email='$email' AND senha='" . $senha . "'";
		
		$result = mysqli_query($conn, $query);
		
		if($result) {
			//verify if the user exists
			$rows_count = mysqli_num_rows($result);
			if($rows_count > 0) { //exists
				//return a array with all values of current row
				$row = mysqli_fetch_row($result);
				
				$_SESSION["id"] = $row[0];
				$_SESSION["name"] = $row[1];
				$_SESSION["email"] = $row[2];
				$_SESSION["status"] = $row[4];
				
				setcookie("logged", "1");
				$_COOKIE["logged"] = "1";
				
				echo "logged sucesfully";
				
				if(!isset($_COOKIE["app"])){
				header("location: index.php");
				} else {
					header("location: client-perfil.php");
				}
			} else { //usuario nāo cadastrado
				header("location: _login.php");
				$_SESSION["message"] = 'email ou senha inválido';
			}
		}
	}
?>