<?php
include("../conexion.php");

// Consultar usuarios con estado igual a 1
$sql = "SELECT id_usuario, nombre_usuario, usuario_usuario FROM usuario WHERE estado_usuario = 1";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>

<?php include('../pagina/header.php'); ?>

<div class="col py-3">
        <h2>Lista de Usuarios</h2>
        <hr />

        <table class="table table-striped table-hover">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) == 0) {
                echo '<tr><td colspan="4">No hay datos.</td></tr>';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '
                        <tr>
                            <td>' . $row['id_usuario'] . '</td>
                            <td>' . $row['nombre_usuario'] . '</td>
                            <td>' . $row['usuario_usuario'] . '</td>
                            <td>
                                <a data-url = "editar_usuario.php ? id=' . $row['id_usuario'] . '" class="btn btn-primary btn-sm load-modal-content" data-bs-toggle="modal" data-bs-target="#forModal">Actualizar</a>
                                <a href="eliminar_usuario.php?id=' . $row['id_usuario'] . '" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                        ';
                }
            }
            ?>
        </table>
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