<?php
include ("inc/login.php"); 
include ("inc/config.php");
 $id_farmaco=$_GET['id_farmaco'];
	echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-1\">All Grd</div>\n";
			      echo "<div class=\"span-1 last\">Grd 3/4</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
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
							echo "<li class=\"cabecera cab_turquesa\">\n"; 
										echo "<div class=\"span-6 last\">$descripcion_grptx</div>\n";
										echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
			   $query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,id_categoria, valor_toxicidad 
			   from farmacos_toxicidad,toxicidad  
			   where  farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad 
			   and id_farmaco=$id_farmaco and id_toxicidad_n0='".$id_grptx."' order by nombre_toxicidad asc";
			   $lista_toxicidades = mysql_query($query_toxicidades, $connect);
			      if ($lista_toxicidades){
				    $numero_toxicidades=mysql_num_rows($lista_toxicidades);
				    if($numero_toxicidades == 0) {
				    } else {
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

						$a = 0;
			   			$dcolor_A = "impar";
			  			$dcolor_B = "par"; 
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
						   
						   
						   
						   //while(list($nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){
			      			   $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			      			   echo "<li class=\"$dcolor\">\n";
						      echo "<div class=\"span-4\">$des_tox</div>\n";
		        			      echo "<div class=\"span-1\">$txall</div>\n";
			      			      echo "<div class=\"span-1 last\">$tx34</div>\n";
						      echo "<div class=\"clear\"></div>\n";
			      			   echo "</li>\n";
			      			   $a = ($dcolor == $dcolor_A ? 1 : 0);
						   }
				     }
			      }			
				}
			}	
		}
	
	
	echo "</ul>\n";				       	  	
?>
