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
function add_pathway_farmaco($id_farmaco){
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
								echo "<div class=\"span-0 last\"><a class=\"blineatabla badd2\" href=\"functions.php?op=apfn&id_farmaco=".$id_farmaco."&id_pathway=".$id_pathway."\"></a></div>\n";
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



function add_farmaco_nuevo(){
global $connect,$basedatos;

echo "<div class=\"span-18 last\">\n";
    echo "<form action=\"functions.php\" method=\"post\" name=\"form_afn\">\n";
        echo "<div class=\"cabecera1\">\n";
            echo "<p class=\"leyenda\">Agregar Farmaco</p>\n";
        echo "</div>\n";
        echo "<div class=\"izq\">\n";
              echo "<p class=\"formulario\">\n";
                echo "<label for \"nombre_farmaco\" class=\"span-5\">Nombre</label>\n";
                echo "<input type=\"text\" name=\"nombre_farmaco\" id=\nombre_farmaco\" class=\"span-8\" />\n";
            echo "</p>\n";
            echo "<p class=\"formulario\">\n";
                echo "<label for \"autores\" class=\"span-5\">Auhors</label>\n";
                echo "<input type=\"text\" name=\"autores\" id=\"autores\"  class=\"span-8\" />\n";
            echo "</p>\n";
             echo "<p class=\"formulario\">\n";
				echo "<label for \"select_categoria_diana\" class=\"span-5\">Target</label>\n";
				echo "<select name=\"select_categoria_diana\" id=\"select_categoria_diana\" class=\"span-8\" onChange=actualiza_categoria(this.value)>\n";        
							 				$query_categorias = "select id_categoria_diana,descripcion_categoria_diana from categorias_dianas order by  id_categoria_diana";
											$resultado_categorias = mysql_query($query_categorias,$connect);
												if ($resultado_categorias){
												$numero_categorias=mysql_num_rows($resultado_categorias);
				    								if($numero_categorias == 0) {
				   									} else {
														echo "<option selected value=\"-1\">Seleccione una Categoria</option>\n";	
														while(list($id_cat_diana,$descripcion_cat_diana)= mysql_fetch_row($resultado_categorias)){
														echo "<option value=\"$id_cat_diana\">$descripcion_cat_diana</option>\n";	
														}  
														echo "<option value=\"0\">Categoria Nueva</option>\n";	
													
													}
												}    	
				echo "</select>\n";	
			echo "</p>\n";
            echo "<p class=\"formulario oculto\" id=\"f_nueva_categoria\">\n";
                echo "<label for \"categoria_nueva\" class=\"span-5\">Descripcion Categoria Nueva</label>\n";
                echo "<input type=\"text\" name=\"categoria_nueva\" id=\"categoria_nueva\" class=\"span-8\" />\n";
            echo "</p>\n";
			
			echo "<p class=\"formulario\">\n";
                echo "<label for \"tipo_ensayo\" class=\"span-5\">Tipo Ensayo</label>\n";
                echo "<input type=\"text\" name=\"tipo_ensayo\" id=\"tipo_ensayo\" class=\"span-8\" />\n";
            echo "</p>\n";
			echo "<p class=\"formulario\">\n";
				echo "<label for \"celular_process\" class=\"span-5\">Process</label>\n";
				echo "<input type=\"text\" name=\"celular_process\"  class=\"span-6\" />\n";
			echo "</p>\n";		
			echo "<p class=\"fomulariosin\">\n";
                echo "<label for \"comentarios\" class=\"span-5\">Comentarios</label>\n";
                echo "<textarea name=\"comentarios\"  id=\"comentarios\" class=\"span-10\"></textarea>\n";
            echo "</p>\n";
            echo "<p class=\"formulario\">\n";
             echo "</p>\n";
            echo "<p class=\"fomulariosin\">\n";
                 echo "<label for \"tx1desc\" class=\"span-5\">related adverse events (AEs) reported in =>10%</label>\n";
                echo "<textarea name=\"tx1desc\" id=\"tx1desc\" class=\"span-10\"></textarea>\n";
            echo "</p>\n";
            echo "<p class=\"formulario\">\n";
             echo "</p>\n";
            echo "<p class=\"fomulariosin\">\n";
                echo "<label for \"tx2desc\" class=\"span-5\">drug-related AEs => Gr 3</label>\n";
                echo "<textarea name=\"tx2desc\" id=\"tx2desc\" class=\"span-10\"></textarea>\n";
            echo "</p>\n";
            
            echo "<p class=\"formulario centrado\">\n";
                echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"afn\" />\n";
                echo "<input type=\"hidden\" name=\"id_categoria_diana\" id=\"id_categoria_diana\" value=\"-1\" />\n";
				echo "<input type=\"button\" value=\"Actualizar\" onClick=\"agregar_categoria()\" />\n"; 
            echo "</p>\n";
        
        
        
        echo "</div>\n";	
    echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function add_toxicidad_farmaco_nuevo($id_farmaco){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$array_toxicidades_farmaco=array();
$query_toxicidades_farmaco="select distinct id_toxicidad from farmacos_inv_toxicidad where id_farmaco=".$id_farmaco;
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
                                    echo "<label for \"tx1\" class=\"span-2\">AE =>10</label>\n";		
                                    echo "<input type=\"checkbox\" name=\"tx1\" id=\"tx1\" value=\"1\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"formulario\">\n";                            
                                    echo "<label for \"tx2\" class=\"span-2\">Gr =>3</label>\n";		
                                    echo "<input type=\"checkbox\" name=\"tx2\" id=\"tx2\" value=\"1\"  />\n";
                                echo "</p>\n";		
                          	echo "<p class=\"centrado\">\n";
                                    echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
				    echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"add_atfn\" />\n";
                                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}
function editar_toxicidad_farmaco_nuevo($id_farmaco,$id_toxicidad){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_toxicidades="select nombre_toxicidad,tx1,tx2 from farmacos_inv_toxicidad,toxicidad where farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad 
and id_farmaco='".$id_farmaco."' and toxicidad.id_toxicidad='".$id_toxicidad."'";

$lista_toxicidades = mysql_query($query_toxicidades, $connect);
	if ($lista_toxicidades){
	$numero_toxicidades=mysql_num_rows($lista_toxicidades);
	if($numero_toxicidades == 0) {
	} else {
	
list($nombre_toxicidad,$tx1,$tx2)= mysql_fetch_row($lista_toxicidades);
		
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions.php\" method=\"post\" name=\"form_etfn\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">$nombre_toxicidad</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
                                    echo "<label for \"tx1\" class=\"span-2\">AE =>10</label>\n";		
                                    if ($tx1==0){
                                    echo "<input type=\"checkbox\" name=\"tx1\" id=\"tx1\" value=\"1\"  />\n";
                                    }else{
                                    echo "<input type=\"checkbox\" name=\"tx1\" id=\"tx1\" value=\"1\" checked />\n";
                                    }
				echo "</p>\n";									
				echo "<p class=\"formulario\">\n";                            
                                    echo "<label for \"tx2\" class=\"span-2\">Gr =>3</label>\n";		
				    if ($tx2==0){
                                    echo "<input type=\"checkbox\" name=\"tx2\" id=\"tx2\" value=\"1\"  />\n";
                                    }else{
                                    echo "<input type=\"checkbox\" name=\"tx2\" id=\"tx2\" value=\"1\" checked />\n";
                                    }
                                echo "</p>\n";						
                                echo "<p class=\"centrado\">\n";
                                    echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
				    echo "<input type=\"hidden\" name=\"id_toxicidad\" id=\"id_toxicidad\" value=\"$id_toxicidad\" />\n";
				    echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"etfn\" />\n";
                                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
}
}

include ("inc/footer_ventana.php");
}

function add_link_farmaco_nuevo($id_farmaco){
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
					$query_tipos_link="select tipo_link,descripcion_tipo_link from categorias_link where link_finv=1";
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
                        echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"add_alkfn\" />\n";
                        echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                echo "</p>\n";
            echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_link_farmaco_nuevo($id_link){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_link="select descripcion_link,url_link,tipo_link from farmacos_inv_link where id_link='".$id_link."'";
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
							 	
								$query_tipos_link="select tipo_link,descripcion_tipo_link from categorias_link where link_finv=1";
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
                                        echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"elkfn\" />\n";
                                        echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                echo "</p>\n";
                            echo "</div>\n";	
                        echo "</form>\n";
                echo "</div>\n";
            }
        }

include ("inc/footer_ventana.php");
}
function add_diana_farmaco_nuevo($id_farmaco){
global $connect,$basedatos;

echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions.php\" method=\"post\" name=\"form_adfn\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Diana</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_diana\" class=\"span-3\">Target</label>\n";
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
			
				echo "<p class=\"formulario\">\n";
                                    echo "<label for \"valor_diana\" class=\"span-3\">Valor</label>\n";		
                                    echo "<input type=\"text\" class=\"span-2\" name=\"valor_diana\" id=\"valor_diana\" />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
                                    echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
				    				echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"add_adiafn\" />\n";
                                     echo "<input type=\"hidden\" name=\"id_diana\" id=\"id_diana\" value=\"-1\" />\n";
									echo "<input type=\"button\" value=\"Actualizar\" onClick=\"agregar_diana()\" />\n";  
                                echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_diana_farmaco_nuevo($id_farmaco,$id_diana){
global $connect,$basedatos;
$query1="select valor_diana,descripcion_diana from farmacos_inv_diana,dianas  where farmacos_inv_diana.id_diana=dianas.id_diana and id_farmaco='".$id_farmaco."' and farmacos_inv_diana.id_diana='".$id_diana."'";
$lista1 = mysql_query($query1, $connect);
	if ($lista1){
	$filas1=mysql_num_rows($lista1);
            if($filas1 == 0) {
            } else {
            list($valor_diana,$descripcion_diana)= mysql_fetch_row($lista1);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions.php\" method=\"post\" name=\"form_atf\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">$descripcion_diana</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
                	echo "<label for \"valor_diana\" class=\"span-3\">Valor</label>\n";		
                	echo "<input type=\"text\" class=\"span-2\" name=\"valor_diana\" id=\"valor_diana\" value=\"$valor_diana\" />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
                	echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
					echo "<input type=\"hidden\" name=\"id_diana\" id=\"id_diana\" value=\"$id_diana\" />\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"edit_ediafn\" />\n";
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
case "afn":
add_farmaco_nuevo();
break;
case "atfn":
add_toxicidad_farmaco_nuevo($_GET['id_farmaco']);
break;
case "apfn":
add_pathway_farmaco($_GET['id_farmaco']);
break;
case "epfn":
edit_pathway_farmaco($_GET['id_farmaco'],$_GET['id_pathway']);
break;
case "etfn":
editar_toxicidad_farmaco_nuevo($_GET['id_farmaco'],$_GET['id_toxicidad']);
break;
case "alkfn":
add_link_farmaco_nuevo($_GET['id_farmaco']);
break;
case "elkfn":
editar_link_farmaco_nuevo($_GET['id_link']);
break;
case "adiafn":
add_diana_farmaco_nuevo($_GET['id_farmaco']);
break;
case "ediafn":
editar_diana_farmaco_nuevo($_GET['id_farmaco'],$_GET['id_diana']);
break;
}

/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
*/

echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function agregar_categoria(){\n";
echo "elemento1=document.getElementById('id_categoria_diana');\n";
	echo "if (elemento1.value==-1){\n";
	echo "alert(\"Seleccione una Categoria \");\n";
	echo "}else{\n";
	echo "document.form_afn.submit();\n";
	echo "}\n";
echo "}\n";
echo "function abrir_ventana400(a){\n";
echo "window.open (a,\"farmacos1\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=400,height=350\");\n";
echo "}\n";
echo "function abrir_ventana600(a){\n";
echo "window.open (a,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=500\");\n";
echo "}\n";
echo "function actualiza_categoria(idcategoria){\n";
echo "objeto1=document.getElementById('categoria_nueva');\n";
echo "objeto2=document.getElementById('id_categoria_diana');\n";
echo "objeto3=document.getElementById('f_nueva_categoria');\n";
echo "objeto2.value=idcategoria;\n";
	echo "if (idcategoria==0){\n";
	echo "objeto3.style.visibility='visible';\n";
	echo "objeto1.focus();\n";
	echo "}else{\n";
	echo "objeto3.style.visibility='hidden';\n";
	echo "}\n";

echo "}\n";
echo "function agregar_diana(){\n";
echo "elemento1=document.getElementById('id_diana');\n";
	echo "if (elemento1.value==-1){\n";
	echo "alert(\"Seleccione una Diana \");\n";
	echo "}else{\n";
	echo "document.form_adfn.submit();\n";
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