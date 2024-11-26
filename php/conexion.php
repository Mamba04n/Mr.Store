<?php
include 'config.php';

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try {
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(1002 => "SET NAMES utf8"));
    
  // echo "<script>alert('Conexión exitosa');</script>";
} catch (PDOException $e) {
    // echo "<script>alert('Error al conectar: " . $e->getMessage() . "');</script>";
    exit();
}
?>