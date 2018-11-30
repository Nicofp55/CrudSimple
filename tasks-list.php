<?php
if (!isset($_SESSION)) {
	session_start();
}
require_once "fn\users.inc.php";
echo (\users\loadTasks());
