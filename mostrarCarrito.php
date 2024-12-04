<?php
session_start();
include './php/conexion.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['Cuenta']) && isset($_SESSION['Carrito'])) {
    if (isset($_POST['btnAccion']) && $_POST['btnAccion'] == 'Agregar') {
        $id_prod = openssl_decrypt($_POST['id'], COD, KEY);
        $id_user = $_SESSION['Cuenta'];
        $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
        $idCarrito = $_SESSION['Carrito'];

        $precioProd = $pdo->prepare("SELECT precio_Producto from productos WHERE id_Producto = :id");
        $precioProd->bindParam(":id", $id_prod, PDO::PARAM_STR);
        $precioProd->execute();
        $precio = $precioProd->fetch(PDO::FETCH_ASSOC);
        $subtotal = $precio['precio_Producto'] * $cantidad;
        $insertCarrito = $pdo->prepare("INSERT INTO detcarritos_compras(id_Carrito,cantidad,id_Producto,subtotal) 
                                            VALUES(:idCar, :cantidad ,:producto, :subtotal)");
        $insertCarrito->bindParam(':idCar', $idCarrito, PDO::PARAM_STR);
        $insertCarrito->bindParam(':producto', $id_prod, PDO::PARAM_STR);
        $insertCarrito->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
        $insertCarrito->bindParam(':subtotal', $subtotal, PDO::PARAM_STR);
        if ($insertCarrito->execute()) {
            header('Location: index.php?status=success');
            exit();
        } else {
            echo "Error en insertar carrito";
        }
    }
} else {
    header('Location: login.php');
}
