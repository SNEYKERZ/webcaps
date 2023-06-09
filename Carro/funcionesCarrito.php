<?php
//AGREGA UN PRODUCTO AL CARRITO DE COMPRAS
function agregarProducto($resultado, $id, $cantidad = 1)
{ 
        $_SESSION['carrito'][$id] = array(
        'id' => $resultado['id'],
        'referencia' => $resultado['referencia'],
        'categoria_id' => $resultado['categoria_id'],
        'categoria' => $resultado['categoria'],
        'foto' => $resultado['foto'],
        'precio' => $resultado['precio'],
        /* 'talla_id' => $resultado['talla_id'],*/
        'cantidad' => $cantidad
    );
}

//RECALCULA LA CANTIDAD Y SU VALOR
function actualizarProducto($id, $cantidad = false)
{
    if ($cantidad >= 1 ){
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;}
    elseif($_SESSION['carrito'][$id]['cantidad'] != 1) {
        $_SESSION['carrito'][$id]['cantidad'] += 1;}
}

//HARA EL CALCULO DEL TOTAL DE LOS PRODUCTOS EN EL CARRO
function calcularTotal()
{

    $total = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $indice => $value) {
            $total += $value['precio'] * $value['cantidad'];
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