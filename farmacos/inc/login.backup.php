<?php 
if (!isset($_SERVER['PHP_AUTH_USER'])) {
header('WWW-Authenticate: Basic realm="Giman"');
header('HTTP/1.0 401 Unauthorized');
exit;
} else if (isset($_SERVER['PHP_AUTH_USER'])) {
mysql_connect("localhost","farmacos","alcachofas14109") 


or die ("Imposible conectar con la base de datos.");
mysql_select_db("farmacos") 
or die ("Imposible seleccionar la base de datos.");
$sql = "SELECT * FROM user_farmacos WHERE Login_Usuario='".$_SERVER['PHP_AUTH_USER']."' and Password_Usuario=password('".$_SERVER['PHP_AUTH_PW']."')";
$result = mysql_query($sql);
$num = mysql_numrows($result);
//$num = 1;

if ($num != "0") {
$IdUsuario=mysql_result($result,0,0);
} else {	
header('WWW-Authenticate: Basic realm="Giman"');
header('HTTP/1.0 401 Unauthorized');
echo 'Acceso Denegado.';
exit;
}
} 
?>
