<?php
include("../conexion.php");

// Consulta para obtener la lista de materias con el nombre de la carrera y estado igual a 1
$sql = "SELECT m.id_materia, m.nombre_materia, m.codigo_materia, m.creditos_materia, m.horas_materias, m.id_carrera, c.nombre_carrera
        FROM materia m
        INNER JOIN carrera c ON m.id_carrera = c.id_carrera
        WHERE m.estado_materia = 1
        ORDER BY m.id_materia ASC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ver Materias</title>
</head>

<?php include('../pagina/header.php'); ?>

<div class="col py-3">  
    <div class="container">
        <h2>Lista de Materias</h2>
        <hr />

        <table class="table table-striped table-hover">
            <tr>
                <th>Nombre Materia</th>
                <th>Código</th>
                <th>Créditos</th>
                <th>Horas Materias</th>
                <th>Carrera</th>
                <th>Acciones</th>
            </tr>
            <?php
            if(mysqli_num_rows($result) == 0){
                echo '<tr><td colspan="6">No hay datos.</td></tr>';
            }else{
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                    <tr>
                        <td>'.$row['nombre_materia'].'</td>
                        <td>'.$row['codigo_materia'].'</td>
                        <td>'.$row['creditos_materia'].'</td>
                        <td>'.$row['horas_materias'].'</td>
                        <td>'.$row['nombre_carrera'].'</td>
                        <td>
                        <a data-url = "editar_materia.php ? id=' . $row['id_materia'] . '" class="btn btn-primary btn-sm load-modal-content" data-bs-toggle="modal" data-bs-target="#forModal">Actualizar</a>
                            <a href="eliminar_materia.php?id='.$row['id_materia'].'" class="btn btn-danger">Eliminar</a>
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


