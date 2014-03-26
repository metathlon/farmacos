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
margin-left:15px;
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
background-position:0 -660px ;
}

</style>
<title>FARMACOS</title>
</head>
<body>
<div class="ventanas clearfix">



