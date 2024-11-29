<?php
include 'database.php';

// Verificar si los datos fueron enviados correctamente
if (isset($_POST['usuario']) && isset($_POST['psw'])) {
    $usuario = $_POST['usuario'];
    $psw = $_POST['psw'];

    /* Imprimir los valores para depuración
    echo "Usuario: $usuario\n";
    echo "Contraseña: $psw\n";
    */
    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' AND psw='$psw'");

    if (mysqli_num_rows($validar_login) > 0) {
        header("refresh:0;url=../index.php");   
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
?>