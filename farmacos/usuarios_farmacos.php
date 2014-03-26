<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");

function pinta_menu_lateral($id){

echo "<ul class=\"navlateral\">\n";
echo "<li><a href=\"categorias.php?cop=lt\">Toxicidades</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=lct\">Categorias Toxicidad</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=ld\">Dianas</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=ldn0\">Categorias Dianas</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=lcd2\">Familias Farmaco</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=ltt\">Tumor Type</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=lpw\">Pathways</a></li>\n"; 
echo "<li><a href=\"usuarios_farmacos.php?cop=luf\">Usuarios</a></li>\n"; 
echo "</ul>\n"; 
}

function listar_usuarios(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-6\">\n";
		pinta_menu_lateral(1);
		echo "</div>\n";	
		echo "<div class=\"span-17 last\">\n";
	
		echo "<form  name=\"form_ld\">\n";
			echo "<div class=\"span-17 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado usuarios</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_usr.php?cop=auf')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-4\">Usuario</div>\n";
						echo "<div class=\"span-2\">Nivel</div>\n";
						echo "<div class=\"span-3\">Fecha Alta</div>\n";
						echo "<div class=\"span-3\">Ultimo Acceso</div>\n";
						echo "<div class=\"span-2\">Activo</div>\n";
						echo "<div class=\"span-1\"></div>\n";
						echo "<div class=\"span-1\"></div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				$query_usr = "select IdUsuario,Login_Usuario,Password_Usuario,Nivel,Mail_usuario,Nombre_completo,Empresa,DATE_FORMAT(Fecha_alta,'%d-%m-%Y'),DATE_FORMAT(Fecha_ultimo_login,'%d-%m-%Y'),Activo from user_farmacos order by Login_Usuario";
				$resultado_usr = mysql_query($query_usr,$connect);
				if ($resultado_usr){
					$numero_usr=mysql_num_rows($resultado_usr);
					if($numero_usr == 0) {
					} else {
							
							
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
							while(list($IdUsuario,$Login_Usuario,$Password_Usuario,$Nivel,$Mail_usuario,$Nombre_completo,$Empresa,$Fecha_alta,$Fecha_ultimo_login,$Activo)= mysql_fetch_row($resultado_usr)){
								$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
								echo "<li class=\"$dcolor\">\n";
									echo "<div class=\"span-4\">$Login_Usuario</div>\n";
									echo "<div class=\"span-2\">$Nivel</div>\n";
									echo "<div class=\"span-3\">$Fecha_alta</div>\n";
									echo "<div class=\"span-3\">$Fecha_ultimo_login</div>\n";
									echo "<div class=\"span-2\">$Activo</div>\n";
									echo "<div class=\"span-1\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_usuario($IdUsuario)\"></a></div>\n";
									echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_usr.php?cop=euf&id_user=".$IdUsuario."')\"></a></div>\n";
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
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}

if (!isset($_GET['cop'])){
$cop="luf";	
}else{
$cop=$_GET['cop'];
}
	
switch($cop) {
default:
listar_usuarios();	   
break;
case "luf":
listar_usuarios();
break;

}

echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"links1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=600\");\n";
echo "}\n";
echo "function abrir_ventana500(a){\n";
echo "window.open (a,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=500\");\n";
echo "}\n";
echo "function aviso_borrar_usuario(des1){\n";
echo "if (confirm(\"¿Desea eliminar este_usuario?\")){\n";
echo "var destino=\"functions_usr.php?op=deluf&id_usuario=\" +des1; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>