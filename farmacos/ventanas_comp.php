<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/header_ventana2.php");


if (!isset($_GET['id_farmaco2'])){
$id_farmaco2=0;
}else{
$id_farmaco2=$_GET['id_farmaco2'];
}
if (!isset($_GET['id_farmaco1'])){
$id_farmaco1=0;
}else{
$id_farmaco1=$_GET['id_farmaco1'];
}
if (!isset($_GET['pmtr1'])){
$pmtr1=0;
}else{
$pmtr1=$_GET['pmtr1'];
}
if (!isset($_GET['pmtr2'])){
$pmtr2=0;
}else{
$pmtr2=$_GET['pmtr2'];
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
					toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0 order by descripcion_toxicidad_n0 ";
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


function lista_toxicidades_familia($id_categoria_diana){
global $basedatos,$connect;	
 echo "<ul class=\"m0\">\n";
	    echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		  echo "<div class=\"span-4\">Toxicidad</div>\n";
		  echo "<div class=\"span-1\">AE >10</div>\n";
		  echo "<div class=\"span-1 last\">Grade >=3</div>\n";
		  echo "<div class=\"clear\"></div>\n";
	    echo "</li>\n";
	    $query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from categorias_diana_toxicidad,toxicidad,toxicidad_n0 where
		id_categoria_diana='".$id_categoria_diana."' and
		categorias_diana_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
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
		$query_toxicidades="select nombre_toxicidad,tx1,tx2 from categorias_diana_toxicidad,toxicidad  
		where  categorias_diana_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
		id_categoria_diana=$id_categoria_diana and id_toxicidad_n0='".$id_grptx."' order by nombre_toxicidad asc";
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
   echo "<form  name=\"form_farmacos\" class=\"equipos\">\n";
	 echo "<div class=\"span-23 last\">\n";
	 echo "<div class=\"span-8\">\n";
	   echo "<div class=\"izq conborde\">\n";
	   
	   // echo "<div class=\"izq conborde\">\n";
	       echo "<div class=\"cabecera1\">\n";
		  echo "<p class=\"leyenda\">FDA Approved Drug</p>\n";
		  echo "<p class=\"formulario\">\n";
		  echo "<select name=\"select_farm1\" id=\"select_farm1\" class=\"span-7\" onChange=actualiza_tx1(this.value)>\n"; 
		  echo "<option value=\"0\">Select FDA Approved Drug</option>\n";	
		  $sql = "select id_farmaco,nombre_farmaco from farmacos order by nombre_farmaco";
		  mysql_select_db($basedatos,$connect);
		  $resultado = mysql_query($sql,$connect);          
		     while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	
					if ($id_farmaco_lista==$id_farmaco1){
					$sel = "selected";
					}else{
					$sel = "";
					}		
			echo "<option $sel value=\"$id_farmaco_lista\">$nombre_farmaco_lista</option>\n";	
			 }       	
		  echo "</select>\n";
		  echo "</p>\n";
	      echo "<p class=\"formulario\">\n";
		   echo "</p>\n";
		  echo "</div>\n";
	       echo "<div class=\"cuerpo1\">\n";
		  echo "<div class=\"scroll600h\">\n";
		     echo "<div id=\"ctoxicidades1\">\n";
						if (!$id_farmaco1==0){
						lista_toxicidades_farmaco_fda($id_farmaco1);
						}
						
			echo "</div>\n";
				      
					  
					   echo "</div>\n";
	       echo "</div>\n";
	    echo "</div>\n";
	 echo "</div>\n";		    			      
	 echo "<div class=\"span-8\">\n";
	 echo "<div class=\"izq conborde\">\n";
	       echo "<div class=\"cabecera1\">\n";
		echo "<p class=\"leyenda\">\n";
						echo "Investigational Drug\n";
						if ($pmtr1==0){
						$classf3="formulario oculto";
						echo "<input type=\"radio\" name=\"radio_simple1\" id=\"radio_simple11\" value=\"1\" checked onClick=mostrar_formulario(1) />\n";
						echo "Only Drug\n";
						echo "<input type=\"radio\" name=\"radio_simple1\" id=\"radio_simple12\" value=\"2\"  onClick=mostrar_formulario(2) />\n";
						echo "Family\n";
		 			    }else{
						$classf3="formulario";
						echo "<input type=\"radio\" name=\"radio_simple1\" id=\"radio_simple11\" value=\"1\"  onClick=mostrar_formulario(1) />\n";
						echo "Only Drug\n";
						echo "<input type=\"radio\" name=\"radio_simple1\" id=\"radio_simple12\" value=\"2\" checked onClick=mostrar_formulario(2) />\n";
						echo "Family\n";
						}
		echo "</p>\n";
		echo "<p class=\"formulario\">\n"; 	
			
				if ($pmtr2==0){
					if ($pmtr1==0){
					$classf1="formulario";
					$classf2="formulario oculto";
				    }else{
					$classf1="formulario oculto";
					$classf2="formulario oculto";
					}
				
				echo "<select name=\"select_orden\" id=\"select_orden\" class=\"span-5\" onChange=actualiza_orden(this.value)>\n"; 
				echo "<option selected value=\"0\">Order by Drug</option>\n";	     	
				echo "<option value=\"1\">Order by Family</option>\n";
				echo "</select>\n";
				}
				if ($pmtr2==1){
						if ($pmtr1==0){
						$classf1="formulario oculto";
						$classf2="formulario";
				    	}else{
						$classf1="formulario oculto";
						$classf2="formulario oculto";
						}
				echo "<select name=\"select_orden\" id=\"select_orden\" class=\"span-5\" onChange=actualiza_orden(this.value)>\n"; 
				echo "<option  value=\"0\">Order by Drug</option>\n";	     	
				echo "<option selected value=\"1\">Order by Family</option>\n";
				echo "</select>\n";
				}
		echo "</p>\n";
		 echo "<p class=\"$classf1\" id=\"f_mostrar_farmacos\">\n"; 	
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
		
		echo "<p class=\"$classf2\" id=\"f_mostrar_ordenados\">\n"; 	
		  echo "<select name=\"select_farmOrd\" id=\"select_farmOrd\" class=\"span-7\" onChange=actualiza_tx2(this.value)>\n"; 
		  		echo "<option value=\"0\">Select Drug(order by family)</option>\n";	
				$query_farm_ord = "select id_farmaco,id_categoria_diana,nombre_farmaco,descripcion_categoria_diana from farmacos_inv,categorias_dianas where  farmacos_inv.categoria_diana=categorias_dianas.id_categoria_diana order by  categorias_dianas.descripcion_categoria_diana";
				$resultado_farm_ord = mysql_query($query_farm_ord,$connect);
				if ($resultado_farm_ord){
				$numero_farm_ord=mysql_num_rows($resultado_farm_ord);
				    if($numero_farm_ord == 0) {
				    } else {
					$grp_diana_anterior='0';
					while(list($id_f,$id_cd,$nombre_f,$descripcion_cd)= mysql_fetch_row($resultado_farm_ord)){
		  				if ($grp_diana_anterior==$id_cd){
		  					if ($id_f==$id_farmaco2){
							$sel = "selected";
							}else{
							$sel = "";
							}
						echo "<option $sel value=\"$id_f\">$nombre_f</option>\n";
		              	}else{
                                                    if ($grp_diana_anterior=='0'){
                                                    echo "<optgroup label=\"$descripcion_cd\">\n";
                                                    }else{
                                                    echo "</optgroup>\n";
                                                    echo "<optgroup label=\"$descripcion_cd\">\n";
                                                    }
                                                    if ($id_f==$id_farmaco2){
														$sel = "selected";
													}else{
														$sel = "";
													}
																										
													echo "<option $sel value=\"$id_f\">$nombre_f</option>\n";	
						}
		   				$grp_diana_anterior=$id_cd;
		  
		 			}       	
		   		}
		 	 
			 }
		  echo "</select>\n";
		 echo "</p>\n";	 
		 
		 echo "<p class=\"$classf3\" id=\"f_mostrar_familias\">\n"; 	
		 	echo "<select name=\"select_fam_farm2\" id=\"select_fam_farm2\" class=\"span-7\" onChange=actualiza_txf2(this.value)>\n"; 
		  		$sql = "select id_categoria_diana,descripcion_categoria_diana from categorias_dianas order by  descripcion_categoria_diana";
		  			mysql_select_db($basedatos,$connect);
		 			$resultado = mysql_query($sql,$connect);          
		     			while(list($id_familia_lista,$nombre_familia_lista) = mysql_fetch_row($resultado)) {	
										if ($id_familia_lista==$id_farmaco2){
										$sel = "selected";
										$nombre_famila2=$nombre_familia_lista;
										}else{
										$sel = "";
										}			
						
						echo "<option $sel value=\"$id_familia_lista\">$nombre_familia_lista</option>\n";	
		    			 }       	
		  	echo "</select>\n";
		echo "</p>\n";
		echo "</div>\n";
	       echo "<div class=\"cuerpo1\">\n";
		  echo "<div class=\"scroll600h\">\n";
		    
		     echo "<div id=\"ctoxicidades2\">\n";
			if (!$id_farmaco2==0){
						if ($pmtr1==0){
						lista_toxicidades_farmaco_inv($id_farmaco2);
						}
						if ($pmtr1==1){
						lista_toxicidades_familia($id_farmaco2);
						}
			}
			
			
					  echo "</div>\n";
				       
				       
				       echo "</div>\n";
	       echo "</div>\n";
	    echo "</div>\n";
	 echo "</div>\n";

echo "<div class=\"span-7 last clearfix\">\n";
	echo "<div class=\"izq conborde\">\n";
		echo "<div class=\"cabecera1\">\n";
			echo "<p class=\"leyenda\">Results</p>\n";
			echo "<p class=\"formulario\">\n";
			echo "<input type=\"button\" value=\"Start Test\"  onClick=\"compara_farmacos()\">\n"; 
			echo "</p>\n";
		echo "</div>\n";
		echo "<div class=\"cuerpo1\">\n";
				echo "<div class=\"scroll600h\">\n";
					echo "<div id=\"ccomparar\">\n";
					echo "</div>\n"; 
				echo "</div>\n";
		echo "</div>\n";
	echo "</div>\n";
echo "</div>\n";


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

echo "function compara_farmacos(){\n";
echo "elemento1=document.getElementById('select_farm1');\n";
echo "elemento2=document.getElementById('select_farm2');\n";
echo "elemento3=document.getElementById('select_fam_farm2');\n";
echo "elemento4=document.getElementById('radio_simple11');\n";
echo "elemento5=document.getElementById('radio_simple12');\n";
echo "elemento6=document.getElementById('select_orden');\n";
echo "elemento7=document.getElementById('select_farmOrd');\n";
echo "if (elemento4.checked){\n";
	echo "if (elemento6.value==0){\n";
	echo "compara (elemento1.value,elemento2.value);\n";
	echo "}else{\n";
	echo "compara (elemento1.value,elemento7.value);\n";
	echo "}\n";
echo "}\n";
echo "if (elemento5.checked){\n";
echo "compara_familia (elemento1.value,elemento3.value);\n";
//echo "alert('compara_familia ('+ elemento1.value + ' ,' + elemento3.value);\n";
echo "}\n";


echo "}\n";
echo "function mostrar_formulario(id_formulario){\n";
echo "objeto1=document.getElementById('ctoxicidades2');\n";			
echo "objeto2=document.getElementById('f_mostrar_farmacos');\n";
echo "objeto3=document.getElementById('f_mostrar_familias');\n";
echo "objeto4=document.getElementById('select_farm2');\n";
echo "objeto5=document.getElementById('select_fam_farm2');\n";
echo "objeto7=document.getElementById('f_mostrar_ordenados');\n";
	echo "if (id_formulario==1){\n";
	echo "objeto1.innerHTML='';\n";
	echo "objeto2.style.display='block';\n";
	echo "objeto3.style.display='none';\n";
	echo "objeto4.selectedIndex='0';\n";
	echo "document.getElementById('select_orden').selectedIndex='0';\n";
	echo "}else{\n";
	echo "objeto1.innerHTML='';\n";
	echo "objeto2.style.display='none';\n";
	echo "objeto3.style.display='block';\n";
	echo "objeto5.selectedIndex='0';\n";
	echo "objeto7.style.display='none';\n";

	echo "}\n";
echo "document.getElementById('ccomparar').innerHTML='';\n";
echo "}\n";

echo "function actualiza_orden(id_orden){\n";
echo "objeto1=document.getElementById('ctoxicidades2');\n";			
echo "objeto2=document.getElementById('f_mostrar_farmacos');\n";
echo "objeto3=document.getElementById('f_mostrar_familias');\n";
echo "objeto4=document.getElementById('select_farm2');\n";
echo "objeto5=document.getElementById('select_fam_farm2');\n";
echo "objeto6=document.getElementById('radio_simple11');\n";
echo "objeto7=document.getElementById('f_mostrar_ordenados');\n";
echo "objeto8=document.getElementById('select_farmOrd');\n";

echo "if (objeto6.checked){\n";
	echo "if (id_orden==0){\n";
	echo "objeto2.style.display='block';\n";
	echo "objeto7.style.display='none';\n";
	echo "objeto4.selectedIndex='0';\n";
	echo "objeto1.innerHTML='';\n";
	echo "}else{\n";
	echo "objeto2.style.display='none';\n";
	echo "objeto7.style.display='block';\n";
	echo "objeto8.selectedIndex='0';\n";
	echo "objeto1.innerHTML='';\n";
	echo "}\n";
	echo "}\n";
echo "}\n";


echo "//-->\n";
echo "</script>\n";  
?>
