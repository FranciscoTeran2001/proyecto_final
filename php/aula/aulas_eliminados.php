<?php
include("../conexion.php");

// Consultar aulas con estado igual a 0 (eliminadas)
$sql = "SELECT id_aula, nombre_aula, capacidad_aula, bloque_aula FROM aula WHERE estado_aula = 0 ORDER BY id_aula ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aulas Eliminadas</title>
</head>
<body>
<?php include('../pagina/header.php'); ?>
    <div class="container">
        <div class="content">
            <h2>Aulas Eliminadas</h2>
            <hr />

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID Aula</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Bloque</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(mysqli_num_rows($result) == 0){
                        echo '<tr><td colspan="5">No hay datos.</td></tr>';
                    }else{
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<tr>';
                            echo '<td>'.$row['id_aula'].'</td>';
                            echo '<td>'.$row['nombre_aula'].'</td>';
                            echo '<td>'.$row['capacidad_aula'].'</td>';
                            echo '<td>'.$row['bloque_aula'].'</td>';
                            echo '<td><a href="restaurar_aula.php?id='.$row['id_aula'].'" class="btn btn-success btn-sm">Restaurar</a></td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include('../pagina/footer.php'); ?>