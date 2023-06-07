<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
require '../vendor/phpmailer/';



    $conexion = mysqli_connect('localhost', 'root', '', 'webcaps');
    $phpmailer = new PHPMailer();
    $phpmailer->isSMTP();
    $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 25;
    $phpmailer->Username = 'c8ac62b8ac8793';
    $phpmailer->Password = '********4497';
    $phpmailer->setFrom('alejoarenasdev@gmail.com', 'AlejandroArenas');
    $phpmailer->addAddress('sneykerz22@gmail.com', 'Alejoarenas');
    $phpmailer->Subject = 'Productos con stock menor o igual a cinco';
    $phpmailer->Body = "hola";
    $phpmailer->isHTML(true);
    if($phpmailer->send() == false){
        echo "No se envio  ";
        echo $phpmailer->ErrorInfo;
    }else {echo "se envio";};

