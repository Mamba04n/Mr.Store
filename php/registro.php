<?php
include "./config.php";
$conexion = new mysqli("localhost", "root", "", BD);

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

// Verificar si los datos fueron enviados correctamente
if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['usuario']) && isset($_POST['psw']) && isset($_POST['cedula']) && isset($_POST['direccion'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $psw = $_POST['psw'];
    $cedula = $_POST['cedula'];
    $direccion = $_POST['direccion'];

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre_Completo, email, username, contraseña, cedula, ultimo_Acceso) 
    VALUES (?, ?, ?, ?, ?, ?)");
    $fecha = date("Y-m-d H:i:s");
    $stmt->bind_param("ssssss", $nombre, $correo, $usuario, $psw, $cedula, $fecha);

    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$correo'");
    if (mysqli_num_rows($verificar_correo) > 0) {
        echo '
            <script>
                alert("Este correo ya esta registrado, intenta con otro");
                window.location = "../signup.php";
            </script>;  
        ';
        exit();
    }

    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE username = '$usuario'");
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
        $idInsertado = $stmt -> insert_id;
        $insertCliente = $conexion -> prepare("INSERT INTO clientes (id_Usuario, direccion) VALUES (?,?)");
        $insertCliente -> bind_param("ss",$idInsertado, $direccion);
        $insertCliente ->execute();
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
    header("refresh:3;url=../signup.php");
}

$conexion->close();
