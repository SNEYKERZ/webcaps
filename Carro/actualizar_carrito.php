<?php
session_start();
require 'funcionesCarrito.php';
require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $cantidad = $_POST['cantidad'];
    
    
    if (is_numeric($cantidad)) {

        if (array_key_exists($id, $_SESSION['carrito']))
            actualizarProducto($id, $cantidad);
    }

    header('Location: index.php');
}