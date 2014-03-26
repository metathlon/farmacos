<?php
include ("inc/login.php"); 
include ("inc/config.php");
 $id_farmaco=$_GET['id_farmaco'];
      echo "<ul class=\"m0\">\n";
	    $query_toxicidades="select nombre_toxicidad,tx1,tx2,toxicidad.id_toxicidad from farmacos_inv_toxicidad,toxicidad  where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco='".$id_farmaco."' order by nombre_toxicidad";
	     $lista_toxicidades = mysql_query($query_toxicidades, $connect);
		  if ($lista_toxicidades){
		  $numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
			echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<select name=\"select_tx2\" id=\"select_tx2\" class=\"span-7\">\n";        
				    while(list($nombre_toxicidad,$tx1,$tx2,$id_toxicidad)= mysql_fetch_row($lista_toxicidades)){ 	
				    echo "<option value=\"$id_toxicidad\">$nombre_toxicidad</option>\n";	
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
?>
