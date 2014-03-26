<?php
include ("inc/login.php"); 
include ("inc/config.php");
 $id_indicacion=$_GET['id_farmaco'];
	echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-5\">Farmaco</div>\n";
			      echo "<div class=\"span-1 last\">::</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
			   $query_indicaciones="select farmacos_indicaciones.id_farmaco,nombre_farmaco,testado from farmacos_indicaciones,farmacos where farmacos_indicaciones.id_farmaco=farmacos.id_farmaco and id_indicacion='".$id_indicacion."' order by nombre_farmaco";
			   $lista_indicaciones = mysql_query($query_indicaciones, $connect);
			      if ($lista_indicaciones){
				    $numero_indicaciones=mysql_num_rows($lista_indicaciones);
				    if($numero_indicaciones == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					while(list($id_farmaco,$nombre_farmaco,$testado)= mysql_fetch_row($lista_indicaciones)){	
					  $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B); 
					  echo "<li class=\"$dcolor\">\n";
					  echo "<div class=\"span-5\">$nombre_farmaco</div>\n";
		        		  echo "<div class=\"span-1\">$testado</div>\n";
					  echo "<div class=\"clear\"></div>\n";
			      		  echo "</li>\n";
			      		  $a = ($dcolor == $dcolor_A ? 1 : 0);
					}	

						  
				     }
			      }			
	echo "</ul>\n";				       	  	
?>
