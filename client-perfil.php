<?php
	session_start();
	if(!isset($_COOKIE["logged"])) {
		header("location:login.php");
	}
	
	require_once("connection.php");
	
	//make connection with mysqli db server
	$conn = mysqli_connect($my_host, $my_user, $my_password, $my_db) or die ("failed to connect");
	$id = $_SESSION["id"];
	$status = $_SESSION["status"];

	$doctor_id = isset($_POST["doctor"]) ? $_POST["doctor"] : null;
?>

<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta name="author" content="Gabriel Victor && Lucas Silva">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>clinica odontologica - perfil</title>
	<link rel="stylesheet" type="text/css" href="css/perfil.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
  </head>
  <body>
  	<div id="popup-delete-acount">
		<div class="content">
			<a class="title">Deseja deletar sua conta? (não será possivel recuperar)</a>
			<div id="buttons">
				<button id="yes" class="button-table">sim</button>
				<button id="no" class="button-table">não</button>
			</div>
		</div>
	</div>

	<?php
		if(!isset($_COOKIE["app"]) || $_COOKIE["logged"] == '1')
				require_once "includes/menu.php";
	?>
	
	<div id="interface">
	  <!-- perfil informations -->
	  <div id="perfil-info">
		<a class="title">Perfil</a>
		<img src="images/profile-icon.png" id="perfil-icon">
		
		<!-- table info -->
		<table class="main-table">
		  <tr>
			<td>Nome: </td>
			<?php
				print("<td>" . $_SESSION["name"] . "</td>");
			?>
		  </tr>
		  <tr>
			<td>Email: </td>
			<?php
				print("<td>" . $_SESSION["email"] . "</td>");
			?>
		  </tr>
		</table>
		
		<?php
			echo '<button class="button-table" id="deletar-conta">Deletar conta</button>';
			
			if($status == "3") { //ADM
				echo '<button class="button-table" id="cadastrar-medico">cadastrar médico</button>';
			}
		?>
	  </div>

	  <!-- agendamentos -->
	  <div id="agendamentos">
	  	<?php
	  		if($status == '1' || $status == '2') {
				echo '<a class="title">Agendamentos</a>';
			}
		?>
		<table class="main-table">
		  <tr>
		  	<?php
		  		if($status == '1' || $status == '2' || $doctor_id != null) {
					echo '<td>Consulta</td>';
				}

				if($status == '1') {
					echo '<td>Doutor(a)</td>';
				}

				if($status == '1' || $status == '2'  || $doctor_id != null) {
					echo '<td>Data</td>';
					echo '<td>Horario</td>';
				}
				
				if($status == '2' || $doctor_id != null) {
					echo '<td>cliente</td>';
				}

				if($status == '3' && $doctor_id == null) {
					echo '<td>Nome do médico</td>';
				}
			?>
		  </tr>
		  
		<?php
				if ($status == "1") { //comum user
					$query = "SELECT * FROM consultas WHERE id_usuario='$id'";
					$result = mysqli_query($conn, $query);

					if($result) {
						if(mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_row($result)) {
								//get doctor name
								$query_ = "SELECT * FROM usuarios WHERE id='$row[6]'";
								$result_ = mysqli_query($conn, $query_);
								if($result_) {
									if(mysqli_num_rows($result_) > 0) {
										$row2 = mysqli_fetch_row($result_);
										echo "<tr onclick='cancelarConsulta($row[0]);' id='$row[0]'><td>$row[2]</td><td>$row2[1]</td><td>$row[4] / $row[5]</td><td>$row[3] h</td></tr>";
									}
								}
							}
						}
					}
				} elseif($status == "2") { //doctor
					$query = "SELECT * FROM consultas WHERE doutor='$id'";
					$result = mysqli_query($conn, $query);

					if($result) {
						if(mysqli_num_rows($result) > 0) {
							while($row = mysqli_fetch_row($result)) {
								//get client name
								$query_ = "SELECT * FROM usuarios WHERE id='$row[1]'";
								$result_ = mysqli_query($conn, $query_);
								if($result_) {
									if(mysqli_num_rows($result_) > 0) {
										$row2 = mysqli_fetch_row($result_);
										//add the current row
										echo "<tr onclick='cancelarConsulta($row[0]);' id='$row[0]'><td>$row[2]</td><td>$row[4] / $row[5]</td><td>$row[3] h</td><td>$row2[1]</td></tr>";
									}
								}
							}
						}
					}
				} elseif ($status == '3') {
					if($doctor_id == null) {
						$query = "SELECT * FROM usuarios WHERE status='2'";
						$result = mysqli_query($conn, $query);

						if($result) {
							if(mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_row($result)) {
									echo "<tr onclick='doctorConsultas($row[0]);' id='doctor_row'><td>" . $row[1] . "</td></tr>";
								}
							}
						}
					} else {
						$query = "SELECT * FROM consultas WHERE doutor='$doctor_id'";
						$result = mysqli_query($conn, $query);

						if($result) {
							if(mysqli_num_rows($result) > 0) {
								while($row = mysqli_fetch_row($result)) {
									//get client name
									$query_ = "SELECT * FROM usuarios WHERE id='$row[1]'";
									$result_ = mysqli_query($conn, $query_);
									if($result_) {
										if(mysqli_num_rows($result_) > 0) {
											$row2 = mysqli_fetch_row($result_);
											//add the current row
											echo "<tr onclick='cancelarConsulta($row[0]);' id='$row[0]'><td>$row[2]</td><td>$row[4] / $row[5]</td><td>$row[3] h</td><td>$row2[1]</td></tr>";
										}
									}
								}
							}
						}
					}
				}
		?>
		</table>

		<!-- buttons -->
		<div id="agendamento-buttons">
			<?php
				if($status == '1') {
		  			echo '<button class="button-table" id="agendar-consulta">Agendar Consulta</button>';
		  		}
				$query = "SELECT * FROM consultas WHERE id_usuario='$id'";
				$result = mysqli_query($conn, $query);

				if($result) {
					if(mysqli_num_rows($result) > 0) {
						echo '<button class="button-table" id="cancelar-consulta">Cancelar Consulta</button>';
					}
				}

				if($doctor_id != null) {
					echo '<button class="button-table" id="back-doctor-adm">Voltar</button>';
				}
			?>
		</div>
		<!-- buttons on cancel consultas -->
		<div id="cancelamento-buttons">
			<button class="button-table" id="cancelar">cancelar consulta</button>
		    <button class="button-table" id="sair">sair</button>
		</div>
	  </div>

	  <!--<footer>
		<a>&copy;Copyright Odonto lar - site desenvolvido por Gabriel Victor && Lucas Silva</a>
	  </footer>		-->

	</div>

	<!-- script -->
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
  </body>
</html>
