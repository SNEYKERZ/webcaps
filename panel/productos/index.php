<?php
session_start();
if (empty($_SESSION["id"])) {
  header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
?>

<head>
  <!-- STYLES -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/tabla-productos.css">

  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../../assets/js/alerts-stock.js"></script>

</head>

<div class="container-product-table">
  <div class="container-content-product-table">
    <h2 class="d-flex justify-content-center text-uppercase">Tablas de productos</h2>
    <div class="table-header">
      <!-- <a href="form_registrar.php" class="btn btn-primary"> -->
      <a href="" data-bs-toggle="modal" data-bs-target="#registerModal" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus">Registrar nuevo producto</span>
      </a>
    </div>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Referencia <i class="fa-solid fa-sort"></i></th>
          <th>Categoria <i class="fa-solid fa-sort"></i></th>
          <th>Precio <i class="fa-solid fa-sort"></i></th>
          <th>Stock <i class="fa-solid fa-sort"></i></th>
          <th>Foto</th>
          <th>Acciones</th>
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
          for ($i = 0; $i < $lista_Productos; $i++) {
            $c++;
            $item = $info_producto[$i];
        ?>
            <tr>
              <td>
                <?php print $item['id'] ?>
              </td>
              <td>
                <?php print $item['referencia'] ?>
              </td>
              <td>
                <?php print $item['categoria'] ?>
              </td>
              <td>
                <?php print $item['precio'] ?>
              </td>
              <td>
                <?php print $item['stock'] ?>
              </td>
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
              <td class="icons d-flex justify-content-center align-items-center gap-2">
                <!-- Button trigger modal -->
                <a href="" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo $item['id']; ?>" type="button" class="btn btn-outline-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></span></a>
                <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal-<?php echo $item['id']; ?>" type="button" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></span></a>
                <!-- <a href="../acciones.php?id=<?php print $item['id'] ?>" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></span></a> -->
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
  </div>
</div>

<!-- MODAL EDITION (Ventana Emergente) -->
<?php
for ($i = 0; $i < $lista_Productos; $i++) {
  $item = $info_producto[$i];
?>
  <div class="modal fade" id="editModal-<?php echo $item['id']; ?>" tabindex="-1" aria-labelledby="editModal-<?php echo $item['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- HEADER MODAL -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- BODY MODAL -->
        <div class="modal-body">
          <div class="container-edit-products d-flex justify-content-center align-items-center">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="../acciones.php" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php print $item['id'] ?>">

                  <!-- SECTIONS MODAL -->
                  <div class="row pt-2">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Referencia</label>
                        <input value="<?php print $item['referencia'] ?>" type="text" class="form-control" name="referencia" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Cantidad</label>
                        <input type="text" class="form-control" name="stock" value="" placeholder="0" required>
                      </div>
                    </div>
                  </div>

                  <div class="row pt-2">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Precio</label>
                        <input value="" class="form-control" name="precio" placeholder="$0" required>
                      </div>
                    </div>


                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Categorías</label>
                        <select class="form-control" name="categoria_id" required>
                          <option value="">SELECCIONE</option>
                          <?php
                          require '../../vendor/autoload.php';
                          $categoria = new capsweb\Categorias;
                          $info_categoria = $categoria->mostrar();
                          $cantidad = count($info_categoria);
                          for ($x = 0; $x < $cantidad; $x++) {
                            $item = $info_categoria[$x];
                          ?>
                            <option value="<?php print $item['id'] ?>" <?php print $item['categoria'] == $item['id'] ? 'SELECTED' : '' ?>>
                              <?php print $item['categoria'] ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row pt-2">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Foto</label>
                        <!-- Necesario hacer el llamado al item para que se efectue el cambio-->
                        <input type="file" class="form-control" name="foto">
                        <input type="hidden" name="foto_temp" value="<?php print $resultado['foto'] ?>">
                      </div>
                    </div>
                  </div>
                  <!-- FOOTER MODAL -->
                  <div class="modal-footer">
                    <input type="submit" name="accion" class="btn btn-primary" value="Actualizar">
                    <a href="index.php" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<!-- MODAL DELETE (Ventana Emergente) -->
<?php
for ($i = 0; $i < $lista_Productos; $i++) {
  $item = $info_producto[$i];
?>
  <div class="modal fade" id="deleteModal-<?php echo $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModal-<?php echo $item['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- HEADER MODAL -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- BODY MODAL -->
        <div class="modal-body">
          <p>¿Estás seguro de que deseas eliminar este producto?</p>
        </div>
        <!-- FOOTER MODAL -->
        <div class="modal-footer">
          <form action="../acciones.php" method="GET">
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
            <input type="submit" name="accion" class="btn btn-danger" value="Eliminar">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<!-- MODAL REGISTER (Ventana Emergente) -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- MODAL HEADER -->
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Registrar nuevo producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- MODAL BODY -->
      <div class="modal-body">
        <div class="container-register-products d-flex justify-content-center align-items-center">
          <div class="row ">
            <div class="col-md-12 ">
              <form method="POST" action="../acciones.php" enctype="multipart/form-data">

                <!-- SECTION MODAL -->
                <div class="row pt-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Referencia</label>
                      <input type="text" class="form-control" name="referencia" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Cantidad</label>
                      <input type="text" class="form-control" name="stock" placeholder="0" required>
                    </div>
                  </div>
                </div>

                <div class="row pt-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Precio</label>
                      <input value="" class="form-control" name="precio" placeholder="$000" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Categorias</label>
                      <select class="form-control" name="categoria_id" required>
                        <option value="">SELECCIONE</option>
                        <?php
                        require '../../vendor/autoload.php';
                        $categoria = new capsweb\Categorias;
                        $info_categoria = $categoria->mostrar();
                        $cantidad = count($info_categoria);
                        for ($x = 0; $x < $cantidad; $x++) {
                          $item = $info_categoria[$x];
                        ?>
                          <option value="<?php print $item['id'] ?>"><?php print $item['categoria'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <!--CHECKBOX DE TALLAS-->
                <div class="row">
                  <div class="col-md-6 pt-3">
                    <div class="form-group">
                      <label>Tallas disponibles</label>
                      <div class="btn-group pt-1" role="group" aria-label="Basic checkbox toggle button group">
                        <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off" name="talla_id">
                        <label class="btn btn-outline-dark" for="btncheck1">S</label>

                        <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off" name="talla_id">
                        <label class="btn btn-outline-dark" for="btncheck2">M</label>

                        <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off" name="talla_id">
                        <label class="btn btn-outline-dark" for="btncheck3">L</label>

                        <input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off" name="talla_id">
                        <label class="btn btn-outline-dark" for="btncheck4">XL</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- END CHECKBOX DE TALLAS-->

                <div class="row pt-2">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Foto</label>
                      <input type="file" class="form-control" name="foto" required>
                    </div>
                  </div>
                </div>

                <!-- MODAL FOOTER -->
                <div class="modal-footer">
                  <input type="submit" name="accion" class="btn btn-primary" value="Registrar">
                  <a href="index.php" class="btn btn-danger">Cancelar</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>