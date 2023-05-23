<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
?>

<head>
    <script>
        $(document).ready(function() {
            var rowIndex = 0; // contador para el índice de fila

            // Agregar una nueva fila a la tabla
            $('#add-row').click(function() {
                rowIndex++;
                var newRow = '<tr id="row' + rowIndex + '">' +
                    '<td><input type="text" name="rollo[]" class="rollo"></td>' +
                    '<td><input type="number" name="cantidad[]" class="cantidad"></td>' +
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
    <h2>Calculadora de fabrica</h2>

    <table class="table table-striped-columns table-bordered table-hover" id="data-table">
        <thead>
            <tr>
                <th>Rollo</th>
                <th>Cantidad</th>
                <th>Camisetas</th>
                <th>Precio de camisas</th>
                <th>Precio de rollos</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <!-- Filas agregadas dinámicamente se mostrarán aquí -->
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1"></td>
                <td>Total Camisetas:</td>
                <td id="total-camisetas"></td>
                <td></td>
            </tr>

            <tr>
                <td colspan="2"></td>
                <td>Total Precio Camisas:</td>
                <td id="total-precio-camisas"></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>Total Precio rollos:</td>
                <td id="total-precio-rollos"></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <button type="button" class="btn btn-primary" id="add-row">Agregar </button>
    <br> <br>
    <div class="btn">
        <a href="javascript:;" id="btnImprimir" class="btn btn-danger hidden-print">Imprimir</a>
    </div>
    </main>
    <script>//imprimir
        $('#btnImprimir').on('click', function() {

            window.print();

            return false;

        })
    </script>

</body>
