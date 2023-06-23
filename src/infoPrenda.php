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
        $sql = "SELECT `id`, `ruta` FROM `fotos` WHERE id = :id";
        $resultado = $this->cn->prepare($sql);
        $resultado->bindParam(":id", $id, PDO::PARAM_INT);

        if ($resultado->execute()) {
            return $resultado->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public function mostrarFotos()
    {
        $sql = "SELECT ruta FROM fotos";
        $stmt = $this->cn->prepare($sql);
        $stmt->execute();

        $fotos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $fotos;
    }
}
