<?php
include ("inc/login.php"); 
include ("inc/config.php");
$cat_farmaco=$_GET['cat_farmaco'];
	echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-6\">Farmaco</div>\n";
			      echo "<div class=\"span-1 last\">&nbsp;</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
			   
			   if ($cat_farmaco==1){
			  /*
select distinct farmacos_indicaciones.id_indicacion,f_fda_temp.id_farmaco,nombre_farmaco,descripcion_indicacion from farmacos_indicaciones,f_fda_temp,farmacos,indicaciones
where 
farmacos_indicaciones.id_indicacion=indicaciones.id_indicacion and
farmacos_indicaciones.id_farmaco=f_fda_temp.id_farmaco and
f_fda_temp.id_farmaco0 farmacos.id_farmaco and 
farmacos_indicaciones.id_farmaco=farmacos.id_farmaco
order by descripcion_indicacion,nombre_farmaco
			
select distinct farmacos_indicaciones.id_indicacion,f_fda_temp.id_farmaco,nombre_farmaco,descripcion_indicacion from farmacos_indicaciones,f_fda_temp,farmacos,indicaciones
where 
farmacos_indicaciones.id_indicacion=indicaciones.id_indicacion and
farmacos_indicaciones.id_farmaco=f_fda_temp.id_farmaco and
f_fda_temp.id_farmaco=farmacos.id_farmaco 
order by descripcion_indicacion,nombre_farmaco
			   
  			   
			   $query_f="select f_fda_temp.id_farmaco,nombre_farmaco
			   from f_fda_temp,farmacos 
			   where f_fda_temp.id_farmaco=farmacos.id_farmaco
			   and IdUsuario='".$IdUsuario."'";
			 	*/ 
				$query_f="select distinct farmacos_indicaciones.id_indicacion,f_fda_temp.id_farmaco,nombre_farmaco,descripcion_indicacion from farmacos_indicaciones,f_fda_temp,farmacos,indicaciones
				where farmacos_indicaciones.id_indicacion=indicaciones.id_indicacion and
				farmacos_indicaciones.id_farmaco=f_fda_temp.id_farmaco and
				f_fda_temp.id_farmaco=farmacos.id_farmaco and
				IdUsuario='".$IdUsuario."' and pw_activo=1
				order by descripcion_indicacion,nombre_farmaco";
			  $lista_f = mysql_query($query_f, $connect);
			      if ($lista_f){
				    $numero_f=mysql_num_rows($lista_f);
				    if($numero_f == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					$grp_indicacion_anterior='0';
					while(list($id_indicacion,$id_farmaco,$nombre_farmaco,$descripcion_indicacion)= mysql_fetch_row($lista_f)){	
					  $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B); 
					  	if ($grp_indicacion_anterior==$id_indicacion){
								echo "<li class=\"$dcolor\">\n";
										echo "<div class=\"span-6\">$nombre_farmaco</div>\n";
										//echo "<div class=\"span-1 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
										echo "<div class=\"span-1 last\"><input name=\"chk_ffda_".$id_farmaco."\" type=\"checkbox\"  id=\"chk_ffda_".$id_farmaco."\" value=\"1\" /></div>\n";
										
										
										echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
						}else{
					 					echo "<li class=\"cabecera cab_turquesa\">\n"; 
											echo "<div class=\"span-7 last\">$descripcion_indicacion</div>\n";
											echo "<div class=\"clear\"></div>\n";
										echo "</li>\n";
										echo "<li class=\"$dcolor\">\n";
										echo "<div class=\"span-6\">$nombre_farmaco</div>\n";
										echo "<div class=\"span-1 last\"><input name=\"chk_ffda_".$id_farmaco."\" type=\"checkbox\"  id=\"chk_ffda_".$id_farmaco."\" value=\"1\" /></div>\n";
										//echo "<div class=\"span-1 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
										echo "<div class=\"clear\"></div>\n";
										echo "</li>\n";
						}
					  
					 $grp_indicacion_anterior=$id_indicacion;
					  $a = ($dcolor == $dcolor_A ? 1 : 0);
					 
					
					}	

						  
				     }
			      }			
			  
			  
			  
			  }
			  if ($cat_farmaco==2){
			   $query_f="select f_inv_temp.id_farmaco,nombre_farmaco,id_categoria_diana,descripcion_categoria_diana
			   from f_inv_temp,farmacos_inv,categorias_dianas
			   where f_inv_temp.id_farmaco=farmacos_inv.id_farmaco and
			   farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana 
			   and IdUsuario='".$IdUsuario."' and pw_activo=1
			   order by  categorias_dianas.id_categoria_diana";
			   $resultado = mysql_query($query_f,$connect);
							if ($resultado){
							$numero_farmacos=mysql_num_rows($resultado);
								if($numero_farmacos == 0) {
								} else {		
						
							$a = 0;
							$dcolor_A = "impar";
							$dcolor_B = "par"; 
							$grp_diana_anterior='0';
							while(list($id_farmaco,$nombre_farmaco,$id_cd,$descripcion_cd,)= mysql_fetch_row($resultado)){
								$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
									if ($grp_diana_anterior==$id_cd){
									echo "<li class=\"$dcolor\">\n";
											echo "<div class=\"span-6\">$nombre_farmaco</div>\n";
											echo "<div class=\"span-1 last\"><input name=\"chk_finv_".$id_farmaco."\" type=\"checkbox\"  id=\"chk_inv_".$id_farmaco."\" value=\"1\" /></div>\n";
											//echo "<div class=\"span-1 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
											echo "<div class=\"clear\"></div>\n";
										echo "</li>\n";
									}else{
										
											echo "<li class=\"cabecera cab_turquesa\">\n"; 
													echo "<div class=\"span-6\">$descripcion_cd</div>\n";
													echo "<div class=\"span-1 last\"><input name=\"chk_fami_".$id_cd."\" type=\"checkbox\"  id=\"chk_fami_".$id_cd."\" value=\"1\" /></div>\n";
													echo "<div class=\"clear\"></div>\n";
												echo "</li>\n";
				
											echo "<li class=\"$dcolor\">\n";
												echo "<div class=\"span-6\">$nombre_farmaco</div>\n";
												echo "<div class=\"span-1 last\"><input name=\"chk_finv_".$id_farmaco."\" type=\"checkbox\"  id=\"chk_inv_".$id_farmaco."\" value=\"1\" /></div>\n";
												//echo "<div class=\"span-1 last\"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vfn&id_farmaco=".$id_farmaco."')\"></a></div>\n";
												echo "<div class=\"clear\"></div>\n";
											echo "</li>\n";
								
									}
									$grp_diana_anterior=$id_cd;
								$a = ($dcolor == $dcolor_A ? 1 : 0);
							}
						
				
				}		//del if resultado de farmacos con common target
				}  // del if numero de farmacos commun target			
		
						  
						  
						  
						  
						  
			  
			  
			  
			  
			  }
			  
		 
	echo "</ul>\n";				       	  	
?>
