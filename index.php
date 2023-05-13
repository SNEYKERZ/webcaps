<?php
include('templates/cabecera.php');
?>

<!-- CARUSEL -->
<section>
  <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="6000" style="padding-bottom: 15px;">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="assets/images/carrusel/6.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="assets/images/carrusel/4.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="assets/images/carrusel/1.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</section>

<!-- PROMOTION BAR -->
<div class="slider_shirt clonar-span">
  <div class="sliders">
    <span class="mx-3"> 1 CAMISETAS EN $30.000 </span>
    <span class="mx-3"> 2 CAMISETAS EN $55.000 </span>
    <span class="mx-3"> 3 CAMISETAS EN $75.000 </span>
    <span class="mx-3"> 4 CAMISETAS EN $95.000 </span>
    <span class="mx-3"> 5 CAMISETAS EN $110.000 </span>
    <span class="mx-3"> 6 CAMISETAS EN $120.000 </span>
  </div>
</div>

<!-- MAIN SECTION -->
<main>
  <div class="titulo_index ">
    <h3>NUESTROS PRODUCTOS</h3>
  </div>
  <div class="products-container d-flex justify-content-center mt-50 mb-50">
    <div class="row gap-10">

      <?php
      require 'vendor/autoload.php';
      $productos = new capsweb\Productos;
      $info_productos = $productos->mostrar();
      $cantidad = count($info_productos);

      if ($cantidad > 0) {
        for ($x = 0; $x < $cantidad; $x++) {
          $item = $info_productos[$x];
      ?>
          <!-- Tarjeta de producto -->
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
            <div class="card">
              <?php
              $foto = 'upload/' . $item['foto'];
              if (file_exists($foto)) {
              ?>
                <i class="fa-solid fa-heart"></i>
                <!-- Fotografia de la imagen -->
                <a href="/webcaps/infoprenda.php?id=<?php print $item['id']  ?>">
                  <img src="<?php print $foto; ?>" class="card-img product-img" style="border-bottom-right-radius: unset;   border-bottom-left-radius: unset;">
                </a>
              <?php } else { ?>
                <!-- Imagen sin fotografia -->
                <a href="carrito.php?id=<?php print $item['id'] ?>">
                  <img src="assets/images/sinfoto.jpg" class="card-img product-img" style="border-radius: none;">
                </a>
              <?php } ?>

              <div class="card-body text-center">
                <h5 class="card-title text-uppercase">
                  <?php print $item['referencia'] ?>
                </h5>
                <span class="card-text card-price font-weight-bold">$ <?php print $item['precio'] ?><b> COP</b></span>
                <a href="carrito.php?id=<?php print $item['id'] ?>" class="bottom-shop mt-4 d-flex"><i class="fa-solid fa-cart-shopping"></i></a>
              </div>
            </div>
          </div>
        <?php }
      } else { ?>
        <h4>NO HAY PRODUCTOS DISPONIBLES ACTUALMENTE :c Estate pendiente de nuestras proximas colecciones!</h4>
      <?php } ?>
    </div>
  </div>
  </div>
</main>

<?php include('templates/whatsAppBottom.php'); ?>
<?php include('templates/footer.php'); ?>