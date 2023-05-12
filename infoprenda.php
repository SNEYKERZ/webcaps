<?php
include('templates/cabecera.php');
require 'vendor/autoload.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  /*$categoria = new capsweb\Categoria;
  $info_categoria = $categoria->mostrar();*/
  $producto = new capsweb\Productos;

  //Datos que se muestran de la prenda con su categoria (datos limitados)
  $prendaEscogida = $producto->mostrarPorIdCategoria($id);

  //Datos que se envian al carrito de compras de la prenda (todos los datos)
  $prenda_al_carrito = $producto->mostrarPorId($id);


  if (!$prendaEscogida)
    header('Location: index.php');
} else {
  header('Location: index.php');
}

?>

<body>
  <section>
    <!-- PRODUCT DETAILS CONTAINER -->
    <div class="container-product d-flex justify-content-between pb-10">
      <!-- IMAGE CONTAINER -->
      <div class="left">
        <div class="main_image" id="main-img" style="width: auto; height: auto;">
          <?php
          $foto = 'upload/' . $prendaEscogida['foto'];
          if (file_exists($foto)) {
          ?>
            <img src="<?php print $foto; ?>" class="slide">
          <?php } else { ?>
            <img src="assets/images/sinfoto.jpg">
          <?php } ?>
        </div>
        <!-- PHOTO GALLERY -->
        <div class="option d-flex justify-content-center">
          <img src="<?php print $foto; ?>" alt="" onclick="img('<?php print $foto; ?>')">
          <img src="<?php print $foto; ?>" alt="" onclick="img('<?php print $foto; ?>')">
          <img src="<?php print $foto; ?>" alt="" onclick="img('<?php print $foto; ?>')">
          <img src="<?php print $foto; ?>" alt="" onclick="img('<?php print $foto; ?>')">
        </div>
      </div>

      <!-- PRODUCT DESCRIPTION CONTAINER  -->
      <div class="right">
        <h3 class="referencia"> <?php print $prendaEscogida['referencia'] ?> </h3>
        <h4 class="categoria"><?php print $prendaEscogida['categoria'] ?></h4>
        <h4 class="precio"><small>$ </small><?php print $prendaEscogida['precio'] ?></h4>
        <p></p>

        <h5>Colores</h5>
        <div class="color d-flex">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>

        <div class="size">
          <h5>Tallas disponibles</h5>
          <ul>
            <!-- <li> <? /** php print $prendaEscogida['talla_id'] **/ ?></li>-->
            <li>M</li>
            <li>L</li>
            <li>XL</li>
          </ul>
        </div>
        <!-- Agrega el producto al carrito de compra -->
        <button onclick="window.location.href='carrito.php?id=<?php print $prenda_al_carrito['id'] ?>'">Agrega al carrito</button>
      </div>
    </div>
  </section>
</body>

<?php
include('templates/footer.php');
?>