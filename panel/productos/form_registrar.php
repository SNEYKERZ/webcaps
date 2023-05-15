<?php
session_start();
if(empty($_SESSION["id"])){
header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
?>
<div class="row">
  <div class="col-md-12">
    <fieldset>
      <legend>Datos del producto</legend>
      <form method="POST" action="../acciones.php" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Referencia</label>
              <input type="text" class="form-control" name="referencia" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Categorias</label>
              <select class="form-control" name="categoria_id" required>
                <option value="">-SELECCIONE-</option>
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
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Precio</label>
              <textarea class="form-control" name="precio" placeholder="$000" required></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Foto</label>
              <input type="file" class="form-control" name="foto" required>
            </div>
          </div>
        </div>
        <!--CHECKBOX DE TALLAS-->
        <div class="row">
          <div class="form-group">
            <label>Tallas disponibles</label>
            <br>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
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
        <!-- fin CHECKBOX DE TALLAS-->
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Cantidad</label>
              <input type="number" class="form-control" name="stock" placeholder="0" required>
            </div>
          </div>
        </div>
        <input type="submit" name="accion" class="btn btn-primary" value="Registrar">
        <a href="index.php" class="btn btn-danger">Cancelar</a>
      </form>
    </fieldset>

  </div>
</div>


<br><br>

<?php
include('../../templates/footerAdmin.php');
?>