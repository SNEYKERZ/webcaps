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
      background-image: url("https://img.freepik.com/vector-premium/trendy-dark-futuristic-mecha-gundam-cyberpunk-metaverse-colorful-abstract-urban-street-art-graffiti-estilo-vector-ilustracion-plantilla-fondo_214056-1176.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
      display: grid;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .container-form-complet-info .main-form {
      width: 85rem;
      height: auto;
      align-items: center;
      display: flex;
      justify-content: center;
      padding-top: 30px;
      padding-bottom: 30px
    }

    .container-form-complet-info .row {
      width: 55rem;
      height: 30rem;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: rgba(255, 255, 255, .15);
      backdrop-filter: blur(10px);
      padding-bottom: 10px;
      box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);
      border-radius: 5px;
    }

    .container-form-complet-info .form-group label {
      color: #fff;
    }

    .container-form-complet-info .btn {
      width: 100%;
    }
  </style>
</head>

<div class="container-form-complet-info" id="main">
  <div class="main-form">
    <div class="row">
      <h2 class="text-center text-uppercase" style="color: #fff;">Completar Datos</h2>
      <div class="col-md-6">
        <fieldset>
          <form action="completar_pedido.php" method="post" onsubmit="gracias(event)">
            <div class="form-group pb-1">
              <label>Nombre</label>
              <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group pb-1">
              <label>Apellidos</label>
              <input type="text" class="form-control" name="apellidos" required>
            </div>
            <div class="form-group pb-1">
              <label>Correo</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group pb-1">
              <label>Teléfono</label>
              <input type="text" class="form-control" name="telefono" required>
            </div>
            <div class="form-group pb-1">
              <label>Direccion</label>
              <textarea name="direccion" placeholder="INGRESE SU DIRECCION LO MAS CLARA POSIBLE" class="form-control" rows="1"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block" >Enviar</button>
            <input type="hidden" name="confirmacion" id="confirmacion" value="RESTAR">
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
<script src="js/push.min.js"></script>

<?php
include('templates/whatsAppBottom.php');
?>