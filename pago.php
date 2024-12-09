<?php session_start();
include './php/conexion.php';
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['Cuenta']) && isset($_SESSION['Carrito'])) {
    if (isset($_POST['accion']) && $_POST['accion'] == 'final') {
        if (isset($_POST['metodopago'])) {
            $idCarrito = $_SESSION['Carrito'];
            $idCuenta = $_SESSION['Cuenta'];
            $metodoPago = $_POST['metodopago'];
            $cliente = $_SESSION['Cliente'];

            $insertPedido = $pdo->prepare("INSERT INTO pedidos (id_Cliente, estado, fecha_Pedido) VALUES (:cliente, 'Confirmado', :fecha)");
            $insertPedido->bindParam(':cliente', $cliente, PDO::PARAM_STR);
            $fecha = date('Y-m-d H:i:s');
            $insertPedido->bindParam(':fecha', $fecha, PDO::PARAM_STR);
            $insertPedido->execute();

            $id_pedido = $pdo->lastInsertId();

            $Carrito = $pdo->prepare("SELECT * FROM detcarritos_compras where id_Carrito = :carrito");
            $Carrito->bindParam(':carrito', $idCarrito, PDO::PARAM_STR);
            $Carrito->execute();
            $productos = $Carrito->fetchAll(PDO::FETCH_ASSOC);

            foreach ($productos as $producto) {
                $precioProd = $pdo->prepare("SELECT precio_Producto from productos WHERE id_Producto = :id");
                $precioProd->bindParam(":id", $producto['id_Producto'], PDO::PARAM_STR);
                $precioProd->execute();
                $precio = $precioProd->fetch(PDO::FETCH_ASSOC);

                $insertDetPedido = $pdo->prepare("INSERT INTO detpedidos (id_Pedido, id_Producto, cantidad, precio_Unitario, subTotal) 
                                                  VALUES (:pedido, :producto, :cantidad, :precio, :subtotal)");
                $insertDetPedido->bindParam(':pedido', $id_pedido, PDO::PARAM_STR);
                $insertDetPedido->bindParam(':producto', $producto['id_Producto'], PDO::PARAM_STR);
                $insertDetPedido->bindParam(':cantidad', $producto['cantidad'], PDO::PARAM_STR);
                $insertDetPedido->bindParam(':precio', $precio['precio_Producto'], PDO::PARAM_STR);
                $insertDetPedido->bindParam(':subtotal', $producto['subTotal'], PDO::PARAM_STR);
                $insertDetPedido->execute();
            }
            $LimpiarCarrito = $pdo->prepare("DELETE FROM detCarritos_Compras where id_Carrito = :idCarrito");
            $LimpiarCarrito->bindParam(':idCarrito', $_SESSION['Carrito'], PDO::PARAM_STR);
            $LimpiarCarrito->execute();
            $_SESSION['ElemCarrito'] = 0;
            echo '
            <script>
                alert("Compra realizada con éxito");
                window.location = "./index.php?success=true";
            </script>';
            // header('Location: index.php?success=true');
            exit();
        }
        else {
            echo '
            <script>
                alert("Seleccione un metodo de pago");
                window.location = "./index.php";
            </script>';
        }
    }
} else {
    echo '
            <script>
                alert("No permiso para estar aquí");
                window.location = "./index.php";
            </script>;  
        ';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="./css/styles.css" />
</head>

<body>
    <div class="top-nav hei"></div>
    <div class="navigation">
        <div class="nav-center container d-flex" style="display: flex; justify-content: center;">
            <a href="index.php" class="logo">
                <h1>Mr. Store</h1>
            </a>
        </div>
    </div>
    <div class="top-nav hei"></div>
    <h1 class="h1Pag">Pasarela de pago</h1>
    <div class="container" id="cont-pago" style="display: grid; justify-content: center; height: fit-content; 
                                                border: 1px solid var(--purple); width: fit-content;
                                                padding: 10px;
                                                box-sizing: content-box;">
        <form action="pago.php" class="form-pago" style="gap: 5px; width: 35vw;" method="POST">
            <div class="metodos" style="display: flex; width: 100%; justify-content: center;">
                <select name="metodopago" id="metodoPago" required>
                    <option value="Seleccione un metodo de pago" disabled selected> Seleccione un metodo de pago </option>
                    <option value="Mastercard"> Tarjeta Mastercard </option>
                    <option value="Paypal"> Paypal </option>
                    <option value="Visa"> Tarjeta Visa </option>
                </select>
                <img src="images/visa.png">
                <img src="images/mastercard.png">
                <img src="images/paypal.png">
            </div>
            <input type="text" name="cardNumber" placeholder="XXXX-XXXX-XXXX-XXXX" maxlength="19" oninput="formatCardNumber(this)" required>
            <input type="text" name="NombreTarjeta" placeholder="Nombre del titular" required>
            <script>
                function formatCardNumber(input) {
                    let value = input.value.replace(/\D/g, '');
                    let formattedValue = value.match(/.{1,4}/g)?.join('-') || '';
                    input.value = formattedValue;
                }
            </script>
            <div style="display: flex;">
                <input type="text" name="fecha" placeholder="Fecha de vencimiento (MM/AA)" maxlength="5" oninput="formatDate(this)" required>
                <input type="text" name="cvv" placeholder="Codigo de seguridad" maxlength="3" required>
                <script>
                    function formatDate(input) {
                        let value = input.value.replace(/\D/g, '');
                        let formattedValue = value.match(/.{1,2}/g)?.join('/') || '';
                        input.value = formattedValue;
                    }
                </script>
            </div>
            <input type="hidden" name="accion" value="final">
            <button type="submit"> Pagar </button>
        </form>
    </div>
    <script src="./js/pago.js"></script>
</body>

</html>