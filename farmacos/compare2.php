<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");
include ("inc/header_ventana2.php");
function devuelve_nombre_farmaco($id_farmaco,$categoria_farmaco){
global $basedatos,$connect;	
if ($categoria_farmaco=='FDA'){
$query_farmacos="select nombre_farmaco from farmacos where id_farmaco='".$id_farmaco."'";
}
if ($categoria_farmaco=='INV'){
$query_farmacos="select nombre_farmaco from farmacos_inv where id_farmaco='".$id_farmaco."'";
}
$lista_farmacos = mysql_query($query_farmacos, $connect);
	if ($lista_farmacos){
	$numero_farmacos=mysql_num_rows($lista_farmacos);
		if($numero_farmacos == 0) {
		return "error";
		} else {
			list($nombre_farmaco)= mysql_fetch_row($lista_farmacos);
		return $nombre_farmaco;
		}								
	}else{
	return "error";	
	}

}






function lista_toxicidades_farmaco_fda($farmaco_id){
global $basedatos,$connect;	
	echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-1\">All Grd</div>\n";
			      echo "<div class=\"span-1 last\">Grd 3/4</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
			   $query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_toxicidad,toxicidad,toxicidad_n0 where
				id_farmaco='".$farmaco_id."' and
					farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
					toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0";
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
			   and id_farmaco=$farmaco_id and id_toxicidad_n0='".$id_grptx."' order by nombre_toxicidad asc";
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
}

function lista_toxicidades_farmaco_inv($farmaco_id){
global $basedatos,$connect;	
echo "<ul class=\"m0\">\n";
	echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-4\">Toxicidad</div>\n";
		echo "<div class=\"span-1\">AE >10</div>\n";
		echo "<div class=\"span-1 last\">Grade >=3</div>\n";
		echo "<div class=\"clear\"></div>\n";
	echo "</li>\n";
		$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_inv_toxicidad,toxicidad,toxicidad_n0 where
		id_farmaco='".$farmaco_id."' and
		farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
		toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0";
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
				$query_toxicidades="select nombre_toxicidad,tx1,tx2 from farmacos_inv_toxicidad,toxicidad  
				where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and 
				id_farmaco=$farmaco_id and id_toxicidad_n0='".$id_grptx."' order by nombre_toxicidad asc";
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
				}
			}	
		}
echo "</ul>\n";	 
}
   echo "<div id=\"tabBody\" class=\"clearfix\">\n";
   echo "<form  name=\"form_farmacos\">\n";
      echo "<div class=\"span-23 last\">\n";
$lista1=$_GET['lista1'];
$lista2=$_GET['lista2'];

if ($lista1==0 or $lista2==0){
echo "no se compara";
echo $lista1;
echo $lista2;
}else{
$array_lista_fda=explode("x",substr($lista2,0,-1));
$array_lista_inv=explode("x",substr($lista1,0,-1));

while (list ($codfinv,$id_farmaco2) = each ($array_lista_inv)){
			while (list ($codf,$idf) = each ($array_lista_fda)){
						  $nombre_farmaco_fda=devuelve_nombre_farmaco($idf,'FDA');
						  $nombre_farmaco_inv=devuelve_nombre_farmaco($id_farmaco2,'INV');
						   //echo "<div class=\"span-23 last\">\n";
						  		/*
								echo "<div class=\"cabecerarecuadro clearfix\">\n";
									echo "<div class=\"titulorecuadro\">".$nombre_farmaco_inv."&nbsp;VS&nbsp;".$nombre_farmaco_fda."</div>\n";
								echo "</div>\n";
						      
							  */
						 // echo "<p class=\"leyenda\">".$nombre_farmaco_inv."&nbsp;VS&nbsp;".$nombre_farmaco_fda."</p>\n";
						 //  echo "<div>\n";
						 
						  echo "<div class=\"span-23 last\">\n";
						   
						  echo "<div class=\"span-8\">\n";
							  echo "<div class=\"izq conborde\">\n";
								   echo "<div class=\"cabecera1\" onMouseOver=actualiza_div_finv($idf,$id_farmaco2)>\n";
									 echo "<p class=\"leyenda\">$nombre_farmaco_inv</p>\n";								  
								   echo " </div>\n";
								   echo "<div class=\"cuerpo1\">\n";
									  echo "<div class=\"scroll200h\">\n";
										  	echo "<div id=\"ctoxicidades2_".$idf."_".$id_farmaco2."\">\n";
											echo "</div>\n";
															 //lista_toxicidades_farmaco_inv($id_farmaco2);		
									  echo "</div>\n";
								  echo "</div>\n";
							  echo "</div>\n";
						  echo "</div>\n";			
						  
						  echo "<div class=\"span-8\">\n";
									  echo "<div class=\"izq conborde\">\n";
										   echo "<div class=\"cabecera1\" onMouseOver=actualiza_div_ffda($idf,$id_farmaco2)>\n";
											   
											  echo "<p class=\"leyenda\">$nombre_farmaco_fda</p>\n";
										  echo "</div>\n";
										  echo "<div class=\"cuerpo1\">\n";
											  echo "<div class=\"scroll200h\">\n";
												  echo "<div id=\"ctoxicidades1_".$idf."_".$id_farmaco2."\">\n";
												echo "</div>\n";
												  //lista_toxicidades_farmaco_fda($idf);			
												  
											  
											  echo "</div>\n";
										  echo "</div>\n";
									  echo "</div>\n";
						  echo "</div>\n";						    
						  
						  
						  echo "<div class=\"span-7 last\">\n";
									  echo "<div class=\"dcha conborde\">\n";
										   echo "<div class=\"cabecera1\">\n";
											  echo "<p class=\"leyenda\">Resultado</p>\n";
										  echo "</div>\n";
											  echo "<div class=\"cuerpo1\">\n";
												  echo "<div class=\"scroll200h\">\n";
												  comparar_inv_fda($id_farmaco2,$idf);
												  echo "</div>\n";
											  echo "</div>\n";
									  echo "</div>\n";
						echo "</div>\n";
						  
					
						
					echo "</div>\n";
						
					
			
			} //del array de los fsrmacos fda pasados como parametro
reset($array_lista_fda);
}//del array de los fsrmacos inv pasados como parametro
}			
			
			echo "</div>\n";
       echo "</form>\n";
	echo "</div>\n";
include ("inc/footer_ventana.php");
/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
*/
echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"eq_giman\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=750,height=550\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>
