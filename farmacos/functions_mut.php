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

function obtiene_ultima_categoria(){
global $connect,$basedatos;
$querya="lock tables categorias_dianas write ";
$queryb="select max(id_categoria_diana) from categorias_dianas";

$resulta = mysql_query($querya,$connect);
//$resulta =1;
if ($resulta) {
     
     $resultb = mysql_query($queryb,$connect);
     if ($resultb) {
     $filab = mysql_fetch_array($resultb);	                          
        if ($filab){
        $proximo_id=$filab['0'] + 1;
		return $proximo_id;
        }else{
       
	   return 1;
        }
     }else{
     return 0;
      }
}else{
return 0;
}

}

function obtiene_ultima_diana(){
global $connect,$basedatos;
$querya="lock tables dianas write ";
$queryb="select max(id_diana) from dianas";

$resulta = mysql_query($querya,$connect);
//$resulta =1;
if ($resulta) {
     
     $resultb = mysql_query($queryb,$connect);
     if ($resultb) {
     $filab = mysql_fetch_array($resultb);	                          
        if ($filab){
        $proximo_id=$filab['0'] + 1;
		return $proximo_id;
        }else{
       
	   return 1;
        }
     }else{
     return 0;
      }
}else{
return 0;
}

}


function obtiene_ultima_mutacion(){
global $connect,$basedatos;
$querya="lock tables mutaciones write ";
$queryb="select max(id_mutacion) from mutaciones";

$resulta = mysql_query($querya,$connect);
//$resulta =1;
if ($resulta) {
     
     $resultb = mysql_query($queryb,$connect);
     if ($resultb) {
     $filab = mysql_fetch_array($resultb);	                          
        if ($filab){
        $proximo_id=$filab['0'] + 1;
		return $proximo_id;
        }else{
       
	   return 1;
        }
     }else{
     return 0;
      }
}else{
return 0;
}

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
    
	
	case "am": 
	$nombre_gen=filtrar_texto($_POST['nombre_gen']);
	$tipo_mutacion=$_POST['select_tipo_mutacion'];
	$GeneId=$_POST['GeneId'];
	$sinonimos_gen=filtrar_texto($_POST['sinonimos_gen']);
	$protein_family=filtrar_texto($_POST['protein_family']);
	$definicion_comun=$_POST['radio_definicion_comun'];
	//$id_diana=$_POST['select_diana'];
	//$diana=filtrar_texto($_POST['diana']);
	$enfermedad_asociada=filtrar_texto($_POST['enfermedad_asociada']);
	$celular_process=filtrar_texto($_POST['celular_process']);
	/*
	 if ($definicion_comun==0){
	 $id_diana=0;
	 }else{
	 }
	*/
	$codigo_ultima_mutacion=obtiene_ultima_mutacion();
	$query_am= "insert into mutaciones(id_mutacion,nombre_gen,tipo_mutacion,GeneId,sinonimos_gen,protein_family,definicion_comun,enfermedad_asociada,celular_process) 
	values ('".$codigo_ultima_mutacion."','".$nombre_gen."','".$tipo_mutacion."','".$GeneId."','".$sinonimos_gen."','".$protein_family."','".$definicion_comun."','".$enfermedad_asociada."','".$celular_process."')";
	 //echo $query_am;
	 $result1 = mysql_query($query_am, $connect);
	 desbloquea_tabla();
	 echo "<script type=\"text/javascript\">\n";
	 echo "window.opener.location='mutaciones.php?cop=em&id_mutacion=".$codigo_ultima_mutacion."';\n";
	 echo " window.close();\n";
	 echo "</script>\n";

	break;

	case "em": 
	$nombre_gen=filtrar_texto($_POST['nombre_gen']);
	$tipo_mutacion=$_POST['select_tipo_mutacion'];
	$GeneId=$_POST['GeneId'];
	$sinonimos_gen=filtrar_texto($_POST['sinonimos_gen']);
	$protein_family=filtrar_texto($_POST['protein_family']);
	$definicion_comun=$_POST['radio_definicion_comun'];
	//$id_diana=$_POST['select_diana'];
	//$diana=filtrar_texto($_POST['diana']);
	$enfermedad_asociada=filtrar_texto($_POST['enfermedad_asociada']);
	$celular_process=filtrar_texto($_POST['celular_process']);
	 /*
	 if ($definicion_comun==0){
	 $id_diana=0;
	 }else{
	 }
	*/
	$query_em= "update  mutaciones set  
	 nombre_gen='".$nombre_gen."',
	 tipo_mutacion='".$tipo_mutacion."',
	 GeneId='".$GeneId."',
	 sinonimos_gen='".$sinonimos_gen."',
	 protein_family='".$protein_family."',
	 definicion_comun='".$definicion_comun."',
	 enfermedad_asociada='".$enfermedad_asociada."',
	 celular_process='".$celular_process."'
	 where id_mutacion='".$_POST['id_mutacion']."'";
	 //echo $query_em;
	 $result1 = mysql_query($query_em, $connect);
	  echo "<script type=\"text/javascript\">\n";
	   echo "alert('Registro Actualizado');\n";
	  echo "window.location='mutaciones.php?cop=em&id_mutacion=".$_POST['id_mutacion']."';\n";
	  echo "</script>\n";
	
	break;
     
	case "apm": 
	$query_apm= "insert into mutaciones_pathways(id_mutacion,id_pathway) 
	values ('".$_GET['id_mutacion']."','".$_GET['id_pathway']."')";
	//echo $query_apm;
	$result1 = mysql_query($query_apm, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	 case "delpm":   
     $query_delpm="delete from mutaciones_pathways 
     where id_mutacion='".$_GET['id_mutacion']."' and id_pathway='".$_GET['id_pathway']."'";
	 //echo $query_etfn;
	 $result1 = mysql_query($query_delpm, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	 case "atm": 
	$query_atm= "insert into mutaciones_tumores(id_mutacion,id_tejido_n1,id_histologia_n0,id_histologia_n1,numero_mutaciones) 
	values ('".$_POST['id_mutacion']."','".$_POST['select_tejido_n1']."','".$_POST['select_histologia_n0']."','".$_POST['select_histologia_n1']."','".$_POST['numero_mutaciones']."')";
	//echo $query_atm;
	
	$result1 = mysql_query($query_atm, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	
	case "etm": 
	$query_etm= "update mutaciones_tumores
	set numero_mutaciones='".$_POST['numero_mutaciones']."' 
	where id_mutacion='".$_POST['id_mutacion']."' and 
	id_tejido_n1='".$_POST['id_tejido_n1']."' and
	id_histologia_n0='".$_POST['id_histologia_n0']."' and 
	id_histologia_n1='".$_POST['id_histologia_n1']."'";
	//echo $query_etm;
	$result1 = mysql_query($query_etm, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	 case "deltm":   
     $query_deltm="delete from mutaciones_tumores
     where id_mutacion='".$_GET['id_mutacion']."' and id_tejido_n1='".$_GET['id_tejido_n1']."' and id_histologia_n0='".$_GET['id_histologia_n0']."' and id_histologia_n1='".$_GET['id_histologia_n1']."'";
	 //echo $query_deltm;
	 $result1 = mysql_query($query_deltm, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	
	case "add_adiam": 
	  if($_POST['id_diana']==0){
		$diana_nueva=filtrar_texto($_POST['diana_nueva']);
		//la diana es nueva y hay que insertarla
		$codigo_ultima_diana=obtiene_ultima_diana();
		$query_acd="insert into dianas(id_diana,descripcion_diana,id_diana_n0)
	 	values('".$codigo_ultima_diana."','".$diana_nueva."','".$_POST['select_dn0']."')";
		$result_acd = mysql_query($query_acd, $connect);
		desbloquea_tabla();
	  	$query_adiafn= "insert into mutaciones_diana(id_mutacion,id_diana) 
	  	values ('".$_POST['id_mutacion']."','".$codigo_ultima_diana."')";
	  //echo $query_adiafn;
		}else{
		$query_adiafn= "insert into mutaciones_diana(id_mutacion,id_diana) 
	 	 values ('".$_POST['id_mutacion']."','".$_POST['id_diana']."')";
		
		}
		
	
		$result1 = mysql_query($query_adiafn, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	case "deldiam":   
	  $query_deldiafn="delete from mutaciones_diana
	  where id_mutacion='".$_GET['id_mutacion']."' and  id_diana='".$_GET['id_diana']."'";
	//echo $query_deldiafn;
	 $result1 = mysql_query($query_deldiafn, $connect);
	  
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	break;


















}
?>