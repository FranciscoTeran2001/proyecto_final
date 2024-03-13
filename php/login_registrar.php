<?php

include('conexion.php');

$nombre = $_POST["txtnombre"];
$usuario = $_POST["txtusuario"];
$pass = $_POST["txtpassword"];

//Para iniciar sesión
if(isset($_POST["btnloginx"]))
{

    $queryusuario = mysqli_query($conn,"SELECT * FROM usuario WHERE usuario_usuario = '$usuario'");
    $nr = mysqli_num_rows($queryusuario); 
    $mostrar = mysqli_fetch_array($queryusuario); 
    
    if (($nr == 1) && (password_verify($pass,$mostrar['clave_usuario'])) )
    { 
        session_start();
        $_SESSION['nombredelusuario']=$usuario;
        header("Location: principal.php");
    }
    else
    {
    echo "<script> alert('Usuario o contraseña incorrecto.');window.location= '../index.html' </script>";
    }
}

//Para registrar
if(isset($_POST["btnregistrarx"]))
{
    $pass_fuerte = password_hash($pass, PASSWORD_BCRYPT);
    $queryregistrar = "INSERT INTO usuario (nombre_usuario, usuario_usuario, clave_usuario, estado_usuario) VALUES ('$nombre', '$usuario', '$pass_fuerte', 1)";

    if(mysqli_query($conn, $queryregistrar))
    {
     
       header("Location: ver_usuarios.php");
    }
    else 
    {
        echo "<script> alert('Error al registrar');window.location= 'principal.php' </script>";
    }
}

/*VaidrollTeam*/
?>



