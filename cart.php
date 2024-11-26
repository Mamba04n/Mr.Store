<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'clear') {
            unset($_SESSION['CARRITO']);
            header('Location: cart.php');
            exit();
        } elseif ($_POST['action'] == 'remove') {
            $id = $_POST['id'];
            foreach ($_SESSION['CARRITO'] as $index => $item) {
                if ($item['id'] == $id) {
                    unset($_SESSION['CARRITO'][$index]);
                    $_SESSION['CARRITO'] = array_values($_SESSION['CARRITO']); // Reindexar el array
                    break;
                }
            }
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
    <div class="container cart">
        <h1>Carrito de Compras</h1>
        <?php if (!empty($_SESSION['CARRITO'])) { ?>
            <p>Total de elementos en el carrito: <?php echo count($_SESSION['CARRITO']); ?></p>
            <table>
                <tr>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>--</th>
                </tr>
                <?php 
                $total = 0;
                foreach ($_SESSION['CARRITO'] as $item) { 
                    $totalItem = $item['precio'] * $item['cantidad'];
                    $total += $totalItem;
                ?>
                <tr>
                    <td>
                        <div class="cart-info">
                            <img src="<?php echo isset($item['imagen']) ? $item['imagen'] : 'default.jpg'; ?>" alt="" />
                            <div>
                                <p><?php echo isset($item['nombre']) ? $item['nombre'] : 'N/A'; ?></p>
                                <span>Price: <?php echo isset($item['precio']) ? $item['precio'] : 'N/A'; ?></span> <br />
                                <form action="cart.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="action" value="remove">
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td><input type="number" value="<?php echo isset($item['cantidad']) ? $item['cantidad'] : 0; ?>" min="1" /></td>
                    <td><?php echo isset($item['precio']) ? $item['precio'] : 'N/A'; ?></td>
                    <td><?php echo $totalItem; ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" align="right"><strong>Total:</strong></td>
                    <td><strong><?php echo $total; ?></strong></td>
                    <td></td>
                </tr>
            </table>
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