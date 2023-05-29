<?php
session_start();
include('templates/cabecera.php');
require 'carro/funcionesCarrito.php';
require 'vendor/autoload.php';
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<head>
  <style>
    body {
      background-color: black;
    }

    .container-form-complet-info {
      /* width: 100%;
      display: flex;      
      justify-content: center;
      align-items: center;
      padding-top: 50px; */
      height: 88.5vh;
      text-align: center;
      font-family: 'Poppins', sans-serif;
      background-image: linear-gradient(to left, #4b4b4b, #0a0a0a);
      background-color: #171a22;
      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
      justify-content: start;
    }

    .container-form-complet-info .main-form {
      /* width: 100vh;
      height: auto;
      background-color: #232734;
      padding: 5px;
      border-radius: 4px; */
      width: 35rem;
      height: 100%;
      border-radius: 4px;
      padding: 30px 20px 50px 20px;
      background-color: #232734;
      box-shadow: 25px 5px 20px 3px rgba(0, 0, 0, .2);
    }

    .container-form-complet-info .row {
      align-items: center;
      display: flex;
      justify-content: center;
    }

    .container-form-complet-info .form-group label {
      color: #fff;
    }
  </style>
</head>

<div class="container-form-complet-info" id="main">
  <div class="main-form">
    <div class="row">
      <h2 class="text-center py-5 text-white">Completar Datos</h2>
      <div class="col-md-6">
        <fieldset>
          <form action="completar_pedido.php" method="post" onsubmit="gracias(event)">
            <div class="form-group pb-3">
              <label>Nombre</label>
              <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group pb-3">
              <label>Apellidos</label>
              <input type="text" class="form-control" name="apellidos" required>
            </div>
            <div class="form-group pb-3">
              <label>Correo</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group pb-3">
              <label>Teléfono</label>
              <input type="text" class="form-control" name="telefono" required>
            </div>
            <div class="form-group pb-3">
              <label>Direccion</label>
              <textarea name="direccion" placeholder="INGRESE SU DIRECCION LO MAS CLARA POSIBLE" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
            <input type="hidden" name="confirmacion" id="confirmacion" value="">
            <script>
              function gracias(event) {
                event.preventDefault();

                swal({
                  title: "¿Desea confirmar su compra?",
                  text: "",
                  icon: "success",
                  buttons: true,
                  dangerMode: true,
                }).then((will) => {
                  if (will) {
                    swal("Gracias por su compra", {
                      icon: "success",
                    });
                    setTimeout(() => {
                      document.getElementById("confirmacion").value = "confirmado";
                      event.target.submit();
                    }, 1500);
                  } else {
                    swal("La compra no fue realizada");
                    setTimeout(() => {
                      location.href = 'index.php';
                    }, 1500);
                  }
                });
              }
            </script>
          </form>
        </fieldset>
      </div>
    </div>
  </div>
</div>

<!-- /container -->
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>

<?php
include('templates/whatsAppBottom.php');
?>