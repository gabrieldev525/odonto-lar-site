<?php
	session_start();
	
	$name = isset($_POST["nome"]) ? $_POST["nome"] : "user name";
	$email = isset($_POST["email"]) ? $_POST["email"] : "user email";
	$senha = md5(isset($_POST["senha"]) ? $_POST["senha"] : "user name");
	$senha_comfirm = md5(isset($_POST["senha"]) ? $_POST["senha"] : "user name");
	$status = isset($_POST["status"]) ? $_POST["status"] : "1";
	
	require_once("connection.php");
	
	//make connection with mysqli db server
	$conn = mysqli_connect($my_host, $my_user, $my_password, $my_db) or die ("failed to connect");
	
	//protect mysql injection
	/*$name = mysql_real_scape_string($conn, $name);
	$email = mysql_real_scape_string($conn, $email);
	$senha = md5(mysql_real_scape_string($conn, $senha));
	$senha_comfirm = md5(mysql_real_scape_string($conn, $senha_comfirm));
	*/
	//verify if the two passwords is equals
	if($senha == $senha_comfirm)
		echo "senha correta";
	else 
		echo "senhas diferentes";
		
	//verify if the email alredy cadastrado
	$query = "SELECT * FROM usuarios WHERE email='$email'";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0) { //email ja cadastrado
		$_SESSION["message"] = "email já cadastrado";
		header("location: _cadastrar.php");
	} else {
		
		//level 1 - commum user
		//level 2 - doctor
		//level 3 - admin
		
		//add a row to table
		$query = "INSERT INTO usuarios(nome, email, senha, status) VALUES ('$name', '$email', '$senha', '$status')";
		
		$result = mysqli_query($conn, $query);

		//register sucefully
		if($result) {
			echo "sucesfully registered";
			
			$query = "SELECT * FROM usuarios WHERE email='$email'";
			$result = mysqli_query($conn, $query);

			//return a array with all values of current row
			$row = mysqli_fetch_row($result);
			
			if($status == '1') {
				$_SESSION["id"] = $row[0];
				$_SESSION["name"] = $row[1];
				$_SESSION["email"] = $row[2];
				$_SESSION["status"] = $row[4];

				setcookie("logged", "1");
				$_COOKIE["logged"] = "1";
			}
			
			if(!isset($_COOKIE["app"])) {
			  header("location: index.php");
			} else {
				header("location: client-perfil.php");
			}
		} else {
			echo "failed to register";
		}
	}
?>