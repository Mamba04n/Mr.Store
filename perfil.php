<?php session_start();
include "./php/conexion.php";
include './php/verificar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Box icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="./css/styles.css" />
    <title>Perfil</title>
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
                <li class="nav-item">
                    <a href="pedidos.php" class="nav-link">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a href="perfil.php" class="nav-link">Perfil</a>
                </li>
                <li class="nav-item">
                    <form action="logout.php" method="POST" style="display:inline;">
                        <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">Cerrar Sesión</button>
                    </form>
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
        <div class="top-nav hei"></div>
    </div>

    <!-- Contenido del perfil -->
    <div class="container" style="margin-top:35px ;">
        <h1 class="title">Perfil</h1>
        <!-- Aquí puedes agregar el contenido del perfil del usuario -->
        <form action="actualizarPerfil.php" method="POST">
            <!-- Campos del perfil -->
            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
        </form>
        <form action="logout.php" method="POST" style="margin-top: 10px;">
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
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