<?php
session_start();
if (empty($_SESSION["id"])) {
  header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
?>

<div class="container" id="main">
  <div class="row">
    <div class="col-md-12">
      <fieldset>
        <legend>Listado de Pedidos</legend>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Cliente</th>
              <th>N° Pedido</th>
              <th>Total</th>
              <th>Fecha</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            require '../../vendor/autoload.php';
            $pedido = new capsweb\pedidos;
            $info_pedido = $pedido->mostrar();
            $cantidad = count($info_pedido);
            if ($cantidad > 0) {
              $c = 0;
              for ($x = 0; $x < $cantidad; $x++) {
                $c++;
                $item = $info_pedido[$x];
            ?>
                <tr>
                  <td><?php print $c ?></td>
                  <td><?php print $item['nombre'] . ' ' . $item['apellidos'] ?></td>
                  <td><?php print $item['id'] ?></td>
                  <td><?php print $item['total'] ?> COP</td>
                  <td><?php print $item['fecha'] ?></td>
                  <td class="text-center">
                    <a href="ver.php?id=<?php print $item['id'] ?>" class="btn btn-outline-info btn-sm"><i class="fa-solid fa-magnifying-glass"></i></a>
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
      </fieldset>
    </div>
  </div>
</div> <!-- /container -->