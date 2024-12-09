<?php 
session_start();
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
    <div class="top-nav hei">
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
                        <form action="" method="POST">
                            <button type="submit" style="all: unset;">
                                <a href="pedidos.php" class="nav-link">Pedidos</a>
                            </button>
                        </form>
                    </li>
                <?php }
                if (isset($_SESSION['admin']) ? $_SESSION['admin'] : false) { ?>
                    <li class="nav-item">
                        <button type="submit" style="all: unset;">
                            <a href="inventario.php" class="nav-link">Inventario</a>
                        </button>
                    </li> <?php } ?>
            </ul>

            <div class="icons d-flex">
                <a href="login.php" class="icon" style="width: 65px; height: 60px; display: flex; justify-content: center; align-items: center;">
                    <i class="bx bx-user"></i>
                </a>
                <div class="icon" style="width: 65px; height: 60px; display: flex; justify-content: center; align-items: center;">
                    <i class="bx bx-search"></i>
                </div>
                <?php if (isset($_SESSION['Cuenta']) && !$_SESSION['admin']) { ?>
                    <form action="favoritos.php" style="all: unset;" method="POST">
                        <div class="icon">
                            <button type="submit" class="icon" style="border: none; background: white;">
                                <i class="bx bx-heart"></i>
                                <span class="d-flex"><?php echo isset($_SESSION['Favs']) ? $_SESSION['Favs'] : 0; ?></span>
                            </button>
                        </div>
                    </form>
                <?php } ?>
                <?php if (isset($_SESSION['admin']) && !$_SESSION['admin']) { ?>
                    <form action="cart.php" style="all: unset;" method="POST">
                        <div class="icon">
                            <button type="submit" class="icon" style="border: none; background: white;">
                                <i class="bx bx-cart"></i>
                                <span class="d-flex"><?php echo isset($_SESSION['ElemCarrito']) ? $_SESSION['ElemCarrito'] : 0; ?></span>
                            </button>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>