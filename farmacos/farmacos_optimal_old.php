<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies_SEL");
include ("inc/headerA1.php");
function devuelve_toxicidades($farmaco_id,$toxicidad_id,$categoria_id){
global $basedatos,$connect;	
$query_toxicidades="select valor_toxicidad from farmacos_toxicidad where id_farmaco=".$farmaco_id." and id_toxicidad=".$toxicidad_id. " and id_categoria=".$categoria_id;
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
	if ($lista_toxicidades){
	$numero_toxicidades=mysql_num_rows($lista_toxicidades);
		if($numero_toxicidades == 0) {
		return 0;
		} else {
			list($valor_toxicidad)= mysql_fetch_row($lista_toxicidades);
		return $valor_toxicidad;
		}								
	}else{
	return "error";	
	}

}

function lista_toxicidades_farmaco_inv($farmaco_id,$toxicidad_id){
global $basedatos,$connect,$nombre_toxicidad_seleccionada;
echo "<ul class=\"m0\">\n";
	    $query_toxicidades="select nombre_toxicidad,tx1,tx2,toxicidad.id_toxicidad from farmacos_inv_toxicidad,toxicidad  where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=".$farmaco_id;
	     $lista_toxicidades = mysql_query($query_toxicidades, $connect);
		  if ($lista_toxicidades){
		  $numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
			echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<select name=\"select_tx2\" id=\"select_tx2\" class=\"span-7\">\n";        
					while(list($nombre_toxicidad,$tx1,$tx2,$id_toxicidad)= mysql_fetch_row($lista_toxicidades)){ 	
						if ($id_toxicidad==$toxicidad_id){
						$sel = "selected";
						$nombre_toxicidad_seleccionada=$nombre_toxicidad;
						}else{
						$sel = "";
						}
					echo "<option $sel value=\"$id_toxicidad\">$nombre_toxicidad</option>\n";	
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
												
}




echo "<div class=\"span-24 last\">\n";
   echo "<div id=\"tabBody\" class=\"clearfix\">\n";
   echo "<form  name=\"form_farmacos\" class=\"equipos\">\n";
      echo "<div class=\"span-23 last clearfix\">\n";
		 	 			echo "<ul class=\"tabArea\">\n";
							echo "  <li class=\"tabOff\"><a href=\"farmacos.php\">Simple Combination</a></li>\n";
							echo "  <li class=\"tabOff\"><a href=\"farmacos_all.php\">Multiple Combination</a></li>\n";
							echo "  <li class=\"tabOn\"><a href=\"farmacos_optimal.php\">Optimal Combination</a></li>\n";
							echo "  <li class=\"tabOff\"><a  href=\"custom_comparer.php\">Custom Combination</a></li>\n";
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
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Investigational Drug</p>\n";
					echo "<p>\n";
						echo "<select name=\"select_farm2\" id=\"select_farm2\" class=\"span-7\" onChange=actualiza_txopt2(this.value)>\n"; 
						$sql = "select id_farmaco,nombre_farmaco from farmacos_inv order by nombre_farmaco";
						echo "<option value=\"0\">Select Drug</option>\n";	
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
					echo "<p class=\"leyenda\">Tumor type</p>\n";
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
						echo "<input type=\"button\" value=\"Comparacion Optima\"  onClick=\"compara_optima(0)\">\n"; 
					echo "</p>\n";
				echo "</div>\n";
				//para que no de error el java no seria necesario es por compatibilidad
				echo "<div id=\"ccomparar\">\n";
				echo "</div>\n"; 
			
			echo "</div>\n";
		echo "</div>\n";


	echo "</div>\n";//del span 23

}else{

$id_farmaco2=$_GET['id_farmaco2'];
$id_farmaco1=$_GET['id_farmaco1'];
$id_tox2=$_GET['id_tox2'];
$porden=$_GET['porden'];

echo "<div class=\"span-23\">\n";
		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Investigational Drug</p>\n";
					echo "<p>\n";
						echo "<select name=\"select_farm2\" id=\"select_farm2\" class=\"span-7\" onChange=actualiza_txopt2(this.value)>\n"; 
						$sql = "select id_farmaco,nombre_farmaco from farmacos_inv order by nombre_farmaco";
						$sel = "";
						echo "<option value=\"0\">Select Drug</option>\n";	
						mysql_select_db($basedatos,$connect);
						$resultado = mysql_query($sql,$connect);          
								while(list($id_farmaco_lista1,$nombre_farmaco_lista1) = mysql_fetch_row($resultado)) {	
									if ($id_farmaco_lista1==$id_farmaco2){
								 	$sel = "selected";
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
						lista_toxicidades_farmaco_inv($id_farmaco2,$id_tox2);
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";			      
		
		
		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Tumor Type</p>\n";
					echo "<p>\n";
				echo "<select name=\"select_farm1\" id=\"select_farm1\" class=\"span-7\"  onChange=actualiza_in1(this.value)>\n"; 
							echo "<option value=\"0\">All</option>\n";	
							$sel = "";
							$sql = "select id_indicacion,descripcion_indicacion from indicaciones order by descripcion_indicacion";
							mysql_select_db($basedatos,$connect);
							$resultado = mysql_query($sql,$connect);          
								while(list($id_indicacion_lista,$descripcion_indicacion_lista) = mysql_fetch_row($resultado)) {	
								if ($id_indicacion_lista==$id_farmaco1){
								 	$sel = "selected";
									}else{
									$sel = "";
									}
								echo "<option $sel value=\"$id_indicacion_lista\">$descripcion_indicacion_lista</option>\n";	
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
						echo "<input type=\"button\" value=\"Comparacion Optima\"  onClick=\"compara_optima(0)\">\n"; 
					echo "</p>\n";
				echo "</div>\n";
				//para que no de error el java no seria necesario es por compatibilidad
				echo "<div id=\"ccomparar\">\n";
				echo "</div>\n"; 
			
			echo "</div>\n";
		echo "</div>\n";

echo "</div>\n";
echo "<div class=\"span-23\">\n";




//en funcion si son todos o solo los farmacos que tienen indicacion
if ($id_farmaco1==0){
$sql = "select id_farmaco,nombre_farmaco from farmacos order by nombre_farmaco";
}else{
$id_indicacion=$id_farmaco1;
$sql = "select farmacos_indicaciones.id_farmaco,nombre_farmaco,id_indicacion,testado from farmacos_indicaciones,farmacos where farmacos_indicaciones.id_farmaco=farmacos.id_farmaco and id_indicacion=".$id_indicacion;
}


$gradeall=array();
$grade34=array();
$nombresdefarmacos=array();
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($sql,$connect);          
while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	
$gradeall[$id_farmaco_lista]=devuelve_toxicidades($id_farmaco_lista,$id_tox2,0);
$grade34[$id_farmaco_lista]=devuelve_toxicidades($id_farmaco_lista,$id_tox2,4);
$nombresdefarmacos[$id_farmaco_lista]=$nombre_farmaco_lista;
}


if ($porden==0){
asort($gradeall);
}else if ($porden==4){
asort($grade34);
}


$a = 0;
$dcolor_A = "impar";
$dcolor_B = "par"; 
echo "<ul class=\"m0\">\n";
	echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
		echo "<div class=\"span-8\">Farmaco</div>\n";
		echo "<div class=\"span-5\">Toxicidad</div>\n";
		echo "<div class=\"span-2 last\">Grade ALL</div>\n";
		echo "<div class=\"span-0\"><a class=\"bcabeceratabla bdown\" href=\"javascript:compara_optima(0)\"></a></div>\n";
		echo "<div class=\"span-2 last\">Grade 3/4</div>\n";
		echo "<div class=\"span-0\"><a class=\"bcabeceratabla bdown\" href=\"javascript:compara_optima(4)\"></a></div>\n";
		echo "<div class=\"clear\"></div>\n";
	echo "</li>\n";
if ($porden==0){
asort($gradeall);
while (list ($cod_farm,$val_all) = each ($gradeall)){
	//while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	
	
	$resultado_comparacion=busca_toxicidad($cod_farm,$id_tox2);
	
	$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
	echo "<li class=\"$dcolor\">\n";
		echo "<div class=\"span-8\">$nombresdefarmacos[$cod_farm]</div>\n";
		echo "<div class=\"span-5\">$nombre_toxicidad_seleccionada</div>\n";
		echo "<div class=\"span-3\">".$gradeall[$cod_farm]."</div>\n";
		echo "<div class=\"span-3\">".$grade34[$cod_farm]."</div>\n";
		if ($gradeall[$cod_farm]==0 and $grade34[$cod_farm]==0){
		echo "<div class=\"span-2\">".$array_txt_comp[1]."</div>\n";
		}else{
		echo "<div class=\"span-2\">".$array_txt_comp[$resultado_comparacion]."</div>\n";
		}
		
		
		//echo "<div class=\"span-2\">".devuelve_toxicidades($id_farmaco_lista,$id_tox2,0)."</div>\n";
		//echo "<div class=\"span-2 last\">".devuelve_toxicidades($id_farmaco_lista,$id_tox2,4)."</div>\n";
		echo "<div class=\"clear\"></div>\n";
	echo "</li>\n";
	$a = ($dcolor == $dcolor_A ? 1 : 0);
	}
}else if ($porden==4){
asort($grade34);
while (list ($cod_farm,$val_all) = each ($grade34)){
$resultado_comparacion=busca_toxicidad($cod_farm,$id_tox2);
	//while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	
	$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
	echo "<li class=\"$dcolor\">\n";
		echo "<div class=\"span-8\">$nombresdefarmacos[$cod_farm]</div>\n";
		echo "<div class=\"span-5\">$nombre_toxicidad_seleccionada</div>\n";
		echo "<div class=\"span-3\">".$gradeall[$cod_farm]."</div>\n";
		echo "<div class=\"span-3\">".$grade34[$cod_farm]."</div>\n";
		if ($gradeall[$cod_farm]==0 and $grade34[$cod_farm]==0){
		echo "<div class=\"span-2\">".$array_txt_comp[1]."</div>\n";
		}else{
		echo "<div class=\"span-2\">".$array_txt_comp[$resultado_comparacion]."</div>\n";
		}
		
		
		//echo "<div class=\"span-2\">".devuelve_toxicidades($id_farmaco_lista,$id_tox2,0)."</div>\n";
		//echo "<div class=\"span-2 last\">".devuelve_toxicidades($id_farmaco_lista,$id_tox2,4)."</div>\n";
		echo "<div class=\"clear\"></div>\n";
	echo "</li>\n";
	$a = ($dcolor == $dcolor_A ? 1 : 0);
	}
}else{
	while (list ($cod_farm,$val_all) = each ($nombresdefarmacos)){
	$resultado_comparacion=busca_toxicidad($cod_farm,$id_tox2);
	//while(list($id_farmaco_lista,$nombre_farmaco_lista) = mysql_fetch_row($resultado)) {	
	$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
	echo "<li class=\"$dcolor\">\n";
		echo "<div class=\"span-8\">$nombresdefarmacos[$cod_farm]</div>\n";
		echo "<div class=\"span-5\">$nombre_toxicidad_seleccionada</div>\n";
		echo "<div class=\"span-3\">".$gradeall[$cod_farm]."</div>\n";
		echo "<div class=\"span-3\">".$grade34[$cod_farm]."</div>\n";
		if ($gradeall[$cod_farm]==0 and $grade34[$cod_farm]==0){
		echo "<div class=\"span-2\">".$array_txt_comp[1]."</div>\n";
		}else{
		echo "<div class=\"span-2\">".$array_txt_comp[$resultado_comparacion]."</div>\n";
		}

		echo "<div class=\"clear\"></div>\n";
	echo "</li>\n";
	$a = ($dcolor == $dcolor_A ? 1 : 0);
	}
}
				

echo "</ul>\n";	 


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
echo "if (elemento2.value==0){\n";
echo "alert(\"Seleccione Farmaco\");\n";
echo "}else{\n";
echo "window.location=\"farmacos_all.php?id_farmaco1=\" + elemento1.value + \"&id_farmaco2=\" + elemento2.value;\n";
echo "}\n";
echo "}\n";
echo "function compara_optima(porden){\n";
echo "elemento1=document.getElementById('select_farm1');\n";
echo "elemento2=document.getElementById('select_farm2');\n";
echo "elemento3=document.getElementById('select_tx2');\n";
echo "if (elemento2.value==0){\n";
echo "alert(\"Seleccione Farmaco\");\n";
echo "}else{\n";
echo "elemento3=document.getElementById('select_tx2');\n";
//echo "alert(elemento3.value);\n";
echo "window.location=\"farmacos_optimal.php?id_farmaco1=\" + elemento1.value + \"&id_farmaco2=\" + elemento2.value + \"&id_tox2=\" + elemento3.value  + \"&porden=\" + porden  ;\n";
echo "}\n";
echo "}\n";

echo "//-->\n";
echo "</script>\n";  
?>
