<?php
session_start();
include './php/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btnAccion']) && $_POST['btnAccion'] == 'Agregar') {
        $id = openssl_decrypt($_POST['id'], COD, KEY);
        $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);

        if (is_numeric($id) && is_numeric($cantidad)) {
            $producto = array(
                'id' => $id,
                'cantidad' => $cantidad
            );

            if (!isset($_SESSION['CARRITO'])) {
                $_SESSION['CARRITO'] = array();
            }

            array_push($_SESSION['CARRITO'], $producto);
        }
    }

    // Redirigir a cart.php después de agregar el producto
    header('Location: cart.php');
    exit();
} else {
    echo "No se recibió una solicitud POST.";
}
?>