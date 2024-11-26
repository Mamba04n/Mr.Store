<?php
$conexion = new mysqli("localhost", "root", "", "mrstore");

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

// Verificar si los datos fueron enviados correctamente
if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['usuario']) && isset($_POST['psw'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $psw = $_POST['psw'];

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_completo, correo, usuario, psw) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $correo, $usuario, $psw);

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo'");
    if (mysqli_num_rows($verificar_correo) > 0) {
        echo '
            <script>
                alert("Este correo ya esta registrado, intenta con otro");
                window.location = "../signup.php";
            </script>;  
        ';
        exit();
    }

    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    if (mysqli_num_rows($verificar_usuario) > 0) {
        echo '
            <script>
                alert("Este usuario ya esta registrado, intenta con otro");
                window.location = "../signup.php";
            </script>;  
        ';
        exit();
    }
    
    if ($stmt->execute()) {
        echo '
            <script>
                alert("Usuario registrado correctamente");
                window.location = "../login.php";
            </script>;  
        ';     
    } else {
        echo '
            <script>
                alert("Error al registrar el usuario");
                window.location = "../signup.php";
            </script>;  
        ';
    }

    $stmt->close();
} else {
    // Mensajes de depuración adicionales
    if (!isset($_POST['nombre'])) {
        echo 'Error: Nombre no enviado';
    }
    if (!isset($_POST['correo'])) {
        echo 'Error: Correo no enviado';
    }
    if (!isset($_POST['usuario'])) {
        echo 'Error: Usuario no enviado';
    }
    if (!isset($_POST['psw'])) {
        echo 'Error: Contraseña no enviada';
    }
    header("refresh:3;url=signup.php");
}

$conexion->close();
?>