<?php
include ("inc/login.php"); 
include ("inc/config.php");
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies_SEL");
include ("inc/headerA1.php");

echo "<div class=\"span-24 last\">\n";
   echo "<div id=\"tabBody\" class=\"clearfix\">\n";
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
		echo "<div class=\"span-11 append-6 prepend-6\">\n";
			echo "<div class=\"recuadroizq conborde\">\n";
				echo "<div class=\"cabecerarecuadro clearfix\">\n";
					echo "<div class=\"titulorecuadro\">Option in Development</div>\n";
				echo "</div>\n";
				echo "<div class=\"cuerporecuadro clearfix\">\n";	
					echo "<div class=\"izq\">\n";
						echo "<p class=\"leyenda\">\n";
						echo "<br />";
						echo "<br />";
						echo "<br />";
						echo "</p>\n";
						echo "<p class=\"leyenda\">\n";
							echo "These options are in development.Not included in this version";
						echo "</p>\n";
						echo "<p class=\"leyenda\">\n";
						echo "<br />";
						echo "<br />";
						echo "<br />";
						echo "</p>\n";
						echo "</p>\n";
						
					echo "</div>\n";		
				echo "</div>\n";
			echo "</div>\n";
		echo "</div>\n";
	
	echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
?>
