<?php
include("../conexion.php");

$sql_perfiles_eliminados = "SELECT p.id_perfil, p.tipo_perfil, p.atributos_perfil, p.id_usuario, u.nombre_usuario
                            FROM perfil p
                            INNER JOIN usuario u ON p.id_usuario = u.id_usuario
                            WHERE p.estado_perfil = 0"; // Cambio aquí para seleccionar perfiles eliminados
$result_perfiles_eliminados = mysqli_query($conn, $sql_perfiles_eliminados);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Perfiles Eliminados</title>
</head>

<?php include('../pagina/header.php'); ?>

<div class="col py-3">
    <div class="container">
        <h2>Perfiles Eliminados</h2>
        <hr />

        <!-- Tabla de perfiles eliminados -->
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
                if (mysqli_num_rows($result_perfiles_eliminados) > 0) {
                    while ($row = mysqli_fetch_assoc($result_perfiles_eliminados)) {
                        echo "<tr>";
                        echo "<td>" . $row["id_perfil"] . "</td>";
                        echo "<td>" . $row["tipo_perfil"] . "</td>";
                        echo "<td>" . $row["atributos_perfil"] . "</td>";
                        echo "<td>" . $row["nombre_usuario"] . "</td>";
                        
                        // Botón para restaurar el perfil
                        echo "<td>
                              <a href='restaurar_perfil.php?id=" . $row["id_perfil"] . "' class='btn btn-success btn-sm'>Restaurar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay perfiles eliminados.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('../pagina/footer.php'); ?>
