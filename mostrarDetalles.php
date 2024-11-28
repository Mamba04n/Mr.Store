<?php
session_start();

/*

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
*/ ?>

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
    <title>Boy’s T-Shirt - Codevo</title>
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
                    <a href="inventario.php" class="nav-link">Inventario</a>
                </li>
                <!-- <li class="nav-item">
            <a href="#contact" class="nav-link">Contactar</a>
          </li> -->
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
                    <i class="bx bx-cart "></i>
                    <span class="d-flex">0</span>
                </a>
            </div>

            <div class="hamburger">
                <i class="bx bx-menu-alt-left"></i>
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <?php if (!empty($_SESSION['DETALLEPROD'])) { ?>
        <section class="section product-detail">
            <div class="details container">
                <div class="left image-container">
                    <div class="main">
                        <img src="<?php echo $_SESSION['DETALLEPROD']['imagen']; ?>" id="zoom" alt="" />
                    </div>
                </div>
                <div class="right">
                    <span><?php echo $_SESSION['DETALLEPROD']['nombre'] . " - " . $_SESSION['DETALLEPROD']['color']?> </span>
                    <h1><?php echo $_SESSION['DETALLEPROD']['descripcion'] ?></h1>
                    <div class="price">$ <?php echo $_SESSION['DETALLEPROD']['precio'] ?></div>
                    <form>
                        <div>
                            <select>
                                <option value="Select Size" selected disabled>
                                    Select Size
                                </option>
                                <option value="1">32</option>
                                <option value="2">42</option>
                                <option value="3">52</option>
                                <option value="4">62</option>
                            </select>
                            <span><i class="bx bx-chevron-down"></i></span>
                        </div>
                    </form>
                    <form class="form">
                        <input type="text" placeholder="1" />
                        <a href="cart.php" class="addCart">Add To Cart</a>
                    </form>
                    <!-- <h3>Product Detail</h3>
                    <p>
                        
                    </p> -->
                </div>
            </div>
        </section>
    <?php } else {
        echo 'asdas';
    } ?>

    <!-- Related -->
    <section class="section featured">
        <div class="top container">
            <h1>Related Products</h1>
            <a href="#" class="view-more">View more</a>
        </div>
        <div class="product-center container">
            <div class="product-item">
                <div class="overlay">
                    <a href="" class="product-thumb">
                        <img src="./images/product-5.jpg" alt="" />
                    </a>
                </div>
                <div class="product-info">
                    <span>MEN'S CLOTHES</span>
                    <a href="">Concepts Solid Pink Men’s Polo</a>
                    <h4>$150</h4>
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
                        <img src="./images/product-2.jpg" alt="" />
                    </a>
                    <span class="discount">40%</span>
                </div>
                <div class="product-info">
                    <span>MEN'S CLOTHES</span>
                    <a href="">Concepts Solid Pink Men’s Polo</a>
                    <h4>$150</h4>
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
                        <img src="./images/product-7.jpg" alt="" />
                    </a>
                </div>
                <div class="product-info">
                    <span>MEN'S CLOTHES</span>
                    <a href="">Concepts Solid Pink Men’s Polo</a>
                    <h4>$150</h4>
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
                        <img src="./images/product-4.jpg" alt="" />
                    </a>
                    <span class="discount">40%</span>
                </div>
                <div class="product-info">
                    <span>MEN'S CLOTHES</span>
                    <a href="">Concepts Solid Pink Men’s Polo</a>
                    <h4>$150</h4>
                </div>
                <ul class="icons">
                    <li><i class="bx bx-heart"></i></li>
                    <li><i class="bx bx-search"></i></li>
                    <li><i class="bx bx-cart"></i></li>
                </ul>
            </div>
        </div>
    </section>
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
    <script
        src="https://code.jquery.com/jquery-3.4.0.min.js"
        integrity="sha384-JUMjoW8OzDJw4oFpWIB2Bu/c6768ObEthBMVSiIx4ruBIEdyNSUQAjJNFqT5pnJ6"
        crossorigin="anonymous"></script>
    <script src="./js/zoomsl.min.js"></script>
    <script>
        $(function() {
            const session = <?php echo json_encode($_SESSION); ?>;
            console.log("datos de la session", session);
            $("#zoom").imagezoomsl({
                zoomrange: [4, 4],
            });
        });
    </script>
</body>

</html>