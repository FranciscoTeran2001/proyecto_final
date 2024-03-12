<?php
include("conexion.php");

// Consulta para obtener los NRCs con el nombre de la materia, nombre de la carrera y nombre del docente
$sql = "SELECT n.id_nrc, n.codigo_nrc, m.nombre_materia, c.nombre_carrera, d.nombre_docente, d.estado_docente
        FROM nrc n 
        INNER JOIN materia m ON n.id_materia = m.id_materia 
        INNER JOIN carrera c ON m.id_carrera = c.id_carrera 
        INNER JOIN docente d ON n.id_docente = d.id_docente 
        WHERE n.estado_nrc = 1";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar NRC</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_nav.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php include('nav.php');?>
    </nav>
    <div class="container">
        <h2>Visualizar NRC</h2>
        <hr />

        <table class="table table-striped table-hover">
            <tr>
                <th>Código NRC</th>
                <th>Materia</th>
                <th>Carrera</th>
                <th>Docente</th>
                <th>Acción</th>
            </tr>
            <?php
            if(mysqli_num_rows($result) == 0){
                echo '<tr><td colspan="5">No hay datos.</td></tr>';
            }else{
                while($row = mysqli_fetch_assoc($result)){
                    echo '<tr>';
                    echo '<td>'.$row['codigo_nrc'].'</td>';
                    echo '<td>'.$row['nombre_materia'].'</td>';
                    echo '<td>'.$row['nombre_carrera'].'</td>';
                    // Verificar si el docente está en estado 1 para mostrar su nombre
                    if($row['estado_docente'] == 1) {
                        echo '<td>'.$row['nombre_docente'].'</td>';
                    } else {
                        echo '<td>Docente no disponible</td>';
                    }
                    echo '<td><a href="editar_nrc.php?id='.$row['id_nrc'].'" class="btn btn-primary btn-sm">Editar</a></td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

