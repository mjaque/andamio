<?php
	/**
		DAO de Usuario.
		Objeto para el acceso a los datos relacionados con usuarios.
	**/

require_once('./modelos/usuario.php');


class DAOUsuario{
	/**
		Consulta la base de datos para autenticar al usuario y devolver sus datos.
		El email ha sido autenticado por Google.
		@param $login Login Modelo de login.
		@return Usuario Devuelve los datos del usuario o false si no existe el usuario.
	**/
	public static function autenticarLogin($login){
		$usuario = new Usuario();

		$sql  = 'SELECT ...';
		$sql .= 'WHERE usuario = :usuario AND clave = PASSWORD(:clave)';

		$params = array('usuario' => $login->usuario, 'clave' => $login->clave);
		$resultado = [];
		//$resultado = BD::seleccionar($sql, $params);
		
		return DaoUsuario::crearUsuario($resultado);
	}
	/**
		Consulta la base de datos para autenticar al usuario y devolver sus datos.
		El email ha sido autenticado por Google.
		@param $email Email del usuario.
		@return {Usuario} Devuelve los datos del usuario o false si no existe el usuario.
	**/
	public static function autenticarEmail($email){
		
		$sql  = 'SELECT ...';
		$sql .= 'WHERE email = :email';

		$params = array('email' => $email);
		$resultado = [];
		//$resultado = BD::seleccionar($sql, $params);

		return DaoUsuario::crearUsuario($resultado);
	}

	private static function crearUsuario($resultSet){
		$usuario = new Usuario();
		
		if (count($resultSet) == 1){
			//Asignamos los datos del usuario a $usuario
			$usuario->id = $resultSet[0]['id'];
			$usuario->email = $resultSet[0]['email'];
			$usuario->nombre = $resultSet[0]['nombre'];
			$usuario->apellidos = $resultSet[0]['apellidos'];
			//...
		}
		else
			$usuario = false;
		
		//Simulación
		$usuario = new Usuario();
		$usuario->id = 42;
		$usuario->email = 'prueba@prueba.com';

		return $usuario;
	}
}
