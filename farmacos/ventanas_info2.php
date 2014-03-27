<?php
//include ("inc/login.php"); 
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",1);
echo $cabecera->get_php_code();

include ("inc/config.php");
include ("inc/alg_functions.php");
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
background: #d8d8da url(img/sprite.png) repeat-x 0 -100;
}
.cab_turquesa{
color:#000;
font-size: 12px; 
background-color:#caa68c; 
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
background-color: #FFE8D7;
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
background-color:#a0351d;
padding: 5px;
margin-bottom: 5px;
}
div.cuerpo1{
	clear:both;
	padding:15px;
	background-color: #FFE8D7;
}

.recuadroizq{
padding:0px;
margin-top: 5px;
margin-right:0px;
margin-bottom: 5px;
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
background-color:#E3E8EA;
}
.cabeceratox{
background-color:#2BDDD9;
border-top: 1px none #999999;
border-right: 1px none #999999;
border-bottom: 1px solid #999999;
border-left: 1px none #999999;
font-family: Arial, Helvetica, sans-serif;
font-weight: bold;
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
.bcomp{
background-position:0 -662px ;
}

</style>
<title>FARMACOS</title>
</head>
<body>
<div class="ventanas clearfix">

<?php
function devuelve_nombre_farmaco($id_farmaco,$categoria_farmaco){
global $basedatos,$connect;	
if ($categoria_farmaco=='FDA'){
$query_farmacos="select nombre_farmaco from farmacos where id_farmaco='".$id_farmaco."'";
}
if ($categoria_farmaco=='INV'){
$query_farmacos="select nombre_farmaco from farmacos_inv where id_farmaco='".$id_farmaco."'";
}
$lista_farmacos = mysql_query($query_farmacos, $connect);
	if ($lista_farmacos){
	$numero_farmacos=mysql_num_rows($lista_farmacos);
		if($numero_farmacos == 0) {
		return "error";
		} else {
			list($nombre_farmaco)= mysql_fetch_row($lista_farmacos);
		return $nombre_farmaco;
		}								
	}else{
	return "error";	
	}

}

function lista_toxicidades_farmaco_fda($farmaco_id){
global $basedatos,$connect;	
	echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-1\">All Grd</div>\n";
			      echo "<div class=\"span-1 last\">Grd 3/4</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
			   $query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_toxicidad,toxicidad,toxicidad_n0 where
				id_farmaco='".$farmaco_id."' and
					farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
					toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0";
					$resultado_grptx = mysql_query($query_grptx,$connect);
					if ($resultado_grptx){
					$numero_grptx=mysql_num_rows($resultado_grptx);
						if($numero_grptx == 0) {
						} else {
							while(list($id_grptx,$descripcion_grptx)= mysql_fetch_row($resultado_grptx)){
							echo "<li class=\"cabecera cab_turquesa\">\n"; 
										echo "<div class=\"span-6 last\">$descripcion_grptx</div>\n";
										echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
			   $query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,id_categoria, valor_toxicidad 
			   from farmacos_toxicidad,toxicidad  
			   where  farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad 
			   and id_farmaco=$farmaco_id and id_toxicidad_n0='".$id_grptx."' order by nombre_toxicidad asc";
			   $lista_toxicidades = mysql_query($query_toxicidades, $connect);
			      if ($lista_toxicidades){
				    $numero_toxicidades=mysql_num_rows($lista_toxicidades);
				    if($numero_toxicidades == 0) {
				    } else {
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

						$a = 0;
			   			$dcolor_A = "impar";
			  			$dcolor_B = "par"; 
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
						   
						   
						   
						   //while(list($nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){
			      			   $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			      			   echo "<li class=\"$dcolor\">\n";
						      echo "<div class=\"span-4\">$des_tox</div>\n";
		        			      echo "<div class=\"span-1\">$txall</div>\n";
			      			      echo "<div class=\"span-1 last\">$tx34</div>\n";
						      echo "<div class=\"clear\"></div>\n";
			      			   echo "</li>\n";
			      			   $a = ($dcolor == $dcolor_A ? 1 : 0);
						   }
				     }
			      }			
				}
			}	
		}
	
	
echo "</ul>\n";		
}

function lista_toxicidades_farmaco_inv($farmaco_id){
global $basedatos,$connect;	
echo "<ul class=\"m0\">\n";
	echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-4\">Toxicidad</div>\n";
		echo "<div class=\"span-1\">AE >10</div>\n";
		echo "<div class=\"span-1 last\">Grade >=3</div>\n";
		echo "<div class=\"clear\"></div>\n";
	echo "</li>\n";
		$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_inv_toxicidad,toxicidad,toxicidad_n0 where
		id_farmaco='".$farmaco_id."' and
		farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
		toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0";
		$resultado_grptx = mysql_query($query_grptx,$connect);
		if ($resultado_grptx){
		$numero_grptx=mysql_num_rows($resultado_grptx);
			if($numero_grptx == 0) {
			} else {
				while(list($id_grptx,$descripcion_grptx)= mysql_fetch_row($resultado_grptx)){
				echo "<li class=\"cabecera cab_turquesa\">\n"; 
							echo "<div class=\"span-6 last\">$descripcion_grptx</div>\n";
							echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$query_toxicidades="select nombre_toxicidad,tx1,tx2 from farmacos_inv_toxicidad,toxicidad  
				where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and 
				id_farmaco=$farmaco_id and id_toxicidad_n0='".$id_grptx."' order by nombre_toxicidad asc";
				$lista_toxicidades = mysql_query($query_toxicidades, $connect);
					if ($lista_toxicidades){
					$numero_toxicidades=mysql_num_rows($lista_toxicidades);
						if($numero_toxicidades == 0) {
						} else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
							while(list($nombre_toxicidad,$tx1,$tx2)= mysql_fetch_row($lista_toxicidades)){
							$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
							echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
							echo "<div class=\"span-1\">$tx1</div>\n";
							echo "<div class=\"span-1 last\">$tx2</div>\n";
							echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
							$a = ($dcolor == $dcolor_A ? 1 : 0);
							}
						}
					}			
				}
			}	
		}
echo "</ul>\n";	 
}

function lista_pathways_mutacion($id_mutacion,$GeneId,$nivel){
global $basedatos,$connect;	

$query_pathways= "select mutaciones_pathways.id_pathway,nombre_pathway,id_external from mutaciones_pathways,pathways where mutaciones_pathways.id_pathway=pathways.id_pathway and id_mutacion='".$id_mutacion."'";
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

function lista_tumores_mutacion($id_mutacion,$nivel){
global $basedatos,$connect;	

$query_tumores= "select tejidos_n0.id_tejido_n0,tejidos_n0.nombre_tejido_n0,tejidos_n1.id_tejido_n1,nombre_tejido_n1,
histologia_n0.id_histologia_n0,nombre_histologia_n0,
histologia_n1.id_histologia_n1,nombre_histologia_n1,numero_mutaciones
from mutaciones_tumores,tejidos_n1,tejidos_n0,histologia_n0,histologia_n1 
where mutaciones_tumores.id_tejido_n1=tejidos_n1.id_tejido_n1 and tejidos_n1.id_tejido_n0=tejidos_n0.id_tejido_n0 and mutaciones_tumores.id_histologia_n0=histologia_n0.id_histologia_n0 and  mutaciones_tumores.id_histologia_n1=histologia_n1.id_histologia_n1 and id_mutacion='".$id_mutacion."'";
$lista_tumores = mysql_query($query_tumores, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-4\">Tissue</div>\n";
		echo "<div class=\"span-4\">SubTissue</div>\n";
		echo "<div class=\"span-5\">Histology</div>\n";
		echo "<div class=\"span-5\">SubHistology</div>\n";
		echo "<div class=\"span-1 last\">Num</div>\n";
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";
if ($lista_tumores){
	$numero_tumores=mysql_num_rows($lista_tumores);
		if($numero_tumores== 0) {
		} else {
			$a = 0;
			$dcolor_A = "impar";
			$dcolor_B = "par"; 
			
			while(list($id_tejido_n0,$nombre_tejido_n0,$id_tejido_n1,$nombre_tejido_n1,$id_histologia_n0,
			$nombre_histologia_n0,$id_histologia_n1,$nombre_histologia_n1,$numero_mutaciones)= mysql_fetch_row($lista_tumores)){
			$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			    echo "<li class=\"$dcolor\">\n";
						echo "<div class=\"span-4\">$nombre_tejido_n0</div>\n";
						echo "<div class=\"span-4\">$nombre_tejido_n1</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n0</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n1</div>\n";
						echo "<div class=\"span-1 last\">$numero_mutaciones</div>\n";
						echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";

}

function pinta_farmacos_commontarget($id_diana){
global $connect,$basedatos,$farmacos_fct;
	$farmacos_fct='';
	$query_farmacos = "select farmacos_inv.id_farmaco,substring(nombre_farmaco,1,40),id_categoria_diana,descripcion_categoria_diana from farmacos_inv_diana,farmacos_inv,categorias_dianas 
	where farmacos_inv_diana.id_farmaco=farmacos_inv.id_farmaco and 
	farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and
	id_diana='".$id_diana."' order by  categorias_dianas.id_categoria_diana";
	mysql_select_db($basedatos,$connect);
	$resultado = mysql_query($query_farmacos,$connect);
	if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {		
			echo "<ul class=\"m0\">\n";
				echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
					echo "<div class=\"span-17\">Drug Name</div>\n";
					echo "<div class=\"span-1\">&nbsp;</div>\n";
					echo "<div class=\"span-1 last\">&nbsp;</div>\n";
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				$grp_diana_anterior='0';
				while(list($id_farmaco,$nombre_farmaco,$id_cd,$descripcion_cd)= mysql_fetch_row($resultado)){
					$farmacos_fct=$farmacos_fct.$id_farmaco."x";
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							
							if ($grp_diana_anterior==$id_cd){
		  				echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-17 clearfix\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\" href=\"javascript:abrir_ventana('ventanas_comp.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0')\" title=\"Compare Drug\"></a></div>\n";
								echo "<div class=\"span-1 last\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
						echo "</li>\n";
						
						}else{
							
							echo "<li class=\"cabecera cab_turquesa\">\n"; 
							echo "<div class=\"span-19 last\">$descripcion_cd</div>\n";
							echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
                                 	
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-17 clearfix\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"javascript:abrir_ventana('ventanas_comp.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0')\" title=\"Compare Drug\"></a></div>\n";
								echo "<div class=\"span-1 last\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
					
						}
		   				$grp_diana_anterior=$id_cd;
					$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
			echo "</ul>\n";	
	
	}		//del if resultado de farmacos con common target
	}  // del if numero de farmacos commun target			

}

function pinta_farmacos_commonpathway($id_mutacion){
global $connect,$basedatos,$farmacos_fcp;
	$farmacos_fcp='';
	
	$query_farmacos = "select distinct farmacos_inv.id_farmaco, substring(nombre_farmaco,1,40),id_categoria_diana,descripcion_categoria_diana 
	from mutaciones_pathways,farmacos_inv_pathways,farmacos_inv,categorias_dianas 
	where mutaciones_pathways.id_pathway=farmacos_inv_pathways.id_pathway and  
	farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and 
	farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and 
	id_mutacion='".$id_mutacion."' order by categorias_dianas.id_categoria_diana";
	mysql_select_db($basedatos,$connect);
	$resultado = mysql_query($query_farmacos,$connect);
	if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {			
					echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-17\">Drug Name</div>\n";
						echo "<div class=\"span-1\">&nbsp;</div>\n";
						echo "<div class=\"span-1 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				$grp_diana_anterior='0';
				while(list($id_farmaco,$nombre_farmaco,$id_cd,$descripcion_cd)= mysql_fetch_row($resultado)){
					$farmacos_fcp=$farmacos_fcp.$id_farmaco."x";
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							if ($grp_diana_anterior==$id_cd){
		  					echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-17 clearfix\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"javascript:abrir_ventana('ventanas_comp.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0')\" title=\"Compare Drug\"></a></div>\n";
								echo "<div class=\"span-1 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						//echo "<option value=\"$id_f\">$nombre_f</option>\n";
							}else{
							
							echo "<li class=\"cabecera cab_turquesa\">\n"; 
										echo "<div class=\"span-19 last\">$descripcion_cd</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
	
									echo "<li class=\"$dcolor\">\n";
										echo "<div class=\"span-17 clearfix\">&nbsp;$nombre_farmaco</div>\n";
										echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"javascript:abrir_ventana('ventanas_comp.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0')\" title=\"Compare Drug\"></a></div>\n";
										echo "<div class=\"span-1 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
					         }
							
							$grp_diana_anterior=$id_cd;
							$a = ($dcolor == $dcolor_A ? 1 : 0);
		
				}
	echo "</ul>\n";	
	
	
	}		//del if resultado de farmacos con common target
	}  // del if numero de farmacos commun target		

}

function pinta_farmacos_fda($id_mutacion){
global $connect,$basedatos,$farmacos_fa;
$farmacos_fa='';
	
	$query_farmacos = "select distinct farmacos.id_farmaco,nombre_farmaco from  mutaciones_tumores,indicacion_tumores,farmacos_indicaciones,farmacos 
	where mutaciones_tumores.id_tejido_n1=indicacion_tumores.id_tejido_n1 and
	mutaciones_tumores.id_histologia_n0=indicacion_tumores.id_histologia_n0 and
	mutaciones_tumores.id_histologia_n1=indicacion_tumores.id_histologia_n1 and
	indicacion_tumores.id_indicacion=farmacos_indicaciones.id_indicacion and
	farmacos_indicaciones.id_farmaco=farmacos.id_farmaco and
	mutaciones_tumores.id_mutacion='".$id_mutacion."'";

	//$query_farmacos = "select distinct farmacos_inv.id_farmaco, substring(nombre_farmaco,1,40)from mutaciones_pathways,farmacos_inv_pathways,farmacos_inv where mutaciones_pathways.id_pathway=farmacos_inv_pathways.id_pathway and  farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and id_mutacion='".$id_mutacion."'";
	mysql_select_db($basedatos,$connect);
	$resultado = mysql_query($query_farmacos,$connect);
	if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {
					echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-17\">Drug Name</div>\n";
						echo "<div class=\"span-1\">&nbsp;</div>\n";
						echo "<div class=\"span-1 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				while(list($id_farmaco,$nombre_farmaco)= mysql_fetch_row($resultado)){
					$farmacos_fa=$farmacos_fa.$id_farmaco."x";
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-17 clearfix\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"javascript:abrir_ventana('ventanas_comp.php?id_farmaco1=".$id_farmaco."&id_farmaco2=0&pmtr1=0&pmtr2=0')\" title=\"Compare Drug\"></a></div>\n";
								echo "<div class=\"span-1 last\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
					$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
	
	echo "</ul>\n";	
		
	
		}		//del if resultado de farmacos fda con con tumor
	}  // del if numero de farmacos fda con tumor			
}



function ver_mutacion($id_mutacion){
global $connect,$basedatos,$farmacos_fct,$farmacos_fcp,$farmacos_fa;
$query_farmacos = "select nombre_gen,tipo_mutacion,GeneId,sinonimos_gen,protein_family,definicion_comun,id_diana,diana,enfermedad_asociada,celular_process from mutaciones where id_mutacion=".$id_mutacion;	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos, $connect);

if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
					if($numero_farmacos == 0) {
					echo "<p class=\"leyenda\">Error No aparece ningun registro</p>\n";
					} else {
					list($nombre_gen,$tipo_mutacion,$GeneId,$sinonimos_gen,$protein_family,$definicion_comun,$id_diana,$diana,$enfermedad_asociada,$celular_process)= mysql_fetch_row($resultado);
					
//echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-21 last\">\n";
	      		echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">$nombre_gen</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
			
					//echo "<div id=\"tabCont1\" class=\"clearfix\">\n";
						//echo "<div class=\"span-22 last\">\n";
							echo "<div class=\"recuadroizq conborde clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Gen Name</div>\n";
										echo "<div class=\"span-8\">$nombre_gen</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Tumour Type</div>\n";
										echo "<div class=\"span-8\">$tipo_mutacion</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">GenId(Ncbi)</div>\n";
										echo "<div class=\"span-8\">$GeneId</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Synonimus</div>\n";
										echo "<div class=\"span-8\">$sinonimos_gen</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Protein Family</div>\n";
										echo "<div class=\"span-8\">$protein_family</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Process</div>\n";
										echo "<div class=\"span-8\">$celular_process</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									
									
									if ($definicion_comun==1){
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Common Target</div>\n";
										echo "<div class=\"span-8\">$id_diana</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									
									}else{
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Target</div>\n";
										echo "<div class=\"span-8\">$diana</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									}
									
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Disease associated</div>\n";
										echo "<div class=\"span-8\">$enfermedad_asociada</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
								echo "</ul>\n";
							echo "</div>\n";
						//echo "</div>\n";
					//echo "</div>\n";
						
					//echo "<div id=\"tabCont2\" class=\"clearfix\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
							
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Pathways</div>\n";
								echo "</div>\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									if ($GeneId==""){
									lista_pathways_mutacion($id_mutacion,0,1);
									}else{
									lista_pathways_mutacion($id_mutacion,$GeneId,1);
									}
									echo "</div>\n";
						echo "</div>\n";
					//echo "</div>\n";
					//echo "<div id=\"tabCont3\" class=\"clearfix\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Tumors</div>\n";
								echo "</div>\n";
								echo "<div class=\"cuerporecuadro clearfix\">\n";
										lista_tumores_mutacion($id_mutacion,1);
								echo "</div>\n";
						echo "</div>\n";
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Investigational Drugs with common target</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
							pinta_farmacos_commontarget($id_diana);
							echo "</div>\n";
						echo "</div>\n";
					 	echo "<div class=\"recuadroizq conborde\">\n";
							  echo "<div class=\"cabecerarecuadro clearfix\">\n";
								  echo "<div class=\"titulorecuadro\">Investigational Drugs acting on this pathway</div>\n";
							  echo "</div>\n";
							  echo "<div class=\"cuerporecuadro clearfix\">\n";
							  pinta_farmacos_commonpathway($id_mutacion);	
							  echo "</div>\n";
					  echo "</div>\n";
					  
					  
					  if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	
						{
							echo "<div class=\"recuadroizq conborde\">\n";
							  echo "<div class=\"cabecerarecuadro clearfix\">\n";
							  echo "<div class=\"titulorecuadro\">FDA Approved Drug</div>\n";
							  echo "</div>\n";
							  echo "<div class=\"cuerporecuadro clearfix\">\n";
							  pinta_farmacos_fda($id_mutacion);
							  echo "</div>\n";
							echo "</div>\n";
						}
					  
					  
					  
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
case "vm":
ver_mutacion($_GET['id_mutacion']);
break;
case "cfm":
//comparar_farmaco_fda($_GET['id_farmaco']);
break;


}

/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";

*/
echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/tabs_farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"ventanas_info2\",\"left=150,top=150,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=920,height=600\");\n";
echo "}\n";

echo "//-->\n";
echo "</script>\n";  
?>