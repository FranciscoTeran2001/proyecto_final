<?php
include("../conexion.php");

// Consulta para obtener las materias eliminadas con el nombre de la carrera
$sql_eliminadas = "SELECT m.id_materia, m.nombre_materia, m.codigo_materia, m.creditos_materia, m.horas_materias, m.id_carrera, c.nombre_carrera
        FROM materia m
        INNER JOIN carrera c ON m.id_carrera = c.id_carrera
        WHERE m.estado_materia = 0
        ORDER BY m.id_materia ASC";

$result_eliminadas = mysqli_query($conn, $sql_eliminadas);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Materias Eliminadas</title>
</head>

<?php include('../pagina/header.php'); ?>

<div class="col py-3">  
    <div class="container">
        <h2>Lista de Materias Eliminadas</h2>
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
            if(mysqli_num_rows($result_eliminadas) == 0){
                echo '<tr><td colspan="6">No hay datos.</td></tr>';
            }else{
                while($row = mysqli_fetch_assoc($result_eliminadas)){
                    echo '
                    <tr>
                        <td>'.$row['nombre_materia'].'</td>
                        <td>'.$row['codigo_materia'].'</td>
                        <td>'.$row['creditos_materia'].'</td>
                        <td>'.$row['horas_materias'].'</td>
                        <td>'.$row['nombre_carrera'].'</td>
                        <td>
                            <a href="restaurar_materia.php?id='.$row['id_materia'].'" class="btn btn-success">Restaurar</a>
                        </td>
                    </tr>
                    ';
                }
            }
            ?>
        </table>
    </div>

    <?php include('../pagina/footer.php'); ?>
