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

function add_farmaco(){
global $connect,$basedatos;

echo "<div class=\"span-12 last\">\n";
    echo "<form action=\"functions.php\" method=\"post\" name=\"form_af\">\n";
        echo "<div class=\"cabecera1\">\n";
			echo "<p class=\"leyenda\">Agregar Farmaco</p>\n";
		echo "</div>\n";
		echo "<div class=\"izq\">\n";
			echo "<p class=\"formulario\">\n";
				echo "<label for \"nombre_farmaco\" class=\"span-3\">Drug Name</label>\n";
				echo "<input type=\"text\" name=\"nombre_farmaco\" class=\"span-8\" />\n";
			echo "</p>\n";
			echo "<div class=\"dcha conborde clearfix\">\n";
				echo "<p class=\"leyenda\">More Information</p>\n";
				echo "<p class=\"fomulariosin\">\n";
					echo "<textarea name=\"observaciones_farmaco\" class=\"span-9\"></textarea>\n";
				echo "</p>\n";;
			echo "</div>\n";	
			echo "<div class=\"dcha conborde clearfix\">\n";
				echo "<p class=\"leyenda\">Clasification Advers Reaction in Clinical Trials</p>\n";
				echo "<p class=\"fomulariosin\">\n";
					echo "<textarea name=\"clasificacion_toxicidad_farmaco\" class=\"span-9\"></textarea>\n";
				echo "</p>\n";
			echo "</div>\n";
			echo "<p class=\"fomulariosin\"></p>\n";
			echo "<p class=\"formulario centrado\">\n";
				echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"af\" />\n";
				echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
			echo "</p>\n";
        echo "</div>\n";	
    echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}
function add_toxicidad_farmaco($id_farmaco){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$array_toxicidades_farmaco=array();
$query_toxicidades_farmaco="select distinct id_toxicidad from farmacos_toxicidad where id_farmaco=".$id_farmaco;
$lista_toxicidades_farmaco = mysql_query($query_toxicidades_farmaco, $connect);
if ($lista_toxicidades_farmaco){
	$numero_toxicidades_farmaco=mysql_num_rows($lista_toxicidades_farmaco);
		if($numero_toxicidades_farmaco == 0) {
		} else {
			while(list($id_toxicidad)= mysql_fetch_row($lista_toxicidades_farmaco)){ 	
				$array_toxicidades_farmaco[$id_toxicidad]=$id_toxicidad;			
			}  
		}
}

echo "<div class=\"span-12 last\">\n";
	
	echo "<form action=\"functions.php\" method=\"post\" name=\"form_atf\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Toxicidad Farmaco</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_tx\" class=\"span-3\">Toxicidad</label>\n";
					echo "<select name=\"select_tx\" id=\"select_tx\" class=\"span-7\">\n";        
							 	$query_toxicidades_todas="select id_toxicidad,toxicidad.id_toxicidad_n0,nombre_toxicidad,descripcion_toxicidad_n0
                                                             from toxicidad,toxicidad_n0 where
                                                             toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0 order by descripcion_toxicidad_n0,nombre_toxicidad";
								
								//$query_toxicidades_todas="select id_toxicidad,nombre_toxicidad from toxicidad order by nombre_toxicidad";
								$lista_toxicidades_todas = mysql_query($query_toxicidades_todas, $connect);
								if ($lista_toxicidades_todas){
									$numero_toxicidades_todas=mysql_num_rows($lista_toxicidades_todas);
										if($numero_toxicidades_todas == 0) {
										} else {
											$grptx_anterior='0';
											while(list($id_toxicidad_t,$id_grp_tx,$nombre_toxicidad_t,$descripcion_grp_tx)= mysql_fetch_row($lista_toxicidades_todas)){
											//while(list($id_toxicidad_t,$nombre_toxicidad_t)= mysql_fetch_row($lista_toxicidades_todas)){ 	
												if ($grptx_anterior==$id_grp_tx){
                                                	if (!in_array($id_toxicidad_t,$array_toxicidades_farmaco)){
												 		echo "<option value=\"$id_toxicidad_t\">$nombre_toxicidad_t</option>\n";	
													}
                                                                                               
                                                 }else{
                                                    if ($grptx_anterior=='0'){
                                                    echo "<optgroup label=\"$descripcion_grp_tx\">\n";
                                                    }else{
                                                    echo "</optgroup>\n";
                                                    echo "<optgroup label=\"$descripcion_grp_tx\">\n";
                                                    }
                                                    if (!in_array($id_toxicidad_t,$array_toxicidades_farmaco)){
													echo "<option value=\"$id_toxicidad_t\">$nombre_toxicidad_t</option>\n";	
													}
                                                  }
                                               $grptx_anterior=$id_grp_tx;
													/*
													if (!in_array($id_toxicidad_t,$array_toxicidades_farmaco)){
													echo "<option value=\"$id_toxicidad_t\">$nombre_toxicidad_t</option>\n";	
													}
											        */
											}  
										}
								}    	
					echo "</select>\n";	
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"txall\" class=\"span-3\">Grade All</label>\n";		
					echo "<input type=\"text\" name=\"txall\" id=\"txall\" value=\"0.0\" class=\"span-2\" />\n";
				echo "</p>\n";									
				echo "<p class=\"formulario\">\n";
					echo "<label for \"tx34\" class=\"span-3\">Grade 3/4</label>\n";		
					echo "<input type=\"text\" name=\"tx34\" id=\"tx34\" value=\"0.0\" class=\"span-2\" />\n";
				echo "</p>\n";						
                                echo "<p>\n";
                                    echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
									echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"add_atf\" />\n";
                                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_toxicidad_farmaco($id_farmaco,$id_toxicidad){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_toxicidades="select nombre_toxicidad,id_categoria,valor_toxicidad from farmacos_toxicidad,toxicidad  
where farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and 
farmacos_toxicidad.id_toxicidad='".$id_toxicidad."' and id_farmaco='".$id_farmaco."'";
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
	if ($lista_toxicidades){
	$numero_toxicidades=mysql_num_rows($lista_toxicidades);
	if($numero_toxicidades == 0) {
	} else {
	$array_toxicidad_farmaco=array();
		while(list($nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){	
		$array_toxicidad_farmaco[$id_categoria]=$valor_toxicidad;
		$titulo_toxicidad=$nombre_toxicidad;
		}
		
				if (array_key_exists(0,$array_toxicidad_farmaco)){
				$txall=$array_toxicidad_farmaco[0];
				}else{
				$txall="0.0";
				}
				if (array_key_exists(4,$array_toxicidad_farmaco)){
				$tx34=$array_toxicidad_farmaco[4];
				}else{
				$tx34="0.0";
				}

echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions.php\" method=\"post\" name=\"form_etf\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">$titulo_toxicidad</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"txall\" class=\"span-3\">Grade All</label>\n";		
					echo "<input type=\"text\" name=\"txall\" id=\"txall\" value=\"$txall\" class=\"span-2\" />\n";
				echo "</p>\n";									
				echo "<p class=\"formulario\">\n";
					echo "<label for \"tx34\" class=\"span-3\">Grade 3/4</label>\n";		
					echo "<input type=\"text\" name=\"tx34\" id=\"tx34\" value=\"$tx34\" class=\"span-2\" />\n";
				echo "</p>\n";						
                                echo "<p>\n";
                                    echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
									 echo "<input type=\"hidden\" name=\"id_toxicidad\" id=\"id_toxicidad\" value=\"$id_toxicidad\" />\n";
									echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"etf\" />\n";
                                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
}
}

include ("inc/footer_ventana.php");
}




function add_link_farmaco($id_farmaco){
global $connect,$basedatos;

echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions.php\" method=\"post\" name=\"form_atf\">\n";
	    echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Link</p>\n";
            echo "</div>\n";
            echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_tipo_link\" class=\"span-3\">Tipo Link</label>\n";
					echo "<select name=\"select_tipo_link\" id=\"select_tipo_link\" class=\"span-7\">\n";        
					$query_tipos_link="select tipo_link,descripcion_tipo_link from categorias_link where link_ffda=1";
					$lista_tipos_link = mysql_query($query_tipos_link, $connect);
						if ($lista_tipos_link){
						$numero_tipos_link=mysql_num_rows($lista_tipos_link);
							if($numero_tipos_link == 0) {
							} else {
									while(list($id_tipo_link,$descripcion_tipo_link)= mysql_fetch_row($lista_tipos_link)){ 	
										echo "<option value=\"$id_tipo_link\">$descripcion_tipo_link</option>\n";	
									}  
							}
						}    	
					echo "</select>\n";	
				echo "</p>\n";
			echo "<p class=\"formulario\">\n";
		    echo "<label for \"descripcion_link\" class=\"span-3\">Descripcion</label>\n";
		    echo "<input class=\"span-7\" type=\"text\" name=\"descripcion_link\" />\n";
            echo "</p>\n";
			echo "<p class=\"formulario\">\n";
                echo "<label for \"url_link\" class=\"span-3\">Url</label>\n";
                echo "</p>\n";		
                echo "<p class=\"formulario\">\n";
                echo "<textarea name=\"url_link\" class=\"span-11\"></textarea>\n";
                echo "</p>\n";	       	     
                echo "<p class=\"formulario centrado\">\n";
                        echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
                        echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"add_alkf\" />\n";
                        echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                echo "</p>\n";
            echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_link_farmaco($id_link){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_link="select descripcion_link,url_link,tipo_link from farmacos_links where id_link='".$id_link."'";
$lista_link = mysql_query($query_link, $connect);
	if ($lista_link){
	$numero_link=mysql_num_rows($lista_link);
            if($numero_link == 0) {
            } else {
            list($descripcion_link,$url_link,$tipo_link)= mysql_fetch_row($lista_link);
                echo "<div class=\"span-12 last\">\n";
                        echo "<form action=\"functions.php\" method=\"post\" name=\"form_atf\">\n";
                            echo "<div class=\"cabecera1\">\n";
                                echo "<p class=\"leyenda\">Agregar Link</p>\n";
                            echo "</div>\n";
                            echo "<div class=\"izq\">\n";
                                echo "<p class=\"formulario\">\n";
								echo "<label for \"select_tipo_link\" class=\"span-3\">Tipo Link</label>\n";
								echo "<select name=\"select_tipo_link\" id=\"select_tipo_link\" class=\"span-7\">\n";        
							 	
								$query_tipos_link="select tipo_link,descripcion_tipo_link from categorias_link where link_ffda=1";
								$lista_tipos_link = mysql_query($query_tipos_link, $connect);
								if ($lista_tipos_link){
									$numero_tipos_link=mysql_num_rows($lista_tipos_link);
										if($numero_tipos_link == 0) {
										} else {
											while(list($id_tipo_link,$descripcion_tipo_link)= mysql_fetch_row($lista_tipos_link)){ 	
											
												if ($id_tipo_link==$tipo_link){
												$sel = "selected";
												}else{
												$sel = "";
												}
											echo "<option $sel value=\"$id_tipo_link\">$descripcion_tipo_link</option>\n";	
											}  
										}
								}    	
								echo "</select>\n";	
								echo "</p>\n";
								echo "<p class=\"formulario\">\n";
                                    echo "<label for \"descripcion_link\" class=\"span-3\">Descripcion</label>\n";
                                    echo "<input class=\"span-7\" type=\"text\" name=\"descripcion_link\" value=\"$descripcion_link\" />\n";
                                echo "</p>\n";
                                echo "<p class=\"formulario\">\n";
                                echo "<label for \"url_link\" class=\"span-3\">Url</label>\n";
                                echo "</p>\n";		
                                echo "<p class=\"formulario\">\n";
                                echo "<textarea name=\"url_link\" class=\"span-11\">".$url_link."</textarea>\n";
                                echo "</p>\n";	       	     
                                echo "<p class=\"formulario centrado\">\n";
                                        echo "<input type=\"hidden\" name=\"id_link\" id=\"id_link\" value=\"$id_link\" />\n";
                                        echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"elkf\" />\n";
                                        echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                echo "</p>\n";
                            echo "</div>\n";	
                        echo "</form>\n";
                echo "</div>\n";
            }
        }

include ("inc/footer_ventana.php");
}

function add_indicacion_farmaco($id_farmaco){
global $connect,$basedatos;

echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions.php\" method=\"post\" name=\"form_atf\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Indicacion Farmaco</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_indicacion\" class=\"span-3\">Indicacion</label>\n";
					echo "<select name=\"select_indicacion\" id=\"select_indicacion\" class=\"span-7\">\n";        
							 	
								$query_indicaciones="select id_indicacion,descripcion_indicacion from indicaciones order by descripcion_indicacion";
								$lista_indicaciones = mysql_query($query_indicaciones, $connect);
								if ($lista_indicaciones){
									$numero_indicaciones=mysql_num_rows($lista_indicaciones);
										if($numero_indicaciones == 0) {
										} else {
											while(list($id_indicacion,$descripcion_indicacion)= mysql_fetch_row($lista_indicaciones)){ 	
											echo "<option value=\"$id_indicacion\">$descripcion_indicacion</option>\n";	
											}  
										}
								}    	
					echo "</select>\n";	
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
                                    echo "<label for \"testado\" class=\"span-2\">Hay datos</label>\n";		
                                    echo "<input type=\"checkbox\" name=\"testado\" id=\"testado\" value=\"1\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
                                    echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
				    echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"add_aif\" />\n";
                                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function edit_indicacion_farmaco($id_farmaco,$id_indicacion){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_indicacion="select descripcion_indicacion,testado from farmacos_indicaciones,indicaciones where farmacos_indicaciones.id_indicacion=indicaciones.id_indicacion
and id_farmaco='".$id_farmaco."' and indicaciones.id_indicacion='".$id_indicacion."'";
$lista_indicaciones = mysql_query($query_indicacion, $connect);
	if ($lista_indicaciones){
	$numero_indicaciones=mysql_num_rows($lista_indicaciones);
            if($numero_indicaciones == 0) {
            } else {
            list($descripcion_indicacion,$testado)= mysql_fetch_row($lista_indicaciones);
                echo "<div class=\"span-12 last\">\n";
                        echo "<form action=\"functions.php\" method=\"post\" name=\"form_atf\">\n";
                                echo "<div class=\"cabecera1\">\n";
                                echo "<p class=\"leyenda\">$descripcion_indicacion</p>\n";
                                echo "</div>\n";
                                echo "<div class=\"izq\">\n";
                                    echo "<p class=\"formulario\">\n";
                                        echo "<label for \"testado\" class=\"span-2\">Hay datos</label>\n";		
                                        if ($testado==0){
                                        echo "<input type=\"checkbox\" name=\"testado\" id=\"testado\" value=\"1\"  />\n";
                                        }else{
                                        echo "<input type=\"checkbox\" name=\"testado\" id=\"testado\" value=\"1\" checked />\n";
                                        }
                                    echo "</p>\n";									
                                    echo "<p class=\"centrado\">\n";
                                        echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
                                        echo "<input type=\"hidden\" name=\"id_indicacion\" id=\"id_indicacion\" value=\"$id_indicacion\" />\n";
                                        echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"eif\" />\n";
                                        echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                    echo "</p>\n";
                                echo "</div>\n";	
                        echo "</form>\n";
                echo "</div>\n";
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
case "af":
add_farmaco();
break;
case "atf":
add_toxicidad_farmaco($_GET['id_farmaco']);
break;
case "etf":
editar_toxicidad_farmaco($_GET['id_farmaco'],$_GET['id_toxicidad']);
break;

case "btf":
borrar_toxicidad_farmaco($_GET['id_farmaco'],$_GET['id_toxicidad']);
break;
//farmacos nuevos

case "alkf":
add_link_farmaco($_GET['id_farmaco']);
break;
case "elkf":
editar_link_farmaco($_GET['id_link']);
break;
case "aif":
add_indicacion_farmaco($_GET['id_farmaco']);
break;
case "eif":
edit_indicacion_farmaco($_GET['id_farmaco'],$_GET['id_indicacion']);
break;
}



/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
*/
echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana400(a){\n";
echo "window.open (a,\"farmacos_fda\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=400,height=350\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>