<?php

use PHPMailer\PHPMailer\PHPMailer;


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
        $phpmailer->Body = "El/los producto/s con referencia --" . $_REQUEST['referencia'] . "," . ", -- tienen casi agotado su stock, menor o igual a 5 se suguiere aumentar el stock, ya que no seran mostrados en la pagina para su compra ";
        $phpmailer->isHTML(true);

        if ($phpmailer->send() == false) {
            echo "No se envio  ";
            echo $phpmailer->ErrorInfo;
        } else {
            echo "se envio";
        };
    }
}


function sendEmailPedido($id)
{
    $pedido = new capsweb\pedidos;
    $info_pedido = $pedido->mostrarPorId($id);
    $info_detalle_pedido = $pedido->mostrarDetallePorIdPedido($id);

    $count = count($info_detalle_pedido);

    if ($count > 0) {
        $c = 0;
        for ($x = 0; $x < $count; $x++) {
            $c++;
            $item = $info_detalle_pedido[$x];
            $total = $item['precio'] * $item['cantidad'];

            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = 'c8ac62b8ac8793';
            $phpmailer->Password = '23d626ce504497';
            $phpmailer->setFrom('alejoarenasdev@gmail.com', 'Alejandro Arenas');
            $phpmailer->addAddress('sneykerz22@gmail.com', 'Alejo arenas');
            $phpmailer->Subject = 'NUEVO PEDIDO/COMPRA!';
            $phpmailer->isHTML(true);
            $phpmailer->Body =  "Informacion de la Compra \n ". $info_pedido['id'] ."\n"."El cliente ".
                "Nombre: " . $info_pedido['nombre'] . " " . $info_pedido['apellidos'] ."\n". "con correo".
                "Correo: " . $info_pedido['email'] . "\n" ."realizo un nuevo pedido en la ".
                "Fecha: " . $info_pedido['fecha'] . "\n" ;
                
            if ($phpmailer->send() == false) {
                echo "No se envio  ";
                echo $phpmailer->ErrorInfo;
            } else {
                echo "se envio";
            };
        }
    }
}
