<?php
include("../conexion.php");

//filtrar solo los que tengan estado 1 y mostrar
$sql = "SELECT * FROM docente WHERE estado_docente=1 ORDER BY id_docente";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Docentes</title>
</head>
<?php include('../pagina/header.php'); ?>

<div class="col py-3">
    <form method="POST">
    </form>
    <h2>Lista de docentes</h2>
    <hr />
    <div class="col-sm-6">
        <a data-url = "add_docente.php  " class="btn btn-primary btn-sm load-modal-content" data-bs-toggle="modal" data-bs-target="#forModal" >
            <i class="material-icons ">&#xE147;</i><span>Añadir Nuevo Docente</span></a>
    </div>
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Cédula de Identidad</th>
            <th>Correo Electrónico</th>
            <th>Teléfono</th>
            <th>Área de Especialización</th>
            <th>Horas de Clases</th>
            <th>Acciones</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) == 0) {
            echo '<tr><td colspan="8">No hay datos.</td></tr>';
        } else {
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                        <tr>
                            <td>' . $no . '</td>
                            <td>' . $row['nombre_docente'] . '</td>
                            <td>' . $row['cedula_docente'] . '</td>
                            <td>' . $row['correo_docente'] . '</td>
                            <td>' . $row['telefono_docente'] . '</td>
                            <td>' . $row['especializacion_docente'] . '</td>
                            <td>' . $row['horas_clase_docente'] . '</td>
                            <td>
                            <a data-url = "editar_docente.php ? id=' . $row['id_docente'] . '" class="btn btn-primary btn-sm load-modal-content" data-bs-toggle="modal" data-bs-target="#forModal">Actualizar</a>
                                <a href="eliminar_docente.php?id='. $row['id_docente'] . '" class="btn btn-danger btn-sm">Eliminar</a> </td>
                        </tr>
                        ';
                $no++;
            }
        }
        ?>
    </table>

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