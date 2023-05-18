<?php
session_start();
if(empty($_SESSION["id"])){
header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
?>
<main>
<h4> Calculadora de fabrica</h4>



</main>
<?php
include('../../templates/footerAdmin.php');
?>