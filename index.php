<?php
include('templates/cabecera.php');
?>

<!-- CARUSEL -->
<section>
  <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="6000">
    <ol class="carousel-indicators">
      <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExample" data-slide-to="1"></li>
      <li data-target="#carouselExample" data-slide-to="2"></li>
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

<!-- MAIN SECTION -->
<main>
  <br>
  <div class="titulo_index ">
    <h3> NUESTROS PRODUCTOS</h3>
    <br>

  </div>
  <div class="products-container p-2">
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
          <div class="col-xl-3 col-lg-3 col-md-4">
            <div class="card">
              <?php
              $foto = 'upload/' . $item['foto'];
              if (file_exists($foto)) {
              ?>
                <!-- Fotografia de la imagen -->
                <a href="/webcaps/infoprenda.php?id=<?php print $item['id']  ?>">
                  <img src="<?php print $foto; ?>" class="card-img product-img">
                </a>
              <?php } else { ?>
                <!-- Imagen sin fotografia -->
                <a href="carrito.php?id=<?php print $item['id'] ?>">
                  <img src="assets/images/sinfoto.jpg" class="card-img product-img">
                </a>
              <?php } ?>

              <div class="card-body">
                <h5 class="card-title text-capitalize"><?php print $item['referencia'] ?></h1>
                </h5>
                <span class="card-text card-price font-weight-bold">$ <?php print $item['precio'] ?><b>COP</b></span>
                <a href="carrito.php?id=<?php print $item['id'] ?>" class="btn btn-success mt-2 d-block">Comprar</a>
              </div>
            </div>
          </div>
        <?php }
      } else { ?>
        <h4>NO HAY REGISTROS</h4>
      <?php } ?>
    </div>
  </div>
  </div>
</main>

<?php
include('templates/whatsAppBottom.php');
?>
<?php
include('templates/footer.php');
?>