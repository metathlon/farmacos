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
.bdate{
background-position:0 -200px ;
}

</style>
<title>FARMACOS</title>
</head>
<body>
<div class="ventanas clearfix">
<?php
function add_user(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions_usr.php\" method=\"post\" name=\"form_apw\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Add User</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"login_usuario\" class=\"span-3\">Login</label>\n";		
					echo "<input type=\"text\" name=\"login_usuario\" id=\"login_usuario\" class=\"span-5\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"formulario\">\n";
					echo "<label for \"password_usuario\" class=\"span-3\">Password</label>\n";		
					echo "<input type=\"password\" name=\"password_usuario\" id=\"password_usuario\" class=\"span-5\"  />\n";
				echo "</p>\n";			
				echo "<p class=\"formulario\">\n";
					echo "<label for \"nivel_usuario\" class=\"span-3\">Nivel</label>\n";		
					echo "<input type=\"text\" name=\"nivel_usuario\" value=\"1\" id=\"nivel_usuario\" class=\"span-2\"  />\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"mail_usuario\" class=\"span-3\">Mail</label>\n";		
					echo "<input type=\"text\" name=\"mail_usuario\" id=\"mail_usuario\" class=\"span-5\"  />\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"Nombre_completo\" class=\"span-3\">Name</label>\n";		
					echo "<input type=\"text\" name=\"Nombre_completo\" id=\"Nombre_completo\" class=\"span-8\"  />\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"Empresa\" class=\"span-3\">Company</label>\n";		
					echo "<input type=\"text\" name=\"Empresa\" id=\"Empresa\" class=\"span-6\"  />\n";
				echo "</p>\n";
				
				echo "<p class=\"formulario\">\n";
				echo "</p>\n";
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"auf\" />\n";
					echo "<input type=\"submit\" value=\"Add User\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function editar_user($id_usuario){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_u="select Login_Usuario,Password_Usuario,Nivel,Mail_usuario,Nombre_completo,Empresa,DATE_FORMAT(Fecha_alta,'%d-%m-%Y'),DATE_FORMAT(Fecha_ultimo_login,'%d-%m-%Y'),Activo from user_farmacos where IdUsuario='".$id_usuario."'" ;
$lista_u = mysql_query($query_u, $connect);
if ($lista_u){
	$numero_u=mysql_num_rows($lista_u);
	if($numero_u == 0) {
	} else {
	list($Login_Usuario,$Password_Usuario,$Nivel,$Mail_usuario,$Nombre_completo,$Empresa,$Fecha_alta,$Fecha_ultimo_login,$Activo)= mysql_fetch_row($lista_u);						
echo "<div class=\"span-14 last\">\n";
	echo "<form action=\"functions_usr.php\" method=\"post\" name=\"form_euf\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Edit User</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"login_usuario\" class=\"span-4\">Login</label>\n";		
					echo "<input type=\"text\" name=\"login_usuario\" value=\"$Login_Usuario\" id=\"login_usuario\" class=\"span-5\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"formulario\">\n";
					echo "<label for \"radio_cambiar\" class=\"span-4\">Cambiar Password</label>\n";		
					echo " <input type=\"radio\" name=\"radio_cambiar\" value=\"1\">Si\n";
   					echo " <input type=\"radio\" name=\"radio_cambiar\" value=\"0\" checked >No\n";
				echo "</p>\n";	
				echo "<p class=\"formulario\">\n";
					echo "<label for \"password_usuario\" class=\"span-4\">Password</label>\n";		
					echo "<input type=\"password\" name=\"password_usuario\"  value=\"$Password_Usuario\" id=\"password_usuario\" class=\"span-5\"  />\n";
				echo "</p>\n";			
				echo "<p class=\"formulario\">\n";
					echo "<label for \"nivel_usuario\" class=\"span-4\">Nivel</label>\n";		
					echo "<input type=\"text\" name=\"nivel_usuario\" value=\"$Nivel\" id=\"nivel_usuario\" class=\"span-2\"  />\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"mail_usuario\" class=\"span-4\">Mail</label>\n";		
					echo "<input type=\"text\" name=\"mail_usuario\" value=\"$Mail_usuario\" id=\"mail_usuario\" class=\"span-5\"  />\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"Nombre_completo\" class=\"span-4\">Name</label>\n";		
					echo "<input type=\"text\" name=\"Nombre_completo\" value=\"$Nombre_completo\" id=\"Nombre_completo\" class=\"span-8\"  />\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"Empresa\" class=\"span-4\">Company</label>\n";		
					echo "<input type=\"text\" name=\"Empresa\" value=\"$Empresa\" id=\"Empresa\" class=\"span-6\"  />\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"Fecha_alta\" class=\"span-4\">Fecha de Alta</label>\n";		
					echo "<input type=\"text\" readonly=\"true\" name=\"Fecha_alta\" value=\"$Fecha_alta\" id=\"Fecha_alta\" class=\"span-3\" />\n";
					echo "<a class=\"blineatabla bdate\" href=\"javascript:show_calendar('form_euf.Fecha_alta')\"></a>\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"Fecha_ultimo_login\" class=\"span-4\">Fecha Ultimo Login</label>\n";		
					echo "<input type=\"text\"  readonly=\"true\" name=\"Fecha_ultimo_login\" value=\"$Fecha_ultimo_login\" id=\"Fecha_ultimo_login\" class=\"span-3\"  />\n";
					echo "<a class=\"blineatabla bdate\" href=\"javascript:show_calendar('form_euf.Fecha_ultimo_login')\"></a>\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"radio_activo\" class=\"span-4\">Activo</label>\n";		
					if ($Activo==1){
						echo " <input type=\"radio\" name=\"radio_activo\" value=\"1\" checked >Si\n";
   						echo " <input type=\"radio\" name=\"radio_activo\" value=\"0\" >No\n";
					}else{
						echo " <input type=\"radio\" name=\"radio_activo\" value=\"1\">Si\n";
   						echo " <input type=\"radio\" name=\"radio_activo\" value=\"0\" checked >No\n";
					}
				echo "</p>\n";	
				
				
				
				echo "<p class=\"formulario\">\n";
				echo "</p>\n";
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"euf\" />\n";
					echo "<input type=\"hidden\" name=\"id_usuario\" id=\"id_usuario\" value=\"$id_usuario\" />\n";
					echo "<input type=\"submit\" value=\"Update User\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";





	}
	}
include ("inc/footer_ventana.php");
}

function add_invitado(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
echo "<div class=\"span-12 last\">\n";
	echo "<form action=\"functions_usr.php\" method=\"post\" name=\"form_ainv\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Add User</p>\n";
                echo "</div>\n";
                echo "<div class=\"izq\">\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"login_usuario\" class=\"span-3\">Login</label>\n";		
					echo "<input type=\"text\" name=\"login_usuario\" id=\"login_usuario\" class=\"span-5\"  />\n";
				echo "</p>\n";									
				echo "<p class=\"formulario\">\n";
					echo "<label for \"mail_usuario\" class=\"span-3\">Mail</label>\n";		
					echo "<input type=\"text\" name=\"mail_usuario\" id=\"mail_usuario\" class=\"span-5\"  />\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"Nombre_completo\" class=\"span-3\">Name</label>\n";		
					echo "<input type=\"text\" name=\"Nombre_completo\" id=\"Nombre_completo\" class=\"span-8\"  />\n";
				echo "</p>\n";
				echo "<p class=\"formulario\">\n";
					echo "<label for \"Empresa\" class=\"span-3\">Company</label>\n";		
					echo "<input type=\"text\" name=\"Empresa\" id=\"Empresa\" class=\"span-6\"  />\n";
				echo "</p>\n";
				
				echo "<p class=\"formulario\">\n";
				echo "</p>\n";
				echo "<p class=\"centrado\">\n";
					echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"ainv\" />\n";
					echo "<input type=\"submit\" value=\"Submit\" />\n"; 
				echo "</p>\n";
                echo "</div>\n";	
	echo "</form>\n";
echo "</div>\n";
include ("inc/footer_ventana.php");
}

function inserta_registro(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
//funcion para generar password
	$password_usuario=1234
//insertar registro en base de datos	
	
	$login_usuario=filtrar_texto($_POST['login_usuario']);
	$mail_usuario=filtrar_texto($_POST['mail_usuario']);
	$Empresa=filtrar_texto($_POST['Empresa']);
	$Nombre_completo=filtrar_texto($_POST['Nombre_completo']);
	$query_auf= "insert into user_farmacos(Login_Usuario,Password_Usuario,Nivel,Mail_usuario,Nombre_completo,Empresa,Fecha_alta,Fecha_ultimo_login,Activo) 
	values ('".$login_usuario."',password('".$password_usuario."'),'1','".$mail_usuario."','".$Nombre_completo."','".$Empresa."',date(now()),date(now()),1)";
	//echo $query_auf;
	$result1 = mysql_query($query_auf, $connect);
//enviar correo a usuario con password o enviarla en foemulario	 
	 echo "<div class=\"span-12 last\">\n";
		echo "<div class=\"cabecera1\">\n";
                echo "<p class=\"leyenda\">Usuario registrado</p>\n";
         echo "</div>\n";
         echo "<div class=\"izq\">\n";
			
			echo "<p class=\"formulario\">\n";	
	       	 echo "<p class=\"leyenda\">";
			echo "En breve recibira un correo con el password login etc etc etc";
			echo "</p>\n";		
			echo "</p>\n";									
		echo "</div>\n";	

echo "</div>\n";
include ("inc/footer_ventana.php");
	 

}

if (!isset($_GET['cop'])){
$cop="nada";	
}else{
$cop=$_GET['cop'];
}
	
switch($cop) {
default:  
break;
case "auf":
add_user();
break;
case "ainv":
add_invitado();
break;

case "euf":
editar_user($_GET['id_user']);
break;
}
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana400(a){\n";
echo "window.open (a,\"farmacos1\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=400,height=350\");\n";
echo "}\n";
echo "function abrir_ventana600(a){\n";
echo "window.open (a,\"farmacos1\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=350\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>