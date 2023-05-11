<?php
function agregarProducto($resultado, $id, $cantidad = 1)
{
    $_SESSION['carrito'][$id] = array(
        'id' => $resultado['id'],
        'referencia' => $resultado['referencia'],
        'foto' => $resultado['foto'],
        'precio' => $resultado['precio'],
       /* 'talla_id' => $resultado['talla_id'],*/
        'cantidad' => $cantidad
    );
}

function actualizarProducto($id, $cantidad = FALSE)
{
    if ($cantidad)
        $_SESSION['carrito'][$id]['cantidad'] = $cantidad;
    else
        $_SESSION['carrito'][$id]['cantidad'] += 1;
}


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
