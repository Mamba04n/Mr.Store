<?php
// include 'database.php';
include "conexion.php";
session_start();
// Verificar si los datos fueron enviados correctamente
if (isset($_POST['usuario']) && isset($_POST['psw'])) {
    $usuario = $_POST['usuario'];
    $psw = $_POST['psw'];

    // Imprimir los valores para depuración
    // echo "Usuario: $usuario\n";
    // echo "Contraseña: $psw\n";

    // $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE username='$usuario' AND contraseña='$psw'");
    $validar_login = $pdo->prepare("SELECT * FROM usuarios WHERE username=:user AND contraseña=:psw");
    $validar_login->bindParam(":user", $usuario, PDO::PARAM_STR);
    $validar_login->bindParam(":psw", $psw, PDO::PARAM_STR);
    $validar_login->execute();
    $resultado = $validar_login->fetch(PDO::FETCH_ASSOC);

    if (count($resultado) > 0) {
        header("refresh:0;url=../index.php");
        $_SESSION['Cuenta'] = $resultado['id_Usuario'];
        exit();
    } else {
        echo '
            <script>
                alert("Usuario o contraseña incorrectos");
                window.location = "../login.php";
            </script>;  
        ';
        exit();
    }
} else {
    // Mensajes de depuración adicionales
    if (!isset($_POST['usuario'])) {
        echo 'Error: Usuario no enviado';
    }
    if (!isset($_POST['psw'])) {
        echo 'Error: Contraseña no enviada';
    }
    header("refresh:3;url=../login.php");
    exit();
}
