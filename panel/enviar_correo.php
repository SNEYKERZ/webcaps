<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

function post_gmail()
{
    $conexion = mysqli_connect('localhost', 'root','', 'webcaps');
    // O utiliza PDO para la conexión, si lo prefieres
    
    // Paso 3: Consulta a la base de datos
    $query = "SELECT * FROM `productos` WHERE `stock` <= '5' ";
    $resultado = mysqli_query($conexion, $query);
    // O utiliza PDO para la consulta, si lo prefieres
    
    // Paso 4: Configuración de phpMailer
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'servidor_smtp';
    $mail->SMTPAuth = true;
    $mail->Username = 'alejovpn0gmail.com';
    $mail->Password = 'Parlante22';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('alejovpn0gmail.com', 'AlejandroArenas');
    $mail->addAddress('sneykerz22@gmail.com', 'Alejoarenas');
    $mail->Subject = 'Productos con stock menor o igual a cinco';
    
    // Paso 5: Envío de correos
    while ($producto = mysqli_fetch_assoc($resultado)) {
        // Configura los detalles del producto en el cuerpo del mensaje
        $mensaje = 'Nombre del producto: ' . $producto['referencia'] . '<br>';
        $mensaje .= 'Stock: ' . $producto['stock'] . '<br>';
       
        $mail->Body = $mensaje;
        $mail->isHTML(true); 
    }
}
?>