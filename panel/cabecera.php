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
  <link rel="stylesheet" href="../../assets/css/style.css">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- Fontawesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <!-- JS de jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <!-- JS de Bootstrap -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <!-- Other JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../../assets/js/scripts.js"></script>

</head>

<body>
  <div class="wrapper">
    <header style="box-shadow: 0 2px 10px 0 rgba(0,0,0,0.2);">
      <!-- Barra de promociones -->
      <div class="slider_shirt clonar-span">
        <div class="sliders">
          <span class="mx-3"> 5 CAMISETAS EN $110.000 </span>
        </div>
      </div>
      <!-- Barra de navegación -->
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
          <!-- Logo de la empresa y nombre -->
          <a class="navbar-brand text-uppercase" href="../../index.php">
            <img src="../../assets/images/logo caps circulo.png" alt="logo" width="40" height="40" class="d-inline-block align-items-center" alt="">
            Caps Culture
          </a>
          <!-- Boton que se despliega en dispositivos moviles -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!--  Contenido que estara en la barra de navegacion y la forma en que aparecera con responsive  -->
          <div class="collapse navbar-collapse justify-content-end fw-bold" id="navbarSupportedContent">
            <ul class="navbar-nav text-uppercase d-flex align-items-center">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../productos/index.php"><i class="fa-solid fa-shirt"></i> Productos </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../pedidos/index.php"><i class="fa-solid fa-people-group"></i> Pedidos</a>
              </li>
              <li class="nav-item btn btn-success">
                <a class="nav-link text-light" href="../../login.php"> ADMIN </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  </div>
</body>

</html>