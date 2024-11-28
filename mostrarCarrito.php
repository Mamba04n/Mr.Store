<?php
session_start();
include './php/config.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['btnAccion']) && $_POST['btnAccion'] == 'Agregar') {
        $id = openssl_decrypt($_POST['id'], COD, KEY);
        $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
        $precio = openssl_decrypt($_POST['precio'], COD, KEY);
        $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
        $descripcion = openssl_decrypt($_POST['descripcion'], COD, KEY);
        $imagen = $_POST['imagen']; // Asegúrate de que el campo 'imagen' esté presente en el formulario

        if (is_numeric($id) && is_string($nombre) && is_numeric($precio) && is_numeric($cantidad) && is_string($imagen) && is_string($descripcion)) {
            $producto = array(
                'id' => $id,
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad,
                'imagen' => $imagen,
                'descripcion' => $descripcion
            );

            if (!isset($_SESSION['CARRITO'])) {
                $_SESSION['CARRITO'] = array();
            }

            array_push($_SESSION['CARRITO'], $producto);
        }
    }

    // Redirigir de vuelta a la página de productos con un mensaje de éxito
    header('Location: index.php?status=success');
    exit();
} else {
    echo "No se recibió una solicitud POST.";
}
?>