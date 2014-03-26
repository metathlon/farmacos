<?php
//include ("inc/login.php"); 
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",10);
echo $cabecera->get_php_code();

include ("inc/config.php");
include ("inc/alg_functions.php");

function lista_farmacos_inv_commonpathway($id_pathway){
global $connect,$basedatos;
	$farmacos_fcp='';
	$query_farmacos = "select distinct farmacos_inv.id_farmaco,nombre_farmaco,id_categoria_diana,descripcion_categoria_diana, 
	autores,tx1desc,tx2desc
	from farmacos_inv_pathways,farmacos_inv,categorias_dianas 
	where 
	farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and 
	farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and 
	id_pathway='".$id_pathway."' order by categorias_dianas.id_categoria_diana";
	
	
	//$query_farmacos = "select distinct farmacos_inv.id_farmaco, substring(nombre_farmaco,1,40)from mutaciones_pathways,farmacos_inv_pathways,farmacos_inv where mutaciones_pathways.id_pathway=farmacos_inv_pathways.id_pathway and  farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and id_mutacion='".$id_mutacion."'";
	mysql_select_db($basedatos,$connect);
	$resultado = mysql_query($query_farmacos,$connect);
	if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {			
					echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						
						
						echo "<div class=\"span-5\">Drug Name</div>\n";
						echo "<div class=\"span-7\">AEs=>10%</div>\n";
						echo "<div class=\"span-8\">Grade=>3</div>\n";
						echo "<div class=\"span-1\">Compare</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				$grp_diana_anterior='0';
				while(list($id_farmaco,$nombre_farmaco,$id_cd,$descripcion_cd,$autores,$tx1desc,$tx2desc)= mysql_fetch_row($resultado)){
					if ($descripcion_cd != " MENU OCULTO RECLUTING")
					{
						$farmacos_fcp=$farmacos_fcp.$id_farmaco."x";
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							if ($grp_diana_anterior==$id_cd){
		  					echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-5\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-7\">$tx1desc</div>\n";
								echo "<div class=\"span-8\">$tx2desc</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\"  href=\"farmacos.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0 \"></a></div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						//echo "<option value=\"$id_f\">$nombre_f</option>\n";
							}else{
									echo "<li class=\"cabecera cab_turquesa\">\n"; 
										echo "<div class=\"span-20\">$descripcion_cd</div>\n";
										echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\"  href=\"farmacos.php?id_farmaco1=0&id_farmaco2=".$id_cd."&pmtr1=1&pmtr2=0 \"></a></div>\n";
										echo "<div class=\"span-0 last\">&nbsp;</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
								echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-5 clearfix\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-7\">$tx1desc</div>\n";
								echo "<div class=\"span-8\">$tx2desc</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\"  href=\"farmacos.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0 \"></a></div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
					         }
							 
					
						$grp_diana_anterior=$id_cd;
						$a = ($dcolor == $dcolor_A ? 1 : 0);
					}
				}
	echo "</ul>\n";	
	
	
	}		//del if resultado de farmacos con common target
	}  // del if numero de farmacos commun target		
//echo "<input type=\"hidden\" name=\"farmacos_fcp\" id=\"farmacos_fcp\" value=\"$farmacos_fcp\" />\n";

}

function lista_farmacos_fda_commonpathway($id_pathway){
global $basedatos,$connect;	

				$query_farmacos = "select distinct farmacos.id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco 
				from farmacos,farmacos_indicaciones,indicacion_pathways
				where farmacos.id_farmaco=farmacos_indicaciones.id_farmaco and 
				farmacos_indicaciones.id_indicacion=indicacion_pathways.id_indicacion and 
				id_pathway='".$id_pathway."' order by nombre_farmaco";	
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_farmacos,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-7\">Drug Name</div>\n";
						echo "<div class=\"span-6\">More Information</div>\n";
						echo "<div class=\"span-7\">Clasification Advers Reaction in Clinical Trials</div>\n";
						echo "<div class=\"span-1\">&nbsp;</div>\n";
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
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\"  href=\"farmacos.php?id_farmaco1=".$id_farmaco."&id_farmaco2=0&pmtr1=0&pmtr2=0 \"></a></div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
					echo "</ul>\n";	 				

}

function lista_mutaciones_pathway($id_pathway){
global $basedatos,$connect;	
$query_mutaciones="select distinct mutaciones.id_mutacion,nombre_gen,GeneId,celular_process,sinonimos_gen from mutaciones_pathways,mutaciones where
mutaciones_pathways.id_mutacion=mutaciones.id_mutacion and 
id_pathway='".$id_pathway."'";
			
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_mutaciones,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"span-4\">Gen Name</div>\n";
						echo "<div class=\"span-4\">Process</div>\n";
						echo "<div class=\"span-12\">Synonimus</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				
				if ($resultado){
				$numero_mutaciones=mysql_num_rows($resultado);
				    if($numero_mutaciones == 0) {
				    } else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_mutacion,$nombre_gen,$GeneId,$celular_process,$sinonimos_gen)= mysql_fetch_row($resultado)){
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								if ($GeneId==0){
								echo "<div class=\"span-0\">&nbsp;</div>\n";
								}else{
								echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('http://www.ncbi.nlm.nih.gov/gene/".$GeneId."')\"></a></div>\n";
								}
								
								echo "<div class=\"span-4\">$nombre_gen</div>\n";
								echo "<div class=\"span-4\">$celular_process</div>\n";
								echo "<div class=\"span-12\">$sinonimos_gen</div>\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info2.php?cop=vm&id_mutacion=".$id_mutacion."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
					echo "</ul>\n";	 

}

function lista_tumores_pathway($id_pathway){
global $basedatos,$connect;	
$query_indicaciones="select distinct indicaciones.id_indicacion,descripcion_indicacion 
from indicacion_pathways,indicaciones where 
indicacion_pathways.id_indicacion=indicaciones.id_indicacion and 
id_pathway='".$id_pathway."'";
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_indicaciones,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-21\">Tumor Type</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				
				if ($resultado){
				$numero_indicaciones=mysql_num_rows($resultado);
				    if($numero_indicaciones == 0) {
				    } else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_indicacion,$descripcion_indicacion)= mysql_fetch_row($resultado)){
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-21\">$descripcion_indicacion</div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info3.php?cop=vtt&id_indicacion=".$id_indicacion."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
					echo "</ul>\n";	 

}

function numero_mutaciones_pathway($id_pathway){
global $basedatos,$connect;	
$query_mutaciones="select id_mutacion from mutaciones_pathways where
id_pathway='".$id_pathway."'";
			
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_mutaciones,$connect);
				if ($resultado){
				$numero_mutaciones=mysql_num_rows($resultado);
				return $numero_mutaciones;
				}else{
				return 0;
				}

}

function listar_pathways($tf,$vf,$pag){
global $connect,$basedatos;
$array_menu_superior=array("mutaciones.php"=>"Gene Mutations","pathways.php"=>"Oncogenic Pathways_SEL","custom_pathways.php"=>"Custom Pathways");
include ("inc/headerB.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
			echo "<form  name=\"form_pahwayss\">\n";
			if ($tf==1){
			$query_pathways = "select id_pathway,id_external,nombre_pathway from pathways 
			where nombre_pathway like '%".$vf."%'
			order by nombre_pathway";	
			}else{
			$query_pathways = "select id_pathway,id_external,nombre_pathway from pathways order by nombre_pathway";	
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
				echo "<div class=\"titulorecuadro\"> PATHWAYS OBTEINED FROM GENE MUTATION DATA </div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				//echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=apw')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"span-2\">ID EXTERNAL</div>\n";
						echo "<div class=\"span-18\">Pathway Name</div>\n";
						echo "<div class=\"span-1\">Num</div>\n";
						echo "<div class=\"span-0\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
								
				$resultado_pathways = mysql_query($query_pathways,$connect);
				if ($resultado_pathways){
				$numero_pathways=mysql_num_rows($resultado_pathways);
				    if($numero_pathways == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					while(list($id_pathway,$id_external,$nombre_pathway)= mysql_fetch_row($resultado_pathways)){
							
							if ($id_external)
							{
							$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;
							$numero_mutaciones=numero_mutaciones_pathway($id_pathway);
							$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$link_pathway."')\"></a></div>\n";
								echo "<div class=\"span-2\">$id_external</div>\n";
								echo "<div class=\"span-18\">$nombre_pathway</div>\n";
								echo "<div class=\"span-1\">$numero_mutaciones</div>\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\" href=\"pathways.php?cop=vpw&id_pathway=".$id_pathway."\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
							$a = ($dcolor == $dcolor_A ? 1 : 0);
							}
							
						}
					}		
				}
					 
				echo "</ul>\n";	
				
				//fin de categorias
				
			echo "</div>\n";	
		echo "</div>\n";
	echo "</form>\n";
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}


function ver_pathway($id_pathway){
global $connect,$basedatos;
$query_d= "select nombre_pathway from pathways where id_pathway='".$id_pathway."'" ;
$lista_d = mysql_query($query_d,$connect);
$array_menu_superior=array("mutaciones.php"=>"Gene Mutations","pathways.php"=>"Oncogenic Pathways_SEL","custom_pathways.php"=>"Custom Pathways");
include ("inc/headerB.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-23 last\">\n";
			if ($lista_d){
				$numero_d=mysql_num_rows($lista_d);
					if($numero_d == 0) {
					} else {
					list($nombre_pathway)= mysql_fetch_row($lista_d);	
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Pathway: ".$nombre_pathway."</div>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
					
					echo "<div class=\"span-23 last\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Investigational Drugs acting on this Pathway</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
												lista_farmacos_inv_commonpathway($id_pathway);
							echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
					
					/*
					 * --- CONTROL DE ACCESO
					*/
					if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	
					{
						echo "<div class=\"span-23 last\">\n";
							echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">FDA Approved Drugs against tumours affected by this Pathway</div>\n";
								echo "</div>\n";
								echo "<div class=\"cuerporecuadro clearfix\">\n";
									lista_farmacos_fda_commonpathway($id_pathway);
								echo "</div>\n";
							echo "</div>\n";
						echo "</div>\n";
					}
					
					
					echo "<div class=\"span-23 last\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Gene Mutations</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								lista_mutaciones_pathway($id_pathway);
							echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
					echo "<div class=\"span-23 last\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">Tumor Type</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								lista_tumores_pathway($id_pathway);
							echo "</div>\n";
							echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
				
				
				
				
				echo "</div>\n";
		             }
				}	 
		echo "</div>\n";
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}









if (!isset($_GET['cop'])){
$cop="lfn";	
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
listar_pathways($tf,$vf,$pag);  
break;

case "lpw":
listar_pathways($tf,$vf,$pag);
break;
case "vpw":
ver_pathway($_GET['id_pathway']);
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
echo "function aviso_borrar_toxicidad(des1,des2){\n";
echo "if (confirm(\"�Desea eliminar esta toxicidad?\")){\n";
echo "var destino=\"functions2.php?op=deltcd&id_categoria_diana=\" +des1+ \"&id_toxicidad=\" + des2; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function buscar_texto(){\n";
echo "var texto_busqueda=document.getElementById('search_text').value;\n";
echo "window.location='pathways.php?cop=lpw&tf=1&vf=' + texto_busqueda + '&pag=0';\n";
echo "}\n";

echo "//-->\n";
echo "</script>\n";  
?>