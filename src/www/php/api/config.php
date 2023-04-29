<?php
	/**
		Fichero de configuración
	**/
	return array(
		'debug' => true,	//En modo debug se muestran los errores.
		'test' => true,		//En modo test, se permite el acceso a usuarios de test
		'log' => false,		//Indica si se genera el log de operaciones.
		
		//Parámetros de encriptación para el Login
		'algoritmo_encriptacion' => 'aes-256-ctr',
		'clave_encriptacion' => 'Clave de encriptación',

		//Parámetros de Base de datos
		'bd' => 'dualex',
		'host_bd' => 'localhost',
		'usuario_bd' => 'usuario',
		'clave_bd' => 'clave' //OJO a la última coma

		
		//Otros parámetros de configuración
	);
