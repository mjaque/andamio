<?php
/**
	Controlador de autenticación.
**/

require_once('./daos/daousuario.php');
require_once('./modelos/usuario.php');

class Login{
	//Se configura por inyección de dependencias
	public static $clave = null;
	public static $algoritmo_encriptacion = null;
	public static $iv = '16 bits aleators';
	
	/**
		Autentifica al usuario con el email y la clave.
		Devuelve por HTTP el objeto usuario en formato JSON.
		@param $pathParams No utilizado.
		@param $queryParams No utilizado.
		@param $login Datos de login (usuario y clave).
	**/
	function post($pathParams, $queryParams, $login){
		global $config;
		$usuario = DAOUsuario::autenticarLogin($login);
		sleep(1);
		if (!$usuario){
      		header('HTTP/1.1 401 Unauthorized');
      		die();
    	}
		//Completamos los datos del usuario
		$usuario->autorizacion = openssl_encrypt(json_encode($usuario), self::$algoritmo_encriptacion, self::$clave, 0, self::$iv);
    	//print_r(openssl_get_cipher_methods()); //Muestra los algoritmos de encriptación disponibles

		header('Content-type: application/json; charset=utf-8');
    	header('HTTP/1.1 200 OK');
    	echo json_encode($usuario);
    	die();
	}
	/**
		Desencripta un mensaje.
		@param {String} $mensaje El texto del mensaje a desencriptar.
		@return {String} Texto del mensaje desencriptado o false si no se pudo desencriptar.
	**/
	public static function desencriptar($mensaje) {
			return openssl_decrypt($mensaje, self::$algoritmo_encriptacion, self::$clave, 0, self::$iv);
	}
}