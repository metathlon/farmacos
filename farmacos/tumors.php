<?php

//include ("inc/login.php"); 
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",10);
echo $cabecera->get_php_code();

include("inc/config.php");
include("inc/alg_functions.php");


function lista_farmacos_fda($id_indicacion){
global $basedatos,$connect;	

				$query_farmacos = "select farmacos.id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco from farmacos,farmacos_indicaciones
				 where farmacos.id_farmaco=farmacos_indicaciones.id_farmaco and id_indicacion='".$id_indicacion."' order by nombre_farmaco";	
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

function lista_tumores_indicacion($id_indicacion){
global $basedatos,$connect;	

$query_tumores= "select tejidos_n0.id_tejido_n0,tejidos_n0.nombre_tejido_n0,tejidos_n1.id_tejido_n1,nombre_tejido_n1,
histologia_n0.id_histologia_n0,nombre_histologia_n0,
histologia_n1.id_histologia_n1,nombre_histologia_n1
from indicacion_tumores,tejidos_n1,tejidos_n0,histologia_n0,histologia_n1 
where indicacion_tumores.id_tejido_n1=tejidos_n1.id_tejido_n1 and tejidos_n1.id_tejido_n0=tejidos_n0.id_tejido_n0 and indicacion_tumores.id_histologia_n0=histologia_n0.id_histologia_n0 and indicacion_tumores.id_histologia_n1=histologia_n1.id_histologia_n1 and id_indicacion='".$id_indicacion."'";
$lista_tumores = mysql_query($query_tumores, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-5\">Tissue</div>\n";
		echo "<div class=\"span-5\">SubTissue</div>\n";
		echo "<div class=\"span-5\">Histology</div>\n";
		echo "<div class=\"span-5\">SubHistology</div>\n";
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";

if ($lista_tumores){
	$numero_tumores=mysql_num_rows($lista_tumores);
		if($numero_tumores== 0) {
		} else {
			$a = 0;
			$dcolor_A = "impar";
			$dcolor_B = "par"; 
			
			while(list($id_tejido_n0,$nombre_tejido_n0,$id_tejido_n1,$nombre_tejido_n1,$id_histologia_n0,
			$nombre_histologia_n0,$id_histologia_n1,$nombre_histologia_n1)= mysql_fetch_row($lista_tumores)){
			$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			     		echo "<li class=\"$dcolor\">\n";
						echo "<div class=\"span-5\">$nombre_tejido_n0</div>\n";
						echo "<div class=\"span-5\">$nombre_tejido_n1</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n0</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n1</div>\n";
						echo "<div class=\"clear\"></div>\n";
						echo "</li>\n";
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";

}

function lista_mutaciones_indicacion($id_indicacion){
global $basedatos,$connect;	

$query_mutaciones="select distinct mutaciones.id_mutacion,nombre_gen,GeneId,celular_process,sinonimos_gen from mutaciones,mutaciones_tumores,indicacion_tumores where
mutaciones.id_mutacion=mutaciones_tumores.id_mutacion and 
mutaciones_tumores.id_tejido_n1=indicacion_tumores.id_tejido_n1 and
mutaciones_tumores.id_histologia_n0=indicacion_tumores.id_histologia_n0 and
mutaciones_tumores.id_histologia_n1=indicacion_tumores.id_histologia_n1 and
indicacion_tumores.id_indicacion='".$id_indicacion."'";

/*
$query_mutaciones = "select id_mutacion,nombre_gen,GeneId,descripcion_tipo_mutacion,sinonimos_gen,protein_family from mutaciones,categorias_mutaciones where mutaciones.tipo_mutacion=categorias_mutaciones.id_tipo_mutacion order by nombre_gen";	
*/				
				
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_mutaciones,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"span-4\">Gen Name</div>\n";
						echo "<div class=\"span-4\">Process</div>\n";
						echo "<div class=\"span-12\">Synonimus</div>\n";
						//echo "<div class=\"span-6\">Protein Family</div>\n";
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

function lista_pathways_indicacion($id_indicacion){
global $basedatos,$connect;	

$query_pathways= "select indicacion_pathways.id_pathway,nombre_pathway,id_external from indicacion_pathways,pathways where indicacion_pathways.id_pathway=pathways.id_pathway and id_indicacion='".$id_indicacion."'";
$lista_pathways = mysql_query($query_pathways, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-21\">Pathway</div>\n";
		echo "<div class=\"span-0 last\"></div>\n";
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";
	
	
if ($lista_pathways){
	$numero_pathways=mysql_num_rows($lista_pathways);
		if($numero_pathways== 0) {
		} else {
			$a = 0;
			$dcolor_A = "impar";
			$dcolor_B = "par"; 
			while(list($id_pathway,$nombre_pathway,$id_external)= mysql_fetch_row($lista_pathways)){
			$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;
	
				echo "<li class=\"$dcolor\">\n";
					echo "<div class=\"span-21\">".$nombre_pathway."</div>\n";
					echo "<div class=\"span-0 last\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$link_pathway."')\"></a></div>\n";
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";

}

function lista_farmacos_commonpathway($id_indicacion){
global $connect,$basedatos;
	$farmacos_fcp='';
	$query_farmacos = "select distinct farmacos_inv.id_farmaco,nombre_farmaco,id_categoria_diana,descripcion_categoria_diana, 
	autores,tx1desc,tx2desc
	from indicacion_pathways,farmacos_inv_pathways,farmacos_inv,categorias_dianas 
	where indicacion_pathways.id_pathway=farmacos_inv_pathways.id_pathway and  
	farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and 
	farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and 
	id_indicacion='".$id_indicacion."' order by categorias_dianas.id_categoria_diana";
	
	
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
						echo "<div class=\"span-1\">&nbsp;</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				$grp_diana_anterior='0';
				while(list($id_farmaco,$nombre_farmaco,$id_cd,$descripcion_cd,$autores,$tx1desc,$tx2desc)= mysql_fetch_row($resultado)){
					
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
	echo "</ul>\n";	
	
	
	}		//del if resultado de farmacos con common target
	}  // del if numero de farmacos commun target		
//echo "<input type=\"hidden\" name=\"farmacos_fcp\" id=\"farmacos_fcp\" value=\"$farmacos_fcp\" />\n";

}




function listar_tumores(){
global $connect,$basedatos;
include ("inc/headerC.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
			echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Tumors Type </div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				//echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=apw')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-19\">Tumor Type</div>\n";
						echo "<div class=\"span-1\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$query_indicaciones = "select id_indicacion,descripcion_indicacion from indicaciones order by descripcion_indicacion";
				$resultado_indicaciones = mysql_query($query_indicaciones,$connect);
				if ($resultado_indicaciones){
				$numero_indicaciones=mysql_num_rows($resultado_indicaciones);
				    if($numero_indicaciones == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					while(list($id_indicacion,$descripcion_indicacion)= mysql_fetch_row($resultado_indicaciones)){
					 $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-19\">$descripcion_indicacion</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bbuscar\" href=\"tumors.php?cop=vt&id_indicacion=".$id_indicacion."\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
					 
				echo "</ul>\n";	
				
				
				
			echo "</div>\n";	
		echo "</div>\n";
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}

function ver_tumor($id_indicacion){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
$query_d="select descripcion_indicacion from indicaciones where id_indicacion='".$id_indicacion."'" ;
$lista_d = mysql_query($query_d,$connect);
include ("inc/headerC.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
			echo "<div class=\"span-23 last\">\n";
			if ($lista_d){
				$numero_d=mysql_num_rows($lista_d);
					if($numero_d == 0) {
					} else {
					list($descripcion_indicacion)= mysql_fetch_row($lista_d);	
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Tumor Type: ".$descripcion_indicacion."</div>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				
				echo "<div class=\"span-23 last\">\n";
					echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">FDA Approved Drugs for: ".$descripcion_indicacion."</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
												lista_farmacos_fda($id_indicacion);
										//tumores
							echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
						  			
				
				echo "<div class=\"span-23 last\">\n";
					echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
							echo "<div class=\"titulorecuadro\">Tumor Clasification</div>\n";
						echo "</div>\n";
						echo "<div class=\"cuerporecuadro clearfix\">\n";
							lista_tumores_indicacion($id_indicacion);
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
				
				echo "<div class=\"span-23 last\">\n";
					echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
							echo "<div class=\"titulorecuadro\">Gene Mutations (for tumor categorization) </div>\n";
						echo "</div>\n";
						echo "<div class=\"cuerporecuadro clearfix\">\n";
							//teniendo en cuenta que hemos categorizado los tumores(indicaciones) con tejidos subtejidos e histologia)
							lista_mutaciones_indicacion($id_indicacion);
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
				
				echo "<div class=\"span-23 last\">\n";
					echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
							echo "<div class=\"titulorecuadro\">Drugs acting on affected pathways</div>\n";
						echo "</div>\n";
						echo "<div class=\"cuerporecuadro clearfix\">\n";
							lista_pathways_indicacion($id_indicacion);
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
				
				echo "<div class=\"span-23 last\">\n";
					echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
							echo "<div class=\"titulorecuadro\">Investigational Drugs with Common Pathways</div>\n";
						echo "</div>\n";
						echo "<div class=\"cuerporecuadro clearfix\">\n";
							lista_farmacos_commonpathway($id_indicacion);
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
$cop="lt";	
}else{
$cop=$_GET['cop'];
}
	
switch($cop) {
default:
listar_tumores();  
break;
case "lt":
listar_tumores();
break;
case "vt":
ver_tumor($_GET['id_indicacion']);
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
echo "if (confirm(\"¿Desea eliminar esta toxicidad?\")){\n";
echo "var destino=\"functions2.php?op=deltcd&id_categoria_diana=\" +des1+ \"&id_toxicidad=\" + des2; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>