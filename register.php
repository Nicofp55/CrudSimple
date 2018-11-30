<?php
// Registry form data
		
		$userReg = $_POST["userReg"];
		$emailReg = $_POST["emailReg"];
		$passReg = $_POST["passReg"];
		
		require_once "fn/validations.inc.php";
		//validations
		 $errors = FALSE;

		if(!\validations\user($userReg) || !\validations\email($emailReg) ||  !\validations\pass($passReg)){
			$errors = TRUE;
			
		}

		if($errors === FALSE){			
			
			require "fn/users.inc.php";
			require "fn/email.inc.php";

			// generar un usuario en la base de datos (inactivo)
			$token = password_hash($emailReg, PASSWORD_DEFAULT); // identificador unico con hash
			if(\users\alta($userReg, $emailReg, $passReg, $token)){
				
				$url_activacion = DOMINIO."/activacion.php?code=$token";

				$message = "<h1>Howdy $userReg !</h1>
						    <p>Activate your account clicking on the next link:</p>
							<a href=\"$url_activacion\">Activate Acount</a>

							If the link doesn't work copy and paste this in browser: $url_activacion
							";

				// enviar un email para validar la cuenta
				enviar($emailReg, 
					   $userReg, 
					   "Activate your account", 
					   $message
					  );
				header("Location: clocker.php");
			}
			else{
				echo "error"; exit;
			}
		}

?>