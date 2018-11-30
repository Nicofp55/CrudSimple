<?php
//--------------------------------------------------------------
// Recordar habilitar mi gmail para que permita enviar mails desde php:
// https://www.google.com/settings/security/lesssecureapps
//--------------------------------------------------------------
	

		require_once 'cnx.inc.php';	
		require 'lib/PHPMailer/PHPMailerAutoload.php';
		

		function enviar($toEmail, $toName, $asunto, $mensaje, $adjunto=false){
			
			date_default_timezone_set('America/Argentina/Buenos_Aires');
			
			// CONFIGURACION DE CASILLA			
			$mail = new PHPMailer();		// creo mi objeto de envio de emails
			$mail->isSMTP();				//Usar SMTP, el servidor que usa Gmail.	
			//$mail->SMTPDebug = NIVEL_ERROR; //Activar SMTP debugging
			$mail->Debugoutput = 'html';	//Errores mostrados con html			
			$mail->Host = SERVIDOR_EMAIL; 	//Servidor de correo			
			$mail->Port = PUERTO_EMAIL;		//Puerto SMTP			
			$mail->SMTPSecure = 'tls';		// ssl (deprecated) o tls			
			$mail->SMTPAuth = true;			// Con SMTP authentication, es decir, que requiere mi usuario y contraseña.		
			$mail->Username = USUARIO_EMAIL;//Usuario de gmail (el email completo)			
			$mail->Password = CLAVE_EMAIL;	//Password
			
			// ENVIO DE EMAIL
			$mail->setFrom(FROM_EMAIL, NAME_EMAIL);//Enviado por. Cuando el usuario responde el mail, se envia a este mail.		

			if(is_array($toEmail)){
				for($i=0;$i<count($toEmail);$i++){
					$mail->addAddress($toEmail[$i], $toName[$i]);	//Enviar a
				}					
			}
			else{
				$mail->addAddress($toEmail, $toName);	//Enviar a	
			}

				

			$mail->Subject = $asunto;				//Asunto	
			$mail->msgHTML($mensaje);				//Mensaje. Permite enviar un mensaje que tiene etiquetas HTML.			
			if($adjunto){

				if(isAssoc($adjunto)){
					$mail->addAttachment($adjunto['tmp_name'],$adjunto['name']);					
				}
				else{
					for($i=0;$i<count($adjunto);$i++){
						$mail->addAttachment($adjunto[$i]['tmp_name'],$adjunto[$i]['name']);
					}
				}
				
			}			
		
			if (!$mail->send()) { // con send se envia el email.
				return $mail->ErrorInfo;			
			}
			else{
				return true;
			}
		}
	

		function isAssoc(array $arr){
		    if (array() === $arr) return false;
		    return array_keys($arr) !== range(0, count($arr) - 1);
		}