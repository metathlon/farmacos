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
/*
color: #555;
*/
}
#mainWrapper{
border:solid 1px;	
margin-top:10px;
background:#FFFFFF;
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

p#botonA21 a,p#botonA21 a:hover,p#botonA22 a,p#botonA22 a:hover,p#botonA23 a,p#botonA23 a:hover,p#botonA24 a,p#botonA24 a:hover{
margin:0 auto;
width:162px;
height:50px;
display:block;
background:url(img/sprite_botones2.png);
background-repeat:no-repeat;
}
p#botonA21 a{
background-position: 0px -2px;
}
p#botonA21 a:hover{
background-position: 0px -53px;
}
p#botonA22 a{
background-position: 0px -102px;
}
p#botonA22 a:hover{
background-position: 0px -154px;
}
p#botonA23 a{
background-position: 0px -204px;
}
p#botonA23 a:hover{
background-position: 0px -256px;
}
p#botonA24 a{
background-position: 0px -306px;
}
p#botonA24 a:hover{
background-position: 0px -357px;
}



















#nav{
clear:both;
float:left;
height:40px;
background:url(img/nav_bg_a.png) no-repeat right;
background-color:#063e5d;
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
border-radius: 0.5em;
height:20px;
}
#nav li a:hover,.activo{
background-color:rgb(49,138,188);
border:1px solid #0066CC;
}
#nav li img {
background: url(img/sprite.png) no-repeat -1px -1055px;
}
#nav2{
	clear:both;
	float:right;
	height:16px;
	background-image:url(img/bgmenu2.jpg);
	background-repeat:repeat-x;
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
color: #FFFFFF;
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
margin-left:15px;
width:930px;
/*
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
.tabAreaInferior
{
clear:both;
width:100%;
height:4px;
border: 2px solid black;
border-top-width: 0px;
background-color: #063e5d;
border-color:#06537e #063e5d #063e5d #06537e;
}
.tabOn, .tabOff
{
	float: left;
	width:170px;
	height:20px;
	border: 2px solid black;
	border-bottom-width: 0px;
	border-color: #06537e #03324c #03324c #06537e;
	text-align:center;
	cursor:pointer;
	margin-right: 10px;
	font-weight:normal;
	font-size: 14px;	
}

.tabOff, .tabOff a{
text-decoration:none;
background-color:#C4DBE6;
border-color: #CFE2EB #9AC0D3 #9AC0D3 #CFE2EB;
color: #000000;
}
.tabOn, .tabOn a {
text-decoration:none;
background-color:#063e5d;
color: #FFF;
}
.tabOff a:hover
{
color: #8e0018;
text-decoration:underline;
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
.cab_aviso{
color: #000;
font-size: 12px; 
background-color:#FF4242; 
}

.cab_fila{
color: #000;
font-weight: bold; 
}

li.aviso{
padding-left: 4px;
background-color:#FDBD84; 
/*background-color:#BBD7E3; */
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
li.par div,li.impar div,li.aviso div{
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
					<a href="paginaa.php"></a>
				</div>
				<div id="tituloB">
					<a href="paginab.php"></a>
				</div>
				<div id="tituloC">
					<a href="tumors.php"></a>
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
                <li>&nbsp;</li>
				<li>&nbsp;</li>
				<li>&nbsp;</li>
				<?
        if ($array_menu_superior){
			while (list ($v_url,$v_menu) = each ($array_menu_superior)){
					if (stristr($v_menu,"_SEL")){
					$clase_link="class=\"activo\"";	
					$v_menu=str_replace("_SEL","",$v_menu);
				 	}else{
					$clase_link="";	
					}
					 echo "<li><a ".$clase_link." href=\"".$v_url."\">".$v_menu."</a></li>\n";
			}
     	}else{
	 			echo "<li><a href=\"listar_farmacos.php\">FDA Approved Drugs</a></li>\n";
				echo "<li>&nbsp;<li>\n";
				echo "<li><a href=\"farmacos_nuevos.php\">Investigational Drugs</a></li>\n";
				echo "<li>&nbsp;<li>\n";
				echo "<li><a href=\"farmacos.php\">Combinational studies </a></li>\n";
		}
	  ?>       
                
                
                
        </ul>
		</div>
    </div>
