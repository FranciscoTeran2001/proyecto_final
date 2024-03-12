
<?php
session_start();
if (!isset($_SESSION['nombredelusuario'])) {
    header('location: ../index.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.84.0" />
    <title>Dashboard Template · Bootstrap v5.0</title>

</head>
<body>
<h2>Registro de Usuarios</h2>
    <form id="frmregistrar" class="grupo-entradas" method="POST" action="login_registrar.php">
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Nombre" required name="txtnombre">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control"  placeholder="&#128273; Ingresar usuario" required name="txtusuario">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" placeholder="&#128274; Ingresar contraseña" required name="txtpassword">
        </div>
        <button type="submit" class="btn btn-primary" name="btnregistrarx">Registrar</button>
    </form>
</body>

</html>