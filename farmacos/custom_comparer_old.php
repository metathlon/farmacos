<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies_SEL");
include ("inc/headerA1.php");
function lista_toxicidades_farmaco($farmaco_id){
global $basedatos,$connect;	
	echo "<ul class=\"m0\">\n";
		echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-4\">Toxicidad</div>\n";
		echo "<div class=\"span-1\">All Grd</div>\n";
		echo "<div class=\"span-1 last\">Grd 3/4</div>\n";
		echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
							$query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,
							id_categoria,valor_toxicidad from farmacos_toxicidad,toxicidad  where farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=".$farmaco_id;
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
									echo "<div class=\"span-4\">".$des_tox."</div>\n";
									echo "<div class=\"span-1\">$txall</div>\n";
									echo "<div class=\"span-1 last\">$tx34</div>\n";
									echo "<div class=\"clear\"></div>\n";
								echo "</li>\n";
							$a = ($dcolor == $dcolor_A ? 1 : 0);
							}
							}
							}			
							echo "</ul>\n";	
	
}


echo "<div class=\"span-24 last\">\n";
   echo "<div id=\"tabBody\" class=\"clearfix\">\n";
      echo "<form  action=\"result_cc.php\" method=\"post\" name=\"form_cc\" >\n";
      echo "<div class=\"span-23 last clearfix\">\n";
		 	 			echo "<ul class=\"tabArea\">\n";
							echo "  <li class=\"tabOff\"><a href=\"farmacos.php\">Simple Combination</a></li>\n";
							echo "  <li class=\"tabOff\"><a href=\"farmacos_all.php\">Multiple Combination</a></li>\n";
							echo "  <li class=\"tabOff\"><a href=\"farmacos_optimal.php\">Optimal Combination</a></li>\n";
							echo "  <li class=\"tabOn\"><a  href=\"custom_comparer.php\">Custom Combination</a></li>\n";
							//echo "  <li class=\"tabOff\"></li>\n";
						echo"</ul>\n";
	echo "</div>\n";
	echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"tabAreaInferior clearfix\">\n";
				echo "</div>\n";
	echo "</div>\n";
	  
	  
	  echo "<div class=\"span-23 last\">\n";


if (!isset($_GET['id_farmaco2'])){
//$id_farmaco2=$_GET['id_farmaco2'];

		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<p class=\"leyenda\">Drug Test 1</p>\n";
				echo "<div class=\"cabeceraseleccion\">\n";
					echo "<p class=\"formulario\">\n";
					echo "<select name=\"select_custom1\" id=\"select_custom1\" class=\"span-7\" onChange=actualiza_custom(1)>\n"; 
						echo "<option value=\"-1\">Select Option 1</option>\n";	
						echo "<option value=\"0\">FDA Drug</option>\n";	
						echo "<option value=\"1\">INVESTIGATONAL Drug</option>\n";	
						echo "<option value=\"2\">CUSTOM Drug</option>\n";	
					echo "</select>\n";
					echo "</p>\n";
					echo "<p class=\"formulario\">\n";
					echo "<input type=\"radio\" name=\"radio_custom1\" id=\"radio_custom11\" value=\"1\" checked onClick=actualiza_custom(1) />\n";
					echo "General\n";
					echo "<input type=\"radio\" name=\"radio_custom1\" id=\"radio_custom12\" value=\"2\"  onClick=actualiza_custom(1) />\n";
					echo "Grouped\n";
					echo "</p>\n";
				
				
				echo "</div>\n";
				echo "<div class=\"cabeceraseleccion\" id=\"filtro_n21\">\n";
				echo "</div>\n";
				
				
				
				echo "<div class=\"cuerpo1\">\n";
					echo "<div class=\"scroll200h\">\n";
						echo "<div id=\"ctoxicidades1\">\n";
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
			
			echo "</div>\n";
		echo "</div>\n";			      
		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<p class=\"leyenda\">Drug Test 2</p>\n";
				echo "<div class=\"cabeceraseleccion\">\n";
					echo "<p class=\"formulario\">\n";
					echo "<select name=\"select_custom2\" id=\"select_custom2\" class=\"span-7\" onChange=actualiza_custom(2)>\n"; 
						echo "<option value=\"-1\">Select Option 2</option>\n";	
						echo "<option value=\"0\">FDA Drug</option>\n";	
						echo "<option value=\"1\">INVESTIGATONAL Drug</option>\n";	
						echo "<option value=\"2\">CUSTOM Drug</option>\n";	
					echo "</select>\n";
					echo "</p>\n";
					echo "<p class=\"formulario\">\n";
					echo "<input type=\"radio\" name=\"radio_custom2\" id=\"radio_custom21\" value=\"1\" checked onClick=actualiza_custom(2) />\n";
					echo "General\n";
					echo "<input type=\"radio\" name=\"radio_custom2\" id=\"radio_custom22\" value=\"2\"  onClick=actualiza_custom(2) />\n";
					echo "Grouped\n";
					echo "</p>\n";
				
				
				echo "</div>\n";
				echo "<div class=\"cabeceraseleccion\" id=\"filtro_n22\">\n";
				echo "</div>\n";
		
				echo "<div class=\"cuerpo1\">\n";
					echo "<div class=\"scroll200h\">\n";
						echo "<div id=\"ctoxicidades2\">\n";
						
						
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
			
			echo "</div>\n";
		echo "</div>\n";			      
			      
		echo "<div class=\"span-7 last\">\n";
			echo "<div class=\"dcha conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Comparar</p>\n";
					echo "<p>\n";
						echo "<input type=\"button\" value=\"Comparacion Multiple\"  onClick=\"compara_multiple()\" />\n"; 
					//echo "<input type=\"submit\" value=\"Start\" />\n"; 
					
					echo "</p>\n";
				echo "</div>\n";
				//para que no de error el java no seria necesario es por compatibilidad
				echo "<div id=\"ccomparar\">\n";
				echo "</div>\n"; 
			
			echo "</div>\n";
		echo "</div>\n";

}else{
$id_farmaco2=$_GET['id_farmaco2'];
$id_farmaco1=$_GET['id_farmaco1'];


		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Drug Test 1</p>\n";
					echo "<p>\n";
						echo "<select name=\"select_farm2\" id=\"select_farm2\" class=\"span-7\" onChange=actualiza_tx2(this.value)>\n"; 
						$sql = "select id_farmaco,nombre_farmaco from farmacos_inv order by nombre_farmaco";
						echo "<option value=\"-1\">Seleccione Farmaco</option>\n";	
						if ($id_farmaco1==-1){
						echo "<option selected value=\"0\">All</option>\n";	
						}else{
						echo "<option value=\"0\">All</option>\n";	
						}		
						mysql_select_db($basedatos,$connect);
						$resultado = mysql_query($sql,$connect);          
								while(list($id_farmaco_lista1,$nombre_farmaco_lista1) = mysql_fetch_row($resultado)) {	
									if ($id_farmaco_lista1==$id_farmaco2){
								 	$sel = "selected";
									$nombre_farmaco2=$nombre_farmaco_lista1;
									}else{
									$sel = "";
									}
								
						echo "<option $sel value=\"$id_farmaco_lista1\">$nombre_farmaco_lista1</option>\n";	
								}       	
						echo "</select>\n";
					echo "</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
					echo "<div class=\"scroll200h\">\n";
						echo "<div id=\"ctoxicidades2\">\n";
						echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-4\">Toxicidad</div>\n";
						echo "<div class=\"span-1\">AE >10</div>\n";
						echo "<div class=\"span-1 last\">Grade >=3</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
					$query_toxicidades="select nombre_toxicidad,tx1,tx2 from farmacos_inv_toxicidad,toxicidad  
					where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=$id_farmaco2";
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
						
						
						
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";			      
		
		
		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Drug Test 2</p>\n";
					echo "<p>\n";
						echo "<select name=\"select_farm1\" id=\"select_farm1\" class=\"span-7\" onChange=actualiza_in1(this.value)>\n"; 
							echo "<option value=\"0\">All</option>\n";	
							$sql = "select id_indicacion, descripcion_indicacion from indicaciones order by descripcion_indicacion";
							mysql_select_db($basedatos,$connect);
							$resultado = mysql_query($sql,$connect);          
								while(list($id_indicacion_lista1,$descripcion_indicacion_lista1) = mysql_fetch_row($resultado)) {	
								if ($id_indicacion_lista1==$id_farmaco1){
								 	$sel = "selected";
									}else{
									$sel = "";
									}
								
								echo "<option $sel value=\"$id_indicacion_lista1\">$descripcion_indicacion_lista1</option>\n";	
								}       	
						
						
						
						echo "</select>\n";
					echo "</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
					echo "<div class=\"scroll200h\">\n";
						echo "<div id=\"ctoxicidades1\">\n";
							if($id_farmaco1!=0){
								echo "<ul class=\"m0\">\n";
									echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
										echo "<div class=\"span-5\">Farmaco</div>\n";
										echo "<div class=\"span-1 last\">::</div>\n";
										echo "<div class=\"clear\"></div>\n";
									echo "</li>\n";
								$id_indicacion=$id_farmaco1;//esto es para trabajar con los mismos codigos creados para farmacos
								$query_indicaciones="select farmacos_indicaciones.id_farmaco,nombre_farmaco,testado
								from farmacos_indicaciones,farmacos where farmacos_indicaciones.id_farmaco=farmacos.id_farmaco and id_indicacion=".$id_indicacion;
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
						
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";		    			      
		echo "<div class=\"span-7 last\">\n";
			echo "<div class=\"dcha conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Comparar</p>\n";
					echo "<p>\n";
						echo "<input type=\"button\" value=\"Comparacion Multiple\"  onClick=\"compara_multiple()\">\n"; 
					echo "</p>\n";
				echo "</div>\n";
					//para que no de error el java no seria necesario es por compatibilidad
				echo "<div id=\"ccomparar\">\n";
				echo "</div>\n"; 
			
	
			echo "</div>\n";
		echo "</div>\n";




//en funcion si son todos o solo los farmacos que tienen indicacion
if ($id_farmaco1==0){
$sql = "select id_farmaco,nombre_farmaco from farmacos order by nombre_farmaco";
}else{
$id_indicacion=$id_farmaco1;
$sql = "select farmacos_indicaciones.id_farmaco,nombre_farmaco,id_indicacion,testado from farmacos_indicaciones,farmacos where farmacos_indicaciones.id_farmaco=farmacos.id_farmaco and id_indicacion=".$id_indicacion;
}

mysql_select_db($basedatos,$connect);
$resultado = mysql_query($sql,$connect);          
while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	

echo "<div class=\"span-23 last\">\n";
echo "<div class=\"span-8\">\n";
	echo "<div class=\"izq conborde\">\n";
		echo "<div>\n";
			echo "<p class=\"leyenda\">$nombre_farmaco2</p>\n";
		echo "</div>\n";
		echo "<div>\n";
			echo "<div class=\"scroll200h\">\n";
				/*
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-4\">Toxicidad</div>\n";
						echo "<div class=\"span-1\">AE >10</div>\n";
						echo "<div class=\"span-1 last\">Grade >=3</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
					$query_toxicidades="select nombre_toxicidad,tx1,tx2 from farmacos_inv_toxicidad,toxicidad  
					where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=$id_farmaco2";
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
			*/
			echo "</div>\n";
		echo "</div>\n";
	echo "</div>\n";
echo "</div>\n";			

echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div>\n";
					echo "<p class=\"leyenda\">$nombre_farmaco_lista</p>\n";
				echo "</div>\n";
				echo "<div>\n";
					echo "<div class=\"scroll200h\">\n";
					lista_toxicidades_farmaco($id_farmaco_lista);			
					echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";	

echo "<div class=\"span-7 last\">\n";
			echo "<div class=\"dcha conborde\">\n";
				echo "<div>\n";
					echo "<p class=\"leyenda\">Resultado</p>\n";
				echo "</div>\n";
					echo "<div>\n";
						echo "<div class=\"scroll200h\">\n";
						echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-2 last\"></div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
$query_toxicidades="select farmacos_inv_toxicidad.id_toxicidad,nombre_toxicidad,tx1,tx2 from farmacos_inv_toxicidad,toxicidad  where farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=".$id_farmaco2;
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
		  if ($lista_toxicidades){
		  $numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
	         			$a = 0;
			   		$dcolor_A = "impar";
			  		$dcolor_B = "par"; 
					while(list($id_toxicidad,$nombre_toxicidad,$tx1,$tx2)= mysql_fetch_row($lista_toxicidades)){
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
					$resultado_comparacion=busca_toxicidad($id_farmaco_lista,$id_toxicidad);
						if ($tx1==1 or $tx2==1){
						echo "<li class=\"$dcolor\">\n";
						      echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
		        			      echo "<div class=\"span-2\">".$array_txt_comp[$resultado_comparacion]."</div>\n";
						      echo "<div class=\"clear\"></div>\n";
			      			echo "</li>\n";
						//echo "<p>".$nombre_toxicidad."---".busca_toxicidad($id_farmaco1,$id_toxicidad)."</p>\n";
						}else{
						echo "<li class=\"$dcolor\">\n";
						      echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
		        			      echo "<div class=\"span-2\">".$array_txt_comp[1]."</div>\n";
						      echo "<div class=\"clear\"></div>\n";
			      			echo "</li>\n";
						//echo "<p>".$nombre_toxicidad."---".$id_toxicidad."VERY LOW</p>\n";
						}
					
					$a = ($dcolor == $dcolor_A ? 1 : 0);
					
					}
			
			
			
			
			
			}
	       
		   }
	   echo "</ul>\n";	 
						echo "</div>\n";
					echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";

echo "</div>\n";
}


}
	 		
			
			
			
			
			echo "</div>\n";
       echo "</form>\n";
	echo "</div>\n";
echo "</div>\n";





include ("inc/footer_horizontal.php");
/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
*/
echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"farmacos\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=750,height=550\");\n";
echo "}\n";
echo "function compara_multiple(){\n";
echo "elemento1=document.getElementById('select_custom1');\n";
echo "elemento2=document.getElementById('select_custom2');\n";
	echo "if (elemento1.value==-1 || elemento2.value==-1){\n";
	echo "alert(\"Seleccione Opcion\");\n";
	echo "}else{\n";
	echo "elemento3=document.getElementById('select_farm1');\n";
	echo "elemento4=document.getElementById('select_farm2');\n";
		echo "if (elemento3.value==-1 || elemento4.value==-1){\n";
		echo "alert(\"Seleccione Farmaco\");\n";
		echo "}else{\n";
		echo "document.form_cc.submit();\n";
		echo "}\n";
	echo "}\n";
//echo "window.location=\"farmacos_ci.php?id_farmaco1=\" + elemento1.value + \"&id_farmaco2=\" + elemento2.value;\n";
echo "}\n";

echo "//-->\n";
echo "</script>\n";  
?>
