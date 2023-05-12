<?php
include('templates/cabecera.php');

/** login  */
if (!empty($_POST['user']) && !empty($_POST['email']) && !empty($_POST['password'])) {
  $sql = "INSERT INTO user (email, user, password) VALUES (:email, :user, :password)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user', $_POST['user']);
  $stmt->bindParam(':email', $_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $stmt->bindParam(':password', $_POST['$password']);

  if ($stmt->execute()) {
    $message = 'Successflully';
  } else {
    $message = 'Error';
  }
}

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
            <form class="caps-login-form">
              <div class="form-group mb-2">
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Nombre de usuario">
              </div>
              <div class="form-group mb-2">
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Correo electrónico">
              </div>
              <div class="form-group mb-2">
                <input type="password" class="form-control" id="Password1" placeholder="Contraseña">
              </div>
              <button type="submit" class="btn btn-green btn-block rounded">Registrarme</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<br><br>

<?php include('templates/footer.php'); ?>