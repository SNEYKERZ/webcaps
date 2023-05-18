<?php
include('templates/cabecera.php');
require 'vendor/autoload.php';
?>

<head>
  <link rel="stylesheet" href="assets/css/login.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- Fontawesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Other JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="assets/js/change_img_infoprenda.js"></script>
</head>

<!--FORMULARIO INICIO DE SESIÓSN-->
<section class="w-100 p-4 d-flex pb-4">
  <div class="container-login">
    <!-- Buttons Navigation -->
    <ul class="nav nav-pills nav-justified mb-5">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">
          Login
        </a>
      </li>

      <li class="nav-item" role="presentation">
        <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">
          Register
        </a>
      </li>
    </ul>

    <!-- Container Login-Register -->
    <div class="tab-content">
      <!-- Pestaña Login -->
      <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <form method="post" action="panel/acciones.php">

          <!-- Username -->
          <div class="form-outline mb-4">
            <input type="text" id="loginName" class="form-control" name="usuario" required>
            <label class="form-label" for="loginName">Nombre de usuario</label>
          </div>

          <!-- Password -->
          <div class="form-outline mb-4">
            <input type="password" id="loginPassword" class="form-control" name="contraseña" required>
            <label class="form-label" for="loginPassword">Contraseña</label>
          </div>

          <div class="row mb-4">
            <div class="col-md-6 d-flex justify-content-center">
              <!-- Checkbox Remember me-->
              <div class="form-check mb-4 mb-md-0">
                <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                <label class="form-check-label" for="loginCheck"> Recordarme </label>
              </div>
            </div>

            <div class="col-md-6 d-flex justify-content-center">
              <!-- Forgot password -->
              <a href="#!">Olvidaste tu contraseña?</a>
            </div>
          </div>

          <!-- Submit Button -->
          <!--<button type="submi" class="btn btn-primary btn-block mb-4" >Sign in</button>-->
          <input class="btn btn-primary btn-block mb-4" type="submit" name="accion" value="Iniciar">

          <p class="text-center mb-3">O</p>

          <div class="text-center mb-3">
            <p>Inicia sesión con:</p>
            <button type="button" class="btn btn-secudary btn-floating mx-1">
              <i class="fa-brands fa-google fa-xl"></i>
            </button>
            <button type="button" class="btn btn-secudary btn-floating mx-1">
              <i class="fa-brands fa-facebook fa-xl"></i>
            </button>
          </div>
        </form>
      </div>

      <!-- Pestaña Register -->
      <div class="tab-pane fade show" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
        <form>
          <!-- Name Input -->
          <div class="form-outline mb-3">
            <input type="text" id="registerName" class="form-control">
            <label for="registerName" class="form-label">Nombre</label>
          </div>

          <!-- Username Input -->
          <div class="form-outline mb-3">
            <input type="text" id="registerUsername" class="form-control">
            <label for="registerUsername" class="form-label">Nombre de usuario</label>
          </div>

          <!-- Password Input -->
          <div class="form-outline mb-3">
            <input type="password" id="registerPassword" class="form-control">
            <label for="registerPassword" class="form-label">Contraseña</label>
          </div>

          <!-- Repeat Password Input -->
          <div class="form-outline mb-3">
            <input type="password" id="registerRepeatPassword" class="form-control">
            <label for="registerRepeatPassword" class="form-label">Repetir contraseña</label>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary btn-block mb-2">Registrar</button>

          <p class="text-center">O</p>

          <div class="text-center mb-3">
            <p>Inicia sesión con:</p>
            <button type="button" class="btn btn-secudary btn-floating mx-1">
              <i class="fab fa-google fa-xl"></i>
            </button>
            <button type="button" class="btn btn-secudary btn-floating mx-1">
              <i class="fab fa-facebook fa-xl"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script src="assets/js/cambiador_Pestañas.js"></script>