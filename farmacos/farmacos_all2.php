<?php
include ("inc/login.php"); 
include ("inc/config.php");
function busca_toxicidad($id_farmaco,$id_toxicidad){
global $basedatos,$connect;
$query_toxicidades="select id_categoria, valor_toxicidad from farmacos_toxicidad
where id_farmaco=".$id_farmaco." and id_toxicidad=".$id_toxicidad;
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
			    if ($lista_toxicidades){
				 
				    $numero_toxicidades=mysql_num_rows($lista_toxicidades);
				    if($numero_toxicidades == 0) {
				    $resultado_comparacion="Very Low";
					} else {
						while(list($id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){
						$array_valores_categoria[$id_categoria]=$valor_toxicidad;
						}
					         //Existen toxicidades para grado all y grado 3/4
					 	if (array_key_exists(0,$array_valores_categoria) and array_key_exists(4,$array_valores_categoria)){
						  $valor_all=$array_valores_categoria[0];
						  $valor_34=$array_valores_categoria[4];
						$query1= "select id_alg_n1,resultado from alg_n1 where parametro=0 and valor_max >=".$valor_all." and valor_min <=".$valor_all;
						$res1 = mysql_query($query1, $connect);
							if ($res1){
								$nreg1=mysql_num_rows($res1);
								if($nreg1 == 0) {
							        $resultado_comparacion="error algoritmo";
								}else{
								list($id_alg_n1,$resultado)= mysql_fetch_row($res1);
								//$resultado_comparacion1="mixto".$valor_all.$id_alg_n1.$resultado;
								}
							}else{
							$resultado_comparacion="error algoritmo";	
							}
						$query2= "select id_alg_n1,resultado from alg_n1 where parametro=4 and valor_max >=".$valor_34." and valor_min <=".$valor_34;
						$res2 = mysql_query($query2, $connect);
							if ($res2){
								$nreg2=mysql_num_rows($res2);
								if($nreg2 == 0) {
							        $resultado_comparacion="error algoritmo";
								}else{
								list($id_alg_n2,$resultado2)= mysql_fetch_row($res2);
								//$resultado_comparacion2="mixto".$valor_34.$id_alg_n2.$resultado2;
								}
							}else{
							$resultado_comparacion="error algoritmo";	
							}
						$query_comb="select resultado_cmb from alg_cmb where id_alg_n11=".$id_alg_n1." and id_alg_n12=".$id_alg_n2;
						$res_comb = mysql_query($query_comb, $connect);
							if ($res_comb){
								$nreg3=mysql_num_rows($res_comb);
								if($nreg3 == 0) {
							        $resultado_comparacion="NO CONTEMPLADO";
								}else{
								list($resultado3)= mysql_fetch_row($res_comb);
								$resultado_comparacion=$resultado3;
								}
							}else{
							$resultado_comparacion="error algoritmo";	
							}
						

						   //$resultado_comparacion="mixto".$valor_all."y".$valor_34;
						  //Existen toxicidades para grado all solo
						  
						  } else if (array_key_exists(0,$array_valores_categoria)){
						  $valor_all=$array_valores_categoria[0];
						  $query1= "select id_alg_n1,resultado from alg_n1 where parametro=0 and valor_max >=".$valor_all." and valor_min <=".$valor_all;
						  $res1 = mysql_query($query1, $connect);
							if ($res1){
								$nreg1=mysql_num_rows($res1);
								if($nreg1 == 0) {
							        $resultado_comparacion="error algoritmo";
								}else{
								list($id_alg_n1,$resultado)= mysql_fetch_row($res1);
								$resultado_comparacion=$resultado;
								//$resultado_comparacion="seeeuno".$valor_all;
								}
							}else{
							$resultado_comparacion="error algoritmo";	
							}
						  //Existen toxicidades para grado 34 solo
						  } else if (array_key_exists(4,$array_valores_categoria)){
						  $valor_34=$array_valores_categoria[4];
						  $query2= "select id_alg_n1,resultado from alg_n1 where parametro=4 and valor_max >=".$valor_34." and valor_min <=".$valor_34;
						  $res2 = mysql_query($query2, $connect);
							if ($res2){
								$nreg2=mysql_num_rows($res2);
								if($nreg2 == 0) {
							        $resultado_comparacion="error algoritmo";
								}else{
								list($id_alg_n2,$resultado2)= mysql_fetch_row($res2);
								$resultado_comparacion=$resultado2;
								//$resultado_comparacion="uno".$valor_34;
								}
							}else{
							$resultado_comparacion="error algoritmo";	
							}

						  }else{
						  //por ejemplo existe grado 3;
						  $resultado_comparacion="Very Low";
						  }

					
					}

				}else{
				$resultado_comparacion="ERROR";
				}
return  $resultado_comparacion;

}


include ("inc/header_horizontal.php");
echo "<div class=\"span-24 last\">\n";
   echo "<div id=\"tabBody\" class=\"clearfix\">\n";
   echo "<form  name=\"form_farmacos\" class=\"equipos\">\n";
      echo "<div class=\"span-23 last\">\n";
/*
$sql = "select id_farmaco,nombre_farmaco from farmacos order by nombre_farmaco limit 2";
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($sql,$connect);          
while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	
	
	$sql2 = "select id_farmaco,nombre_farmaco from farmacos_inv order by nombre_farmaco";
	$resultado2 = mysql_query($sql2,$connect);          
	 while(list($id_farmaco2_lista,$nombre_farmaco2_lista) = mysql_fetch_row($resultado2)) {	
	*/
if (!isset($_GET['id_farmaco2'])){
//$id_farmaco2=$_GET['id_farmaco2'];

		
		
		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Drug Test</p>\n";
					echo "<p>\n";
						echo "<select name=\"select_farm2\" id=\"select_farm2\" class=\"span-7\" onChange=actualiza_tx2(this.value)>\n"; 
						$sql = "select id_farmaco,nombre_farmaco from farmacos_inv order by nombre_farmaco";
						echo "<option value=\"0\">Seleccione Farmaco</option>\n";	
						mysql_select_db($basedatos,$connect);
						$resultado = mysql_query($sql,$connect);          
								while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	
								echo "<option value=\"$id_farmaco_lista\">$nombre_farmaco_lista</option>\n";	
								}       	
						echo "</select>\n";
					echo "</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
					echo "<div class=\"scroll200h\">\n";
						echo "<div id=\"ctoxicidades2\">\n";
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";			      
		
		
		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Drug 1</p>\n";
					echo "<p>\n";
				echo "<select name=\"select_farm1\" id=\"select_farm1\" class=\"span-7\"  onChange=actualiza_in1(this.value)>\n"; 
							echo "<option value=\"0\">All</option>\n";	
							
							$sql = "select id_indicacion,descripcion_indicacion from indicaciones order by descripcion_indicacion";
							mysql_select_db($basedatos,$connect);
							$resultado = mysql_query($sql,$connect);          
								while(list($id_indicacion_lista,$descripcion_indicacion_lista) = mysql_fetch_row($resultado)) {	
								echo "<option value=\"$id_indicacion_lista\">$descripcion_indicacion_lista</option>\n";	
								}       	
						     
						echo "</select>\n";
					echo "</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
					echo "<div class=\"scroll200h\">\n";
						echo "<div id=\"ctoxicidades1\">\n";
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
					echo "<div class=\"cuerpo1\">\n";
						echo "<div class=\"scroll200h\">\n";
							echo "<div id=\"ccomparar\">\n";
							echo "</div>\n"; 
						echo "</div>\n";
					echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";

		
		
		
		
		/*
		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div>\n";
				echo "<p class=\"leyenda\">Drug Test</p>\n";
				echo "<p>\n";
				 echo $nombre_farmaco2_lista;
				echo "</p>\n";
				echo "</div>\n";
				echo "<div>\n";
				echo "<div class=\"scroll200h\">\n";
				echo "<div id=\"ctoxicidades2_".$id_farmaco_lista.$id_farmaco2_lista."\">\n";
				echo "</div>\n";
				  
				   
				echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";
	
	
	
echo "<div class=\"span-7 last\">\n";
	echo "<div class=\"izq conborde\">\n";
		echo "<div>\n";
			echo "<p class=\"leyenda\">Comparar</p>\n";
			echo "<p>\n";
			echo $nombre_farmaco_lista."<br>";
			echo $nombre_farmaco2_lista."<br>";
			echo "</p>\n";
		echo "</div>\n";
		echo "<div>\n";
				echo "<div class=\"scroll200h\">\n";
					echo "<div id=\"ccomparar_".$id_farmaco_lista.$id_farmaco2_lista."\">\n";
					echo "</div>\n"; 
				echo "</div>\n";
		echo "</div>\n";
	echo "</div>\n";
echo "</div>\n";

}	
}	
*/	
	
}else{
$id_farmaco2=$_GET['id_farmaco2'];
$id_farmaco1=$_GET['id_farmaco1'];


echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Drug Test</p>\n";
					echo "<p>\n";
						echo "<select name=\"select_farm2\" id=\"select_farm2\" class=\"span-7\" onChange=actualiza_tx2(this.value)>\n"; 
						$sql = "select id_farmaco,nombre_farmaco from farmacos_inv order by nombre_farmaco";
						echo "<option value=\"0\">Seleccione Farmaco</option>\n";	
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
					echo "<p class=\"leyenda\">Drug 1</p>\n";
					echo "<p>\n";
						echo "<select name=\"select_farm1\" id=\"select_farm1\" class=\"span-7\">\n"; 
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
								
								echo "<option $sel value=\"$id_indicacion\">$descripcion_indicacion_lista1</option>\n";	
								}       	
						
						
						
						echo "</select>\n";
					echo "</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
					echo "<div class=\"scroll200h\">\n";
						echo "<div id=\"ctoxicidades1\">\n";
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
					echo "<div class=\"cuerpo1\">\n";
						echo "<div class=\"scroll200h\">\n";
							echo "<div id=\"ccomparar\">\n";
							echo "</div>\n"; 
						echo "</div>\n";
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
echo $sql;
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
						echo "<ul class=\"m0\">\n";
							echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
								echo "<div class=\"span-4\">Toxicidad</div>\n";
								echo "<div class=\"span-1\">All Grd</div>\n";
								echo "<div class=\"span-1 last\">Grd 3/4</div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
							$query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,
							id_categoria,valor_toxicidad from farmacos_toxicidad,toxicidad  where 		farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=".$id_farmaco_lista;
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
			      	
						if ($tx1==1 or $tx2==1){
						echo "<li class=\"$dcolor\">\n";
						      echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
		        			      echo "<div class=\"span-2\">".busca_toxicidad($id_farmaco_lista,$id_toxicidad)."</div>\n";
						      echo "<div class=\"clear\"></div>\n";
			      			echo "</li>\n";
						//echo "<p>".$nombre_toxicidad."---".busca_toxicidad($id_farmaco1,$id_toxicidad)."</p>\n";
						}else{
						echo "<li class=\"$dcolor\">\n";
						      echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
		        			      echo "<div class=\"span-2\">VERY LOW</div>\n";
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
echo "window.open (a,\"eq_giman\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=750,height=550\");\n";
echo "}\n";
echo "function compara_multiple(){\n";
echo "elemento1=document.getElementById('select_farm1');\n";
echo "elemento2=document.getElementById('select_farm2');\n";
echo "window.location=\"farmacos_all.php?id_farmaco1=\" + elemento1.value + \"&id_farmaco2=\" + elemento2.value;\n";
echo "}\n";


echo "//-->\n";
echo "</script>\n";  
?>
