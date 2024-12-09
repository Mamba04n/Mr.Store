<?php
session_start();
include "./php/conexion.php";

// Verificar si el usuario ya tiene un carrito existente
if (!isset($_SESSION['id_Carrito'])) {
    try {
        $usuarioId = 18; // Reemplaza con el ID del usuario actual
        $consultaCarritoExistente = $pdo->prepare("SELECT id_Carrito FROM carritos_compras WHERE id_Cliente = :id_Cliente");
        $consultaCarritoExistente->bindParam(':id_Cliente', $usuarioId);
        $consultaCarritoExistente->execute();
        $carritoExistente = $consultaCarritoExistente->fetch(PDO::FETCH_ASSOC);

        if ($carritoExistente) {
            // Usar el carrito existente
            $_SESSION['id_Carrito'] = $carritoExistente['id_Carrito'];
        } else {
            // Crear un nuevo carrito
            $consultaCarrito = $pdo->prepare("INSERT INTO carritos_compras (id_Cliente) VALUES (:id_Cliente)");
            $consultaCarrito->bindParam(':id_Cliente', $usuarioId);
            $consultaCarrito->execute();
            $_SESSION['id_Carrito'] = $pdo->lastInsertId();
        }
    } catch (PDOException $e) {
        die("Error al crear o verificar el carrito: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Boxicons -->
  <link
    href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
    rel="stylesheet" />
  <!-- Glide js -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.theme.css">
  <!-- Custom StyleSheet -->
  <link rel="stylesheet" href="./css/styles.css" />
  <title>Mr. Store</title>
</head>

<body>
  <!-- Header -->
  <header class="header" id="header">
    <!-- Top Nav -->
    <div class="top-nav hei">
      <div>
      </div>
    </div>
    <div class="navigation">
      <div class="nav-center container d-flex">
        <a href="" class="logo">
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
          if (isset($_SESSION['admin']) ? $_SESSION['admin'] : false) { ?>
            <li class="nav-item">
              <a href="inventario.php" class="nav-link">Inventario</a>
            </li> <?php } ?>

          <!-- <li class="icons d-flex">
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
            </li> -->
        </ul>

        <div class="icons d-flex">
          <a href="perfil.php" class="icon">
            <i class="bx bx-user"></i>
          </a>
          <div class="icon">
            <i class="bx bx-search"></i>
          </div>
          <div class="icon">
            <i class="bx bx-heart"></i>
            <span class="d-flex"><?php echo isset($_SESSION['Favs']) ? $_SESSION['Favs'] : 0; ?></span>
          </div>
          <?php if (isset($_SESSION['admin']) && !$_SESSION['admin']) { ?>
            <a href="cart.php" class="icon">
              <i class="bx bx-cart"></i>
              <span class="d-flex"><?php echo isset($_SESSION['ElemCarrito']) ? $_SESSION['ElemCarrito'] : 0; ?></span>
            </a>
          <?php } ?>
        </div>

        <div class="hamburger">
          <i class="bx bx-menu-alt-left"></i>
        </div>
      </div>
    </div>

    <div class="hero">
      <div class="glide" id="glide_1">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li class="glide__slide">
              <div class="center">
                <div class="left">
                  <span class="">Inspiracion 2024</span>
                  <h1 class="">NUEVAS PRENDAS!!</h1>
                  <p>Articulos para todo publico</p>
                  <a href="product.php" class="hero-btn">COMPRA AHORA!!</a>
                </div>
                <div class="right">
                  <img class="img1" src="./images/hero-1.png" alt="">
                </div>
              </div>
            </li>
            <li class="glide__slide">
              <div class="center">
                <div class="left">
                  <span>Inspiracion 2024</span>
                  <h1>EL OUTFIT PERFECTO!!</h1>
                  <p>Encuentra tu outfit con nosotros</p>
                  <a href="#" class="hero-btn">COMPRA AHORA!!</a>
                </div>
                <div class="right">
                  <img class="img2" src="./images/hero-2.png" alt="">
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <!-- Categories Section -->
  <section class="section category">
    <div class="cat-center">
      <div class="cat">
        <img src="./images/cat3.jpg" alt="" />
        <div>
          <p>MUJERES</p>
        </div>
      </div>
      <div class="cat">
        <img src="./images/acce.jpeg" alt="" />
        <div>
          <p>ACCESORIOS</p>
        </div>
      </div>
      <div class="cat">
        <img src="./images/cat1.jpg" alt="" />
        <div>
          <p>MHOMBRES</p>
        </div>
      </div>
    </div>
  </section>

  <!-- New Arrivals -->
  <section class="section new-arrival">
    <div class="title">
      <h1>NUESTROS PRODUCTOS</h1>
      <p>Calidad a tus manos</p>
    </div>
    <div class="product-center">
      <?php
      include "./php/conexion.php";
      $database = BD;
      $sentencia = $pdo->prepare("SELECT * FROM {$database}.productos LIMIT 12;");
      $sentencia->execute();
      $listaProductos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
      ?>
      <?php foreach ($listaProductos as $producto) { ?>
        <div class="product-item">
          <div class="overlay">
            <form action="productDetails.php" method="POST">
              <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id_Producto'], COD, KEY); ?>">
              <input type="hidden" name="nombre" value="<?php echo openssl_encrypt($producto['nombre_Producto'], COD, KEY); ?>">
              <input type="hidden" name="precio" value="<?php echo openssl_encrypt($producto['precio_Producto'], COD, KEY); ?>">
              <input type="hidden" name="descripcion" value="<?php echo openssl_encrypt($producto['descripcion'], COD, KEY); ?>">
              <input type="hidden" name="tallas" value="<?php echo openssl_encrypt($producto['talla'], COD, KEY); ?>">
              <input type="hidden" name="color" value="<?php echo openssl_encrypt($producto['color'], COD, KEY); ?>">
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
          <form id="carritoForm" action="mostrarCarrito.php" method="POST">
            <input type="hidden" name="id" value="<?php echo openssl_encrypt($producto['id_Producto'], COD, KEY); ?>">
            <input type="hidden" name="cantidad" value="<?php echo openssl_encrypt(1, COD, KEY); ?>"> <!-- Ejemplo de cantidad fija -->
            <input type="hidden" name="btnAccion" value="Agregar">
            <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">
              <i class="bx bx-cart bx-tada"></i>
            </button>
          </form>
        </div>
      <?php } ?>
    </div>
</section>

  <!-- Promo -->

  <section class="section banner">
    <div class="left">
      <span class="trend">Mr. Store</span>
      <h1>PROMOCION!!</h1>
      <p>Por tu primer compra recibes el <span class="color">50% de descuento</span> tiempo limitado</p>
      <a href="#" class="btn btn-1">Compra ahora</a>
    </div>
    <div class="right">
      <!-- <img src="./images/kisspng-candice-swanepoel-5d47976ac538c5.4922582115649729068078.png" alt="Promotional Banner"> -->
    </div>
  </section>




  <!-- Featured -->

  <section class="section new-arrival">
    <div class="title">
      <h1>ACCESORIOS</h1>
      <p>Belleza y estilo a tus manos</p>
    </div>

    <div class="product-center">
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="./images/acc1.jpg" alt="" />
          </a>
          <span class="discount">50%</span>
        </div>
        <div class="product-info">
          <span>Accesorios</span>
          <a href="">Luz de pinza recargable portátil, apta para fotografía al aire libre</a>
          <h4>$3</h4>
        </div>
        <ul class="icons">
          <li><i class="bx bx-heart"></i></li>
          <li><i class="bx bx-search"></i></li>
          <li><i class="bx bx-cart"></i></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="./images/acc2.jpg" alt="" />
          </a>
        </div>

        <div class="product-info">
          <span>Accesorios</span>
          <a href="">Bolso cuadrado rojo de poliuretano con diseño de puntada simple</a>
          <h4>$13</h4>
        </div>
        <ul class="icons">
          <li><i class="bx bx-heart"></i></li>
          <li><i class="bx bx-search"></i></li>
          <li><i class="bx bx-cart"></i></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="./images/acc3.jpg" alt="" />
          </a>
          <span class="discount">40%</span>
        </div>
        <div class="product-info">
          <span>Accesorios</span>
          <a href="">Bolso de hombro simple y de moda para mujer, primavera/verano</a>
          <h4>$19</h4>
        </div>
        <ul class="icons">
          <li><i class="bx bx-heart"></i></li>
          <li><i class="bx bx-search"></i></li>
          <li><i class="bx bx-cart"></i></li>
        </ul>
      </div>
      <div class="product-item">
        <div class="overlay">
          <a href="" class="product-thumb">
            <img src="./images/acc4.jpg" alt="" />
          </a>
        </div>
        <div class="product-info">
          <span>Accesorios</span>
          <a href="">Reloj inteligente compatible con IOS y Android</a>
          <h4>$10</h4>
        </div>
        <ul class="icons">
          <li><i class="bx bx-heart"></i></li>
          <li><i class="bx bx-search"></i></li>
          <li><i class="bx bx-cart"></i></li>
        </ul>
      </div>

  </section>

  <!-- Contact -->
  <section class="section contact">
    <div class="row">
      <div class="col">
        <h2>SOPORTE DE CLIENTE</h2>
        <p>Amamos atender a nuestros clientes con el mejor servicio por eso si
          tienes alguna duda no dudes en contactarnos
        </p>
        <a href="" class="btn btn-1">Contacto</a>
      </div>
      <div class="col">
        <form action="">
          <div>
            <input type="email" placeholder="Email Address">
            <a href="">enviar</a>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="row">
      <div class="col d-flex">
        <h4>INFORMACION</h4>
        <a href="">Acerca de nosotros</a>
        <a href="">Contactanos</a>
        <a href="">Terminos</a>
      </div>
      <div class="col d-flex">
        <span><i class='bx bxl-facebook-square'></i></span>
        <span><i class='bx bxl-instagram-alt'></i></span>
        <span><i class='bx bxl-github'></i></span>
        <span><i class='bx bxl-twitter'></i></span>
        <span><i class='bx bxl-pinterest'></i></span>
      </div>
    </div>
  </footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>
<script src="./js/slider.js"></script>
<script src="./js/index.js"></script>

</html>