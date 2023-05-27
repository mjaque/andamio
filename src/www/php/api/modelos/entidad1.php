<?php
/**
  Modelo de Entidad1.
**/
namespace Modelos;

class Entidad1{
	public $campo1 = null;
	public $campo2 = null;

	static function seleccionar($parametros, $usuario){
		//Creamos la sentencia SQL
		$sql = 'SELECT ... :campo1 ... ';

		//Enlazamos los parámetros de la consulta
		$params = array('campo1' => $parametros->campo1, 'idUsuario' => $usuario->id);

		return BD::seleccionar($sql, $params);
	}

	static function insertar($entidad1, $usuario){
		//Si hace falta, iniciamos una transacción SQL
		if (!BD::iniciarTransaccion())
			throw new Exception('No es posible iniciar la transacción.');

		//Creamos la sentencia SQL
		$sql = 'INSERT ... :campo1 ... ';

		//Enlazamos los parámetros de la consulta
		$params = array('campo1' => $entidad1->campo1, 'idUsuario' => $usuario->id);

		$idNuevo = BD::seleccionar($sql, $params);

		if (!BD::commit())
			throw new Exception('No se pudo confirmar la transacción.');

		return $idNuevo;
	}
}
