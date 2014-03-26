<?php
include ("inc/login.php"); 
include ("inc/config.php");
//include ("inc/alg_functions.php");

function devuelve_array_tox_inv($id_farmaco){
global $connect,$basedatos;
$query_toxicidades="select id_toxicidad,tx1,tx2 from farmacos_inv_toxicidad where id_farmaco='".$id_farmaco."'";
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
$array_tox_farmaco=array();
if ($lista_toxicidades){
$numero_toxicidades=mysql_num_rows($lista_toxicidades);
	if($numero_toxicidades == 0) {
	} else {
		while(list($id_toxicidad,$tx1,$tx2)= mysql_fetch_row($lista_toxicidades)){
		$clave_array1=$id_toxicidad."tx1";
		$clave_array2=$id_toxicidad."tx2";
		$array_tox_farmaco[$clave_array1]=$tx1;
		$array_tox_farmaco[$clave_array2]=$tx2;
		//echo $id_toxicidad."<br>";
		}
	}
}
return $array_tox_farmaco;
}

function devuelve_array_dianas($id_farmaco){
global $connect,$basedatos;
$query_dianas="select id_diana,valor_diana from farmacos_inv_diana where id_farmaco='".$id_farmaco."'";
$lista_dianas = mysql_query($query_dianas, $connect);
$array_dianas_farmaco=array();
if ($lista_dianas){
$numero_dianas=mysql_num_rows($lista_dianas);
	if($numero_dianas == 0) {
	} else {
		while(list($id_diana,$valor_diana)= mysql_fetch_row($lista_dianas)){
		$array_dianas_farmaco[$id_diana]=$valor_diana;
		}
	}
}
return $array_dianas_farmaco;
}
function devuelve_links($id_farmaco){
global $connect,$basedatos;
$array_links_farmaco=array();
$query_link="select url_link,tipo_link from farmacos_inv_link where id_farmaco='".$id_farmaco."'";
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
$query_farmacos = "select id_farmaco,cod_farmaco,nombre_farmaco,autores,categoria_diana,tx1desc,tx2desc,comentarios,tipo_ensayo from farmacos_inv";
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos,$connect);

$query_toxicidades_cabecera="SELECT distinct farmacos_inv_toxicidad.id_toxicidad,toxicidad.nombre_toxicidad FROM farmacos_inv_toxicidad,toxicidad where
farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad order by toxicidad.nombre_toxicidad asc";
$lista_toxicidades_cabecera=mysql_query($query_toxicidades_cabecera, $connect);
if ($lista_toxicidades_cabecera){
	$numero_toxicidades_cabecera=mysql_num_rows($lista_toxicidades_cabecera);
		if($numero_toxicidades_cabecera == 0) {
		}else{
			while(list($id_toxicidad_cabecera,$nombre_toxicidad_cabecera)= mysql_fetch_row($lista_toxicidades_cabecera)){
			$array_toxicidades_cabecera[$id_toxicidad_cabecera]=$nombre_toxicidad_cabecera;
			}
		}
}

$query_dianas_cabecera="SELECT distinct farmacos_inv_diana.id_diana,dianas.descripcion_diana FROM farmacos_inv_diana,dianas where
farmacos_inv_diana.id_diana=dianas.id_diana order by dianas.descripcion_diana asc";
$lista_dianas_cabecera=mysql_query($query_dianas_cabecera, $connect);
if ($lista_dianas_cabecera){
	$numero_dianas_cabecera=mysql_num_rows($lista_dianas_cabecera);
		if($numero_dianas_cabecera == 0) {
		}else{
			while(list($id_diana_cabecera,$descripcion_diana_cabecera)= mysql_fetch_row($lista_dianas_cabecera)){
			$array_dianas_cabecera[$id_diana_cabecera]=$descripcion_diana_cabecera;
			}
		}
}

$query_tipos_link="select tipo_link,descripcion_tipo_link from categorias_link where link_finv=1";
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

$excel=new ExcelWriter("export_excel/investigational_drugs.xls");
if($excel==false) {    
echo $excel->error;
}
			//cabecera
			
			$excel->writeCol("<b>no</b>");
			
			$excel->writeCol("<b>DRUG NAME</b>");
			$excel->writeCol("<b>AUTHORS</b>");
			
			
			while (list ($cod_link, $des_link) = each ($array_links_cabecera)){
			$excel->writeCol("<b>".$des_link."</b>");
			}
			reset($array_links_cabecera);
			$excel->writeCol("<b>related adverse events <br/> AEs) reported in =>10%</b>");
			while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
			$excel->writeCol("<b>AE=>10%</b><br/><b>".$des_tox."</b>");
			}
			reset($array_toxicidades_cabecera);
			$excel->writeCol("<b>drug-related AEs => Gr 3</b>");
			while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
			$excel->writeCol("<b>G=>3</b><br/><b>".$des_tox."</b>");
			}
			reset($array_toxicidades_cabecera);
			
			$excel->writeCol("<b>COMMENTS AT</b>");
			$excel->writeCol("<b>type of clinical trial</b>");
			while (list ($cod_diana,$des_diana) = each ($array_dianas_cabecera)){
			$excel->writeCol("<b>".$des_diana."</b>");
			}
			reset($array_dianas_cabecera);	
			$excel->writeRow();



if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {
			
				while(list($id_farmaco,$cod_farmaco,$nombre_farmaco,$autores,$categoria_diana,$tx1desc,$tx2desc,$comentarios,$tipo_ensayo)= mysql_fetch_row($resultado)){
					$array_tox_farmaco=devuelve_array_tox_inv($id_farmaco);
					$array_dianas_farmaco=devuelve_array_dianas($id_farmaco);
					$array_links_farmaco=devuelve_links($id_farmaco);
				
					$excel->writeCol($cod_farmaco);
					$excel->writeCol($nombre_farmaco);
					$excel->writeCol($autores);
					while (list ($cod_link, $des_link) = each ($array_links_cabecera)){
						if (array_key_exists($cod_link,$array_links_farmaco)){
						$excel->writeCol($array_links_farmaco[$cod_link]);
						}else{
						$excel->writeCol("");
						}
					}
					
					reset($array_links_cabecera);
					$excel->writeCol($tx1desc); 
					while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
					$clave_array=$cod_tox."tx1";
						if (array_key_exists($clave_array,$array_tox_farmaco)){
						$excel->writeColNum($array_tox_farmaco[$clave_array]);					
						}else{
						$excel->writeColNum("0");	
						}
					}
					reset($array_toxicidades_cabecera);
					$excel->writeCol($tx2desc);
					while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
					$clave_array=$cod_tox."tx2";
						if (array_key_exists($clave_array,$array_tox_farmaco)){
						$excel->writeColNum($array_tox_farmaco[$clave_array]);					
						}else{
						$excel->writeColNum("0");	
						}
					}
					reset($array_toxicidades_cabecera);
					$excel->writeCol($comentarios);
					$excel->writeCol($tipo_ensayo);
					while (list ($cod_diana,$des_diana) = each ($array_dianas_cabecera)){
						if (array_key_exists($cod_diana,$array_dianas_farmaco)){
						$excel->writeCol($array_dianas_farmaco[$cod_diana]);					
						}else{
						$excel->writeCol("");	
						}
					}
					reset($array_dianas_cabecera);	
					$excel->writeRow();
				}
		}		
}
					 

$excel->writeRow();
$excel->close();
header("location:export_excel/investigational_drugs.xls");
?>