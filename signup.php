<?php session_start(); ?>

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
  <title>Sign Up</title>
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

  <!-- Login -->
  <div class="container">
    <div class="login-form">
      <form action="./php/registro.php" method="POST">
        <h1>Registrate</h1>
        <p>
          Por favor llena este formulario para crear una cuenta o
          <a href="login.php">Iniciar Sesion</a>
        </p>
        <label for="nombre">Nombre Completo</label>
        <input type="text" placeholder="Ingrese su Nombre" name="nombre" required />

        <label for="cedula">Cedula de identidad (con guiones)</label>
        <input type="text" placeholder="Ingrese su cedula" name="cedula" id="cedula" required />

        <label for="email">Email</label>
        <input type="text" placeholder="Ingrese el Email" name="correo" required />

        <label for="usuario">Usuario</label>
        <input type="text" placeholder="Ingrese su Usuario" name="usuario" required />

        <label for="psw">Contraseña</label>
        <input type="password" placeholder="Ingrese la contraseña" name="psw" required />

        <label for="direccion">Direccion</label>
        <input type="text" placeholder="Ingrese su direccion" name="direccion" required />

        <label>
          <input type="checkbox" checked="checked" name="remember" style="margin-bottom: 15px" />
          Remember me
        </label>

        <p>
          Al crear una cuenta usted acepta nuestros
          <a href="#">Terminos & Condiciones</a>.
        </p>

        <div class="buttons">
          <button type="button" class="cancelbtn">Cancel</button>
          <button type="submit" class="signupbtn">Resgistrarse</button>
        </div>
      </form>
    </div>
  </div>


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


  <!-- Custom Script -->
  <script src="./js/index.js"></script>
</body>

</html>