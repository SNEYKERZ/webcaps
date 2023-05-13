<?php
session_start();
include('templates/cabecera.php');
require 'funcionesCarrito.php';
?>
<br>

<div class="container" id="main">
  <div class="main-form">
    <div class="row">
      <div class="col-md-12">
        <fieldset>
          <legend>Completar Datos</legend>
          <form action="completar_pedido.php" method="post">
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
              <label>Comentario</label>
              <textarea name="comentario" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </form>
        </fieldset>
      </div>
    </div>
  </div>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.min.js"></script>

<br><br>
<?php
include('templates/whatsAppBottom.php');
?>

<?php
include('templates/footer.php');
?>