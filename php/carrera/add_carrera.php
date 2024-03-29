<?php
include("../conexion.php");

if (isset($_POST['add'])) {
    $nombre_carrera = mysqli_real_escape_string($conn, $_POST["nombre_carrera"]);
    $estado_carrera = 1; // Asignar estado automáticamente como 1

    // Verificar si la carrera ya está registrada
    $query = "SELECT * FROM `carrera` WHERE `nombre_carrera` = '$nombre_carrera'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        $insert = mysqli_query($conn, "INSERT INTO `carrera`(`nombre_carrera`, `estado_carrera`) VALUES ('$nombre_carrera', '$estado_carrera')");

        if ($insert) {
            echo '<br><br><br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>¡La carrera se ha agregado correctamente!</div>';
        } else {
            echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo agregar la carrera.</div>';
        }
    } else {
        echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>La carrera ya está registrada.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Registro de Carrera</title>
</head>

<body>
    <div class="container">
        <div class="content">
            <h2>Datos de la carrera &raquo; Agregar datos</h2>
            <hr />

            <form class="form-horizontal" action="" method="post" onsubmit="return validateFormAddCarrera()">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre de la Carrera</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre_carrera" class="form-control" placeholder="Nombre de la Carrera"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
                        <a href="ver_carreras.php" class="btn btn-sm btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validateFormAddCarrera() {
            var nombreCarrera = document.getElementsByName("nombre_carrera")[0].value.trim();

            if (nombreCarrera === "") {
                alert("Por favor, ingrese el nombre de la carrera.");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>
