<?php
//include ("inc/login.php"); 
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",1);
echo $cabecera->get_php_code();
 
include ("inc/config.php");
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies_SEL");
include ("inc/headerA1.php");

echo "<div class=\"span-24 last\">\n";
    echo "<div id=\"tabBody\" class=\"clearfix\">\n";
        echo "<form  name=\"form_farmacos\">\n";
         	echo "<div class=\"span-23 last\">\n";
				echo "<div class=\"span-6\">\n";
				echo "<p id=\"botonA21\">\n";
        			echo "<a href=\"farmacos.php\"></a>\n";
        		echo "</p>\n";
		 		echo "</div>\n";
				if( $GLOBALS['cabecera']->admin_lvl <= $_SESSION['UNIVEL'])
				{
					echo "<div class=\"span-6\">\n";
					echo "<p id=\"botonA22\">\n";
						echo "<a href=\"farmacos_all.php\"></a>\n";
					echo "</p>\n";
					echo "</div>\n";
					echo "<div class=\"span-6\">\n";
					echo "<p id=\"botonA23\">\n";
						echo "<a href=\"farmacos_optimal.php\"></a>\n";
					echo "</p>\n";
					echo "</div>\n";
					echo "<div class=\"span-5 last\">\n";
					echo "<p id=\"botonA24\">\n";
						echo "<a href=\"custom_comparer.php\"></a>\n";
					echo "</p>\n";
					echo "</div>\n";
				}
			echo "</div>\n";
		echo "</form>\n";
    echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
?>
