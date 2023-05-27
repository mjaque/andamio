<?php
/**
	Controlador1.
**/
namespace Controladores;

require_once('./modelos/entidad1.php');

class Entidad1{
	/**
		Descripción del método.
		@param $pathParams {Array} Array de parámetros del path.
		@param $queryParams {Array} Array de parámetros de query.
		@param $usuario {Usuario} Usuario identificado.
		@return {Array} Devuelve un array con los recursos solicitados.
	**/
	function get($pathParams, $queryParams, $usuario){
		header('HTTP/1.1 501 Not Implemented');
		die();
	}
	/**
		Descripción del método.
		@param $pathParams {Array} Array de parámetros del path.
		@param $queryParams {Array} Array de parámetros de query.
		@param $body {Object} Objeto con los datos recibidos en el cuerpo de la petición.
		@param $usuario {Usuario} Usuario identificado.
		@return {Number} Identificador del recurso insertado.
	**/
	function post($pathParams, $queryParams, $body, $usuario){
		//Control de Acceso
		//if ($usuario) ...

		//Control de valores nulos
		if ($body->campo1 === "null")
			$body->campo1 = null;

    $id = \Modelos\Entidad1::insertar($body, $usuario);
    //Respuesta a un POST
    header('HTTP/1.1 201 Created');
    $localizacion = '/entidad1/'.$id; //Localización del nuevo recurso
    echo $localizacion;
    die();
	}
}
