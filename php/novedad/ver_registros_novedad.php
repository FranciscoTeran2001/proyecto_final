<?php
include("../conexion.php");

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
</head>
<?php include('../pagina/header.php'); ?>
<div class="col py-3">
    <div class="container">
        <h2>Visualizar Novedades</h2>
        <hr/>
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
                    echo '<td><a data-url="editar_novedad.php?id= '.$row['id_novedad'].'"class="btn btn-primary btn-sm load-modal-content" data-bs-toggle="modal" data-bs-target="#forModal">Editar</a>
                    <a href="eliminar_novedad.php?id='.$row['id_novedad'].' "class="btn btn-danger btn-sm" >eliminar</a>
                    </td>";
                    echo "</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Estructura del Modal -->
<div class="modal fade" id="forModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <?php include('../pagina/footer.php'); ?>


