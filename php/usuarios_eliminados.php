<?php
include("conexion.php");

// Consultar usuarios con estado igual a 0 (eliminados)
$sql = "SELECT id_usuario, nombre_usuario, usuario_usuario FROM usuario WHERE estado_usuario = 0";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Eliminados</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_nav.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php include('nav.php');?>
    </nav>
    <div class="container">
        <div class="content">
            <h2>Usuarios Eliminados</h2>
            <hr />

            <table class="table table-striped table-hover">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
                <?php
                if(mysqli_num_rows($result) == 0){
                    echo '<tr><td colspan="4">No hay datos.</td></tr>';
                }else{
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
                        <tr>
                            <td>'.$row['id_usuario'].'</td>
                            <td>'.$row['nombre_usuario'].'</td>
                            <td>'.$row['usuario_usuario'].'</td>
                            <td>
                                <a href="restaurar_usuario.php?id='.$row['id_usuario'].'" class="btn btn-success btn-sm">Restaurar</a>
                             
                            </td>
                        </tr>
                        ';
                    }
                }
                ?>
            </table>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
