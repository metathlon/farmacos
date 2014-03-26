<?php
include ("inc/login.php"); 
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
/*
margin-left:5px;
width:930px;
background-color: #C4DBE6;
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
background: #d8d8da url(img/sprite.png) repeat-x 0 0;
}
.cab_turquesa{
color: #000;
font-size: 12px; 
background-color:#2BDDD9; 
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
background-color: #9AC0D3;
padding: 5px;
margin-bottom: 5px;
}
div.cuerpo1{
clear:both;
}

.recuadroizq{
padding:0px;
margin-top: 5px;
margin-right:0px;
margin-bottom: 5px;
margin-left: 10px;
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
font-weight: bold; font-size:1em; margin-top:-0.2em; margin-bottom:0.2em; 	
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


</style>
<title>FARMACOS</title>
</head>
<body>
<div class="ventanas clearfix">

<?php
function lista_farmacos_fda($id_indicacion){
global $basedatos,$connect;	

				$query_farmacos = "select farmacos.id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco from farmacos,farmacos_indicaciones
				 where farmacos.id_farmaco=farmacos_indicaciones.id_farmaco and id_indicacion='".$id_indicacion."' order by nombre_farmaco";	
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_farmacos,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-6\">Drug Name</div>\n";
						echo "<div class=\"span-5\">More Information</div>\n";
						echo "<div class=\"span-8\">Clasification Advers Reaction in Clinical Trials</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				
				if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
				    if($numero_farmacos == 0) {
				    } else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_farmaco,$nombre_farmaco,$observaciones_farmaco,$clasificacion_toxicidad_farmaco)= mysql_fetch_row($resultado)){
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-6\">$nombre_farmaco</div>\n";
								echo "<div class=\"span-5\">$observaciones_farmaco</div>\n";
								echo "<div class=\"span-8\">$clasificacion_toxicidad_farmaco</div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
					echo "</ul>\n";	 
				

}

function lista_pathways_indicacion($id_indicacion){
global $basedatos,$connect;	

$query_pathways= "select indicacion_pathways.id_pathway,nombre_pathway,id_external from indicacion_pathways,pathways where indicacion_pathways.id_pathway=pathways.id_pathway and id_indicacion='".$id_indicacion."'";
$lista_pathways = mysql_query($query_pathways, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-20\">Pathway</div>\n";
		echo "<div class=\"span-0 last\"></div>\n";
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";
	
	
if ($lista_pathways){
	$numero_pathways=mysql_num_rows($lista_pathways);
		if($numero_pathways== 0) {
		} else {
			while(list($id_pathway,$nombre_pathway,$id_external)= mysql_fetch_row($lista_pathways)){
			$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;
	
				echo "<li class=\"impar\">\n";
					echo "<div class=\"span-20\">".$nombre_pathway."</div>\n";
					echo "<div class=\"span-0 last\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$link_pathway."')\"></a></div>\n";
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				
				}
		}			
	}
	echo "</ul>\n";

}

function lista_tumores_indicacion($id_indicacion){
global $basedatos,$connect;	

$query_tumores= "select tejidos_n0.id_tejido_n0,tejidos_n0.nombre_tejido_n0,tejidos_n1.id_tejido_n1,nombre_tejido_n1,
histologia_n0.id_histologia_n0,nombre_histologia_n0,
histologia_n1.id_histologia_n1,nombre_histologia_n1
from indicacion_tumores,tejidos_n1,tejidos_n0,histologia_n0,histologia_n1 
where indicacion_tumores.id_tejido_n1=tejidos_n1.id_tejido_n1 and tejidos_n1.id_tejido_n0=tejidos_n0.id_tejido_n0 and indicacion_tumores.id_histologia_n0=histologia_n0.id_histologia_n0 and indicacion_tumores.id_histologia_n1=histologia_n1.id_histologia_n1 and id_indicacion='".$id_indicacion."'";
$lista_tumores = mysql_query($query_tumores, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-5\">Tissue</div>\n";
		echo "<div class=\"span-5\">SubTissue</div>\n";
		echo "<div class=\"span-5\">Histology</div>\n";
		echo "<div class=\"span-5\">SubHistology</div>\n";
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
			$nombre_histologia_n0,$id_histologia_n1,$nombre_histologia_n1)= mysql_fetch_row($lista_tumores)){
			$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			     		echo "<li class=\"$dcolor\">\n";
						echo "<div class=\"span-5\">$nombre_tejido_n0</div>\n";
						echo "<div class=\"span-5\">$nombre_tejido_n1</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n0</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n1</div>\n";
						echo "<div class=\"clear\"></div>\n";
						echo "</li>\n";
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";

}

function lista_farmacos_commonpathway($id_indicacion){
global $connect,$basedatos;
	$farmacos_fcp='';
	$query_farmacos = "select distinct farmacos_inv.id_farmaco,nombre_farmaco,id_categoria_diana,descripcion_categoria_diana, 
	autores,tx1desc,tx2desc
	from indicacion_pathways,farmacos_inv_pathways,farmacos_inv,categorias_dianas 
	where indicacion_pathways.id_pathway=farmacos_inv_pathways.id_pathway and  
	farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and 
	farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and 
	id_indicacion='".$id_indicacion."' order by categorias_dianas.id_categoria_diana";
	
	
	//$query_farmacos = "select distinct farmacos_inv.id_farmaco, substring(nombre_farmaco,1,40)from mutaciones_pathways,farmacos_inv_pathways,farmacos_inv where mutaciones_pathways.id_pathway=farmacos_inv_pathways.id_pathway and  farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and id_mutacion='".$id_mutacion."'";
	mysql_select_db($basedatos,$connect);
	$resultado = mysql_query($query_farmacos,$connect);
	if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {			
					echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						
						
						echo "<div class=\"span-6\">Drug Name</div>\n";
						echo "<div class=\"span-7\">AEs=>10%</div>\n";
						echo "<div class=\"span-7\">Grade=>3</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				$grp_diana_anterior='0';
				while(list($id_farmaco,$nombre_farmaco,$id_cd,$descripcion_cd,$autores,$tx1desc,$tx2desc)= mysql_fetch_row($resultado)){
					$farmacos_fcp=$farmacos_fcp.$id_farmaco."x";
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							if ($grp_diana_anterior==$id_cd){
		  					echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-6\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-7\">$tx1desc</div>\n";
								echo "<div class=\"span-7\">$tx2desc</div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						//echo "<option value=\"$id_f\">$nombre_f</option>\n";
							}else{
									echo "<li class=\"cabecera cab_turquesa\">\n"; 
										echo "<div class=\"span-20 last\">$descripcion_cd</div>\n";
										echo "<div class=\"span-0 last\">&nbsp;</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
	
								echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-6 clearfix\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-7\">$tx1desc</div>\n";
								echo "<div class=\"span-7\">$tx2desc</div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
					         }
					
					$grp_diana_anterior=$id_cd;
					$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
	echo "</ul>\n";	
	
	
	}		//del if resultado de farmacos con common target
	}  // del if numero de farmacos commun target		
//echo "<input type=\"hidden\" name=\"farmacos_fcp\" id=\"farmacos_fcp\" value=\"$farmacos_fcp\" />\n";

}
function lista_mutaciones_indicacion($id_indicacion){
global $basedatos,$connect;	

$query_mutaciones="select distinct mutaciones.id_mutacion,nombre_gen,GeneId,celular_process,sinonimos_gen from mutaciones,mutaciones_tumores,indicacion_tumores where
mutaciones.id_mutacion=mutaciones_tumores.id_mutacion and 
mutaciones_tumores.id_tejido_n1=indicacion_tumores.id_tejido_n1 and
mutaciones_tumores.id_histologia_n0=indicacion_tumores.id_histologia_n0 and
mutaciones_tumores.id_histologia_n1=indicacion_tumores.id_histologia_n1 and
indicacion_tumores.id_indicacion='".$id_indicacion."'";

/*
$query_mutaciones = "select id_mutacion,nombre_gen,GeneId,descripcion_tipo_mutacion,sinonimos_gen,protein_family from mutaciones,categorias_mutaciones where mutaciones.tipo_mutacion=categorias_mutaciones.id_tipo_mutacion order by nombre_gen";	
*/				
				
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_mutaciones,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"span-4\">Gen Name</div>\n";
						echo "<div class=\"span-4\">Process</div>\n";
						echo "<div class=\"span-11\">Synonimus</div>\n";
						//echo "<div class=\"span-6\">Protein Family</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				
				if ($resultado){
				$numero_mutaciones=mysql_num_rows($resultado);
				    if($numero_mutaciones == 0) {
				    } else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_mutacion,$nombre_gen,$GeneId,$celular_process,$sinonimos_gen)= mysql_fetch_row($resultado)){
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								if ($GeneId==0){
								echo "<div class=\"span-0\">&nbsp;</div>\n";
								}else{
								echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('http://www.ncbi.nlm.nih.gov/gene/".$GeneId."')\"></a></div>\n";
								}
								
								echo "<div class=\"span-4\">$nombre_gen</div>\n";
								echo "<div class=\"span-4\">$celular_process</div>\n";
								echo "<div class=\"span-11\">$sinonimos_gen</div>\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info2.php?cop=vm&id_mutacion=".$id_mutacion."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
					echo "</ul>\n";	 



}


function ver_tipo_tumor($id_indicacion){
global $connect,$basedatos,$farmacos_fct,$farmacos_fcp,$farmacos_fa;
$query_indicaciones = "select descripcion_indicacion from indicaciones  where id_indicacion='".$id_indicacion."'";
$resultado_indicaciones = mysql_query($query_indicaciones,$connect);
if ($resultado_indicaciones){
				$numero_indicaciones=mysql_num_rows($resultado_indicaciones);
				    if($numero_indicaciones == 0) {
					echo "<p class=\"leyenda\">Error No aparece ningun registro</p>\n";
					} else {
					list($descripcion_indicacion)= mysql_fetch_row($resultado_indicaciones);
					
//echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-23 last\">\n";
	      		echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Tumor Type: ".$descripcion_indicacion."</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
		  			echo "<div class=\"span-23 last clearfix\">\n";
		 	 			echo "<ul class=\"tabArea\">\n";
							echo "  <li class=\"tabOn\"  id=\"tab1\">FDA Approved Drug</li>\n";
							echo "  <li class=\"tabOff\" id=\"tab2\">Investigational Drugs</li>\n";
							echo "  <li class=\"tabOff\" id=\"tab3\">Tumor Characterization</li>\n";
							echo "  <li class=\"tabOff\" id=\"tab4\">Gene Mutations</li>\n";
							echo "  <li class=\"tabOff\" id=\"tab5\">Pathways</li>\n";
						echo"</ul>\n";
	     			echo "</div>\n";
				
					echo "<div id=\"tabCont1\" class=\"clearfix\">\n";
						echo "<div class=\"span-22 last\">\n";
							echo "<div class=\"recuadroizq conborde clearfix\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">FDA Approved Drug</div>\n";
								echo "</div>\n";
								echo "<div class=\"scroll600h\">\n";
								echo "<div class=\"cuerporecuadro clearfix\">\n";
								lista_farmacos_fda($id_indicacion);
								echo "</div>\n";
								echo "</div>\n";
							
							
							echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
						
					echo "<div id=\"tabCont2\" class=\"clearfix\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
							
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Investigational Drugs</div>\n";
								echo "</div>\n";
								echo "<div class=\"scroll600h\">\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									lista_farmacos_commonpathway($id_indicacion);
									echo "</div>\n";
								echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
					echo "<div id=\"tabCont3\" class=\"clearfix\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Tumor Characterization</div>\n";
								echo "</div>\n";
								echo "<div class=\"scroll600h\">\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
										lista_tumores_indicacion($id_indicacion);
									echo "</div>\n";
								echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
					echo "<div id=\"tabCont4\" class=\"clearfix\">\n";
							echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Tumor Characterization</div>\n";
								echo "</div>\n";
								echo "<div class=\"scroll600h\">\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									lista_mutaciones_indicacion($id_indicacion);
									echo "</div>\n";
								echo "</div>\n";
							echo "</div>\n";
					echo "</div>\n";
					
					
					echo "<div id=\"tabCont5\" class=\"clearfix\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
							
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Pathways</div>\n";
								echo "</div>\n";
								echo "<div class=\"scroll600h\">\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									lista_pathways_indicacion($id_indicacion);
									echo "</div>\n";
								echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
					
		
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
case "vtt":
ver_tipo_tumor($_GET['id_indicacion']);
break;
}

/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
*/
echo "<script language=\"JavaScript\" src=\"inc/tabs_farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"ventanas_info2\",\"left=150,top=150,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=600\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>