<?php
include('templates/cabecera.php');
require 'vendor/autoload.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  /*$categoria = new capsweb\Categoria;
  $info_categoria = $categoria->mostrar();*/
  $producto = new capsweb\Productos;
  //Datos que se muestran de la prenda con su categoria (datos limitados)
  $prendaEscogida = $producto->mostrarPorId($id);

  if (!$prendaEscogida)
    header('Location: index.php');
} else {
  header('Location: index.php');
}

$infoPrenda = new capsweb\InfoPrenda();
$fotos = $infoPrenda->mostrarFotos();
?>

<!-- PRODUCT DETAILS CONTAINER -->
<div class="container-product d-flex justify-content-between pb-10">

  <!-- IMAGE CONTAINER -->
  <div class="left">
    <div class="main_image" id="main-img" style="width: auto; height: auto;">
      <?php
      require 'vendor/autoload.php';
      $producto = new capsweb\Productos;
      $fotoPrincipal = 'upload/' . $prendaEscogida['foto'];
      if (file_exists($fotoPrincipal)) {
      ?>
        <!-- Fotografía principal del producto -->
        <img src="<?php print $fotoPrincipal; ?>" class="product-img slide">
      <?php } else { ?>
        <!-- Imagen sin fotografía -->
        <img src="assets/images/sinfoto.jpg" class="product-img">
      <?php } ?>

      <!-- PHOTO GALLERY -->
      <!-- <div class="option d-flex justify-content-center">
      <?php
      $infoPrenda = new capsweb\InfoPrenda();
      $fotos = $infoPrenda->mostrarFotos();
      foreach ($fotos as $foto) {
        $rutaFoto = 'upload/' . $foto['ruta'];
        if (file_exists($rutaFoto)) {
      ?>
          <img src="<?php print $rutaFoto; ?>" class="product-img slide">
        <?php } else { ?>
          <img src="assets/images/sinfoto.jpg" class="product-img">
        <?php } ?>
      <?php } ?>
      </div> -->
    </div>

    <!-- PHOTO GALLERY -->
    <div class="option d-flex justify-content-center">
      <?php
      require 'vendor/autoload.php';

      use capsweb\InfoPrenda;

      $infoPrenda = new InfoPrenda();

      // Obtener las rutas de las fotos desde la base de datos
      $fotos = $infoPrenda->mostrarFotos();

      foreach ($fotos as $foto) {
        $rutaFoto = 'upload/' . $foto['ruta'];

        if (file_exists($rutaFoto)) {
          // Fotografía del producto
          echo '<img src="' . $rutaFoto . '" class="product-img slide">';
        } else {
          // Imagen sin fotografía
          echo '<img src="assets/images/sinfoto.jpg" class="product-img">';
        }
      }
      ?>
    </div>
  </div>


  <!-- PRODUCT DESCRIPTION CONTAINER   -->
  <div class="right">
    <h3 class="referencia"><?php echo $prendaEscogida['referencia']; ?></h3>
    <h4 class="categoria"><?php echo $prendaEscogida['categoria']; ?></h4>
    <h4 class="precio"><small>$</small><?php echo $prendaEscogida['precio']; ?></h4>
    <p></p>

    <?php
    $colores = array("Rojo", "Azul", "Verde", "Amarillo", "Negro");
    ?>

    <div class="color d-flex">
      <?php foreach ($colores as $color) { ?>
        <span class="color-option <?php echo strtolower($color); ?>"></span>
      <?php } ?>
    </div>

    <!-- Tallas  -->
    <div class="size">
      <h5>Tallas disponibles</h5>
      <ul>
        <?php
        $tallasDisponibles = $producto->mostrarTallas($id);
        foreach ($tallasDisponibles as $talla) {
          echo "<li name='talla'>{$talla}</li>";
        }
        ?>
      </ul>
    </div>

    <!-- Agrega el producto al carrito de compra  -->
    <button onclick="window.location.href=' carro/index.php?id=<?php echo $prendaEscogida['id']; ?>'">Agrega al carrito</button>
  </div>
</div>