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

     case "add_atf": 
	//convertir a numero sin comas
	$valor_toxicidadall=convierte_numero($_POST['txall']);
	$valor_toxicidad34=convierte_numero($_POST['tx34']);
	if (!$valor_toxicidadall==0){
	$queryall= "insert into farmacos_toxicidad(id_farmaco,id_toxicidad,id_categoria,valor_toxicidad) 
	values ('".$_POST['id_farmaco']."','".$_POST['select_tx']."','0','".$valor_toxicidadall."')";
	$result1 = mysql_query($queryall, $connect);
		if ($result1){
		}else{
		}
	}
	if (!$valor_toxicidad34==0){
	$query34= "insert into farmacos_toxicidad(id_farmaco,id_toxicidad,id_categoria,valor_toxicidad) 
	values ('".$_POST['id_farmaco']."','".$_POST['select_tx']."','4','".$valor_toxicidad34."')";
	$result2 = mysql_query($query34, $connect);
		if ($result2){
		}else{
		}
	
	}

echo "<script type=\"text/javascript\">\n";
echo "window.opener.location.reload(true);\n";
echo " window.close();\n";
echo "</script>\n";
	break;
	
	case "etf": 
	//convertir a numero sin comas
	//echo existe_toxicidad_farmaco($_POST['id_farmaco'],$_POST['id_toxicidad'],0);
	//echo existe_toxicidad_farmaco($_POST['id_farmaco'],$_POST['id_toxicidad'],4);
	$valor_toxicidadall=convierte_numero($_POST['txall']);
	$valor_toxicidad34=convierte_numero($_POST['tx34']);
	if (!$valor_toxicidadall==0){
	       if (existe_toxicidad_farmaco($_POST['id_farmaco'],$_POST['id_toxicidad'],0)){
	       //se actualiza el registro de la toxicidad all grade.
	       $queryall="update farmacos_toxicidad set valor_toxicidad='".$valor_toxicidadall."'
	       where id_farmaco='".$_POST['id_farmaco']."' and id_toxicidad='".$_POST['id_toxicidad']."' and id_categoria='0'";
	       $result1 = mysql_query($queryall, $connect);
		    if ($result1){
		    }else{
		    }
	       }else{
		// si no existe hay que insertar el registro con la toxicidad all grade    
	       $queryall= "insert into farmacos_toxicidad(id_farmaco,id_toxicidad,id_categoria,valor_toxicidad) 
	       values ('".$_POST['id_farmaco']."','".$_POST['id_toxicidad']."','0','".$valor_toxicidadall."')";
	       $result1 = mysql_query($queryall, $connect);
		    if ($result1){
		    }else{
		    }
	       }
	}else{
	       if (existe_toxicidad_farmaco($_POST['id_farmaco'],$_POST['id_toxicidad'],0)){
	       //se borra la toxicidad.
	       $queryall="delete from farmacos_toxicidad
	       where id_farmaco='".$_POST['id_farmaco']."' and id_toxicidad='".$_POST['id_toxicidad']."' and id_categoria='0'";
	       $result1 = mysql_query($queryall, $connect);
		    if ($result1){
		    }else{
		    }
	       }else{
		//no se hace nada
	       }
	}
	//echo $queryall;
	if (!$valor_toxicidad34==0){
	       if (existe_toxicidad_farmaco($_POST['id_farmaco'],$_POST['id_toxicidad'],4)){
	       //se actualiza el registro de la toxicidad 34.
	       $query34="update farmacos_toxicidad set valor_toxicidad='".$valor_toxicidad34."'
	       where id_farmaco='".$_POST['id_farmaco']."' and id_toxicidad='".$_POST['id_toxicidad']."' and id_categoria='4'";
	       $result1 = mysql_query($query34, $connect);
		    if ($result1){
		    }else{
		    }
	       }else{
		// si no existe hay que insertar el registro con la toxicidad 34    
	       $query34= "insert into farmacos_toxicidad(id_farmaco,id_toxicidad,id_categoria,valor_toxicidad) 
	       values ('".$_POST['id_farmaco']."','".$_POST['id_toxicidad']."','4','".$valor_toxicidada34."')";
	       $result1 = mysql_query($query34, $connect);
		    if ($result1){
		    }else{
		    }
	       }
	  }else{
	       if (existe_toxicidad_farmaco($_POST['id_farmaco'],$_POST['id_toxicidad'],4)){
	       //se borra la toxicidad 34.
	       $query34="delete from farmacos_toxicidad 
	       where id_farmaco='".$_POST['id_farmaco']."' and id_toxicidad='".$_POST['id_toxicidad']."' and id_categoria='4'";
	       $result1 = mysql_query($query34, $connect);
		    if ($result1){
		    }else{
		    }
	       }else{
		// no se hace nada    
	       } 
	  }
//echo $query34;
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	break;

     case "deltf": 
      if (existe_toxicidad_farmaco($_GET['id_farmaco'],$_GET['id_toxicidad'],0)){
	       //se borra la toxicidad.
	       $queryall="delete from farmacos_toxicidad
	       where id_farmaco='".$_GET['id_farmaco']."' and id_toxicidad='".$_GET['id_toxicidad']."' and id_categoria='0'";
	       $result1 = mysql_query($queryall, $connect);
		    if ($result1){
		    }else{
		    }
     }
     if (existe_toxicidad_farmaco($_GET['id_farmaco'],$_GET['id_toxicidad'],4)){
	       //se borra la toxicidad 34.
	       $query34="delete from farmacos_toxicidad 
	       where id_farmaco='".$_GET['id_farmaco']."' and id_toxicidad='".$_GET['id_toxicidad']."' and id_categoria='4'";
	       $result1 = mysql_query($query34, $connect);
		    if ($result1){
		    }else{
		    }
     }
    
     
     echo "<script type=\"text/javascript\">\n";
     echo "window.opener.location.reload(true);\n";
     echo " window.close();\n";
     echo "</script>\n";
     break;

	case "af": 
	$codigo_ultimo_farmaco=obtiene_ultimo_farmaco(0);
    if ($codigo_ultimo_farmaco==0){
	echo "<script type=\"text/javascript\">\n";
	echo "window.opener.location.reload(true);\n";
	echo " window.close();\n";
	echo "</script>\n";
	}else{

	 $nombre_farmaco=filtrar_texto($_POST['nombre_farmaco']);
	 $observaciones_farmaco=filtrar_texto($_POST['observaciones_farmaco']);
	 $clasificacion_toxicidad_farmaco=filtrar_texto($_POST['clasificacion_toxicidad_farmaco']);
	 $query_af="insert into farmacos(id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco)
	 values('".$codigo_ultimo_farmaco."','".$nombre_farmaco."','".$observaciones_farmaco."','".$clasificacion_toxicidad_farmaco."')";
	 $result1 = mysql_query($query_af, $connect);
	 desbloquea_tabla();
	 echo "<script type=\"text/javascript\">\n";
	 echo "window.opener.location.href = \"listar_farmacos.php?cop=ef&id_farmaco=".$codigo_ultimo_farmaco."\";\n";
	 echo " window.close();\n";
	 echo "</script>\n";
	
	}
	 
	 
	 
	 break;
	
	
	
	case "ef": 
     $nombre_farmaco=filtrar_texto($_POST['nombre_farmaco']);
     $observaciones_farmaco=filtrar_texto($_POST['observaciones_farmaco']);
     $clasificacion_toxicidad_farmaco=filtrar_texto($_POST['clasificacion_toxicidad_farmaco']);
	 
	 $query_ef="update farmacos  set nombre_farmaco='".$nombre_farmaco."',observaciones_farmaco='".$observaciones_farmaco."',clasificacion_toxicidad_farmaco='".$clasificacion_toxicidad_farmaco."'
	 ,tipo_farmaco='".$_POST['radio_tipo_farmaco']."',farmaco_principal='".$_POST['select_farmaco_principal']."'
	 where id_farmaco='".$_POST['id_farmaco']."'";
	 $result1 = mysql_query($query_ef, $connect);
     echo "<script type=\"text/javascript\">\n";
	 echo "alert('Registro Actualizado');\n";
	 echo "window.location='listar_farmacos.php?cop=ef&id_farmaco=".$_POST['id_farmaco']."';\n";
	 echo "</script>\n";
     break;
	
	case "delffda": 
	 $query_delfn="delete from farmacos_links
	 where id_farmaco='".$_GET['id_farmaco']."'";
	 $result1 = mysql_query($query_delfn, $connect);
	 
	  $query_delfn="delete from farmacos_toxicidad
	 where id_farmaco='".$_GET['id_farmaco']."'";
	 $result1 = mysql_query($query_delfn, $connect);
	 
	 $query_delfn="delete from farmacos_indicaciones
	 where id_farmaco='".$_GET['id_farmaco']."'";
	 $result1 = mysql_query($query_delfn, $connect);
	 
	 $query_delfn="delete from farmacos
	 where id_farmaco='".$_GET['id_farmaco']."'";
	 $result1 = mysql_query($query_delfn, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	break;
	case "afn": 
	 $id_categoria_diana=$_POST['id_categoria_diana'];
	 $nombre_farmaco=filtrar_texto($_POST['nombre_farmaco']);
	 $autores=filtrar_texto($_POST['autores']);
	 $categoria_nueva=filtrar_texto($_POST['categoria_nueva']);
	 $tx1desc=filtrar_texto($_POST['tx1desc']);
	 $tx2desc=filtrar_texto($_POST['tx2desc']);
	 $comentarios=filtrar_texto($_POST['comentarios']);
	 $tipo_ensayo=filtrar_texto($_POST['tipo_ensayo']);
	 $celular_process=filtrar_texto($_POST['celular_process']);
	 
	 	if($id_categoria_diana==0){
		//la categoria es nueva y hay que insertarla
		$codigo_ultima_categoria=obtiene_ultima_categoria();
		$query_acd="insert into categorias_dianas(id_categoria_diana,descripcion_categoria_diana)
	 	values('".$codigo_ultima_categoria."','".$categoria_nueva."')";
		$result_acd = mysql_query($query_acd, $connect);
		desbloquea_tabla();
		$codigo_ultimo_farmaco=obtiene_ultimo_farmaco(1);
			 if ($codigo_ultimo_farmaco==0){
			 desbloquea_tabla();
			 echo "<script type=\"text/javascript\">\n";
			 echo "window.opener.location.reload(true);\n";
			 echo " window.close();\n";
			 echo "</script>\n";
			 }else{
			 $query_efn="insert into farmacos_inv(id_farmaco,nombre_farmaco,autores,categoria_diana,tx1desc,tx2desc,comentarios,tipo_ensayo,celular_process)
			 values('".$codigo_ultimo_farmaco."','".$nombre_farmaco."','".$autores."','".$codigo_ultima_categoria."','".$tx1desc."','".$tx2desc."','".$comentarios."','".$tipo_ensayo."','".$celular_process."')";
			 $result1 = mysql_query($query_efn, $connect);
			 desbloquea_tabla();
			 echo "<script type=\"text/javascript\">\n";
			 echo "window.opener.location.href = \"farmacos_nuevos.php?cop=efn&id_farmaco=".$codigo_ultimo_farmaco."\";\n";
			 echo " window.close();\n";
			 echo "</script>\n";
			 }
		//insertar farmaco nuevo
	 	}else{
		    $codigo_ultimo_farmaco=obtiene_ultimo_farmaco(1);
			 if ($codigo_ultimo_farmaco==0){
			 desbloquea_tabla();
			 echo "<script type=\"text/javascript\">\n";
			 echo "window.opener.location.reload(true);\n";
			 echo " window.close();\n";
			 echo "</script>\n";
			 }else{
			 $codigo_ultimo_farmaco=obtiene_ultimo_farmaco(1);
			 $query_efn="insert into farmacos_inv(id_farmaco,nombre_farmaco,autores,categoria_diana,tx1desc,tx2desc,comentarios,tipo_ensayo,celular_process)
			 values('".$codigo_ultimo_farmaco."','".$nombre_farmaco."','".$autores."','".$id_categoria_diana."','".$tx1desc."','".$tx2desc."','".$comentarios."','".$tipo_ensayo."','".$celular_process."')";
			 $result1 = mysql_query($query_efn, $connect);
			 desbloquea_tabla();
			 echo "<script type=\"text/javascript\">\n";
			 echo "window.opener.location.href = \"farmacos_nuevos.php?cop=efn&id_farmaco=".$codigo_ultimo_farmaco."\";\n";
			 echo " window.close();\n";
			 echo "</script>\n";
			 }
		}
	  
	 break;
	case "efn": 
	 $nombre_farmaco=filtrar_texto($_POST['nombre_farmaco']);
	 $autores=filtrar_texto($_POST['autores']);
	 $categoria_diana=filtrar_texto($_POST['categoria_diana']);
	 $tx1desc=filtrar_texto($_POST['tx1desc']);
	 $tx2desc=filtrar_texto($_POST['tx2desc']);
	 $comentarios=filtrar_texto($_POST['comentarios']);
	 $tipo_ensayo=filtrar_texto($_POST['tipo_ensayo']);
	 $celular_process=filtrar_texto($_POST['celular_process']);
	 
	 
	 $query_efn="update farmacos_inv  set 
	 nombre_farmaco='".$nombre_farmaco."',
	 autores='".$autores."',
	 categoria_diana='".$categoria_diana."',
	 tx1desc='".$tx1desc."',
	 tx2desc='".$tx2desc."',
	 comentarios='".$comentarios."',
	 tipo_ensayo='".$tipo_ensayo."',
	 celular_process='".$celular_process."'
	 where id_farmaco='".$_POST['id_farmaco']."'";
	 //echo $query_efn;
	 
	 $result1 = mysql_query($query_efn, $connect);
	   echo "<script type=\"text/javascript\">\n";
	   echo "alert('Registro Actualizado');\n";
	   echo "window.location='farmacos_nuevos.php?cop=efn&id_farmaco=".$_POST['id_farmaco']."';\n";
	   echo "</script>\n";
	 break;
    
	case "delfn": 
	 $query_delfn="delete from farmacos_inv_link
	 where id_farmaco='".$_GET['id_farmaco']."'";
	 $result1 = mysql_query($query_delfn, $connect);
	 
	  $query_delfn="delete from farmacos_inv_toxicidad
	 where id_farmaco='".$_GET['id_farmaco']."'";
	 $result1 = mysql_query($query_delfn, $connect);
	 
	 $query_delfn="delete from farmacos_inv_diana
	 where id_farmaco='".$_GET['id_farmaco']."'";
	 $result1 = mysql_query($query_delfn, $connect);
	 
	 $query_delfn="delete from farmacos_inv
	 where id_farmaco='".$_GET['id_farmaco']."'";
	 $result1 = mysql_query($query_delfn, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	break;
     
	case "add_atfn": 
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
	 $query_atfn= "insert into farmacos_inv_toxicidad(id_farmaco,id_toxicidad,tx1,tx2) 
	  values ('".$_POST['id_farmaco']."','".$_POST['select_tx']."','".$tx1."','".$tx2."')";
	  //echo $query_atfn;
	  $result1 = mysql_query($query_atfn, $connect);
	}
	
	 
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	 break;
     
     case "etfn": 
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
     $query_etfn="delete from farmacos_inv_toxicidad 
     where id_farmaco='".$_POST['id_farmaco']."' and id_toxicidad='".$_POST['id_toxicidad']."'";
	}else{
     $query_etfn="update farmacos_inv_toxicidad set tx1='".$tx1."', tx2='".$tx2."'
     where id_farmaco='".$_POST['id_farmaco']."' and id_toxicidad='".$_POST['id_toxicidad']."'";
	}
	
	 //echo $query_etfn;
	 $result1 = mysql_query($query_etfn, $connect);
	   echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	 break;
     case "deltfn":   
     $query_deltfn="delete from farmacos_inv_toxicidad 
     where id_farmaco='".$_GET['id_farmaco']."' and id_toxicidad='".$_GET['id_toxicidad']."'";
	 //echo $query_etfn;
	 $result1 = mysql_query($query_deltfn, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;

     case "add_alkf": 
	  $descripcion_link=filtrar_texto($_POST['descripcion_link']);
	  $query_alkf= "insert into farmacos_links(id_farmaco,descripcion_link,url_link,tipo_link) 
	  values ('".$_POST['id_farmaco']."','".$descripcion_link."','".$_POST['url_link']."','".$_POST['select_tipo_link']."')";
	  //echo $query_atfn;
	  $result1 = mysql_query($query_alkf, $connect);
	
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	 break;
     case "elkf": 
	  $descripcion_link=filtrar_texto($_POST['descripcion_link']);
	  $query_elkf= "update farmacos_links set descripcion_link='".$descripcion_link."',
	  url_link='".$_POST['url_link']."',tipo_link='".$_POST['select_tipo_link']."'  where id_link='".$_POST['id_link']."'";
	  //echo $query_elkf;
	  
	  $result1 = mysql_query($query_elkf, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;

     case "dellkf":   
	  $query_dellkf="delete from farmacos_links
	  where id_link='".$_GET['id_link']."'";
	// echo $query_dellkf;
	 $result1 = mysql_query($query_dellkf, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;

     case "add_aif": 
	  if (!isset($_POST['testado'])){
	  $testado=0;
	  }else{
	  $testado=1;
	  }
	  $query_aif= "insert into farmacos_indicaciones(id_farmaco,id_indicacion,testado) 
	  values ('".$_POST['id_farmaco']."','".$_POST['select_indicacion']."','".$testado."')";
	  //echo $query_aif;
	  $result1 = mysql_query($query_aif, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
     case "eif": 
	  if (!isset($_POST['testado'])){
	  $testado=0;
	  }else{
	  $testado=1;
	  }
	  $query_eif= "update farmacos_indicaciones set testado='".$testado."'
	  where id_farmaco='".$_POST['id_farmaco']."' and id_indicacion='".$_POST['id_indicacion']."'";
	  $result1 = mysql_query($query_eif, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	  break;
     case "delif":   
	  $query_delif="delete from farmacos_indicaciones
	  where id_farmaco='".$_GET['id_farmaco']."' and id_indicacion='".$_GET['id_indicacion']."'";
	 $result1 = mysql_query($query_delif, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;

     case "add_alkfn": 
	  $descripcion_link=filtrar_texto($_POST['descripcion_link']);
	  $query_alkf= "insert into farmacos_inv_link(id_farmaco,descripcion_link,url_link,tipo_link) 
	  values ('".$_POST['id_farmaco']."','".$descripcion_link."','".$_POST['url_link']."','".$_POST['select_tipo_link']."')";
	  //echo $query_atfn;
	  $result1 = mysql_query($query_alkf, $connect);
	
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	 break;
     case "elkfn": 
	  $descripcion_link=filtrar_texto($_POST['descripcion_link']);
	  $query_elkf= "update farmacos_inv_link set descripcion_link='".$descripcion_link."',
	  url_link='".$_POST['url_link']."',tipo_link='".$_POST['select_tipo_link']."' where id_link='".$_POST['id_link']."'";
	  //echo $query_elkf;
	  
	  $result1 = mysql_query($query_elkf, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;

     case "dellkfn":   
	  $query_dellkf="delete from farmacos_inv_link
	  where id_link='".$_GET['id_link']."'";
	// echo $query_dellkf;
	 $result1 = mysql_query($query_dellkf, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	
	
	  case "add_adiafn": 
	  $valor_diana=filtrar_texto($_POST['valor_diana']);
	  
	  
	  if($_POST['id_diana']==0){
		$diana_nueva=filtrar_texto($_POST['diana_nueva']);
		//la diana es nueva y hay que insertarla
		$codigo_ultima_diana=obtiene_ultima_diana();
		$query_acd="insert into dianas(id_diana,descripcion_diana,id_diana_n0)
	 	values('".$codigo_ultima_diana."','".$diana_nueva."','".$_POST['select_dn0']."')";
		$result_acd = mysql_query($query_acd, $connect);
		desbloquea_tabla();
	  	$query_adiafn= "insert into farmacos_inv_diana(id_farmaco,id_diana,valor_diana) 
	  	values ('".$_POST['id_farmaco']."','".$codigo_ultima_diana."','".$valor_diana."')";
	  //echo $query_adiafn;
		}else{
		$query_adiafn= "insert into farmacos_inv_diana(id_farmaco,id_diana,valor_diana) 
	 	 values ('".$_POST['id_farmaco']."','".$_POST['id_diana']."','".$valor_diana."')";
		
		}
		
	
		$result1 = mysql_query($query_adiafn, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
 	
	case "edit_ediafn": 
	  $valor_diana=filtrar_texto($_POST['valor_diana']);
	  $query_ediafn= "update farmacos_inv_diana set  valor_diana='".$valor_diana."'
	 where id_farmaco='".$_POST['id_farmaco']."' and  id_diana='".$_POST['id_diana']."'";
	 //echo $query_ediafn;
	
	$result1 = mysql_query($query_ediafn, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	break;
	
	case "deldiafn":   
	  $query_deldiafn="delete from farmacos_inv_diana
	  where id_farmaco='".$_GET['id_farmaco']."' and  id_diana='".$_GET['id_diana']."'";
	//echo $query_deldiafn;
	 $result1 = mysql_query($query_deldiafn, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	break;

	case "apfn": 
	$query_apm= "insert into farmacos_inv_pathways(id_farmaco,id_pathway) 
	values ('".$_GET['id_farmaco']."','".$_GET['id_pathway']."')";
	//echo $query_apm;
	$result1 = mysql_query($query_apm, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	case "delpfn":   
     $query_delpm="delete from farmacos_inv_pathways 
     where id_farmaco='".$_GET['id_farmaco']."' and id_pathway='".$_GET['id_pathway']."'";
	 //echo $query_etfn;
	 $result1 = mysql_query($query_delpm, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;
	
	case "apin": 
	$query_apm= "insert into indicacion_pathways(id_indicacion,id_pathway) 
	values ('".$_GET['id_indicacion']."','".$_GET['id_pathway']."')";
	//echo $query_apm;
	
	$result1 = mysql_query($query_apm, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	
	break;
	case "delpin":   
     $query_delpm="delete from indicacion_pathways 
     where id_indicacion='".$_GET['id_indicacion']."' and id_pathway='".$_GET['id_pathway']."'";
	 //echo $query_etfn;
	 $result1 = mysql_query($query_delpm, $connect);
	  echo "<script type=\"text/javascript\">\n";
	  echo "window.opener.location.reload(true);\n";
	  echo " window.close();\n";
	  echo "</script>\n";
	 break;


}
?>