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
function lista_tumores_indicacion($id_indicacion,$nivel){
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
		echo "<div class=\"span-4\">SubTissue</div>\n";
		echo "<div class=\"span-5\">Histology</div>\n";
		echo "<div class=\"span-5\">SubHistology</div>\n";
		if ($nivel > 1){
		echo "<div class=\"span-0 last\"></div>\n";
		}
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
						echo "<div class=\"span-4\">$nombre_tejido_n1</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n0</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n1</div>\n";
						if ($nivel > 1){
						echo "<div class=\"span-0 last\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_tumor_indicacion('".$id_indicacion."','".$id_tejido_n1."','".$id_histologia_n0."','".$id_histologia_n1."')\"></a></div>\n";
					}
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";

}

function lista_pathways_indicacion($id_indicacion,$nivel){
global $basedatos,$connect;	

$query_pathways= "select indicacion_pathways.id_pathway,nombre_pathway,id_external from indicacion_pathways,pathways where indicacion_pathways.id_pathway=pathways.id_pathway and id_indicacion='".$id_indicacion."'";
$lista_pathways = mysql_query($query_pathways, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-0\"></div>\n";
		echo "<div class=\"span-18\">Pathway</div>\n";
		
		if ($nivel > 1){
		echo "<div class=\"span-0 last\"></div>\n";
		}
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";
	
	
if ($lista_pathways){
	$numero_pathways=mysql_num_rows($lista_pathways);
		if($numero_pathways== 0) {
		} else {
			while(list($id_pathway,$nombre_pathway,$id_external)= mysql_fetch_row($lista_pathways)){
			
			$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;

				echo "<li class=\"impar\">\n";
					echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$link_pathway."')\"></a></div>\n";
					echo "<div class=\"span-18\">".$nombre_pathway."</div>\n";
						if ($nivel > 1){
					echo "<div class=\"span-0 last\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_pathway_indicacion('".$id_indicacion."','".$id_pathway."')\"></a></div>\n";
					}
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				
				}
		}			
	}
	echo "</ul>\n";

}






function add_toxicidad_categoria_diana($id_categoria_diana){
global $connect,$basedatos;
$array_toxicidades_cd=array();
$query_toxicidades_cd="select distinct id_toxicidad from categorias_diana_toxicidad where id_categoria_diana=".$id_categoria_diana;
$lista_toxicidades_cd = mysql_query($query_toxicidades_cd, $connect);
if ($lista_toxicidades_cd){
	$numero_toxicidades_cd=mysql_num_rows($lista_toxicidades_cd);
		if($numero_toxicidades_cd == 0) {
		} else {
			while(list($id_toxicidad)= mysql_fetch_row($lista_toxicidades_cd)){ 	
				$array_toxicidades_cd[$id_toxicidad]=$id_toxicidad;			
			}  
		}
}

echo "<div class=\"span-12 last\">\n";
	
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_atf\">\n";
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
								$lista_toxicidades_todas = mysql_query($query_toxicidades_todas, $connect);
								if ($lista_toxicidades_todas){
									$numero_toxicidades_todas=mysql_num_rows($lista_toxicidades_todas);
										if($numero_toxicidades_todas == 0) {
										} else {
											$grptx_anterior='0';
                                                                                        while(list($id_toxicidad_t,$id_grp_tx,$nombre_toxicidad_t,$descripcion_grp_tx)= mysql_fetch_row($lista_toxicidades_todas)){ 	
                                                                                            if ($grptx_anterior==$id_grp_tx){
                                                                                                if (!in_array($id_toxicidad_t,$array_toxicidades_cd)){
												 echo "<option value=\"$id_toxicidad_t\">$nombre_toxicidad_t</option>\n";	
												}
                                                                                               
                                                                                            }else{
                                                                                                if ($grptx_anterior=='0'){
                                                                                                echo "<optgroup label=\"$descripcion_grp_tx\">\n";
                                                                                                }else{
                                                                                                echo "</optgroup>\n";
                                                                                                    echo "<optgroup label=\"$descripcion_grp_tx\">\n";
                                                                                                }
                                                                                                if (!in_array($id_toxicidad_t,$array_toxicidades_cd)){
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
                                    echo "<input type=\"hidden\" name=\"id_categoria_diana\" id=\"id_categoria_diana\" value=\"$id_categoria_diana\" />\n";
				    echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"add_atcd\" />\n";
                                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}
function editar_toxicidad_categoria_diana($id_categoria_diana,$id_toxicidad){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_toxicidades="select nombre_toxicidad,tx1,tx2 from categorias_diana_toxicidad,toxicidad where categorias_diana_toxicidad.id_toxicidad=toxicidad.id_toxicidad 
and id_categoria_diana='".$id_categoria_diana."' and toxicidad.id_toxicidad='".$id_toxicidad."'";

$lista_toxicidades = mysql_query($query_toxicidades, $connect);
	if ($lista_toxicidades){
	$numero_toxicidades=mysql_num_rows($lista_toxicidades);
	if($numero_toxicidades == 0) {
	} else {
	
list($nombre_toxicidad,$tx1,$tx2)= mysql_fetch_row($lista_toxicidades);
		
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_etfn\">\n";
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
                                    echo "<input type=\"hidden\" name=\"id_categoria_diana\" id=\"id_categoria_diana\" value=\"$id_categoria_diana\" />\n";
				    echo "<input type=\"hidden\" name=\"id_toxicidad\" id=\"id_toxicidad\" value=\"$id_toxicidad\" />\n";
				    echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"etcd\" />\n";
                                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                                echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
}
}

include ("inc/footer_ventana.php");
}

function add_toxicidad(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_atf\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Toxicidad</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_tx\" class=\"span-4\">Categoria Toxicidad</label>\n";
					echo "<select name=\"select_tx\" id=\"select_tx\" class=\"span-7\">\n";        
						$query_ct="select id_toxicidad_n0,descripcion_toxicidad_n0 from toxicidad_n0 order by descripcion_toxicidad_n0" ;
						$lista_ct = mysql_query($query_ct, $connect);
						
						if ($lista_ct){
						$numero_ct=mysql_num_rows($lista_ct);
							if($numero_ct == 0) {
							} else {
								while(list($id_toxicidad_n0,$descripcion_toxicidad_n0)= mysql_fetch_row($lista_ct)){
									echo "<option value=\"$id_toxicidad_n0\">$descripcion_toxicidad_n0</option>\n";	
								}
							}
						}    	
			
					echo "</select>\n";	
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"nombre_toxicidad\" class=\"span-4\">Toxicidad</label>\n";		
					echo "<input type=\"text\" name=\"nombre_toxicidad\" id=\"nombre_toxicidad\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"add_tx\" />\n";
					echo "<input type=\"submit\" value=\"Agregar Toxicidad\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");

}

function editar_toxicidad($id_toxicidad){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_txs="select nombre_toxicidad,id_toxicidad_n0 from toxicidad where id_toxicidad='".$id_toxicidad."'";

$lista_txs = mysql_query($query_txs, $connect);
	if ($lista_txs){
	$numero_txs=mysql_num_rows($lista_txs);
	if($numero_txs == 0) {
	} else {
	list($nombre_toxicidad,$id_toxicidad_n0)= mysql_fetch_row($lista_txs);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_et\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Editar Toxicidad</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_tx\" class=\"span-4\">Categoria Toxicidad</label>\n";
					echo "<select name=\"select_tx\" id=\"select_tx\" class=\"span-7\">\n";        
						$query_ct="select id_toxicidad_n0,descripcion_toxicidad_n0 from toxicidad_n0 order by descripcion_toxicidad_n0" ;
						$lista_ct = mysql_query($query_ct, $connect);
						if ($lista_ct){
						$numero_ct=mysql_num_rows($lista_ct);
							if($numero_ct == 0) {
							} else {
								while(list($id_tx_lista,$descripcion_tx_lista)= mysql_fetch_row($lista_ct)){
									if ($id_tx_lista==$id_toxicidad_n0){
										$sel = "selected";
									}else{
										$sel = "";
									}
								echo "<option $sel value=\"$id_tx_lista\">$descripcion_tx_lista</option>\n";	
								}
							}
						}    	
			
					echo "</select>\n";	
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"nombre_toxicidad\" class=\"span-4\">Toxicidad</label>\n";		
					echo "<input type=\"text\" name=\"nombre_toxicidad\" id=\"nombre_toxicidad\" value=\"$nombre_toxicidad\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"etx\" />\n";
					echo "<input type=\"hidden\" name=\"id_toxicidad\" id=\"id_toxicidad\" value=\"$id_toxicidad\" />\n";
					echo "<input type=\"submit\" value=\"Actualizar Toxicidad\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";

	}
	}
include ("inc/footer_ventana.php");

}

function add_categoria_toxicidad(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_act\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Categoria Toxicidad</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"descripcion_toxicidad_n0\" class=\"span-4\">Categoria Toxicidad</label>\n";		
					echo "<input type=\"text\" name=\"descripcion_toxicidad_n0\" id=\"descripcion_toxicidad_n0\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"act\" />\n";
					echo "<input type=\"submit\" value=\"Agregar Categoria Toxicidad\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}
function editar_categoria_toxicidad($id_toxicidad_n0){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_ct="select descripcion_toxicidad_n0 from toxicidad_n0 where id_toxicidad_n0='".$id_toxicidad_n0."'" ;
$lista_ct = mysql_query($query_ct, $connect);
if ($lista_ct){
	$numero_ct=mysql_num_rows($lista_ct);
	if($numero_ct == 0) {
	} else {
	list($descripcion_toxicidad_n0)= mysql_fetch_row($lista_ct);
									
								
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_ect\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Editar Categoria Toxicidad</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"descripcion_toxicidad_n0\" class=\"span-4\">Toxicidad</label>\n";		
					echo "<input type=\"text\" name=\"descripcion_toxicidad_n0\" id=\"descripcion_toxicidad_n0\" value=\"$descripcion_toxicidad_n0\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"ect\" />\n";
					echo "<input type=\"hidden\" name=\"id_toxicidad_n0\" id=\"id_toxicidad_n0\" value=\"$id_toxicidad_n0\" />\n";
					echo "<input type=\"submit\" value=\"Actualizar Categoria Toxicidad\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";

	}
	}
include ("inc/footer_ventana.php");
}

function add_diana(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_ad\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Diana</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_dn0\" class=\"span-4\">Categoria Diana</label>\n";
					echo "<select name=\"select_dn0\" id=\"select_dn0\" class=\"span-7\">\n";        
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
					echo "<label for \"descripcion_diana\" class=\"span-4\">Diana</label>\n";		
					echo "<input type=\"text\" name=\"descripcion_diana\" id=\"descripcion_diana\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"ad\" />\n";
					echo "<input type=\"submit\" value=\"Agregar Diana\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_diana($id_diana){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_d="select descripcion_diana,id_diana_n0 from dianas where id_diana='".$id_diana."'" ;
$lista_d = mysql_query($query_d, $connect);
if ($lista_d){
	$numero_d=mysql_num_rows($lista_d);
	if($numero_d == 0) {
	} else {
	list($descripcion_diana,$id_diana_n0)= mysql_fetch_row($lista_d);						
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_edn0\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Editar Diana</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"select_dn0\" class=\"span-4\">Categoria Diana</label>\n";
					echo "<select name=\"select_dn0\" id=\"select_dn0\" class=\"span-7\">\n";        
						$query_dn0="select id_diana_n0,descripcion_diana_n0 from dianas_n0 order by descripcion_diana_n0" ;
						$lista_dn0 = mysql_query($query_dn0, $connect);
						if ($lista_dn0){
						$numero_dn0=mysql_num_rows($lista_dn0);
							if($numero_dn0 == 0) {
							} else {
								while(list($id_diana_n0_lista,$descripcion_diana_n0_lista)= mysql_fetch_row($lista_dn0)){
									if ($id_diana_n0_lista==$id_diana_n0){
										$sel = "selected";
									}else{
										$sel = "";
									}
								echo "<option $sel value=\"$id_diana_n0_lista\">$descripcion_diana_n0_lista</option>\n";	
								}
							}
						}    	
			
					echo "</select>\n";	
				echo "</p>\n";
				
				
				echo "<p class=\"formulario\">\n";
					echo "<label for \"descripcion_diana\" class=\"span-4\">Diana </label>\n";		
					echo "<input type=\"text\" name=\"descripcion_diana\" id=\"descripcion_diana\" value=\"$descripcion_diana\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"ed\" />\n";
					echo "<input type=\"hidden\" name=\"id_diana\" id=\"id_diana\" value=\"$id_diana\" />\n";
					echo "<input type=\"submit\" value=\"Actualizar Diana\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";

	}
	}
include ("inc/footer_ventana.php");
}

function add_categoria_diana(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_acd\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Familia Farmaco</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"descripcion_categoria_diana\" class=\"span-4\">Familia Farmaco</label>\n";		
					echo "<input type=\"text\" name=\"descripcion_categoria_diana\" id=\"descripcion_categoria_diana\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"acd\" />\n";
					echo "<input type=\"submit\" value=\"Agregar Familia Farmaco\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_categoria_diana($id_categoria_diana){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_d="select descripcion_categoria_diana from categorias_dianas where id_categoria_diana='".$id_categoria_diana."'" ;
$lista_d = mysql_query($query_d, $connect);
if ($lista_d){
	$numero_d=mysql_num_rows($lista_d);
	if($numero_d == 0) {
	} else {
	list($descripcion_categoria_diana)= mysql_fetch_row($lista_d);						
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_ect\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Editar Familia</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"descripcion_categoria_diana\" class=\"span-4\">Familia Farmaco </label>\n";		
					echo "<input type=\"text\" name=\"descripcion_categoria_diana\" id=\"descripcion_categoria_diana\" value=\"$descripcion_categoria_diana\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"ecd2\" />\n";
					echo "<input type=\"hidden\" name=\"id_categoria_diana\" id=\"id_categoria_diana\" value=\"$id_categoria_diana\" />\n";
					echo "<input type=\"submit\" value=\"Actualizar Familia Farmaco\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";

	}
	}
include ("inc/footer_ventana.php");
}
function add_tipo_tumor(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_acd\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Tipo Tumor</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"descripcion_indicacion\" class=\"span-4\">Tipo de Tumor</label>\n";		
					echo "<input type=\"text\" name=\"descripcion_indicacion\" id=\"descripcion_indicacion\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"att\" />\n";
					echo "<input type=\"submit\" value=\"Agregar Tipo Tumor\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_tipo_tumor($id_indicacion){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_d="select descripcion_indicacion from indicaciones where id_indicacion='".$id_indicacion."'" ;
$lista_d = mysql_query($query_d, $connect);
if ($lista_d){
	$numero_d=mysql_num_rows($lista_d);
	if($numero_d == 0) {
	} else {
	list($descripcion_indicacion)= mysql_fetch_row($lista_d);						
echo "<form action=\"functions2.php\" method=\"post\" name=\"form_ett\">\n";
echo "<div class=\"span-21 last\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Editar Tipo Tumor</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"descripcion_indicacion\" class=\"span-4\">Tipo Tumor</label>\n";		
					echo "<input type=\"text\" name=\"descripcion_indicacion\" id=\"descripcion_indicacion\" value=\"$descripcion_indicacion\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"ett\" />\n";
					echo "<input type=\"hidden\" name=\"id_indicacion\" id=\"id_indicacion\" value=\"$id_indicacion\" />\n";
					echo "<input type=\"submit\" value=\"Actualizar Tipo Tumor\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
echo "</div>\n";
echo "<div class=\"span-21 last\">\n";
		echo "<div class=\"recuadroizq conborde\">\n";
			echo "<div class=\"cabecerarecuadro clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Tumour Clasification</div>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana600('ventanas_ctg.php?cop=ati&id_indicacion=".$id_indicacion."')\"></a>\n";
			echo "</div>\n";
			
			echo "<div class=\"cuerporecuadro clearfix\">\n";
			lista_tumores_indicacion($id_indicacion,2);
				//tumores
			echo "</div>\n";
		echo "</div>\n";
echo "</div>\n";
	
echo "<div class=\"span-21 last\">\n";
		echo "<div class=\"recuadroizq conborde\">\n";
			echo "<div class=\"cabecerarecuadro clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Pathways </div>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana600('ventanas_ctg.php?cop=apin&id_indicacion=".$id_indicacion."')\"></a>\n";
			echo "</div>\n";
			
			echo "<div class=\"cuerporecuadro clearfix\">\n";
			lista_pathways_indicacion($id_indicacion,2);
				//tumores
			echo "</div>\n";
		echo "</div>\n";
echo "</div>\n";



echo "</form>\n";


	}
	}
include ("inc/footer_ventana.php");
}

function add_diana_n0(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_adn0\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Agregar Categoria Diana</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"descripcion_diana_n0\" class=\"span-4\">Categoria Diana</label>\n";		
					echo "<input type=\"text\" name=\"descripcion_diana_n0\" id=\"descripcion_diana_n0\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"adn0\" />\n";
					echo "<input type=\"submit\" value=\"Agregar Categoria Diana\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_diana_n0($id_diana_n0){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_d="select descripcion_diana_n0 from dianas_n0 where id_diana_n0='".$id_diana_n0."'" ;
$lista_d = mysql_query($query_d, $connect);
if ($lista_d){
	$numero_d=mysql_num_rows($lista_d);
	if($numero_d == 0) {
	} else {
	list($descripcion_diana_n0)= mysql_fetch_row($lista_d);						
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_edn0\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Editar Categoria Diana</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"descripcion_diana_n0\" class=\"span-4\">Categoria Diana</label>\n";		
					echo "<input type=\"text\" name=\"descripcion_diana_n0\" id=\"descripcion_diana_n0\" value=\"$descripcion_diana_n0\" class=\"span-7\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"edn0\" />\n";
					echo "<input type=\"hidden\" name=\"id_diana_n0\" id=\"id_diana_n0\" value=\"$id_diana_n0\" />\n";
					echo "<input type=\"submit\" value=\"Actualizar Categoria Diana\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";

	}
	}
include ("inc/footer_ventana.php");
}

function add_tumor_indicacion($id_indicacion){
global $connect,$basedatos;

echo "<div class=\"span-14 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_ati\">\n";
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
				echo "<p class=\"centrado\">\n";
                    echo "<input type=\"hidden\" name=\"id_indicacion\" id=\"id_indicacion\" value=\"$id_indicacion\" />\n";
				    echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"ati\" />\n";
                    echo "<input type=\"submit\" value=\"Actualizar\" />\n"; 
                 echo "</p>\n";
                
                
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function add_pathway_indicacion($id_indicacion){
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
								echo "<div class=\"span-0 last\"><a class=\"blineatabla badd2\" href=\"functions.php?op=apin&id_indicacion=".$id_indicacion."&id_pathway=".$id_pathway."\"></a></div>\n";
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

function add_pathway(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_apw\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Add Pathway</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"id_external\" class=\"span-3\">ID EXTERNAL</label>\n";		
					echo "<input type=\"text\" name=\"id_external\" id=\"id_external\" class=\"span-4\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"formulario\">\n";
					echo "<label for \"nombre_pathway\" class=\"span-3\">Pathway Name</label>\n";		
					echo "<textarea name=\"nombre_pathway\" class=\"span-8\"></textarea>\n";
				echo "</p>\n";	
				echo "<p class=\"formulario\">\n";
				echo "</p>\n";
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"apw\" />\n";
					echo "<input type=\"submit\" value=\"Add Pathway\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_pathway($id_pathway){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_d="select id_external,nombre_pathway from pathways where id_pathway='".$id_pathway."'" ;
$lista_d = mysql_query($query_d, $connect);
if ($lista_d){
	$numero_d=mysql_num_rows($lista_d);
	if($numero_d == 0) {
	} else {
	list($id_external,$nombre_pathway)= mysql_fetch_row($lista_d);						
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions2.php\" method=\"post\" name=\"form_epw\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Edit Pathway</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"id_external\" class=\"span-3\">ID EXTERNAL</label>\n";		
					echo "<input type=\"text\" name=\"id_external\" id=\"id_external\" value=\"$id_external\"  class=\"span-4\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"formulario\">\n";
					echo "<label for \"nombre_pathway\" class=\"span-3\">Pathway Name</label>\n";		
					echo "<textarea name=\"nombre_pathway\" class=\"span-8\">$nombre_pathway</textarea>\n";
				echo "</p>\n";						
				echo "<p class=\"formulario\">\n";
				echo "</p>\n";		
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"epw\" />\n";
					echo "<input type=\"hidden\" name=\"id_pathway\" id=\"id_pathway\" value=\"$id_pathway\" />\n";
					echo "<input type=\"submit\" value=\"Save Pathway\" />\n"; 
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
case "at":
add_toxicidad();
break;
case "et":
editar_toxicidad($_GET['id_toxicidad']);
break;
case "ad":
add_diana();
break;
case "ed":
editar_diana($_GET['id_diana']);
break;
case "acd":
add_categoria_diana();
break;
case "ecd":
editar_categoria_diana($_GET['id_categoria_diana']);
break;
case "act":
add_categoria_toxicidad();
break;
case "ect":
editar_categoria_toxicidad($_GET['id_toxicidad_n0']);
break;

case "atcd":
add_toxicidad_categoria_diana($_GET['id_categoria_diana']);
break;
case "etcd":
editar_toxicidad_categoria_diana($_GET['id_categoria_diana'],$_GET['id_toxicidad']);
break;

case "att":
add_tipo_tumor();
break;
case "ett":
editar_tipo_tumor($_GET['id_indicacion']);
break;
case "adn0":
add_diana_n0();
break;
case "edn0":
editar_diana_n0($_GET['id_diana_n0']);
break;
case "ati":
add_tumor_indicacion($_GET['id_indicacion']);
break;
case "apw":
add_pathway();
break;
case "epw":
editar_pathway($_GET['id_pathway']);
break;
case "apin":
add_pathway_indicacion($_GET['id_indicacion']);
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
echo "window.open (a,\"farmacos1\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=400,height=350\");\n";
echo "}\n";
echo "function abrir_ventana600(a){\n";
echo "window.open (a,\"farmacos1\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=350\");\n";
echo "}\n";
echo "function aviso_borrar_tumor_indicacion(des1,des2,des3,des4){\n";
echo "if (confirm(\"¿Desea eliminar este registro?\")){\n";
echo "var destino=\"functions2.php?op=delti&id_indicacion=\" +des1+ \"&id_tejido_n1=\" + des2+ \"&id_histologia_n0=\" + des3+ \"&id_histologia_n1=\" + des4; \n";
echo "window.open (destino,\"funciones2\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_pathway_indicacion(des1,des2){\n";
echo "if (confirm(\"¿Desea eliminar este pathway?\")){\n";
echo "var destino=\"functions.php?op=delpin&id_indicacion=\" +des1+ \"&id_pathway=\" + des2; \n";
echo "window.open (destino,\"pathways1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";;

echo "//-->\n";
echo "</script>\n";  
?>