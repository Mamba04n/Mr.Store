<?php session_start();
include "./php/conexion.php";
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
    <title>Login</title>
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
                    <i class="bx bx-cart"></i>
                    <span class="d-flex">0</span>
                </a>
            </div>

            <div class="hamburger">
                <i class="bx bx-menu-alt-left"></i>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="login-form">
            <form action="actualizarPerfil.php" method="POST">
                <h1 class="title">Perfil</h1>
                <?php 
                $id = $_SESSION['Cuenta'];
                $query = $pdo ->prepare("SELECT * FROM usuarios a JOIN clientes b ON a.id_Usuario = b.id_Usuario where a.id_Usuario = :id");
                $query -> bindParam(":id",$id,PDO::PARAM_STR);
                $query -> execute();
                $cuenta = $query -> fetch(PDO::FETCH_ASSOC);
                if (isset($_SESSION['Cuenta'])) { ?>
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" placeholder="Ingrese su Nombre" name="nombre" value="<?php echo $cuenta['nombre_Completo']?>" required />
                    <input type="hidden" name="id" value="<?php echo $id?>" required />

                    <label for="cedula">Cedula de identidad (con guiones)</label>
                    <input type="text" placeholder="Ingrese su cedula" name="cedula" id="cedula" value="<?php echo $cuenta['cedula'] ?>" required />

                    <label for="email">Email</label>
                    <input type="text" placeholder="Ingrese el Email" name="correo" value="<?php echo $cuenta['email'] ?>" required />

                    <label for="usuario">Usuario</label>
                    <input type="text" placeholder="Ingrese su Usuario" name="usuario" value="<?php echo $cuenta['username'] ?>" required />

                    <label for="psw">Contraseña</label>
                    <input type="password" placeholder="Ingrese la contraseña" name="psw" value="<?php echo $cuenta['contraseña'] ?>" required />

                    <label for="direccion">Direccion</label>
                    <input type="text" placeholder="Ingrese su direccion" name="direccion" value="<?php echo $cuenta['direccion'] ?>" required />
                <?php } ?>
                <button type="submit">Actualizar perfil</button>
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