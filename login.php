<?php
include('templates/cabecera.php');
require 'vendor/autoload.php';

?>
<br><br>
<div class="wrapper">

  <div class="container">

    <!-- Inicio de login -->
    <div class="row login">

      <div class="col-lg-6 bg-green d-flex justify-content-end">
        <img src="assets/images/eminen-photo.png" alt="Eminen photo" class="w-75">
        <div class="logo">
          <img src="assets/images/caps.png" alt="Caps">
          <img src="assets/images/culture.png" alt="Culture">
        </div>
      </div>

      <div class="col-lg-6 content">
        <div class="row caps-content p-0">
          <div class="col-lg-12">
            <h2>Registrate o inicia sesion</h2>

          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 p-1">
            <form class="caps-login-form" method="post" action="">
              <div class="form-group mb-2">
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Nombre de usuario" name="usuario">
              </div>
              <div class="form-group mb-2">
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Correo electrónico" name="email">
              </div>
              <div class="form-group mb-2">
                <input type="password" class="form-control" id="Password1" placeholder="Contraseña" name="contraseña">
              </div>
              <button type="submit" class="btn btn-green btn-block rounded" name="btn_ingreso" value="INICIAR">Registrarme</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<br><br>

<?php include('templates/footer.php'); ?>