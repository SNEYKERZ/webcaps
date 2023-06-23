<?php

use FontLib\Table\Type\head;

require '../vendor/autoload.php';

$producto = new capsweb\Productos;
$categoria = new capsweb\Categorias;
$noticia = new capsweb\noticias;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($_POST['accion'] === 'Registrar') {

    if (empty($_POST['referencia']))
      exit('Completar referencia');

    if (empty($_POST['precio']))
      exit('Completar precio');

    if (empty($_POST['categoria_id']))
      exit('Seleccionar una Categoria');

    if (empty($_POST['tallas']))
      exit('Seleccionar una talla al menos');
    else {
      $tallasSeleccionadas = implode(',', $_POST['tallas']);
    }

    if (empty($_POST['stock']))
      exit('digita una cantidad en stock válida');

    $_params = array(
      'referencia' => $_POST['referencia'],
      'categoria_id' => $_POST['categoria_id'],
      'foto' => subirFoto(),
      'precio' => $_POST['precio'],
      'tallas' => $tallasSeleccionadas,
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

    if (empty($_POST['precio']))
      exit('Completar precio');

    if (empty($_POST['stock']))
      exit('digita una Cantidad válida');

    /**if (empty($_POST['tallasNuevas']))
      exit('Seleccionar una talla al menos');
    else {
      $tallasNuevas = implode(',', $_POST['tallasNuevas']);
    }**/
    $_params = array(
      'id' => $_POST['id'],
      'referencia' => $_POST['referencia'],
      'categoria_id' => $_POST['categoria_id'],
      'precio' => $_POST['precio'],
      'stock' => $_POST['stock'],
      'tallas' => isset($_POST['tallasNuevas']) ? implode(',', explode(',', $_POST['tallasNuevas'])) : '',
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

//REGISTRAR / AÑADIR UNA CATEGORIA
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($_POST['accion'] === 'Añadir') {

    if (empty($_POST['categoria']))
      exit('Completar categoria');

    $_params = array(
      'categoria' => $_POST['categoria']
    );

    $rpt = $categoria->registrar($_params);

    if ($rpt)
      header('Location: productos/index.php');
    else
      print 'Error al añadir la categoria';
  }
}

// CAMBIAR LAS NOTICIAS
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if ($_POST['accion'] === 'Cambiar') {

    if (empty($_POST['campos_adicionales']))
      exit('Completar la noticia');

    $_params = array(
      'campos_adicionales' => $_POST['campos_adicionales']
    );

    $rpt = $noticia->actualizarNoticias($_params);

    if ($rpt)
      header('Location: productos/index.php');
    else
      print 'Error al cambiar la noticia';
  }
}

// //SUBIR UNA FOTO
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
