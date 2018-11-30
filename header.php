<?php
if(!isset($_SESSION)){
	session_start();
}
if(isset($_POST["userReg"])){
	require "register.php";

}
if(isset($_POST["emailLog"])){
	require_once "fn/users.inc.php";
	$email = $_POST["emailLog"];
	$clave = $_POST["passLog"];
	\users\login($email,$clave);

}

$opciones = '';
if(isset($_SESSION["id_usuario"])){
	$user = $_SESSION["user"];
	$opciones .= "&nbsp;|&nbsp;
							<li>$user</li>&nbsp;|&nbsp;
							<li><a href=\"logout.php\">Salir</a></li>";
	
}						
else{
	$opciones .= '&nbsp;|&nbsp;
							<div class="dropdown"><li id="showLog" class="dropdown" data-toggle="dropdown"><a href="#">Ingresar</a></li>
							<ul class="dropdown-menu dropdown-menu custom mt-2 ml-4">
				   <li class="px-3 py-2">
					   <form class="form" role="form" method="post" action="">
							<div class="form-group">
								<input id="emailLog" name="emailLog" placeholder="Email" class="form-control form-control-sm" type="text" required="">	
							</div>
							<div class="form-group">
								<input id="passLog" name="passLog" placeholder="Password" class="form-control form-control-sm" type="password" required="">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Login</button>
							</div>
							</form>						
					</li>
				</ul>
				</div>
				&nbsp;|&nbsp;
							<div class="dropdown"><li id="showLog" class="dropdown" data-toggle="dropdown"><a href="#">Registrarse</a></li>
							<ul class="dropdown-menu dropdown-menu-right mt-2">
				   <li class="px-3 py-2">
					   <form class="form" role="form" method="post" action="">
					   <div class="form-group">
								<input id="userReg" name="userReg" placeholder="Usuario" class="form-control form-control-sm" type="text" required="">
								</div>
							<div class="form-group">
								<input id="emailReg" name="emailReg" placeholder="Email" class="form-control form-control-sm" type="email" required="">
							</div>
							<div class="form-group">
								<input id="passReg" name="passReg" placeholder="Password" class="form-control form-control-sm" type="password" required="">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Registrarse</button>
							</div>
							<div class="form-group text-center">
							</div>
						</form>
					</li>
				</ul>
				</div>';
}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Clocker</title>
	<link rel="stylesheet" href="https://bootswatch.com/4/slate/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<nav class= " navbar navbar-expand-sm justify-content-between  navbar-dark bg-secondary">
		<div class= "navbar-header" >
			<h1>Clocker</h1>
		</div>
		<ul class="navbar-nav navbar-right px-3">
			<?= $opciones; ?>
		</ul>
	</nav>

			