<?php
include("conexion.php");

// Consultar los datos de la tabla franja_horaria
$sql = "SELECT * FROM franja_horaria";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ver Franja Horaria</title>
    <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <nav >
        <?php include('nav.php');?>
    </nav>
    <div class="container">
        <h2>Franja Horaria</h2>
        <hr />

        <!-- Mostrar mensaje de éxito o error -->
        <?php if (isset($message)) { ?>
            <div class="alert alert-<?php echo $message['type']; ?>">
                <?php echo $message['content']; ?>
            </div>
        <?php } ?>

        <!-- Tabla de franja horaria -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["id_fh"] . "</td>";
                        echo "<td>" . $row["hora_fh"] . "</td>";
                        echo "<td>" . $row["estado_fh"] . "</td>";
                        echo "<td><a href='editar_franjaD.php?id=" . $row["id_fh"] . "' class='btn btn-primary btn-sm'>Editar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay datos</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
