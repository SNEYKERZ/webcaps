<?php

include('templates/cabecera.php');
require 'vendor/autoload.php';
?>

<form class="login-form" method="post" action="panel/acciones.php">
    <div class="form-group mb-2">
        <input type="text" aria-describedby="emailHelp" placeholder="Nombre de usuario" name="usuario">
    </div>
    <div class="form-group mb-2">
        <input type="password" placeholder="Contraseña" name="contraseña">
    </div>
    <input type="submit" name="accion" value="INICIAR">


</form>
<?php
include('templates/footer.php');
?>