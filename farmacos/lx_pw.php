<?php
include ("inc/login.php"); 
include ("inc/config.php");
	echo "<ul class=\"m0\">\n";
			   /*
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-1 last\">&nbsp;</div>\n";
				  echo "<div class=\"span-14\">Farmaco</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
				*/
				$query_f="(SELECT f_fda_temp.id_pathway,nombre_pathway,pw_activo FROM f_fda_temp,pathways where f_fda_temp.id_pathway=pathways.id_pathway and IdUsuario='".$IdUsuario."')
				UNION
				(SELECT  f_inv_temp.id_pathway,nombre_pathway,pw_activo FROM f_inv_temp,pathways where f_inv_temp.id_pathway=pathways.id_pathway and IdUsuario='".$IdUsuario."')
				order by nombre_pathway";
			  	$lista_f = mysql_query($query_f, $connect);
			      if ($lista_f){
				    $numero_f=mysql_num_rows($lista_f);
				    if($numero_f == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					$grp_indicacion_anterior='0';
						while(list($id_pathway,$nombre_pathway,$pw_activo)= mysql_fetch_row($lista_f)){	
					 	 $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B); 
								echo "<li class=\"$dcolor\">\n";
										if ($pw_activo==1){
										echo "<div class=\"span-0\"><input name=\"chk_pw_".$id_pathway."\" type=\"checkbox\"  id=\"chk_pw_".$id_pathway."\" value=\"1\" checked  onChange=\"cambia_estado_pathway($id_pathway)\"/></div>\n";
										}else{
										echo "<div class=\"span-0\"><input name=\"chk_pw_".$id_pathway."\" type=\"checkbox\"  id=\"chk_pw_".$id_pathway."\" value=\"0\" onChange=\"cambia_estado_pathway($id_pathway)\"/></div>\n";
										}
										echo "<div class=\"span-21 last\">$nombre_pathway</div>\n";
										//echo "<div class=\"span-1 \"><a class=\"blineatabla bbuscar\"  href=\"javascript:abrir_ventana('ventanas_info.php?cop=vf&id_farmaco=".$id_farmaco."')\"></a></div>\n";
										echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
					 	 $a = ($dcolor == $dcolor_A ? 1 : 0);
						}	

						  
				     }
			      }			
	 
			       	  	
?>
