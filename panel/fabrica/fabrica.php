<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
?>

<head>
    <link rel="stylesheet" href="../../assets/css/fabrica.css">

    <script>
        $(document).ready(function() {
            var rowIndex = 0; // contador para el índice de fila

            // Agregar una nueva fila a la tabla
            $('#add-row').click(function() {
                rowIndex++;
                var newRow = '<tr id="row' + rowIndex + '">' +
                    '<td><input type="text" name="rollo[]" class="rollo" placeholder="Nombre/Color del rollo"></td>' +
                    '<td><input type="number" name="cantidad[]" class="cantidad" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Cantidad de rollos"></td>' +
                    '<td><span class="camisetas"></span></td>' +
                    '<td><span class="precio-camisas"></span></td>' +
                    '<td><span class="precio-rollos"></span></td>' +
                    '<td><button class="delete-row" data-row="' + rowIndex + '">Eliminar</button></td>' +
                    '</tr>';
                $('#data-table tbody').append(newRow);
            });

            // Eliminar una fila de la tabla
            $(document).on('click', '.delete-row', function() {
                var rowToRemove = $(this).data('row');
                $('#row' + rowToRemove).remove();
            });

            // Calcular los valores y actualizar la tabla cuando cambie la cantidad
            $(document).on('change', '.cantidad', function() {
                var row = $(this).closest('tr');
                var cantidad = $(this).val();
                var camisetas = cantidad * 20;
                var precioCamisas = camisetas * 35000;
                var precioRollos = cantidad * 50000;

                row.find('.camisetas').text(camisetas);
                row.find('.precio-camisas').text(precioCamisas);
                row.find('.precio-rollos').text(precioRollos);

                calcularTotal();
            });

            // Calcular el valor total de ciertas columnas
            function calcularTotal() {
                var totalCamisetas = 0;
                var totalPrecioCamisas = 0;
                var totalPrecioRollos = 0;

                $('.camisetas').each(function() {
                    totalCamisetas += parseInt($(this).text());
                });

                $('.precio-camisas').each(function() {
                    totalPrecioCamisas += parseInt($(this).text());
                });

                $('.precio-rollos').each(function() {
                    totalPrecioRollos += parseInt($(this).text());
                });

                $('#total-camisetas').text(totalCamisetas);
                $('#total-precio-camisas').text(totalPrecioCamisas);
                $('#total-precio-rollos').text(totalPrecioRollos);
            }
        });
    </script>
</head>

<body>
    <h2 class="text-center pb-5 text-uppercase">Calculadora de fabrica</h2>
    
    <div class="container-table">
        <table class="table table-striped table-bordered table-hover" id="data-table">
            <thead>
                <tr>
                    <th>Rollo</th>
                    <th>Cantidad</th>
                    <th>Camisetas resultantes</th>
                    <th>Precio de camisas</th>
                    <th>Precio de rollos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Filas agregadas dinámicamente se mostrarán aquí -->
            </tbody>
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td colspan="1"></td>
                    <td id="total-camisetas"></td>
                    <td id="total-precio-camisas"></td>
                    <td id="total-precio-rollos"></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="buttons d-flex justify-content-center align-items-center">
        <button type="button" class="btn btn-success" id="add-row">Agregar </button>
        <div class="btn">
            <a href="javascript:;" id="btnImprimir" class="btn btn-danger hidden-print">Imprimir</a>
        </div>
    </div>
    </main>
    <script>
        //imprimir
        $('#btnImprimir').on('click', function() {
            window.print();
            return false;
        })
    </script>
</body>