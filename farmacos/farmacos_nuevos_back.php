<?php
include ("inc/login.php"); 
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


function lista_toxicidades_farmaco_nuevo($farmaco_id,$id_tox_n0,$nivel){
global $basedatos,$connect;	

	$query_toxicidades="select nombre_toxicidad,tx1,tx2,toxicidad.id_toxicidad from farmacos_inv_toxicidad,toxicidad  where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco='".$farmaco_id."' and id_toxicidad_n0='".$id_tox_n0."'";
		//$query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,
		//id_categoria,valor_toxicidad from farmacos_toxicidad,toxicidad  where farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=".$farmaco_id;
		$lista_toxicidades = mysql_query($query_toxicidades, $connect);
		if ($lista_toxicidades){
		$numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
			//repartirlo en 3 columnas
			
			$resto=$numero_toxicidades%3;
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
			$filas_col1=($numero_toxicidades-$resto)/3 + $ad1;
			$filas_col2=($numero_toxicidades-$resto)/3+ $ad2;
			$filas_col3=($numero_toxicidades-$resto)/3;

		$a = 0;
		$dcolor_A = "impar";
		$dcolor_B = "par"; 
		$cfilas=1;
		$ccolumnas=1;
		$fin_tabla=$filas_col1;
		$array_0_1=array("","<img class=\"blineatabla bok\" />");
		while(list($nombre_toxicidad,$tx1,$tx2,$id_toxicidad)= mysql_fetch_row($lista_toxicidades)){ 	
		
		if	($cfilas==1){
		if ($nivel > 1){
		echo "<div class=\"span-7\">\n";
		}else{
		echo "<div class=\"span-6\">\n";
		}
		
		echo "<ul class=\"m0\">\n";
			echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			echo "<div class=\"span-3\">Toxicidad</div>\n";
			echo "<div class=\"span-1\">AE =>10</div>\n";
			echo "<div class=\"span-1 last\">Gr =>3</div>\n";
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
				echo "<div class=\"span-3\">".$nombre_toxicidad."</div>\n";
				echo "<div class=\"span-1\">".$array_0_1[$tx1]."</div>\n";
				echo "<div class=\"span-1 last\">".$array_0_1[$tx2]."</div>\n";
				if ($nivel > 1){
				echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_toxicidad('".$farmaco_id."','".$id_toxicidad."')\"></a></div>\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_inv.php?cop=etfn&id_farmaco=".$farmaco_id."&id_toxicidad=".$id_toxicidad."')\"></a></div>\n";
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
function lista_dianas_farmaco_nuevo($farmaco_id,$nivel){
global $basedatos,$connect;	
	
	$query_dianas= "select farmacos_inv_diana.id_diana,descripcion_diana,valor_diana,dianas.id_diana_n0,descripcion_diana_n0
	from farmacos_inv_diana,dianas,dianas_n0 
	where farmacos_inv_diana.id_diana=dianas.id_diana 
	and dianas.id_diana_n0=dianas_n0.id_diana_n0
	and id_farmaco='".$farmaco_id."' order by descripcion_diana_n0,descripcion_diana";
	$lista_dianas = mysql_query($query_dianas, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-6\">Target</div>\n";
		echo "<div class=\"span-2\"></div>\n";
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
				while(list($id_diana,$descripcion_diana,$valor_diana,$id_diana_n0,$descripcion_diana_n0)= mysql_fetch_row($lista_dianas)){
					if ($grp_diana_n0_anterior==$id_diana_n0){
						echo "<li class=\"par\">\n";
						echo "<div class=\"span-6\">".$descripcion_diana."</div>\n";
						echo "<div class=\"span-2\">".$valor_diana."</div>\n";
							if ($nivel > 1){
							echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_diana('".$farmaco_id."','".$id_diana."')\"></a></div>\n";
							echo "<div class=\"span-0 last\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_inv.php?cop=ediafn&id_farmaco=".$farmaco_id."&id_diana=".$id_diana."')\"></a></div>\n";
							}
						echo "<div class=\"clear\"></div>\n";
						echo "</li>\n";
					}else{
						echo "<li class=\"cabecera cab_turquesa\">\n"; 
							echo "<div class=\"span-8\">$descripcion_diana_n0</div>\n";
							echo "<div class=\"span-0 last\">&nbsp;</div>\n";
							echo "<div class=\"clear\"></div>\n";
						echo "</li>\n";
				
				
						echo "<li class=\"par\">\n";
							echo "<div class=\"span-6\">".$descripcion_diana."</div>\n";
							echo "<div class=\"span-2\">".$valor_diana."</div>\n";
								if ($nivel > 1){
								echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_diana('".$farmaco_id."','".$id_diana."')\"></a></div>\n";
								echo "<div class=\"span-0 last\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_inv.php?cop=ediafn&id_farmaco=".$farmaco_id."&id_diana=".$id_diana."')\"></a></div>\n";
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

function lista_links_farmaco_nuevo($farmaco_id,$tipo_link,$nivel){
global $basedatos,$connect;	
	
$query_links= "select id_link,descripcion_link,url_link,tipo_link from farmacos_inv_link where id_farmaco='".$farmaco_id."' and tipo_link='".$tipo_link."'";
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
				echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_inv.php?cop=elkfn&id_link=".$id_link."')\"></a></div>\n";
				}
				echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
			
			}
		echo "</ul>\n";
		}			
	}

}
function lista_pathways_farmaco($id_farmaco,$GeneId,$nivel){
global $basedatos,$connect;	

$query_pathways= "select farmacos_inv_pathways.id_pathway,nombre_pathway,id_external from farmacos_inv_pathways,pathways where farmacos_inv_pathways.id_pathway=pathways.id_pathway and id_farmaco='".$id_farmaco."'";
$lista_pathways = mysql_query($query_pathways, $connect);
	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-8\">Pathway</div>\n";
		echo "<div class=\"span-0\"></div>\n";
		if ($nivel > 1){
		echo "<div class=\"span-0\"></div>\n";
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
							
			if ($GeneId==0){
			$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;
			}else{
			$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external."?Sel=geneid:".$GeneId."#show=genes";
			
			}
			
				echo "<li class=\"$dcolor\">\n";
					echo "<div class=\"span-8\">".$nombre_pathway."</div>\n";
					echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$link_pathway."')\"></a></div>\n";
						if ($nivel > 1){
						echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_pathway('".$id_farmaco."','".$id_pathway."')\"></a></div>\n";
						
					}
					echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}			
	}
	echo "</ul>\n";

}

function listar_farmacos_nuevos(){
global $connect,$basedatos;
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs_SEL","paginaa1.php"=>"Combinational Studies");
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<form  name=\"form_farmacos\">\n";
			echo "<div class=\"span-23 last\">\n";
			echo "<div class=\"span-14 \">\n";
				echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Search by Toxicity</div>\n";
								echo "<div class=\"titulorecuadro\">\n";
								echo "<select name=\"search_toxicidad\" id=\"search_toxicidad\" class=\"span-9\">\n";        
							 	$query_toxicidades_todas="select id_toxicidad,toxicidad.id_toxicidad_n0,nombre_toxicidad,descripcion_toxicidad_n0
                                                             from toxicidad,toxicidad_n0 where
                                                             toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0 order by descripcion_toxicidad_n0,nombre_toxicidad";
								
								//$query_toxicidades_todas="select id_toxicidad,nombre_toxicidad from toxicidad order by nombre_toxicidad";
								$lista_toxicidades_todas = mysql_query($query_toxicidades_todas, $connect);
								if ($lista_toxicidades_todas){
									$numero_toxicidades_todas=mysql_num_rows($lista_toxicidades_todas);
										if($numero_toxicidades_todas == 0) {
										} else {
											$grptx_anterior='0';
											echo "<option value=\"0\"></option>\n";
											while(list($id_toxicidad_t,$id_grp_tx,$nombre_toxicidad_t,$descripcion_grp_tx)= mysql_fetch_row($lista_toxicidades_todas)){
											//while(list($id_toxicidad_t,$nombre_toxicidad_t)= mysql_fetch_row($lista_toxicidades_todas)){ 	
													
												if ($grptx_anterior==$id_grp_tx){
                                                echo "<option value=\"$id_toxicidad_t\">$nombre_toxicidad_t</option>\n";	
													                                     
                                                 }else{
                                                    if ($grptx_anterior=='0'){
                                                    echo "<optgroup label=\"$descripcion_grp_tx\">\n";
                                                    }else{
                                                    echo "</optgroup>\n";
                                                    echo "<optgroup label=\"$descripcion_grp_tx\">\n";
                                                    }
                                                   
													echo "<option value=\"$id_toxicidad_t\">$nombre_toxicidad_t</option>\n";	
										
                                                  }
                                               $grptx_anterior=$id_grp_tx;
													/*
													if (!in_array($id_toxicidad_t,$array_toxicidades_farmaco)){
													echo "<option value=\"$id_toxicidad_t\">$nombre_toxicidad_t</option>\n";	
													}
											        */
											}  
										}
								}    	
					echo "</select>\n";	
					echo "</div>\n";
								echo "<a class=\"blineatabla bsearch\" href=\"javascript:filtrar_toxicidad()\"></a>\n";
						echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
			echo "<div class=\"span-9 last\">\n";
				echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Search by Name</div>\n";
								echo "<div class=\"titulorecuadro\"><input type=\"text\" name=\"search_text\" id=\"search_text\" value=\"\" class=\"span-4\" /></div>\n";
								echo "<a class=\"blineatabla bsearch\" href=\"javascript:buscar_texto()\"></a>\n";
						echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
			echo "</div>\n";	
			echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado Farmacos Nuevos</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana('ventanas_inv.php?cop=afn')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-5\">Nombre</div>\n";
						echo "<div class=\"span-3\">Author</div>\n";
						echo "<div class=\"span-6\">AEs=>10%</div>\n";
						echo "<div class=\"span-6\">Grade=>3</div>\n";
						echo "<div class=\"span-1\">&nbsp;</div>\n";
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$query_categorias = "select distinct categorias_dianas.id_categoria_diana,descripcion_categoria_diana from categorias_dianas,farmacos_inv where  categorias_dianas.id_categoria_diana=farmacos_inv.categoria_diana order by  categorias_dianas.descripcion_categoria_diana";
				$resultado_categorias = mysql_query($query_categorias,$connect);
				if ($resultado_categorias){
				$numero_categorias=mysql_num_rows($resultado_categorias);
				    if($numero_categorias == 0) {
				    } else {
					while(list($id_categoria_diana,$descripcion_categoria_diana)= mysql_fetch_row($resultado_categorias)){
				echo "<li class=\"cabecera cab_turquesa clearfix\">\n"; 
				echo "<div class=\"span-0\"><a id=\"aFam".$id_categoria_diana."\" class=\"botoncabecera badd\" href=\"javascript:ver_farmacos_capa('".$id_categoria_diana."')\"></a></div>\n";
				echo "<div class=\"span-20\">$descripcion_categoria_diana</div>\n";
				echo "<div class=\"span-1\">&nbsp;</div>\n";
				
				echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"categorias.php?cop=ecd&id_categoria_diana=".$id_categoria_diana."\"></a></div>\n";
				echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				$query_farmacos = "select id_farmaco,nombre_farmaco,autores,categoria_diana,tx1desc,tx2desc,comentarios,tipo_ensayo from farmacos_inv where categoria_diana='".$id_categoria_diana."' order by  nombre_farmaco";	
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_farmacos,$connect);
				
				
				
				if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
				 echo "<div id=\"divFam".$id_categoria_diana."\"  class=\"oculto\">\n";
					if($numero_farmacos == 0) {
				    } else {
					
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_farmaco,$nombre_farmaco,$autores,$categoria_diana,$tx1desc,$tx2desc,$comentarios,$tipo_ensayo)= mysql_fetch_row($resultado)){
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-5\">$nombre_farmaco</div>\n";
								echo "<div class=\"span-3\">$autores</div>\n";
								echo "<div class=\"span-6\">$tx1desc</div>\n";
								echo "<div class=\"span-6\">$tx2desc</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_farmaco('".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"farmacos_nuevos.php?cop=efn&id_farmaco=".$id_farmaco."\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					
						
					
					}		
		
				echo "</div>\n";
				
				}
					 
				
					} //del while categorias
				}//del if numero_categorias
				} // del if resultado_categorias
				
				
				echo "</ul>\n";	
				
				//fin de categorias
				
				echo "</div>\n";	
			
			
			
			
			echo "</div>\n";
		echo "</form>\n";
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}

function editar_farmaco_nuevo($id_farmaco){
global $connect,$basedatos;
$query_farmacos = "select nombre_farmaco,autores,categoria_diana,tx1desc,tx2desc,comentarios,tipo_ensayo,celular_process from farmacos_inv where id_farmaco=".$id_farmaco;	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos, $connect);
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs_SEL","paginaa1.php"=>"Combinational Studies");
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
						list($nombre_farmaco,$autores,$categoria_diana,$tx1desc,$tx2desc,$comentarios,$tipo_ensayo,$celular_process)= mysql_fetch_row($resultado);
						echo "<form action=\"functions.php\" method=\"post\" name=\"form_farmacos\">\n";
							echo "<div class=\"cuerpo1\">\n";
							echo "<div class=\"span-12\">\n";
								echo "<div class=\"izq\">\n";
									echo "<div class=\"izq conborde clearfix\">\n";
									echo "<p class=\"formulario\">\n";
										echo "<label for \"nombre_farmaco\" class=\"span-3\">Nombre</label>\n";
										echo "<input type=\"text\" name=\"nombre_farmaco\" id=\nombre_farmaco\" value=\"$nombre_farmaco\" class=\"span-8\" />\n";
									echo "</p>\n";
									echo "<p class=\"formulario\">\n";
										echo "<label for \"autores\" class=\"span-3\">Auhors</label>\n";
										echo "<input type=\"text\" name=\"autores\" id=\"autores\" value=\"$autores\" class=\"span-8\" />\n";
									echo "</p>\n";
									echo "<p class=\"formulario\">\n";
										echo "<label for \"categoria_diana\" class=\"span-3\">Family</label>\n";
										echo "<select name=\"categoria_diana\" id=\"categoria_diana\" class=\"span-7\">\n";        
							 				$query_categorias = "select id_categoria_diana,descripcion_categoria_diana from categorias_dianas order by  id_categoria_diana";
											$resultado_categorias = mysql_query($query_categorias,$connect);
												if ($resultado_categorias){
												$numero_categorias=mysql_num_rows($resultado_categorias);
				    								if($numero_categorias == 0) {
				   									} else {
														while(list($id_categoria_diana,$descripcion_categoria_diana)= mysql_fetch_row($resultado_categorias)){
															if ($id_categoria_diana==$categoria_diana){
															$sel = "selected";
															}else{
															$sel = "";
															}
														echo "<option $sel value=\"$id_categoria_diana\">$descripcion_categoria_diana</option>\n";	
														
														}  
													}
												}    	
										echo "</select>\n";	
									echo "</p>\n";
									echo "<p class=\"formulario\">\n";
										echo "<label for \"tipo_ensayo\" class=\"span-3\">Tipo Ensayo</label>\n";
										echo "<input type=\"text\" name=\"tipo_ensayo\" id=\"tipo_ensayo\" value=\"$tipo_ensayo\" class=\"span-8\" />\n";
									echo "</p>\n";
									echo "<p class=\"formulario\">\n";
										echo "<label for \"celular_process\" class=\"span-3\">Process</label>\n";
										echo "<input type=\"text\" name=\"celular_process\" value=\"$celular_process\" class=\"span-8\" />\n";
									echo "</p>\n";
									echo "<p class=\"fomulariosin\">\n";
									echo "<label for \"comentarios\" class=\"span-3\">Comentarios</label>\n";
									echo "<textarea name=\"comentarios\"  id=\"comentarios\" class=\"span-8\">$comentarios</textarea>\n";
									echo "</p>\n";
									echo "</div>\n";
									echo "<div class=\"izq conborde clearfix\">\n";
									echo "<p class=\"leyenda\">related adverse events (AEs) reported in =>10%</p>\n";
									echo "<textarea name=\"tx1desc\" id=\"tx1desc\" class=\"span-10\">$tx1desc</textarea>\n";
									echo "</div>\n";	
									echo "<div class=\"izq conborde clearfix\">\n";
									echo "<p class=\"leyenda\">drug-related AEs => Gr 3</p>\n";
									echo "<textarea name=\"tx2desc\" id=\"tx2desc\" class=\"span-10\">$tx2desc</textarea>\n";
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
										echo "<div class=\"titulorecuadro\">Targets</div>\n";
										echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_inv.php?cop=adiafn&id_farmaco=".$id_farmaco."')\"></a>\n";
									echo "</div>\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
										lista_dianas_farmaco_nuevo($id_farmaco,2);
									echo "</div>\n";

								echo "</div>\n";
								echo "<div class=\"recuadrodcha conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Pathways</div>\n";
										echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana600('ventanas_inv.php?cop=apfn&id_farmaco=".$id_farmaco."')\"></a>\n";
									echo "</div>\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									lista_pathways_farmaco($id_farmaco,0,2);
									echo "</div>\n";

								echo "</div>\n";
							
							
							
							
							echo "<div class=\"recuadrodcha conborde\">\n";
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Links</div>\n";
										echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_inv.php?cop=alkfn&id_farmaco=".$id_farmaco."')\"></a>\n";
									echo "</div>\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									$query_grplnk="select distinct categorias_link.tipo_link,descripcion_tipo_link from categorias_link,farmacos_inv_link where
											id_farmaco='".$id_farmaco."' and
											categorias_link.tipo_link=farmacos_inv_link.tipo_link";
										$resultado_grplnk = mysql_query($query_grplnk,$connect);
										if ($resultado_grplnk){
										$numero_grplnk=mysql_num_rows($resultado_grplnk);
											if($numero_grplnk == 0) {
											} else {
												while(list($id_grplnk,$descripcion_grplnk)= mysql_fetch_row($resultado_grplnk)){
													echo "<div class=\"recuadrotox conborde\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grplnk</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_links_farmaco_nuevo($id_farmaco,$id_grplnk,2);
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
													echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"efn\" />\n";
													echo "<input type=\"submit\" value=\"Actualizar\"/>\n"; 
												echo "</p>\n";
										echo "</div>\n";
										echo "<div class=\"span-11 last\">\n";
											echo "<p class=\"fomulariosin centrado\">\n";
												echo "<input type=\"button\" value=\"Salir\" onClick='window.location=\"farmacos_nuevos.php\"'>\n";
											echo "</p>\n";
										echo "</div>\n";
							echo "</div>\n";
							echo "<div class=\"span-23 last\">\n";
								echo "<div class=\"recuadroizq conborde\">\n";
									
									echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Toxicidad Farmaco</div>\n";
										echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_inv.php?cop=atfn&id_farmaco=".$id_farmaco."')\"></a>\n";
									echo "</div>\n";
									
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_inv_toxicidad,toxicidad,toxicidad_n0 where
											id_farmaco='".$id_farmaco."' and
											farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
											toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0 order by descripcion_toxicidad_n0 ";
										$resultado_grptx = mysql_query($query_grptx,$connect);
										if ($resultado_grptx){
										$numero_grptx=mysql_num_rows($resultado_grptx);
											if($numero_grptx == 0) {
											} else {
												while(list($id_grptx,$descripcion_grptx)= mysql_fetch_row($resultado_grptx)){
													echo "<div class=\"recuadrotox conborde\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grptx</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_toxicidades_farmaco_nuevo($id_farmaco,$id_grptx,2);
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
function ver_farmaco_nuevo($id_farmaco){
global $connect,$basedatos;
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs_SEL","paginaa1.php"=>"Combinational Studies");
include ("inc/headerA.php");
$query_farmacos = "select nombre_farmaco,autores,descripcion_categoria_diana,tx1desc,tx2desc,comentarios,tipo_ensayo from farmacos_inv,categorias_dianas where  farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana and id_farmaco=".$id_farmaco;	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_farmacos, $connect);
if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
					if($numero_farmacos == 0) {
					echo "<p class=\"leyenda\">Error No aparece ningun registro</p>\n";
					} else {
					list($nombre_farmaco,$autores,$categoria_diana,$tx1desc,$tx2desc,$comentarios,$tipo_ensayo)= mysql_fetch_row($resultado);
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
							echo "  <li class=\"tabOff\" id=\"tab4\">Targets</li>\n";
							echo "  <li class=\"tabOff\" id=\"tab5\">Pathways</li>\n";
						echo"</ul>\n";
	     			echo "</div>\n";
				
					echo "<div id=\"tabCont1\" class=\"clearfix\">\n";
						echo "<div class=\"span-22 last\">\n";
							echo "<div class=\"recuadroizq conborde clearfix\">\n";
								echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Drug Name</div>\n";
										echo "<div class=\"span-8\">$nombre_farmaco</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Auhors</div>\n";
										echo "<div class=\"span-8\">$autores</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Drug Family</div>\n";
										echo "<div class=\"span-8\">$categoria_diana</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Type of Clinical Trial</div>\n";
										echo "<div class=\"span-8\">$tipo_ensayo</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-4 cab_fila\">Copments</div>\n";
										echo "<div class=\"span-8\">$comentarios</div>\n";
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
								$query_grplnk="select distinct categorias_link.tipo_link,descripcion_tipo_link from categorias_link,farmacos_inv_link where
											id_farmaco='".$id_farmaco."' and
											categorias_link.tipo_link=farmacos_inv_link.tipo_link";
										$resultado_grplnk = mysql_query($query_grplnk,$connect);
										if ($resultado_grplnk){
										$numero_grplnk=mysql_num_rows($resultado_grplnk);
											if($numero_grplnk == 0) {
											} else {
												while(list($id_grplnk,$descripcion_grplnk)= mysql_fetch_row($resultado_grplnk)){
													echo "<div class=\"recuadrotox conborde\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grplnk</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_links_farmaco_nuevo($id_farmaco,$id_grplnk,1);
														echo "</div>\n";
													echo "</div>\n";
												}
											}	
										}
	
								//lista_links_farmaco_nuevo($id_farmaco,1);
							echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
					echo "<div id=\"tabCont3\" class=\"clearfix\">\n";
		
						echo "<div class=\"recuadroizq conborde clearfix\">\n";
							echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-8 cab_fila\">related adverse events (AEs) reported in =>10%</div>\n";
										echo "<div class=\"span-12\">$tx1desc</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
									echo "</ul>\n";
							echo "</div>\n";				
						echo "<div class=\"recuadroizq conborde clearfix\">\n";
							echo "<ul class=\"m0\">\n";
									echo "<li class=\"par\">\n"; 
										echo "<div class=\"span-8 cab_fila\">drug-related AEs => Gr 3</div>\n";
										echo "<div class=\"span-12\">$tx2desc</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";	
									echo "</ul>\n";
							echo "</div>\n";
						
						echo "<div class=\"recuadroizq conborde\">\n";
									echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Toxicidad Farmaco</div>\n";
									echo "</div>\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
									echo "<div class=\"scroll200h\">\n";
									$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_inv_toxicidad,toxicidad,toxicidad_n0 where
											id_farmaco='".$id_farmaco."' and
											farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
											toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0";
										$resultado_grptx = mysql_query($query_grptx,$connect);
										if ($resultado_grptx){
										$numero_grptx=mysql_num_rows($resultado_grptx);
											if($numero_grptx == 0) {
											} else {
												while(list($id_grptx,$descripcion_grptx)= mysql_fetch_row($resultado_grptx)){
													echo "<div class=\"recuadrotox conborde\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grptx</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_toxicidades_farmaco_nuevo($id_farmaco,$id_grptx,1);
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
										echo "<div class=\"titulorecuadro\">Targets</div>\n";
								echo "</div>\n";
								echo "<div class=\"cuerporecuadro clearfix\">\n";
										lista_dianas_farmaco_nuevo($id_farmaco,1);
								echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
					echo "<div id=\"tabCont5\" class=\"clearfix\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
							echo "<div class=\"titulorecuadro\">Pathways</div>\n";
						echo "</div>\n";
						echo "<div class=\"cuerporecuadro clearfix\">\n";
							lista_pathways_farmaco($id_farmaco,0,1);
						echo "</div>\n";
					
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
$cop="lfn";	
}else{
$cop=$_GET['cop'];
}
	
switch($cop) {
default:
listar_farmacos_nuevos();		   
break;
case "lfn":
listar_farmacos_nuevos();
break;

case "efn":
editar_farmaco_nuevo($_GET['id_farmaco']);
break;
case "vfn":
ver_farmaco_nuevo($_GET['id_farmaco']);
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
echo "function abrir_ventana600(a){\n";
echo "window.open (a,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=500\");\n";
echo "}\n";
echo "function aviso_borrar_toxicidad(des1,des2){\n";
echo "if (confirm(\"¿Desea eliminar esta toxicidad?\")){\n";
echo "var destino=\"functions.php?op=deltfn&id_farmaco=\" +des1+ \"&id_toxicidad=\" + des2; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_diana(des1,des2){\n";
echo "if (confirm(\"¿Desea eliminar esta diana?\")){\n";
echo "var destino=\"functions.php?op=deldiafn&id_farmaco=\" +des1+ \"&id_diana=\" + des2; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_farmaco(des1){\n";
echo "if (confirm(\"¿Desea eliminar este farmaco?\")){\n";
echo "var destino=\"functions.php?op=delfn&id_farmaco=\" +des1; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_link(des1){\n";
echo "if (confirm(\"¿Desea eliminar este enlace?\")){\n";
echo "var destino=\"functions.php?op=dellkfn&id_link=\" +des1; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "function aviso_borrar_pathway(des1,des2){\n";
echo "if (confirm(\"¿Desea eliminar este pathway?\")){\n";
echo "var destino=\"functions.php?op=delpfn&id_farmaco=\" +des1+ \"&id_pathway=\" + des2; \n";
echo "window.open (destino,\"mutaciones1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
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
echo "window.location='buscar_inv.php?cop=lfn&tf=1&vf=' + texto_busqueda + '&pag=0';\n";
echo "}\n";
echo "function filtrar_toxicidad(){\n";
echo "var texto_busqueda=document.getElementById('search_toxicidad').value;\n";
echo "window.location='buscar_inv.php?cop=ltfn&tf=1&vf=' + texto_busqueda + '&pag=0';\n";
echo "}\n";

echo "//-->\n";
echo "</script>\n";  
?>