<?php
include("../conexion.php");

// Consulta para obtener las carreras eliminadas
$sql = "SELECT id_carrera, nombre_carrera FROM carrera WHERE estado_carrera = 0";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carreras Eliminadas</title>
</head>
<body>
<?php include('../pagina/header.php'); ?>
<div class="col py-3">
    <div class="container">
        <h2>Carreras Eliminadas</h2>
        <hr />

        <table class="table table-striped table-hover">
            <tr>
                <th>ID Carrera</th>
                <th>Nombre Carrera</th>
                <th>Acciones</th>
            </tr>
            <?php
            if(mysqli_num_rows($result) == 0){
                echo '<tr><td colspan="3">No hay carreras eliminadas.</td></tr>';
            }else{
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                    <tr>
                        <td>'.$row['id_carrera'].'</td>
                        <td>'.$row['nombre_carrera'].'</td>
                        <td>
                            <a href="restaurar_carrera.php?id='.$row['id_carrera'].'" class="btn btn-success btn-sm">Restaurar</a>
                        </td>
                    </tr>
                    ';
                }
            }
            ?>
        </table>
    </div>
<?php include('../pagina/footer.php'); ?>  
