  <?php
include('templates/cabecera.php');
require 'vendor/autoload.php';
//tokens session_start();
 
// CONFIGURACIÓN EN TIEMPO DE EJECUCIÓN //

  // Especifica si el módulo sólo usará cookies para almacenar el id de sesión en la parte del cliente. 
  //Habilitar este ajuste previene ataques que implican pasar el id de sesión en la URL
  ini_set('session.use_only_cookies', 1);
  
  // Especifica si el módulo usará cookies para almacenar el id de sesión en la parte del cliente
  ini_set('session.use_cookies', 1);
  //Marca la cookie como accesible sólo a través del protocolo HTTP.
  //Esto siginifica que la cookie no será accesible por lenguajes de script, 
  //tales como JavaScript. Este ajuste puede ayudar de manera efectiva a reducir robos de indentidad a través de ataques 
  //(aunque no está soportado por todos los navegadores)
  ini_set('session.cookie_httponly', 1);
  //Si está habilitado sid transparente 
  //La administración de sesiones basadas en URL tiene riesgos de seguridad adicionales comparada con 
  //la administración de sesiones basdas en cookies. Los usuarios pueden enviar una URL que contenga un
  //ID de sesión activo a sus amigos mediante email o los usuarios pueden guardar una URL que contenga 
  //una ID de sesión en sus marcadores y acceder a su sitio siempre con el mismo ID de sesión, por ejemplo.
  // Desde PHP 7.1.0, una ruta de URL completa, p.ej. https://php.net/, es manejada por la característa trans sid. Versiones anteriores de PHP manejaban únicamente rutas de URL relativas
  ini_set('session.use_trans_sid', 0);
  // Permite especificar el número de bits en caracteres de ID de sesión codificados.
  // Los valores posibles son '4' (0-9, a-f), '5' (0-9, a-v), y '6' (0-9, a-z, A-Z, "-", ",").
  // El predeterminado es 4. Cuantos más bits, más fuerte es el ID de sesión. Se recomienda 5 para la mayoría de entornos
  ini_set('session.sid_bits_per_character', 5);
  // Especifica si las cookies deberían enviarse sólo sobre conexiones seguras - en localhost no funciona si no tienes SSL
  // ini_set('session.cookie_secure', 1);
  // ENCABEZADOS SIN FORMATO HTTP //
  // Los navegadores que soportan esta cabecera (IE y Chrome), no cargan las hojas de estilos, ni los scripts (Javascript), cuyo Myme-type no sea el adecuado
  header('X-Content-Type-Options: nosniff');
  // La cabecera X-Frame-Options sirve para prevenir que la página pueda ser abierta en un frame, o iframe. De esta forma se pueden prevenir ataques de clickjacking sobre tu web
  header('X-Frame-Options: SAMEORIGIN');
  // La cabecera X-XSS-Protection Se trata de una capa de seguridad adicional que bloquea ataques XSS
  header('X-XSS-Protection: 1;mode=block');
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
<?php
session_start();
if (!empty($_SESSION["id"])) {
    header("location: panel/productos/");
}
?>
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
         <p>EXCLUSIVO DEL ADMINISTRADOR</p>
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
          <input class="btn btn-primary btn-block mb-4" type="submit" name="accion" value="Conectar">

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
