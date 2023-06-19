<?php
include('templates/cabecera.php');
?>

<!-- CARUSEL -->
<section>
  <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="6000" style="padding-bottom: 15px; height: 90%;">
    <ol class="carousel-indicators gap-3 py-3">
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

<?php
require 'vendor/autoload.php';
$noticia = new capsweb\noticias;
$notice = $noticia->mostrar();
$i = count($notice);

if ($i > 0) {
  for ($x = 0; $x < $i; $x++) {
    $colum = $notice[$x];
?>
    <!-- PROMOTION BAR -->
    <div class="slider-shirt">
      <div class="sliders block-1 text-uppercase">
        <?php
        if (isset($colum['campos_adicionales'])) {
          $camposAdicionales = explode(',', $colum['campos_adicionales']);
          foreach ($camposAdicionales as $campo) {
            echo '<span class="mx-3">' . $campo . '</span>';
          }
        }
        ?>
      </div>

      <div class="sliders block-2">
        <?php
        if (isset($colum['campos_adicionales'])) {
          $camposAdicionales = explode(',', $colum['campos_adicionales']);
          foreach ($camposAdicionales as $campo) {
            echo '<span class="mx-3">' . $campo . '</span>';
          }
        }
        ?>
      </div>
    </div>
<?php
  }
}
?>

<style>
  .header-products {
    text-align: center;
    justify-content: center;
    letter-spacing: 5px;
    font-family: 'Roboto';
    padding-top: 50px;
  }

  .header-products h3 {
    font-size: 24px;
  }

  .header-products .nav-link {
    color: #86888b;
  }
</style>
<!-- MAIN SECTION -->
<main class="pb-4">
  <div class="header-products">
    <h3 class="text-center">NUESTROS PRODUCTOS</h3>
    <ul class="nav nav-tabs mt-3 d-flex justify-content-center" id="myTab" role="tablist">

      <li class="nav-item">
        <a class="nav-link active" id="tab-general" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="tab-camisetas-basicas" data-toggle="tab" href="#camisetas-basicas" role="tab" aria-controls="camisetas-basicas" aria-selected="false">Camisetas Básicas</a>
      </li>
    </ul>
  </div>

  <div class="tab-content mt-3" id="myTabContent">
    <!-- Pestaña "General" -->
    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="tab-general">
      <div class="products-container justify-content-center my-50">
        <div class="row d-flex justify-content-center aling-items-center">
          <?php
          require 'vendor/autoload.php';
          $productos = new capsweb\Productos;
          $info_productos = $productos->mostrarProductos();
          $cantidad = count($info_productos);

          if ($cantidad > 0) {
            for ($x = 0; $x < $cantidad; $x++) {
              $item = $info_productos[$x];
          ?>
              <!-- Tarjeta de producto -->
              <div class="d-flex justify-content-center col-xl-3 col-lg-3 col-md-4 col-sm-5 col-xs-4">
                <div class="card">
                  <?php
                  $foto = 'upload/' . $item['foto'];
                  if (file_exists($foto)) {
                  ?>
                    <i class="fa-solid fa-heart"></i>
                    <!-- Fotografia de la imagen -->
                    <a href="infoPrenda.php?id=<?php print $item['id']  ?>">
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
                    <a href="carro/index.php?id=<?php print $item['id'] ?>" class="bottom-shop d-flex">
                      <span class="card-text card-price">$ <?php print number_format($item['precio'], 2, ",", ".") ?>
                        <b> COP</b> <i class="fa-solid fa-cart-shopping"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            <?php }
          } else { ?>
            <div class="d-flex flex-column justify-content-center align-items-center">
              <h4 class="text-center"> ACTUALMENTE NO HAY PRODUCTOS DISPONIBLES </h4>
              <h6>Estate pendiente de nuestras proximas colecciones!</h6>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <!-- Pestaña "Camisetas Básicas" -->
    <div class="tab-pane fade" id="camisetas-basicas" role="tabpanel" aria-labelledby="tab-camisetas-basicas">
      <div class="products-container justify-content-center mt-50 mb-50">
        <div class="row gap-10">
          <!-- Codigo que muestras las camisetas basicas -->
          <?php
          require 'vendor/autoload.php';
          $productos = new capsweb\Productos;
          $info_producto = $productos->mostrarPrendasBasicas();
          $cantidad = count($info_producto);

          if ($cantidad > 0) {
            for ($x = 0; $x < $cantidad; $x++) {
              $item = $info_producto[$x];
          ?>
              <!-- Tarjeta de producto -->
              <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                  <?php
                  $foto = 'upload/' . $item['foto'];
                  if (file_exists($foto)) {
                  ?>
                    <!-- Fotografia de la imagen -->
                    <a href="infoPrenda.php?id=<?php print $item['id']  ?>">
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
                    <a href="carro/index.php?id=<?php print $item['id'] ?>" class="bottom-shop d-flex">
                      <span class="card-text card-price">$ <?php print number_format($item['precio'], 2, ",", ".") ?>
                        <b> COP</b> <i class="fa-solid fa-cart-shopping"></i>
                      </span>
                    </a>
                  </div>
                </div>
              </div>
            <?php }
          } else { ?>
            <div class="d-flex flex-column justify-content-center align-items-center">
              <h4 class="text-center"> ACTUALMENTE NO HAY PRODUCTOS DISPONIBLES </h4>
              <h6>Estate pendiente de nuestras proximas colecciones!</h6>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- PAYMENT METHODS -->
<!-- <h2 class="text-center text-uppercase" style="background-color: #fafafa; margin: 0; letter-spacing: 5px;">Metodos de Pago</h2>
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
    </div> -->

<?php include('templates/whatsAppBottom.php'); ?>
<?php include('templates/footer.php'); ?>