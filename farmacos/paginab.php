<?php
include ("inc/login.php"); 
include ("inc/config.php");
include ("inc/headerB.php");

echo "<div class=\"span-24 last\">\n";
    echo "<div id=\"tabBody\" class=\"clearfix\">\n";
        echo "<form  name=\"form_farmacos\">\n";
            echo "<div class=\"span-23 last\">\n";
                echo "<div id=\"cabecera-menubh\">\n";
                echo "</div>\n";
                echo "<div id=\"cuadro-menuh\">\n";
                    echo "<div class=\"span-7\">\n";
                        echo "<p id=\"botonB11\">\n";
                            echo "<a href=\"mutaciones.php\"></a>\n";
                        echo "</p>\n";
                    echo "</div>\n";
                    echo "<div class=\"span-7\">\n";
                        echo "<p id=\"botonB12\">\n";
                            echo "<a href=\"pathways.php\"></a>\n";
                        echo "</p>\n";
                    echo "</div>\n";
                    echo "<div class=\"span-7\">\n";
                        echo "<p id=\"botonB13\">\n";
                            echo "<a href=\"custom_pathways.php\"></a>\n";
                        echo "</p>\n";
                    echo "</div>\n";
                echo "</div>\n";
            echo "</div>\n";
        echo "</form>\n";
    echo "</div>\n";
echo "</div>\n";
include ("inc/footer_horizontal.php");
?>