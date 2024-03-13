<?php
include("../conexion.php");

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
</head>
<?php include('../pagina/header.php'); ?>

<div class="col py-3">
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
                        
                        echo '<td>
                                    <a data-url= "actualizar_perfil.php?id=' . $row['id_perfil'] . '"class="btn btn-primary btn-sm load-modal-content" data-bs-toggle="modal" data-bs-target="#forModal">Actualizar</a>
                                    <a href="eliminar_perfil.php?id=' . $row['id_perfil'] . '" class="btn btn-danger btn-sm">Eliminar</a>
                                </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay perfiles disponibles.</td></tr>";
                }
                ?>
            </tbody>
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
</div>

    <?php include('../pagina/footer.php'); ?>
