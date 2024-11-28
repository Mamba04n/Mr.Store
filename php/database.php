<?php
include "./config.php";
$conexion = mysqli_connect("localhost", "root", "", BD);
if ($conexion) {
    // echo 'Conexion Exitosa';
    // exit();
}else{
    // echo 'Conexión Fallida';
}
?>