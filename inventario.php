<?php
include './php/conexion.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'buscar') {
        $id = $_POST['id'];
        $inventario = $pdo->prepare("SELECT * FROM inventario a join productos b on a.id_producto = b.id_producto 
                                    join proveedores c on b.id_proveedor = c.id_proveedor where a.id_Inv = :id");
        $inventario->bindParam(':id', $id);
        $inventario->execute();
        $stockInv = $inventario->fetchAll(PDO::FETCH_ASSOC);
    } elseif (isset($_POST['action']) && $_POST['action'] == 'filtro') {
        $inventario = $pdo->prepare("SELECT * FROM inventario a join productos b on a.id_producto = b.id_producto 
                                    join proveedores c on b.id_proveedor = c.id_proveedor");
        $inventario->execute();
        $stockInv = $inventario->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    $inventario = $pdo->prepare("SELECT * FROM inventario a join productos b on a.id_producto = b.id_producto 
                                join proveedores c on b.id_proveedor = c.id_proveedor");
    $inventario->execute();
    $stockInv = $inventario->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="container" style="display: flex; justify-content: center; margin-bottom: 20px;">
        <div style="display: flex; gap: 1px;">
            <form action="inventario.php" method="POST">
                <label><strong>Buscador por id: </strong></label>
                <input type="text" name="id">
                <input type="hidden" name="action" id="action" value="buscar">
                <button class="btn btn-green" type="submit"><strong>Buscar</strong></button>
            </form>
            <form action="inventario.php" style="all: none;" method="POST">
                <input type="hidden" name="action" value="filtro">
                <button id="btnFiltro" class="btn btn-green" type="submit"><strong>Quitar filtro</strong></button>
            </form>
        </div>

    </div>
    <div class="container" style="height: 400px; overflow: scroll; padding: 0;">
        <table class="TabInv">
            <?php
            ?>
            <tr>
                <th>id del Inventario</th>
                <th>id de Producto</th>
                <th>Proveedor</th>
                <th>Nombre del producto</th>
                <th>Stock</th>
                <th>Precio del producto</th>
                <th>Tallas</th>
                <th></th>
            </tr>
            <?php foreach ($stockInv as $stock) { ?>
                <tr>
                    <td class="ids selector"  style="cursor: pointer;"><?php echo $stock['id_Inv'] ?></td>
                    <td class="ids"><?php echo $stock['id_Producto'] ?></td>
                    <td><?php echo $stock['nombre_Empresa'] ?></td>
                    <td><?php echo $stock['nombre_Producto'] ?></td>
                    <td><?php echo $stock['stock'] ?></td>
                    <td><?php echo $stock['precio_Producto'] ?></td>
                    <td><?php echo $stock['talla'] ?></td>
                    <td>
                        <form action="inventario.php">
                            <input type="hidden" name="id_Prod" value=<?php echo $stock['id_Producto']?>>
                            <button type="submit" style="border: none;">
                                <i class='bx bxs-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <script>
                    const selectores = document.getElementsByClassName('selector');
                    
                    addEventListener('click', function() {
                        let inputs = document.getElementsByClassName('input_inv');
                        inputs[0].value = this.parentElement.children[0].innerText;
                        inputs[1].value = this.parentElement.children[1].innerText;
                        inputs[2].value = this.parentElement.children[2].innerText;
                        inputs[3].value = this.parentElement.children[3].innerText;
                        inputs[4].value = this.parentElement.children[4].innerText;
                        inputs[5].value = this.parentElement.children[5].innerText;
                        inputs[6].value = this.parentElement.children[6].innerText;
                    });
                </script>
            <?php } ?>
        </table>
    </div>
    <div class="container" style="margin-top: 10px;">
        <form action="inventario.php" style="display: grid; grid-template-columns: repeat(4,1fr); gap: 10px;">
            <label for="id_Inv">Id del inventario</label>
            <input type="text" name="id_Inv" class="input_inv" oninput="formatNums(this)" readonly>
            <label for="id_Prod">Id del producto</label>
            <input type="text" name="id_Prod" class="input_inv" oninput="formatNums(this)" readonly>
            <label for="empresa">Nombre de la empresa</label>
            <input type="text" name="empresa" class="input_inv" oninput="formatNums(this)" readonly>
            <label for="producto">Nombre del producto</label>
            <input type="text" name="producto" class="input_inv" oninput="formatNums(this)">
            <label for="stock">Stock del producto</label>
            <input type="text" name="stock" class="input_inv" oninput="formatNums(this)" readonly>
            <label for="precio">Precio del producto</label>
            <input type="text" name="precio" class="input_inv" oninput="formatNums(this)">
            <label for="talla">Tallas disponibles</label>
            <input type="text" name="talla" class="input_inv" oninput="formatNums(this)">
            <input type="hidden" name="action" value="actualizar">
            <button class="btn btn-green" type="submit" style="width: 100%; grid-column: span 2">Actualizar</button>
            <script>
                function formatNums(input) {
                    let value = input.value.replace(/\D/g, '');
                    input.value = value;
                }
            </script>
        </form>
    </div>

</body>

</html>