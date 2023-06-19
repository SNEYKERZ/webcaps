<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require 'src/enviar_correo.php';
    require 'carro/funcionesCarrito.php';
    require 'vendor/autoload.php';

    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $cliente = new capsweb\clientes;

        $_params = array(
            'nombre' => $_POST['nombre'],
            'apellidos' => $_POST['apellidos'],
            'email' => $_POST['email'],
            'telefono' => $_POST['telefono'],
            'direccion' => $_POST['direccion']
        );

        $cliente_id = $cliente->registrar($_params);
        $pedido = new capsweb\pedidos;

        $_params = array(
            'cliente_id' => $cliente_id,
            'total' => calcularTotal(),
            'fecha' => date('Y-m-d')
        );

        $pedido_id =  $pedido->registrar($_params);

        foreach ($_SESSION['carrito'] as $value) {
            $_params = array(
                "pedido_id" => $pedido_id,
                "producto_id" => $value['id'],
                "precio" => $value['precio'],
                "cantidad" => $value['cantidad'],
                "talla" => $value['talla'],

            );
            $pedido->registrarDetalle($_params);
            sendEmailPedido($pedido_id);
        }
        $_SESSION['carrito'] = array();
        header('Location: index.php');
    }
}
