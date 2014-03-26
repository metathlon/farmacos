<?php
include ("inc/login.php"); 
include ("inc/config.php");

$div_origen=$_GET['divo'];
$pf1e1=$_GET['pf1e1'];
$pf1e2=$_GET['pf1e2'];
switch ($pf1e1){
      default:
      break;
      
      case 0;  
	    echo "<p class=\"formulario\">\n";
		  echo "<select name=\"select_farm".$div_origen."\" id=\"select_farm".$div_origen."\" class=\"span-7\" onChange=actualiza_nivel3($div_origen)>\n"; 
			
			if ($pf1e2==1){
			$sql = "select id_farmaco,nombre_farmaco from farmacos order by nombre_farmaco";
			echo "<option value=\"-1\">Select FDA drug</option>\n";	
			echo "<option value=\"0\">All</option>\n";
			}else{
			 $sql = "select id_indicacion,descripcion_indicacion from indicaciones order by descripcion_indicacion";  
			echo "<option value=\"-1\">Select an Option</option>\n";	
			echo "<option value=\"0\">All</option>\n";
			
			}
			 mysql_select_db($basedatos,$connect);
			$resultado = mysql_query($sql,$connect);          
			       while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	
			           echo "<option value=\"$id_farmaco_lista\">$nombre_farmaco_lista</option>\n";	
			      }       	
		  echo "</select>\n";
	    echo "</p>\n";
      break;
      case 1;
	    echo "<p class=\"formulario\">\n";
		  echo "<select name=\"select_farm".$div_origen."\" id=\"select_farm".$div_origen."\" class=\"span-7\" onChange=actualiza_nivel3($div_origen)>\n"; 
			if ($pf1e2==1){
			$sql = "select id_farmaco,nombre_farmaco from farmacos_inv order by nombre_farmaco";
			echo "<option value=\"-1\">Select Inv. Drug</option>\n";	
			echo "<option value=\"0\">All</option>\n";	
			}else{
			 $sql = "select id_categoria_diana,descripcion_categoria_diana from categorias_dianas order by descripcion_categoria_diana";  
			echo "<option value=\"-1\">Select Target</option>\n";	
			echo "<option value=\"0\">All</option>\n";	
			}
			
			
			
			 mysql_select_db($basedatos,$connect);
			$resultado = mysql_query($sql,$connect);          
			      while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	
			      echo "<option value=\"$id_farmaco_lista\">$nombre_farmaco_lista</option>\n";	
			}       	
		  echo "</select>\n";
	    echo "</p>\n";
      break;
      case 2;
	    echo "<p class=\"formulario\">\n";
		  echo "<input type=\"text\" name=\"in_farm".$div_origen."\" id=\"in_farm".$div_origen."\" class=\"span-7\" />\n"; 
	    echo "</p>\n";
      break;

}

if ($div_origen==1){
      

echo "<p class=\"formulario\">\n";
$query_toxicidades="select id_toxicidad,nombre_toxicidad from toxicidad order by nombre_toxicidad";
	     $lista_toxicidades = mysql_query($query_toxicidades, $connect);
		  if ($lista_toxicidades){
		  $numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
			
			      echo "<select name=\"select_tx".$div_origen."\" id=\"select_tx".$div_origen."\" class=\"span-7\">\n";        
				     echo "<option value=\"0\">All Toxicity</option>\n";
					while(list($id_toxicidad,$nombre_toxicidad)= mysql_fetch_row($lista_toxicidades)){ 	
				    echo "<option value=\"$id_toxicidad\">$nombre_toxicidad</option>\n";	
				    }       	
			      echo "</select>\n";
			
			}
		  }
echo "</p>\n";
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
