<?php
//include ("inc/login.php"); 
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",1);
echo $cabecera->get_php_code();

//echo "NIVEL: ".$_SESSION['UNIVEL']."</br>";


include ("inc/config.php");
include ("inc/alg_functions.php");




function lista_pathways_mutacion($id_mutacion,$GeneId,$nivel){
global $cabecera;	



$lista_pathways = $cabecera->bd->lista_pathways($id_mutacion);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-19\">Pathway</div>\n";
		echo "<div class=\"span-1\">Num</div>\n";
		echo "<div class=\"span-0\"></div>\n";
		if ($nivel > 1){
		echo "<div class=\"span-0 last\"></div>\n";
		}
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
			$numero_mutaciones=$cabecera->bd->numero_mutaciones_pathway($id_pathway);	
			if ($GeneId==0){
			$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;
			}else{
			$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external."?Sel=geneid:".$GeneId."#show=genes";
			
			}
			
				echo "<li class=\"$dcolor\">\n";
					echo "<div class=\"span-19\">".$nombre_pathway."</div>\n";
					echo "<div class=\"span-1\">$numero_mutaciones</div>\n";
					echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$link_pathway."')\"></a></div>\n";
					if ($nivel > 1){
					
						/*
						 * --- CONTROL DE ACCESO
						*/
						
						if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-0 last\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_pathway('".$id_mutacion."','".$id_pathway."')\"></a></div>\n";
					}
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";

}

function lista_tumores_mutacion($id_mutacion,$nivel){
global  $cabecera;	

$lista_tumores = $cabecera->bd->lista_tumores($id_mutacion);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-5\">Tissue</div>\n";
		echo "<div class=\"span-4\">SubTissue</div>\n";
		echo "<div class=\"span-5\">Histology</div>\n";
		echo "<div class=\"span-5\">SubHistology</div>\n";
		echo "<div class=\"span-1\">Num</div>\n";
		if ($nivel > 1){
		echo "<div class=\"span-0\"></div>\n";
		echo "<div class=\"span-0 last\"></div>\n";
		}
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
			$nombre_histologia_n0,$id_histologia_n1,$nombre_histologia_n1,$numero_mutaciones)= mysql_fetch_row($lista_tumores)){
			$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			     		echo "<li class=\"$dcolor\">\n";
						echo "<div class=\"span-5\">$nombre_tejido_n0</div>\n";
						echo "<div class=\"span-4\">$nombre_tejido_n1</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n0</div>\n";
						echo "<div class=\"span-5\">$nombre_histologia_n1</div>\n";
						echo "<div class=\"span-1\">$numero_mutaciones</div>\n";
						if ($nivel > 1){
							/*
							 * --- CONTROL DE ACCESO
							*/
							
							if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_tumor_mutacion('".$id_mutacion."','".$id_tejido_n1."','".$id_histologia_n0."','".$id_histologia_n1."')\"></a></div>\n";
						echo "<div class=\"span-0 last\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana600('ventanas_mut.php?cop=etm&id_mutacion=".$id_mutacion."&id_tejido_n1=".$id_tejido_n1."&id_histologia_n0=".$id_histologia_n0."&id_histologia_n1=".$id_histologia_n1."')\"></a></div>\n";
					}
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";

}

function lista_dianas_mutacion($id_mutacion,$nivel){
global $basedatos,$connect,$cabecera;
	$query_dianas= "select mutaciones_diana.id_diana,descripcion_diana,dianas.id_diana_n0,descripcion_diana_n0
	from mutaciones_diana,dianas,dianas_n0 
	where mutaciones_diana.id_diana=dianas.id_diana 
	and dianas.id_diana_n0=dianas_n0.id_diana_n0
	and id_mutacion='".$id_mutacion."' order by descripcion_diana_n0,descripcion_diana";
	$lista_dianas = mysql_query($query_dianas, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-8\">Target</div>\n";
		if ($nivel > 1){
		echo "<div class=\"span-0\"></div>\n";
		echo "<div class=\"span-0 last\"></div>\n";
		}
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";
	
	
if ($lista_dianas){
	$numero_dianas=mysql_num_rows($lista_dianas);
		if($numero_dianas== 0) {
		} else {
				$grp_diana_n0_anterior='0';
				while(list($id_diana,$descripcion_diana,$id_diana_n0,$descripcion_diana_n0)= mysql_fetch_row($lista_dianas)){
					if ($cabecera->bd->comprueba_diana_comun($id_diana)==0){
					$clase_fila="span-8";
					}else{
					$descripcion_diana=$descripcion_diana."&nbsp;**&nbsp;Common Target";
					$clase_fila="span-8 cab_fila";
					}
					
					
					
					if ($grp_diana_n0_anterior==$id_diana_n0){
						echo "<li class=\"par\">\n";
						echo "<div class=\"".$clase_fila."\">".$descripcion_diana."</div>\n";
						
							if ($nivel > 1){
								/*
								 * --- CONTROL DE ACCESO
								*/
								
								if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_diana('".$id_mutacion."','".$id_diana."')\"></a></div>\n";
							//echo "<div class=\"span-0 last\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_mut.php?cop=ediam&id_mutacion=".$id_mutacion."&id_diana=".$id_diana."')\"></a></div>\n";
							}
						echo "<div class=\"clear\"></div>\n";
						echo "</li>\n";
					}else{
						echo "<li class=\"cabecera cab_turquesa\">\n"; 
							echo "<div class=\"span-8\">$descripcion_diana_n0</div>\n";
							echo "<div class=\"span-0\">&nbsp;</div>\n";
							//echo "<div class=\"span-0 last\">&nbsp;</div>\n";
							echo "<div class=\"clear\"></div>\n";
						echo "</li>\n";
				
				
						echo "<li class=\"par\">\n";
							echo "<div class=\"".$clase_fila."\">".$descripcion_diana."</div>\n";
								if ($nivel > 1){
									/*
									 * --- CONTROL DE ACCESO
									*/
									
									if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_diana('".$id_mutacion."','".$id_diana."')\"></a></div>\n";
								
								//echo "<div class=\"span-0 last\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_inv.php?cop=ediam&id_mutacion=".$id_mutacion."&id_diana=".$id_diana."')\"></a></div>\n";
								}
							echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
							
						}
		   				$grp_diana_n0_anterior=$id_diana_n0;
				
				}
		}			
	}
	echo "</ul>\n";
}
 
function pinta_farmacos_commontarget($id_mutacion){
global $connect,$basedatos;
	$farmacos_fct='';
	/*	
	$query_farmacos = "select farmacos_inv.id_farmaco,substring(nombre_farmaco,1,40),id_categoria_diana,descripcion_categoria_diana,autores,tx1desc,tx2desc from farmacos_inv_diana,farmacos_inv,categorias_dianas 
	where farmacos_inv_diana.id_farmaco=farmacos_inv.id_farmaco and 
	farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and
	id_diana='".$id_diana."' order by  categorias_dianas.id_categoria_diana";
	*/
	$query_farmacos = "select farmacos_inv.id_farmaco,substring(nombre_farmaco,1,40),id_categoria_diana,descripcion_categoria_diana,autores,tx1desc,tx2desc 
	from mutaciones_diana,farmacos_inv_diana,farmacos_inv,categorias_dianas 
	where mutaciones_diana.id_diana=farmacos_inv_diana.id_diana and
	farmacos_inv_diana.id_farmaco=farmacos_inv.id_farmaco and 
	farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and
	id_mutacion='".$id_mutacion."'
	order by  categorias_dianas.id_categoria_diana,nombre_farmaco";
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
					$farmacos_fct=$farmacos_fct.$id_farmaco."x";
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
						if ($grp_diana_anterior==$id_cd){
		  				echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-5\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-7\">$tx1desc</div>\n";
								echo "<div class=\"span-8\">$tx2desc</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"farmacos.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0 \"></a></div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						}else{
							
								echo "<li class=\"cabecera cab_turquesa\">\n"; 
										echo "<div class=\"span-20\">$descripcion_cd</div>\n";
										echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"farmacos.php?id_farmaco1=0&id_farmaco2=".$id_cd."&pmtr1=1&pmtr2=0 \"></a></div>\n";
										echo "<div class=\"span-0 last\">&nbsp;</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
	
								echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-5 clearfix\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-7\">$tx1desc</div>\n";
								echo "<div class=\"span-8\">$tx2desc</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"farmacos.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0 \"></a></div>\n";
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
echo "<input type=\"hidden\" name=\"farmacos_fct\" id=\"farmacos_fct\" value=\"$farmacos_fct\" />\n";

}

function pinta_farmacos_commonpathway($id_mutacion){
global $connect,$basedatos;
	$farmacos_fcp='';
	$query_farmacos = "select distinct farmacos_inv.id_farmaco, substring(nombre_farmaco,1,40),id_categoria_diana,descripcion_categoria_diana,autores,tx1desc,tx2desc
	from mutaciones_pathways,farmacos_inv_pathways,farmacos_inv,categorias_dianas 
	where mutaciones_pathways.id_pathway=farmacos_inv_pathways.id_pathway and  
	farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and 
	farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and 
	id_mutacion='".$id_mutacion."' order by categorias_dianas.id_categoria_diana";
	
	
	
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
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"farmacos.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0 \"></a></div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";;
						//echo "<option value=\"$id_f\">$nombre_f</option>\n";
							}else{
									echo "<li class=\"cabecera cab_turquesa\">\n"; 
										echo "<div class=\"span-20\">$descripcion_cd</div>\n";
										echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"farmacos.php?id_farmaco1=0&id_farmaco2=".$id_cd."&pmtr1=1&pmtr2=0 \"></a></div>\n";
										echo "<div class=\"span-0 last\">&nbsp;</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
	
								echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-5 clearfix\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"span-7\">$tx1desc</div>\n";
								echo "<div class=\"span-8\">$tx2desc</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"farmacos.php?id_farmaco1=0&id_farmaco2=".$id_farmaco."&pmtr1=0&pmtr2=0 \"></a></div>\n";
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
echo "<input type=\"hidden\" name=\"farmacos_fcp\" id=\"farmacos_fcp\" value=\"$farmacos_fcp\" />\n";
}

function pinta_farmacos_fda($id_mutacion){
global $connect,$basedatos;
	$farmacos_fa='';
	$query_farmacos = "select distinct farmacos.id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco,descripcion_indicacion  
	from  mutaciones_tumores,indicacion_tumores,farmacos_indicaciones,farmacos,indicaciones
	where mutaciones_tumores.id_tejido_n1=indicacion_tumores.id_tejido_n1 and
	mutaciones_tumores.id_histologia_n0=indicacion_tumores.id_histologia_n0 and
	mutaciones_tumores.id_histologia_n1=indicacion_tumores.id_histologia_n1 and
	indicacion_tumores.id_indicacion=farmacos_indicaciones.id_indicacion and
	farmacos_indicaciones.id_farmaco=farmacos.id_farmaco and
	farmacos_indicaciones.id_indicacion=indicaciones.id_indicacion and
	mutaciones_tumores.id_mutacion='".$id_mutacion."' order by nombre_farmaco";

	//$query_farmacos = "select distinct farmacos_inv.id_farmaco, substring(nombre_farmaco,1,40)from mutaciones_pathways,farmacos_inv_pathways,farmacos_inv where mutaciones_pathways.id_pathway=farmacos_inv_pathways.id_pathway and  farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and id_mutacion='".$id_mutacion."'";
	mysql_select_db($basedatos,$connect);
	$resultado = mysql_query($query_farmacos,$connect);
	if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {
					echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-7\">Drug Name</div>\n";
						echo "<div class=\"span-6\">Approved for</div>\n";
						echo "<div class=\"span-7\">Clasification Advers Reaction in Clinical Trials</div>\n";
						echo "<div class=\"span-1\">&nbsp;</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				
				while(list($id_farmaco,$nombre_farmaco,$observaciones_farmaco,$clasificacion_toxicidad_farmaco,$descripcion_indicacion)= mysql_fetch_row($resultado)){
					$farmacos_fa=$farmacos_fa.$id_farmaco."x";
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-7\">$nombre_farmaco</div>\n";
								echo "<div class=\"span-6\">$descripcion_indicacion</div>\n";
								echo "<div class=\"span-7\">$clasificacion_toxicidad_farmaco</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"farmacos.php?id_farmaco1=".$id_farmaco."&id_farmaco2=0&pmtr1=0&pmtr2=0 \"></a></div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
				
					$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
	
	echo "</ul>\n";	
		
	
		}		//del if resultado de farmacos fda con con tumor
	}  // del if numero de farmacos fda con tumor			
	
	echo "<input type=\"hidden\" name=\"farmacos_fa\" id=\"farmacos_fa\" value=\"$farmacos_fa\" />\n";
}

function pinta_farmacos_fda_commonpathway($id_mutacion){
global $connect,$basedatos;
	$farmacos_fa='';
	$query_farmacos = "select distinct farmacos.id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco,descripcion_indicacion 
	from farmacos,farmacos_indicaciones,indicacion_pathways,mutaciones_pathways,indicaciones
	where farmacos.id_farmaco=farmacos_indicaciones.id_farmaco and 
	farmacos_indicaciones.id_indicacion=indicacion_pathways.id_indicacion and 
	indicacion_pathways.id_pathway=mutaciones_pathways.id_pathway and 
	farmacos_indicaciones.id_indicacion=indicaciones.id_indicacion
	and	id_mutacion='".$id_mutacion."' order by nombre_farmaco";	
	


	//$query_farmacos = "select distinct farmacos_inv.id_farmaco, substring(nombre_farmaco,1,40)from mutaciones_pathways,farmacos_inv_pathways,farmacos_inv where mutaciones_pathways.id_pathway=farmacos_inv_pathways.id_pathway and  farmacos_inv_pathways.id_farmaco=farmacos_inv.id_farmaco and id_mutacion='".$id_mutacion."'";
	mysql_select_db($basedatos,$connect);
	$resultado = mysql_query($query_farmacos,$connect);
	if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {
					echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-7\">Drug Name</div>\n";
						echo "<div class=\"span-6\">Approved for</div>\n";
						echo "<div class=\"span-7\">Clasification Advers Reaction in Clinical Trials</div>\n";
						echo "<div class=\"span-1\">&nbsp;</div>\n";
						echo "<div class=\"span-0 last\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				
				while(list($id_farmaco,$nombre_farmaco,$observaciones_farmaco,$clasificacion_toxicidad_farmaco,$descripcion_indicacion)= mysql_fetch_row($resultado)){
					$farmacos_fa=$farmacos_fa.$id_farmaco."x";
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-7\">$nombre_farmaco</div>\n";
								echo "<div class=\"span-6\">$descripcion_indicacion</div>\n";
								echo "<div class=\"span-7\">$clasificacion_toxicidad_farmaco</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bcomp\" title=\"Compare with\"  href=\"farmacos.php?id_farmaco1=".$id_farmaco."&id_farmaco2=0&pmtr1=0&pmtr2=0 \"></a></div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
				
					$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
	
	echo "</ul>\n";	
		
	
		}		//del if resultado de farmacos fda con con tumor
	}  // del if numero de farmacos fda con tumor			
	
	echo "<input type=\"hidden\" name=\"farmacos_fa\" id=\"farmacos_fa\" value=\"$farmacos_fa\" />\n";
}

function listar_mutaciones($tf,$vf,$pag){
global $connect,$basedatos;
$array_menu_superior=array("mutaciones.php"=>"Gene Mutations_SEL","pathways.php"=>"Oncogenic Pathways","custom_pathways.php"=>"Custom Pathways");
include ("inc/headerB.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<form  name=\"form_mutaciones\">\n";
			if ($tf==1){
			$query_mutaciones = "select id_mutacion,nombre_gen,GeneId,descripcion_tipo_mutacion,sinonimos_gen,protein_family from mutaciones,categorias_mutaciones 
			where mutaciones.tipo_mutacion=categorias_mutaciones.id_tipo_mutacion and
			nombre_gen like '%".$vf."%' order by nombre_gen ";	
			}else{
			$query_mutaciones = "select id_mutacion,nombre_gen,GeneId,descripcion_tipo_mutacion,sinonimos_gen,protein_family from mutaciones,categorias_mutaciones 
			where mutaciones.tipo_mutacion=categorias_mutaciones.id_tipo_mutacion order by nombre_gen";	
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
				echo "<div class=\"titulorecuadro\">Gene Mutations</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				
				
				/*
				 * --- CONTROL DE ACCESO
				 */
				
				if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL']) echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana600('ventanas_mut.php?cop=am')\"></a>\n";
				
				
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_mutaciones,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						//echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"span-4\">Gene Name</div>\n";
						echo "<div class=\"span-3\">Type</div>\n";
						echo "<div class=\"span-12\">Alternative Names</div>\n";
						//echo "<div class=\"span-6\">Protein Family</div>\n";
						echo "<div class=\"span-1\">PubMed Info</div>\n";
						echo "<div class=\"span-0\">&nbsp;</div>\n";
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
						while(list($id_mutacion,$nombre_gen,$GeneId,$tipo_mutacion,$sinonimos_gen,$protein_family)= mysql_fetch_row($resultado)){
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								
								
								echo "<div class=\"span-4\"><a href=\"javascript:abrir_ventana('ventanas_info2.php?cop=vm&id_mutacion=".$id_mutacion."')\">$nombre_gen</a></div>\n";
								echo "<div class=\"span-3\">$tipo_mutacion</div>\n";
								echo "<div class=\"span-12\">$sinonimos_gen</div>\n";
								if ($GeneId==0){
									echo "<div class=\"span-0\">&nbsp;</div>\n";
								}else{
									echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('http://www.ncbi.nlm.nih.gov/gene/".$GeneId."')\"></a></div>\n";
								}
								//echo "<div class=\"span-6\">$protein_family</div>\n";
								
								
								/*
				 				* --- CONTROL DE ACCESO
				 				*/
				
								if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL']) echo "<div class=\"span-1\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_mutacion('".$id_mutacion."')\"></a></div>\n";
								
								
								//echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info2.php?cop=vm&id_mutacion=".$id_mutacion."')\"></a></div>\n";
								
								/*
								 * --- CONTROL DE ACCESO
								*/
								
								if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"mutaciones.php?cop=em&id_mutacion=".$id_mutacion."\"></a></div>\n";
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

function editar_mutacion($id_mutacion){
global $connect,$basedatos;
$query_farmacos = "select nombre_gen,tipo_mutacion,GeneId,sinonimos_gen,protein_family,definicion_comun,id_diana,diana,enfermedad_asociada,celular_process from mutaciones where id_mutacion=".$id_mutacion;	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos, $connect);
$array_menu_superior=array("mutaciones.php"=>"Gene Mutations_SEL","pathways.php"=>"Oncogenic Pathways","custom_pathways.php"=>"Custom Pathways");
include ("inc/headerB.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-23 last\">\n";
			echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Edit Mutation</p>\n";
			echo "</div>\n";
				if ($resultado){
				$numero_registros=mysql_num_rows($resultado);
					if($numero_registros == 0) {
					echo "<p class=\"leyenda\">Error No aparece ningun registro</p>\n";
					} else {
						list($nombre_gen,$tipo_mutacion,$GeneId,$sinonimos_gen,$protein_family,$definicion_comun,$id_diana,$diana,$enfermedad_asociada,$celular_process)= mysql_fetch_row($resultado);
							echo "<form action=\"functions_mut.php\" method=\"post\" name=\"form_mutaciones\">\n";
											  echo "<div class=\"cuerpo1\">\n";
												  echo "<div class=\"span-12\">\n";
												  echo "<div class=\"izq\">\n";
													  echo "<p class=\"formulario\">\n";
														  echo "<label for \"nombre_gen\" class=\"span-3\">Gen Name</label>\n";
														  echo "<input type=\"text\" name=\"nombre_gen\" value=\"$nombre_gen\" class=\"span-8\" />\n";
													  echo "</p>\n";
													  echo "<p class=\"formulario\">\n";
														  echo "<label for \"GeneId\" class=\"span-3\">GenId(Ncbi)</label>\n";
														  echo "<input type=\"text\" name=\"GeneId\" value=\"$GeneId\" class=\"span-3\" />\n";
													 	  if ($GeneId==0){
														  }else{
														  echo "<a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('http://www.ncbi.nlm.nih.gov/gene/".$GeneId."')\"></a>";
														   }
													  
													  echo "</p>\n";
													  echo "<div class=\"dcha conborde clearfix\">\n";
														  echo "<p class=\"leyenda\">Synonimus</p>\n";
														  echo "<p class=\"fomulariosin\">\n";
															  echo "<textarea name=\"sinonimos_gen\" class=\"span-11\">$sinonimos_gen</textarea>\n";
														  echo "</p>\n";
													  echo "</div>\n";	
													  echo "<div class=\"dcha conborde clearfix\">\n";
														  echo "<p class=\"leyenda\">Protein Family</p>\n";
														  echo "<p class=\"fomulariosin\">\n";
															  echo "<textarea name=\"protein_family\" class=\"span-11\">$protein_family</textarea>\n";
														  echo "</p>\n";
													  echo "</div>\n";	
					  
												  echo "<div class=\"dcha conborde clearfix\">\n";
													  echo "<p class=\"leyenda\">Disease associated</p>\n";
													  echo "<p class=\"fomulariosin\">\n";
														  echo "<textarea name=\"enfermedad_asociada\" class=\"span-11\">$enfermedad_asociada</textarea>\n";
													  echo "</p>\n";
												  echo "</div>\n";
													  
													  echo "<p class=\"fomulariosin\"></p>\n";
													  
												  echo "</div>\n";
											  echo "</div>\n";
											  
											  
									echo "<div class=\"span-11 last\">\n";
										echo "<div class=\"dcha conborde\">\n";
											echo "<p class=\"formulario\">\n";
												echo "<label for \"select_tipo_mutacion\" class=\"span-4\">Mutation Type</label>\n";
												echo "<select name=\"select_tipo_mutacion\" id=\"select_tipo_mutacion\" class=\"span-4\">\n";        
													  $query_tipos_mutaciones="select id_tipo_mutacion,descripcion_tipo_mutacion from categorias_mutaciones ";
													  $lista_tipos_mutaciones = mysql_query($query_tipos_mutaciones, $connect);
													  if ($lista_tipos_mutaciones){
														  $numero_tipos_mutaciones=mysql_num_rows($lista_tipos_mutaciones);
															  if($numero_tipos_mutaciones == 0) {
															  } else {
															  while(list($id_tipo_lista,$descripcion_tipo_lista)= mysql_fetch_row($lista_tipos_mutaciones)){ 	
																	  if ($id_tipo_lista==$tipo_mutacion){
																	  $sel = "selected";
																	  }else{
																	  $sel = "";
																	  }
																  echo "<option $sel value=\"$id_tipo_lista\">$descripcion_tipo_lista</option>\n";	
																  }  	
															  }
													  }    	
												echo "</select>\n";	
											echo "</p>\n";
										echo "</div>\n";
										echo "<div class=\"dcha conborde\">\n";
											echo "<p class=\"formulario\">\n";
													echo "<label for \"celular_process\" class=\"span-4\">Process</label>\n";
													echo "<input type=\"text\" name=\"celular_process\" value=\"$celular_process\" class=\"span-6\" />\n";
											echo "</p>\n";
										echo "</div>\n";													
										echo "<div class=\"dcha conborde\">\n";
											echo "<p class=\"formulario\">\n";
													if ($definicion_comun==0){
													echo "<label for \"radio_definicion_comun\" class=\"span-4\">Common definition</label>\n";
													echo "<input type=\"radio\" name=\"radio_definicion_comun\" value=\"1\"  />\n";
													echo "Yes";
													echo "<input type=\"radio\" name=\"radio_definicion_comun\" value=\"0\" checked />\n";
													echo "No";
													}else{
													echo "<label for \"radio_definicion_comun\" class=\"span-4\">Common definition</label>\n";
													echo "<input type=\"radio\" name=\"radio_definicion_comun\" value=\"1\" checked />\n";
													echo "Yes";
													echo "<input type=\"radio\" name=\"radio_definicion_comun\" value=\"0\"  />\n";
													echo "No";
													}
											
											echo "</p>\n";
											/*
											echo "<p class=\"formulario\">\n";
													echo "<label for \"select_diana\" class=\"span-4\">Common Target</label>\n";
													echo "<select name=\"select_diana\" id=\"select_diana\" class=\"span-5\">\n";        
													$query_dianas="select id_diana,descripcion_diana from dianas order by descripcion_diana";
													$lista_dianas = mysql_query($query_dianas, $connect);
													if ($lista_dianas){
														$numero_dianas=mysql_num_rows($lista_dianas);
															if($numero_dianas == 0) {
															} else {
																echo "<option value=\"0\">Seleccione Diana</option>\n";
																while(list($id_diana_lista,$descripcion_diana_lista)= mysql_fetch_row($lista_dianas)){ 	
																	if ($id_diana_lista==$id_diana){
																	$sel = "selected";
																	}else{
																	$sel = "";
																	}
																echo "<option $sel value=\"$id_diana_lista\">$descripcion_diana_lista</option>\n";	
																}  	
															}
													}    	
													echo "</select>\n";	
											echo "</p>\n";
										*/
										echo "</div>\n";
										/*
										echo "<div class=\"dcha conborde\">\n";
											echo "<p class=\"formulario\">\n";
												echo "<label for \"diana\" class=\"span-4\">Other Target</label>\n";
												echo "<label class=\"span-5 clearfix\">$diana</label>\n";
												echo "</p>\n";
										echo "</div>\n";					
										*/
									echo "</div>\n";
									echo "<div class=\"span-23 last\">\n";
										echo "<div class=\"span-12\">\n";
												echo "<p class=\"fomulariosin centrado\">\n";
													  	echo "<input type=\"hidden\" name=\"id_mutacion\" id=\"id_mutacion\" value=\"$id_mutacion\" />\n";
													  	echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"em\" />\n";
														echo "<input type=\"submit\" value=\"Actualizar\"/>\n"; 
												echo "</p>\n";
										echo "</div>\n";
										echo "<div class=\"span-11 last\">\n";
											echo "<p class=\"fomulariosin centrado\">\n";
												echo "<input type=\"button\" value=\"Salir\" onClick='window.location=\"mutaciones.php\"'>\n";
											echo "</p>\n";
										echo "</div>\n";
									
									
									
									echo "</div>\n";
									
									echo "<div class=\"span-23 last\">\n";
									  echo "<div class=\"recuadroizq conborde\">\n";
											echo "<div class=\"cabecerarecuadro clearfix\">\n";
												echo "<div class=\"titulorecuadro\">Tumours</div>\n";
												echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana600('ventanas_mut.php?cop=atm&id_mutacion=".$id_mutacion."')\"></a>\n";
											echo "</div>\n";
											echo "<div class=\"cuerporecuadro clearfix\">\n";
												lista_tumores_mutacion($id_mutacion,2);
										//tumores
											echo "</div>\n";
									  echo "</div>\n";
									echo "</div>\n";
						  		
									echo "<div class=\"span-23 last\">\n";
										echo "<div class=\"recuadroizq conborde\">\n";
											echo "<div class=\"cabecerarecuadro clearfix\">\n";
												echo "<div class=\"titulorecuadro\">Pathways</div>\n";
												echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana600('ventanas_mut.php?cop=apm&id_mutacion=".$id_mutacion."')\"></a>\n";
											echo "</div>\n";
											echo "<div class=\"cuerporecuadro clearfix\">\n";
																if ($GeneId==""){
																lista_pathways_mutacion($id_mutacion,0,2);
																}else{
																lista_pathways_mutacion($id_mutacion,$GeneId,2);
																}
											echo "</div>\n";
										echo "</div>\n";
										
										echo "</div>\n";				
										echo "<div class=\"span-23 last\">\n";
											echo "<div class=\"recuadroizq conborde\">\n";
												echo "<div class=\"cabecerarecuadro clearfix\">\n";
													echo "<div class=\"titulorecuadro\">Targets</div>\n";
													echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana600('ventanas_mut.php?cop=adiam&id_mutacion=".$id_mutacion."')\"></a>\n";
												echo "</div>\n";
												echo "<div class=\"cuerporecuadro clearfix\">\n";
													lista_dianas_mutacion($id_mutacion,2);
												echo "</div>\n";
											echo "</div>\n";	
										echo "</div>\n";
										echo "<div class=\"span-23 last \">\n";				
											echo "<div class=\"recuadroizq conborde\">\n";
													echo "<div class=\"cabecerarecuadro clearfix\">\n";
														echo "<div class=\"titulorecuadro\">Investigational Drugs with common pathway</div>\n";
													echo "</div>\n";
													echo "<div class=\"cuerporecuadro clearfix\">\n";
													pinta_farmacos_commonpathway($id_mutacion);	
													echo "</div>\n";
											echo "</div>\n";
										echo "</div>\n";						
										echo "<div class=\"span-23 last \">\n";			
											echo "<div class=\"recuadroizq conborde\">\n";
													echo "<div class=\"cabecerarecuadro clearfix\">\n";
														echo "<div class=\"titulorecuadro\">Investigational Drugs with common target</div>\n";
													echo "</div>\n";
													echo "<div class=\"cuerporecuadro clearfix\">\n";
													pinta_farmacos_commontarget($id_mutacion);
													echo "</div>\n";
											echo "</div>\n";
										echo "</div>\n";		
										echo "<div class=\"span-23 last \">\n";					
											echo "<div class=\"recuadroizq conborde clearfix\">\n";
													echo "<div class=\"cabecerarecuadro clearfix\">\n";
														echo "<div class=\"titulorecuadro\">FDA Approved Drug</div>\n";
													echo "</div>\n";
													echo "<div class=\"cuerporecuadro clearfix\">\n";
													pinta_farmacos_fda($id_mutacion);
													echo "</div>\n";
											echo "</div>\n";
										echo "</div>\n";
										
										echo "<div class=\"span-23 last \">\n";					
											echo "<div class=\"recuadroizq conborde clearfix\">\n";
													echo "<div class=\"cabecerarecuadro clearfix\">\n";
														echo "<div class=\"titulorecuadro\">FDA Approved Drug with common pathway</div>\n";
													echo "</div>\n";
													echo "<div class=\"cuerporecuadro clearfix\">\n";
													pinta_farmacos_fda_commonpathway($id_mutacion);
													echo "</div>\n";
											echo "</div>\n";
										echo "</div>\n";
						  			
									
									
									echo "<div class=\"span-23 last \">\n";
										echo "<p class=\"formulario centrado\">\n";
                                    	echo "<input type=\"button\" value=\"Compare Drugs\" onClick=\"compare_drugs()\" />\n"; 
                						echo "</p>\n";
									echo "</div>\n";
								
								
								
								echo "</div>\n";	
						echo "</form>\n";
					}
				}
		
		echo "</div>\n";
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}



if (!isset($_GET['cop'])){
$cop="lm";	
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

listar_mutaciones($tf,$vf,$pag);		   
break;
case "lm":
listar_mutaciones($tf,$vf,$pag);
break;
case "em":
editar_mutacion($_GET['id_mutacion']);
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
echo "var ventana = window.open (a,\"links1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=600\");\n";
echo "ventana.focus();";
echo "}\n";
echo "function abrir_ventana600(a){\n";
echo "window.open (a,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=500\");\n";
echo "}\n";
echo "function aviso_borrar_pathway(des1,des2){\n";
echo "if (confirm(\"�Desea eliminar este pathway?\")){\n";
echo "var destino=\"functions_mut.php?op=delpm&id_mutacion=\" +des1+ \"&id_pathway=\" + des2; \n";
echo "window.open (destino,\"mutaciones1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_tumor_mutacion(des1,des2,des3,des4){\n";
echo "if (confirm(\"�Desea eliminar este registro?\")){\n";
echo "var destino=\"functions_mut.php?op=deltm&id_mutacion=\" +des1+ \"&id_tejido_n1=\" + des2+ \"&id_histologia_n0=\" + des3+ \"&id_histologia_n1=\" + des4; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_diana(des1,des2){\n";
echo "if (confirm(\"�Desea eliminar esta diana?\")){\n";
echo "var destino=\"functions_mut.php?op=deldiam&id_mutacion=\" +des1+ \"&id_diana=\" + des2; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function compare_drugs(){\n";
echo "e1=document.getElementById('farmacos_fct');\n";			
echo "e2=document.getElementById('farmacos_fcp');\n";
echo "e3=document.getElementById('farmacos_fa');\n";
echo "var lista1=e1.value + e2.value;\n";
echo "var lista2=e3.value;\n";
echo "if (lista1==''){\n";
echo "lista1=0;\n";
echo "}\n";
echo "if (lista2==''){\n";
echo "lista2=0;\n";
echo "}\n";
echo "var destino=\"compare2.php?lista1=\" +lista1+ \"&lista2=\" + lista2; \n";
echo "window.open (destino,\"comparaciones\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=950,height=650\");\n";
echo "}\n";
echo "function buscar_texto(){\n";
echo "var texto_busqueda=document.getElementById('search_text').value;\n";
echo "window.location='mutaciones.php?cop=lm&tf=1&vf=' + texto_busqueda + '&pag=0';\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>