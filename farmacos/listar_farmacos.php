<?php
//include ("inc/login.php"); 
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",10);
echo $cabecera->get_php_code();


include ("inc/config.php");
include ("inc/alg_functions.php");

function devuelve_toxicidades($farmaco_id,$toxicidad_id,$categoria_id){
global $basedatos,$connect;	
$query_toxicidades="select valor_toxicidad from farmacos_toxicidad where id_farmaco=".$farmaco_id." and id_toxicidad=".$toxicidad_id. " and id_categoria=".$categoria_id;
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
	if ($lista_toxicidades){
	$numero_toxicidades=mysql_num_rows($lista_toxicidades);
		if($numero_toxicidades == 0) {
		return 0;
		} else {
			list($valor_toxicidad)= mysql_fetch_row($lista_toxicidades);
		return $valor_toxicidad;
		}								
	}else{
	return "error";	
	}

}

function lista_toxicidades_farmaco_inv($farmaco_id,$toxicidad_id){
global $basedatos,$connect,$nombre_toxicidad_seleccionada;
echo "<ul class=\"m0\">\n";
	    $query_toxicidades="select nombre_toxicidad,tx1,tx2,toxicidad.id_toxicidad from farmacos_inv_toxicidad,toxicidad  where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=".$farmaco_id;
	     $lista_toxicidades = mysql_query($query_toxicidades, $connect);
		  if ($lista_toxicidades){
		  $numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
			echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<select name=\"select_tx2\" id=\"select_tx2\" class=\"span-7\">\n";        
					while(list($nombre_toxicidad,$tx1,$tx2,$id_toxicidad)= mysql_fetch_row($lista_toxicidades)){ 	
						if ($id_toxicidad==$toxicidad_id){
						$sel = "selected";
						$nombre_toxicidad_seleccionada=$nombre_toxicidad;
						}else{
						$sel = "";
						}
					echo "<option $sel value=\"$id_toxicidad\">$nombre_toxicidad</option>\n";	
					}       	
			      echo "</select>\n";
			echo "</li>\n";
			}
		  }
	    
	    echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		  echo "<div class=\"span-4\">Toxicidad</div>\n";
		  echo "<div class=\"span-1\">AE >10</div>\n";
		  echo "<div class=\"span-1 last\">Grade >=3</div>\n";
		  echo "<div class=\"clear\"></div>\n";
	    echo "</li>\n";
	    
	    $lista_toxicidades = mysql_query($query_toxicidades, $connect);
		  if ($lista_toxicidades){
		  $numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
			$a = 0;
			$dcolor_A = "impar";
			$dcolor_B = "par"; 
			      $array_0_1=array("","<img class=\"blineatabla bok\" />");
			      while(list($nombre_toxicidad,$tx1,$tx2)= mysql_fetch_row($lista_toxicidades)){
			      $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			      echo "<li class=\"$dcolor\">\n";
				    echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
		        	    echo "<div class=\"span-1\">$array_0_1[$tx1]</div>\n";
				    //echo "<div class=\"span-1\"><img class=\"blineatabla bok\" /></div>\n";
				    echo "<div class=\"span-1 last\">$array_0_1[$tx2]</div>\n";
				    echo "<div class=\"clear\"></div>\n";
				    echo "</li>\n";
			      	    $a = ($dcolor == $dcolor_A ? 1 : 0);
			      }
			
			}
		  }			
      echo "</ul>\n";	  				       	    													
}

function lista_toxicidades_farmaco($farmaco_id,$id_tox_n0,$nivel){
global $basedatos,$connect;	
	
							$query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,
							id_categoria,valor_toxicidad from farmacos_toxicidad,toxicidad  where farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco='".$farmaco_id."' and id_toxicidad_n0='".$id_tox_n0."'";
							$lista_toxicidades = mysql_query($query_toxicidades, $connect);
							if ($lista_toxicidades){
							$numero_toxicidades=mysql_num_rows($lista_toxicidades);
								if($numero_toxicidades == 0) {
								} else {
								//repartirlo en 3 columnas
								
								
								
								
								$gradeall=array();
								$grade34=array();
									while(list($id_toxicidad,$nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){	
										$array_toxicidades[$id_toxicidad]=$nombre_toxicidad;
										if ($id_categoria==0){
										$gradeall[$id_toxicidad]=$valor_toxicidad;
										}
										if ($id_categoria==4){
										$grade34[$id_toxicidad]=$valor_toxicidad;
										}
									}	
							
							    $n_toxicidades_farmaco=count($array_toxicidades);
								$resto=$n_toxicidades_farmaco%3;
								if ($resto==1){
								$ad1=1;
								$ad2=0;
								}else if($resto==2){
								$ad1=1;
								$ad2=1;
								}else{
								$ad1=0;
								$ad2=0;
								}
								$filas_col1=($n_toxicidades_farmaco-$resto)/3 + $ad1;
								$filas_col2=($n_toxicidades_farmaco-$resto)/3+ $ad2;
								$filas_col3=($n_toxicidades_farmaco-$resto)/3;
								
							
							
							
							
							
							$a = 0;
							$dcolor_A = "impar";
							$dcolor_B = "par"; 
							$cfilas=1;
							$ccolumnas=1;
							$fin_tabla=$filas_col1;
							
							while (list ($cod_tox, $des_tox) = each ($array_toxicidades)){
										if (array_key_exists($cod_tox,$gradeall)){
										$txall=$gradeall[$cod_tox];
										}else{
										$txall="---";
										}
										if (array_key_exists($cod_tox,$grade34)){
										$tx34=$grade34[$cod_tox];
										}else{
										$tx34="---";
										}
							
							if	($cfilas==1){
								if ($nivel > 1){
								echo "<div class=\"span-7\">\n";
								}else{
								echo "<div class=\"span-6\">\n";
								}
							
							
							echo "<ul class=\"m0\">\n";
								echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
								echo "<div class=\"span-3\">Toxicidad</div>\n";
								echo "<div class=\"span-1\">All Grd</div>\n";
								echo "<div class=\"span-1 last\">Grd 3/4</div>\n";
								if ($nivel > 1){
								echo "<div class=\"span-0\"></div>\n";
								echo "<div class=\"span-0\"></div>\n";
								}
								echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
							}
							
							
							//while(list($nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){
								$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
								echo "<li class=\"$dcolor\">\n";
									echo "<div class=\"span-3\">".$des_tox."</div>\n";
									echo "<div class=\"span-1\">$txall</div>\n";
									echo "<div class=\"span-1 last\">$tx34</div>\n";
									if ($nivel > 1){
									echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_toxicidad('".$farmaco_id."','".$cod_tox."')\"></a></div>\n";
									echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_fda.php?cop=etf&id_farmaco=".$farmaco_id."&id_toxicidad=".$cod_tox."')\"></a></div>\n";
									}
									
									echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
							$a = ($dcolor == $dcolor_A ? 1 : 0);
							if	($cfilas==$fin_tabla){
							echo "</ul>\n";	
							echo "</div>\n";
							$cfilas=0;
								if ($ccolumnas < 3){
								$ccolumnas=$ccolumnas+1;
								$valor_columnas="filas_col".$ccolumnas;
								$fin_tabla=$$valor_columnas;
								}
							}
							
							
							
							$cfilas=$cfilas+1;
							
							}
			
							}
							}			
							
	
}

function lista_indicaciones_farmaco($farmaco_id,$nivel){
global $basedatos,$connect;	

	$query_indicaciones= "select farmacos_indicaciones.id_indicacion,descripcion_indicacion,testado  from farmacos_indicaciones,indicaciones where farmacos_indicaciones.id_indicacion=indicaciones.id_indicacion and id_farmaco='".$farmaco_id."' order by descripcion_indicacion";
	$lista_indicaciones = mysql_query($query_indicaciones, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-7\">Indicacion</div>\n";
		echo "<div class=\"span-0\"></div>\n";
		if ($nivel > 1){
		echo "<div class=\"span-0\"></div>\n";
		echo "<div class=\"span-0\"></div>\n";
		}
		echo "<div class=\"clear\"></div>\n";
		echo "</li>\n";
	
	
if ($lista_indicaciones){
	$numero_indicaciones=mysql_num_rows($lista_indicaciones);
		if($numero_indicaciones== 0) {
		} else {
				while(list($id_indicacion,$descripcion_indicacion,$testado)= mysql_fetch_row($lista_indicaciones)){
				
				echo "<li class=\"impar\">\n";
					echo "<div class=\"span-7\">".$descripcion_indicacion."</div>\n";
					echo "<div class=\"span-0\">".$testado."</div>\n";
					if ($nivel > 1){
					echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_indicacion('".$farmaco_id."','".$id_indicacion."')\"></a></div>\n";
					echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_fda.php?cop=eif&id_farmaco=".$farmaco_id."&id_indicacion=".$id_indicacion."')\"></a></div>\n";
					}
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				
				}
		}			
	}
	echo "</ul>\n";
}

function lista_links_farmaco($farmaco_id,$tipo_link,$nivel){
global $basedatos,$connect;	
	
$query_links= "select id_link,descripcion_link,url_link,tipo_link from farmacos_links where id_farmaco='".$farmaco_id."' and tipo_link='".$tipo_link."'";
$lista_links = mysql_query($query_links, $connect);
	
	if ($lista_links){
	$numero_links=mysql_num_rows($lista_links);
	if($numero_links== 0) {
		} else {
		echo "<ul class=\"m0\">\n";	
			while(list($id_link,$descripcion_link,$url_link,$tipo_link)= mysql_fetch_row($lista_links)){
			
			echo "<li class=\"par\">\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$url_link."')\"></a></div>\n";
				echo "<div class=\"span-6\">".$descripcion_link."</div>\n";
				if ($nivel > 1){
				echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_link('".$id_link."')\"></a></div>\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_fda.php?cop=elkf&id_link=".$id_link."')\"></a></div>\n";
				}
				echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
			
			}
		echo "</ul>\n";
		}			
	}

}

function listar_farmacos(){
global $connect,$basedatos;
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs_SEL","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies");
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<form  name=\"form_farmacos\">\n";
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
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL']) echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_fda.php?cop=af')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				$query_farmacos = "select id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco,tipo_farmaco,farmaco_principal from farmacos where tipo_farmaco != 3 order by nombre_farmaco";	
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_farmacos,$connect);
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-7\">Drug Name</div>\n";
						echo "<div class=\"span-6\">More Information</div>\n";
						echo "<div class=\"span-6\">Clasification Advers Reaction in Clinical Trials</div>\n";
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
						while(list($id_farmaco,$nombre_farmaco,$observaciones_farmaco,$clasificacion_toxicidad_farmaco,$tipo_farmaco,$farmaco_principal)= mysql_fetch_row($resultado)){
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);					
							
								if ($tipo_farmaco==2){
								echo "<li class=\"$dcolor\">\n";
									echo "<div class=\"span-0\"><a id=\"aFam".$id_farmaco."\" class=\"botoncabecera badd\" href=\"javascript:ver_farmacos_capa('".$id_farmaco."')\"></a></div>\n";
									echo "<div class=\"span-7\">$nombre_farmaco</div>\n";
									echo "<div class=\"span-6\">$observaciones_farmaco</div>\n";
									echo "<div class=\"span-6\">$clasificacion_toxicidad_farmaco</div>\n";
									
									/*
									 * --- CONTROL DE ACCESO
									*/
									
									if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-1\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_farmaco_fda('".$id_farmaco."')\"></a></div>\n";
									
									
									echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
									
									
									/*
									 * --- CONTROL DE ACCESO
									*/
									
									if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"listar_farmacos.php?cop=ef&id_farmaco=".$id_farmaco."\"></a></div>\n";
									
									
									echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
								
								 echo "<div id=\"divFam".$id_farmaco."\"  class=\"oculto\">\n";
								$query_f_t3 = "select id_farmaco,nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco
								from farmacos where tipo_farmaco = 3  and farmaco_principal=".$id_farmaco." order by nombre_farmaco";	
								$resultado_t3 = mysql_query($query_f_t3,$connect);
									if ($resultado_t3){
									$numero_f_t3=mysql_num_rows($resultado_t3);
				    					if($numero_f_t3 == 0) {
				    					} else {
											
											while(list($id_farmaco_t3,$nombre_farmaco_t3,$observaciones_farmaco_t3,$clasificacion_toxicidad_farmaco_t3)= mysql_fetch_row($resultado_t3)){
											//$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);	
											echo "<li class=\"$dcolor\">\n";
													echo "<div class=\"span-0\">&nbsp;</div>\n";
													echo "<div class=\"span-7\">$nombre_farmaco_t3</div>\n";
													echo "<div class=\"span-6\">$observaciones_farmaco_t3</div>\n";
													echo "<div class=\"span-6\">$clasificacion_toxicidad_farmaco</div>\n";
													/*
													 * --- CONTROL DE ACCESO
													*/
														
													if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-1\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_farmaco_fda('".$id_farmaco_t3."')\"></a></div>\n";
													
													echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco_t3."')\"></a></div>\n";
													
													/*
													 * --- CONTROL DE ACCESO
													*/
														
													if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"listar_farmacos.php?cop=ef&id_farmaco=".$id_farmaco_t3."\"></a></div>\n";
													
													echo "<div class=\"clear\"></div>\n";
											echo "</li>\n";
											//$a = ($dcolor == $dcolor_A ? 1 : 0);
											}
								        }
									}
								
									echo "</div>\n";
								
								
								}else{
								echo "<li class=\"$dcolor\">\n";
									echo "<div class=\"span-0\">&nbsp;</div>\n";
									echo "<div class=\"span-7\">$nombre_farmaco</div>\n";
									echo "<div class=\"span-6\">$observaciones_farmaco</div>\n";
									echo "<div class=\"span-6\">$clasificacion_toxicidad_farmaco</div>\n";
									/*
									 * --- CONTROL DE ACCESO
									*/
										
									if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-1\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_farmaco_fda('".$id_farmaco."')\"></a></div>\n";
									
									echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
									
									/*
									 * --- CONTROL DE ACCESO
									*/
										
									if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])	echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"listar_farmacos.php?cop=ef&id_farmaco=".$id_farmaco."\"></a></div>\n";
									
									echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
								}
								
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

function editar_farmaco($id_farmaco){
global $connect,$basedatos;
$query_farmacos = "select nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco,tipo_farmaco,farmaco_principal from farmacos where id_farmaco=".$id_farmaco;	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos, $connect);
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs_SEL","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies");
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
			echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Edicion Farmaco</p>\n";
				echo "</div>\n";
				if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
					if($numero_farmacos == 0) {
					echo "<p class=\"leyenda\">Error No aparece ningun registro</p>\n";
					} else {
						list($nombre_farmaco,$observaciones_farmaco,$clasificacion_toxicidad_farmaco,$tipo_farmaco,$farmaco_principal)= mysql_fetch_row($resultado);
						echo "<form action=\"functions.php\" method=\"post\" name=\"form_farmacos\">\n";
							echo "<div class=\"cuerpo1\">\n";
							echo "<div class=\"span-12\">\n";
								echo "<div class=\"izq\">\n";
									echo "<p class=\"formulario\">\n";
										echo "<label for \"nombre_farmaco\" class=\"span-3\">Drug Name</label>\n";
										echo "<input type=\"text\" name=\"nombre_farmaco\" value=\"$nombre_farmaco\" class=\"span-8\" />\n";
									echo "</p>\n";
									
									echo "<div class=\"dcha conborde clearfix\">\n";
									echo "<p class=\"leyenda\">More Information</p>\n";
									echo "<p class=\"fomulariosin\">\n";
										echo "<textarea name=\"observaciones_farmaco\" class=\"span-9\">$observaciones_farmaco</textarea>\n";
									echo "</p>\n";;
								echo "</div>\n";	
								echo "<div class=\"dcha conborde clearfix\">\n";
									echo "<p class=\"leyenda\">Clasification Advers Reaction in Clinical Trials</p>\n";
									echo "<p class=\"fomulariosin\">\n";
										echo "<textarea name=\"clasificacion_toxicidad_farmaco\" class=\"span-9\">$clasificacion_toxicidad_farmaco</textarea>\n";
									echo "</p>\n";
								echo "</div>\n";
								echo "<div class=\"dcha conborde clearfix\">\n";
													echo "<p class=\"leyenda\">Tipo farmaco</p>\n";
														$array_v_checked=array('','','','','');
	 													$array_v_checked[$tipo_farmaco]="checked";	
														
													
														echo "<p class=\"formulario\">\n";
														echo "<input type=\"radio\" name=\"radio_tipo_farmaco\" value=\"1\" ".$array_v_checked[1]." />\n";
													 	echo "Sin Categoria";
														echo "</p>\n";
														echo "<p class=\"formulario\">\n";
														echo "<input type=\"radio\" name=\"radio_tipo_farmaco\" value=\"2\" ".$array_v_checked[2]." />\n";
														echo "Cabeza de Categoria";
														echo "</p>\n";
														echo "<p class=\"formulario\">\n";
														echo "<input type=\"radio\" name=\"radio_tipo_farmaco\" value=\"3\" ".$array_v_checked[3]." />\n";
														echo "Pertenece a Categoria:";
														echo "</p>\n";
														echo "<p class=\"formulario\">\n";
															echo "<select name=\"select_farmaco_principal\" id=\"select_farmaco_principal\" class=\"span-10\">\n";        
													  		echo "<option value=\"0\"></option>\n";
													  		$query_f_principales="select id_farmaco,nombre_farmaco from farmacos where tipo_farmaco=2";
													  		$lista_f_principales = mysql_query($query_f_principales, $connect);
																  if ($lista_f_principales){
																	  $numero_f_principales=mysql_num_rows($lista_f_principales);
																		  if($numero_f_principales == 0) {
																		  } else {
																		  while(list($id_fp,$descripcion_fp)= mysql_fetch_row($lista_f_principales)){ 	
																				  if ($id_fp==$farmaco_principal){
																				  $sel = "selected";
																				  }else{
																				  $sel = "";
																				  }
																			  echo "<option $sel value=\"$id_fp\">$descripcion_fp</option>\n";	
																			  }  	
																		  }
																  	}    	
															echo "</select>\n";	
														
														
														echo "</p>\n";
								echo "</div>\n";
								
								
								
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Ongoing Clinical Trials</div>\n";
										$link_trial="http://www.clinicaltrials.gov/ct2/results?term=".urlencode($nombre_farmaco)."&Search=Search";
										echo "<a class=\"botoncabecera binfo\" href=\"javascript:abrir_ventana('".$link_trial."')\"></a></div>\n";
								echo "</div>\n";
									
									
									
								
								
								echo "</div>\n";
							echo "</div>\n";
							echo "<div class=\"span-11 last\">\n";
								echo "<div class=\"recuadrodcha conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Indicaciones</div>\n";
										echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_fda.php?cop=aif&id_farmaco=".$id_farmaco."')\"></a>\n";
									echo "</div>\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
										lista_indicaciones_farmaco($id_farmaco,2);
									echo "</div>\n";

								echo "</div>\n";
								echo "<div class=\"recuadrodcha conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Links</div>\n";
										echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_fda.php?cop=alkf&id_farmaco=".$id_farmaco."')\"></a>\n";
									echo "</div>\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
										
										$query_grplnk="select distinct categorias_link.tipo_link,descripcion_tipo_link from categorias_link,farmacos_links where
											id_farmaco='".$id_farmaco."' and
											categorias_link.tipo_link=farmacos_links.tipo_link";
										$resultado_grplnk = mysql_query($query_grplnk,$connect);
										if ($resultado_grplnk){
										$numero_grplnk=mysql_num_rows($resultado_grplnk);
											if($numero_grplnk == 0) {
											} else {
												while(list($id_grplnk,$descripcion_grplnk)= mysql_fetch_row($resultado_grplnk)){
													echo "<div class=\"recuadrotox conborde\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grplnk</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_links_farmaco($id_farmaco,$id_grplnk,2);
														echo "</div>\n";
													echo "</div>\n";
												}
											}	
										}

									echo "</div>\n";

								echo "</div>\n";
							
							
							
							echo "</div>\n";
							
							echo "<div class=\"span-23 last\">\n";
										echo "<div class=\"span-12\">\n";
												echo "<p class=\"fomulariosin centrado\">\n";
													echo "<input type=\"hidden\" name=\"id_farmaco\" id=\"id_farmaco\" value=\"$id_farmaco\" />\n";
													echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"ef\" />\n";
													echo "<input type=\"submit\" value=\"Actualizar\"/>\n"; 
												echo "</p>\n";
										echo "</div>\n";
										echo "<div class=\"span-11 last\">\n";
											echo "<p class=\"fomulariosin centrado\">\n";
												echo "<input type=\"button\" value=\"Salir\" onClick='window.location=\"listar_farmacos.php\"'>\n";
											echo "</p>\n";
										echo "</div>\n";
							echo "</div>\n";
							
							
							
							
							echo "<div class=\"span-23 last\">\n";
								echo "<div class=\"recuadroizq conborde\">\n";
									
									echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Toxicidad Farmaco</div>\n";
										echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_fda.php?cop=atf&id_farmaco=".$id_farmaco."')\"></a>\n";
									echo "</div>\n";
									
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_toxicidad,toxicidad,toxicidad_n0 where
											id_farmaco='".$id_farmaco."' and
											farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
											toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0 order by descripcion_toxicidad_n0";
										$resultado_grptx = mysql_query($query_grptx,$connect);
										if ($resultado_grptx){
										$numero_grptx=mysql_num_rows($resultado_grptx);
											if($numero_grptx == 0) {
											} else {
												while(list($id_grptx,$descripcion_grptx)= mysql_fetch_row($resultado_grptx)){
													echo "<div class=\"recuadrotox conborde\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grptx</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_toxicidades_farmaco($id_farmaco,$id_grptx,2);
														//lista_toxicidades_farmaco_nuevo($id_farmaco,$id_grptx);
														//lista_toxicidades_categoria_diana($id_categoria_diana,$id_grptx);
														echo "</div>\n";
													echo "</div>\n";
												}
											}	
										}
		
									
									echo "</div>\n";
								      
								echo "</div>\n";
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
function listar_toxicidades(){
global $connect,$basedatos;
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs_SEL","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies");
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<form  name=\"form_farmacos\">\n";
			echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				$query_farmacos = "select id_farmaco,nombre_farmaco from farmacos order by nombre_farmaco ";	
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_farmacos,$connect);
				if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
				    if($numero_farmacos == 0) {
				    } else {
						while(list($id_farmaco,$nombre_farmaco)= mysql_fetch_row($resultado)){
						echo "<div class=\"span-22\">\n";
							echo "<div class=\"cent conborde clearfix\">";
						lista_toxicidades_farmaco($id_farmaco,2);
							echo "</div>\n";
						echo "</div>\n";
						}
					}		
				}
				echo "</div>\n";	
			echo "</div>\n";
		echo "</form>\n";
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}

function ver_farmaco($id_farmaco){
global $connect,$basedatos;
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs_SEL","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies");include ("inc/headerA.php");
$query_farmacos = "select nombre_farmaco,observaciones_farmaco,clasificacion_toxicidad_farmaco from farmacos where id_farmaco=".$id_farmaco;	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos, $connect);
if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
					if($numero_farmacos == 0) {
					echo "<p class=\"leyenda\">Error No aparece ningun registro</p>\n";
					} else {
					list($nombre_farmaco,$observaciones_farmaco,$clasificacion_toxicidad_farmaco)= mysql_fetch_row($resultado);
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-23 last\">\n";
	      		echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">$nombre_farmaco</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
		  			echo "<div class=\"span-23 last clearfix\">\n";
		 	 			echo "<ul class=\"tabArea\">\n";
							echo "  <li class=\"tabOn\"  id=\"tab1\">General</li>\n";
							echo "  <li class=\"tabOff\" id=\"tab2\">Links</li>\n";
							echo "  <li class=\"tabOff\" id=\"tab3\">Toxicidad</li>\n";
							echo "  <li class=\"tabOff\" id=\"tab4\">Tumor</li>\n";
							echo "  <li class=\"tabOff\" id=\"tab5\">Mas Datos</li>\n";
						echo"</ul>\n";
	     			echo "</div>\n";
				
					echo "<div id=\"tabCont1\" class=\"clearfix\">\n";
						echo "<div class=\"span-22 last\">\n";
							echo "<div class=\"recuadroizq conborde clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Drug Name</div>\n";
										echo "<div class=\"span-10\">$nombre_farmaco</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">More Information</div>\n";
										echo "<div class=\"span-10\">$observaciones_farmaco</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
								echo "</ul>\n";
							echo "</div>\n";
						echo "<div class=\"recuadroizq conborde clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Clasification Advers Reaction in Clinical Trials</div>\n";
										echo "<div class=\"span-10\">$clasificacion_toxicidad_farmaco</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
								echo "</ul>\n";
							echo "</div>\n";
						
						echo "</div>\n";
					echo "</div>\n";
						
					echo "<div id=\"tabCont2\" class=\"clearfix\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
							echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Links</div>\n";
							echo "</div>\n";
							echo "<div class=\"cuerporecuadro clearfix\">\n";
								$query_grplnk="select distinct categorias_link.tipo_link,descripcion_tipo_link from categorias_link,farmacos_links where
											id_farmaco='".$id_farmaco."' and
											categorias_link.tipo_link=farmacos_links.tipo_link";
										$resultado_grplnk = mysql_query($query_grplnk,$connect);
										if ($resultado_grplnk){
										$numero_grplnk=mysql_num_rows($resultado_grplnk);
											if($numero_grplnk == 0) {
											} else {
												while(list($id_grplnk,$descripcion_grplnk)= mysql_fetch_row($resultado_grplnk)){
													echo "<div class=\"recuadrotox conborde\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grplnk</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_links_farmaco($id_farmaco,$id_grplnk,1);
														echo "</div>\n";
													echo "</div>\n";
												}
											}	
										}
								
								
								//lista_links_farmaco($id_farmaco,1);
							echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
					
					echo "<div id=\"tabCont3\" class=\"clearfix\">\n";
						
						echo "<div class=\"recuadroizq conborde\">\n";
									
									echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Toxicidad Farmaco</div>\n";
									echo "</div>\n";
									
									echo "<div class=\"cuerporecuadro clearfix\">\n";
										echo "<div class=\"scroll600h\">\n";
									$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_toxicidad,toxicidad,toxicidad_n0 where
											id_farmaco='".$id_farmaco."' and
											farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
											toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0 order by descripcion_toxicidad_n0";
										$resultado_grptx = mysql_query($query_grptx,$connect);
										if ($resultado_grptx){
										$numero_grptx=mysql_num_rows($resultado_grptx);
											if($numero_grptx == 0) {
											} else {
												while(list($id_grptx,$descripcion_grptx)= mysql_fetch_row($resultado_grptx)){
													echo "<div class=\"recuadrotox conborde\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grptx</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_toxicidades_farmaco($id_farmaco,$id_grptx,1);
														//lista_toxicidades_farmaco_nuevo($id_farmaco,$id_grptx);
														//lista_toxicidades_categoria_diana($id_categoria_diana,$id_grptx);
														echo "</div>\n";
													echo "</div>\n";
												}
											}	
										}
		
										echo "</div>\n";
									echo "</div>\n";
								      
						echo "</div>\n";
					echo "</div>\n";
				
					
					
					echo "<div id=\"tabCont4\" class=\"clearfix\">\n";
						echo "<div class=\"recuadroizq conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Tumor</div>\n";
								echo "</div>\n";
								echo "<div class=\"cuerporecuadro clearfix\">\n";
										lista_indicaciones_farmaco($id_farmaco,1);
								echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
					echo "<div id=\"tabCont5\" class=\"clearfix\">\n";
					echo "</div>\n";
				
		
			echo "</div>\n";
		echo "</div>\n";
	echo "</div>\n";
echo "</div>\n";
 }

}

include ("inc/footer_horizontal.php");
echo "<script language=\"JavaScript\" src=\"inc/tabs_farmacos.js\"></script>\n";
}

if (!isset($_GET['cop'])){
$cop="lf";	
}else{
$cop=$_GET['cop'];
}
	
switch($cop) {
default:
listar_farmacos();		   
break;
case "lf":
listar_farmacos();
break;

case "ef":
editar_farmaco($_GET['id_farmaco']);
break;

case "vf":
ver_farmaco($_GET['id_farmaco']);
break;



case "lt":
listar_toxicidades();
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
echo "var destino=\"functions.php?op=deltf&id_farmaco=\" +des1+ \"&id_toxicidad=\" + des2; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_indicacion(des1,des2){\n";
echo "if (confirm(\"�Desea eliminar esta indicacion?\")){\n";
echo "var destino=\"functions.php?op=delif&id_farmaco=\" +des1+ \"&id_indicacion=\" + des2; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_farmaco_fda(des1){\n";
echo "if (confirm(\"�Desea eliminar este farmaco?\")){\n";
echo "var destino=\"functions.php?op=delffda&id_farmaco=\" +des1; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_link(des1){\n";
echo "if (confirm(\"�Desea eliminar este enlace?\")){\n";
echo "var destino=\"functions.php?op=dellkf&id_link=\" +des1; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function ver_farmacos_capa(pmt1){\n";
echo "var id_capa='divFam' + pmt1;\n";
echo "var id_enlace='aFam' + pmt1;\n";
echo "var capa_familia=document.getElementById(id_capa);\n";
echo "var enlace_familia=document.getElementById(id_enlace);\n";
echo "if (enlace_familia.className=='botoncabecera badd'){\n";
echo "enlace_familia.className='botoncabecera bmenos';\n";
echo "}else{\n";
echo "enlace_familia.className='botoncabecera badd';\n";
echo "}\n";
echo "if (capa_familia.style.display=='block'){\n";
echo "capa_familia.style.display='none';\n";
echo "}else{\n";
echo "capa_familia.style.display='block';\n";
echo "}\n";
echo "}\n";
echo "function buscar_texto(){\n";
echo "var texto_busqueda=document.getElementById('search_text').value;\n";
echo "window.location='buscar_fda.php?cop=lm&tf=1&vf=' + texto_busqueda + '&pag=0';\n";
echo "}\n";


echo "//-->\n";
echo "</script>\n";  
?>