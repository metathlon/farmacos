<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");

function listar_farmacos($tf,$vf,$pag){
global $connect,$basedatos;
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs_SEL","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies");
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<form  name=\"form_farmacos\">\n";
			if ($tf==1){
				$query_farmacos = "select id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco from farmacos where nombre_farmaco like '%".$vf."%' order by nombre_farmaco";	
				}else{
				$query_farmacos = "select id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco from farmacos where nombre_farmaco  order by nombre_farmaco";	
				$vf='';
				}
			
			echo "<div class=\"span-7 prepend-16 last\">\n";
				echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Search</div>\n";
								echo "<div class=\"titulorecuadro\"><input type=\"text\" name=\"search_text\" id=\"search_text\" value=\"$vf\" class=\"span-4\" /></div>\n";
								echo "<a class=\"blineatabla bsearch\" href=\"javascript:buscar_texto()\"></a>\n";
						echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
			echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">FDA Approved Drugs</div>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				
				
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_farmacos,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-7\">Drug Name</div>\n";
						echo "<div class=\"span-6\">More Information</div>\n";
						echo "<div class=\"span-7\">Clasification Advers Reaction in Clinical Trials</div>\n";
						echo "<div class=\"span-1\">&nbsp;</div>\n";
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				
				if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
				    if($numero_farmacos == 0) {
				    } else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_farmaco,$nombre_farmaco,$observaciones_farmaco,$clasificacion_toxicidad_farmaco)= mysql_fetch_row($resultado)){
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-7\">$nombre_farmaco</div>\n";
								echo "<div class=\"span-6\">$observaciones_farmaco</div>\n";
								echo "<div class=\"span-7\">$clasificacion_toxicidad_farmaco</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_farmaco_fda('".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"listar_farmacos.php?cop=ef&id_farmaco=".$id_farmaco."\"></a></div>\n";
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
include ("inc/footer_horizontal.php");
}


if (!isset($_GET['cop'])){
$cop="lf";	
}else{
$cop=$_GET['cop'];
}
if (!isset($_GET['tf'])){
$tf=0;
$vf=0;
$pag=0;
}else{
$tf=$_GET['tf'];
$vf=$_GET['vf'];
$pag=$_GET['pag'];
}

switch($cop) {
default:
listar_farmacos($tf,$vf,$pag);		   
break;
case "lf":
listar_farmacos($tf,$vf,$pag);
break;
}





/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
*/
echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"links1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=600\");\n";
echo "}\n";
echo "function abrir_ventana500(a){\n";
echo "window.open (a,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=500,height=400\");\n";
echo "}\n";
echo "function aviso_borrar_farmaco_fda(des1){\n";
echo "if (confirm(\"¿Desea eliminar este farmaco?\")){\n";
echo "var destino=\"functions.php?op=delffda&id_farmaco=\" +des1; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function buscar_texto(){\n";
echo "var texto_busqueda=document.getElementById('search_text').value;\n";
echo "window.location='buscar_fda.php?cop=lm&tf=1&vf=' + texto_busqueda + '&pag=0';\n";
echo "}\n";

echo "//-->\n";
echo "</script>\n";  
?>