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
<div class="slider-shirt">
  <div class="sliders block-1">
    <span class="mx-3"> 1 CAMISETAS EN $30.000 </span>
    <span class="mx-3"> 2 CAMISETAS EN $55.000 </span>
    <span class="mx-3"> 3 CAMISETAS EN $75.000 </span>
    <span class="mx-3"> 4 CAMISETAS EN $95.000 </span>
    <span class="mx-3"> 5 CAMISETAS EN $110.000 </span>
    <span class="mx-3"> 6 CAMISETAS EN $120.000 </span>
  </div>

  <div class="sliders block-2">
    <span class="mx-3"> 1 CAMISETAS EN $30.000 </span>
    <span class="mx-3"> 2 CAMISETAS EN $55.000 </span>
    <span class="mx-3"> 3 CAMISETAS EN $75.000 </span>
    <span class="mx-3"> 4 CAMISETAS EN $95.000 </span>
    <span class="mx-3"> 5 CAMISETAS EN $110.000 </span>
    <span class="mx-3"> 6 CAMISETAS EN $120.000 </span>
  </div>
</div>

<!-- MAIN SECTION -->
<main class="pb-4">
  <div class="titulo_index ">
    <h3>NUESTROS PRODUCTOS</h3>
  </div>
  <div class="products-container d-flex justify-content-center mt-50 mb-50">
    <div class="row gap-10">

      <?php
      require 'vendor/autoload.php';
      $productos = new capsweb\Productos;
      $info_productos = $productos->mostrarPrueba();
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
                <a href="carrito.php?id=<?php print $item['id'] ?>" class="bottom-shop d-flex">
                  <span class="card-text card-price">$ <?php print $item['precio'] ?>
                    <b> COP</b> <i class="fa-solid fa-cart-shopping"></i>
                  </span>
                </a>
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

<!-- PAYMENT METHODS -->
<div class="slider-payment">
  <div class="slide-track primary">
    <div class="slide-content"><img src="https://logotipoz.com/wp-content/uploads/2021/10/bancolombia-logo-png-transparente.png" alt="Bancolombia"></div>
    <div class="slide-content"><img src="https://mercantilcolpatria.com/wp-content/uploads/2022/09/mercantilColpatria.png" alt="Colpatria"></div>
    <div class="slide-content"><img src="https://www.operadorjuegos.com.co/images/Logo-Baloto-Big.png" alt="Baloto"></div>
    <div class="slide-content"><img src="https://www.tuya.com.co/sites/default/files/landings/paso-a-paso-exitocom/logoexito-pasoapaso-exitocom.png" alt="Exito"></div>
    <div class="slide-content"><img src="https://static.ofertia.com.co/comercios/Carulla/profile-15696.v11.png" alt="Carulla"></div>
    <div class="slide-content"><img src="https://www.america-retail.com/static//2019/03/Surtimax.png" alt="SurtiMax"></div>
    <div class="slide-content"><img src="https://www.superinter.com.co/sites/default/files/logo-super-inter-.png" alt="SuperInter"></div>
    <div class="slide-content"><img src="https://magv1-prod.s3.amazonaws.com/image_assets/files/14832/medium-logo-.png?1648817626" alt="Olimpica"></div>
    <div class="slide-content"><img src="https://www.efecty.com.co/WebApi//uploads/logo-efecty_nuevo-01-2.png" alt="Efecty"></div>
    <div class="slide-content"><img src="https://laherradura.com.co/wp-content/uploads/2020/08/gane.png" alt="Gane"></div>
    <div class="slide-content"><img src="https://www.americadecali.co/wp-content/uploads/2021/09/LOGO-SUPER-GIROS.png" alt="Super Giros"></div>
  </div>

  <div class="slide-track secondary">
    <div class="slide-content"><img src="https://logotipoz.com/wp-content/uploads/2021/10/bancolombia-logo-png-transparente.png" alt="Bancolombia"></div>
    <div class="slide-content"><img src="https://mercantilcolpatria.com/wp-content/uploads/2022/09/mercantilColpatria.png" alt="Colpatria"></div>
    <div class="slide-content"><img src="https://www.operadorjuegos.com.co/images/Logo-Baloto-Big.png" alt="Baloto"></div>
    <div class="slide-content"><img src="https://www.tuya.com.co/sites/default/files/landings/paso-a-paso-exitocom/logoexito-pasoapaso-exitocom.png" alt="Exito"></div>
    <div class="slide-content"><img src="https://static.ofertia.com.co/comercios/Carulla/profile-15696.v11.png" alt="Carulla"></div>
    <div class="slide-content"><img src="https://www.america-retail.com/static//2019/03/Surtimax.png" alt="SurtiMax"></div>
    <div class="slide-content"><img src="https://www.superinter.com.co/sites/default/files/logo-super-inter-.png" alt="SuperInter"></div>
    <div class="slide-content"><img src="https://magv1-prod.s3.amazonaws.com/image_assets/files/14832/medium-logo-.png?1648817626" alt="Olimpica"></div>
    <div class="slide-content"><img src="https://www.efecty.com.co/WebApi//uploads/logo-efecty_nuevo-01-2.png" alt="Efecty"></div>
    <div class="slide-content"><img src="https://laherradura.com.co/wp-content/uploads/2020/08/gane.png" alt="Gane"></div>
    <div class="slide-content"><img src="https://www.americadecali.co/wp-content/uploads/2021/09/LOGO-SUPER-GIROS.png" alt="Super Giros"></div>
  </div>
</div>

<?php include('templates/whatsAppBottom.php'); ?>
<?php include('templates/footer.php'); ?>