<?php
include("conexion.php");

// Consultar los perfiles con estado 1
$sql_perfiles = "SELECT p.id_perfil, p.tipo_perfil, p.atributos_perfil, p.id_usuario, u.nombre_usuario
                FROM perfil p
                INNER JOIN usuario u ON p.id_usuario = u.id_usuario
                WHERE p.estado_perfil = 1";
$result_perfiles = mysqli_query($conn, $sql_perfiles);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Perfiles</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_nav.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php include('nav.php');?>
    </nav>
    <div class="container">
        <h2>Perfiles</h2>
        <hr />

        <!-- Tabla de perfiles -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID de Perfil</th>
                    <th>Tipo de Perfil</th>
                    <th>Atributos de Perfil</th>
                    <th>Nombre de Usuario</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result_perfiles) > 0) {
                    while ($row = mysqli_fetch_assoc($result_perfiles)) {
                        echo "<tr>";
                        echo "<td>" . $row["id_perfil"] . "</td>";
                        echo "<td>" . $row["tipo_perfil"] . "</td>";
                        echo "<td>" . $row["atributos_perfil"] . "</td>";
                        echo "<td>" . $row["nombre_usuario"] . "</td>";
                        echo "<td><a href='actualizar_perfil.php?id=" . $row["id_perfil"] . "' class='btn btn-primary btn-sm'>Actualizar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay perfiles disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

