<?php
include("../conexion.php");

// Consulta para obtener las novedades eliminadas
$sql_novedades_eliminadas = "SELECT rn.id_novedad, rn.descripcion_novedad, rn.fecha_creacion_novedad, rn.fecha_edicion_novedad, rn.id_usuario, a.nombre_aula, u.nombre_usuario
                FROM registro_novedades rn
                INNER JOIN aula a ON rn.id_aula = a.id_aula
                INNER JOIN usuario u ON rn.id_usuario = u.id_usuario
                WHERE rn.estado_novedad = 0";
$result_novedades_eliminadas = mysqli_query($conn, $sql_novedades_eliminadas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novedades Eliminadas</title>
</head>
<?php include('../pagina/header.php'); ?>
<div class="col py-3">
    <div class="container">
        <h2>Novedades Eliminadas</h2>
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
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result_novedades_eliminadas)) {
                    echo "<tr>";
                    echo "<td>{$row['id_novedad']}</td>";
                    echo "<td>{$row['descripcion_novedad']}</td>";
                    echo "<td>{$row['fecha_creacion_novedad']}</td>";
                    echo "<td>{$row['fecha_edicion_novedad']}</td>";
                    echo "<td>{$row['nombre_usuario']}</td>"; 
                    echo "<td>{$row['nombre_aula']}</td>";
                    echo "<td>
                            <a href='restaurar_novedades.php?id={$row['id_novedad']}' class='btn btn-success btn-sm'>Restaurar</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include('../pagina/footer.php'); ?>
