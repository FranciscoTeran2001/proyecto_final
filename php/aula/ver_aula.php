<?php
include("../conexion.php");

// Consultar aulas con estado igual a 1 (activas)
$sql = "SELECT id_aula, nombre_aula, capacidad_aula, bloque_aula FROM aula WHERE estado_aula = 1 ORDER BY id_aula ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Aulas</title>
</head>
<?php include('../pagina/header.php'); ?>
<div class="col py-3">
    <div class="container">
        <div class="content">
            <h2>Lista de Aulas</h2>
            <hr />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Aula</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Bloque</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) == 0) {
                        echo '<tr><td colspan="5">No hay datos.</td></tr>';
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['id_aula'] . '</td>';
                            echo '<td>' . $row['nombre_aula'] . '</td>';
                            echo '<td>' . $row['capacidad_aula'] . '</td>';
                            echo '<td>' . $row['bloque_aula'] . '</td>';
                            echo '<td>
                            <a data-url = "editar_aula.php ? id=' . $row['id_aula'] . '" class="btn btn-primary btn-sm load-modal-content" data-bs-toggle="modal" data-bs-target="#forModal">Actualizar</a>
                            <a href="eliminar_aula.php?id=' . $row['id_aula'] . '" class="btn btn-danger btn-sm">Eliminar</a>
                                 </td>';
                            echo '</tr>';
                        }
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