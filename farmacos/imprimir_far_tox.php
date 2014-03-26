<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/alg_functions.php");
require('inc/fpdf.php');
define('FPDF_FONTPATH','font/');

$pdf=new FPDF();
$pdf->AliasNbPages();			
//$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
if (!isset($_GET['vf'])){
$vf=0;
}else{
$vf=$_GET['vf'];
}
//$vf=6;

				$query_categorias = "select distinct categorias_dianas.id_categoria_diana,descripcion_categoria_diana 
				from categorias_dianas,farmacos_inv,farmacos_inv_toxicidad
				where categorias_dianas.id_categoria_diana=farmacos_inv.categoria_diana 
				and farmacos_inv.id_farmaco=farmacos_inv_toxicidad.id_farmaco
				and id_toxicidad='".$vf."' order by  categorias_dianas.descripcion_categoria_diana";
				$pdf->SetFont('Times','B',18);
				
				if (!$vf==0){
				$pdf->Cell(190,10,$array_toxicidades_master[$vf],1,1,'C');
				}
				$pdf->SetXY(15,30);
				$resultado_categorias = mysql_query($query_categorias,$connect);
				if ($resultado_categorias){
				$numero_categorias=mysql_num_rows($resultado_categorias);
				    if($numero_categorias == 0) {
				    } else {
					while(list($id_categoria_diana,$descripcion_categoria_diana)= mysql_fetch_row($resultado_categorias)){
				
				$pdf->SetX(15);
				$y_pos=$pdf->GetY();
				$pdf->SetFont('Times','B',12);
				$pdf->SetX(10);
				$pdf->Cell(140,8,$descripcion_categoria_diana,1,0,'L');
				$pdf->SetX(150);
				$pdf->Cell(25,8,'AEs=>10%',1,0,'C');
				$pdf->SetX(175);
				$pdf->Cell(25,8,'Grade=>3',1,1,'C');
				
				
				$query_farmacos = "select farmacos_inv.id_farmaco,nombre_farmaco,tx1,tx2
				from farmacos_inv,farmacos_inv_toxicidad where 
				farmacos_inv.id_farmaco=farmacos_inv_toxicidad.id_farmaco
				and categoria_diana='".$id_categoria_diana."' and  
				id_toxicidad='".$vf."' order by  nombre_farmaco";	
				mysql_select_db($basedatos,$connect);
				$resultado = mysql_query($query_farmacos,$connect);
				
				//echo $query_farmacos;
				
				if ($resultado){
				$numero_farmacos=mysql_num_rows($resultado);
				    if($numero_farmacos == 0) {
				    } else {
						
						while(list($id_farmaco,$nombre_farmaco,$tx1,$tx2)= mysql_fetch_row($resultado)){
						
						$y_pos=$pdf->GetY();
						$pdf->SetX(10);
						$pdf->SetFont('times','',10);
						$pdf->Cell(140,6,$nombre_farmaco,1,0,'L');
						$pdf->SetX(150);
						$pdf->SetFont('zapfdingbats','',10);
						$array_0_1=array("","4");
						
						$pdf->Cell(25,6,$array_0_1[$tx1],1,0,'C');
						$pdf->SetX(175);
						$pdf->Cell(25,6,$array_0_1[$tx2],1,1,'C');
						/*
						$pdf->Cell(25,6,$tx1,1,0,'C');
						$pdf->SetX(175);
						$pdf->Cell(25,6,$tx2,1,1,'C');
						*/
						
						
						
						}
					}		
				}
					 
				
					} //del while categorias
				}//del if numero_categorias
				} // del if resultado_categorias



$pdf->Output();  
?>