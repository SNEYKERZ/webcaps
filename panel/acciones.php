<?php
require '../vendor/autoload.php';

$producto = new capsweb\Productos;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['accion'] === 'Registrar') {

        if (empty($_POST['referencia']))
            exit('Completar referencia');

        if (empty($_POST['precio']))
            exit('Completar precio');
        
       /** if(empty($_POST['talla_id']))
            exit('Seleccionar una talla'); */

        if (empty($_POST['stock']))
            exit('digita una cantidad en stock válida');

        $_params = array(
            'referencia' => $_POST['referencia'],
            'precio' => $_POST['precio'],
            'foto' => subirFoto(),
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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $id = $_GET['id'];

    $rpt = $producto->eliminar($id);

    if ($rpt)
        header('Location: productos/index.php');
    else
        print 'Error al eliminar el producto';
}


function subirFoto()
{

    $carpeta = __DIR__ . '/../upload/';

    $archivo = $carpeta . $_FILES['foto']['name'];

    move_uploaded_file($_FILES['foto']['tmp_name'], $archivo);

    return $_FILES['foto']['name'];
}
