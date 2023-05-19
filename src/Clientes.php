<?php

namespace capsweb;
use PDO;
class clientes
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
        $sql = "INSERT INTO `clientes`(`nombre`, `apellidos`, `email`, `telefono`, `direccion`) 
        VALUES (:nombre,:apellidos,:email,:telefono,:direccion)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" => $_params['nombre'],
            ":apellidos" => $_params['apellidos'],
            ":email" => $_params['email'],
            ":telefono" => $_params['telefono'],
            ":direccion" => $_params['direccion']
        );

        if ($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }
}
