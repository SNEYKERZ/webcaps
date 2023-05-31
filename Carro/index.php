<?php
//ACTIVAR LAS SESSIONES EN PHP
session_start();
include('../templates/carroCabecera.php');
require 'funcionesCarrito.php';
require '../vendor/autoload.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  require '../vendor/autoload.php';
  $producto = new capsweb\Productos;
  $resultado = $producto->mostrarPorId($id);

  if (!$resultado)
    header('Location: ../index.php');

  if (isset($_SESSION['carrito'])) { //SI EL CARRITO EXISTE
    //SI PRODUCTO EXISTE EN EL CARRITO
    if (array_key_exists($id, $_SESSION['carrito'])) {
      actualizarProducto($id);
    } else {
      //  SI EL CARRITO NO EXISTE EN EL CARRITO
      agregarProducto($resultado, $id);
    }
  } else {
    //  SI EL CARRITO NO EXISTE
    agregarProducto($resultado, $id);
  }
}
?>

<link rel="stylesheet" href="../assets/css/carrito.css">
<script>
  $(document).ready(function() {})
</script>
<h2 class="text-center text-uppercase pt-5">Carrito de compras</h2>
<div class="container-car-shopping-content" id="main">
  <table class="table "> <!--- table-bordered table-hover -->
    <thead>
      <tr>
        <th>Foto</th>
        <th>Referencia</th>
        <th>Categoria</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Total</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $c = 0;

        foreach ($_SESSION['carrito'] as $indice => $value) {
          $c++;

          $subTotal = $value['precio'] * $value['cantidad'];
      ?>
          <tr>
            <form action="actualizar_carrito.php" method="post">
              <td data-label="Foto">
                <?php
                $foto = '../upload/' . $value['foto'];
                if (file_exists($foto)) {
                ?>
                  <img src="<?php print $foto; ?>" width="35">
                <?php } else { ?>
                  <img src="../assets/images/sinfoto.jpg" width="35">
                <?php } ?>
              </td>
              <td data-label="Referencia">
                <?php print $value['referencia'] ?>
              </td>
              <td data-label="Categoria">
                <?php print $value['categoria'] ?>
              </td>

              <td data-label="Precio">
                <?php print $value['precio'] ?> COP
              </td>
              <td data-label="Cantidad" class="d-flex justify-content-between ">
                <input type="hidden" name="id" value="<?php print $value['id'] ?>">
                <input type="number" name="cantidad" class="form-control u-size-100" value="<?php print $value['cantidad'] ?>">
              </td>
              <td data-label="Valor">
                <?php echo $subTotal ?> COP
              </td>
              <td data-label="Acciones">
                <button type="submit" class="btn btn-dark">
                  <i class="fa-solid fa-rotate-right"></i>
                </button>
                <a href="eliminar_carrito.php?id=<?php print $value['id'] ?>" class="btn btn-outline-danger btn-xs">
                  <i class="fa-solid fa-trash"></i>
                </a>
              </td>
            </form>
          </tr>
        <?php }
      } else { ?>
        <tr>
          <td colspan="7">NO HAY PRODUCTOS EN EL CARRITO</td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="5" class="text-right">Total</td>
        <td>
          <?php print calcularTotal(); ?> COP
        </td>
        <td></td>
      </tr>
    </tfoot>
  </table>
  <hr>
  <?php
  if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
  ?>
    <div class="botones">
      <button type="button" class="btn btn-dark"> <a href="../index.php">
          <i class="fa-solid fa-arrow-left"></i>
          Seguir Comprando
      </button>
      <button type="button" class="btn btn-success"> <a href="../finalizar.php">
          Finalizar Compra
          <i class="fa-solid fa-dollar-sign"></i>
      </button>
    </div>
  <?php } ?>
</div> <!-- /container -->