<?php
include ("inc/login.php"); 
include ("inc/config.php");
 $id_farmaco=$_GET['id_farmaco'];
	echo "<table class=\"m0\">\n";
			   echo "<tr class=\"cabecera cab_gris\">\n"; 
			      echo "<td>Toxicidad</td>\n";
			      echo "<td>All Grades</td>\n";
			      echo "<td>Grade3/4</td>\n";
			    echo "</tr>\n";
			   $query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,id_categoria, valor_toxicidad from farmacos_toxicidad,toxicidad  where  farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco='".$id_farmaco."' order by nombre_toxicidad";
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
			      			   echo "<tr class=\"$dcolor\">\n";
						      echo "<td>$des_tox</td>\n";
		        			      echo "<td>$txall</td>\n";
			      			      echo "<td>$tx34</td>\n";
			      			   echo "</tr>\n";
			      			   $a = ($dcolor == $dcolor_A ? 1 : 0);
						   }
				     }
			      }			
	echo "</table>\n";				       	  	
?>
