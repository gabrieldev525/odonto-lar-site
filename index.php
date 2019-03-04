<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Gabriel Victor && Lucas Silva">
		<meta name="description" content="">
		<meta name="keywords" content="clinica odontologica, dentes, consultas">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>clinica odontologica</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

		<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</head>
	<body>
	  <!-- file:///sdcard/school/cdp/tcc/clinica%20odontologica/index.html -->
	  
		<?php
			if(!isset($_COOKIE["app"]) || $_COOKIE["logged"] == '1')
				require_once "includes/menu.php";
		?>

		<!-- interface main -->
		<div id="interface">
			<!-- thumb -->
			<img src="images/thumb-01.jpg" class="photo-thumb">

			<div id="servicos">
				<!-- info contents -->
				<div class="info-content">
					<i class="fa fa-plus-square icon"></i>

					<a class="title">A clinica</a>
					<a class="description">A Clínica Odonto Lar possui uma estrutura voltada para o conforto e comodidade de seus pacientes. Desde a recepção até as salas de atendimento, tudo é pensado para que você se sinta bem na Clínica Odontológica Multi Oral .</a>
				</div>

				<div class="info-content">
					<i class="fa fa-medkit icon"></i>

					<a class="title">Primeira consulta</a>
					<a class="description">A primeira consulta na Odonto Lar é de extrema importância. Para que se estabeleça uma relação de confiança é reservado um tempo para ouvir, com atenção, as queixas e dúvidas do paciente</a>
				</div>

				<div class="info-content">
					<i class="fa fa-user-md icon"></i>

					<a class="title">Revisão e prevenção</a>
					<a class="description">Você certamente já ouviu a frase “Prevenir é melhor que remediar” inúmeras vezes. Quando se trata de garantir a saúde dos seus dentes e do seu sorriso, prevenção é a palavra-chave.</a>
				</div>

				<div class="info-content">
					<i class="fas fa-ambulance icon"></i>

					<a class="title">Emergências odontológicas</a>
					<a class="description">Você acordou com dor de dentes e isso está incomodando muito? Seu filho quebrou um dente ao cair do balanço? Você mordeu a língua ou os lábios e o sangramento persiste?</a>
				</div>
			</div>

			<!-- cadastrar email -->
			<div id="content-cadastrar-email">
				<a id="title">Cadastre seu email</a>
				<a id="description">Receba noticias sobre a Odonto Lar</a>
				<form>
					<input type="email">
					<input type="submit" value="cadastrar">
				</form>
			</div>
			
			<!-- ambiente -->
			<div id="ambiente">
			  <a class="title">Clínica odontológica na melhor localização</a>
			  <a class="description">
				A Clínica Odonto Lar é um espaço destinado a quem procura mais saúde, 
				mais qualidade de vida e um atendimento individualizado e personalizado. 
				Com atendimento diferenciado, nossos dentistas estão sempre buscando atender as necessidades e desejos de nossos pacientes. 
				Nosso compromisso é fornecer as melhores soluções para a saúde bucal, queremos oferecer uma experiência agradável e confortável. 
				A nossa clínica odontológica tem como missão a prestação de serviços com excelência, honestidade e qualidade. 
				A visão é de estar sempre apresentando as inovações e novas tecnologias do mercado. 
				E como seu maior valor têm o respeito pelas pessoas. 
				Nós queremos ver nossos pacientes sempre sorrindo!</a>
			  <img src="images/ambiente_01.jpg">
			  <img src="images/ambiente_02.jpg">
			</div>
			
			<!-- nossa equipe -->
			<div id="nossa-equipe">
			  <a class="title">Nossa equipe</a>
			  
			  <div class="content">
				<img src="images/dentista_01.png" class="photo">
				<a class="title">Dra. Cristiane</a>
			  </div>
			  
			  <div class="content">
				<img src="images/dentista_02.png" class="photo">
				<a class="title">Dr. Carlos</a>
			  </div>
			  
			  <div class="content">
				<img src="images/dentista_03.png" class="photo">
				<a class="title">Dr. Jailson</a>
			  </div>
			  
			  <div class="content">
				<img src="images/dentista_04.jpg" class="photo">
				<a class="title">Dra. Debora</a>
			  </div>
			  
			  <div class="content">
				<img src="images/dentista_05.jpg" class="photo">
				<a class="title">Dra. Maria</a>
			  </div>
			  
			  <div class="content">
				<img src="images/dentista_06.jpg" class="photo">
				<a class="title">Dra. Emilly</a>
			  </div>
			</div>
			
			<!-- contato -->
			<div id="contato">
			  <a class="title">Entre em contato conosco aqui</a>
			  
			  <form method="post" action="submit-email.php">
				<label for="name">Nome:</label>
				<input type="text" name="name">
				 
				<label for="email">Nome:</label>
				<input type="email" name="email">
				  
				<label for="message">Mensagem:</label>
				<textarea name="message" cols="50" rows="7"></textarea>
				
				<input type="submit" value="enviar">
			  </form>
			</div>
		</div>

		<footer>
			<a>&copy;Copyright Odonto lar - site desenvolvido por Gabriel Victor && Lucas Silva</a>
		</footer>		

		<!-- script -->
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
	</body>
</html>
