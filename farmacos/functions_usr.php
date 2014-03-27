<?php
//include ("inc/login.php"); 
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",0);
echo $cabecera->get_php_code();

include ("inc/config.php");

function filtrar_texto($cadena_texto){
$cadena_texto = str_replace("'", '', $cadena_texto);
$cadena_texto = str_replace('"', '', $cadena_texto);
return $cadena_texto;
}
function convierte_numero($cadena_texto){
$cadena_texto = str_replace(",", '.', $cadena_texto);
$numero_retornado = 1 * $cadena_texto;
return $numero_retornado;
}

function fecha($fecha)  {
	$year=substr($fecha,6,4);
	$mes=substr($fecha,3,2);
	$dia=substr($fecha,0,2);
	$fecha_nueva=$year."-".$mes."-".$dia;
	return $fecha_nueva;
}




if (!isset($_REQUEST['op'])){
$op="xx";
}else{
$op=$_REQUEST['op'];
}

mysql_select_db($basedatos,$connect);
switch($op) {
    default:
   	echo $_REQUEST['op'];
    break;
     
     
	 case "auf": 
	
	$login_usuario=filtrar_texto($_POST['login_usuario']);
	$password_usuario=filtrar_texto($_POST['password_usuario']);
	$nivel_usuario=filtrar_texto($_POST['nivel_usuario']);
	$mail_usuario=filtrar_texto($_POST['mail_usuario']);
	$Empresa=filtrar_texto($_POST['Empresa']);
	$Nombre_completo=filtrar_texto($_POST['Nombre_completo']);
	$query_auf= "insert into user_farmacos(Login_Usuario,Password_Usuario,Nivel,Mail_usuario,Nombre_completo,Empresa,Fecha_alta,Fecha_ultimo_login,Activo) 
	values ('".$login_usuario."',password('".$password_usuario."'),'".$nivel_usuario."','".$mail_usuario."','".$Nombre_completo."','".$Empresa."',date(now()),date(now()),1)";
	//echo $query_auf;
	$result1 = mysql_query($query_auf, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	
     
     case "euf": 
	$id_usuario=filtrar_texto($_POST['id_usuario']);
	$login_usuario=filtrar_texto($_POST['login_usuario']);
	$password_usuario=filtrar_texto($_POST['password_usuario']);
	$nivel_usuario=filtrar_texto($_POST['nivel_usuario']);
	$mail_usuario=filtrar_texto($_POST['mail_usuario']);
	$Empresa=filtrar_texto($_POST['Empresa']);
	$Nombre_completo=filtrar_texto($_POST['Nombre_completo']);
	$Fecha_alta=filtrar_texto($_POST['Fecha_alta']);
	$Fecha_ultimo_login=filtrar_texto($_POST['Fecha_ultimo_login']);
	$radio_activo=filtrar_texto($_POST['radio_activo']);
	$radio_cambiar=$_POST['radio_cambiar'];
	
	
	if ($radio_cambiar==1){
	$query_euf="update user_farmacos  set 
	Login_Usuario='".$login_usuario."',
	Password_Usuario=password('".$password_usuario."'),
	Nivel='".$nivel_usuario."',
	Mail_usuario='".$mail_usuario."',
	Nombre_completo='".$Nombre_completo."',
	Empresa='".$Empresa."',
	Fecha_alta='".fecha($Fecha_alta)."',
	Fecha_ultimo_login='".fecha($Fecha_ultimo_login)."',
	Activo='".$radio_activo."' where IdUsuario='".$id_usuario."'"; 
	
	}else{
	$query_euf="update user_farmacos  set 
	Login_Usuario='".$login_usuario."',
	Nivel='".$nivel_usuario."',
	Mail_usuario='".$mail_usuario."',
	Nombre_completo='".$Nombre_completo."',
	Empresa='".$Empresa."',
	Fecha_alta='".fecha($Fecha_alta)."',
	Fecha_ultimo_login='".fecha($Fecha_ultimo_login)."',
	Activo='".$radio_activo."' where IdUsuario='".$id_usuario."'"; 
	}
	
	//echo $query_euf;

	$result1 = mysql_query($query_euf, $connect);
	echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";

	break;
	
	 case "deluf":   
     $query_deluf="delete from user_farmacos 
     where IdUsuario='".$_GET['id_usuario']."'";
	 //echo $query_etfn;
	 $result1 = mysql_query($query_deluf, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;


}
?>