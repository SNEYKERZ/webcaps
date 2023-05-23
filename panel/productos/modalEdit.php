<!-- MODAL EDITION (Ventana Emergente) -->
<div class="modal fade" id="editModal-<?php $item['id']; ?>" tabindex="-1" aria-labelledby="editModal-<?php $item['id']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- HEADER MODAL -->
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
      </div>

      <!-- BODY MODAL -->
      <div class="modal-body">
        <div class="container-edit-products d-flex justify-content-center align-items-center">
          <div class="row">
            <div class="col-md-12">
              <form method="POST" action="../acciones.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php print $item['id'] ?>">

                <!-- SETIONS MODAL -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Referencia</label>
                      <input value="<?php print $item['referencia'] ?>" type="text" class="form-control" name="referencia" required>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Cantidad</label>
                        <input type="text" class="form-control" name="stock" value="" placeholder="0" required>
                      </div>
                    </div>
                  </div>

                  <!-- SETIONS MODAL -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Precio</label>
                        <input value="" class="form-control" name="precio" placeholder="$0" required>
                      </div>
                    </div>
                  </div>

                  <!-- SETIONS MODAL -->
                  <div class="row">
                    <div class="col-md-12">
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
                            <option value="<?php print $item['id'] ?>" <?php print $item['categoria'] == $item['id'] ? 'SELECTED' : '' ?>>
                              <?php print $item['categoria'] ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <!-- SETIONS MODAL -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto">
                        <input type="hidden" name="foto_temp" value="">
                      </div>
                    </div>
                  </div>
              </form>

            </div>
          </div>
        </div>

        <!-- FOOTER MODAL -->
        <div class="modal-footer">
          <input type="submit" name="accion" class="btn btn-primary" value="Actualizar">
          <a href="index.php" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
        </div>
      </div>
    </div>
  </div>
</div>