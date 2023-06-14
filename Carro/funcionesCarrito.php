<?php
require '../vendor/autoload.php';
//AGREGA UN PRODUCTO AL CARRITO DE COMPRAS
function agregarProducto($resultado, $id, $cantidad = 1)
{
    $_SESSION['carrito'][$id] = array(
        'id' => $resultado['id'],
        'foto' => $resultado['foto'],
        'referencia' => $resultado['referencia'],
        'categoria_id' => $resultado['categoria_id'],
        'categoria' => $resultado['categoria'],
        'precio' => $resultado['precio'],
        'cantidad' => $cantidad,
        'tallas' =>  $resultado['tallas']

    );
}

//RECALCULA LA CANTIDAD Y SU VALOR
function actualizarProducto($id, $cantidad = false)
{
    if ($cantidad >= 1) {
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    } elseif ($_SESSION['carrito'][$id]['cantidad'] != 1) {
        $_SESSION['carrito'][$id]['cantidad'] += 1;
    } elseif ($_SESSION['carrito'][$id]['cantidad'] <= 0) {
        $_SESSION['carrito'][$id]['cantidad'] = 1;
    }
}
//HARA EL CALCULO DEL PRECIO TOTAL DE LOS PRODUCTOS EN EL CARRO
function calcularTotal()
{
    $total = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $indice => $value) {

            if ($value['cantidad'] == 5 && $value['categoria']== 'CAMISETA') {
                $total += $value['precio'] = 22000 * $value['cantidad'];
            }elseif ($value['cantidad'] == 4 && $value['categoria']== 'CAMISETA') {
                $total += $value['precio'] = 23750 * $value['cantidad'];
            }else if ($value['cantidad'] == 3 && $value['categoria']== 'CAMISETA') {
                $total += $value['precio'] = 25000 * $value['cantidad'];
            } elseif ($value['cantidad'] == 2 && $value['categoria']== 'CAMISETA') {
                $total += $value['precio'] = 27500 * $value['cantidad'];
            } elseif($value['cantidad'] >= 5 || $value['cantidad'] <= 1 ) {
                $total += $value['precio'] * $value['cantidad'];
            }
            else{ $total +=  $value['precio'] * $value['cantidad'];}
        }
    }
    return $total;
}

//DEVUELVE LA CANTIDAD DE PRODUCTOS
function cantidadProductos()
{
    $cantidad = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $indice => $value) {
            $cantidad +=  $value['cantidad'];
        }
    }
    return $cantidad;
}
