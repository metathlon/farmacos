<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");

function listar_farmacos_nuevos($tf,$vf,$pag){
global $connect,$basedatos;
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs_SEL","paginaa1.php"=>"Combinational Studies");
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<form  name=\"form_farmacos\">\n";
			if ($tf==1){
				$query_categorias = "select distinct categorias_dianas.id_categoria_diana,descripcion_categoria_diana 
				from categorias_dianas,farmacos_inv 
				where categorias_dianas.id_categoria_diana=farmacos_inv.categoria_diana 
				and nombre_farmaco like '%".$vf."%'
				order by  categorias_dianas.descripcion_categoria_diana";
				}else{
				$query_categorias = "select distinct categorias_dianas.id_categoria_diana,descripcion_categoria_diana 
				from categorias_dianas,farmacos_inv 
				where categorias_dianas.id_categoria_diana=farmacos_inv.categoria_diana 
				order by  categorias_dianas.descripcion_categoria_diana";	
				$vf='';
				}
			
					
			echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"span-7 prepend-16 last\">\n";
				echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Search</div>\n";
								echo "<div class=\"titulorecuadro\"><input type=\"text\" name=\"search_text\" id=\"search_text\" value=\"$vf\" class=\"span-4\" /></div>\n";
								echo "<a class=\"blineatabla bsearch\" href=\"javascript:buscar_texto()\"></a>\n";
						echo "</div>\n";
				echo "</div>\n";
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
				
				
				
				//$query_categorias = "select distinct categorias_dianas.id_categoria_diana,descripcion_categoria_diana from categorias_dianas,farmacos_inv where  categorias_dianas.id_categoria_diana=farmacos_inv.categoria_diana order by  categorias_dianas.descripcion_categoria_diana";
				$resultado_categorias = mysql_query($query_categorias,$connect);
				if ($resultado_categorias){
				$numero_categorias=mysql_num_rows($resultado_categorias);
				    if($numero_categorias == 0) {
				    } else {
					while(list($id_categoria_diana,$descripcion_categoria_diana)= mysql_fetch_row($resultado_categorias)){
				echo "<li class=\"cabecera cab_turquesa clearfix\">\n"; 
				echo "<div class=\"span-20\">$descripcion_categoria_diana</div>\n";
				echo "<div class=\"span-1\">&nbsp;</div>\n";
				echo "<div class=\"span-0\">&nbsp;</div>\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"categorias.php?cop=ecd&id_categoria_diana=".$id_categoria_diana."\"></a></div>\n";
				echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				
				if ($tf==1){
				$query_farmacos = "select id_farmaco,nombre_farmaco,autores,categoria_diana,tx1desc,tx2desc,comentarios,tipo_ensayo 
				from farmacos_inv where categoria_diana='".$id_categoria_diana."' and  nombre_farmaco like '%".$vf."%' order by  nombre_farmaco";	
				}else{
				$query_farmacos = "select id_farmaco,nombre_farmaco,autores,categoria_diana,tx1desc,tx2desc,comentarios,tipo_ensayo 
				from farmacos_inv where categoria_diana='".$id_categoria_diana."' order by nombre_farmaco";
				}
					
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_farmacos,$connect);
				
				
				
				if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
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


function listar_toxicidad_farmacos_nuevos($tf,$vf,$pag){
global $connect,$basedatos;
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs_SEL","paginaa1.php"=>"Combinational Studies");
$array_0_1=array("","<img class=\"blineatabla bok\" />");
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<form  name=\"form_farmacos\">\n";
				$query_categorias = "select distinct categorias_dianas.id_categoria_diana,descripcion_categoria_diana 
				from categorias_dianas,farmacos_inv,farmacos_inv_toxicidad
				where categorias_dianas.id_categoria_diana=farmacos_inv.categoria_diana 
				and farmacos_inv.id_farmaco=farmacos_inv_toxicidad.id_farmaco
				and id_toxicidad='".$vf."' order by  categorias_dianas.descripcion_categoria_diana";
			
			echo "<div class=\"span-23 last\">\n";
			echo "<div class=\"span-14 \">\n";;
				echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
								echo "<div class=\"titulorecuadro\">Search</div>\n";
								echo "<div class=\"titulorecuadro\">\n";
								echo "<select name=\"search_toxicidad\" id=\"search_toxicidad\" class=\"span-9\" onChange=filtrar_toxicidad()>\n";        
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
											while(list($id_toxicidad_t,$id_grp_tx,$nombre_toxicidad_t,$descripcion_grp_tx)= mysql_fetch_row($lista_toxicidades_todas)){
											//while(list($id_toxicidad_t,$nombre_toxicidad_t)= mysql_fetch_row($lista_toxicidades_todas)){ 	
												if ($id_toxicidad_t==$vf){
												$sel = "selected";
												}else{
												$sel = "";
												}	
												
												if ($grptx_anterior==$id_grp_tx){
                                                	
												 echo "<option $sel value=\"$id_toxicidad_t\">$nombre_toxicidad_t</option>\n";	
													                                     
                                                 }else{
                                                    if ($grptx_anterior=='0'){
                                                    echo "<optgroup label=\"$descripcion_grp_tx\">\n";
                                                    }else{
                                                    echo "</optgroup>\n";
                                                    echo "<optgroup label=\"$descripcion_grp_tx\">\n";
                                                    }
                                                   
													echo "<option $sel value=\"$id_toxicidad_t\">$nombre_toxicidad_t</option>\n";	
										
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
								
								
								echo"</div>\n";
								//echo "<a class=\"blineatabla bsearch\" href=\"javascript:filtrar_toxicidad()\"></a>\n";
						echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";			
			echo "<div class=\"span-3\">\n";
				echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
								//echo "<div class=\"titulorecuadro\">View PDF</div>\n";
								echo "<a class=\"titulorecuadro\" href=\"javascript:abrir_ventana('imprimir_far_tox.php?vf=".$vf."')\">View PDF</a>\n";
								echo "<a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('imprimir_far_tox.php?vf=".$vf."')\"></a>\n";
						echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
			echo "<div class=\"span-5 prepend-1 last\">\n";
				echo "<div class=\"recuadroizq conborde\">\n";
						echo "<div class=\"cabecerarecuadro clearfix\">\n";
								//echo "<div class=\"titulorecuadro\">View PDF</div>\n";
								echo "<a class=\"titulorecuadro\" href=\"farmacos_nuevos.php\">Investigational Drugs</a>\n";
						echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
			
			
			echo "</div>\n";
			echo "<div class=\"span-23 last\">\n";
				
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-8\">Nombre</div>\n";
						echo "<div class=\"span-6\">AEs=>10%</div>\n";
						echo "<div class=\"span-6\">Grade=>3</div>\n";
						echo "<div class=\"span-1\">&nbsp;</div>\n";
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				
				
				//$query_categorias = "select distinct categorias_dianas.id_categoria_diana,descripcion_categoria_diana from categorias_dianas,farmacos_inv where  categorias_dianas.id_categoria_diana=farmacos_inv.categoria_diana order by  categorias_dianas.descripcion_categoria_diana";
				$resultado_categorias = mysql_query($query_categorias,$connect);
				if ($resultado_categorias){
				$numero_categorias=mysql_num_rows($resultado_categorias);
				    if($numero_categorias == 0) {
				    } else {
					while(list($id_categoria_diana,$descripcion_categoria_diana)= mysql_fetch_row($resultado_categorias)){
				echo "<li class=\"cabecera cab_turquesa clearfix\">\n"; 
				echo "<div class=\"span-20\">$descripcion_categoria_diana</div>\n";
				echo "<div class=\"span-1\">&nbsp;</div>\n";
				echo "<div class=\"span-0\">&nbsp;</div>\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"categorias.php?cop=ecd&id_categoria_diana=".$id_categoria_diana."\"></a></div>\n";
				echo "<div class=\"clear\"></div>\n";
				echo "</li>\n";
				
				
				$query_farmacos = "select farmacos_inv.id_farmaco,nombre_farmaco,tx1,tx2
				from farmacos_inv,farmacos_inv_toxicidad where 
				farmacos_inv.id_farmaco=farmacos_inv_toxicidad.id_farmaco
				and categoria_diana='".$id_categoria_diana."' and  
				id_toxicidad='".$vf."' order by  nombre_farmaco";	
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_farmacos,$connect);
				
				//echo $query_farmacos;
				
				if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
				    if($numero_farmacos == 0) {
				    } else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_farmaco,$nombre_farmaco,$tx1,$tx2)= mysql_fetch_row($resultado)){
						$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-8\">$nombre_farmaco</div>\n";
								echo "<div class=\"span-6\">$array_0_1[$tx1]</div>\n";
								echo "<div class=\"span-6\">$array_0_1[$tx2]</div>\n";
								echo "<div class=\"span-1\">&nbsp;</div>\n";
								echo "<div class=\"span-0\">&nbsp;</div>\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bbuscar\" href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
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
listar_farmacos_nuevos($tf,$vf,$pag);		   
break;
case "lfn":
listar_farmacos_nuevos($tf,$vf,$pag);
break;
case "ltfn":
listar_toxicidad_farmacos_nuevos($tf,$vf,$pag);
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