<?php
//include ("inc/login.php"); 
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",10);
echo $cabecera->get_php_code();


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


function add_pathway_comparacion(){
global $connect,$basedatos;
echo "<div class=\"span-17 last\">\n";
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
						echo "<div class=\"span-2\">ID</div>\n";
						echo "<div class=\"span-13\">PATHWAY</div>\n";
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
							if ($id_external) {
						
						$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana600('".$link_pathway."')\"></a></div>\n";
								echo "<div class=\"span-2\">$id_external</div>\n";
								echo "<div id=\"cpath_".$id_pathway."\" class=\"span-13\">$nombre_pathway</div>\n";
								//echo "<div class=\"span-0 last\"><a class=\"blineatabla badd2\"  href=\"javascript:mostrar_farmacos_pathway('1')\"></a></div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla badd2\"  href=\"javascript:cargar_farmacos_pathway('".$id_pathway."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
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

if (!isset($_GET['cop'])){
$cop="lf";	
}else{
$cop=$_GET['cop'];
}
	
switch($cop) {
default:  
break;
case "apc":

break;
//farmacos nuevos

case "apwc":
add_pathway_comparacion();
break;
}

/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
*/
echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana600(a){\n";
echo "window.open (a,\"ventanas_mut\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=450\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>