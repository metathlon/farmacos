<?php
include_once("classes/class.cabecera.php");
$cabecera = new cabecera("blobs.css",0);
echo $cabecera->get_php_code(); 

?>
<body>
<?php 
//$cabecera->bd->crea_user(vero, hola);
if ($_GET['error']=='1') echo "<br><h2> USUARIO O CLAVE INCORRECTA </h2><br>"
?>
  <div id="login_form">
            <form name="f1" method="post" action="inc/check_login.php" id="f1">
                <table>
                    <tr>
                        <td class="f1_label">Usuario :</td><td><input type="text" name="user" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td class="f1_label">Password  :</td><td><input type="password" name="pass" value=""  />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input type="submit" name="login" value="Identificarse" style="font-size:18px; " />
                        </td>
                    </tr>
                </table>
            </form> 
   </div>
  </body>