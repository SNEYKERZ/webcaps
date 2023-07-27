<?php
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
function calcularTotal($contadorCamisetas)
{
    $total = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $indice => $value) {
            // Verificar si el producto actual es una camiseta y la cantidad es mayor o igual a 2
            if ($value['categoria'] == 'CAMISETA' && $value['cantidad'] >= 2) {
                // Aplicar descuento por cantidad al subtotal del producto
                if ($value['cantidad'] == 2) {
                    $subtotalProducto = $value['precio'] - 0; // Descuento de 2500 pesos
                } elseif ($value['cantidad'] == 3) {
                    $subtotalProducto = $value['precio'] - 0; // Descuento de 5000 pesos
                } elseif ($value['cantidad'] == 4) {
                    $subtotalProducto = $value['precio'] - 0; // Descuento de 6250 pesos
                } elseif ($value['cantidad'] == 5) {
                    $subtotalProducto = $value['precio'] - 0; // Descuento de 8000 pesos
                } else {
                    $subtotalProducto = $value['precio']; // No se aplica descuento
                }
            } else {
                $subtotalProducto = $value['precio']; // No se aplica descuento
            }

            // Actualizar el subtotal del producto en el carrito
            $_SESSION['carrito'][$indice]['subtotal'] = $subtotalProducto;

            // Actualizar el total con el subtotal del producto
            $total += $subtotalProducto * $value['cantidad'];
        }
        // Aplicar descuento por cantidad al subtotal total del carrito si hay de 2 a 5 camisetas
        if ($contadorCamisetas >= 2 && $contadorCamisetas <= 5) {
            if ($contadorCamisetas == 2) {
                $total -= 5000; // Descuento de 5000 pesos
            } elseif ($contadorCamisetas == 3) {
                $total -= 15000; // Descuento de 15000 pesos
            } elseif ($contadorCamisetas == 4) {
                $total -= 25000; // Descuento de 25000 pesos
            } elseif ($contadorCamisetas == 5) {
                $total -= 40000; // Descuento de 40000 pesos
            }
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
