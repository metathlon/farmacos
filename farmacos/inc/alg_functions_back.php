<?php


$query_out_comp="select id_result,texto_result,peso_result from alg_results";
$lista_out_comp=mysql_query($query_out_comp, $connect);
if ($lista_out_comp){
	$numero_out_comp=mysql_num_rows($lista_out_comp);
		if($numero_out_comp == 0) {
		echo "ERROR EN OUT_COMP";
		}else{
			while(list($id_result,$texto_result,$peso_result)= mysql_fetch_row($lista_out_comp)){
			$array_txt_comp[$id_result]=$texto_result;
			$array_peso_comp[$id_result]=$peso_result;
			}
		}



}else{
echo "ERROR EN OUT_COMP";
}

$query_toxicidades_master="select id_toxicidad,nombre_toxicidad from toxicidad order by nombre_toxicidad";
$lista_toxicidades_master=mysql_query($query_toxicidades_master, $connect);
if ($lista_toxicidades_master){
	$numero_toxicidades_master=mysql_num_rows($lista_toxicidades_master);
		if($numero_toxicidades_master == 0) {
		echo "ERROR EN TOXICIDADES MASTER";
		}else{
			while(list($id_toxicidad_master,$nombre_toxicidad_master)= mysql_fetch_row($lista_toxicidades_master)){
			$array_toxicidades_master[$id_toxicidad_master]=$nombre_toxicidad_master;
			}
		}



}else{
echo "ERROR EN TOXICIDADES MASTER";
}


function busca_toxicidad($id_farmaco,$id_toxicidad){
global $basedatos,$connect;
$query_toxicidades="select id_categoria, valor_toxicidad from farmacos_toxicidad
where id_farmaco=".$id_farmaco." and id_toxicidad=".$id_toxicidad;
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
			    if ($lista_toxicidades){
				 
				    $numero_toxicidades=mysql_num_rows($lista_toxicidades);
				    if($numero_toxicidades == 0) {
				    $resultado_comparacion=1;
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
							        $resultado_comparacion=0;
								}else{
								list($id_alg_n1,$resultado)= mysql_fetch_row($res1);
								//$resultado_comparacion1="mixto".$valor_all.$id_alg_n1.$resultado;
								}
							}else{
							$resultado_comparacion=-1;	
							}
						$query2= "select id_alg_n1,resultado from alg_n1 where parametro=4 and valor_max >=".$valor_34." and valor_min <=".$valor_34;
						$res2 = mysql_query($query2, $connect);
							if ($res2){
								$nreg2=mysql_num_rows($res2);
								if($nreg2 == 0) {
							        $resultado_comparacion=0;
								}else{
								list($id_alg_n2,$resultado2)= mysql_fetch_row($res2);
								//$resultado_comparacion2="mixto".$valor_34.$id_alg_n2.$resultado2;
								}
							}else{
							$resultado_comparacion=-1;	
							}
						$query_comb="select resultado_cmb from alg_cmb where id_alg_n11=".$id_alg_n1." and id_alg_n12=".$id_alg_n2;
						$res_comb = mysql_query($query_comb, $connect);
							if ($res_comb){
								$nreg3=mysql_num_rows($res_comb);
								if($nreg3 == 0) {
							        $resultado_comparacion=0;
								}else{
								list($resultado3)= mysql_fetch_row($res_comb);
								$resultado_comparacion=$resultado3;
								}
							}else{
							$resultado_comparacion=-1;	
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
							$resultado_comparacion=-1;	
							}
						  //Existen toxicidades para grado 34 solo
						  } else if (array_key_exists(4,$array_valores_categoria)){
						  $valor_34=$array_valores_categoria[4];
						  $query2= "select id_alg_n1,resultado from alg_n1 where parametro=4 and valor_max >=".$valor_34." and valor_min <=".$valor_34;
						  $res2 = mysql_query($query2, $connect);
							if ($res2){
								$nreg2=mysql_num_rows($res2);
								if($nreg2 == 0) {
							        $resultado_comparacion=-1;
								}else{
								list($id_alg_n2,$resultado2)= mysql_fetch_row($res2);
								$resultado_comparacion=$resultado2;
								//$resultado_comparacion="uno".$valor_34;
								}
							}else{
							$resultado_comparacion=-1;	
							}

						  }else{
						  //por ejemplo existe grado 3;
						  $resultado_comparacion=0;
						  }

					
					}

				}else{
				$resultado_comparacion=-1;
				}
return  $resultado_comparacion;

}

function comparar_farmacos_fda($id_fda1,$id_fda2){
global $basedatos,$connect;

$array_toxicidades1=array();
$array_toxicidades2=array();
$gradeall_fd1=array();
$grade34_fd1=array();
$gradeall_fd2=array();
$grade34_fd2=array();

echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-1\">All Grd</div>\n";
			      echo "<div class=\"span-1 last\">Grd 3/4</div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";

$query_toxicidades1="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,id_categoria, valor_toxicidad from farmacos_toxicidad,toxicidad  where  farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=$id_fda1";
	$lista_toxicidades1 = mysql_query($query_toxicidades1, $connect);
		if ($lista_toxicidades1){
		$numero_toxicidades1=mysql_num_rows($lista_toxicidades1);
			if($numero_toxicidades1 == 0) {
			} else {
					
				while(list($id_toxicidad1,$nombre_toxicidad1,$id_categoria1,$valor_toxicidad1)= mysql_fetch_row($lista_toxicidades1)){	
				$array_toxicidades1[$id_toxicidad1]=$nombre_toxicidad1;
					  if ($id_categoria1==0){
					  $gradeall_fd1[$id_toxicidad1]=$valor_toxicidad1;
					  }
					  if ($id_categoria1==4){
					  $grade34_fd1[$id_toxicidad1]=$valor_toxicidad1;
					  }
				}
			}
		}	    
$query_toxicidades2="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,id_categoria, valor_toxicidad from farmacos_toxicidad,toxicidad  where  farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=$id_fda2";
	$lista_toxicidades2 = mysql_query($query_toxicidades2, $connect);
		if ($lista_toxicidades2){
		$numero_toxicidades2=mysql_num_rows($lista_toxicidades2);
			if($numero_toxicidades2 == 0) {
			} else {
			
			while(list($id_toxicidad2,$nombre_toxicidad2,$id_categoria2,$valor_toxicidad2)= mysql_fetch_row($lista_toxicidades2)){	
				$array_toxicidades2[$id_toxicidad2]=$nombre_toxicidad2;
				if ($id_categoria2==0){
					  $gradeall_fd2[$id_toxicidad2]=$valor_toxicidad2;
					  }
					  if ($id_categoria2==4){
					  $grade34_fd2[$id_toxicidad2]=$valor_toxicidad2;
					  }
				}
			}
		}	    

// visualizacion comparacion
$array_tox_comp=array();
//unimos las matrices de toxicidades


$array_tox_comp=$array_toxicidades1 + $array_toxicidades2;
asort($array_tox_comp);
$a = 0;
$dcolor_A = "impar";
$dcolor_B = "par"; 
   while (list ($cod_tox, $des_tox) = each ($array_tox_comp)){
   //while(list($nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){
   
   if (array_key_exists($cod_tox,$gradeall_fd1)){
	$txall=$gradeall_fd1[$cod_tox];
	}else{
	$txall="---";
	}
	if (array_key_exists($cod_tox,$grade34_fd1)){
	$tx34=$grade34_fd1[$cod_tox];
	}else{
	$tx34="---";
	}
   
   if (array_key_exists($cod_tox,$gradeall_fd2)){
	$txall2=$gradeall_fd2[$cod_tox];
	}else{
	$txall2="---";
	}
	if (array_key_exists($cod_tox,$grade34_fd2)){
	$tx342=$grade34_fd2[$cod_tox];
	}else{
	$tx342="---";
	}
   
   
   
   $dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
   echo "<li class=\"$dcolor\">\n";
      echo "<div class=\"span-4\">$des_tox</div>\n";
      echo "<div class=\"span-1\">".$txall."<br />".$txall2."</div>\n";
      echo "<div class=\"span-1 last\">".$tx34."<br />".$tx342."</div>\n";
      echo "<div class=\"clear\"></div>\n";
   echo "</li>\n";
   $a = ($dcolor == $dcolor_A ? 1 : 0);
   }
echo "</ul>\n";		

}

function comparar_inv_fda($id_finv,$id_fda){
global $basedatos,$connect,$array_txt_comp;
echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-2 last\"></div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";

$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from farmacos_inv_toxicidad,toxicidad,toxicidad_n0 where
		id_farmaco='".$id_finv."' and
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



$query_toxicidades="select farmacos_inv_toxicidad.id_toxicidad,nombre_toxicidad,tx1,tx2 from farmacos_inv_toxicidad,toxicidad
where farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and 
id_farmaco=$id_finv and id_toxicidad_n0='".$id_grptx."' order by nombre_toxicidad asc";
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
					$resultado_comparacion=busca_toxicidad($id_fda,$id_toxicidad);
						if ($tx1==1 or $tx2==1){
						echo "<li class=\"$dcolor\">\n";
						      echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
		        			      echo "<div class=\"span-2\">".$array_txt_comp[$resultado_comparacion]."</div>\n";
						      echo "<div class=\"clear\"></div>\n";
			      			echo "</li>\n";
						//echo "<p>".$nombre_toxicidad."---".busca_toxicidad($id_fda,$id_toxicidad)."</p>\n";
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
	  	}
	}	
}
		
echo "</ul>\n";	
}
function comparar_fam_fda($id_categoria_diana,$id_fda){
global $basedatos,$connect,$array_txt_comp;
echo "<ul class=\"m0\">\n";
			   echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			      echo "<div class=\"span-4\">Toxicidad</div>\n";
			      echo "<div class=\"span-2 last\"></div>\n";
			      echo "<div class=\"clear\"></div>\n";
			   echo "</li>\n";
$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from categorias_diana_toxicidad,toxicidad,toxicidad_n0 where
		id_categoria_diana='".$id_categoria_diana."' and
		categorias_diana_toxicidad.id_toxicidad=toxicidad.id_toxicidad and
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
$query_toxicidades="select categorias_diana_toxicidad.id_toxicidad,nombre_toxicidad,tx1,tx2 from categorias_diana_toxicidad,toxicidad  where categorias_diana_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_categoria_diana='".$id_categoria_diana."' and id_toxicidad_n0='".$id_grptx."' order by nombre_toxicidad asc";
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
					$resultado_comparacion=busca_toxicidad($id_fda,$id_toxicidad);
						if ($tx1==1 or $tx2==1){
						echo "<li class=\"$dcolor\">\n";
						      echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
		        			      echo "<div class=\"span-2 last\">".$array_txt_comp[$resultado_comparacion]."</div>\n";
						      echo "<div class=\"clear\"></div>\n";
			      			echo "</li>\n";
						//echo "<p>".$nombre_toxicidad."---".busca_toxicidad($id_farmaco1,$id_toxicidad)."</p>\n";
						}else{
						echo "<li class=\"$dcolor\">\n";
						      echo "<div class=\"span-4\">$nombre_toxicidad</div>\n";
		        			      echo "<div class=\"span-2 last\">".$array_txt_comp[1]."</div>\n";
						      echo "<div class=\"clear\"></div>\n";
			      			echo "</li>\n";
						//echo "<p>".$nombre_toxicidad."---".$id_toxicidad."VERY LOW</p>\n";
						}
					
					$a = ($dcolor == $dcolor_A ? 1 : 0);
					
				}
			}
		   }
		}
	}	
}
echo "</ul>\n";	
}


















function devuelve_toxicidad_fda($farmaco_id,$toxicidad_id,$categoria_id){
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

function devuelve_toxicidad_inv($farmaco_id,$toxicidad_id){
global $basedatos,$connect;	
$query_toxicidades="select tx1,tx2 from farmacos_inv_toxicidad where id_farmaco=".$farmaco_id." and id_toxicidad=".$toxicidad_id;
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
	if ($lista_toxicidades){
	$numero_toxicidades=mysql_num_rows($lista_toxicidades);
		if($numero_toxicidades == 0) {
		$fila_resultado=array('0','0');
		return $fila_resultado;
		} else {
		$fila_resultado=mysql_fetch_array($lista_toxicidades);	
		return $fila_resultado;
		}								
	}else{
	$fila_resultado=array('error','error');
	return $fila_resultado;
	}

}




?>
