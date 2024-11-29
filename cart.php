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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Box icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"
    />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="./css/styles.css" />
    <title>Login</title>
  </head>
  <body>
    <!-- Navigation -->
    <div class="top-nav">
      <div class="container d-flex">
        <p>Order Online Or Call Us: (001) 2222-55555</p>
        <ul class="d-flex">
          <li><a href="#">About Us</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
    <div class="navigation">
      <div class="nav-center container d-flex">
        <a href="index.php" class="logo"><h1>Mr. Store</h1></a>

        <ul class="nav-list d-flex">
          <li class="nav-item">
            <a href="/" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="product.php" class="nav-link">Shop</a>
          </li>
          <li class="nav-item">
            <a href="#terms" class="nav-link">Terms</a>
          </li>
          <li class="nav-item">
            <a href="#about" class="nav-link">About</a>
          </li>
          <li class="nav-item">
            <a href="#contact" class="nav-link">Contact</a>
          </li>
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
    <!-- Footer -->
    <footer class="footer">
      <div class="row">
        <div class="col d-flex">
          <h4>INFORMATION</h4>
          <a href="">About us</a>
          <a href="">Contact Us</a>
          <a href="">Term & Conditions</a>
          <a href="">Shipping Guide</a>
        </div>
        <div class="col d-flex">
          <h4>USEFUL LINK</h4>
          <a href="">Online Store</a>
          <a href="">Customer Services</a>
          <a href="">Promotion</a>
          <a href="">Top Brands</a>
        </div>
        <div class="col d-flex">
          <span><i class="bx bxl-facebook-square"></i></span>
          <span><i class="bx bxl-instagram-alt"></i></span>
          <span><i class="bx bxl-github"></i></span>
          <span><i class="bx bxl-twitter"></i></span>
          <span><i class="bx bxl-pinterest"></i></span>
        </div>
      </div>
    </footer>

    <!-- Custom Script -->
    <script src="./js/index.js"></script>
  </body>
</html>
