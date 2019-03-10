<!-- side nav -->
		<div class="sidenav">
			<a href="javascript:void(0)" id="closeButton" onclick="hideSidenav();">&times;</a>
			<ul>
				<li><a href="index.php#">Inicio</a></li>
				<li><a href="index.php#servicos">Serviços</a></li>
				<li><a href="index.php#ambiente">Sobre</a></li>

				<?php
					if(!isset($_COOKIE["logged"])) {
						echo '<li><a href="_login.php" class="login-item">Login</a></li>';
						echo '<li><a href="_cadastrar.php" class="cadastrar-item">Cadastrar</a></li>';
					} else {
						echo '<li class="login-item" id="menu-login"><a href="client-perfil.php"  class="login-item">Perfil</a></li>';
						echo '<li class="login-item" id="menu-cadastrar"><a href="logout.php">Sair</a></li>';
					}
				?>
			</ul>
		</div>
		
		<!-- menu -->
		<nav class="menu">
			<ul>
				<?php
					if(!isset($_COOKIE["app"])) {
				?>
				<li class="menu-item"><a href="index.php#">Inicio</a></li>
				<li class="menu-item"><a href="index.php#servicos">Serviços</a></li>
				<li class="menu-item"><a href="index.php#ambiente">Sobre</a></li>
				<?php
					}
				?>


				<?php 
					if(!isset($_COOKIE["logged"])) {
						echo '<li class="menu-item" id="menu-login"><a href="_login.php" class="login-item">Login</a></li>';
						echo '<li class="menu-item" id="menu-cadastrar"><a href="_cadastrar.php" class="cadastrar-item">Cadastrar</a></li>';
					} else {
						if(!isset($_COOKIE["app"])) {
							echo '<li class="menu-item" id="menu-cadastrar"><a href="logout.php">Sair</a></li>';
							echo '<li class="menu-item" id="menu-login"><a href="client-perfil.php" class="login-item">Perfil</a></li>';
						}
					}

				if(!isset($_COOKIE["app"])) {
				  echo '<li class="menu-side"><i class="fas fa-bars" onclick="showSidenav();"></i></li>';
			    } else {
				  echo '<li id="menu-cadastrar"><a href="logout.php">Sair</a></li>';
				}
				?>
			</ul>
		</nav>