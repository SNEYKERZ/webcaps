<?php

use FontLib\Table\Type\head;

require '../vendor/autoload.php';

$producto = new capsweb\Productos;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($_POST['accion'] === 'Registrar') {

    if (empty($_POST['referencia']))
      exit('Completar referencia');

    if (empty($_POST['precio']))
      exit('Completar precio');

    if (empty($_POST['categoria_id']))
      exit('Seleccionar una Categoria');

    /**if (!is_numeric($_POST['categoria_id']))
            exit('Seleccionar una Categoria válida');

        /** if(empty($_POST['talla_id'])) exit('Seleccionar una talla'); */

    if (empty($_POST['stock']))
      exit('digita una cantidad en stock válida');

    $_params = array(
      'referencia' => $_POST['referencia'],
      'categoria_id' => $_POST['categoria_id'],
      'foto' => subirFoto(),
      'precio' => $_POST['precio'],
      /*'talla_id'=>$_POST['talla_id'],*/
      'stock' => $_POST['stock'],
      'fecha' => date('y-m-d')
    );

    $rpt = $producto->registrar($_params);

    if ($rpt)
      header('Location: productos/index.php');
    else
      print 'Error al registrar el producto';
  }

  if ($_POST['accion'] === 'Actualizar') {

    if (empty($_POST['referencia']))
      exit('Completar referencia');

    if (empty($_POST['categoria_id']))
      exit('Seleccionar una Categoria');

    /**if (!is_numeric($_POST['categoria_id']))
            exit('Seleccionar una Categoria válida');*/

    if (empty($_POST['precio']))
      exit('Completar precio');

    if (empty($_POST['stock']))
      exit('digita una Cantidad válida');

    /*if(empty($_POST['talla_id']))
        exit('Seleccionar una talla');

         if(!is_numeric($_POST['talla_id']))
        exit('Seleccionar una talla válida');*/
    $_params = array(
      'id' => $_POST['id'],
      'referencia' => $_POST['referencia'],
      'categoria_id' => $_POST['categoria_id'],
      'precio' => $_POST['precio'],
      /*'talla_id'=>$_POST['talla_id'],*/
      'stock' => $_POST['stock'],
      'fecha' => date('Y-m-d')
    );

    if (!empty($_POST['foto_temp']))
      $_params['foto'] = $_POST['foto_temp'];

    if (!empty($_FILES['foto']['name']))
      $_params['foto'] = subirFoto();

    $rpt = $producto->actualizar($_params);
    if ($rpt)
      header('Location: productos/index.php');
    else
      print 'Error al actualizar el producto';
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'Eliminar') {
  $id = $_GET['id'];
  $rpt = $producto->eliminar($id);
  if ($rpt)
    header('Location: productos/index.php');
  else
    echo 'Error al eliminar el producto';
}


function subirFoto()
{
  $carpeta = __DIR__ . '/../upload/';
  $archivo = $carpeta . $_FILES['foto']['name'];
  move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);
  return $_FILES['foto']['name'];
}

//INICIO DE SECCION
if ($_POST['accion'] === 'Conectar') {
  session_start();

  if (empty($_POST["btn_ingreso"])) {

    $config = parse_ini_file(__DIR__ . '/../config/config.ini');
    $cn = new \PDO($config['dns'], $config['usuario'], $config['clave'], array(
      \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ));
    if (!empty($_POST["usuario"]) && (!empty($_POST["contraseña"]))) {

      $usuario = $_POST["usuario"];
      $contraseña = $_POST["contraseña"];
      $sql = $cn->query("SELECT * from administradores where usuario = '$usuario' and contraseña ='$contraseña' ");

      $_SESSION['logged_in'] = true;

      if ($datos = $sql->fetchObject()) {
        $_SESSION["id"] = $datos->id;
        $_SESSION["nombre"] = $datos->nombre;
        $_SESSION["email"] = $datos->email;
        $_SESSION["numero"] = $datos->numero;

        header("location: productos/index.php");
        # code...
      } else {
        echo  "ACCESO DENEGADO ";
        # code...
      }
    } else {
      echo "campos vacios";
    }
  }
}