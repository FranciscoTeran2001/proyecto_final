<?php
include("../conexion.php");

if(isset($_POST['add'])){
    // Verificar si se han proporcionado las fechas de inicio y finalización
    if(empty($_POST["fecha_inicio"]) || empty($_POST["fecha_final"])) {
        // Mostrar un mensaje de error si falta alguna fecha
        echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. Debe ingresar la fecha de inicio y la fecha final.</div>';
        exit(); // Detener la ejecución del script
    }

    // Obtener las fechas del formulario
    $fecha_inicio = mysqli_real_escape_string($conn, $_POST["fecha_inicio"]);
    $fecha_final = mysqli_real_escape_string($conn, $_POST["fecha_final"]);

    // Verificar si la fecha de inicio es anterior a la fecha final
    if(strtotime($fecha_inicio) >= strtotime($fecha_final)) {
        // Mostrar un mensaje de error si la fecha de inicio es mayor o igual que la fecha final
        echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. La fecha de inicio debe ser anterior a la fecha final.</div>';
        exit(); // Detener la ejecución del script
    }

    $estado_periodo = 1; // Asignar estado automáticamente como 1
    
    // Insertar el período en la base de datos
    $insert = mysqli_query($conn, "INSERT INTO `periodo`(`fecha_inicio`, `fecha_final`, `estado_periodo`)
                    VALUES('$fecha_inicio', '$fecha_final', '$estado_periodo')");

    if($insert){
        echo '<br><br><br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>¡El periodo se ha guardado con éxito!</div>';
    }else{
        echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar el periodo.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Registro de Periodo</title>
</head>
<body>

    <div class="container">
        <div class="content">
            <h2>Datos del Periodo &raquo; Agregar datos</h2>
            <hr />

            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Fecha de Inicio</label>
                    <div class="col-sm-4">
                        <input type="date" name="fecha_inicio" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Fecha Final</label>
                    <div class="col-sm-4">
                        <input type="date" name="fecha_final" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
                        <a href="ver_periodo.php" class="btn btn-sm btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $('.date').datepicker({
            format: 'dd-mm-yyyy',
        })
    </script>
</body>
</html>
