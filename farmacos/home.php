<?php
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",0);
echo $cabecera->get_php_code(); 

 
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
background: url(img/bg_main.jpg) repeat-x scroll 0 0 #fff;
color: #555;
}
#mainWrapper{
border:solid 1px;	
margin-top:10px;
background:#FFFFFF
}

#logo{
	float:left;
	background-image:url(img/logo1.png);
	width:120px;
	height:68px;
	margin: 0px;

}
#logo_titulo{
	background-image:url(img/logo_titulo.png);
	width:550px;
	height:68px;
	margin:0px;
}
#tituloA a ,#tituloB a ,#tituloC a {
display:block;
background-image:url(img/sprite_menu_sup.png);
width:260px;
height:20px;
margin:2px;
}
#tituloA a{
background-position: 0px -1px;
}
#tituloA a:hover{
background-position: 0px -22px;
}
#tituloB a{
background-position: 0px -42px;
}
#tituloB a:hover{
background-position: 0px -63px;
}
#tituloC a{
background-position: 0px -84px;
}
#tituloC a:hover{
background-position: 0px -105px;
}

#linkAB{
display:block;
font-size: 16px;
font-weight:bold;
color:#000099;
text-decoration:none;
text-align:right;
width:340px;
height:33px;
margin-right:5px;
}

p#botonA11 a,p#botonA11 a:hover,p#botonA12 a,p#botonA12 a:hover,p#botonA13 a,p#botonA13 a:hover, p#botonB11 a,p#botonB11 a:hover,p#botonB12 a,p#botonB12 a:hover,p#botonB13 a,p#botonB13 a:hover,p#botonC11 a,p#botonC11 a:hover      {
margin:0 auto;
width:250px;
height:79px;
display:block;
background:url(img/sprite_botones1.png);
background-repeat:no-repeat;
}


p#botonA11{
background-position: 0px 0px;
}
p#botonA11 a:hover{
background-position: 0px -79px;
}
p#botonA12 a{
background-position: 0px -156px;
}
p#botonA12 a:hover{
background-position: 0px -235px;
}
p#botonA13 a{
background-position: 0px -312px;
}
p#botonA13 a:hover{
background-position: 0px -391px;
}
p#botonB11 a{
background-position: 0px -475px;
}
p#botonB11 a:hover{
background-position: 0px -554px;
}
p#botonB12 a{
background-position: 0px -631px;
}
p#botonB12 a:hover{
background-position: 0px -710px;
}
p#botonB13 a{
background-position: 0px -787px;
}
p#botonB13 a:hover{
background-position: 0px -866px;
}
p#botonC11 a{
background-position: 0px -950px;
}
p#botonC11 a:hover{
background-position: 0px -1030px;
}

.cuadro-menu1,.cabecera-menua,.cabecera-menub,.cabecera-menuc{
display: block;
float: left;
margin: 5px 10px;
padding: 5px 10px 5px 10px;
border-radius: 0.5em;
-webkit-border-radius: 0.5em;
-moz-border-radius: 0.5em;
-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .4);
-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .4);
font-size: 14px;
color: #5a5a5a;
height:350;
width:270;
background-color: #fdfafa ;
/*
background-color:rgb(225,116,98);
*/
}
.cabecera-menua{
background:url(img/imagen_a1.jpg) no-repeat;
height:40;
}
.cabecera-menub{
background:url(img/imagen_b1.jpg) no-repeat;
height:40;
}
.cabecera-menuc{
background:url(img/imagen_c1.jpg) no-repeat;
height:40;
}



#nav{
	clear:both;
	float:left;
	height:40px;
	/*
	background:-webkit-gradient(linear, left top, left bottom, from(rgb(6,62,93)), to(rgb(9,86,131) ));
	*/
	
	background:url(img/nav_bg_a.png) no-repeat right;
	background-color:rgb(6,62,93);
	margin:0;
	padding:0;
	width:100%;
}

#nav li  {
	float:left;
	list-style-type: none;
	margin-left:15px;
}

#nav li a{
float:left;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size: 16px;
font-weight:normal;
color: #FFFFFF;
text-decoration:none;
vertical-align: middle; 
display:block;
padding: 5px;
/*
margin-top: 1px;
margin-botton: 1px;
*/
border-radius: 0.5em;
/*
-webkit-border-radius: 0.5em;
*/
height:20px;

/*
border:1px solid;
padding:.2em 0 2em .5em;
*/
}
#nav li a:hover{
background-color:rgb(49,138,188);
/*
background: url(img/sprite.png) repeat-x 0 -1320px;
*/
border:1px solid #0066CC;
}

#nav li img {
background: url(img/sprite.png) no-repeat -1px -1055px;
}

#nav2{
	clear:both;
	float:right;
	height:16px;
	background: url(img/sprite.png) repeat-x 0 0;
	background-repeat:repeat-x;
	background-position:0px -1500px;
	margin:0;
	padding:0;
	width:100%;
    list-style-type: none;
}
#nav2 li{
float:right;
list-style-type: none;
margin-right:20px;
text-decoration:none;
}
#nav2 li a{
border:1px solid;
padding:1px;
text-decoration:none;
font-style:Tahoma, sans-serif;
font-size: 11px;
font-weight:bold;
color: #000000;
}

.navlateral{
list-style-type: none;
}
.navlateral li{
background: url(img/sprite.png) repeat-x 0 -0px;
margin:5px;
padding:2px;
border:1px solid;
border-color: #808080;
	
}
.navlateral li:hover{
background: url(img/sprite.png) repeat-x 0 -100px;
}


.navlateral li a{
padding:1px;
text-decoration:none;
font-style:Tahoma, sans-serif;
font-size: 11px;
font-weight:bold;
color: #000000; 
}

#tabBody
{
/*
margin: 0px;
background-color: #C4DBE6;*/
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
div.cabeceraseleccion{
clear: both;
background-color: #9AC0D3;
padding: 5px;
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
margin-bottom: 5px;
margin-left: 10px;
padding: 0px;
}
p.centrado{
text-align:center;
}

.oculto{
display:none;
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

<div class="container">
    <div id="mainWrapper" class="clearfix">
		<div class="span-24 last append-bottom">
			<div class="span-3"> 
			   <div id="logo"></div>
			</div>
			<div class="span-14"> 
			   <div id="logo_titulo"></div>
			</div>
			<div class="span-7 last"> 
				<div id="tituloA">
					
				</div>
				<div id="tituloB">
					
				</div>
				<div id="tituloC">
					
				</div>
		    </div>
			
            
            <div class="span-24 last">
				<ul id="nav">
						<li>
							<a href="index.php" title="Return to home page">
								<span>
									<img alt="Home" src="img/pixel.gif" width="20" height="20" onClick="window.location='index.php';">
								</span>
							 </a>
						</li>
						<li><a href="paginaa.php">Drugs</a></li>
						<li>&nbsp;<li>
						<li><a href="paginab.php">Biological Pathways</a></li>
						<li>&nbsp;<li>
						<li><a href="tumors.php">Tumors</a></li>
				</ul>
			</div>
		</div>
		
		<div class="span-24 last">
	<div class="span-12 append-6 prepend-6">
<?php		

	echo "<div class=\"recuadroizq conborde\">\n";
									
		echo "<div class=\"cabecerarecuadro clearfix\">\n";
			echo "<div class=\"titulorecuadro\">Acceso al programa de Farmacos</div>\n";
		echo "</div>\n";
		echo "<div class=\"cuerporecuadro clearfix\">\n";
				echo "<form action=\"functions_usr.php\" method=\"post\" name=\"form_login\">\n";	
					echo "<div class=\"izq\">\n";
					echo "<p class=\"leyenda\">\n";
					echo "Para acceder a esta pagina es necesario estar registrado";
					echo "</p>\n";
					echo "<p class=\"leyenda\">\n";
					echo "Si usted no esta registrado <a href=\"javascript:abrir_ventana500('ventanas_usr.php?cop=ainv')\">Pulse Aqui</a> para registrarse";
					echo "</p>\n";
					echo "<p class=\"formulario\">\n";
					echo "</p>\n";
					echo "<p class=\"formulario\">\n";
					echo "<label for \"login_usuario\" class=\"span-3\">Login</label>\n";		
					echo "<input type=\"text\" name=\"login_usuario\" value=\"$Login_Usuario\" id=\"login_usuario\" class=\"span-5\"  />\n";
					echo "</p>\n";										
					echo "<p class=\"formulario\">\n";
					echo "<label for \"password_usuario\" class=\"span-3\">Password</label>\n";		
					echo "<input type=\"password\" name=\"password_usuario\"  value=\"$Password_Usuario\" id=\"password_usuario\" class=\"span-5\"  />\n";
					echo "</p>\n";			
					
					
					echo "<p class=\"formulario\">\n";
					
					echo "</p>\n";
					echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"lu\" />\n";
					echo "<input type=\"submit\" value=\"LOGIN\" />\n"; 
					echo "</p>\n";
					echo "</div>\n";	
				echo "</form>\n";
		echo "</div>\n";
			
	echo "</div>\n";
		
?>
		
		</div>
		</div>
		<div class="span-24 last">
			<h3>Footer</h3>
		</div>
	</div>
</div>
</body>
</html>
<?
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"links1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=600\");\n";
echo "}\n";
echo "function abrir_ventana500(a){\n";
echo "window.open (a,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=500\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>


