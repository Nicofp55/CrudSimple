<?php
namespace users {
	use \PDO;

	require_once "cnx.inc.php";
	function alta($user, $email, $clave, $token)
	{

		$clave = password_hash($clave, PASSWORD_DEFAULT);
		$activo = 0;

		$query = "INSERT INTO usuarios
			(user, email, pass, token, activo)
			VALUES 
			(:u, :e, :p, :t, :a)
		";
		$cnx = conectarse();
		$consulta = $cnx->prepare($query);
		$consulta->bindParam(":u", $user, PDO::PARAM_STR);
		$consulta->bindParam(":e", $email, PDO::PARAM_STR);
		$consulta->bindParam(":p", $clave, PDO::PARAM_STR);
		$consulta->bindParam(":t", $token, PDO::PARAM_STR);
		$consulta->bindParam(":a", $activo, PDO::PARAM_INT);
		return $consulta->execute();
	}
	function activar($token)
	{
		$query = "UPDATE usuarios
		          SET activo = 1
				  WHERE token = :t
		          ";
		$cnx = conectarse();
		$consulta = $cnx->prepare($query);
		$consulta->bindParam(':t', $token, PDO::PARAM_STR);
		return $consulta->execute();

		// if($resultado){
		// 	return "Su usuario fue activado";
		// }   
		// else{
		// 	return "Su usuario NO pudo ser activado";
		// }       

	}
	function login($email, $clave)
	{
		$query = "SELECT *
				  FROM usuarios
				  WHERE email = '$email'
				  AND activo = 1
				  LIMIT 1
		";

		$cnx = conectarse();
		$usuarios = $cnx->prepare($query);
		$usuarios->execute();
		$resultado = $usuarios->fetch(PDO::FETCH_ASSOC);

		$respuesta = "Email y/o clave incorrecta.";

		if (password_verify($clave, $resultado['pass'])) {
			$respuesta = true;

			$_SESSION["user"] = $resultado["user"];
			$_SESSION["email"] = $resultado["email"];
			$_SESSION["id_usuario"] = $resultado["idusuario"];


			return $respuesta;
		}
	}
	function loadTasks()
	{
		$user = $_SESSION["user"];
		$query = "
					SELECT t.tarea, t.hora 
					FROM tareas t 
					LEFT JOIN usuarios u ON (t.idusuario = u.idusuario) 
					WHERE u.user= :u
					";
		$cnx = conectarse();
		$consulta = $cnx->prepare($query);
		$consulta->bindParam(':u', $user, PDO::PARAM_STR);
		$consulta->execute();
		$result = $consulta->fetchAll(PDO::FETCH_ASSOC);
		$jsonstring = json_encode($result);
		return $jsonstring;
	}
	function saveToDb($tarea, $hora)
	{
		$user = $_SESSION["user"];
		$query = "
						INSERT INTO tareas
						(Tarea, Hora, idusuario)
						VALUES
						(:t, :h, (SELECT idusuario FROM usuarios WHERE user = :u))
					
		";
		$cnx = conectarse();
		$consulta = $cnx->prepare($query);
		$consulta->bindParam(":t", $tarea, PDO::PARAM_STR);
		$consulta->bindParam(":h", $hora, PDO::PARAM_STR);
		$consulta->bindParam(":u", $user, PDO::PARAM_STR);
		$consulta->execute();
	}
	function deleteTask($tarea, $user){
		$query = "
						DELETE FROM tareas
						WHERE Tarea = :t AND (SELECT idusuario FROM usuarios WHERE user = :u)
						";
		$cnx = conectarse();
		$consulta = $cnx->prepare($query);
		$consulta->bindParam(":t", $tarea, PDO::PARAM_STR);
		$consulta->bindParam(":u", $user, PDO::PARAM_STR);
		$consulta->execute();
						
	}
}