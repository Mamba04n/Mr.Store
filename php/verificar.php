<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si hay una sesión iniciada
if (!isset($_SESSION['Cuenta'])) {
    // Redirige al login si no hay sesión iniciada
    header('Location: login.php');
    exit();
} else {
    // Mensaje de depuración
    echo "Sesión iniciada: " . $_SESSION['Cuenta'] . "<br>";
}

// Verifica si el carrito está definido
if (!isset($_SESSION['id_Carrito'])) {
    include "./php/conexion.php";
    try {
        $usuarioId = $_SESSION['Cuenta']; // Reemplaza con el ID del usuario actual
        $consultaCarritoExistente = $pdo->prepare("SELECT id_Carrito FROM carritos_compras WHERE id_Cliente = :id_Cliente");
        $consultaCarritoExistente->bindParam(':id_Cliente', $usuarioId);
        $consultaCarritoExistente->execute();
        $carritoExistente = $consultaCarritoExistente->fetch(PDO::FETCH_ASSOC);

        if ($carritoExistente) {
            // Usar el carrito existente
            $_SESSION['id_Carrito'] = $carritoExistente['id_Carrito'];
        } else {
            // Crear un nuevo carrito
            $consultaCarrito = $pdo->prepare("INSERT INTO carritos_compras (id_Cliente) VALUES (:id_Cliente)");
            $consultaCarrito->bindParam(':id_Cliente', $usuarioId);
            $consultaCarrito->execute();
            $_SESSION['id_Carrito'] = $pdo->lastInsertId();
        }
    } catch (PDOException $e) {
        die("Error al crear o verificar el carrito: " . $e->getMessage());
    }
}

// Mensaje de depuración
echo "ID Carrito: " . (isset($_SESSION['id_Carrito']) ? $_SESSION['id_Carrito'] : 'No definido') . "<br>";
?>