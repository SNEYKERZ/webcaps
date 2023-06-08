<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../src/productos.php';
require '../src/pedidos.php';

function sendEmailStock()
{

    $conexion = mysqli_connect('localhost', 'root', '', 'webcaps');

    $sql = $conexion->query("SELECT `referencia`,`stock` FROM `productos` 
    WHERE productos.stock <= '5'  ");

    $_REQUEST['correo'] = true;
    if ($datos = $sql->fetch_object()) {
        $_REQUEST["referencia"] = $datos->referencia;
        $_REQUEST["stock"] = $datos->stock;

        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'c8ac62b8ac8793';
        $phpmailer->Password = '23d626ce504497';
        $phpmailer->setFrom('alejoarenasdev@gmail.com', 'Alejandro Arenas');
        $phpmailer->addAddress('sneykerz22@gmail.com', 'Alejo arenas');
        $phpmailer->Subject = 'Productos con stock menor o igual a cinco';
        $phpmailer->Body = "El/los producto/s con referencia --".$_REQUEST['referencia'].",".", -- tienen casi agotado su stock, menor o igual a 5 se suguiere aumentar el stock, ya que no seran mostrados en la pagina para su compra ";
        $phpmailer->isHTML(true);

        if ($phpmailer->send() == false) {
            echo "No se envio  ";
            echo $phpmailer->ErrorInfo;
        } else {
            echo "se envio";
        };
    }
}

sendEmailStock();
