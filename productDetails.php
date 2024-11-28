<?php
session_start();
include './php/config.php';
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['MostrarDetalle']) && $_POST['MostrarDetalle'] == 'detalle') {
        $id = openssl_decrypt($_POST['id'], COD, KEY);
        $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
        $precio = openssl_decrypt($_POST['precio'], COD, KEY);
        $descripcion = openssl_decrypt($_POST['descripcion'],COD,KEY);
        $imagen = $_POST['imagen']; // Asegúrate de que el campo 'imagen' esté presente en el formulario
        if (is_numeric($id) && is_string($nombre) && is_numeric($precio) && is_string($imagen) && is_string($descripcion)){
            $producto = array(
                'id' => $id,
                'nombre' => $nombre,
                'precio' => $precio,
                'imagen' => $imagen,
                'descripcion' => $descripcion
            );

            $_SESSION['DETALLEPROD'] = $producto;
            // array_push($_SESSION['DETALLEPROD'], $producto);
        }
    }
    else{
        echo "No se valido la solicitud Mostrar detalle";
    }

    // Redirigir de vuelta a la página de productos con un mensaje de éxito
    header('Location: mostrarDetalles.php');
    exit();
} else {
    echo "No se recibió una solicitud POST.";
}
?>

