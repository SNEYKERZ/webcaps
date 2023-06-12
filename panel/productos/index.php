<?php
session_start();
if (empty($_SESSION["id"])) {
  header("location: ../../acceso.php");
}
include('../../templates/cabeceraAdmin.php');
?>

<?php
require '../../vendor/autoload.php';
$producto = new capsweb\Productos;
$info_producto = $producto->mostrar();

$referencia = isset($_GET['referencia']) ? $_GET['referencia'] : '';
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$precio = isset($_GET['precio']) ? $_GET['precio'] : '';
$stock = isset($_GET['stock']) ? $_GET['stock'] : '';

// Filtrar los resultados basados en los parámetros de búsqueda
$resultadosFiltrados = [];
foreach ($info_producto as $item) {
  // Aplicar el filtro para cada campo de búsqueda
  if (empty($referencia) || strpos($item['referencia'], $referencia) !== false) {
    if (empty($categoria) || $item['categoria'] == $categoria) {
      if (empty($precio) || $item['precio'] == $precio) {
        if (empty($stock) || $item['stock'] == $stock) {
          $resultadosFiltrados[] = $item;
        }
      }
    }
  }
}

// Configuración del paginado
$elementosPorPagina = 5; // Elementos mostrados por página
$totalElementos = count($resultadosFiltrados); // Total de elementos filtrados
$totalPaginas = ceil($totalElementos / $elementosPorPagina); // Total de páginas

// Página actual
$paginaActual = isset($_GET['page']) ? intval($_GET['page']) : 1;
$inicio = ($paginaActual - 1) * $elementosPorPagina;
$fin = $inicio + $elementosPorPagina;

$listaProductosPaginada = array_slice($resultadosFiltrados, $inicio, $elementosPorPagina);

$lista_Productos = count($listaProductosPaginada);

?>

<head>
  <!-- STYLES -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/css/tabla-productos.css">

  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../../assets/js/alerts-stock.js"></script>
</head>


<style>
  .container-content-product-table form {
    display: flex !important;
    justify-content: end !important;
    padding-right: 10px;
  }

  .form-control {
    width: 40%;
  }
</style>

<div class="container-product-table py-3">
  <div class="container-content-product-table">
    <h2 class="d-flex justify-content-center text-uppercase">Tablas de productos</h2>
    <div class="table-header">
      <!-- <a href="form_registrar.php" class="btn btn-primary"> -->
      <!-- BUTTON CREATE PRODUCT  -->
      <a href="" data-bs-toggle="modal" data-bs-target="#registerModal" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus">Nuevo producto <i class="fa-solid fa-plus"></i></span>
      </a>

      <!-- BUTTON REGISTER CATEGORIA -->
      <a href="" data-bs-toggle="modal" data-bs-target="#registerCategoriaModal" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus">Añadir una categoria <i class="fa-solid fa-plus"></i></span>
      </a>

      <!-- BUTTON CHANGE NEWS -->
      <a href="" data-bs-toggle="modal" data-bs-target="#cambiarNewsModal" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus">Cambiar noticia <i class="fa-solid fa-plus"></i></span>
      </a>
    </div> 

    <!-- FILTER -->
    <form class="d-flex justify-content-center my-3">
      <input class="form-control me-2" type="search" placeholder="Buscar" name="referencia" value="<?php echo $referencia; ?>" aria-label="Buscar">
      <input class="form-control me-2" type="search" placeholder="Categoría" name="categoria" value="<?php echo $categoria; ?>" aria-label="Categoría">
      <input class="form-control me-2" type="search" placeholder="Precio" name="precio" value="<?php echo $precio; ?>" aria-label="Precio">
      <input class="form-control me-2" type="search" placeholder="Stock" name="stock" value="<?php echo $stock; ?>" aria-label="Stock">
      <button class="btn btn-outline-primary" type="submit">Filtrar</button>
    </form>

    <!-- TABLE -->
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Referencia</th>
          <th>Categoria</th>
          <th>Precio</th>
          <th>Stock</th>
          <th>Foto</th>
          <th>Acciones</th>
        </tr>
      </thead>

      <tbody>
        <?php
        if ($totalElementos > 0) {
          $c = $inicio + 1;
          foreach ($listaProductosPaginada as $item) {
        ?>
            <tr>
              <td>
                <?php echo $item['id'] ?>
              </td>

              <td>
                <?php echo $item['referencia'] ?>
              </td>

              <td>
                <?php echo $item['categoria'] ?>
              </td>

              <td>
                <?php echo $item['precio'] ?>
              </td>

              <td>
                <?php echo $item['stock'] ?>
              </td>

              <td class="text-center">
                <?php
                $foto = '../../upload/' . $item['foto'];
                if (file_exists($foto)) {
                ?>
                  <img src="<?php echo $foto; ?>" width="90" height="120">
                <?php } else { ?>
                  SIN FOTO
                <?php } ?>
              </td>

              <td class="icons d-flex justify-content-center align-items-center gap-2">
                <!-- BUTTON TRIGGER MODAL -->
                <a href="" data-bs-toggle="modal" data-bs-target="#editModal-<?php echo $item['id']; ?>" type="button" class="btn btn-outline-success btn-sm"><i class="fa-regular fa-pen-to-square"></i></span></a>
                <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal-<?php echo $item['id']; ?>" type="button" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></span></a>
              </td>
            </tr>
          <?php
            $c++;
          }
        } else {
          ?>
          <tr>
            <td colspan="7">NO HAY REGISTROS</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <!-- PAGINATION -->
    <nav aria-label="Paginación">
      <ul class="pagination justify-content-center">
        <?php if ($paginaActual > 1) { ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?php echo $paginaActual - 1; ?>&referencia=<?php echo $referencia; ?>&categoria=<?php echo $categoria; ?>&precio=<?php echo $precio; ?>&stock=<?php echo $stock; ?>">Anterior</a>
          </li>
        <?php } ?>
        <?php for ($i = 1; $i <= $totalPaginas; $i++) { ?>
          <li class="page-item <?php echo ($i == $paginaActual) ? 'active' : ''; ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>&referencia=<?php echo $referencia; ?>&categoria=<?php echo $categoria; ?>&precio=<?php echo $precio; ?>&stock=<?php echo $stock; ?>"><?php echo $i; ?></a>
          </li>
        <?php } ?>
        <?php if ($paginaActual < $totalPaginas) { ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?php echo $paginaActual + 1; ?>&referencia=<?php echo $referencia; ?>&categoria=<?php echo $categoria; ?>&precio=<?php echo $precio; ?>&stock=<?php echo $stock; ?>">Siguiente</a>
          </li>
        <?php } ?>
      </ul>
    </nav>
  </div>
</div>

<!-- MODAL EDITION (Ventana Emergente) -->
<?php
for ($i = 0; $i < $lista_Productos; $i++) {
  $info = $info_producto[$i];
?>
  <div class="modal fade" id="editModal-<?php echo $info['id']; ?>" tabindex="-1" aria-labelledby="editModal-<?php echo $info['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- HEADER MODAL -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- BODY MODAL -->
        <div class="modal-body">
          <div class="container-edit-products d-flex justify-content-center align-items-center">
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="../acciones.php" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php print $info['id'] ?>">

                  <!-- SECTIONS MODAL -->
                  <div class="row pt-2">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Referencia</label>
                        <input value="<?php print $info['referencia'] ?>" type="text" class="form-control" name="referencia" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Cantidad</label>
                        <input value="<?php print $info['stock'] ?>" class="form-control" name="stock" placeholder="0" required>
                      </div>
                    </div>
                  </div>

                  <div class="row pt-2">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Precio</label>
                        <input value="<?php print $info['precio'] ?>" class="form-control" name="precio" placeholder="$0" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Categorías</label>
                        <select class="form-control" name="categoria_id" required>
                          <option value="">SELECCIONE</option>
                          <?php
                          require '../../vendor/autoload.php';
                          $categoria = new capsweb\Categorias;
                          $info_categoria = $categoria->mostrar();
                          $cantidad = count($info_categoria);
                          for ($x = 0; $x < $cantidad; $x++) {
                            $item = $info_categoria[$x];
                          ?>
                            <option value="<?php print $item['id'] ?>" <?php print $info['categoria'] == $item['id'] ? 'selected' : '' ?>>
                              <?php print $item['categoria'] ?>
                            </option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row pt-2">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Foto</label>
                        <!-- Necesario hacer el llamado al item para que se efectue el cambio-->
                        <input type="file" class="form-control" name="foto">
                        <input type="hidden" name="foto_temp" value="<?php print $info['foto'] ?>">
                      </div>
                    </div>
                  </div>
                  <!-- FOOTER MODAL -->
                  <div class="modal-footer">
                    <input type="submit" name="accion" class="btn btn-primary" value="Actualizar">
                    <a href="index.php" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<!-- MODAL DELETE (Ventana Emergente) -->
<?php
for ($i = 0; $i < $lista_Productos; $i++) {
  $item = $info_producto[$i];
?>
  <div class="modal fade" id="deleteModal-<?php echo $item['id']; ?>" tabindex="-1" aria-labelledby="deleteModal-<?php echo $item['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- HEADER MODAL -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- BODY MODAL -->
        <div class="modal-body">
          <p>¿Estás seguro de que deseas eliminar este producto?</p>
        </div>
        <!-- FOOTER MODAL -->
        <div class="modal-footer">
          <form action="../acciones.php" method="GET">
            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
            <input type="submit" name="accion" class="btn btn-danger" value="Eliminar">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<!-- MODAL REGISTER (Ventana Emergente) -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- MODAL HEADER -->
      <div class="modal-header">
        <h5 class="modal-title" id="registerModalLabel">Registrar nuevo producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- MODAL BODY -->
      <div class="modal-body">
        <div class="container-register-products d-flex justify-content-center align-items-center">
          <div class="row ">
            <div class="col-md-12 ">
              <form method="POST" action="../acciones.php" enctype="multipart/form-data">

                <!-- SECTION MODAL -->
                <div class="row pt-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Referencia</label>
                      <input type="text" class="form-control" name="referencia" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Cantidad</label>
                      <input type="text" class="form-control" name="stock" placeholder="0" required>
                    </div>
                  </div>
                </div>

                <div class="row pt-2">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Precio</label>

                      <input stringvalue="" class="form-control" name="precio" placeholder="$000" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Categorias</label>
                      <select class="form-control" name="categoria_id" required>
                        <option value="">SELECCIONE</option>
                        <?php
                        require '../../vendor/autoload.php';
                        $categoria = new capsweb\Categorias;
                        $info_categoria = $categoria->mostrar();
                        $cantidad = count($info_categoria);
                        for ($x = 0; $x < $cantidad; $x++) {
                          $item = $info_categoria[$x];
                        ?>
                          <option value="<?php print $item['id'] ?>"><?php print $item['categoria'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <!--CHECKBOX DE TALLAS-->
                <div class="row">
                  <div class="col-md-6 pt-3">
                    <div class="form-group"> 
                      <label>Tallas disponibles</label>
                      <div class="btn-group pt-1" role="group" aria-label="Basic checkbox toggle button group">
                        
                        <input type="checkbox" class="btn-check" name="tallas[]" value="S" id="talla_s" ">
                        <label class=" btn btn-outline-dark" for="talla_s">S</label>

                        <input type="checkbox" class="btn-check" name="tallas[]" value="M" id="talla_m" ">
                        <label class=" btn btn-outline-dark" for="talla_m">M</label>

                        <input type="checkbox" class="btn-check" name="tallas[]" value="L" id="talla_l" ">
                        <label class=" btn btn-outline-dark" for="talla_l">L</label>

                        <input type="checkbox" class="btn-check" name="tallas[]" value="XL" id="talla_xl" ">
                        <label class=" btn btn-outline-dark" for="talla_xl">XL</label>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- END CHECKBOX DE TALLAS-->

                <div class="row pt-2">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Foto</label>
                      <input type="file" class="form-control" name="foto" required>
                    </div>
                  </div>
                </div>

                <!-- MODAL FOOTER -->
                <div class="modal-footer">
                  <input type="submit" name="accion" class="btn btn-primary" value="Registrar">
                  <a href="index.php" class="btn btn-danger">Cancelar</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL CHANGE NEWS -->
<div class="modal fade" id="cambiarNewsModal" tabindex="-1" aria-labelledby="cambiarNewsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- MODAL HEADER -->
      <div class="modal-header">
        <h5 class="modal-title" id="cambiarNewsModalLabel">Cambiar la Noticia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- BODY MODAL -->
      <div class="modal-body">
        <div class="container-register-products d-flex justify-content-center align-items-center">
          <div class="row">
            <div class="col-md-12">
              <form method="POST" action="../acciones.php" enctype="multipart/form-data">

                <!-- SECTION MODAL -->
                <div class="row pt-2">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="lema">Nueva Noticia</label>
                      <input type="text" class="form-control" id="lema" name="lema" required>
                    </div>
                  </div>
                </div>

                <!-- FOOTER MODAL -->
                <div class="modal-footer">
                  <input type="submit" name="accion" class="btn btn-primary" value="Cambiar">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL REGISTER CATEGORIA (Ventana Emergente) -->
<div class="modal fade" id="registerCategoriaModal" tabindex="-1" aria-labelledby="registerCategoriaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- MODAL HEADER -->
      <div class="modal-header">
        <h5 class="modal-title" id="registerCategoriaModalLabel">Añadir Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- MODAL BODY -->
      <div class="modal-body">
        <div class="container-register-products d-flex justify-content-center align-items-center">
          <div class="row">
            <div class="col-md-12 ">
              <form method="POST" action="../acciones.php" enctype="multipart/form-data">

                <!-- SECTION MODAL -->
                <div class="row pt-2">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Categoria</label>
                      <input type="text" class="form-control" name="categoria" required>
                    </div>
                  </div>
                  <!-- MODAL FOOTER -->
                  <div class="modal-footer">
                    <input type="submit" name="accion" class="btn btn-primary" value="Añadir">
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>