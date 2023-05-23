<?php
session_start();
if (empty($_SESSION["id"])) {
  header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
?>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="../../assets/js/alerts-stock.js"></script>

  <style>
    .container-product-table {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .container-content-product-table {
      display: flex;
      flex-direction: column;
      box-shadow: 6px 5px 20px 6px #bdbdbdbf;
      width: 90%;
      background-color: #fff;
      border-radius: 4px;
    }

    .container-content-product-table h2 {
      padding-top: 20px;
      padding-bottom: 2px;
    }

    .table-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 30px;
    }

    .table-header .btn-primary {
      outline: none;
      border: none;
      color: #fff;
      background-color: #00763f;
      padding: 10px 30px;
      border-radius: 4px;
      text-transform: uppercase;
      font-size: 14px;
    }

    .table-header .btn-primary:hover {
      background-color: #006332 !important;
      transition: all .5s;
    }

    .table-header select {
      border: none;
      border-bottom: 1px solid #c9c9c9;
      width: 200px;
      padding: 10px 0;
      font-size: 14px;
    }

    .table {
      border-spacing: 0;
      margin-top: 1rem;
    }

    thead {
      background-color: #a8aaad2e;
    }

    thead th {
      padding: 10px;
      font-size: 16px;
    }

    tbody th td {
      padding: 10px;
      text-align: center;
      border-bottom: 1px solid #dfdfdf;
    }

    .icons .btn-outline-success {
      background-color: #178f53;
    }

    .icons .btn-outline-success:hover {
      background-color: #006332;
      transition: all .2s;
    }

    .icons .btn-outline-success i {
      color: #fff !important;
    }

    .icons .btn-outline-danger {
      background-color: #dc3545;
    }

    .icons .btn-outline-danger:hover {
      background-color: #e32828;
      transition: all .2s;
    }

    .icons .btn-outline-danger i {
      color: #fff !important;
    }
  </style>
</head>

<div class="container-product-table">
  <div class="container-content-product-table">
    <h2 class="d-flex justify-content-center text-uppercase">Tablas de productos</h2>
    <div class="table-header">
      <a href="form_registrar.php" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus">Registrar nuevo producto</span>
      </a>
    </div>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Referencia <i class="fa-solid fa-sort"></i></th>
          <th>Categoria <i class="fa-solid fa-sort"></i></th>
          <th>Precio <i class="fa-solid fa-sort"></i></th>
          <th>Stock <i class="fa-solid fa-sort"></i></th>
          <th>Foto</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
        <?php
        require '../../vendor/autoload.php';
        $producto = new capsweb\Productos;
        $info_producto = $producto->mostrar();

        $lista_Productos = count($info_producto);
        if ($lista_Productos > 0) {
          $c = 0;
          for ($x = 0; $x < $lista_Productos; $x++) {
            $c++;
            $item = $info_producto[$x];
        ?>
            <tr>
              <td><?php print $item['id'] ?></td>
              <td><?php print $item['referencia'] ?></td>
              <td><?php print $item['categoria'] ?></td>
              <td><?php print $item['precio'] ?></td>
              <td><?php print $item['stock'] ?></td>
              <td class="text-center">
                <?php
                $foto = '../../upload/' . $item['foto'];
                if (file_exists($foto)) {
                ?>
                  <img src="<?php print $foto; ?>" width="90" height="120">
                <?php } else { ?>
                  SIN FOTO
                <?php } ?>
              </td>
              <td class="icons d-flex justify-content-center align-items-center gap-2">

                <!-- Button trigger modal -->
                <a href="" data-bs-toggle="modal" data-bs-target="#editModal-<?php $item['id']; ?>" type="button" class="btn btn-outline-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></span></a>
                <a href="../acciones.php?id=<?php print $item['id'] ?>" class="btn btn-outline-danger btn-sm" onclick="deleteProduct(<?php $item['id'] ?>)"><i class="fa-solid fa-trash"></i></span></a>
              </td>
            </tr>
            <?php include('../../panel/productos/modalEdit.php'); ?>
          <?php
          }
        } else {
          ?>
          <tr>
            <td colspan="4">NO HAY REGISTROS</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>