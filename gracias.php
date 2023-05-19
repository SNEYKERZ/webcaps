<?php
session_start();
require 'funcionesCarrito.php';
include 'templates/cabecera.php'
?>
    <div class="container" id="main">
        <div class="row">
            <div class="jumbotron">
                <p>Gracias por su compra</p>
                <p>
                <a href="index.php">Regresar</a>
                </p>
            </div>
        </div>
    </div> <!-- /container -->
<?php
    include 'templates/footer.php'
?>