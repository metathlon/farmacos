<?php
class user{
	
	var $id;
	var $nombre;
	var $apellidos;
	var $email;
	var $telefono;
	var $nivel;
	var $fechaNacimiento;

	
	/**
	 * Crea un usuario con la información de la base de datos
	 * 
	 * @param mysql_results $info
	 */
	function __construct($info)
	{
		$this->id = $info['id'];
		$this->nombre = $info['nombre'];
		$this->apellidos = $info['apellidos'];
		$this->email = $info['email'];
		$this->nivel = $info['nivel'];
		if ( $info['telefono'])	$this->telefono = $info['telefono'];
		if ($info['fechaNacimiento']) $this->fechaNacimiento = $info['fechaNacimiento'];
	}
	
	function texto_nivel($nivel)
	{
		switch($nivel)
		{
			case 0: return "Registrado";
					break;
			case 1: return "Cliente";
					break;
			case 2: return "Colaborador";
					break;
			case 3: return "Administrador";
					break;
			default: return FALSE;
		}
	}
	
	
	function get_php_table()
	{
		$table = "<tr>";
		$table .= "<td>".$this->email."</td>";
		$table .= "<td class='edit_text' id='nombre".$this->id."'>".$this->nombre."</td>";
		$table .= "<td class='edit_text' id='apellidos".$this->id."'>".$this->apellidos."</td>";
		$table .= "<td class='edit_text' id='telefono".$this->id."'>".$this->telefono."</td>";
		$table .= "<td class='edit_nivel' id='nivel".$this->id."'>".$this->texto_nivel($this->nivel)."</td>";
	//	$table .= "<td> <button id='editaUser'>Create new user</button></td>";
		$table .= "</tr>";
		
		return $table;
	}
	
	function __toString()
	{
		$usuario = "<table> <thead> <th>ID</th><th>email</th><th>Nombre</th> <th>Apellidos</th></thead><tbody>";
		$usuario = "<tr>";
		$usuario .= "<td>".$this->id."</td>";
		$usuario .= "<td>".$this->email."</td>";
		$usuario .= "<td>".$this->nombre."</td>";
		$usuario .= "<td>".$this->apellidos."</td>";
		$usuario .= "</tr></tbody></table>";
		return $usuario;
	}

	
}
?>