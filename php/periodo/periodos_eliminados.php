<?php
include("../conexion.php");

// Consulta para obtener los períodos eliminados (estado_periodo = 0)
$sql = "SELECT id_periodo, fecha_inicio, fecha_final FROM periodo WHERE estado_periodo = 0";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Periodos Eliminados</title>
</head>

<?php include('../pagina/header.php'); ?>

<div class="col py-3">  
    <div class="container">
        <h2>Visualizar Períodos Eliminados</h2>
        <hr />

        <table class="table table-striped table-hover">
            <tr>
                <th>ID Periodo</th>
                <th>Fecha de Inicio</th>
                <th>Fecha Final</th>
                <th>Acción</th>
            </tr>
            <?php
            if(mysqli_num_rows($result) == 0){
                echo '<tr><td colspan="4">No hay períodos eliminados.</td></tr>';
            }else{
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                    <tr>
                        <td>'.$row['id_periodo'].'</td>
                        <td>'.$row['fecha_inicio'].'</td>
                        <td>'.$row['fecha_final'].'</td>
                        <td>
                            <a href="restaurar_periodo.php?id='.$row['id_periodo'].'" class="btn btn-success">Restaurar</a>
                        </td>
                    </tr>';
                }
            }
            ?>
        </table>
    </div>
</div>
<?php include('../pagina/footer.php'); ?>