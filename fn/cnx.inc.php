<?php
#cnx settings

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("NAME", "clocker");
define("DOMINIO", "xXxXxXxXx");
#email settings

define("SERVIDOR_EMAIL", "smtp.gmail.com");
define("PUERTO_EMAIL", 587);
define("USUARIO_EMAIL", "Clocker.noreply@clocker.com");
define("CLAVE_EMAIL", "XxXxX");
define("NIVEL_ERROR", 2); // poner en cero en producción
define("FROM_EMAIL", "admin@Clocker.com");
define("NAME_EMAIL", "Clocker");

define("DEV_MODE", true);

// Mostrar errores siempre
ini_set("display_errors", DEV_MODE);
if (DEV_MODE) {
    error_reporting(E_ALL);
}
function conectarse()
{
    return new PDO("mysql:host=" . HOST . ";dbname=" . NAME, USER, PASS);
};