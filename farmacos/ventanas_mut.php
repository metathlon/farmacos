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
margin:10px;
padding: 5px;
border:1px solid;
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
.oculto{
visibility:hidden;
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

function add_mutacion(){
global $connect,$basedatos;
echo "<div class=\"span-13 last\">\n";
	echo "<form action=\"functions_mut.php\" method=\"post\" name=\"form_am\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Mutacion</p>\n";
		echo "</div>\n";
		echo "<div class=\"izq\">\n";
									echo "<p class=\"formulario\">\n";
										echo "<label for \"nombre_gen\" class=\"span-3\">Gen Name</label>\n";
										echo "<input type=\"text\" name=\"nombre_gen\" class=\"span-8\" />\n";
									echo "</p>\n";
									echo "<p class=\"formulario\">\n";
										echo "<label for \"GeneId\" class=\"span-3\">GenId(Ncbi)</label>\n";
										echo "<input type=\"text\" name=\"GeneId\" class=\"span-3\" />\n";
									echo "</p>\n";
									echo "<div class=\"dcha conborde clearfix\">\n";
										echo "<p class=\"leyenda\">Synonimus</p>\n";
										echo "<p class=\"fomulariosin\">\n";
											echo "<textarea name=\"sinonimos_gen\" class=\"span-11\"></textarea>\n";
										echo "</p>\n";
									echo "</div>\n";	
									echo "<div class=\"dcha conborde clearfix\">\n";
										echo "<p class=\"leyenda\">Protein Family</p>\n";
										echo "<p class=\"fomulariosin\">\n";
											echo "<textarea name=\"protein_family\" class=\"span-11\"></textarea>\n";
										echo "</p>\n";
									echo "</div>\n";	
	
								echo "<div class=\"dcha conborde clearfix\">\n";
									echo "<p class=\"leyenda\">Disease associated</p>\n";
									echo "<p class=\"fomulariosin\">\n";
										echo "<textarea name=\"enfermedad_asociada\" class=\"span-11\"></textarea>\n";
									echo "</p>\n";
								echo "</div>\n";
									echo "<div class=\"dcha conborde\">\n";
										echo "<p class=\"formulario\">\n";
												echo "<label for \"select_tipo_mutacion\" class=\"span-4\">Mutation Type</label>\n";
												echo "<select name=\"select_tipo_mutacion\" id=\"select_tipo_mutacion\" class=\"span-4\">\n";        
												$query_tipos_mutaciones="select id_tipo_mutacion,descripcion_tipo_mutacion from categorias_mutaciones ";
												$lista_tipos_mutaciones = mysql_query($query_tipos_mutaciones, $connect);
												if ($lista_tipos_mutaciones){
													$numero_tipos_mutaciones=mysql_num_rows($lista_tipos_mutaciones);
														if($numero_tipos_mutaciones == 0) {
														} else {
														while(list($id_tipo_lista,$descripcion_tipo_lista)= mysql_fetch_row($lista_tipos_mutaciones)){ 	
																
															echo "<option value=\"$id_tipo_lista\">$descripcion_tipo_lista</option>\n";	
															}  	
														}
												}    	
												echo "</select>\n";	
										echo "</p>\n";
								echo "</div>\n";
									echo "<div class=\"dcha conborde\">\n";
								echo "<p class=\"formulario\">\n";
										echo "<label for \"celular_process\" class=\"span-4\">Process</label>\n";
										echo "<input type=\"text\" name=\"celular_process\" class=\"span-6\" />\n";
								echo "</p>\n";
								
								echo "</div>\n";
									
									
									
									
									echo "<div class=\"dcha conborde\">\n";
								echo "<p class=\"formulario\">\n";
										echo "<label for \"radio_definicion_comun\" class=\"span-4\">Common definition</label>\n";
										echo "<input type=\"radio\" name=\"radio_definicion_comun\" value=\"1\"  />\n";
										echo "Yes";
										echo "<input type=\"radio\" name=\"radio_definicion_comun\" value=\"0\" checked />\n";
										echo "No";
								echo "</p>\n";
								/*
								echo "<p class=\"formulario\">\n";
										echo "<label for \"select_diana\" class=\"span-4\">Common Target</label>\n";
										echo "<select name=\"select_diana\" id=\"select_diana\" class=\"span-5\">\n";        
										$query_dianas="select id_diana,descripcion_diana from dianas order by descripcion_diana";
										$lista_dianas = mysql_query($query_dianas, $connect);
										if ($lista_dianas){
											$numero_dianas=mysql_num_rows($lista_dianas);
												if($numero_dianas == 0) {
												} else {
													echo "<option value=\"0\">Seleccione Diana</option>\n";
													while(list($id_diana_lista,$descripcion_diana_lista)= mysql_fetch_row($lista_dianas)){ 	
														
													echo "<option value=\"$id_diana_lista\">$descripcion_diana_lista</option>\n";	
													}  	
												}
										}    	
										echo "</select>\n";	
								echo "</p>\n";
								*/
								echo "</div>\n";
								/*	
								echo "<div class=\"dcha conborde\">\n";
								echo "<p class=\"formulario\">\n";
										echo "<label for \"diana\" class=\"span-4\">Other Target</label>\n";
										echo "<input type=\"text\" name=\"diana\" class=\"span-4\" />\n";
								echo "</p>\n";
								
								echo "</div>\n";
								*/
									
									
									echo "<p class=\"fomulariosin\"></p>\n";
									echo "<p class=\"fomulariosin centrado\">\n";
									echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"am\" />\n";
										echo "<input type=\"submit\" value=\"Actualizar\"/>\n"; 
									echo "</p>\n";
		echo "</div>\n";
						
							
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function add_pathway_mutacion($id_mutacion){
global $connect,$basedatos;
echo "<div class=\"span-13 last\">\n";
	echo "<form action=\"functions_mut.php\" method=\"post\" name=\"form_apm\">\n";
	echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Pathways</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				$query_pathways = "select id_pathway,id_external,nombre_pathway from pathways order by nombre_pathway";	
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_pathways,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-1\">&nbsp;</div>\n";
						echo "<div class=\"span-2\">id_external</div>\n";
						echo "<div class=\"span-8\">nombre_pathway</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				if ($resultado){
				$numero_pathways=mysql_num_rows($resultado);
				    if($numero_pathways == 0) {
				    } else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_pathway,$id_external,$nombre_pathway)= mysql_fetch_row($resultado)){
						$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana600('".$link_pathway."')\"></a></div>\n";
								echo "<div class=\"span-2\">$id_external</div>\n";
								echo "<div class=\"span-8\">$nombre_pathway</div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla badd2\" href=\"functions_mut.php?op=apm&id_mutacion=".$id_mutacion."&id_pathway=".$id_pathway."\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
					echo "</ul>\n";	 
				echo "</div>\n";	
			echo "</div>\n";
	
	
	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function edit_pathway_mutacion($id_mutacion,$id_pathway){
global $connect,$basedatos;


}

function add_tumor_mutacion($id_mutacion){
global $connect,$basedatos;

echo "<div class=\"span-14 last\">\n";
	echo "<form action=\"functions_mut.php\" method=\"post\" name=\"form_atm\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Tumor</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_tejido_n1\" class=\"span-4\">Tissue</label>\n";
					echo "<select name=\"select_tejido_n1\" id=\"select_tejido_n1\" class=\"span-7\">\n";        
						$query_tejidos_n0 = "select id_tejido_n0,nombre_tejido_n0 from tejidos_n0 order by nombre_tejido_n0";
						$resultado1 = mysql_query($query_tejidos_n0,$connect);
							if ($resultado1){
								$numero1=mysql_num_rows($resultado1);
				    			if($numero1 == 0) {
				    			} else {
									while(list($id_tejido_n0,$nombre_tejido_n0)= mysql_fetch_row($resultado1)){
                                     echo "<optgroup label=\"$nombre_tejido_n0\">\n";
                                	 	$query_tejidos_n1 = "select id_tejido_n1,nombre_tejido_n1 from tejidos_n1 where id_tejido_n0='".$id_tejido_n0."' order by nombre_tejido_n1";
										$resultado2 = mysql_query($query_tejidos_n1,$connect);
											if ($resultado2){
												$numero2=mysql_num_rows($resultado2);
				    								if($numero2 == 0) {
				    								} else {
														while(list($id_tejido_n1,$nombre_tejido_n1)= mysql_fetch_row($resultado2)){
                                     					echo "<option value=\"$id_tejido_n1\">$nombre_tejido_n1</option>\n";	
									 					}
									 				}
									 		}
									 
									 
									 
									 
									  echo "</optgroup>\n";
									 }
		 	 
								}
		  
		  					}
					echo "</select>\n";	
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_histologia_n0\" class=\"span-4\">Histology</label>\n";
					echo "<select name=\"select_histologia_n0\" id=\"select_histologia_n0\" class=\"span-7\">\n";        
							 	
								$query_histologia_n0="select id_histologia_n0,nombre_histologia_n0 from histologia_n0 order by nombre_histologia_n0";
								$lista_histologia_n0 = mysql_query($query_histologia_n0, $connect);
								if ($lista_histologia_n0){
									$numero_histologia_n0=mysql_num_rows($lista_histologia_n0);
										if($numero_histologia_n0 == 0) {
										} else {
											while(list($id_histologia_n0,$nombre_histologia_n0)= mysql_fetch_row($lista_histologia_n0)){ 	
											echo "<option value=\"$id_histologia_n0\">$nombre_histologia_n0</option>\n";	
											}  
										}
								}    	
					echo "</select>\n";	
				echo "</p>\n";			
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_histologia_n1\" class=\"span-4\">SubHistology</label>\n";
					echo "<select name=\"select_histologia_n1\" id=\"select_histologia_n1\" class=\"span-7\">\n";        
							 	
								$query_histologia_n1="select id_histologia_n1,nombre_histologia_n1 from histologia_n1 order by nombre_histologia_n1";
								$lista_histologia_n1 = mysql_query($query_histologia_n1, $connect);
								if ($lista_histologia_n1){
									$numero_histologia_n1=mysql_num_rows($lista_histologia_n1);
										if($numero_histologia_n1 == 0) {
										} else {
											while(list($id_histologia_n1,$nombre_histologia_n1)= mysql_fetch_row($lista_histologia_n1)){ 	
											echo "<option value=\"$id_histologia_n1\">$nombre_histologia_n1</option>\n";	
											}  
										}
								}    	
					echo "</select>\n";	
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"numero_mutaciones\" class=\"span-4\">Number of Mutations</label>\n";
					echo "<input type=\"text\" name=\"numero_mutaciones\" id=\"numero_mutaciones\" class=\"span-3\" />\n";        
				echo "</p>\n";
				
				
				echo "<p class=\"centrado\">\n";
                    echo "<input type=\"hidden\" name=\"id_mutacion\" id=\"id_mutacion\" value=\"$id_mutacion\" />\n";
				    echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"atm\" />\n";
                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                 echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_tumor_mutacion($id_mutacion,$id_tejido_n1,$id_histologia_n0,$id_histologia_n1){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);

$query_tm="select tejidos_n0.id_tejido_n0,tejidos_n0.nombre_tejido_n0,nombre_tejido_n1,
nombre_histologia_n0,
nombre_histologia_n1,
numero_mutaciones
from mutaciones_tumores,tejidos_n1,tejidos_n0,histologia_n0,histologia_n1 
where mutaciones_tumores.id_tejido_n1=tejidos_n1.id_tejido_n1 and 
tejidos_n1.id_tejido_n0=tejidos_n0.id_tejido_n0 and 
mutaciones_tumores.id_histologia_n0=histologia_n0.id_histologia_n0
and  mutaciones_tumores.id_histologia_n1=histologia_n1.id_histologia_n1 and id_mutacion='".$id_mutacion."'
and tejidos_n1.id_tejido_n1='".$id_tejido_n1."'
and histologia_n0.id_histologia_n0='".$id_histologia_n0."'
and histologia_n1.id_histologia_n1='".$id_histologia_n1."'";
//echo $query_tm;
$lista_tm = mysql_query($query_tm, $connect);
	if ($lista_tm){
	$numero_tm=mysql_num_rows($lista_tm);
	if($numero_tm == 0) {
	} else {
	
list($id_tejido_n0,$nombre_tejido_n0,$nombre_tejido_n1,$nombre_histologia_n0,$nombre_histologia_n1,$numero_mutaciones)= mysql_fetch_row($lista_tm);
echo "<div class=\"span-14 last\">\n";
	echo "<form action=\"functions_mut.php\" method=\"post\" name=\"form_etm\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Editar Tumor</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label class=\"span-4\">Tissue</label>\n";
					echo "<label>$nombre_tejido_n0</label>\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label class=\"span-4\">SubTissue</label>\n";
					echo "<label>$nombre_tejido_n1</label>\n";
				echo "</p>\n";
				
				echo "<p class=\"formulario\">\n";
					echo "<label class=\"span-4\">Histology</label>\n";
					echo "<label>$nombre_histologia_n0</label>\n";
				echo "</p>\n";			
				echo "<p class=\"formulario\">\n";
					echo "<label class=\"span-4\">SubHistology</label>\n";
					echo "<label>$nombre_histologia_n1</label>\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"numero_mutaciones\" class=\"span-4\">Number of Mutations</label>\n";
					echo "<input type=\"text\" name=\"numero_mutaciones\" id=\"numero_mutaciones\" value=\"$numero_mutaciones\" class=\"span-3\" />\n";        
				echo "</p>\n";
				
				
				echo "<p class=\"centrado\">\n";
                    echo "<input type=\"hidden\" name=\"id_mutacion\" id=\"id_mutacion\" value=\"$id_mutacion\" />\n";
				     echo "<input type=\"hidden\" name=\"id_tejido_n1\" id=\"id_tejido_n1\" value=\"$id_tejido_n1\" />\n";
					  echo "<input type=\"hidden\" name=\"id_histologia_n0\" id=\"id_histologia_n0\" value=\"$id_histologia_n0\" />\n";
					 echo "<input type=\"hidden\" name=\"id_histologia_n1\" id=\"id_histologia_n1\" value=\"$id_histologia_n1\" />\n";
					
					
					
					
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"etm\" />\n";
                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                 echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
}
}

include ("inc/footer_ventana.php");
}
function add_diana_mutacion($id_mutacion){
global $connect,$basedatos;

echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions_mut.php\" method=\"post\" name=\"form_adiam\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Diana</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_diana\" class=\"span-3\">Diana</label>\n";
					echo "<select name=\"select_diana\" id=\"select_diana\" class=\"span-7\" onChange=actualiza_diana(this.value)>\n";        
							 			
								$query_dianas="select id_diana,dianas.id_diana_n0,descripcion_diana,descripcion_diana_n0 
								from dianas,dianas_n0
								where dianas.id_diana_n0=dianas_n0.id_diana_n0
								order by descripcion_diana_n0,descripcion_diana";
								$lista_dianas = mysql_query($query_dianas, $connect);
								if ($lista_dianas){
									$numero_dianas=mysql_num_rows($lista_dianas);
										if($numero_dianas == 0) {
										} else {
											echo "<option value=\"-1\">Seleccione Diana</option>\n";
											$id_diana_n0_anterior='0';
											while(list($id_diana,$id_diana_n0,$descripcion_diana,$descripcion_diana_n0)= mysql_fetch_row($lista_dianas)){ 	
												if ($id_diana_n0_anterior==$id_diana_n0){
                                                echo "<option value=\"$id_diana\">$descripcion_diana</option>\n";	
                                                }else{
													if ($id_diana_n0_anterior=='0'){
                                                    echo "<optgroup label=\"$descripcion_diana_n0\">\n";
                                                    }else{
                                                    echo "</optgroup>\n";
                                                    echo "<optgroup label=\"$descripcion_diana_n0\">\n";
                                                    }
                                                    
													echo "<option value=\"$id_diana\">$descripcion_diana</option>\n";	
													
                                                  }
                                               $id_diana_n0_anterior=$id_diana_n0;
												}  
											echo "<optgroup label=\"New target\">\n";
											echo "<option value=\"0\">New Target</option>\n";	
											echo "</optgroup>\n";
										}
								}    	
					echo "</select>\n";	
				echo "</p>\n";
				echo "<div class=\"oculto\" id=\"f_nueva_diana\">\n";
				  echo "<p class=\"formulario\">\n";
					  echo "<label for \"select_dn0\" class=\"span-3\">Categoria Diana</label>\n";
					  echo "<select name=\"select_dn0\" id=\"select_dn0\" class=\"span-6\">\n";        
					  $query_dn0="select id_diana_n0,descripcion_diana_n0 from dianas_n0 order by descripcion_diana_n0" ;
					  $lista_dn0 = mysql_query($query_dn0, $connect);
					  if ($lista_dn0){
					  $numero_dn0=mysql_num_rows($lista_dn0);
						  if($numero_dn0 == 0) {
						  } else {
							  while(list($id_diana_n0_lista,$descripcion_diana_n0_lista)= mysql_fetch_row($lista_dn0)){
							  echo "<option value=\"$id_diana_n0_lista\">$descripcion_diana_n0_lista</option>\n";	
							  }
						  }
					  }    	
					  
					  echo "</select>\n";	
				  echo "</p>\n";	
				  echo "<p class=\"formulario\">\n";
					echo "<label for \"diana_nueva\" class=\"span-3\">Descripcion</label>\n";
					echo "<input type=\"text\" name=\"diana_nueva\" id=\"diana_nueva\" class=\"span-6\" />\n";
				  echo "</p>\n";
				echo "</div>\n";								
				echo "<p class=\"centrado\">\n";
                                    echo "<input type=\"hidden\" name=\"id_mutacion\" id=\"id_mutacion\" value=\"$id_mutacion\" />\n";
				    				echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"add_adiam\" />\n";
                                     echo "<input type=\"hidden\" name=\"id_diana\" id=\"id_diana\" value=\"-1\" />\n";
									echo "<input type=\"button\" value=\"Actualizar\" onClick=\"agregar_diana()\" />\n";  
                                echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
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
case "af":

break;
//farmacos nuevos


case "am":
add_mutacion();
break;
case "apm":
add_pathway_mutacion($_GET['id_mutacion']);
break;
case "epm":
edit_pathway_mutacion($_GET['id_mutacion'],$_GET['id_pathway']);
break;
case "atm":
add_tumor_mutacion($_GET['id_mutacion']);
break;
case "etm":
editar_tumor_mutacion($_GET['id_mutacion'],$_GET['id_tejido_n1'],$_GET['id_histologia_n0'],$_GET['id_histologia_n1']);
break;
case "adiam":
add_diana_mutacion($_GET['id_mutacion']);
break;
}

/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
*/
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana600(a){\n";
echo "window.open (a,\"ventanas_mut\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=450\");\n";
echo "}\n";
echo "function agregar_diana(){\n";
echo "elemento1=document.getElementById('id_diana');\n";
	echo "if (elemento1.value==-1){\n";
	echo "alert(\"Seleccione una Diana \");\n";
	echo "}else{\n";
	echo "document.form_adiam.submit();\n";
	echo "}\n";
echo "}\n";
echo "function actualiza_diana(iddiana){\n";
echo "objeto1=document.getElementById('diana_nueva');\n";
echo "objeto2=document.getElementById('id_diana');\n";
echo "objeto3=document.getElementById('f_nueva_diana');\n";
echo "objeto2.value=iddiana;\n";
	echo "if (iddiana==0){\n";
	echo "objeto3.style.visibility='visible';\n";
	echo "objeto1.focus();\n";
	echo "}else{\n";
	echo "objeto3.style.visibility='hidden';\n";
	echo "}\n";

echo "}\n";










echo "//-->\n";
echo "</script>\n";  
?>