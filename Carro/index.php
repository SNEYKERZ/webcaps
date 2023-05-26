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

<main>
  <div class="container" id="main">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Referencia</th>
          <th>Categoria</th>
          <th>Foto</th>
          <th>Precio</th>
          <th>Cantidad</th>
          <th>Total</th>
          <th></th>
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
                <td><?php print $c ?></td>
                <td><?php print $value['referencia']  ?></td>
                <td><?php print $value['categoria']  ?></td>
                <td>
                  <?php
                  $foto = '../upload/' . $value['foto'];
                  if (file_exists($foto)) {
                  ?>
                    <img src="<?php print $foto; ?>" width="35">
                  <?php } else { ?>
                    <img src="../assets/images/sinfoto.jpg" width="35">
                  <?php } ?>
                </td>
                <td><?php print $value['precio']  ?> COP</td>
                <td>
                  <input type="hidden" name="id" value="<?php print $value['id'] ?>">
                  <input type="number" name="cantidad" class="form-control u-size-100" value="<?php print $value['cantidad'] ?>">
                </td>
                <td>
                  <?php echo $subTotal  ?> COP
                </td>
                <td>
                  <button type="submit" class="btn btn-outline-info ">
                    <img src="../assets/images/metaforas/actualizar.png" width="30" height="30">
                  </button>
                  <a href="eliminar_carrito.php?id=<?php print $value['id'] ?>" class="btn btn-outline-danger btn-xs">
                    <img src="../assets/images/metaforas/trash_icon.png" width="30" height="30">
                  </a>
                </td>
              </form>
            </tr>
          <?php  }
        } else { ?>
          <tr>
            <td colspan="7">NO HAY PRODUCTOS EN EL CARRITO</td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="5" class="text-right">Total</td>
          <td><?php print calcularTotal(); ?> COP</td>
        </tr>
      </tfoot>
    </table>
    <hr>
    <?php
    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    ?>
      <div class="botones">
        <style>
          a {
            text-decoration: none;
            color: #fff;
          }
        </style>
        <button type="button" class="btn btn-info"> <a href="../index.php">
            Seguir Comprando </button>
        <button type="button" class="btn btn-success"> <a href="../finalizar.php">
            Finalizar Compra </button>
      </div>
      <br><br>
    <?php } ?>
  </div> <!-- /container -->
</main>