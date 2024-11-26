<?php
$conexion = mysqli_connect("localhost", "root", "", "login_register_bd");

if ($conexion) {
    echo 'Conexion Exitosa';
    exit();
}else{
    echo 'Conexión Fallida';
}
?>