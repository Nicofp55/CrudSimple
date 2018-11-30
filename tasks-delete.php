<?php
if (!isset($_SESSION)) {
	session_start();
	require_once "fn/users.inc.php";
	if(isset($_POST['tarea'])){
		print_r($_POST);
		$task= $_POST['tarea'];
		$taskUser = $_SESSION['user'];
		  require_once('fn/users.inc.php');
		(\users\deleteTask($task, $taskUser));
	}
}


