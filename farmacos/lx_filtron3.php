<?php
include ("inc/login.php"); 
include ("inc/config.php");

 
$pf1e1=$_GET['pf1e1'];
$pf1e2=$_GET['pf1e2'];
$pf2=$_GET['pf2'];
switch ($pf1e1){
      default:
      break;
      
      case 0;  
	   if ($pf1e2==1){
	    echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-1\">All Grd</div>\n";
			      echo "<div class=\"span-1 last\">Grd 3/4</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
			   $query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,id_categoria, valor_toxicidad from farmacos_toxicidad,toxicidad  where  farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco='".$pf2."'";
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
	echo "</ul>\n";			
		
			}else{
			
			echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-5\">Farmaco</div>\n";
			      echo "<div class=\"span-1 last\">::</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
			   $query_indicaciones="select farmacos_indicaciones.id_farmaco,nombre_farmaco,testado from farmacos_indicaciones,farmacos where farmacos_indicaciones.id_farmaco=farmacos.id_farmaco and id_indicacion='".$pf2."'";
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
			
			}
			
      break;
      case 1;
      if ($pf1e2==1){
      echo "<ul class=\"m0\">\n";
	    echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		  echo "<div class=\"span-4\">Toxicidad</div>\n";
		  echo "<div class=\"span-1\">AE >10</div>\n";
		  echo "<div class=\"span-1 last\">Grade >=3</div>\n";
		  echo "<div class=\"clear\"></div>\n";
	    echo "</li>\n";
	    $query_toxicidades="select nombre_toxicidad,tx1,tx2 from farmacos_inv_toxicidad,toxicidad  where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco='".$pf2."'";
	    $lista_toxicidades = mysql_query($query_toxicidades, $connect);
		  if ($lista_toxicidades){
		  $numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
			$a = 0;
			$dcolor_A = "impar";
			$dcolor_B = "par"; 
			      while(list($nombre_toxicidad,$tx1,$tx2)= mysql_fetch_row($lista_toxicidades)){
			      $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			      echo "<li class=\"$dcolor\">\n";
				    echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
		        	    echo "<div class=\"span-1\">$tx1</div>\n";
				    echo "<div class=\"span-1 last\">$tx2</div>\n";
				    echo "<div class=\"clear\"></div>\n";
				    echo "</li>\n";
			      	    $a = ($dcolor == $dcolor_A ? 1 : 0);
			      }
			}
		  }			
      echo "</ul>\n";	  	
      
      }else{
      echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-6\">Farmaco</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
			   $query_dianas="select id_farmaco,nombre_farmaco from farmacos_inv where  categoria_diana='".$pf2."'";
			   $lista_dianas = mysql_query($query_dianas, $connect);
			      if ($lista_dianas){
				    $numero_dianas=mysql_num_rows($lista_dianas);
				    if($numero_dianas == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					while(list($id_farmaco,$nombre_farmaco)= mysql_fetch_row($lista_dianas)){	
					  $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B); 
					  echo "<li class=\"$dcolor\">\n";
					  echo "<div class=\"span-6\">$nombre_farmaco</div>\n";
		        		  echo "<div class=\"clear\"></div>\n";
			      		  echo "</li>\n";
			      		  $a = ($dcolor == $dcolor_A ? 1 : 0);
					}	

						  
				     }
			      }			
	echo "</ul>\n";			
      
      
      
      
      
      
      
      
      
      }
      
      
      break;
      case 2;
	    echo "<p class=\"formulario\">\n";
		  echo "<input type=\"text\" name=\"in_farm2\" id=\"in_farm2\" class=\"span-7\" />\n"; 
	    echo "</p>\n";
      break;

}

	/*
	echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-1\">All Grd</div>\n";
			      echo "<div class=\"span-1 last\">Grd 3/4</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
			   $query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,id_categoria, valor_toxicidad from farmacos_toxicidad,toxicidad  where  farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=$id_farmaco";
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
	echo "</ul>\n";				       	  	
*/

?>
