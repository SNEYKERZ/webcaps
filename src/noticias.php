<?php

namespace capsweb;

use PDO;

class noticias
{
    private $config;
    private $cn = null;
    public function __construct()
    {

        $this->config = parse_ini_file(__DIR__ . '/../config/config.ini');

        $this->cn = new \PDO($this->config['dns'], $this->config['usuario'], $this->config['clave'], array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
    }
    // Función para actualizar las noticias
    public function actualizarNoticias($_params)
    {
        $sql = "UPDATE `noticias` SET `campos_adicionales` = :campos_adicionales WHERE `id` = 1;";
        $resultado = $this->cn->prepare($sql);
        $_array = array(
            ":campos_adicionales" => $_params['campos_adicionales']
        );
        if ($resultado->execute($_array))
            return true;

        return false;
    }

    public function mostrar()
    {
        $sql = "SELECT `id`, `campos_adicionales` FROM `noticias`";
        $resultado = $this->cn->prepare($sql);

        if ($resultado->execute())
            return $resultado->fetchAll(PDO::FETCH_ASSOC);

        return false;
    }
}
