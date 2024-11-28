<?php
session_start(); // Asegúrate de iniciar la sesión al principio del archivo
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Box icons -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="./css/styles.css" />
  <title>Boy’s T-Shirt</title>
</head>

<body>
  <!-- Navigation -->
  <div class="top-nav hei">
    <div>
    </div>
  </div>
  <div class="navigation">
    <div class="nav-center container d-flex">
      <a href="index.php" class="logo">
        <h1>Mr. Store</h1>
      </a>

      <ul class="nav-list d-flex">
            <li class="nav-item">
              <a href="index.php" class="nav-link">Inicio</a>
            </li>
            <li class="nav-item">
              <a href="product.php" class="nav-link">Tienda</a>
            </li>
            <?php
            if (isset($_SESSION['Cuenta'])) { ?>
              <li class="nav-item">
                <a href="pedidos.php" class="nav-link">Pedidos</a>
              </li>
            <?php }
            include "./php/conexion.php";
            $database = BD;
            $query = $pdo->prepare("SELECT * FROM {$database}.administradores where id_Usuario = :cuenta");
            $query->bindParam(":cuenta", $_SESSION['Cuenta'], PDO::PARAM_INT);
            $query->execute();
            $resultado = $query->fetch(PDO::FETCH_ASSOC);
            if ($resultado) { ?>
              <li class="nav-item">
                <a href="inventario.php" class="nav-link">Inventario</a>
              </li> <?php } ?>
            <li class="icons d-flex">
              <a href="login.php" class="icon">
                <i class="bx bx-user"></i>
              </a>
              <div class="icon">
                <i class="bx bx-search"></i>
              </div>
              <div class="icon">
                <i class="bx bx-heart"></i>
                <span class="d-flex">0</span>
              </div>
              <a href="cart.php" class="icon">
                <i class="bx bx-cart"></i>
                <span class="d-flex">0</span>
              </a>
            </li>
          </ul>

      <div class="icons d-flex">
        <a href="login.php" class="icon">
          <i class="bx bx-user"></i>
        </a>
        <div class="icon">
          <i class="bx bx-search"></i>
        </div>
        <div class="icon">
          <i class="bx bx-heart"></i>
          <span class="d-flex">0</span>
        </div>
        <a href="cart.php" class="icon">
          <i class="bx bx-cart "></i>
          <span class="d-flex">0</span>
        </a>
      </div>

      <div class="hamburger">
        <i class="bx bx-menu-alt-left"></i>
      </div>
    </div>
  </div>

  <!-- All Products -->
  <section class="section all-products" id="products">
    <div class="top container">
      <h1>Todos los productos</h1>
      <form>
        <select id="filtro">
          <option value="1">Por defecto</option>
          <option value="2">Por precio</option>
          <option value="4">Por oferta</option>
        </select>
        <span><i class="bx bx-chevron-down"></i></span>
      </form>
    </div>
    <div class="product-center container">
      <?php
      if (!empty($_REQUEST['page'])) {
        $_REQUEST['page'] = $_REQUEST['page'];
      } else {
        $_REQUEST['page'] = '1';
      }
      if ($_REQUEST['page'] == "") {
        $_REQUEST['page'] = '1';
      }

      $database = BD;
      $sentenciaTotal = $pdo->prepare("SELECT * FROM {$database}.productos;");
      $sentenciaTotal->execute();
      $totalProductos = $sentenciaTotal->fetchAll(PDO::FETCH_ASSOC);

      $registros = 8;
      $pagina = $_REQUEST["page"];
      if (is_numeric($pagina)) {
        $inicio = ($pagina - 1) * ($registros) + 1;
      } else {
        $inicio = 0;
      }
      $final = $registros + $inicio - 1;
      $sentencia = $pdo->prepare("SELECT * FROM {$database}.productos WHERE id_Producto BETWEEN :inicio and :final;");
      $sentencia->bindParam(":inicio", $inicio, PDO::PARAM_INT);
      $sentencia->bindParam(":final", $final, PDO::PARAM_INT);
      $sentencia->execute();
      $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      $numRegistros = count($totalProductos);
      ?>
      <?php foreach ($listaProductos as $producto) { ?>
        <div class="product-item">
          <div class="overlay">
            <form action="productDetails.php" method="POST">
              <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id_Producto'], COD, KEY); ?>">
              <input type="hidden" name="nombre" value="<?php echo openssl_encrypt($producto['nombre_Producto'], COD, KEY); ?>">
              <input type="hidden" name="precio" value="<?php echo openssl_encrypt($producto['precio_Producto'], COD, KEY); ?>">
              <input type="hidden" name="descripcion" value="<?php echo openssl_encrypt($producto['descripcion'], COD, KEY); ?>">
              <input type="hidden" name="imagen" value="<?php echo $producto['imagen']; ?>">
              <button type='submit' name='MostrarDetalle' value='detalle' class="product-thumb" style="border: none; background: none; padding: 0;">
                <img src="<?php echo $producto['imagen']; ?>" alt="" />
              </button>
            </form>
          </div>
          <div class="product-info">
            <span><?php echo $producto['nombre_Producto']; ?></span>
            <a href="productDetails.php"><?php echo $producto['descripcion']; ?></a>
            <h4><?php echo $producto['precio_Producto'], "$"; ?></h4>
          </div>
          <form action="mostrarCarrito.php" method="POST" id='formProducto'>
            <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id_Producto'], COD, KEY); ?>">
            <input type="hidden" name="nombre" value="<?php echo openssl_encrypt($producto['nombre_Producto'], COD, KEY); ?>">
            <input type="hidden" name="precio" value="<?php echo openssl_encrypt($producto['precio_Producto'], COD, KEY); ?>">
            <input type="hidden" name="descripcion" value="<?php echo openssl_encrypt($producto['descripcion'], COD, KEY); ?>">
            <input type="hidden" name="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
            <input type="hidden" name="imagen" value="<?php echo $producto['imagen']; ?>">
            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">
              <i class="bx bx-cart bx-tada"></i>
            </button>
          </form>
        </div>
      <?php } ?>
    </div>
  </section>
  <section class="pagination">
    <div class="container">
      <?php
      $paginas = ceil($numRegistros / $registros);
      for ($i = 1; $i <= $paginas; $i++) {
        echo "<a href='product.php?page=$i' class='pagina'>$i</a>";
      }
      echo "<a href='product.php?page=$paginas' class='pagina'><i class='bx bx-right-arrow-alt'></i></a>";
      ?>
    </div>
  </section>
  <!-- Footer -->
  <footer class="footer">
    <div class="row">
      <div class="col d-flex">
        <h4>INFORMATION</h4>
        <a href="">Acerca de nosotros</a>
        <a href="">Contactanos</a>
        <a href="">Terminos y condiciones</a>
        <a href="">Guia de envio</a>
      </div>
      <div class="col d-flex">
        <h4>Links</h4>
        <!-- <a href="">Online Store</a> -->
        <!-- <a href="">Customer Services</a> -->
        <!-- <a href="">Promotion</a> -->
        <!-- <a href="">Top Brands</a> -->
      </div>
      <div class="col d-flex">
        <span><i class="bx bxl-facebook-square"></i></span>
        <span><i class="bx bxl-instagram-alt"></i></span>
        <!-- <span><i class="bx bxl-github"></i></span> -->
        <!-- <span><i class="bx bxl-twitter"></i></span> -->
        <!-- <span><i class="bx bxl-pinterest"></i></span> -->
      </div>
    </div>
  </footer>
  <!-- Custom Script -->
  <script src="./js/index.js"></script>
</body>

</html>