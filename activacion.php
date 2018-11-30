<?php
	require "fn/users.inc.php";
	$token = $_GET["code"];
	\users\activar($token);

header("Location: clocker.php");
exit();