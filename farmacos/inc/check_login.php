<?php

session_start ();
include ('../classes/class.bd.php');
include ('../inc/vars.php');
$bd = new bd($mysql_bd_hostname,$mysql_bd_user,$mysql_bd_password,$mysql_bd_database);
/*
 * If the user loged with google
*/
if ($bd->login_user($_POST['user'], $_POST['pass']))
{
	$user_info = $bd->get_user($_POST['user']);
	
	
	
	if ($user_info == FALSE)
	{
	//	echo "USER NO EXISTE <br>";
	/*	$bd->add_user($email,$nombre,$apellidos);
		echo "USER CREADO <br>";
		$user_info = $bd->get_user($email);
		*/
		header ( 'location:../login.php?error=2' );
	}
	else 
	{
		$_SESSION ['ID'] = $user_info['IdUsuario'];
		$_SESSION ['USER'] = $_POST['user'];
		$_SESSION ['UNIVEL'] = $user_info['Nivel'];
		$_SESSION ['UEMAIL'] = $user_info['Mail_usuario'];
		header ( 'location:../index.php' );
		echo "USER: ".$_SESSION['USER']."  LEVEL: ".$_SESSION['UNIVEL'];
	}
	
}
else header ( 'location:../login.php?error=1' );

//echo "USER: ".$_POST['user']."   PASS: ".$_POST['pass'];
?>