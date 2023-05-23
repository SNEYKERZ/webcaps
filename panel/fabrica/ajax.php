<?php

/**if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados por AJAX
    $rollos = $_POST['rollo'];
    $cantidades = $_POST['cantidad'];

    // Construir los datos de la tabla
    $tableData = array();
    for ($i = 0; $i < count($rollos); $i++) {
        $rollo = $rollos[$i];
        $cantidad = $cantidades[$i];
        $camisetas = $cantidad * 20;
        $precioCamisas = $camisetas * 35000;
        $precioRollos = $cantidad * 50000;

        $tableData[] = array(
            'rollo' => $rollo,
            'cantidad' => $cantidad,
            'camisetas' => $camisetas,
            'precioCamisas' => $precioCamisas,
            'precioRollos' => $precioRollos
        );
    }

    // Enviar los datos de la tabla como respuesta
    echo json_encode($tableData);
}
?>