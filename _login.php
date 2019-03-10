<?php
	session_start();

	$message = isset($_SESSION["message"]) ? $_SESSION["message"] : "";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Gabriel Victor && Lucas Silva">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>clinica odontologica - login</title>
		<link rel="stylesheet" type="text/css" href="css/login_register.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</head>
	<body>
		<div class="content">
				<a class="title" class="popup-content-title">Login</a>
				<?php
			    	echo '<a id="warning" class="popup-content-title">' . $message . '</a>';
			    ?>
			     <form action="login.php" method="post">
					<input type="email" name="email" class="input-text" id="email-logar" placeholder="Email">
					<input type="password" name="senha" class="input-text" id="senha-logar" placeholder="Senha">
					<input type="submit" value="logar" onclick="return logarEmpty();">
				</form>	
			</div>

			<?php //reset message session
				$_SESSION["message"] = "";
			?>
			
			<!-- script -->
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/script2.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>