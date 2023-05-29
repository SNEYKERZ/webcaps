<?php
session_start();
include('templates/cabecera.php');
require 'carro/funcionesCarrito.php';
require 'vendor/autoload.php';
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<head>
  <style>
    .container-form-complet-info {
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top: 50px;
    }

    .container-form-complet-info .main-form {
      width: 100%;
      height: auto;

    }


  </style>
</head>

<div class="container-form-complet-info" id="main">
  <div class="main-form">
    <div class="row">
      <div class="col-md-6">
        <fieldset>
          <legend>Completar Datos</legend>
          <form action="completar_pedido.php" method="post" onsubmit="gracias(event)">
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group">
              <label>Apellidos</label>
              <input type="text" class="form-control" name="apellidos" required>
            </div>
            <div class="form-group">
              <label>Correo</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
              <label>Teléfono</label>
              <input type="text" class="form-control" name="telefono" required>
            </div>
            <div class="form-group">
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