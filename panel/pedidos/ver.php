<?php
session_start();
if (empty($_SESSION["id"])) {
  header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
?>
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4">
      <fieldset>
        <?php
        require '../../vendor/autoload.php';
        $id = $_GET['id'];
        $pedido = new capsweb\pedidos;
        $info_pedido = $pedido->mostrarPorId($id);
        $info_detalle_pedido = $pedido->mostrarDetallePorIdPedido($id);
        ?>
        <legend>Información de la Compra</legend>
        <div class="form-group">
          <label>Nombre</label>
          <input value="<?php print $info_pedido['nombre'] ?>" type="text" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label>Apellidos</label>
          <input value="<?php print $info_pedido['apellidos'] ?>" type="text" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input value="<?php print $info_pedido['email'] ?>" type="text" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label>Fecha</label>
          <input value="<?php print $info_pedido['fecha'] ?>" type="text" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-12">
      <h2 class="d-flex justify-content-center py-3">
        <hr>
        Productos Comprados
        <hr>
      </h2>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Titulo</th>
            <th>Foto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>
              Total
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $cantidad = count($info_detalle_pedido);
          if ($cantidad > 0) {
            $c = 0;
            for ($x = 0; $x < $cantidad; $x++) {
              $c++;
              $item = $info_detalle_pedido[$x];
              $total = $item['precio'] * $item['cantidad'];
          ?>
              <tr>
                <td><?php print $c ?></td>
                <td><?php print $item['referencia'] ?></td>
                <td>
                  <?php
                  $foto = '../../upload/' . $item['foto'];
                  if (file_exists($foto)) {
                  ?>
                    <img src="<?php print $foto; ?>" width="35">
                  <?php } else { ?>
                    SIN FOTO
                  <?php } ?>
                </td>
                <td>$ <?php print number_format($item['precio'],2,",",".") ?> COP</td>
                <td><?php print $item['cantidad'] ?></td>
                <td>
                  <?php print $total ?>
                </td>
              </tr>

            <?php
            }
          } else {
            ?>
            <tr>
              <td colspan="6">NO HAY REGISTROS</td>
            </tr>

          <?php } ?>
        </tbody>
      </table>
      <div class="col-md-3">
        <div class="form-group">
          <label>Total Compra</label>
          <input value="<?php print number_format($info_pedido['total'],2,",",".") ?>" type="text" class="form-control" readonly>
        </div>
      </div>
      </fieldset>
      <div class="d-flex align-items-center pt-3">
        <div class="pull-left" style="margin-right: 10px;">
          <a href="index.php" class="btn bg-dark text-white hidden-print">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
          </a>
        </div>
        <div class="pull-right">
          <a href="javascript:;" id="btnImprimir" class="btn btn-danger hidden-print">Imprimir</a>
        </div>
      </div>
    </div>
  </div>
</div> <!-- /container -->

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script>//script para imprimir la pestaña
  $('#btnImprimir').on('click', function() {

    window.print();

    return false;

  })
</script>