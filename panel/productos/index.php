<?php
include('../cabecera.php');
?>

<main>
  <br>
  <div class="row">
    <div class="col-md-12">
      <div class="pull-right">
        <a href="form_registrar.php" class="btn btn-primary">
          <span class="glyphicon glyphicon-plus"></span>Registrar nuevo producto</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <fieldset>
        <legend>Listado de Productos</legend>
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Referencia</th>
              <th>Categoria</th>
              <th>Precio</th>
              <th>Stock</th>
              <th class="text-center">Foto</th>

              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            require '../../vendor/autoload.php';
            $producto = new capsweb\Productos;
            $info_producto = $producto->mostrar();
            $lista_Productos = count($info_producto);
            if ($lista_Productos > 0) {
              $c = 0;
              for ($x = 0; $x < $lista_Productos; $x++) {
                $c++;
                $item = $info_producto[$x];
            ?>
                <tr>
                  <td><?php print $item['id'] ?></td>
                  <td><?php print $item['referencia'] ?></td>
                  <td><?php print $item['categoria'] ?></td>
                  <td><?php print $item['precio'] ?></td>
                  <td><?php print $item['stock'] ?></td>
                  <td class="text-center">
                    <?php
                    $foto = '../../upload/' . $item['foto'];
                    if (file_exists($foto)) {
                    ?>
                      <img src="<?php print $foto; ?>" width="90" height="120">
                    <?php } else { ?>
                      SIN FOTO
                    <?php } ?>
                  </td>
                  <td class="text-center">
                    <a href="form_actualizar.php?id=<?php print $item['id']  ?>" class="btn  btn-outline-success btn-sm"><img src="../../assets/images/metaforas/edit_icon.png" width="30px" height="30px"></span></a>
                    <a href="../acciones.php?id=<?php print $item['id'] ?>" class="btn btn-outline-danger btn-sm"><img src="../../assets/images/metaforas/trash_icon.png" width="30px" height="30px"></span></a>
                  </td>

                </tr>

              <?php
              }
            } else {

              ?>
              <tr>
                <td colspan="4">NO HAY REGISTROS</td>
              </tr>

            <?php } ?>


          </tbody>

        </table>
      </fieldset>
    </div>
  </div>




</main>



<?php
include('../footer.php');
?>