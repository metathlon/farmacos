<?php
include ("inc/login.php"); 
include ("inc/config.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print"> 
	<!--[if lt IE 8]>
	 <link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection">
	<![endif]-->
<style>
body{
background-color:#edf5ff;
}

div.ventanas{
/*
margin:10px;
padding: 5px;
border:1px solid;
*/
}

#tabBody
{

margin:10px;
padding:10px;
/*
width:930px;
background-color: #FFF;
*/


}
.tabArea
{
list-style-type: none;
float:left;
width:100%;
padding: 0px 0px 0px 0px;
margin:0px;
}



.tabOn, .tabOff, .tabHover
{
	float: left;
	width:150px;
	height:20px;
	border: 2px solid black;
	border-bottom-width: 0px;
	border-color: #CFE2EB #9AC0D3 #9AC0D3 #CFE2EB;
	cursor:pointer;
	text-align:center;
	font-size: 12px;
	color: #000000;
	margin-right: 10px;
}

.tabOn { z-index:2; background-color:#C4DBE6; }

.tabOff { z-index:0; background-color:#C4DBE6;}
                
.tabHover { background-color:#9AC0D3; }
/*
#tab2 { width:150px; }
#tab3 { width:150px; }
*/
#tabCont1,#tabCont2,#tabCont3,#tabCont4,#tabCont5
{
clear:both;
width:870px;
height:460px;
border: 2px solid black;
border-color: #CFE2EB #9AC0D3 #9AC0D3 #CFE2EB;
background-color: #C4DBE6;
border-color: #CFE2EB #9AC0D3 #9AC0D3 #CFE2EB;
z-index: 101;
display: none;
padding:10px;

}

#tabCont1
{
display: block;	
}

.scroll200h{
overflow:auto;
height:200px;
}
.scroll600h{
overflow:auto;
height:400px;
}
.scrollh{
overflow:auto;
}
.contenedor_h{
float: left;
margin-right: -30000px;
}

ul.m0{
padding:0px;
margin:0px;
list-style-type: none;
font-family: Arial, Helvetica, sans-serif; 
font-size: 11px; 
font-style: normal; 
color: #000000; 
}


li.cabecera{
padding-left: 4px;
margin-bottom: 2px;
font-weight: bold; 
}
.cab_gris{
color: #000;
background: #d8d8da url(img/sprite.png) repeat-x 0 -10;

}
.cab_turquesa{
color: #000;
font-size: 12px; 
background-color:#75b5d0; 
}
.cab_fila{
color: #000;
font-weight: bold; 
}

li.par{
padding-left: 4px;
background-color:#FFF; 
/*background-color:#BBD7E3; */

}
li.impar{
padding-left: 4px;
background-color:#e1edf2; 

}

li.par div,li.impar div{
padding-bottom: 1px;
padding-top: 1px;
}


div.izq{
margin-left: 10px;
margin-right: 0px;
}
div.cent{
margin-left: 10px;
margin-right: 10px;
}

div.dcha{
margin-left: 0px;
margin-right: 10px;
}

div.izq,div.dcha,div.cent{
list-style-type: none;
margin-bottom: 5px;
margin-top: 5px;
padding-left: 2px;
padding-bottom: 4px;
padding-right: 2px;
padding-top: 4px;
/*display:block;*/
}
div.cabecera1{
clear: both;
background-color: #063e5d;
padding: 5px;
margin-bottom: 5px;
}
div.cuerpo1{
clear:both;
padding:15px;
background-color: #CBDCED;
	/*
background-color:#bcc5cc;
*/

}

.recuadroizq{
padding:0px;
margin-top: 5px;
margin-right:0px;
margin-bottom: 10px;
margin-left: 10px;
background:#FFFFFF;
}
.recuadrodcha{
padding:0px;
margin-top: 5px;
margin-right:10px;
margin-bottom: 5px;
margin-left: 0px;
list-style-type: none;
}
.cabecerarecuadro{
background: url(img/sprite.png) repeat-x 0 0;
border-top: 1px none #999999;
border-right: 1px none #999999;
border-bottom: 1px solid #999999;
border-left: 1px none #999999;
display: block;
}
.titulorecuadro{
float: left;
font-family: Arial, Helvetica, sans-serif;
font-weight: bold;
text-decoration:none;
font-size: 12px;
color: #000000;
margin: 3px 10px 3px 8px;	
}
.cuerporecuadro{
padding:0px;
margin-top: 5px;
margin-right:15px;
margin-bottom: 5px;
margin-left: 15px;

}
.conborde{
border-width: 1px;
border-style: solid;
border-color: #808080;
}

.recuadrotox{
padding:0px;
margin-top: 5px;
margin-right:10px;
margin-bottom: 5px;
margin-left: 0px;
list-style-type: none;
/*
background-color:#E3E8EA;
*/
}
.cabeceratox{
/*
background-color:#adf0ee;
border-top: 1px none #999999;
border-right: 1px none #999999;
border-bottom: 1px solid #999999;
border-left: 1px none #999999;
*/
font-family: Arial, Helvetica, sans-serif;
font-weight: bold;
color:#8E0018;
text-decoration:none;
font-size: 11px;
padding-left:5px;
display: block;
}

.cuerpotox{
padding:2px;
margin-top: 5px;
margin-right:5px;
margin-bottom: 5px;
margin-left: 5px;

}



p.leyenda{
font-weight: bold; font-size:1em; margin-top:-0.2em; margin-bottom:0.2em;color:#FFFFFF; 	
}
p.formulario{
clear:both;
height:20px;
margin-bottom: 10px;
margin-left: 10px;
padding: 0px;
}
p.fomulariosin{
clear:both;
margin-bottom: 10px;
margin-left: 10px;
padding: 0px;
}
p.centrado{
padding-top: 10px;
text-align:center;
}

.botoncabecera{
width:16px;
height: 16px;
background:url(img/sprite.png) no-repeat 0 0;  
float: right;
margin: 4px 4px 4px 0;
}
.bcabeceratabla{
width:16px;
height:16px;
background:url(img/sprite.png) no-repeat 0 0;  
margin:2px 2px 2px 5px;
vertical-align: middle;
float: right;
/*margin:0px;*/
}
.blineatabla{
float:left;
width:16px;
height:16px;
background:url(img/sprite4.png) no-repeat 0 0;  
margin:2px 2px 2px 5px;
vertical-align: middle;
/*margin:0px;*/
}

.bdown{
background-position: -11px -802px;
} 

.badd{
background-position: 0 -350px;
}
.badd2{
background-position: 0 -330px;
}
.bedit{
background-position:0 -1452px ;
}
.bcal{
background-position:0 -200px ;
}
.bpapelera{
background-position:0 -726px ;
}
.bok{
background-position:0 -1718px ;
}
.bbuscar{
background-position:0 -1584px ;
}
.bpdf{
background-position:0 -1848px ;
}
.binfo{
background-position: 0 -1200px;
}

</style>
<title>FARMACOS</title>
</head>
<body>
<div class="ventanas clearfix">

<?php
function lista_toxicidades_farmaco($farmaco_id,$id_tox_n0,$nivel){
global $basedatos,$connect;	
							$query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,
							id_categoria,valor_toxicidad from farmacos_toxicidad,toxicidad  where farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco='".$farmaco_id."' and id_toxicidad_n0='".$id_tox_n0."'";
							$lista_toxicidades = mysql_query($query_toxicidades, $connect);
							if ($lista_toxicidades){
							$numero_toxicidades=mysql_num_rows($lista_toxicidades);
								if($numero_toxicidades == 0) {
								} else {
								//repartirlo en 3 columnas
								
								
								
								
								$gradeall=array();
								$grade34=array();
									while(list($id_toxicidad,$nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){	
										$array_toxicidades[$id_toxicidad]=$nombre_toxicidad;
										if ($id_categoria==0){
										$gradeall[$id_toxicidad]=$valor_toxicidad;
										}
										if ($id_categoria==4){
										$grade34[$id_toxicidad]=$valor_toxicidad;
										}
									}	
							
							    $n_toxicidades_farmaco=count($array_toxicidades);
								$resto=$n_toxicidades_farmaco%3;
								if ($resto==1){
								$ad1=1;
								$ad2=0;
								}else if($resto==2){
								$ad1=1;
								$ad2=1;
								}else{
								$ad1=0;
								$ad2=0;
								}
								$filas_col1=($n_toxicidades_farmaco-$resto)/3 + $ad1;
								$filas_col2=($n_toxicidades_farmaco-$resto)/3+ $ad2;
								$filas_col3=($n_toxicidades_farmaco-$resto)/3;
								
							
							
							
							
							
							$a = 0;
							$dcolor_A = "par";  //cambio a par para que se vean del mismo color
							$dcolor_B = "par"; 
							$cfilas=1;
							$ccolumnas=1;
							$fin_tabla=$filas_col1;
							
							while (list ($cod_tox, $des_tox) = each ($array_toxicidades)){
										if (array_key_exists($cod_tox,$gradeall)){
										$txall=$gradeall[$cod_tox];
										}else{
										$txall="---";
										}
										if (array_key_exists($cod_tox,$grade34)){
										$tx34=$grade34[$cod_tox];
										}else{
										$tx34="---";
										}
							
							if	($cfilas==1){
							echo "<div class=\"span-6\">\n";
								echo "<ul class=\"m0\">\n";
									echo "<li class=\"cabecera clearfix\">\n"; 
										echo "<div class=\"span-4 last\">&nbsp;</div>\n";
										echo "<div class=\"span-1\">All</div>\n";
										echo "<div class=\"span-1 last\">3/4</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
							}
							
							
							//while(list($nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){
								$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
								echo "<li class=\"$dcolor\">\n";
									echo "<div class=\"span-4 last cab_fila\">".$des_tox."</div>\n";
									echo "<div class=\"span-1\">$txall</div>\n";
									echo "<div class=\"span-1 last\">$tx34</div>\n";
									echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
							$a = ($dcolor == $dcolor_A ? 1 : 0);
							if	($cfilas==$fin_tabla){
							echo "</ul>\n";	
							echo "</div>\n";
							$cfilas=0;
								if ($ccolumnas < 3){
								$ccolumnas=$ccolumnas+1;
								$valor_columnas="filas_col".$ccolumnas;
								$fin_tabla=$$valor_columnas;
								}
							}
							

							
							
							$cfilas=$cfilas+1;
							
							}
			
							}
							}			
							
	
}

function lista_indicaciones_farmaco($farmaco_id,$nivel){
global $basedatos,$connect;	

	$query_indicaciones= "select farmacos_indicaciones.id_indicacion,descripcion_indicacion,testado  from farmacos_indicaciones,indicaciones where farmacos_indicaciones.id_indicacion=indicaciones.id_indicacion and id_farmaco=".$farmaco_id;
	$lista_indicaciones = mysql_query($query_indicaciones, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-7\">Indication</div>\n";
		echo "<div class=\"span-0\"></div>\n";
		if ($nivel > 1){
		echo "<div class=\"span-0\"></div>\n";
		echo "<div class=\"span-0\"></div>\n";
		}
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";
if ($lista_indicaciones){
	$numero_indicaciones=mysql_num_rows($lista_indicaciones);
		if($numero_indicaciones== 0) {
		} else {
				while(list($id_indicacion,$descripcion_indicacion,$testado)= mysql_fetch_row($lista_indicaciones)){
				
				echo "<li class=\"par\">\n";
					echo "<div class=\"span-7\">".$descripcion_indicacion."</div>\n";
					echo "<div class=\"span-0\">".$testado."</div>\n";
					if ($nivel > 1){
					echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_indicacion('".$farmaco_id."','".$id_indicacion."')\"></a></div>\n";
					echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_fda.php?cop=eif&id_farmaco=".$farmaco_id."&id_indicacion=".$id_indicacion."')\"></a></div>\n";
					}
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				
				}
		}			
	}
	echo "</ul>\n";
}

function lista_links_farmaco($farmaco_id,$tipo_link,$nivel){
global $basedatos,$connect;	
	
$query_links= "select id_link,descripcion_link,url_link,tipo_link from farmacos_links where id_farmaco='".$farmaco_id."' and tipo_link='".$tipo_link."'";
$lista_links = mysql_query($query_links, $connect);
	
	if ($lista_links){
	$numero_links=mysql_num_rows($lista_links);
	if($numero_links== 0) {
		} else {
		//echo "<ul class=\"m0\">\n";	
			while(list($id_link,$descripcion_link,$url_link,$tipo_link)= mysql_fetch_row($lista_links)){
			
			echo "<li class=\"par\">\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$url_link."')\"></a></div>\n";
				echo "<div class=\"span-6\">".$descripcion_link."</div>\n";
				echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
			
			}
		//echo "</ul>\n";
		}			
	}

}

function devuelve_toxicidades($farmaco_id,$toxicidad_id,$categoria_id){
global $basedatos,$connect;	
$query_toxicidades="select valor_toxicidad from farmacos_toxicidad where id_farmaco=".$farmaco_id." and id_toxicidad=".$toxicidad_id. " and id_categoria=".$categoria_id;
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
	if ($lista_toxicidades){
	$numero_toxicidades=mysql_num_rows($lista_toxicidades);
		if($numero_toxicidades == 0) {
		return 0;
		} else {
			list($valor_toxicidad)= mysql_fetch_row($lista_toxicidades);
		return $valor_toxicidad;
		}								
	}else{
	return "error";	
	}

}


function lista_toxicidades_farmaco_nuevo($farmaco_id,$id_tox_n0,$nivel){
global $basedatos,$connect;	

	$query_toxicidades="select nombre_toxicidad,tx1,tx2,toxicidad.id_toxicidad from farmacos_inv_toxicidad,toxicidad  where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco='".$farmaco_id."' and id_toxicidad_n0='".$id_tox_n0."'";
		//$query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,
		//id_categoria,valor_toxicidad from farmacos_toxicidad,toxicidad  where farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=".$farmaco_id;
		$lista_toxicidades = mysql_query($query_toxicidades, $connect);
		if ($lista_toxicidades){
		$numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
			//repartirlo en 3 columnas
			
			$resto=$numero_toxicidades%3;
			if ($resto==1){
			$ad1=1;
			$ad2=0;
			}else if($resto==2){
			$ad1=1;
			$ad2=1;
			}else{
			$ad1=0;
			$ad2=0;
			}
			$filas_col1=($numero_toxicidades-$resto)/3 + $ad1;
			$filas_col2=($numero_toxicidades-$resto)/3+ $ad2;
			$filas_col3=($numero_toxicidades-$resto)/3;

		$a = 0;
		$dcolor_A = "par";
		$dcolor_B = "par"; 
		$cfilas=1;
		$ccolumnas=1;
		$fin_tabla=$filas_col1;
		$array_0_1=array("","<img class=\"blineatabla bok\" />");
		while(list($nombre_toxicidad,$tx1,$tx2,$id_toxicidad)= mysql_fetch_row($lista_toxicidades)){ 	
		
		if	($cfilas==1){
		echo "<div class=\"span-6\">\n";
		echo "<ul class=\"m0\">\n";
			echo "<li class=\"cabecera clearfix\">\n"; 
			echo "<div class=\"span-3\">&nbsp;</div>\n";
			echo "<div class=\"span-2\">AE=>10&nbsp;&nbsp;Gr=>3</div>\n";
			echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
		}
		
		
		//while(list($nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){
			$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			echo "<li class=\"$dcolor\">\n";
				echo "<div class=\"span-3 cab_fila\">".$nombre_toxicidad."</div>\n";
				echo "<div class=\"span-1\">".$array_0_1[$tx1]."</div>\n";
				echo "<div class=\"span-1 last\">".$array_0_1[$tx2]."</div>\n";
				if ($nivel > 1){
				echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_toxicidad('".$farmaco_id."','".$id_toxicidad."')\"></a></div>\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_inv.php?cop=etfn&id_farmaco=".$farmaco_id."&id_toxicidad=".$id_toxicidad."')\"></a></div>\n";
				}
				echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
		$a = ($dcolor == $dcolor_A ? 1 : 0);
		if	($cfilas==$fin_tabla){
		echo "</ul>\n";	
		echo "</div>\n";
		$cfilas=0;
			if ($ccolumnas < 3){
			$ccolumnas=$ccolumnas+1;
			$valor_columnas="filas_col".$ccolumnas;
			$fin_tabla=$$valor_columnas;
			}
		}
		
		
		
		$cfilas=$cfilas+1;
		
		}
		
		
		}
		}			
		

}
function lista_dianas_farmaco_nuevo($farmaco_id,$nivel){
global $basedatos,$connect;	

	$query_dianas= "select farmacos_inv_diana.id_diana,descripcion_diana,valor_diana,dianas.id_diana_n0,descripcion_diana_n0
	from farmacos_inv_diana,dianas,dianas_n0 
	where farmacos_inv_diana.id_diana=dianas.id_diana 
	and dianas.id_diana_n0=dianas_n0.id_diana_n0
	and id_farmaco='".$farmaco_id."' order by descripcion_diana_n0,descripcion_diana";
	$lista_dianas = mysql_query($query_dianas, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-5\">Target</div>\n";
		echo "<div class=\"span-2\"></div>\n";
		if ($nivel > 1){
		echo "<div class=\"span-0\"></div>\n";
		echo "<div class=\"span-0\"></div>\n";
		}
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";
	
	
if ($lista_dianas){
	$numero_dianas=mysql_num_rows($lista_dianas);
		if($numero_dianas== 0) {
		} else {
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				$grp_diana_n0_anterior='0';
				while(list($id_diana,$descripcion_diana,$valor_diana,$id_diana_n0,$descripcion_diana_n0)= mysql_fetch_row($lista_dianas)){
				$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
				if ($grp_diana_n0_anterior==$id_diana_n0){
					echo "<li class=\"$dcolor\">\n";
					echo "<div class=\"span-6\">".$descripcion_diana."</div>\n";
					echo "<div class=\"span-2\">".$valor_diana."</div>\n";
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				}else{
						echo "<li class=\"cabecera cab_turquesa\">\n"; 
							echo "<div class=\"span-8\">$descripcion_diana_n0</div>\n";
							echo "<div class=\"span-0 last\">&nbsp;</div>\n";
							echo "<div class=\"clear\"></div>\n";
						echo "</li>\n";
					echo "<li class=\"$dcolor\">\n";
							echo "<div class=\"span-6\">".$descripcion_diana."</div>\n";
							echo "<div class=\"span-2\">".$valor_diana."</div>\n";
							echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
							
						}
		   		$grp_diana_n0_anterior=$id_diana_n0;
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";
}

function lista_links_farmaco_nuevo($farmaco_id,$tipo_link,$nivel){
global $basedatos,$connect;	
	
$query_links= "select id_link,descripcion_link,url_link,tipo_link from farmacos_inv_link where id_farmaco='".$farmaco_id."' and tipo_link='".$tipo_link."'";
$lista_links = mysql_query($query_links, $connect);
	
	if ($lista_links){
	$numero_links=mysql_num_rows($lista_links);
	if($numero_links== 0) {
		} else {
		//echo "<ul class=\"m0\">\n";	
			while(list($id_link,$descripcion_link,$url_link,$tipo_link)= mysql_fetch_row($lista_links)){
			
			echo "<li class=\"par\">\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$url_link."')\"></a></div>\n";
				echo "<div class=\"span-6\">".$descripcion_link."</div>\n";
				echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
			
			}
		//echo "</ul>\n";
		}			
	}

}
function lista_pathways_farmaco($id_farmaco,$GeneId,$nivel){
global $basedatos,$connect;	

$query_pathways= "select farmacos_inv_pathways.id_pathway,nombre_pathway,id_external from farmacos_inv_pathways,pathways where farmacos_inv_pathways.id_pathway=pathways.id_pathway and id_farmaco='".$id_farmaco."'";
$lista_pathways = mysql_query($query_pathways, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-18\">Pathway</div>\n";
		echo "<div class=\"span-0\"></div>\n";
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";
	
	
if ($lista_pathways){
	$numero_pathways=mysql_num_rows($lista_pathways);
		if($numero_pathways== 0) {
		} else {
			$a = 0;
			$dcolor_A = "impar";
			$dcolor_B = "par"; 
			while(list($id_pathway,$nombre_pathway,$id_external)= mysql_fetch_row($lista_pathways)){
			$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			if ($GeneId==0){
			$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;
			}else{
			$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external."?Sel=geneid:".$GeneId."#show=genes";
			
			}
			
				echo "<li class=\"$dcolor\">\n";
					echo "<div class=\"span-18\">".$nombre_pathway."</div>\n";
					echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$link_pathway."')\"></a></div>\n";
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";

}

function ver_farmaco_nuevo($id_farmaco){
global $connect,$basedatos;
$query_farmacos = "select nombre_farmaco,autores,descripcion_categoria_diana,tx1desc,tx2desc,comentarios,tipo_ensayo from farmacos_inv,categorias_dianas where  farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and id_farmaco=".$id_farmaco;	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos, $connect);
if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
					if($numero_farmacos == 0) {
					echo "<p class=\"leyenda\">Error No aparece ningun registro</p>\n";
					} else {
					list($nombre_farmaco,$autores,$categoria_diana,$tx1desc,$tx2desc,$comentarios,$tipo_ensayo)= mysql_fetch_row($resultado);
//echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-21 last\">\n";
	      		echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">$nombre_farmaco</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";

				echo "<div class=\"recuadroizq conborde\">\n";
					echo "<div class=\"cabecerarecuadro clearfix\">\n";
						echo "<div class=\"titulorecuadro\">General Information</div>\n";
					echo "</div>\n";
					
					echo "<div class=\"cuerporecuadro clearfix\">\n";
						echo "<div class=\"span-19 last\">\n";
							echo "<div class=\"recuadroizq conborde clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Drug Name</div>\n";
										echo "<div class=\"span-8\">$nombre_farmaco</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Auhors</div>\n";
										echo "<div class=\"span-8\">$autores</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Drug Family</div>\n";
										echo "<div class=\"span-8\">$categoria_diana</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Type of Clinical Trial</div>\n";
										echo "<div class=\"span-8\">$tipo_ensayo</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Commments</div>\n";
										echo "<div class=\"span-8\">$comentarios</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
					//echo "<div id=\"tabCont2\" class=\"clearfix\">\n";
						
						
						
						/*
						
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Links</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
								$query_grplnk="select distinct categorias_link.tipo_link,descripcion_tipo_link from categorias_link,farmacos_inv_link where
											id_farmaco='".$id_farmaco."' and
											categorias_link.tipo_link=farmacos_inv_link.tipo_link";
										$resultado_grplnk = mysql_query($query_grplnk,$connect);
										if ($resultado_grplnk){
										$numero_grplnk=mysql_num_rows($resultado_grplnk);
											if($numero_grplnk == 0) {
											} else {
												while(list($id_grplnk,$descripcion_grplnk)= mysql_fetch_row($resultado_grplnk)){
													echo "<li class=\"cabecera cab_gris clearfix\">\n";
													echo "<div class=\"span-6\">".$descripcion_grplnk."</div>\n";
													echo "<div class=\"span-0\">&nbsp;</div>\n";
													echo "<div class=\"clear\"></div>\n";
													echo "</li>\n";
													lista_links_farmaco_nuevo($id_farmaco,$id_grplnk,1);	
												}
											}	
										}
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n";
					*/
						
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Data Supporting</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco_nuevo($id_farmaco,4,1);	
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n";
						
						echo "<div class=\"recuadroizq conborde\">\n";
									echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Drug Toxicity</div>\n";
									echo "</div>\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									echo "<div class=\"recuadroizq conborde clearfix\">\n";
							echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-8 cab_fila\">related adverse events (AEs) reported in =>10%</div>\n";
										echo "<div class=\"span-12\">$tx1desc</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
							echo "</ul>\n";
							echo "</div>\n";				
						
						echo "<div class=\"recuadroizq conborde clearfix\">\n";
							echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-8 cab_fila\">drug-related AEs => Gr 3</div>\n";
										echo "<div class=\"span-12\">$tx2desc</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";	
									echo "</ul>\n";
							echo "</div>\n";
																	
									$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_inv_toxicidad,toxicidad,toxicidad_n0 where
											id_farmaco='".$id_farmaco."' and
											farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
											toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0";
										$resultado_grptx = mysql_query($query_grptx,$connect);
										if ($resultado_grptx){
										$numero_grptx=mysql_num_rows($resultado_grptx);
											if($numero_grptx == 0) {
											} else {
												while(list($id_grptx,$descripcion_grptx)= mysql_fetch_row($resultado_grptx)){
													echo "<div class=\"recuadrotox\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grptx</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_toxicidades_farmaco_nuevo($id_farmaco,$id_grptx,1);
														//lista_toxicidades_categoria_diana($id_categoria_diana,$id_grptx);
														echo "</div>\n";
													echo "</div>\n";
												}
											}	
										}
									echo "</div>\n";
						echo "</div>\n";
					
					
					
					//echo "</div>\n";
					//echo "<div id=\"tabCont4\" class=\"clearfix\">\n";
						
					//echo "</div>\n";
					
					
					//echo "<div id=\"tabCont5\" class=\"clearfix\">\n";
					echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
							echo "<div class=\"titulorecuadro\">Pathways</div>\n";
						echo "</div>\n";
						echo "<div class=\"cuerporecuadro clearfix\">\n";
							lista_pathways_farmaco($id_farmaco,0,1);
						echo "</div>\n";
					echo "</div>\n";
					
					echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Targets</div>\n";
								echo "</div>\n";
								echo "<div class=\"cuerporecuadro clearfix\">\n";
										lista_dianas_farmaco_nuevo($id_farmaco,1);
								echo "</div>\n";
					echo "</div>\n";
		
					  echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Links to Drug Sensibility</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco_nuevo($id_farmaco,5,1);	
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n";
						 echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Other Links</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco_nuevo($id_farmaco,0,1);	
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n"; 
						
						
						
						
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Clinical Data Investigational Agent Abstract</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco_nuevo($id_farmaco,3,1);	
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n";
						
						
						
						
						echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Ongoing Clinical Trials</div>\n";
									$link_trial="http://www.clinicaltrials.gov/ct2/results?term=".urlencode($nombre_farmaco)."&Search=Search";
									echo "<a class=\"botoncabecera binfo\" href=\"javascript:abrir_ventana('".$link_trial."')\"></a>\n";
								echo "</div>\n";
						echo "</div>\n";
						
						/*
						echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Drug Dosage</div>\n";
									$link_drug_dosage="http://www.drugs.com/search.php?sources%5B%5D=dosage&searchterm=".urlencode($nombre_farmaco);
									echo "<a class=\"botoncabecera binfo\" href=\"javascript:abrir_ventana('".$link_drug_dosage."')\"></a>\n";
								echo "</div>\n";
						echo "</div>\n";
			
			            */
			
			
			
			echo "</div>\n";
		echo "</div>\n";
	echo "</div>\n";
//echo "</div>\n";
 }

}
include ("inc/footer_ventana.php");
}
function ver_farmaco_fda($id_farmaco){
global $connect,$basedatos;
$query_farmacos = "select nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco from farmacos where id_farmaco=".$id_farmaco;	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos, $connect);
if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
					if($numero_farmacos == 0) {
					echo "<p class=\"leyenda\">Error No aparece ningun registro</p>\n";
					} else {
					list($nombre_farmaco,$observaciones_farmaco,$clasificacion_toxicidad_farmaco)= mysql_fetch_row($resultado);
//echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-21\">\n";
	      		echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">$nombre_farmaco</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";

				echo "<div class=\"recuadroizq\">\n";
					echo "<div class=\"cabecerarecuadro clearfix\">\n";
						echo "<div class=\"titulorecuadro\">General Information</div>\n";
					echo "</div>\n";
					echo "<div class=\"cuerporecuadro clearfix\">\n";
						
						echo "<div class=\"span-19 last\">\n";
							echo "<div class=\"recuadroizq conborde clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Drug Name</div>\n";
										echo "<div class=\"span-10\">$nombre_farmaco</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">More Information</div>\n";
										echo "<div class=\"span-10\">$observaciones_farmaco</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
								echo "</ul>\n";
							echo "</div>\n";
						
						echo "<div class=\"recuadroizq conborde clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Clasification Advers Reaction in Clinical Trials</div>\n";
										echo "<div class=\"span-10\">$clasificacion_toxicidad_farmaco</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
								echo "</ul>\n";
							echo "</div>\n";
						
						echo "</div>\n";
				
					echo "</div>\n";
					echo "</div>\n";
					
					
					/*
						echo "<div class=\"recuadroizq\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Links</div>\n";
							echo "</div>\n";				
							echo "<div class=\"cuerporecuadro clearfix\">\n";
							echo "<ul class=\"m0\">\n";
								
								$query_grplnk="select distinct categorias_link.tipo_link,descripcion_tipo_link from categorias_link,farmacos_links where
											id_farmaco='".$id_farmaco."' and
											categorias_link.tipo_link=farmacos_links.tipo_link";
										$resultado_grplnk = mysql_query($query_grplnk,$connect);
										if ($resultado_grplnk){
										$numero_grplnk=mysql_num_rows($resultado_grplnk);
											if($numero_grplnk == 0) {
											} else {
												while(list($id_grplnk,$descripcion_grplnk)= mysql_fetch_row($resultado_grplnk)){
													echo "<li class=\"cabecera cab_gris clearfix\">\n";
													echo "<div class=\"span-6\">".$descripcion_grplnk."</div>\n";
													echo "<div class=\"span-0\">&nbsp;</div>\n";
													echo "<div class=\"clear\"></div>\n";
													echo "</li>\n";
														
														lista_links_farmaco($id_farmaco,$id_grplnk,1);
												}
											}	
										}
								
								echo "</ul>\n";
								
							echo "</div>\n";
						echo "</div>\n";
					*/
						
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">FDA Full Prescription Information</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco($id_farmaco,1,1);	
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n";
						
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Link to Drugbank Database</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco($id_farmaco,6,1);	
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n";
						
						
						
						echo "<div class=\"recuadroizq \">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Tumor Type</div>\n";
								echo "</div>\n";
								echo "<div class=\"cuerporecuadro clearfix\">\n";
										lista_indicaciones_farmaco($id_farmaco,1);
								echo "</div>\n";
						echo "</div>\n";
	
						echo "<div class=\"recuadroizq\">\n";
									
									echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Drug Toxicity</div>\n";
									echo "</div>\n";
									
									echo "<div class=\"cuerporecuadro clearfix\">\n";
										//echo "<div class=\"scroll600h\">\n";
									$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_toxicidad,toxicidad,toxicidad_n0 where
											id_farmaco='".$id_farmaco."' and
											farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
											toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0";
										$resultado_grptx = mysql_query($query_grptx,$connect);
										if ($resultado_grptx){
										$numero_grptx=mysql_num_rows($resultado_grptx);
											if($numero_grptx == 0) {
											} else {
												while(list($id_grptx,$descripcion_grptx)= mysql_fetch_row($resultado_grptx)){
													echo "<div class=\"recuadrotox\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grptx</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_toxicidades_farmaco($id_farmaco,$id_grptx,1);
														//lista_toxicidades_farmaco_nuevo($id_farmaco,$id_grptx);
														//lista_toxicidades_categoria_diana($id_categoria_diana,$id_grptx);
														echo "</div>\n";
													echo "</div>\n";
												}
											}	
										}
		
										//echo "</div>\n";
									echo "</div>\n";
								      
						echo "</div>\n";
					
					
					echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Chemical structure</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco($id_farmaco,2,1);	
								echo "</ul>\n";
							echo "</div>\n";
					echo "</div>\n";
					
					 echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Links to Drug Sensibility</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco($id_farmaco,5,1);	
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n"; 
					
					 echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Other Links</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco($id_farmaco,0,1);	
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n"; 
					 
					 
					 echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Clinical Data Investigational Agent Abstract</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									lista_links_farmaco($id_farmaco,3,1);	
								echo "</ul>\n";
							echo "</div>\n";
						echo "</div>\n";
					
					
					
					echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Ongoing Clinical Trials</div>\n";
									$link_trial="http://www.clinicaltrials.gov/ct2/results?term=".urlencode($nombre_farmaco)."&Search=Search";
									echo "<a class=\"botoncabecera binfo\" href=\"javascript:abrir_ventana('".$link_trial."')\"></a>\n";
								echo "</div>\n";
					echo "</div>\n";
					
					echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Drug Dosage</div>\n";
									$link_drug_dosage="http://www.drugs.com/search.php?sources%5B%5D=dosage&searchterm=".urlencode($nombre_farmaco);
									echo "<a class=\"botoncabecera binfo\" href=\"javascript:abrir_ventana('".$link_drug_dosage."')\"></a>\n";
								echo "</div>\n";
					echo "</div>\n";
					
					
					
					
					
					
					
					
					
					
					//echo "</div>\n";
				
					
					
					//echo "<div id=\"tabCont4\" class=\"clearfix\">\n";
						
					//echo "</div>\n";
					//echo "<div id=\"tabCont5\" class=\"clearfix\">\n";
					//echo "</div>\n";
				
		
			echo "</div>\n";
		echo "</div>\n";
	echo "</div>\n";
//echo "</div>\n";
 }

}

include ("inc/footer_ventana.php");
}


if (!isset($_GET['cop'])){
$cop="lf";	
}else{
$cop=$_GET['cop'];
}
	
switch($cop) {
default:  
break;
case "vfn":
ver_farmaco_nuevo($_GET['id_farmaco']);
break;
case "vf":
ver_farmaco_fda($_GET['id_farmaco']);
break;


}

/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/tabs_farmacos.js\"></script>\n";
*/
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"ventanas_mut\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=800,height=600\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>