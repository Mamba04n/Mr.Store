<?php
session_start();
include "./php/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'clear') {
            $LimpiarCarrito = $pdo->prepare("DELETE FROM detCarritos_Compras where id_Carrito = :idCarrito");
            $LimpiarCarrito->bindParam(':idCarrito', $_SESSION['Carrito'], PDO::PARAM_STR);
            $LimpiarCarrito->execute();
            header('Location: cart.php');
            exit();
        } elseif ($_POST['action'] == 'remove') {
            $id_Prod = $_POST['id'];
            $eliminarProdCarrito = $pdo->prepare("DELETE FROM detCarritos_Compras where id_Carrito = :idCarrito AND id_Producto = :prod LIMIT 1");
            $eliminarProdCarrito->bindParam(':idCarrito', $_SESSION['Carrito'], PDO::PARAM_STR);
            $eliminarProdCarrito->bindParam(':prod', $id_Prod, PDO::PARAM_STR);
            $eliminarProdCarrito->execute();
            header('Location: cart.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="./css/styles.css" />
</head>

<body>
    <div class="top-nav hei">
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
                <?php if (isset($_SESSION['admin']) ? !$_SESSION['admin'] : false) { ?>
                    <a href="cart.php" class="icon">
                        <i class="bx bx-cart"></i>
                        <span class="d-flex">0</span>
                    </a>
                <?php } ?>
            </div>

            <div class="hamburger">
                <i class="bx bx-menu-alt-left"></i>
            </div>
        </div>
        <div class="top-nav hei"></div>
    </div>
    <!-- Carrito -->
    <div class="container" style="margin-top:35px ;">
        <h1 class="title">Carrito de Compras</h1>
        <?php
        $Carrito = $pdo->prepare("SELECT * FROM detcarritos_compras where id_Carrito = :carrito");
        $Carrito->bindParam(':carrito', $_SESSION['Carrito'], PDO::PARAM_STR);
        $Carrito->execute();
        $productos = $Carrito->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php if (count($productos) > 0) { ?>
            <table>
                <tr>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
                <?php
                $total = 0;
                foreach ($productos as $item) {
                    $precioProd = $pdo->prepare("SELECT * from productos WHERE id_Producto = :id");
                    $precioProd->bindParam(":id", $item['id_Producto'], PDO::PARAM_STR);
                    $precioProd->execute();
                    $producto = $precioProd->fetch(PDO::FETCH_ASSOC);
                    $totalItem = $producto['precio_Producto'] * $item['cantidad'];
                    $total += $totalItem;
                ?>
                    <tr>
                        <td>
                            <div class="cart-info">
                                <img src="<?php echo isset($producto['imagen']) ? $producto['imagen'] : 'default.jpg'; ?>" alt="" />
                                <div>
                                    <p><?php echo isset($producto['nombre_Producto']) ? $producto['nombre_Producto'] : 'N/A'; ?></p>
                                    <span><?php echo isset($producto['descripcion']) ? $producto['descripcion'] : 'N/A'; ?></span> <br />
                                    <form action="cart.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $item['id_Producto']; ?>">
                                        <input type="hidden" name="action" value="remove">
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td><input type="number" value="<?php echo isset($item['cantidad']) ? $item['cantidad'] : 0; ?>" min="1" /></td>
                        <script>

                        </script>
                        <td><?php echo isset($producto['precio_Producto']) ? $producto['precio_Producto'] . "$" : 'N/A'; ?></td>
                        <td><?php echo $totalItem . "$"; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <p class="texto rightT">Total de elementos en el carrito:<strong><?php echo count($productos);?></strong></p>
            <div class="rightT">
                <p class="bg-purple btrPadding"><strong>Total:</strong></p>
                <p class="bg-purple btrPadding"><strong><?php echo $total . "$"; ?></strong></p>
            </div>
            <form action="cart.php" method="POST">
                <input type="hidden" name="action" value="clear">
                <button type="submit" class="btn btn-danger">Vaciar Carrito</button>
            </form>
        <?php } else { ?>
            <p>El carrito está vacío</p>
        <?php } ?>
    </div>
    <!-- Custom Script -->
    <script src="./js/index.js"></script>
</body>

</html>