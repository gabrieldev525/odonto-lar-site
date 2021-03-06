<?php
	session_start();

	$status = isset($_POST["status"]) ? $_POST["status"] : "1";

	$message = isset($_SESSION["message"]) ? $_SESSION["message"] : null;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Gabriel Victor && Lucas Silva">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>clinica odontologica - cadastrar</title>
		<link rel="stylesheet" type="text/css" href="css/login_register.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</head>
	<body>
			<?php
					if($message != null)
						echo '<a id="warning" class="popup-content-title">' . $message . '</a>';
			?>
			<div class="content">
				<a class="title" class="popup-content-title">Cadastrar</a>

			    <form action="cadastrar.php" method="post">
					<input type="text" name="nome" class="input-text" id="nome-cadastrar" placeholder="Nome">
					<input type="email" name="email" class="input-text" id="email-cadastrar" placeholder="Email">
					<input type="password" name="senha" class="input-text" id="senha-cadastrar" placeholder="Senha">
					<input type="password" name="senha" class="input-text" id="comfirm-senha-cadastrar" placeholder="Comfirme sua senha">

					<?php
						echo '<input type="hidden" name="status" value="' . $status . '">';
					?>
					<input type="submit" value="cadastrar" onclick="return cadastrarEmpty();">
				</form>	

				<?php //reset message session
					$_SESSION["message"] = "";
				?>
			</div>
			<!-- script -->
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/script2.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>