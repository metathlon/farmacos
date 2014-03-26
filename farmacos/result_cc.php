<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");
include ("inc/headerA.php");
function pinta_celda1($farmaco_id1,$nombre_farmaco1,$tipo_farmaco){
global $basedatos,$connect;	
echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">$nombre_farmaco1</p>\n";
					echo "<p>\n";
					echo "</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
					echo "<div class=\"scroll200h\">\n";
						echo "<div id=\"ctoxicidades2\">\n";
						if ($tipo_farmaco==0){
						lista_toxicidades_farmaco_fda($farmaco_id1);
						}
						if ($tipo_farmaco==1){
						lista_toxicidades_farmaco_inv($farmaco_id1);
						}
						if ($tipo_farmaco==2){
						echo "CUSTOM";
						}
						//lista_toxicidades_farmaco_inv($id_farmaco2,$id_tox2);
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";			      
}
function pinta_celda2($farmaco_id2,$nombre_farmaco2,$tipo_farmaco2){
global $basedatos,$connect;	
	      echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">$nombre_farmaco2</p>\n";
					echo "<p>\n";
					echo "</p>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
					echo "<div class=\"scroll200h\">\n";
						echo "<div id=\"ctoxicidades2\">\n";
						if ($tipo_farmaco2==0){
						lista_toxicidades_farmaco_fda($farmaco_id2);
						}
						if ($tipo_farmaco2==1){
						lista_toxicidades_farmaco_inv($farmaco_id2);
						}
						if ($tipo_farmaco2==2){
						echo "CUSTOM";
						}
						//lista_toxicidades_farmaco_inv($id_farmaco2,$id_tox2);
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";			
}
function pinta_celda3($farmaco_id1,$farmaco_id2,$tipo_comparacion){
global $basedatos,$connect;	
echo "<div class=\"span-7 last\">\n";
			echo "<div class=\"dcha conborde\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Resultado</p>\n";
					echo "<p>\n"; 
					echo "</p>\n";
				echo "</div>\n";
				echo "<div class=\"scroll200h\">\n";
				echo "<div id=\"ccomparar\">\n";
				if ($tipo_comparacion=='00'){
				comparar_farmacos_fda($farmaco_id1,$farmaco_id2);	
				}
				if ($tipo_comparacion=='10'){
				comparar_inv_fda($farmaco_id1,$farmaco_id2);	
				}
				if ($tipo_comparacion=='01'){
				comparar_inv_fda($farmaco_id2,$farmaco_id1);	
				}
				
				echo "</div>\n"; 
			echo "</div>\n";
			echo "</div>\n";
echo "</div>\n";
}
function pinta_toxicidad_unica($sql2,$farmaco_id1,$nombre_farmaco1,$id_tox2){
global $basedatos,$connect;	
$gradeall=array();
$grade34=array();
$nombresdefarmacos=array();
$toxall_f1=devuelve_toxicidad_fda($farmaco_id1,$id_tox2,0);
$tox34_f1=devuelve_toxicidad_fda($farmaco_id1,$id_tox2,4);



echo "<div class=\"span-23 last\">\n";
	pinta_celda1($farmaco_id1,$nombre_farmaco1,0);
	
	echo "<div class=\"span-15 last\">\n";
		echo "<ul class=\"m0\">\n";
			echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
				echo "<div class=\"span-6\">Farmaco Destino</div>\n";
				echo "<div class=\"span-4\">Toxicidad</div>\n";
				echo "<div class=\"span-2 \">Grade ALL</div>\n";
				echo "<div class=\"span-2 \">Grade 3/4</div>\n";
				echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
			echo "<li class=\"par\">\n";
				echo "<div class=\"span-6\">$nombre_farmaco1</div>\n";
				echo "<div class=\"span-4\">$id_tox2</div>\n";
				echo "<div class=\"span-2\">".$toxall_f1."</div>\n";
				echo "<div class=\"span-2\">".$tox34_f1."</div>\n";
				echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
		echo "</ul>\n";
	echo "</div>\n";
echo "</div>\n";
echo "<div class=\"span-23 last\">\n";

$resultado2 = mysql_query($sql2,$connect);          
	if ($resultado2){
	$numero_farmacos2=mysql_num_rows($resultado2);
		if($numero_farmacos2 == 0) {
			} else {
				while(list($id_farmaco2,$nombre_farmaco2) = mysql_fetch_row($resultado2)) {	
				$gradeall[$id_farmaco2]=devuelve_toxicidad_fda($id_farmaco2,$id_tox2,0);
				$grade34[$id_farmaco2]=devuelve_toxicidad_fda($id_farmaco2,$id_tox2,4);
				$gradeall_suma[$id_farmaco2]=$gradeall[$id_farmaco2]+$toxall_f1;
				$grade34_suma[$id_farmaco2]=$grade34[$id_farmaco2]+$tox34_f1;
				
				$nombresdefarmacos[$id_farmaco2]=$nombre_farmaco2;		      
				}
			$a = 0;
			$dcolor_A = "impar";
			$dcolor_B = "par"; 
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-8\">Farmaco</div>\n";
						echo "<div class=\"span-4\">Toxicidad</div>\n";
						echo "<div class=\"span-2 \">Grade ALL</div>\n";
						echo "<div class=\"span-2 \">Grade 3/4</div>\n";
						echo "<div class=\"span-2 \">Grade ALL +</div>\n";
						echo "<div class=\"span-2 \">Grade 3/4 +</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";

				asort($grade34_suma);
					while (list ($cod_farm,$val_all) = each ($grade34_suma)){
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
						echo "<li class=\"$dcolor\">\n";
							echo "<div class=\"span-8\">$nombresdefarmacos[$cod_farm]</div>\n";
							echo "<div class=\"span-4\">$id_tox2</div>\n";
							echo "<div class=\"span-2\">".$gradeall[$cod_farm]."</div>\n";
							echo "<div class=\"span-2\">".$grade34[$cod_farm]."</div>\n";
							echo "<div class=\"span-2\">".$gradeall_suma[$cod_farm]."</div>\n";
							echo "<div class=\"span-2\">".$grade34_suma[$cod_farm]."</div>\n";
							echo "<div class=\"clear\"></div>\n";
						echo "</li>\n";
					$a = ($dcolor == $dcolor_A ? 1 : 0);
					}
				echo "</ul>\n";
			}
		}


echo "</div>\n";
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
	    $query_toxicidades="select nombre_toxicidad,tx1,tx2 from farmacos_inv_toxicidad,toxicidad  where  farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco='".$farmaco_id."'";
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
      echo "<div class=\"span-23 last\">\n";

$select_custom1=$_POST['select_custom1'];
$select_custom2=$_POST['select_custom2'];
$select_farm1=$_POST['select_farm1'];
$select_farm2=$_POST['select_farm2'];
$radio_custom1=$_POST['radio_custom1'];
$radio_custom2=$_POST['radio_custom2'];
$select_tx1=$_POST['select_tx1'];
//print_r($_POST);

$array_campo_fda=array("","id_farmaco","id_indicacion");
$array_campo_inv=array("","id_farmaco","categoria_diana");


//farmaco1

if ($select_farm1==0){
$filtro_fda="";
$filtro_inv="";
}else{
$filtro_fda=" and ".$array_campo_fda[$radio_custom1]."='".$select_farm1."'";
$filtro_inv=" and ".$array_campo_inv[$radio_custom1]."='".$select_farm1."'";
}
//print_r($array_campo_fda);

switch($select_custom1) {
default:  
break;
case "0":
if ($radio_custom1==1){
$sql = "select id_farmaco,nombre_farmaco from farmacos where 1=1 ".$filtro_fda." order by nombre_farmaco";
}else{
$sql = "select distinct farmacos_indicaciones.id_farmaco,nombre_farmaco from farmacos_indicaciones,farmacos where farmacos_indicaciones.id_farmaco=farmacos.id_farmaco".$filtro_fda;
}

//fda drug
break;
case "1":
if ($radio_custom1==1){
$sql = "select id_farmaco,nombre_farmaco from farmacos_inv where 1=1 ".$filtro_inv." order by nombre_farmaco";
}else{
$sql = "select id_farmaco,nombre_farmaco from farmacos_inv where 1=1 ".$filtro_inv;
//$sql = "select id_diana,descripcion_diana from dianas order by descripcion_diana";  
}

break;
case "2":

break;

}
	
//farmaco2
if ($select_farm2==0){
$filtro_fda="";
$filtro_inv="";
}else{
$filtro_fda=" and ".$array_campo_fda[$radio_custom2]."='".$select_farm2."'";
$filtro_inv=" and ".$array_campo_inv[$radio_custom2]."='".$select_farm2."'";
}


switch($select_custom2) {
default:  
break;
case "0":
if ($radio_custom2==1){
$sql2 = "select id_farmaco,nombre_farmaco from farmacos where 1=1 ".$filtro_fda." order by nombre_farmaco";
}else{
$sql2 = "select distinct farmacos_indicaciones.id_farmaco,nombre_farmaco from farmacos_indicaciones,farmacos where farmacos_indicaciones.id_farmaco=farmacos.id_farmaco".$filtro_fda;
}

//fda drug
break;
case "1":
if ($radio_custom2==1){
$sql2 = "select id_farmaco,nombre_farmaco from farmacos_inv where 1=1 ".$filtro_inv." order by nombre_farmaco";
}else{
$sql2 = "select id_farmaco,nombre_farmaco from farmacos_inv where 1=1 ".$filtro_inv;
//$sql = "select id_diana,descripcion_diana from dianas order by descripcion_diana";  
}

break;
case "2":

break;

}



if ($select_custom1==0 and  $select_custom2==0 and  $select_farm1==0 and $select_farm2==0){
echo "<p class=\"leyenda\">Demasiados resultados para visualizar</p>\n";
}else{
//caso de una toxicidad
if ($select_tx1!=0){
//cambio $sql por sql2
$sql_temp=$sql;
$sql=$sql2;
$sql2=$sql_temp;
}


$tipo_comparacion=$select_custom1.$select_custom2;

mysql_select_db($basedatos,$connect);
$resultado = mysql_query($sql,$connect);          
	if ($resultado){
		$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {
			while(list($id_farmaco1,$nombre_farmaco1) = mysql_fetch_row($resultado)) {	
				if ($select_tx1==0){
					$resultado2 = mysql_query($sql2,$connect);          
					if ($resultado2){
					$numero_farmacos2=mysql_num_rows($resultado2);
						if($numero_farmacos2 == 0) {
						} else {
							while(list($id_farmaco2,$nombre_farmaco2) = mysql_fetch_row($resultado2)) {	
								echo "<div class=\"span-23\">\n";
								pinta_celda1($id_farmaco1,$nombre_farmaco1,$select_custom1);
								pinta_celda2($id_farmaco2,$nombre_farmaco2,$select_custom2);
								pinta_celda3($id_farmaco1,$id_farmaco2,$tipo_comparacion);
								echo "</div>\n";			      
							}
						}
					}
				}else{
				pinta_toxicidad_unica($sql2,$id_farmaco1,$nombre_farmaco1,$select_tx1);
				}
			}
		}
	}



} //del if deemasiados resultados




//echo $sql;
	
	
	
	
	
		/*
		echo "<div class=\"span-8\">\n";
			echo "<div class=\"izq conborde\">\n";
				echo "<p class=\"leyenda\">Drug Test 1</p>\n";
				echo "<div class=\"cabeceraseleccion\">\n";
					echo "<p class=\"formulario\">\n";
					echo "<select name=\"select_custom1\" id=\"select_custom1\" class=\"span-7\" onChange=actualiza_custom(1)>\n"; 
						echo "<option value=\"-1\">Select Option 2</option>\n";	
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
						echo "<input type=\"button\" value=\"Comparacion Multiple\"  onClick=\"compara_multiple()\">\n"; 
					echo "</p>\n";
				echo "</div>\n";
				//para que no de error el java no seria necesario es por compatibilidad
				echo "<div id=\"ccomparar\">\n";
				echo "</div>\n"; 
			
			echo "</div>\n";
		echo "</div>\n";

*/
			
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
echo "elemento1=document.getElementById('select_farm1');\n";
echo "elemento2=document.getElementById('select_farm2');\n";
echo "if (elemento2.value==-1){\n";
echo "alert(\"Seleccione Farmaco\");\n";
echo "}else{\n";
echo "window.location=\"farmacos_ci.php?id_farmaco1=\" + elemento1.value + \"&id_farmaco2=\" + elemento2.value;\n";
echo "}\n";
echo "}\n";
echo "function prueba(){\n";
echo "alert(\"Hola\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>
