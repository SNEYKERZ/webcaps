<?php
//ACTIVAR LAS SESSIONES EN PHP
session_start();
include('../templates/carroCabecera.php');
require 'funcionesCarrito.php';
require '../src/productos.php';
require '../vendor/autoload.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  require '../vendor/autoload.php';
  $producto = new capsweb\Productos;
  $resultado = $producto->mostrarPorId($id); //busca el producto por medio de su id
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

<h2 class="text-center text-uppercase pt-5">Carrito de compras</h2>
<div class="container-car-shopping-content" id="main">
  <div class="table-header">
    <div class="botones">
      <button type="button" class="btn btn-dark">
        <a href="../index.php">
          <i class="fa-solid fa-arrow-left"></i>
          Seguir Comprando
        </a>
      </button>
    </div>
    <form method="POST" action="eliminar_carrito.php" enctype="multipart/form-data">
      <!-- <a href="form_registrar.php" class="btn btn-primary"> -->
      <button type="submit" class="btn btn-outline-danger btn-xs" name="accion" id="btn_limpiar" value="eliminartodo" style="width: 200px;">
        Eliminar Carrito
        <i class="fa-solid fa-trash"></i>
      </button>
      <!-- <input type="submit" name="accion" class="btn btn-danger" id="btn_limpiar" value="eliminartodo"> -->

    </form>
  </div>
  <table class="table"> <!--- table-bordered table-hover -->
    <thead>
      <tr>
        <th>Foto</th>
        <th>Referencia</th>
        <th>Categoria</th>
        <th>Precio c/u</th>
        <th>Cantidad</th>
        <th>Talla</th>
        <th>subtotal</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php $subTotal = 0;
      if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $c = 0;
        
        foreach ($_SESSION['carrito'] as $indice => $value) {

          $c++;
          $idProducto = $value['id'];
          $producto = new capsweb\Productos;
          $tallasProducto = $producto->mostrarTallas($idProducto);

          // calcula el precio de las prendas por sus cantidades
          if ($value['cantidad'] == 5  && $value['categoria']== 'CAMISETA') {
            $parcial = $value['precio']= 22000;
            $subTotal +=  $parcial * $value['cantidad'];
          } if ($value['cantidad'] == 4  && $value['categoria']== 'CAMISETA') { 
            $parcial = $value['precio']= 23750;
            $subTotal +=  $parcial * $value['cantidad'] ;
          } if ($value['cantidad'] == 3  && $value['categoria']== 'CAMISETA' ) {
            $parcial = $value['precio']= 25000;
            $subTotal += $parcial * $value['cantidad'] ;
          } if ($value['cantidad'] == 2 && $value['categoria']== 'CAMISETA') {
            $parcial = $value['precio']= 27500;
            $subTotal += $parcial * $value['cantidad'];
          } if ($value['cantidad'] >= 5 || $value['cantidad'] <=1 ) {
            $subTotal =  $value['precio'] * $value['cantidad'];
          } else{$subTotal =  $value['precio'] * $value['cantidad'];}
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
              <td data-label="tallas">

                <?php if ($tallasProducto !== false) {
                  echo '<select name="talla" id="talla">';
                  foreach ($tallasProducto as $talla) {
                    $selected = '';
                    if ($talla == $tallaSeleccionada) {
                      $selected = 'selected';
                    }
                    echo '<option value="' . $talla . '" ' . $selected . '>' . $talla . '</option>';
                  }
                  echo '</select>';
                } else {
                  echo 'No se encontraron tallas';
                }
                ?>
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
        <?php
        }
      } else { ?>
        <tr>
          <td colspan="8">NO HAY PRODUCTOS EN EL CARRITO</td>
        </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="6" class="text-right">Total</td>
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
      <button type="button" class="btn btn-success"> <a href="../finalizar.php">
          Finalizar Compra
          <i class="fa-solid fa-dollar-sign"></i>
      </button>
    </div>
  <?php } ?>
</div> <!-- /container -->