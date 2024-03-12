<?php
include("conexion.php");

// Consulta para obtener las novedades con estado 1 y los nombres de usuario
$sql_novedades = "SELECT rn.id_novedad, rn.descripcion_novedad, rn.fecha_creacion_novedad, rn.fecha_edicion_novedad, rn.id_usuario, a.nombre_aula, u.nombre_usuario
                FROM registro_novedades rn
                INNER JOIN aula a ON rn.id_aula = a.id_aula
                INNER JOIN usuario u ON rn.id_usuario = u.id_usuario
                WHERE rn.estado_novedad = 1";
$result_novedades = mysqli_query($conn, $sql_novedades);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Novedades</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_nav.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php include('nav.php');?>
    </nav>
    <div class="container">
        <h2>Visualizar Novedades</h2>
        <hr />

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Edición</th>
                    <th>Usuario</th>
                    <th>Aula</th>
                    <th>Acción</th> <!-- Nuevo encabezado para la columna de acción -->
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result_novedades)) {
                    echo "<tr>";
                    echo "<td>{$row['id_novedad']}</td>";
                    echo "<td>{$row['descripcion_novedad']}</td>";
                    echo "<td>{$row['fecha_creacion_novedad']}</td>";
                    echo "<td>{$row['fecha_edicion_novedad']}</td>";
                    echo "<td>{$row['nombre_usuario']}</td>"; // Mostrar el nombre de usuario en lugar del ID
                    echo "<td>{$row['nombre_aula']}</td>";
                    // Agregar un enlace para editar la novedad
                    echo "<td><a href='editar_novedad.php?id={$row['id_novedad']}' class='btn btn-primary'>Editar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

