<?php
include('templates/cabecera.php');
?>
<!-- Contenedor de la galleria de imagenes
<div class="gallery-image">
    Contenedores de las imagenes 
    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>

    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>

    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>

    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>


    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>

    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>
    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>
    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>
    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>
    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>
    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>
    <div class="image-box">
        <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
            <img src="assets/images/sinfoto.jpg" alt="">
        </a>
    </div>
</div> -->


<style>
  .gallery-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    grid-gap: 5px;
  }

  .gallery-item {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.5s ease;
    max-width: 400px;
    padding: 1rem;
  }

  .gallery-item img {
    width: 100%;
    height: auto;
    object-fit: cover;
  }

  .gallery-item:hover {
    transform: translateY(-5px);
    transition: transform 0.3s ease;
  }

  @media (max-width: 768px) {
    .gallery-container {
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }
  }
</style>

<div class="gallery-container">
  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <img src="assets/images/sinfoto.jpg" alt="Imagen 2">
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>

  <div class="gallery-item">
    <a href="https://www.instagram.com/reel/CpoEMcCJPKa/" target="_blank">
      <img src="assets/images/sinfoto.jpg" alt="">
    </a>
  </div>
</div>



<?php
include('templates/whatsAppBottom.php');
?>
<?php
include('templates/footer.php');
?>