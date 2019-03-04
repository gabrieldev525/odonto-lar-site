<?php
	require_once("connection.php");
	
	//make connection with mysqli db server
	$conn = mysqli_connect($my_host, $my_user, $my_password, $my_db) or die ("failed to connect");

	$months = array(
		"01" => "Janeiro", 
		"02" => "fevereiro",
		"03" => "março",
		"04" => "abril",
		"05" => "maio", 
		"06" => "junho",
		"07" => "julho", 
		"08" => "agosto", 
		"09" => "setembro", 
		"10" => "outubro", 
		"11" => "novembro", 
		"12" => "dezembro");

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Gabriel Victor && Lucas Silva">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>clinica odontologica - agendar</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/perfil.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</head>
	<body>
		<div id="content-agendar">
		<a id="title" class="popup-content-title">Agendar consulta</a>


		<form action="agendar.php" method="post">
		  <!-- tipo de consulta-->
		  <label for="tipodeconsulta">Tipo de consulta:</label>
		  <select name="tipodeconsulta">
			<option value="limpeza">Limpeza</option>
			<option value="extração">Extração</option>
			<option value="manutenção">manutenção do aparelho</option>
		  </select>
		  
		  <!-- horario-->
		  <label for="horario">Horario:</label>
		  <select name="horario">
		  	<?php
		  		for($i = 8; $i <= 18; $i ++) {
		  			//add a option of 8am at 18pm, and verify if the $i varible is sless of 10 and case tru add a '0' char to the string 
		  			echo '<option value="' . (($i < 10) ? ("0" . $i . ":00") : $i . ":00") . '">' . (($i < 10) ? ("0" . $i . ":00") : $i . ":00") . '</option>';
		  		}
			?>
		  </select>
		
		<!-- dia-->
			<?php
				//if is the end of month
				$day = date("d");
				if($day == "30" || $day == "31") {
					$day = "1";
				}
			?>		
		  <label for="dia">dia:</label>
		  <select name="dia">
		  	<?php
		  		//for ($i = $day; $i <= 30; $i++) {
		  		for ($i = 1; $i <= 30; $i++) {
		  			echo '<option value="' . $i . '">' . $i . '</option>';
		  		}
		  	?>
		  </select>
		
		<!-- mes-->
		  <label for="mes">mês:</label>
		  <select name="mes">
			
			<?php
				//echo '<option value="marco">' . $months[date("m", strtotime("+0 month"))] . '</option>';
				echo '<option value="' . $months[date("m", strtotime("+1 month"))] . '">' . $months[date("m", strtotime("+1 month"))] . '</option>';
				echo '<option value="' . $months[date("m", strtotime("+2 months"))] . '">' . $months[date("m", strtotime("+2 months"))] . '</option>';
			?>
		  </select>
		  
		  <!-- doutor -->
		  <label for="doutor">Doutor:</label>
		  <select name="doutor">
		  	<?php
		  		$query = "SELECT * FROM usuarios WHERE status='2'";
				$result = mysqli_query($conn, $query);
				if($result) {
					if (mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_row($result)) {
							echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
						}
					}
				}
			?>
		  </select>
		  

		  <input type="submit" value="Agendar">
		</form>	
	  </div>
		
			<!-- script -->
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>