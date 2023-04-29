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
	public static function autenticar($login){
		$usuario = new Usuario();

		$sql  = 'SELECT ...';

		$params = array('usuario' => $login->usuario, 'clave' => $login->clave);
return $usuario;
		$resultado = BD::seleccionar($sql, $params);
		if (count($resultado) == 1){
			//Asignamos los datos del usuario a $usuario
			$usuario->id = $resultado[0]['id'];
			$usuario->rol = 'rol';
			$usuario->nombre = $resultado[0]['nombre'];
			$usuario->apellidos = $resultado[0]['apellidos'];
			//...
		}
		else
			$usuario = false;

		return $usuario;
	}
}
