<?php
include("../conexion.php");

// Consulta para obtener los docentes eliminados
$sql = "SELECT * FROM docente WHERE estado_docente = 0 ORDER BY id_docente";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Docentes Eliminados</title>
</head>
<?php include('../pagina/header.php'); ?>
<div class="col py-3">
    <div class="container">
        <h2>Docentes Eliminados</h2>
        <hr />

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
            if(mysqli_num_rows($result) == 0){
                echo '<tr><td colspan="8">No hay docentes eliminados.</td></tr>';
            }else{
                $no = 1;
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                    <tr>
                        <td>'.$no.'</td>
                        <td>'.$row['nombre_docente'].'</td>
                        <td>'.$row['cedula_docente'].'</td>
                        <td>'.$row['correo_docente'].'</td>
                        <td>'.$row['telefono_docente'].'</td>
                        <td>'.$row['especializacion_docente'].'</td>
                        <td>'.$row['horas_clase_docente'].'</td>
                        <td>
                            <a href="restaurar_docente.php?id='.$row['id_docente'].'" class="btn btn-success btn-sm">Restaurar</a>
                        </td>
                    </tr>
                    ';
                    $no++;
                }
            }
            ?>
        </table>
    </div>
<?php include('../pagina/footer.php'); ?>  
