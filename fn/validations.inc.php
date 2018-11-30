<?php
namespace validations {

	function user($u)
	{
		$u = trim($u);
		$u = htmlspecialchars($u);
		$size = strlen($u);
		if ($size > 2 && is_string($u)) {
			return true;
		}
		return false;
	}

	function pass($p)
	{
		$p = htmlspecialchars($p);
		$p = trim($p);
		$size = strlen($p);
		if ($size > 2 && is_string($p)) {
			return true;
		}
		return false;
	}

	function email($e)
	{

		$expresion = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

		if (preg_match($expresion, $e)) {
			return true;
		}

		return false;
	}

}