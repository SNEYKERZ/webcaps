<?php

session_start();
if (empty($_SESSION["id"])) {
  header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
require '../../vendor/autoload.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  $producto = new capsweb\Productos;
  $resultado = $producto->mostrarPorId($id);

  if (!$resultado)
    header('Location: index.php');
} else {
  header('Location: index.php');
}
?>

<head>

  <style>
    section {
      height: 88.5vh;
      text-align: center;
      font-family: 'Poppins', sans-serif;
      background-image: linear-gradient(to left, #4b4b4b, #0a0a0a);
      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
      justify-content: start;
    }

    .container-edit-products {
      width: 35rem;
      height: 100%;
      border-radius: 4px;
      padding: 30px 20px 50px 20px;
      background-color: rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(10px);
      box-shadow: 25px 5px 20px 3px rgba(0, 0, 0, .2)
    }
  </style>

</head>


<section>
  <div class="container-edit-products d-flex justify-content-center align-items-center">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>Datos del producto</legend>
          <?php
          print $id
          ?>
          <form method="POST" action="../acciones.php" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?php print $resultado['id'] ?>">

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Referencia</label>
                  <!-- Necesario hacer el llamado al item para que se efectue el cambio-->
                  <input value="<?php print $resultado['referencia'] ?>" type="text" class="form-control" name="referencia" required>

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
                      <option value="<?php print $item['id'] ?>" <?php print $resultado['categoria_id'] == $item['id'] ? 'selected' : '' ?>>
                        <?php print $item['categoria'] ?></option>
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
                  <!-- Necesario hacer el llamado al item para que se efectue el cambio-->
                  <input value="<?php print $resultado['precio'] ?>" type="number" class="form-control" name="precio" placeholder="0.000" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Foto</label>
                  <!-- Necesario hacer el llamado al item para que se efectue el cambio-->
                  <input type="file" class="form-control" name="foto">
                  <input type="hidden" name="foto_temp" value="<?php print $resultado['foto'] ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Cantidad</label>
                  <input type="text" class="form-control" name="stock" placeholder="0" required>
                </div>
              </div>
            </div>
            <input type="submit" name="accion" class="btn btn-primary" value="Actualizar">
            <a href="index.php" class="btn btn-danger">Cancelar</a>
          </form>
        </fieldset>
      </div>
    </div>
  </div>
</section>