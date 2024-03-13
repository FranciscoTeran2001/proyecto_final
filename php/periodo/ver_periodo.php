<?php
include("../conexion.php");

// Consulta para obtener los periodos activos
$sql = "SELECT id_periodo, fecha_inicio, fecha_final FROM periodo WHERE estado_periodo = 1";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Periodos</title>
</head>
<body>
<?php include('../pagina/header.php'); ?>

<div class="col py-3">  
    <div class="container">
        <h2>Visualizar Periodos</h2>
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
                echo '<tr><td colspan="4">No hay periodos activos.</td></tr>';
            }else{
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                    <tr>
                        <td>'.$row['id_periodo'].'</td>
                        <td>'.$row['fecha_inicio'].'</td>
                        <td>'.$row['fecha_final'].'</td>
                        <td>
                            <a href="editar_periodo.php?id='.$row['id_periodo'].'" class="btn btn-primary btn-sm">Editar</a>
                        </td>
                    </tr>
                    ';
                }
            }
            ?>
        </table>
    </div>

<?php include('../pagina/footer.php'); ?>
