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


#cuadro-menuh,#cabecera-menubh{
display: block;
float: left;
margin: 5px 10px;
padding: 5px 10px 5px 10px;
border:solid 1px;
border-radius: 0.5em;
color: #5a5a5a;
height:90px;
width:890px;
background-color:fdfafa;
}
#cabecera-menubh{
background:url(img/imagen_b1.jpg) no-repeat right;
background-color:#a0351d;
height:40;
}

p#botonB11 a,p#botonB11 a:hover,p#botonB12 a,p#botonB12 a:hover,p#botonB13 a,p#botonB13 a:hover{
margin:0 auto;
width:250px;
height:79px;
display:block;
background:url(img/sprite_botones1.png);
background-repeat:no-repeat;
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



#nav{
	clear:both;
	float:left;
	height:40px;
	background:url(img/nav_bg_b.png) no-repeat right;
	background-color:#a0351d;
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
text-decoration:none;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size: 16px;
font-weight:normal;
color: #FFFFFF;
display:block;
vertical-align: middle; 
padding: 5px;
/*
margin-top: 2px;
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
#nav li a:hover,.activo {
background-color:#ff9966;
/*
background: url(img/sprite.png) repeat-x 0 -1320px;
*/
border:1px solid #b14b38;
}

#nav li img {
background: url(img/sprite.png) no-repeat -1px -1055px;
}
#nav2{
	clear:both;
	float:right;
	height:16px;
	background:url(img/sprite.png);
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
padding:1px;
text-decoration:none;
font-style:Tahoma, sans-serif;
font-size: 12px;
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
background-color: #ef907f;
/*
background-color:#2BDDD9; 
*/
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
background-color:#fdd7d0; 

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
/*
background-color: #9AC0D3;
*/
background-color: #ef907f;
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
.bsearch{
background-position:0 -990px ;
margin: 4px 4px 4px 0;
}
.bpdf{
background-position:0 -1848px ;
}
.bcomp{
background-position:0 -662px ;
}
</style>
<title>Biological Pathways</title>
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
				<li>&nbsp;&nbsp;<li>
				<li>&nbsp;&nbsp;<li>
				<li>&nbsp;&nbsp;<li>
                <?
        if (!isset($array_menu_superior)){
		echo "<li><a href=\"mutaciones.php\">Gene Mutations</a></li>\n";
		echo "<li>&nbsp;<li>\n";
		echo "<li><a href=\"pathways.php\">Oncogenic Pathways</a></li>\n";
		echo "<li>&nbsp;<li>\n";
		echo "<li><a href=\"custom_pathways.php\">Custom Pathways</a></li>\n";
		}else{
			while (list ($v_url,$v_menu) = each ($array_menu_superior)){
					if (stristr($v_menu,"_SEL")){
					$clase_link="class=\"activo\"";	
					$v_menu=str_replace("_SEL","",$v_menu);
				 	}else{
					$clase_link="";	
					}
					echo "<li><a ".$clase_link." href=\"".$v_url."\">".$v_menu."</a></li>\n";
			}		
		}
	  ?>        
                
                
               
       			</ul>
		</div>
		<div class="span-24 last">
			<ul id="nav2">
				<li></li>
				<li></li>
            
            <?php
            /*
             * --- CONTROL DE ACCESO
            */
            
            if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL']) echo "<li><a href='categorias.php?cop=lpw'>Administrar Tablas</a></li>";
            
            ?>
            </ul>
		</div>

   
    </div>



