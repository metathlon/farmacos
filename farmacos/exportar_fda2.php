<?php
include ("inc/login.php"); 
include ("inc/config.php");
//include ("inc/alg_functions.php");

function devuelve_array_tox($id_farmaco){
global $connect,$basedatos;
$query_toxicidades="select id_toxicidad,id_categoria,valor_toxicidad from farmacos_toxicidad where id_farmaco='".$id_farmaco."'";
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
$array_tox_farmaco=array();
if ($lista_toxicidades){
$numero_toxicidades=mysql_num_rows($lista_toxicidades);
	if($numero_toxicidades == 0) {
	} else {
		while(list($id_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){
		$clave_array=$id_toxicidad."tx".$id_categoria;
		$array_tox_farmaco[$clave_array]=$valor_toxicidad;
		//echo $id_toxicidad."<br>";
		}
	}
}
return $array_tox_farmaco;
}

function devuelve_array_indicaciones($id_farmaco){
global $connect,$basedatos;
$query_indicaciones="select id_indicacion,testado from farmacos_indicaciones where id_farmaco='".$id_farmaco."'";
$lista_indicaciones = mysql_query($query_indicaciones, $connect);
$array_indicaciones_farmaco=array();
if ($lista_indicaciones){
$numero_indicaciones=mysql_num_rows($lista_indicaciones);
	if($numero_indicaciones == 0) {
	} else {
		while(list($id_indicacion,$testado)= mysql_fetch_row($lista_indicaciones)){
		$array_indicaciones_farmaco[$id_indicacion]=$testado;
		}
	}
}
return $array_indicaciones_farmaco;
}
function devuelve_links($id_farmaco){
global $connect,$basedatos;
$array_links_farmaco=array();
$query_link="select url_link,tipo_link from farmacos_links where id_farmaco='".$id_farmaco."'";
$lista_link = mysql_query($query_link, $connect);
	if ($lista_link){
	$numero_link=mysql_num_rows($lista_link);
            if($numero_link == 0) {
            } else {
            	while(list($url_link,$tipo_link)= mysql_fetch_row($lista_link)){
						if (array_key_exists($tipo_link,$array_links_farmaco)){
						$valor_nuevo=$array_links_farmaco[$tipo_link]."<br/>".$url_link;			
						$array_links_farmaco[$tipo_link]=$valor_nuevo;
						}else{
						$array_links_farmaco[$tipo_link]=$url_link;
						}
				}
			
			}
	}

return $array_links_farmaco;
}

include("inc/excelwriter.inc.php");
$query_farmacos = "select id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco from farmacos order by nombre_farmaco";	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos,$connect);

$query_toxicidades_cabecera="select id_toxicidad,nombre_toxicidad,descripcion_toxicidad_n0 from toxicidad,toxicidad_n0 where
toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0 and toxicidad_n0.id_toxicidad_n0='2'  order by descripcion_toxicidad_n0,nombre_toxicidad";
		$lista_toxicidades_cabecera=mysql_query($query_toxicidades_cabecera, $connect);
		if ($lista_toxicidades_cabecera){
			$numero_toxicidades_cabecera=mysql_num_rows($lista_toxicidades_cabecera);
				if($numero_toxicidades_cabecera == 0) {
				}else{
					while(list($id_toxicidad_cabecera,$nombre_toxicidad_cabecera,$descripcion_toxicidad_n0)= mysql_fetch_row($lista_toxicidades_cabecera)){
					$array_toxicidades_n0[$id_toxicidad_cabecera]=$descripcion_toxicidad_n0;
					$array_toxicidades_cabecera[$id_toxicidad_cabecera]=$nombre_toxicidad_cabecera;
					}
				}
		}

$query_indicaciones_cabecera="SELECT distinct farmacos_indicaciones.id_indicacion,indicaciones.descripcion_indicacion FROM farmacos_indicaciones,indicaciones where
farmacos_indicaciones.id_indicacion=indicaciones.id_indicacion order by descripcion_indicacion asc";
$lista_indicaciones_cabecera=mysql_query($query_indicaciones_cabecera, $connect);
if ($lista_indicaciones_cabecera){
	$numero_indicaciones_cabecera=mysql_num_rows($lista_indicaciones_cabecera);
		if($numero_indicaciones_cabecera == 0) {
		}else{
			while(list($id_indicacion_cabecera,$descripcion_indicacion_cabecera)= mysql_fetch_row($lista_indicaciones_cabecera)){
			$array_indicaciones_cabecera[$id_indicacion_cabecera]=$descripcion_indicacion_cabecera;
			}
		}
}

$query_tipos_link="select tipo_link,descripcion_tipo_link from categorias_link where link_ffda=1";
$lista_tipos_link = mysql_query($query_tipos_link, $connect);
if ($lista_tipos_link){
	$numero_tipos_link=mysql_num_rows($lista_tipos_link);
		if($numero_tipos_link == 0) {
		} else {
				while(list($id_link_cabecera,$descripcion_link_cabecera)= mysql_fetch_row($lista_tipos_link)){ 	
				$array_links_cabecera[$id_link_cabecera]=$descripcion_link_cabecera;	
				}  
		}
}    	

$excel=new ExcelWriter("export_excel/fda_drugs2.xls");
if($excel==false) {    
echo $excel->error;
}
			//cabecera
			$excel->writeCol("");
			while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
			$excel->writeCol("<b>".$array_toxicidades_n0[$cod_tox]."</b>");
			$excel->writeCol("<b>".$array_toxicidades_n0[$cod_tox]."</b>");
			}
			reset($array_toxicidades_cabecera);
			$excel->writeRow();
			
			$excel->writeCol("<b>DRUG NAME</b>");
			while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
			$excel->writeCol("<b>".$des_tox."ALL Grades</b>");
			$excel->writeCol("<b>".$des_tox."Grade 3/4</b>");
			}
			reset($array_toxicidades_cabecera);
			$excel->writeRow();



if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {
			
				while(list($id_farmaco,$nombre_farmaco,$observaciones_farmaco,$clasificacion_toxicidad_farmaco)= mysql_fetch_row($resultado)){
					$array_tox_farmaco=devuelve_array_tox($id_farmaco);
					$array_links_farmaco=devuelve_links($id_farmaco);
					$array_indicaciones_farmaco=devuelve_array_indicaciones($id_farmaco);
					$excel->writeCol($nombre_farmaco);
					while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
					$clave_array=$cod_tox."tx0";
						if (array_key_exists($clave_array,$array_tox_farmaco)){
						$excel->writeColNum($array_tox_farmaco[$clave_array]);					
						}else{
						$excel->writeColNum("");	
						}
					$clave_array=$cod_tox."tx4";
						if (array_key_exists($clave_array,$array_tox_farmaco)){
						$excel->writeColNum($array_tox_farmaco[$clave_array]);					
						}else{
						$excel->writeColNum("");	
						}
					
					}
					reset($array_toxicidades_cabecera);
					$excel->writeRow();
				}
		}		
}
					 

$excel->writeRow();
$excel->close();
header("location:export_excel/fda_drugs2.xls");
?>