<?php

namespace capsweb;

use PDO;

class Productos
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
    /**añade un producto en la base de datos */
    public function registrar($_params)
    {
        $sql = "INSERT INTO `productos`(`referencia`,`precio`,`foto`,`categoria_id`,`stock`,`fecha`) 
        VALUES (:referencia,:precio,:foto,:categoria_id,:stock,:fecha)";
        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":referencia" => $_params['referencia'],
            ":precio" => $_params['precio'],
            ":categoria_id" => $_params['categoria_id'],
            ":foto" => $_params['foto'],
            /*":talla_id"=> $_params['talla_id'],*/
            ":stock" => $_params['stock'],
            ":fecha" => $_params['fecha']
        );

        if ($resultado->execute($_array))
            return true;
        return false;
    }
    /** Actualiza el producto en la basi de datos */
    public function actualizar($_params)
    {
        $sql = "UPDATE `productos` SET `referencia`=:referencia,`categoria_id` =:categoria_id,`foto`=:foto,`precio`=:precio,`fecha`=:fecha,`stock`=:stock
         WHERE `id`=:id";
        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":id" => $_params['id'],
            ":referencia" => $_params['referencia'],
            ":categoria_id" => $_params['categoria_id'],
            ":foto" => $_params['foto'],
            /*":talla_id"=> $_params['talla_id'],*/
            ":precio" => $_params['precio'],
            ":fecha" => $_params['fecha'],
            ":stock" => $_params['stock']
        );
        if ($resultado->execute($_array))
            return true;

        return false;
    }
    /**elimina el producto de la base de datos mediante su ID */
    public function eliminar($id)
    {
        $sql = " DELETE FROM `productos` WHERE `id`=:id";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":id" => $id
        );

        if ($resultado->execute($_array))
            return true;

        return false;
    }
    /** selecciona y muestra los  items de la tabla productos*/
    public function mostrar()
    {
        $sql = " SELECT productos.id, `referencia`,`foto`,`categoria_id` ,`precio`,`stock` ,`categoria` FROM `productos` 
        INNER JOIN `categorias`
        ON productos.categoria_id = categorias.id ORDER BY productos.id DESC ";

        $resultado = $this->cn->prepare($sql);

        if ($resultado->execute())

            return $resultado->fetchAll();

        return false;
    }

    /** con el ID dado busca en la base de datos la prenda con ese ID */
    public function mostrarPorId($id)
    {

        $sql = "SELECT * FROM `productos` WHERE `id`=:id ";

        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":id" =>  $id
        );

        if ($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }

    /** con el ID dado busca en la base de datos la prenda con ese ID */
    public function mostrarPorIdCategoria($id)
    {
        $sql = "SELECT * FROM `productos` INNER JOIN `categorias` 
        on productos.categoria_id = categorias.id WHERE productos.id =:id ";

        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":id" =>  $id
        );

        if ($resultado->execute($_array))
            return $resultado->fetch();

        return false;
    }
    public function mostrarPrueba()
    { {
            $sql = " SELECT productos.id, `referencia`,`foto`,`categoria_id` ,`precio`,`stock` FROM `productos` 
        WHERE productos.stock >= '5' ";

            $resultado = $this->cn->prepare($sql);

            if ($resultado->execute())

                return $resultado->fetchAll();

            return false;
        }
    }
}
