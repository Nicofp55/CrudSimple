<?php
if (!isset($_SESSION)) {
	session_start();
}
	include_once('fn/cnx.inc.php');
	if(isset($_POST['tarea'])){
		$task= $_POST['tarea'];
		$taskHour = $_POST['hora'];
		  require_once('fn/users.inc.php');
		(\users\saveToDb($task, $taskHour));
	}
