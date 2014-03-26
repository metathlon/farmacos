<?php
//include ("inc/login.php"); 
include_once("classes/class.header.php");
$cabecera = new cabecera("blobs.css",10);
echo $cabecera->get_php_code();

include ("inc/config.php");
$array_menu_superior=array("mutaciones.php"=>"Gene Mutations","pathways.php"=>"Oncogenic Pathways","custom_pathways.php"=>"Custom Pathways_SEL");
include ("inc/headerB.php");
function limpiar_tablas_temp() {
global $connect,$basedatos,$IdUsuario;
$querya="DELETE FROM f_fda_temp WHERE  IdUsuario='".$IdUsuario."'";
$resulta = mysql_query($querya,$connect);
$querya="DELETE FROM f_inv_temp WHERE  IdUsuario='".$IdUsuario."'";
$resulta = mysql_query($querya,$connect);
}

limpiar_tablas_temp();

echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
   		echo "<form  name=\"form_farmacos\" >\n";
			echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"cabecera1 clearfix\">\n";
					echo "<div class=\"titulorecuadro\">Custom Pathways</div>\n";
				//echo "<p class=\"leyenda\">Listado Farmacos</p>\n";
					//echo "<a class=\"botoncabecera badd\" href=\"javascript:abrir_ventana('ventanas_custom.php?cop=apwc')\"></a>\n";
				echo "</div>\n";
				echo "<div  id=\"cpathways\" class=\"cabecera1 clearfix\">\n";
				echo "<p class=\"leyenda\"><input type=\"button\" value=\"Add Pathways\"  onClick=\"abrir_ventana('ventanas_custom.php?cop=apwc')\">&nbsp;<input type=\"button\" value=\"Clear Pathways\"  onClick=\"clear_farmacos()\"></p>\n";
				echo "</div>\n";
				
				echo "<div class=\"span-8\">\n";
	   				echo "<div class=\"izq conborde\">\n";
	   					echo "<div class=\"cabecera1\">\n";
		  					echo "<p class=\"leyenda\">FDA Approved Drug by Tumor Type</p>\n";
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
	   					echo "<div class=\"cabecera1\">\n";
		  					echo "<p class=\"leyenda\">Investigational Drug</p>\n";
		 				 echo "</div>\n";
	      				 echo "<div class=\"cuerpo1\">\n";
						 	echo "<div class=\"scroll200h\">\n";
		    					echo "<div id=\"ctoxicidades2\">\n";
								
								echo "</div>\n";
					  		echo "</div>\n";
	      				 echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";		
				echo "<div class=\"span-7 last clearfix\">\n";
					echo "<div class=\"izq conborde\">\n";
						echo "<div class=\"cabecera1\">\n";
							echo "<p class=\"leyenda\">\n";
								echo "<input type=\"button\" value=\"Start Test\"  onClick=\"compara_farmacos()\">\n"; 
							echo "</p>\n";
						echo "</div>\n";
						echo "<div class=\"cuerpo1\">\n";
							echo "<div class=\"scroll200h\">\n";
							echo "</div>\n";
						echo "</div>\n";
					echo "</div>\n";
				echo "</div>\n";
	 echo "</div>\n";
     echo "<div class=\"span-23 last\">\n";
	 echo "<div id=\"ccomparar\">\n";
	echo "</div>\n"; 
	 
	 echo "</div>\n";
	  
	   echo "</form>\n";
      echo "</div>\n";
echo "</div>\n";


include ("inc/footer_horizontal.php");
echo "<script language=\"JavaScript\" src=\"inc/farmacos.js\"></script>\n";
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"ventana_pathways\",\"left=50,top=50,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=600\");\n";
echo "}\n";
echo "function clear_farmacos(){\n";
echo "window.location='custom_pathways.php';\n";
echo "}\n";

echo "function compara_farmacos(){\n";
echo "var farmacos_fda='';\n";
echo "var farmacos_inv='';\n";
echo "var farmacos_fam='';\n";
echo "for (i=0;ele=document.form_farmacos.elements[i];i++){\n";
	echo "if (ele.type=='checkbox'){\n";
		echo "if (ele.checked){\n";
			echo "if (ele.name.indexOf('chk_ffda_')==0){\n";
			echo "farmacos_fda=farmacos_fda + ele.name.substring(9) + 'x' ;\n";
			echo "}\n";
			echo "if (ele.name.indexOf('chk_finv_')==0){\n";
			echo "farmacos_inv=farmacos_inv + ele.name.substring(9) + 'x' ;\n";
			echo "}\n";
			echo "if (ele.name.indexOf('chk_fami_')==0){\n";
			echo "farmacos_fam=farmacos_fam + ele.name.substring(9) + 'x' ;\n";
			echo "}\n";
		
		echo "}\n";
	echo "}\n";

echo "}\n";
echo "if (farmacos_fda==''){\n";
echo "farmacos_fda=0;\n";
echo "}\n";
echo "if (farmacos_inv==''){\n";
echo "farmacos_inv=0;\n";
echo "}\n";
echo "if (farmacos_fam==''){\n";
echo "farmacos_fam=0;\n";
echo "}\n";
echo "var pmt=\"lista1=\" + farmacos_inv + \"&lista2=\" + farmacos_fda + \"&lista3=\" + farmacos_fam ; \n";
echo "compara_farmacos_pathway(pmt); \n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>
