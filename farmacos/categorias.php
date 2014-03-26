<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");

function pinta_menu_lateral($id){

echo "<ul class=\"navlateral\">\n";
echo "<li><a href=\"categorias.php?cop=lt\">Toxicidades</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=lct\">Categorias Toxicidad</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=ld\">Dianas</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=ldn0\">Categorias Dianas</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=lcd2\">Familias Farmaco</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=ltt\">Tumor Type</a></li>\n"; 
echo "<li><a href=\"categorias.php?cop=lpw\">Pathways</a></li>\n"; 
echo "</ul>\n"; 
}


function devuelve_array_tox_inv($id_farmaco){
global $connect,$basedatos;
$query_toxicidades="select id_toxicidad,tx1,tx2 from farmacos_inv_toxicidad where id_farmaco='".$id_farmaco."'";
$lista_toxicidades = mysql_query($query_toxicidades, $connect);
$array_tox_farmaco=array();
if ($lista_toxicidades){
$numero_toxicidades=mysql_num_rows($lista_toxicidades);
	if($numero_toxicidades == 0) {
	} else {
		while(list($id_toxicidad,$tx1,$tx2)= mysql_fetch_row($lista_toxicidades)){
		$clave_array1=$id_toxicidad."tx1";
		$clave_array2=$id_toxicidad."tx2";
		$array_tox_farmaco[$clave_array1]=$tx1;
		$array_tox_farmaco[$clave_array2]=$tx2;
		//echo $id_toxicidad."<br>";
		}
	}
}
return $array_tox_farmaco;
}
function lista_toxicidades_categoria_diana($id_categoria_diana,$id_tox_n0){
global $basedatos,$connect;	
	$query_toxicidades="select nombre_toxicidad,tx1,tx2,toxicidad.id_toxicidad from categorias_diana_toxicidad,toxicidad  where  categorias_diana_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_categoria_diana=".$id_categoria_diana." and id_toxicidad_n0='".$id_tox_n0."'";
		//$query_toxicidades="select farmacos_toxicidad.id_toxicidad,nombre_toxicidad,
		//id_categoria,valor_toxicidad from farmacos_toxicidad,toxicidad  where farmacos_toxicidad.id_toxicidad=toxicidad.id_toxicidad and id_farmaco=".$farmaco_id;
		$lista_toxicidades = mysql_query($query_toxicidades, $connect);
		if ($lista_toxicidades){
		$numero_toxicidades=mysql_num_rows($lista_toxicidades);
			if($numero_toxicidades == 0) {
			} else {
			//repartirlo en 3 columnas
			
			$resto=$numero_toxicidades%3;
			if ($resto==1){
			$ad1=1;
			$ad2=0;
			}else if($resto==2){
			$ad1=1;
			$ad2=1;
			}else{
			$ad1=0;
			$ad2=0;
			}
			$filas_col1=($numero_toxicidades-$resto)/3 + $ad1;
			$filas_col2=($numero_toxicidades-$resto)/3+ $ad2;
			$filas_col3=($numero_toxicidades-$resto)/3;

		$a = 0;
		$dcolor_A = "impar";
		$dcolor_B = "par"; 
		$cfilas=1;
		$ccolumnas=1;
		$fin_tabla=$filas_col1;
		$array_0_1=array("","<img class=\"blineatabla bok\" />");
		while(list($nombre_toxicidad,$tx1,$tx2,$id_toxicidad)= mysql_fetch_row($lista_toxicidades)){ 	
		
		if	($cfilas==1){
		echo "<div class=\"span-7\">\n";
		echo "<ul class=\"m0\">\n";
			echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
			echo "<div class=\"span-3\">Toxicidad</div>\n";
			echo "<div class=\"span-1\">AE =>10</div>\n";
			echo "<div class=\"span-1 last\">Gr =>3</div>\n";
			echo "<div class=\"span-0\"></div>\n";
			echo "<div class=\"span-0\"></div>\n";
			echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
		}
		
		
		//while(list($nombre_toxicidad,$id_categoria,$valor_toxicidad)= mysql_fetch_row($lista_toxicidades)){
			$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
			echo "<li class=\"$dcolor\">\n";
				echo "<div class=\"span-3\">".$nombre_toxicidad."</div>\n";
				echo "<div class=\"span-1\">".$array_0_1[$tx1]."</div>\n";
				echo "<div class=\"span-1 last\">".$array_0_1[$tx2]."</div>\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bpapelera\" href=\"javascript:aviso_borrar_toxicidad('".$id_categoria_diana."','".$id_toxicidad."')\"></a></div>\n";
				echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=etcd&id_categoria_diana=".$id_categoria_diana."&id_toxicidad=".$id_toxicidad."')\"></a></div>\n";
				echo "<div class=\"clear\"></div>\n";
			echo "</li>\n";
		$a = ($dcolor == $dcolor_A ? 1 : 0);
		if	($cfilas==$fin_tabla){
		echo "</ul>\n";	
		echo "</div>\n";
		$cfilas=0;
			if ($ccolumnas < 3){
			$ccolumnas=$ccolumnas+1;
			$valor_columnas="filas_col".$ccolumnas;
			$fin_tabla=$$valor_columnas;
			}
		}
		
		
		
		$cfilas=$cfilas+1;
		
		}
		
		}
		}				
}

function listar_toxicidades(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-6\">\n";
		pinta_menu_lateral(1);
		echo "</div>\n";	
		echo "<div class=\"span-17 last\">\n";
	
		echo "<form  name=\"form_txs\">\n";
			echo "<div class=\"span-17 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado Toxicidades</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=at')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-15\">Descripcion Toxicidad</div>\n";
						echo "<div class=\"span-1\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				$query_grptx = "select id_toxicidad_n0,descripcion_toxicidad_n0 from toxicidad_n0 order by descripcion_toxicidad_n0";
				$resultado_grptx = mysql_query($query_grptx,$connect);
				if ($resultado_grptx){
					$numero_grptx=mysql_num_rows($resultado_grptx);
					if($numero_grptx == 0) {
					} else {
							
							while(list($id_toxicidad_n0,$descripcion_toxicidad_no)= mysql_fetch_row($resultado_grptx)){
							echo "<li class=\"cabecera cab_turquesa clearfix\">\n"; 
							echo "<div class=\"span-16\">$descripcion_toxicidad_no</div>\n";
							//echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"categorias.php?cop=ecd&id_categoria_diana=".$id_categoria_diana."\"></a></div>\n";
							echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
									$query_txs = "select id_toxicidad,nombre_toxicidad,id_toxicidad_n0 from toxicidad where id_toxicidad_n0='".$id_toxicidad_n0."'  order by  nombre_toxicidad";
									$resultado_txs = mysql_query($query_txs,$connect);
									if ($resultado_txs){
									$numero_txs=mysql_num_rows($resultado_txs);
										if($numero_txs == 0) {
										} else {
										$a = 0;
										$dcolor_A = "impar";
										$dcolor_B = "par"; 
											while(list($id_toxicidad,$nombre_toxicidad,$id_toxicidad_n0)= mysql_fetch_row($resultado_txs)){
												$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
												echo "<li class=\"$dcolor\">\n";
													echo "<div class=\"span-15\">$nombre_toxicidad</div>\n";
													echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=et&id_toxicidad=".$id_toxicidad."')\"></a></div>\n";
													echo "<div class=\"clear\"></div>\n";
												echo "</li>\n";
												$a = ($dcolor == $dcolor_A ? 1 : 0);
											}
										}		
									}
								 
							//
							}
					}
				}
				
				
				
				
				echo "</ul>\n";	
				
				
				
				echo "</div>\n";	
			
			
			
			
			echo "</div>\n";
		echo "</form>\n";
		
		echo "</div>\n";
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}
function listar_categorias_toxicidad(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-6\">\n";
		pinta_menu_lateral(1);
		echo "</div>\n";	
		echo "<div class=\"span-17 last\">\n";
	
		echo "<form  name=\"form_txs\">\n";
			echo "<div class=\"span-17 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado Categorias Toxicidad</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=act')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-15\">Descripcion Categoria</div>\n";
						echo "<div class=\"span-1\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				$query_grptx = "select id_toxicidad_n0,descripcion_toxicidad_n0 from toxicidad_n0 order by descripcion_toxicidad_n0";
				$resultado_grptx = mysql_query($query_grptx,$connect);
				if ($resultado_grptx){
					$numero_grptx=mysql_num_rows($resultado_grptx);
					if($numero_grptx == 0) {
					} else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_toxicidad_n0,$descripcion_toxicidad_no)= mysql_fetch_row($resultado_grptx)){
							$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-15\">$descripcion_toxicidad_no</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=ect&id_toxicidad_n0=".$id_toxicidad_n0."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
							$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
				echo "</ul>\n";
				
				echo "</div>\n";
			echo "</div>\n";
		echo "</form>\n";
		
		echo "</div>\n";
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}

function listar_dianas(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-6\">\n";
		pinta_menu_lateral(1);
		echo "</div>\n";	
		echo "<div class=\"span-17 last\">\n";
	
		echo "<form  name=\"form_ld\">\n";
			echo "<div class=\"span-17 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado Dianas</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=ad')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-15\">Descripcion Diana</div>\n";
						echo "<div class=\"span-1\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				$query_grpdia = "select id_diana_n0,descripcion_diana_n0 from dianas_n0 order by descripcion_diana_n0";
				$resultado_grpdia = mysql_query($query_grpdia,$connect);
				if ($resultado_grpdia){
					$numero_grpdia=mysql_num_rows($resultado_grpdia);
					if($numero_grpdia == 0) {
					} else {
							
							while(list($id_diana_n0,$descripcion_diana_n0)= mysql_fetch_row($resultado_grpdia)){
							echo "<li class=\"cabecera cab_turquesa clearfix\">\n"; 
							echo "<div class=\"span-16\">$descripcion_diana_n0</div>\n";
							//echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"categorias.php?cop=ecd&id_categoria_diana=".$id_categoria_diana."\"></a></div>\n";
							echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
									$query_dias = "select id_diana,descripcion_diana,id_diana_n0 from dianas where id_diana_n0='".$id_diana_n0."'  order by descripcion_diana";
									$resultado_dias = mysql_query($query_dias,$connect);
									if ($resultado_dias){
									$numero_dias=mysql_num_rows($resultado_dias);
										if($numero_dias == 0) {
										} else {
										$a = 0;
										$dcolor_A = "impar";
										$dcolor_B = "par"; 
											while(list($id_diana,$descripcion_diana,$id_diana_n0)= mysql_fetch_row($resultado_dias)){
												$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
												echo "<li class=\"$dcolor\">\n";
													echo "<div class=\"span-15\">$descripcion_diana</div>\n";
													echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=ed&id_diana=".$id_diana."')\"></a></div>\n";
													echo "<div class=\"clear\"></div>\n";
												echo "</li>\n";
												$a = ($dcolor == $dcolor_A ? 1 : 0);
											}
										}		
									}
								 
							//
							}
					}
				}
				
				
				
				
				echo "</ul>\n";	
				
				
				
				echo "</div>\n";	
			
			
			
			
			echo "</div>\n";
		echo "</form>\n";
		
		echo "</div>\n";
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}





function listar_categorias_dianas(){
global $connect,$basedatos;
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<form  name=\"form_farmacos\">\n";
			echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado Categorias Diana</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana('ventanas_ctg.php?cop=acd')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-20\">Descripcion Categoria</div>\n";
						echo "<div class=\"span-1\">::</div>\n";
						echo "<div class=\"span-1\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$query_categorias = "select id_categoria_diana,descripcion_categoria_diana from categorias_dianas order by descripcion_categoria_diana";
				$resultado_categorias = mysql_query($query_categorias,$connect);
				if ($resultado_categorias){
				$numero_categorias=mysql_num_rows($resultado_categorias);
				    if($numero_categorias == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					while(list($id_categoria_diana,$descripcion_categoria_diana)= mysql_fetch_row($resultado_categorias)){
							$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-20\">$descripcion_categoria_diana</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bbuscar\" href=\"javascript:ver_categoria_diana(0)\"></a></div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"categorias.php?cop=ecd&id_categoria_diana=".$id_categoria_diana."\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
					 
				
				echo "</ul>\n";	
				
				//fin de categorias
				
				echo "</div>\n";	
			
			
			
			
			echo "</div>\n";
		echo "</form>\n";
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}

function editar_categoria_diana($id_categoria_diana){
global $connect,$basedatos;
$query_categorias_dianas = "select id_categoria_diana,descripcion_categoria_diana,tx1desc_cd,tx2desc_cd,comentarios_cd from categorias_dianas where id_categoria_diana=".$id_categoria_diana;	
mysql_select_db($basedatos,$connect);
$resultado = mysql_query($query_categorias_dianas, $connect);

include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
			echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"cabecera1\">\n";
					echo "<p class=\"leyenda\">Edicion Familia Farmaco</p>\n";
				echo "</div>\n";
				if ($resultado){
				$numero_categorias_dianas=mysql_num_rows($resultado);
					if($numero_categorias_dianas == 0) {
					echo "<p class=\"leyenda\">Error No aparece ningun registro</p>\n";
					} else {
						list($id_categoria_diana,$descripcion_categoria_diana,$tx1desc_cd,$tx2desc_cd,$comentarios_cd)= mysql_fetch_row($resultado);
						echo "<form action=\"functions2.php\" method=\"post\" name=\"form_farmacos\">\n";
							echo "<div class=\"cuerpo1\">\n";
							echo "<div class=\"span-12\">\n";
								
								//echo "<div class=\"izq\">\n";
									echo "<div class=\"izq conborde clearfix\">\n";
									echo "<p class=\"formulario\">\n";
										echo "<label for \"descripcion_categoria_diana\" class=\"span-3\">Nombre</label>\n";
										echo "<input type=\"text\" name=\"descripcion_categoria_diana\" id=\descripcion_categoria_diana\" value=\"$descripcion_categoria_diana\" class=\"span-8\" />\n";
									echo "</p>\n";
									echo "<p class=\"fomulariosin\">\n";
									echo "<label for \"comentarios\" class=\"span-3\">Comentarios</label>\n";
									echo "<textarea name=\"comentarios_cd\"  id=\"comentarios_cd\" class=\"span-8\">$comentarios_cd</textarea>\n";
									echo "</p>\n";
									echo "</div>\n";
										
									
									echo "</div>\n";
								//echo "</div>\n";
							
							
							echo "</div>\n";
							echo "<div class=\"span-11 last\">\n";
							echo "<div class=\"izq conborde clearfix\">\n";
											echo "<p class=\"leyenda\">related adverse events (AEs) reported in =>10%</p>\n";
											echo "<textarea name=\"tx1desc_cd\" id=\"tx1desc_cd\" class=\"span-10\">$tx1desc_cd</textarea>\n";
										echo "</div>\n";	
										echo "<div class=\"izq conborde clearfix\">\n";
											echo "<p class=\"leyenda\">drug-related AEs => Gr 3</p>\n";
											echo "<textarea name=\"tx2desc_cd\" id=\"tx2desc_cd\" class=\"span-10\">$tx2desc_cd</textarea>\n";
										echo "</div>\n";
							
							echo "</div>\n";
							echo "<div class=\"span-23 last\">\n";
									echo "<p class=\"fomulariosin centrado\">\n";
										echo "<input type=\"hidden\" name=\"id_categoria_diana\" id=\"id_categoria_diana\" value=\"$id_categoria_diana\" />\n";
										echo "<input type=\"hidden\" name=\"op\" id=\"op\" value=\"ecd\" />\n";
										echo "<input type=\"submit\" value=\"Actualizar\"/>\n"; 
									echo "</p>\n";
							
							echo "</div>\n";
							
							echo "<div class=\"span-23 last\">\n";
								echo "<div class=\"recuadroizq conborde\">\n";
									
									echo "<div class=\"cabecerarecuadro clearfix\">\n";
										echo "<div class=\"titulorecuadro\">Toxicidad Familia Farmaco</div>\n";
										echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=atcd&id_categoria_diana=".$id_categoria_diana."')\"></a>\n";
									echo "</div>\n";
									echo "<div class=\"cuerporecuadro clearfix\">\n";
										$query_grptx="select distinct toxicidad_n0.id_toxicidad_n0,descripcion_toxicidad_n0 from toxicidad_n0,toxicidad,categorias_diana_toxicidad where
											id_categoria_diana='".$id_categoria_diana."' and
											toxicidad_n0.id_toxicidad_n0=toxicidad.id_toxicidad_n0 and
											toxicidad.id_toxicidad=categorias_diana_toxicidad.id_toxicidad ";
										$resultado_grptx = mysql_query($query_grptx,$connect);
										if ($resultado_grptx){
										$numero_grptx=mysql_num_rows($resultado_grptx);
											if($numero_grptx == 0) {
											} else {
												while(list($id_grptx,$descripcion_grptx)= mysql_fetch_row($resultado_grptx)){
													echo "<div class=\"recuadrotox conborde\">\n";//hay que busca estilos
														echo "<div class=\"cabeceratox clearfix\">$descripcion_grptx</div>\n";
														echo "<div class=\"cuerpotox clearfix\">\n";//hay que busca estilos
														lista_toxicidades_categoria_diana($id_categoria_diana,$id_grptx);
														echo "</div>\n";
													echo "</div>\n";
												}
											}	
										}
									echo "</div>\n";
								      
								echo "</div>\n";
							echo "</div>\n";
										
						
						echo "</div>\n";	
						echo "</form>\n";
					}
				}
			
			
			echo "</div>\n";
		
$query_toxicidades_cabecera="SELECT distinct farmacos_inv_toxicidad.id_toxicidad,substring(toxicidad.nombre_toxicidad,1,20) FROM 
farmacos_inv,farmacos_inv_toxicidad,toxicidad where 
farmacos_inv.id_farmaco=farmacos_inv_toxicidad.id_farmaco and
farmacos_inv_toxicidad.id_toxicidad=toxicidad.id_toxicidad and categoria_diana='".$id_categoria_diana."'";

//echo $query_toxicidades_cabecera;
$array_toxicidades_cabecera=array();

$lista_toxicidades_cabecera=mysql_query($query_toxicidades_cabecera, $connect);
if ($lista_toxicidades_cabecera){
	$numero_toxicidades_cabecera=mysql_num_rows($lista_toxicidades_cabecera);
		if($numero_toxicidades_cabecera == 0) {
		}else{
			while(list($id_toxicidad_cabecera,$nombre_toxicidad_cabecera)= mysql_fetch_row($lista_toxicidades_cabecera)){
			$array_toxicidades_cabecera[$id_toxicidad_cabecera]=$nombre_toxicidad_cabecera;
			}
		}
}


echo "<div class=\"span-23 last\">\n";
	echo "<div class=\"span-6\">\n";
	$query_farmacos = "select id_farmaco,substring(nombre_farmaco,1,40) from farmacos_inv where categoria_diana='".$id_categoria_diana."'";
	mysql_select_db($basedatos,$connect);
	$resultado = mysql_query($query_farmacos,$connect);
	echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-6\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-6\">Drug Name</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
	
	if ($resultado){
	$numero_farmacos=mysql_num_rows($resultado);
		if($numero_farmacos == 0) {
		} else {
				$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
				$array_farmacos_inv=array();
				while(list($id_farmaco,$nombre_farmaco)= mysql_fetch_row($resultado)){
					$array_farmacos_inv[$id_farmaco]=$nombre_farmaco;
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-6 clearfix\">&nbsp;$nombre_farmaco</div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
					$a = ($dcolor == $dcolor_A ? 1 : 0);
				}
		}		
	}
	echo "</ul>\n";	
	echo "</div>\n";
	echo "<div class=\"span-17 last\">\n";
		echo "<div class=\"scrollh\">\n";
			echo "<div class=\"contenedor_h\">\n";
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
							
							echo "<div class=\"span-4\">$des_tox</div>\n";
						
						
						}
					reset($array_toxicidades_cabecera);
					echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
							echo "<div class=\"span-2\">AE=>10</div>\n";
							echo "<div class=\"span-2\">GR=>3</div>\n";
						
						}
					reset($array_toxicidades_cabecera);
					echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
					$a = 0;
				$dcolor_A = "impar";
				$dcolor_B = "par"; 
					while(list($idf,$nf)= each ($array_farmacos_inv)){
					$array_tox_farmaco=devuelve_array_tox_inv($idf);
					$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								while (list ($cod_tox, $des_tox) = each ($array_toxicidades_cabecera)){
									$clave_array=$cod_tox."tx1";
									if (array_key_exists($clave_array,$array_tox_farmaco)){
									echo "<div class=\"span-2\">$array_tox_farmaco[$clave_array]</div>\n";
									}else{
									echo "<div class=\"span-2\">0</div>\n";
									}
									$clave_array=$cod_tox."tx2";
									if (array_key_exists($clave_array,$array_tox_farmaco)){
									echo "<div class=\"span-2\">$array_tox_farmaco[$clave_array]</div>\n";
									}else{
									echo "<div class=\"span-2\">0</div>\n";
									}
								
								
								}
								reset($array_toxicidades_cabecera);
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
					$a = ($dcolor == $dcolor_A ? 1 : 0);
					}
	
				echo "</ul>\n";
			echo "</div>\n";
		echo "</div>\n";
	echo "</div>\n";
echo "</div>\n";
	
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}

function listar_categorias_dianas2(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-6\">\n";
		pinta_menu_lateral(1);
		echo "</div>\n";	
		echo "<div class=\"span-17 last\">\n";
	
		echo "<form  name=\"form_txs\">\n";
			echo "<div class=\"span-17 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado Familias  </div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=acd')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-15\">Familia Farmaco</div>\n";
						echo "<div class=\"span-1\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				$query_categorias = "select id_categoria_diana,descripcion_categoria_diana from categorias_dianas order by descripcion_categoria_diana";
				$resultado_categorias = mysql_query($query_categorias,$connect);
				if ($resultado_categorias){
				$numero_categorias=mysql_num_rows($resultado_categorias);
				    if($numero_categorias == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					while(list($id_categoria_diana,$descripcion_categoria_diana)= mysql_fetch_row($resultado_categorias)){
												$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
												echo "<li class=\"$dcolor\">\n";
												echo "<div class=\"span-15\">$descripcion_categoria_diana</div>\n";
												echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=ecd&id_categoria_diana=".$id_categoria_diana."')\"></a></div>\n";
												echo "<div class=\"clear\"></div>\n";
												echo "</li>\n";
												$a = ($dcolor == $dcolor_A ? 1 : 0);
											}
										}		
									}			
				
				echo "</ul>\n";	
				
				
				
				echo "</div>\n";	
			
			
			
			
			echo "</div>\n";
		echo "</form>\n";
		
		echo "</div>\n";
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}
function listar_tipos_tumor(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-6\">\n";
		pinta_menu_lateral(1);
		echo "</div>\n";	
		echo "<div class=\"span-17 last\">\n";
	
		echo "<form  name=\"form_txs\">\n";
			echo "<div class=\"span-17 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado Tipos Tumor</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=att')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-15\">Tipo Tumor</div>\n";
						echo "<div class=\"span-1\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				$query_indicaciones = "select id_indicacion,descripcion_indicacion from indicaciones order by descripcion_indicacion";
				$resultado_indicaciones = mysql_query($query_indicaciones,$connect);
				if ($resultado_indicaciones){
				$numero_indicaciones=mysql_num_rows($resultado_indicaciones);
				    if($numero_indicaciones == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					while(list($id_indicacion,$descripcion_indicacion)= mysql_fetch_row($resultado_indicaciones)){
												$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
												echo "<li class=\"$dcolor\">\n";
												echo "<div class=\"span-15\">$descripcion_indicacion</div>\n";
												echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana('ventanas_ctg.php?cop=ett&id_indicacion=".$id_indicacion."')\"></a></div>\n";
												echo "<div class=\"clear\"></div>\n";
												echo "</li>\n";
												$a = ($dcolor == $dcolor_A ? 1 : 0);
											}
										}		
									}			
				
				echo "</ul>\n";	
				
				
				
				echo "</div>\n";	
			
			
			
			
			echo "</div>\n";
		echo "</form>\n";
		
		echo "</div>\n";
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}

function listar_dianas_n0(){
global $connect,$basedatos;
mysql_select_db($basedatos,$connect);
include ("inc/headerA.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-6\">\n";
		pinta_menu_lateral(1);
		echo "</div>\n";	
		echo "<div class=\"span-17 last\">\n";
	
		echo "<form  name=\"form_dian0\">\n";
			echo "<div class=\"span-17 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado Categorias Dianas</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=adn0')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						echo "<div class=\"span-15\">Descripcion Categoria</div>\n";
						echo "<div class=\"span-1\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				
				$query_dian0 = "select id_diana_n0,descripcion_diana_n0 from dianas_n0 order by descripcion_diana_n0";
				$resultado_dian0 = mysql_query($query_dian0,$connect);
				if ($resultado_dian0){
					$numero_dian0=mysql_num_rows($resultado_dian0);
					if($numero_dian0 == 0) {
					} else {
						$a = 0;
						$dcolor_A = "impar";
						$dcolor_B = "par"; 
						while(list($id_diana_n0,$descripcion_diana_no)= mysql_fetch_row($resultado_dian0)){
							$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-15\">$descripcion_diana_no</div>\n";
								echo "<div class=\"span-1\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=edn0&id_diana_n0=".$id_diana_n0."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
							$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
				echo "</ul>\n";
				
				echo "</div>\n";
			echo "</div>\n";
		echo "</form>\n";
		
		echo "</div>\n";
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}

function listar_pathways(){
global $connect,$basedatos;
include ("inc/headerB.php");
echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
		echo "<div class=\"span-6\">\n";
		pinta_menu_lateral(1);
		echo "</div>\n";	
		echo "<div class=\"span-17 last\">\n";
		
		echo "<form  name=\"form_farmacos\">\n";
			echo "<div class=\"span-17 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
				echo "<div class=\"titulorecuadro\">Listado Pathways</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
				echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=apw')\"></a>\n";
				echo "</div>\n";
				echo "<div class=\"cuerpo1\">\n";
				//query categorias_dianas
				echo "<ul class=\"m0\">\n";
					echo "<li class=\"cabecera cab_gris clearfix\">\n"; 
						
						echo "<div class=\"span-0\">&nbsp;</div>\n";
						echo "<div class=\"span-2\">ID EXTERNAL</div>\n";
						echo "<div class=\"span-13\">Pathway Name</div>\n";
						echo "<div class=\"span-0\">::</div>\n";
						echo "<div class=\"clear\"></div>\n";
					echo "</li>\n";
				$query_pathways = "select id_pathway,id_external,nombre_pathway from pathways order by nombre_pathway";	
				
				$resultado_pathways = mysql_query($query_pathways,$connect);
				if ($resultado_pathways){
				$numero_pathways=mysql_num_rows($resultado_pathways);
				    if($numero_pathways == 0) {
				    } else {
					$a = 0;
					$dcolor_A = "impar";
					$dcolor_B = "par"; 
					while(list($id_pathway,$id_external,$nombre_pathway)= mysql_fetch_row($resultado_pathways)){
							$link_pathway="http://www.ncbi.nlm.nih.gov/biosystems/".$id_external;
							$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
							echo "<li class=\"$dcolor\">\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bpdf\" href=\"javascript:abrir_ventana('".$link_pathway."')\"></a></div>\n";
								echo "<div class=\"span-2\">$id_external</div>\n";
								echo "<div class=\"span-13\">$nombre_pathway</div>\n";
								echo "<div class=\"span-0\"><a class=\"blineatabla bedit\" href=\"javascript:abrir_ventana500('ventanas_ctg.php?cop=epw&id_pathway=".$id_pathway."')\"></a></div>\n";
								echo "<div class=\"clear\"></div>\n";
							echo "</li>\n";
						$a = ($dcolor == $dcolor_A ? 1 : 0);
						}
					}		
				}
					 
				echo "</ul>\n";	
				
				//fin de categorias
				
				echo "</div>\n";	
			echo "</div>\n";
		echo "</form>\n";
	echo "</div>\n";
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
}




if (!isset($_GET['cop'])){
$cop="lfn";	
}else{
$cop=$_GET['cop'];
}
	
switch($cop) {
default:
listar_toxicidades();	   
break;
case "ld":
listar_dianas();
break;

case "lcd2":
listar_categorias_dianas2();
break;

case "ecd":
editar_categoria_diana($_GET['id_categoria_diana']);
break;

case "lt":
listar_toxicidades();
break;

case "lct":
listar_categorias_toxicidad();
break;

case "ltt":
listar_tipos_tumor();
break;

case "ldn0":
listar_dianas_n0();
break;
case "lpw":
listar_pathways();
break;

}





/*
echo "<script language=\"JavaScript\" src=\"inc/tabs_equipo.js\"></script>\n";
echo "<script language=\"JavaScript\" src=\"inc/date-picker.js\"></script>\n";
*/
echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"links1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=600\");\n";
echo "}\n";
echo "function abrir_ventana500(a){\n";
echo "window.open (a,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=500,height=400\");\n";
echo "}\n";
echo "function aviso_borrar_toxicidad(des1,des2){\n";
echo "if (confirm(\"¿Desea eliminar esta toxicidad?\")){\n";
echo "var destino=\"functions2.php?op=deltcd&id_categoria_diana=\" +des1+ \"&id_toxicidad=\" + des2; \n";
echo "window.open (destino,\"farmacos1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,copyhistory=no,width=100,height=100\");\n";
echo "}\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>