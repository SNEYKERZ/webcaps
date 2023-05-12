<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CAPS Culture</title>

  <!-- Fuentes -->
  <link href="https://fonts.cdnfonts.com/css/roboto" rel="stylesheet">
  <!-- Estilos -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- Fontawesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- Other JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="assets/js/scripts.js"></script>
</head>

<body>
  <header>
    <nav class="wrapper">
      <!-- Barra de promociones -->
      <!-- <div class="slider_shirt clonar-span">
        <div class="sliders">
          <span class="mx-3"> 5 CAMISETAS EN $110.000 </span>
        </div>
      </div> -->
      <!--Barra de navegación--> <!-- Padding con logo cetrado padding: 0 30px 0 600px; -->
      <nav class="navbar navbar-expand-md navbar-light" style="box-shadow: 0 2px 10px 0 rgba(0,0,0,0.2); padding: 3px 30px 0 30px;">
        <nav class="navbar">
          <a class="navbar-brand fw-bold mb-2" href="index.php">
            <img src="assets/images/logo caps circulo.png" alt="logo" width="45" height="45" class="d-inline-block align-items-center"> CAPS CULTURE
          </a>
        </nav>
        <!-- Boton que se despliega en dispositivos moviles -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!--  Contenido que estara en la barra de navegacion y la forma en que aparecera con responsive  -->
        <div class="collapse navbar-collapse justify-content-end fw-bold" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto text-uppercase d-flex align-items-center">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="outfits.php"><i class="fa-solid fa-shirt"></i> Outfits </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="conocenos.php"><i class="fa-solid fa-people-group"></i> Conocenos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="carrito.php"><i class="fa-solid fa-cart-shopping"></i> Carrito</a>
            </li>
            <li class="nav-item btn" style="background-color: rgb(18, 56, 100);">
              <b><a class="nav-link " href="administrador.php" style="color: #fff;"> Perfil </a><b>
            </li>
          </ul>
        </div>
      </nav>
    </nav>
  </header>
</body>

</html>