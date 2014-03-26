<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");
$array_texto_tox1=array("","AE>10:YES");
$array_texto_tox2=array("","Grd3:YES");
$array_grptx_f1=array();
$array_grptx_f2=array();
$array_grptx=array();
$array_grptx_ovlp=array();
$array_tx=array();
$array_tx_f1=array();
$array_tx_f2=array();
$array_tx_ovlp=array();
$id_farmaco1=$_GET['id_farmaco1'];
$id_farmaco2=$_GET['id_farmaco2'];
echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-2 last\"></div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";

$query_grptx_f2="select toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0,farmacos_inv_toxicidad.id_toxicidad,nombre_toxicidad
		from farmacos_inv_toxicidad,toxicidad,toxicidad_n0 where
		farmacos_inv_toxicidad.id_farmaco='".$id_farmaco2."' and
		farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
		toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0 order by descripcion_toxicidad_n0,nombre_toxicidad";
		$resultado_grptx_f2 = mysql_query($query_grptx_f2,$connect);
		if ($resultado_grptx_f2){
		$numero_grptx_f2=mysql_num_rows($resultado_grptx_f2);
			if($numero_grptx_f2 == 0) {
			} else {
				while(list($id_grptx,$descripcion_grptx,$id_toxicidad,$nombre_toxicidad)= mysql_fetch_row($resultado_grptx_f2)){
				$array_grptx_f2[$id_grptx]=$descripcion_grptx;
				$array_grptx[$id_grptx]=$descripcion_grptx;
				$array_tx_f2[$id_toxicidad]=$nombre_toxicidad;
				$array_tx[$id_toxicidad]=$nombre_toxicidad;
				}
			    /*
				$array_grptx_f2[][0]=$id_grptx;
				$array_grptx_f2[][1]=$descripcion_grptx;
			 	while (list ($karray) = each ($array_grptx_f2)){
				echo $array_grptx_f2[$karray][0]."=>".$array_grptx_f2[$karray][1]."<br>";
				}
			    */
			
			}

		}

$query_grptx_f1="select toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0,farmacos_toxicidad.id_toxicidad,nombre_toxicidad 
		from farmacos_toxicidad,toxicidad,toxicidad_n0 where
		farmacos_toxicidad.id_farmaco='".$id_farmaco1."' and
		farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
		toxicidad.id_toxicidad_n0=toxicidad_n0.id_toxicidad_n0 order by descripcion_toxicidad_n0,nombre_toxicidad";
		$resultado_grptx_f1 = mysql_query($query_grptx_f1,$connect);
		if ($resultado_grptx_f1){
		$numero_grptx_f1=mysql_num_rows($resultado_grptx_f1);
			if($numero_grptx_f1 == 0) {
			} else {
				while(list($id_grptx,$descripcion_grptx,$id_toxicidad,$nombre_toxicidad)= mysql_fetch_row($resultado_grptx_f1)){
				$array_grptx_f1[$id_grptx]=$descripcion_grptx;
				$array_grptx[$id_grptx]=$descripcion_grptx;
				$array_tx_f1[$id_toxicidad]=$nombre_toxicidad;
				$array_tx[$id_toxicidad]=$nombre_toxicidad;
				}
			    /*
			 	while (list ($karray) = each ($array_grptx_f1)){
				echo $array_grptx_f1[$karray][0]."=>".$array_grptx_f1[$karray][1]."<br>";
				}
			    */
			}

		}
//$array_grptx=array_diff($array_grptx_f2[0],$array_grptx_f1[0]);
//$array_grptx=array_merge($array_grptx_f2, array_diff($array_grptx_f1,$array_grptx_f2));
asort($array_grptx);
$array_grptx_ovlp= array_intersect_assoc($array_grptx_f2,$array_grptx_f1);
$array_tx_ovlp= array_intersect_assoc($array_tx_f2,$array_tx_f1);
while (list ($cod_grptx, $des_grptx) = each ($array_grptx)){
			if (array_key_exists($cod_grptx,$array_grptx_ovlp)){
			echo "<li class=\"cabecera cab_aviso\">\n"; 
							echo "<div class=\"span-6 last\">$des_grptx <br> Potential General Overlapping</div>\n";
							echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
			
			//echo $cod_grptx."=>". $des_grptx."Potencial General Overlaping<br>";
			$query_toxicidades_grp="select id_toxicidad from toxicidad where id_toxicidad_n0=".$cod_grptx." order by nombre_toxicidad";
			$lista_toxicidades_grp=mysql_query($query_toxicidades_grp, $connect);
				if ($lista_toxicidades_grp){
					$numero_toxicidades_grp=mysql_num_rows($lista_toxicidades_grp);
						if($numero_toxicidades_grp == 0) {
						}else{
							$a = 0;
			   				$dcolor_A = "impar";
			  				$dcolor_B = "par"; 
							while(list($id_toxicidad)= mysql_fetch_row($lista_toxicidades_grp)){
												
								
								if (array_key_exists($id_toxicidad,$array_tx_ovlp)){
								//echo $array_tx_ovlp[$id_toxicidad]."OVLP<br>";
								echo "<li class=\"cab_fila\">\n";
						      		echo "<div class=\"span-6\">".$array_tx_ovlp[$id_toxicidad].":Overlap</div>\n";
		        			  		echo "<div class=\"clear\"></div>\n";
			      				echo "</li>\n";
								echo "<li class=\"cab_fila\">\n";
						      		
									$tx12=devuelve_toxicidad_inv($id_farmaco2,$id_toxicidad);
									echo "<div class=\"span-6\">".$array_texto_tox1[$tx12[0]]."&nbsp;".$array_texto_tox2[$tx12[1]]."&nbsp;All Grd:".devuelve_toxicidad_fda($id_farmaco1,$id_toxicidad,0)."&nbsp;Grd3/4:".devuelve_toxicidad_fda($id_farmaco1,$id_toxicidad,4)."</div>\n";
						   
							  /*
							   echo "<div class=\"span-3\">".$array_texto_tox1[$tx1]."&nbsp;".$array_texto_tox2[$tx2]."</div>\n";
						       echo "<div class=\"span-3\">All Grd:".devuelve_toxicidad_fda($id_farmaco1,$id_toxicidad,0)."&nbsp;Grd3/4:".devuelve_toxicidad_fda($id_farmaco1,$id_toxicidad,4)."</div>\n";
							  */
							  		echo "<div class=\"clear\"></div>\n";
			      				echo "</li>\n";
								
								
								
								}else{
									if (array_key_exists($id_toxicidad,$array_tx)){
									$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
									//echo $array_tx[$id_toxicidad]."<br>";
									echo "<li class=\"$dcolor\">\n";
						      			echo "<div class=\"span-6\">".$array_tx[$id_toxicidad]."</div>\n";
		        			  			echo "<div class=\"clear\"></div>\n";
			      					echo "</li>\n";
									
									
									}
								}
							
							$a = ($dcolor == $dcolor_A ? 1 : 0);
							
							}
						}
				}
			}else{
			echo "<li class=\"cabecera cab_turquesa\">\n"; 
							echo "<div class=\"span-6 last\">$des_grptx</div>\n";
							echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
			
			//echo $cod_grptx."=>". $des_grptx."<br>";
			$query_toxicidades_grp="select id_toxicidad from toxicidad where id_toxicidad_n0=".$cod_grptx." order by nombre_toxicidad";
			$lista_toxicidades_grp=mysql_query($query_toxicidades_grp, $connect);
				if ($lista_toxicidades_grp){
					$numero_toxicidades_grp=mysql_num_rows($lista_toxicidades_grp);
						if($numero_toxicidades_grp == 0) {
						}else{
							
							$a = 0;
			   				$dcolor_A = "impar";
			  				$dcolor_B = "par"; 
							while(list($id_toxicidad)= mysql_fetch_row($lista_toxicidades_grp)){
							
									if (array_key_exists($id_toxicidad,$array_tx)){
									//echo $array_tx[$id_toxicidad]."<br>";
									$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
									echo "<li class=\"$dcolor\">\n";
						      			echo "<div class=\"span-6\">".$array_tx[$id_toxicidad]."</div>\n";
		        			  			echo "<div class=\"clear\"></div>\n";
			      					echo "</li>\n";
									
									
									}
								
							$a = ($dcolor == $dcolor_A ? 1 : 0);
							}
						}
				}
			
			
			
			}
		
		}

echo "</ul>\n";	
?>
