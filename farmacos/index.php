<?php
include_once('classes/class.cabecera.php');
$cabecera = new cabecera("blobs.css",10);
echo($cabecera->get_php_code()); 

include ('inc/login.php');
?>


<body>
<div style="float: right;width 100%;">
<?php 
//print_r($_SESSION);
if (isset($_SESSION['USER'])) echo "Wellcome ".$_SESSION['USER'].": <a href='login.php?logout=1'>Logout</a>";

?>
</div>


<ul id="blobs">
<li id="blob1"><a href="paginaa.php"></a></li>
<li id="blob2"><a href="listar_farmacos.php"></a></li>
<li id="blob3"><a href="farmacos_nuevos.php"></a></li>
<li id="blob4"><a href="farmacos.php"></a></li>
<li id="blob5"><a href="paginab.php"></a></li>
<li id="blob6"><a href="mutaciones.php"></a></li>
<li id="blob7"><a href="pathways.php"></a></li>
<li id="blob8"><a href="custom_pathways.php"></a></li>
<li id="blob9"><a href="tumors.php"></a></li>
<li id="blob10"><a href="tumors.php"></a></li>
<li id="blob11"><a href="javascript:abrir_ventana('aophelp.php')"></a></li>
</ul>

</body>
</html>
<?php
echo "<script type=\"text/javascript\">\n";
echo "<!--\n";
echo "function abrir_ventana(a){\n";
echo "window.open (a,\"links1\",\"left=100,top=100,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=900,height=600\");\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";  
?>