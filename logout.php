<?php
session_start();
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión
echo "Sesión cerrada correctamente."; // Mensaje de depuración
header('Location: ./cart.php'); // Redirige a la página de carrito
exit();
?>