<?php
/**###################################################
* Clase de control de BD para prometeo
*
* @author Fernando Andrés Pretel
###################################################*/
include ("class.error.php");
class bd
{
	/**
	* Url del servidor BD
	* @var string
	*/
	var $bd_host;
	
	/**
	* Usuario para el servidor BD
	* @var string
	*/
	var $bd_user;
	
	/**
	* Password del servidor BD
	* @var string
	*/
	var $bd_pass;
	
	/**
	* Base de datos sobre la que operar
	* @var string
	*/
	var $bd;
	
	/**
	* Bd link. Este link es más costoso tenerlo activo que cerrarlo tras cada consulta, con lo que debe ser un recurso poco usado
	* @var string
	*/
	var $bd_link;
	
	
	
	
	/**=====================================================
	* Constructor
	* 
	* @param host URL al servidor de la BD
	* @param user Usuario de conexion con la BD
	* @param pass Clave para conectar con el servidor
	* @param bd Nombre de la base de datos
	*
	* @return -1 (recibido de conecta_bd) ERROR en la conexion
	* @return -2 (recibido de conecta_bd) ERROR en la seleccion de la BD
	* @return TRUE si todo es correcto
	* @return FALSE si ocurre algo fuera de lo ya indicado
	*=====================================================*/
	function bd($host,$user,$pass,$bd)
	{
		$link = $this->conecta_bd($host,$user,$pass,$bd);
		if ($link->objeto_tipo_error != TRUE)
		{
			$this->bd_host=$host;
			$this->bd_user=$user;
			$this->bd_pass=$pass;
			$this->bd=$bd;
			$this->bd_link=$link;
			
		//	$this->cierra_bd($link); //cerramos la conexion una vez que sabemos que funciona correctamente
			return TRUE;
		}
		else 
		{
			//$this->cierra_bd($link); //cerramos la conexion
			return new error(__FILE__."-->".__LINE__,'Error en la conexion con la BD',$link);
			
		}
		
		return new error(__FILE__."-->".__LINE__,'Error en la conexion con la BD');	//error por defecto
		
	}
	
	/**============================================
	* Funcion que agrupa las operaciones de 
	*  -Conexion con la BD
	*  -Seleccion de la BD
	* 
	* @param host URL al servidor de la BD
	* @param user Usuario de conexion con la BD
	* @param pass Clave para conectar con el servidor
	* @param bd Nombre de la base de datos
	*
	* @return -1 ERROR en la conexion
	* @return -2 ERROR en la seleccion de la BD
	* @return link si todo es correcto
	*=============================================*/
	function conecta_bd($host,$user,$pass,$bd)
	{
		/*
		$link=$this->conexion_bd($host,$user,$pass);
		if ($link->objeto_tipo_error == TRUE) return new error(__FILE__."-->".__LINE__,'Error en la conexion con la BD',$this->bd_link);
		else if ($this->seleccion_bd($link,$bd)->objeto_tipo_error ==TRUE) return new error(__FILE__."-->".__LINE__,'Error en la seleccion de la  BD',$this->seleccion_bd($link,$bd));
		else return $link; //TODO OK!
		*/
		//echo $bd;
		$con = mysql_connect($host, $user, $pass) or die("No se ha podido CONECTAR a la base de datos");
		mysql_select_db($bd, $con) or die("Se ha conectado con el servidor pero NO SE HA PODIDO seleccionar base de datos");
		return $con;
		//return new error(__FILE__."-->".__LINE__,'Error en la conexion con la BD');//error por defecto
	}
	
	/**============================================
	* Cierra la conexión con la BD
	* 
	* @param conexion link de la conexion a la bd
	* @return True
	*=============================================*/
	function cierra_bd($conexion)
	{
		mysql_close($conexion);
		return True;
	}
	

	/**============================================
	* Función de conexion con la BD.
	*
	* @param host url del servidor
	* @param user usuario del servidor
	* @param pass password del servidor
	* @return -1 en caso de error, la conexion en caso de exito
	*=============================================*/
	function conexion_bd($host,$user,$pass)
	{
		$conexion=mysql_connect($host,$user,$pass);
		if (!$conexion) return new error(__FILE__."-->".__LINE__,'La conexion con la BD ha sido imposible');
		else return $conexion;
		
		//devuelve error por defecto
		return new error(__FILE__."-->".__LINE__,'Error en la conexion con la BD');
		
	}//fin funcion de conexion 
	
	
	/**============================================
	* Función para la selección de la bd
	* 
	* @param bd nombre de la base de datos
	* @param conexion link de la conexion abierta
	*=============================================*/
	function seleccion_bd($conexion,$bd)
	{
		if (!mysql_select_db($bd,$conexion)) return new error(__FILE__."-->".__LINE__,'Error en la seleccion de la BD',$this->bd_link);
		else return $conexion;
	}
	

	
	/**
	 * Devuelve la información asociada al usuario con su nombre de usuario
	 * 
	 * @param string $user
	 * @return usuario (class.user.php):
	 */
	function get_user($user)
	{
		$sql = "SELECT * FROM user_farmacos WHERE Login_Usuario = '$user'";
		$sql_user = mysql_query ( $sql );
		$user_info = mysql_fetch_assoc($sql_user);
		if ($user_info != FALSE) return $user_info;
		else return FALSE;
		
	}
	
	/**
	 * Obtiene toda la información de los usuarios de la base de datos
	 * @return multitype:|boolean
	 */
	function get_user_list()
	{
		$sql = "SELECT * FROM users";
		$sql_users = mysql_query ( $sql );
		$cont = 0;
		//echo "SUARIO -->".$sql_users."<br>";
		while ($user = mysql_fetch_array($sql_users, MYSQL_ASSOC)) {
			 $lista_users[$cont]["id"] = $user["id"];
			 $lista_users[$cont]["email"] = $user["email"];
			 $lista_users[$cont]["nombre"] = $user["nombre"];
			 $lista_users[$cont]["apellidos"] = $user["apellidos"];
			 $lista_users[$cont]["telefono"] = $user["telefono"];
			 $lista_users[$cont]["fechaNacimiento"] = $user["fechaNacimiento"];
			 $lista_users[$cont]["nivel"] = $user["nivel"];
			 $cont++;
		}
		//si hay al menos uno
		if ($lista_users[0]["email"]) return $lista_users;
		else return FALSE;
	
	}
	
	
	
	
	/**
	 * Crea un usuario en la tabla users
	 *
	 * @param string $nombre
	 * @param string $mail
	 */
	function add_user($mail,$nombre,$apellidos)
	{
		
		$sql = "INSERT INTO users(email,nivel,fechaEntrada,nombre,apellidos) values('$mail','2',now(),'$nombre','$apellidos')";
		$resultado = mysql_query ( $sql );
		//echo "DEENTRO ADD USER -->".$resultado."<br>";
		/*
		 * now if the users database is empty, this is de very first user and so becames admin
		*/
		
		$user = $this->get_user($email);
		
		$ID = $user['id'];
	
		if ($ID == 1) {
			$sql = "UPDATE users SET lvl = 3 WHERE email = '".$mail."'";
			mysql_query ( $sql );
		}
	}
	
	/**
	 * Identificación de usuario
	 * @param String $user
	 * @param CodedString $pass
	 * @return boolean
	 */
	function login_user($user,$pass)
	{
		$sql = "SELECT * FROM user_farmacos WHERE Login_Usuario='".$user."' and Password_Usuario=password('".$pass."')";
		$result = mysql_query($sql);
		$num = mysql_numrows($result);
		if ($num > 0) return TRUE;
		else return FALSE;
	}
	
	/**
	 * Creación BASICA de usuarios
	 * @param unknown $user
	 * @param unknown $pass
	 */
	function crea_user($user,$pass)
	{
		$sql = "INSERT INTO user_farmacos (Login_Usuario, Password_Usuario) values('".$user."',password('".$pass."'))";
		$result = mysql_query($sql);
	}

	
	
	/**
	 * 
	 * @param unknown $mail
	 * @param unknown $nombre
	 * @param unknown $apellidos
	 * @param unknown $telefono
	 * @param unknown $nivel
	 */
	function update_user($mail,$nombre,$apellidos,$telefono,$nivel)
	{
		$sql = "UPDATE users SET email = '".$email."' apellidos='".$apellidos."' telefono='".$telefono."' nivel='".$nivel."'";
		$resultado = mysql_query($sql);
	}

	
	/*===================================================================================================================
	 * ------------------------ MUTACIONES ------------------------------------------------------------------------------
	 ====================================================================================================================*/
	function comprueba_diana_comun($id_diana){
		$query_farmacos = "select id_farmaco from farmacos_inv_diana where id_diana='".$id_diana."'";
		$resultado = mysql_query($query_farmacos);
		if ($resultado){
			$numero_farmacos=mysql_num_rows($resultado);
			if($numero_farmacos == 0) {
				return 0;
			} else {
				return 1;
			}
		}else{
			return 0;
		}
	}
	
	function numero_mutaciones_pathway($id_pathway){
	
		$query_mutaciones="select id_mutacion from mutaciones_pathways where id_pathway='".$id_pathway."'";
		$resultado = mysql_query($query_mutaciones);
		if ($resultado){
			$numero_mutaciones=mysql_num_rows($resultado);
			return $numero_mutaciones;
		}else{
			return 0;
		}
	
	}
	
	function lista_pathways($id_mutacion)
	{
		$query_pathways= "select mutaciones_pathways.id_pathway,nombre_pathway,id_external from mutaciones_pathways,pathways where mutaciones_pathways.id_pathway=pathways.id_pathway and id_mutacion='".$id_mutacion."'";
		$resultado = mysql_query($query_mutaciones);
		return $resultado;
	}
	
	function lista_tumores($id_mutacion)
	{
		$query_tumores= "select tejidos_n0.id_tejido_n0,tejidos_n0.nombre_tejido_n0,tejidos_n1.id_tejido_n1,nombre_tejido_n1,
							histologia_n0.id_histologia_n0,nombre_histologia_n0,
							histologia_n1.id_histologia_n1,nombre_histologia_n1,numero_mutaciones
						from mutaciones_tumores,tejidos_n1,tejidos_n0,histologia_n0,histologia_n1
						where mutaciones_tumores.id_tejido_n1=tejidos_n1.id_tejido_n1 and tejidos_n1.id_tejido_n0=tejidos_n0.id_tejido_n0 and mutaciones_tumores.id_histologia_n0=histologia_n0.id_histologia_n0 and  mutaciones_tumores.id_histologia_n1=histologia_n1.id_histologia_n1 and id_mutacion='".$id_mutacion."'";
		$resultado = mysql_query($query_tumores);
		return $resultado;
		
	}
	
	
	
	function sql_query($sql)
	{
		$resultado = mysql_query($sql);
	}
	
	/**=======================================================
	* Funcion para mostrar las variables del objeto
	*=========================================================*/
	function debug()
	{
		echo "<p></p><br> DEBUG PARA EL OBJETO BASE DE DATOS </br>";
		echo "<br> bd_host --> ".$this->bd_host."  </br>";
		echo "<br> bd_user --> ".$this->bd_user."  </br>";
		echo "<br> bd_pass --> ".$this->bd_pass."  </br>";
		echo "<br> bd --> ".$this->bd."  </br>";
		echo "<br> bd_link --> ".$this->bd_link."  </br>";
	}
}
?>
