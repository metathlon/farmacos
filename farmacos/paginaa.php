<?php
//include ("inc/login.php"); 
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",10);
echo $cabecera->get_php_code();



include ("inc/config.php");
$array_menu_superior=array("listar_farmacos.php"=>"FDA Approved Drugs","farmacos_nuevos.php"=>"Investigational Drugs","paginaa1.php"=>"Combinational Studies");
include ("inc/headerA.php");

echo "<div class=\"span-24 last\">\n";
	echo "<div id=\"tabBody\" class=\"clearfix\">\n";
        echo "<form  name=\"form_farmacos\">\n";
            echo "<div class=\"span-23 last\">\n";
                echo "<div id=\"cabecera-menuah\">\n";
                echo "</div>\n";
                echo "<div id=\"cuadro-menuh\">\n";
                    echo "<div class=\"span-7\">\n";
                        echo "<p id=\"botonA11\">\n";
                            echo "<a href=\"listar_farmacos.php\"></a>\n";
                        echo "</p>\n";
                    echo "</div>\n";
                    echo "<div class=\"span-7\">\n";
                        echo "<p id=\"botonA12\">\n";
                            echo "<a href=\"farmacos_nuevos.php\"></a>\n";
                        echo "</p>\n";
                    echo "</div>\n";
                    echo "<div class=\"span-7\">\n";
                        echo "<p id=\"botonA13\">\n";
                            echo "<a href=\"farmacos.php\"></a>\n";
                        echo "</p>\n";
                    echo "</div>\n";
                echo "</div>\n";
            echo "</div>\n";
        echo "</form>\n";
    echo "</div>\n";

echo "</div>\n";
include ("inc/footer_horizontal.php");
?>
