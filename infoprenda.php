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
?>

<?php
require 'vendor/autoload.php';

$infoPrenda = new capsweb\InfoPrenda();
$rutas = $infoPrenda->mostrarFotos();
?>


<!-- PRODUCT DETAILS CONTAINER -->
<div class="container-product d-flex justify-content-between pb-10">

  <!-- IMAGE CONTAINER -->
  <div class="left">
    <div class="main_image" id="main-img" style="width: auto; height: auto;">
      <?php if (!empty($rutas)) { ?>
        <img src="assets/images/productos/<?php echo $prendaEscogida['id'] ?>.jpg" class="slide">
      <?php } else { ?>
        <img src="assets/images/productos/<?php echo $prendaEscogida['id'] ?>.jpg">
      <?php } ?>
    </div>

    <!-- PHOTO GALLERY -->
    <div class="option d-flex justify-content-center">
      <?php foreach ($rutas as $ruta) { ?>
        <img src="assets/images/productos/<?php echo $prendaEscogida['id'] ?>.jpg" onclick="img('assets/images/productos/<?php echo $prendaEscogida['id'] ?>.jpg')" class="slide">
        <img src="assets/images/sinfoto.jpg" onclick="img('assets/images/sinfoto.jpg')">
        <img src="assets/images/productos/1.jpg" onclick="img('assets/images/productos/1.jpg')">
      <?php } ?>
    </div>

    <!-- FALTA LAS RUTAS PARA PROBAR -->
    <!-- PHOTO GALLERY -->
    <!-- <div class="option d-flex justify-content-center">
      <?php foreach ($rutas as $ruta) { ?>
        <img src="<?php echo $ruta; ?>" alt="" onclick="img('<?php echo $ruta; ?>')" class="slide">
      <?php } ?>
    </div> -->

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
    <button onclick="window.location.href='carro/index.php?id=<?php echo $prendaEscogida['id']; ?>'">Agrega al carrito</button>
  </div>
</div>


<section>
  <!-- PRODUCT DETAILS CONTAINER -->
  <div class="container-product d-flex justify-content-between pb-10">

    <!-- IMAGE CONTAINER -->
    <div class="left">
      <div class="main_image" id="main-img" style="width: auto; height: auto;">
        <?php
        $fotos = $rutas;

        if (!empty($fotos)) {
          $foto = $fotos[0];
          if (file_exists($foto)) {
        ?>
            <img src="<?php echo $ruta ?>" class="slide">
          <?php } else { ?>
            <img src="assets/images/sinfoto.jpg">
          <?php }
        } else { ?>
          <img src="assets/images/sinfoto.jpg">
        <?php } ?>
      </div>

      <!-- PHOTO GALLERY -->
      <div class="option d-flex justify-content-center">
        <?php
        foreach ($fotos as $foto) {
        ?>
          <img src="<?php echo $foto; ?>" alt="" onclick="img('<?php echo $foto; ?>')">
        <?php } ?>
      </div>
    </div>

    <!-- PRODUCT DESCRIPTION CONTAINER -->
    <div class="right">
      <h3 class="referencia"><?php echo $prendaEscogida['referencia']; ?></h3>
      <h4 class="categoria"><?php echo $prendaEscogida['categoria']; ?></h4>
      <h4 class="precio"><small>$</small><?php echo $prendaEscogida['precio']; ?></h4>
      <p></p>

      <h5>Colores</h5>
      <div class="color d-flex">
        <span onclick="change('#ff0000')"></span>
        <span onclick="change('#00ff00')"></span>
        <span onclick="change('#0000ff')"></span>
        <span onclick="change('#ffff00')"></span>
        <span onclick="change('#ff00ff')"></span>
      </div>

      <div class="size">
        <h5>Tallas disponibles</h5>
        <ul>
          <?php if (isset($prendaEscogida['talla'])) { ?>
            <li><?php echo $prendaEscogida['talla']; ?></li>
          <?php } ?>
          <li>M</li>
          <li>L</li>
          <li>XL</li>
        </ul>
      </div>


      <!-- Agrega el producto al carrito de compra -->
      <button onclick="window.location.href='carro/index.php?id=<?php echo $prendaEscogida['id']; ?>'">Agrega al carrito</button>
    </div>
  </div>
</section>

<script>
  function img(anything) {
    document.querySelector('.slide').src = anything;
  }

  function change(color) {
    const homeElement = document.querySelector('.home');
    homeElement.style.background = color;
  }
</script>