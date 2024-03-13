<?php
include("conexion.php");

// Consultar todos los registros de la tabla franja_dias
$sql = "SELECT * FROM franja_dias";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ver Franja de Días</title>
    <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <nav >
        <?php include('nav.php');?>
    </nav>
    <div class="container">
        <h2>Franja de Días</h2>
        <hr />

        <!-- Tabla para mostrar la franja de días -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Día</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar cada registro de la tabla franja_dias en filas de la tabla
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id_fd']}</td>";
                    echo "<td>{$row['dia_fd']}</td>";
                    echo "<td>{$row['estado_fd']}</td>";
                    echo "<td><a href='editar_dia.php?id={$row['id_fd']}' class='btn btn-primary'>Editar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
