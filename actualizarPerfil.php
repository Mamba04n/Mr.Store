<?php
include "./php/conexion.php";

if (isset($_POST['nombre']) && isset($_POST['cedula']) && isset($_POST['correo']) && isset($_POST['id']) &&
    isset($_POST['usuario']) &&  isset($_POST['psw']) && isset($_POST['direccion'])) {
    $nombre = $_POST['nombre'];
    $cedula = $_POST['cedula'];
    $email = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $contraseña =$_POST['psw'];
    $direccion = $_POST['direccion'];
    $id = $_POST['id'];

    $updateUsuario = $pdo -> prepare("UPDATE usuarios SET nombre_Completo = :nombre, cedula = :cedula, email = :email,
     username = :usuario, contraseña = :psw WHERE id_Usuario = :id" );
    $updateUsuario -> bindParam(":nombre", $nombre);
    $updateUsuario -> bindParam(":cedula",$cedula);
    $updateUsuario -> bindParam(":email", $email);
    $updateUsuario -> bindParam(":usuario", $usuario);
    $updateUsuario -> bindParam(":psw", $contraseña);
    $updateUsuario -> bindParam(":id", $id );
    $updateUsuario -> execute();

    $updateCliente = $pdo -> prepare("UPDATE clientes set direccion = :direccion WHERE id_Usuario = :id");
    $updateCliente -> bindParam(":direccion", $direccion);
    $updateCliente -> bindParam(":id", $id);
    $updateCliente -> execute();

    if($updateCliente -> rowCount() > 0 || $updateUsuario -> rowCount() > 0){
        echo '
            <script>
                alert("Perfil actualizado con exito");
                window.location = "perfil.php";
            </script>;  
        ';
    }
} else{
    echo '
            <script>
                alert("Error");
                window.location = "perfil.php";
            </script>;  
        ';
}

