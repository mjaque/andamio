<?php
	/**
		Router del API REST de la aplicación.
		Su responsabilidad es procesar la petición HTTP para decidir a qué controlador llamar (routing).
		También identifica al usuario (autenticación).
		Es un interfaz RESTful (https://www.rfc-editor.org/rfc/rfc7231)
	**/
	//echo 'PHP version: ' . phpversion();die();

	//Cargamos la configuración
	$config = require_once('config.php');
	if ($config['debug']){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	}

	try{
		//Inyección de dependencias
		require_once('./servicios/bd.php');
		BD::$bd = $config['bd'];
		BD::$host = $config['host_bd'];
		BD::$usuario = $config['usuario_bd'];
		BD::$clave = $config['clave_bd'];
		
		//Peticiones especiales de depuración
		if ($config['debug']){
			if ($_SERVER['QUERY_STRING'] == 'cargarBDPruebas'){
				$salida = [];
				//Establecemos los locales
				$locale='es_ES.UTF-8';
				setlocale(LC_ALL,$locale);
				putenv('LC_ALL='.$locale);
				//echo exec('locale charmap');
				exec('mysql -u '.BD::$usuario.' --password='.BD::$clave.' '.BD::$bd.' < ../../sql/datos_prueba.sql', $salida);
				die('Cargada BD Pruebas.');
			}
		}

		//Procesamos la petición para identificar el recurso solicitado y sus parámetros
		$metodo = $_SERVER['REQUEST_METHOD'];
		$pathParams = explode('/', $_SERVER['PATH_INFO']);
		$queryParams = [];
		parse_str($_SERVER['QUERY_STRING'], $queryParams);
		$recurso = $pathParams[1];	//El primer elemento es la /.
		array_splice($pathParams, 0, 2);	//Quitamos la / y el recurso solicitado.
		//Procesamos los nulos
		for($i = 0; $i < count($pathParams); $i++)
			if ($pathParams[$i] == 'null')
				$pathParams[$i] = null;
		$body = json_decode(file_get_contents('php://input'));

		//Autenticación
		$usuario = null;
		require_once('./controladores/login.php');
		//Inyección de dependencias
		Login::$clave = $config['clave_encriptacion'];
		Login::$algoritmo_encriptacion = $config['algoritmo_encriptacion'];
		//Utilizamos Authorization2 en lugar de Authorization por un bug de NGINX que no transmite esa cabecera
		if(array_key_exists('Authorization2', apache_request_headers())){
			$autorizacion = apache_request_headers()['Authorization2'];
			if ($autorizacion != "null")
				$usuario = json_decode(Login::desencriptar($autorizacion));
		}

		//Logging
		if ($config['log']){
			require_once('./servicios/log.php');
			Log::registrar($usuario, $recurso, $metodo, $pathParams, $queryParams, $body);
		}

		//Routing
		$controlador = false;
		switch($recurso){
			case 'login':
				require_once('./controladores/login.php');
				$controlador = new Login();
				break;
			case 'login_google':
				require_once('./controladores/login_google.php');
				$controlador = new LoginGoogle();
				break;
			case 'controlador1':
				require_once('./controladores/controlador1.php');
				$controlador = new Controlador1();
				break;
			case 'controlador2':
				require_once('./controladores/controlador2.php');
				$controlador = new Controlador2();
				break;
			//Otros controladores
			default:
				header('HTTP/1.1 501 Not Implemented');
				die();
		}
		if ($controlador)
			switch($metodo){
					case 'GET':
						$controlador->get($pathParams, $queryParams, $usuario);
						die();
					case 'POST':
						$controlador->post($pathParams, $queryParams, $body, $usuario);
						die();
					case 'DELETE':
						$controlador->delete($pathParams, $queryParams, $usuario);
						die();
					case 'PUT':
						$controlador->put($pathParams, $queryParams, $body, $usuario);
						die();
					default:
						header('HTTP/1.1 501 Not Implemented');
						die();
			}
		else{
			header('HTTP/1.1 501 Not Implemented');
			die();
		}
	}catch(Throwable $excepcion){	//Throwable (interfaz) incluye Error y Exception
		header('HTTP/1.1 500 Internal Server Error 1');
		echo $excepcion;
		die();
	}
