<?
include ("inc/login.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<style media="screen">

#blobs {
	width: 960px;
	height: 720px;
	margin: 10px auto;
	padding: 0;
	position: relative;
	background-image: url(img/fondo_inicio5.jpg);
}
#blobs li {margin: 0; padding: 0; list-style: none; display: block; position: absolute;}

#blobs a {display: block;
}

#blob1 {
	left: 126px;
	top: 253px;
	width: 300px;
	height: 300px;
}
#blob2 {
	left: 96px;
	top: 512px;
	width: 152px;
	height: 155px;

}
#blob3 {
	left: 232px;
	top: 561px;
	width: 150px;
	height: 151px;
}
#blob4 {
	left: 369px;
	top: 515px;
	width: 155px;
	height: 155px;
}
#blob5 {
	left: 328px;
	top: 90px;
	width: 300px;
	height: 298px;
}
#blob6 {
	left: 11px;
	top: 30px;
	width: 155px;
	height: 155px;
}
#blob7 {
	left: 149px;
	top: 88px;
	width: 155px;
	height: 155px;
}

#blob8 {
	left: 258px;
	top: 1px;
	width: 155px;
	height: 155px;
}
#blob9 {
	left: 522px;
	top: 252px;
	width: 300px;
	height: 298px;
}
#blob10 {
	left: 739px;
	top: 483px;
	width: 155px;
	height: 155px;
}
#blob11 {
	left: 696px;
	top: 26px;
	width: 241px;
	height: 225px;
}

#blob1 a{
height: 300px;
}
#blob2 a {
height: 155px;
}
#blob3 a {
height: 151px;
}
#blob4 a {
height: 155px;
}
#blob5 a {
height: 298px;
}
#blob6 a {
height: 155px;
}
#blob7 a {
height: 155px;
}

#blob8 a {
height: 155px;
}
#blob9 a {
height: 298px;
}
#blob10 a {
height: 155px;
}
#blob11 a {
height: 225px;
}


/*
#blob4 a {height: 155px;}
#blob5 a {height: 298px;}

#blob1 a:hover {
	background-image: url(img/blue_ball.png);
	background-repeat: no-repeat;
		
}
#blob2 a:hover {
	background-image: url(img/blue_ball.png);
	background-repeat: no-repeat;	
}

#blob3 a:hover {background: url(blobs.gif) -160px -300px no-repeat;}
#blob4 a:hover {
	background-image: url(img/blue_ball.png);
	background-repeat: no-repeat;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-style: normal;
	font-weight: bold;
	color: #FFFFFF;
	text-decoration: none;
}
#blob5 a:hover {background: url(blobs.gif) -110px -402px no-repeat;}
*/
 
 </style>








</head>

<body>
<ul id="blobs">
<li id="blob1"><a href="paginaa.php"></a></li>
<li id="blob2"><a href="listar_farmacos.php"></a></li>
<li id="blob3"><a href="farmacos_nuevos.php"></a></li>
<li id="blob4"><a href="farmacos.php"></a></li>
<li id="blob5"><a href="paginab.php"></a></li>
<li id="blob6"><a href="mutaciones.php"></a></li>
<li id="blob7"><a href="pathways.php"></a></li>
<li id="blob8"><a href="custom_pathways.php"></a></li>
<li id="blob9"><a href="tumors.php"></a></li>
<li id="blob10"><a href="tumors.php"></a></li>
<li id="blob11"><a href="javascript:abrir_ventana('aophelp.php')"></a></li>
</ul>

</body>
</html>
<?
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"links1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=600\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>