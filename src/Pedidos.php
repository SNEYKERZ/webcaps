<?php

namespace capsweb;

use PHPMailer\PHPMailer\PHPMailer;

use PDO;

class pedidos
{
    private $config;
    private $cn = null;

    public function __construct()
    {
        $this->config = parse_ini_file(__DIR__ . '/../config/config.ini');

        $this->cn = new PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }

    public function registrar($_params)
    {
        $sql = "INSERT INTO `pedidos`(`cliente_id`, `total`, `fecha`) 
        VALUES (:cliente_id,:total,:fecha)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":cliente_id" => $_params['cliente_id'],
            ":total" => $_params['total'],
            ":fecha" => $_params['fecha'],
        );

        if ($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }

    //esta funcion muestra los datos del cliente y el producto
    public function mostrar()
    {
        $sql = "SELECT p.id, nombre, apellidos, email, total, fecha FROM pedidos p 
        INNER JOIN clientes c ON p.cliente_id = c.id ORDER BY p.id DESC";

        $resultado = $this->cn->prepare($sql);

        if ($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }

    //esta funcion muestra los ultimos pedidos realizados con un limite de 10
    public function mostrarUltimos()
    {
        $sql = "SELECT p.id, nombre, apellidos, email, total, fecha FROM pedidos p 
        INNER JOIN clientes c ON p.cliente_id = c.id ORDER BY p.id DESC LIMIT 20";

        $resultado = $this->cn->prepare($sql);

        if ($resultado->execute())
            return  $resultado->fetchAll();

        return false;
    }

    //muestra los datos del pedido y del respectivo cliente segun el id del pedido
    public function mostrarPorId($id)
    {
        $sql = "SELECT p.id, nombre, apellidos, email, total, fecha, direccion FROM pedidos p 
        INNER JOIN clientes c ON p.cliente_id = c.id WHERE p.id = :id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ':id' => $id
        );

        if ($resultado->execute($_array))
            return  $resultado->fetch();

        return false;
    }

    public function mostrarDetallePorIdPedido($id)
    {
        $sql = "SELECT 
                dp.id,
                pe.referencia,
                dp.precio,
                dp.cantidad,
                pe.foto,
                dp.talla               
                FROM detalle_pedidos dp
                INNER JOIN productos pe ON pe.id= dp.producto_id
                WHERE dp.pedido_id = :id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ':id' => $id
        );

        if ($resultado->execute($_array))
            return  $resultado->fetchAll();

        return false;
    }

    //aqui se enviara a la base de datos todos los detalles del pedidio hecho por un cliente
    public function registrarDetalle($_params)
    {
        $sql = "INSERT INTO `detalle_pedidos`(`pedido_id`, `producto_id`, `precio`, `cantidad`, `talla`) 
            VALUES (:pedido_id, :producto_id, :precio, :cantidad, :talla)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":pedido_id" => $_params['pedido_id'],
            ":producto_id" => $_params['producto_id'],
            ":precio" => $_params['precio'],
            ":cantidad" => $_params['cantidad'],
            ":talla" => isset($_params['talla']) ? $_params['talla'] : null,
        );

        if ($resultado->execute($_array)) {
            $id = $_params['pedido_id'];
            return true;
        }
        return false;
    }
}
