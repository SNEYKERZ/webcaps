<?php
session_start();
require 'funcionesCarrito.php';
include 'templates/cabecera.php'
?>

<style>
    .container {
        background-color: black;
        width: 100%;
        height: 100%;
    }
</style>

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