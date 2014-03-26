<?php
include ("inc/login.php"); 
include ("inc/config.php");
function existe_toxicidad_farmaco($id_farmaco,$id_toxicidad,$id_categoria) {
global $connect,$basedatos;
     $queryb="select valor_toxicidad from farmacos_toxicidad where id_farmaco='".$id_farmaco."' and id_toxicidad='".$id_toxicidad. "' and id_categoria='".$id_categoria."'";
     $resultb = mysql_query($queryb,$connect);
     if ($resultb) {
     $nregs=mysql_num_rows($resultb);
	    	if ($nregs==0){
        	return 0;
        	}else{
	   		return 1;
      		}
     }else{
     return 0;
     }
}

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

function obtiene_ultimo_farmaco($tipo_farmaco) {
global $connect,$basedatos;
//tipo farmaco 0 fda_drug, 1 Inv drug
if ($tipo_farmaco==0){
$querya="lock tables farmacos write ";
$queryb="select max(id_farmaco) from farmacos";
}else{
$querya="lock tables farmacos_inv write ";
$queryb="select max(id_farmaco) from farmacos_inv";
}


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
     
     
	 case "acd": 
	
	 $descripcion_categoria_diana=filtrar_texto($_POST['descripcion_categoria_diana']);
	 $query_acd= "insert into categorias_dianas(descripcion_categoria_diana) 
		values ('".$descripcion_categoria_diana."')";
		$result1 = mysql_query($query_acd, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	 
	 
	 
	 
	 case "ecd": 
	 $descripcion_categoria_diana=filtrar_texto($_POST['descripcion_categoria_diana']);
	 $tx1desc_cd=filtrar_texto($_POST['tx1desc_cd']);
	 $tx2desc_cd=filtrar_texto($_POST['tx2desc_cd']);
	 $comentarios_cd=filtrar_texto($_POST['comentarios_cd']);
	 
	 $query_ecd="update categorias_dianas  set 
	 descripcion_categoria_diana='".$descripcion_categoria_diana."',
	 tx1desc_cd='".$tx1desc_cd."',
	 tx2desc_cd='".$tx2desc_cd."',
	 comentarios_cd='".$comentarios_cd."'
	where id_categoria_diana='".$_POST['id_categoria_diana']."'";
	// echo $query_ecd;
	
	$result1 = mysql_query($query_ecd, $connect);
	  echo "<script type=\"text/javascript\">\n";
	echo "window.location='farmacos_nuevos.php';\n";
	echo "</script>\n";
	break;
     
     case "ecd2": 
	
	 $descripcion_categoria_diana=filtrar_texto($_POST['descripcion_categoria_diana']);
	 $query_ecd="update categorias_dianas  set 
	 descripcion_categoria_diana='".$descripcion_categoria_diana."'
	 where id_categoria_diana='".$_POST['id_categoria_diana']."'";
	 //echo $query_efn;
	 $result1 = mysql_query($query_ecd, $connect);
	 echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
     
     
     
     case "add_atcd": 
	  if (!isset($_POST['tx1'])){
	  $tx1=0;
	  }else{
	  $tx1=1;
	  }
	  if (!isset($_POST['tx2'])){
	  $tx2=0;
	  }else{
	  $tx2=1;
	  }
	if ($tx1==0 and $tx2==0){
     
	}else{
	 $query_atcd= "insert into categorias_diana_toxicidad(id_categoria_diana,id_toxicidad,tx1,tx2) 
	  values ('".$_POST['id_categoria_diana']."','".$_POST['select_tx']."','".$tx1."','".$tx2."')";
	  //echo $query_atfn;
	  $result1 = mysql_query($query_atcd, $connect);
	}
	
	 
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	 break;
     
     case "etcd": 
	  if (!isset($_POST['tx1'])){
	  $tx1=0;
	  }else{
	  $tx1=1;
	  }
	  if (!isset($_POST['tx2'])){
	  $tx2=0;
	  }else{
	  $tx2=1;
	  }
     
     if ($tx1==0 and $tx2==0){
     $query_etcd="delete from categorias_diana_toxicidad 
     where id_categoria_diana='".$_POST['id_categoria_diana']."' and id_toxicidad='".$_POST['id_toxicidad']."'";
	}else{
     $query_etcd="update categorias_diana_toxicidad set tx1='".$tx1."', tx2='".$tx2."'
     where id_categoria_diana='".$_POST['id_categoria_diana']."' and id_toxicidad='".$_POST['id_toxicidad']."'";
	}
	
	 //echo $query_etfn;
	 $result1 = mysql_query($query_etcd, $connect);
	   echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	 break;
     case "deltcd":   
     $query_deltcd="delete from categorias_diana_toxicidad 
     where id_categoria_diana='".$_GET['id_categoria_diana']."' and id_toxicidad='".$_GET['id_toxicidad']."'";
	 //echo $query_etfn;
	 $result1 = mysql_query($query_deltcd, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
 	
	
	case "add_tx":   
		$nombre_toxicidad=filtrar_texto($_POST['nombre_toxicidad']);
		$query_atx= "insert into toxicidad(nombre_toxicidad,id_toxicidad_n0) 
		values ('".$nombre_toxicidad."','".$_POST['select_tx']."')";
		$result1 = mysql_query($query_atx, $connect);
	 
	 // echo $query_atx;
	
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;
	case "etx":   
		$nombre_toxicidad=filtrar_texto($_POST['nombre_toxicidad']);
		$query_etx= "update toxicidad set nombre_toxicidad='".$nombre_toxicidad."',id_toxicidad_n0='".$_POST['select_tx']."' 
		where id_toxicidad='".$_POST['id_toxicidad']."'";
		$result1 = mysql_query($query_etx, $connect);
	 // echo $query_etx;
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;
	case "ect":   
		$descripcion_toxicidad_n0=filtrar_texto($_POST['descripcion_toxicidad_n0']);
		$query_ect= "update toxicidad_n0 set descripcion_toxicidad_n0='".$descripcion_toxicidad_n0."' 
		where id_toxicidad_n0='".$_POST['id_toxicidad_n0']."'";
		$result1 = mysql_query($query_ect, $connect);
	 // echo $query_etx;
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;
	case "act":   
		$descripcion_toxicidad_n0=filtrar_texto($_POST['descripcion_toxicidad_n0']);
		$query_act= "insert into toxicidad_n0(descripcion_toxicidad_n0) 
		values ('".$descripcion_toxicidad_n0."')";
		$result1 = mysql_query($query_act, $connect);
	 
	 // echo $query_atx;
	
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;

	case "ad":   
		$descripcion_diana=filtrar_texto($_POST['descripcion_diana']);
		$query_ad= "insert into dianas(descripcion_diana,id_diana_n0) 
		values ('".$descripcion_diana."','".$_POST['select_dn0']."')";
		$result1 = mysql_query($query_ad, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;
	
	case "ed":   
		$descripcion_diana=filtrar_texto($_POST['descripcion_diana']);
		$query_ed= "update dianas set descripcion_diana='".$descripcion_diana."', id_diana_n0='".$_POST['select_dn0']."'
		where id_diana='".$_POST['id_diana']."'";
		$result1 = mysql_query($query_ed, $connect);
	 // echo $query_etx;
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;
	case "att":   
		$descripcion_indicacion=filtrar_texto($_POST['descripcion_indicacion']);
		$query_att= "insert into indicaciones(descripcion_indicacion) 
		values ('".$descripcion_indicacion."')";
		$result1 = mysql_query($query_att, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;
	case "ett":   
		$descripcion_indicacion=filtrar_texto($_POST['descripcion_indicacion']);
		$query_ett= "update indicaciones set descripcion_indicacion='".$descripcion_indicacion."' 
		where id_indicacion='".$_POST['id_indicacion']."'";
		$result1 = mysql_query($query_ett, $connect);
	 // echo $query_ett;
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;

	case "adn0":   
		$descripcion_diana_n0=filtrar_texto($_POST['descripcion_diana_n0']);
		$query_adn0= "insert into dianas_n0(descripcion_diana_n0) 
		values ('".$descripcion_diana_n0."')";
		$result1 = mysql_query($query_adn0, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	break;
	
	case "edn0":   
		$descripcion_diana_n0=filtrar_texto($_POST['descripcion_diana_n0']);
		$query_edn0= "update dianas_n0 set descripcion_diana_n0='".$descripcion_diana_n0."' 
		where id_diana_n0='".$_POST['id_diana_n0']."'";
		$result1 = mysql_query($query_edn0, $connect);
	 // echo $query_ett;
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;
	
	case "ati": 
	$query_ati= "insert into indicacion_tumores(id_indicacion,id_tejido_n1,id_histologia_n0,id_histologia_n1) 
	values ('".$_POST['id_indicacion']."','".$_POST['select_tejido_n1']."','".$_POST['select_histologia_n0']."','".$_POST['select_histologia_n1']."')";
	//echo $query_atm;
	
	$result1 = mysql_query($query_ati, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	
	case "delti":   
     $query_delti="delete from indicacion_tumores
     where id_indicacion='".$_GET['id_indicacion']."' and id_tejido_n1='".$_GET['id_tejido_n1']."' and id_histologia_n0='".$_GET['id_histologia_n0']."' and id_histologia_n1='".$_GET['id_histologia_n1']."'";
	 //echo $query_deltm;
	 $result1 = mysql_query($query_delti, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;

	case "apw": 
	$id_external=filtrar_texto($_POST['id_external']);
	$nombre_pathway=filtrar_texto($_POST['nombre_pathway']);
	$query_apw= "insert into pathways(id_external,nombre_pathway) 
	values ('".$id_external."','".$nombre_pathway."')";
	//echo $query_atm;
	$result1 = mysql_query($query_apw, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	case "epw":   
		$id_external=filtrar_texto($_POST['id_external']);
		$nombre_pathway=filtrar_texto($_POST['nombre_pathway']);
		$query_epw= "update  pathways set id_external='".$id_external."', 
		nombre_pathway='".$nombre_pathway."'
		where id_pathway='".$_POST['id_pathway']."'";
		$result1 = mysql_query($query_epw, $connect);
	 // echo $query_ett;
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	break;
}
?>