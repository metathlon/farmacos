<?php
/**
 * Gestión de cabecera de la paltaforma
 * 
 * Control de acceso a la página en función del usuario
 * 
 * @author Fernando Andrés Pretel
 */


//include_once("inc/dbConnect.inc.php");
include_once('classes/class.bd.php');

class cabecera
{
	var $css;
	var $bd;
	var $nivel;
	var $admin_lvl = 9;
	
	/**
	 * Constructor de la clase
	 */
	function __construct($css="style.css", $nivel="1")
	{
	
		include_once('inc/vars.php');
		session_start();	
		$this->css = $css;
		$this->nivel = $nivel;
		
		//conecting with DB
		$this->bd = new bd($mysql_bd_hostname,$mysql_bd_user,$mysql_bd_password,$mysql_bd_database);

		//$this->bd->debug();
		
		//Comprobando que el usuario tiene permisos para ver la página
		//nivel 0 reservado para las páginas publicas
		if ($nivel > 0)
		{
			//si no es una página publica se requiere identificación
			if (!$_SESSION['USER']) header('location:login.php');   
			else {
				if ($_SESSION['UNIVEL']<$nivel) echo "NO TIENE NIVEL PARA ACCEDER A ESTA PARTE DE LA WEB";
			}
		}
		
	}
	
	
	/**
	 * Cambia la hoja de estilos de la web
	 * @param unknown $nueva_css
	 */
	function set_css ($nueva_css)
	{
		if ($nueva_css) $this->css=$nueva_css;
	}
	
	
	
	function list_users()
	{
		include_once("inc/class.user.php");
		$lista_usuarios = $this->bd->get_user_list();
		if ($lista_usuarios == FALSE) echo "FALSE<br>";
		$cont = 0;
		//echo " USUARIO -->".$lista_usuarios[0]['apellidos'];
		foreach($lista_usuarios as $user)
		{
			$siguiente_user[$cont] = new user($user);
			echo $siguiente_user[$cont]->get_php_table();
		}
		
	}
	
	function get_php_code()
	{
		$codigo = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>";
		$codigo .= "<head>";
		$codigo .= "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'. />";
		$codigo .= "<title> TITULO NECESITAMOS UNO!!!! </title>";
		//$codigo .= "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>";
		$codigo .= "<style media='screen'></style>";
		$codigo .= "<link href='css/".$this->css."' rel='stylesheet' type='text/css' />";
		$codigo .= "</head>";
		return $codigo;
	}
}
?>