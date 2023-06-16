<?php

namespace capsweb;

use PDO;

class InfoPrenda
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

    function subirFoto()
    {
        $carpeta = __DIR__ . '/../assets/images/productos/Imagenes de productos/';
        $archivo = $carpeta . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);
        return $_FILES['foto']['name'];
    }

    public function mostrarPorId($id)
    {
        $sql = " SELECT `id`, `ruta` FROM `fotos` 
        INNER JOIN `fotos`
        ON productos.id = foto.id WHERE foto.id =:id ";

        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":id" =>  $id
        );

        if ($resultado->execute($_array)) {
            return $resultado->fetch();
        }
        return false;
    }

    public function mostrarFotos()
    {
        $sql = "SELECT ruta FROM fotos";
        $resultado = $this->cn->prepare($sql);

        if ($resultado->execute()) {
            return $resultado->fetchAll(PDO::FETCH_COLUMN);
        }

        return array();
    }
}
