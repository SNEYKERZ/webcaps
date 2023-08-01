<?php session_start();
if (!isset($_GET['id']) or !is_numeric($_GET['id']))
    header('Location: index.php');

$id = $_GET['id'];

if (isset($_SESSION['carrito'])) {
    unset($_SESSION['carrito'][$id]);
    header('Location: index.php');
} else {
    header('Location: ../index.php');
}

//Esto elminara todos los productos al destruir la seccion del carrito creada con el id de un producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['accion'] === 'eliminartodo') {
     
        // Verificar si el usuario ha iniciado sesión
        if (isset($_SESSION['carrito'])) {
            // Eliminar todas las variables de sesión
            session_unset();
            // Destruir la sesión
            session_destroy();
        }
        header('location: index.php');
    }
}
