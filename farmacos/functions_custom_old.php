<?php
include ("inc/login.php"); 
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
	$año=substr($fecha,6,4);
	$mes=substr($fecha,3,2);
	$dia=substr($fecha,0,2);
	$fecha_nueva=$año."-".$mes."-".$dia;
	return $fecha_nueva;
}

function desbloquea_tabla() {
global $connect,$basedatos;
$querya="unlock tables ";
$resulta = mysql_query($querya,$connect);
if ($resulta) {
return 1;
}else{
return 0;
}
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
     
     
	 case "cfpw": 
	 $id_pathway=$_GET['id_pathway'];
	 mysql_select_db($basedatos,$connect);
	 $query_farmacos = "select distinct id_farmaco from farmacos_indicaciones,indicacion_pathways
	 where farmacos_indicaciones.id_indicacion=indicacion_pathways.id_indicacion
	 and id_pathway='".$id_pathway."'";
	 $resultado = mysql_query($query_farmacos,$connect);
	 if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
				    if($numero_farmacos == 0) {
				    } else {
	 					while(list($id_farmaco)= mysql_fetch_row($resultado)){
						//insert en f_fda_temp
						$query="insert into f_fda_temp(IdUsuario,id_farmaco) values ('".$IdUsuario."','".$id_farmaco."')";
	 					$result1 = mysql_query($query, $connect);
						}
					
					}
	 }
	
	$query_farmacos2 = "select distinct id_farmaco from farmacos_inv_pathways
	 where id_pathway='".$id_pathway."'";
	 $resultado = mysql_query($query_farmacos2,$connect);
	 if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
				    if($numero_farmacos == 0) {
				    } else {
	 					while(list($id_farmaco)= mysql_fetch_row($resultado)){
						//insert en f_inv_temp
						$query="insert into f_inv_temp(IdUsuario,id_farmaco) values ('".$IdUsuario."','".$id_farmaco."')";
	 					$result1 = mysql_query($query, $connect);
						}
					
					}
	 }
	

	 break;
	 
}
?>