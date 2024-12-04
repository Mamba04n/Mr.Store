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
        $admin = $pdo->prepare("SELECT * FROM administradores WHERE id_Usuario = :id");
        $admin -> bindParam(":id", $resultado['id_Usuario'], PDO::PARAM_STR);
        $admin -> execute();
        $adminResultado = $admin -> fetch(PDO::FETCH_ASSOC);
        $_SESSION['Cuenta'] = $resultado['id_Usuario'];

        if($adminResultado){
            $_SESSION['admin'] = true;
        }
        else{
            $_SESSION['admin'] = false;
        }

        $obtenerIdCarrito = $pdo -> prepare("SELECT a.id_Carrito FROM carritos_compras a JOIN clientes b on a.id_Cliente = b.id_Cliente 
                                            JOIN usuarios c on b.id_Usuario = c.id_Usuario WHERE c.id_Usuario = :id");
        $iduser = $resultado['id_Usuario'];
        $obtenerIdCarrito -> bindParam(':id',$iduser, PDO::PARAM_INT);
        $obtenerIdCarrito ->execute();
        $resultadoCarrito = $obtenerIdCarrito -> fetch(PDO::FETCH_ASSOC);
        $_SESSION['Carrito'] = $resultadoCarrito['id_Carrito'];

        $Carrito = $pdo->prepare("SELECT * FROM detcarritos_compras where id_Carrito = :carrito");
        $Carrito->bindParam(':carrito', $resultadoCarrito['id_Carrito'], PDO::PARAM_STR);
        $Carrito->execute();
        $productos = $Carrito->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['ElemCarrito'] = count($productos);
        header("refresh:0;url=../index.php");
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
