<?php
include("../conexion.php");

// Consulta para obtener los nombres de las carreras
$query_nombres_carreras = "SELECT id_carrera, nombre_carrera FROM carrera";
$resultado_nombres_carreras = mysqli_query($conn, $query_nombres_carreras);

if(isset($_POST['add'])){
    $nombre_materia = mysqli_real_escape_string($conn, $_POST["nombre_materia"]);
    $codigo_materia = mysqli_real_escape_string($conn, $_POST["codigo_materia"]);
    $creditos_materia = mysqli_real_escape_string($conn, $_POST["creditos_materia"]);
    $horas_materias = mysqli_real_escape_string($conn, $_POST["horas_materias"]);
    $id_carrera = mysqli_real_escape_string($conn, $_POST["id_carrera"]);
    $estado_materia = 1; // Asignar estado automáticamente como 1
    
    $insert = mysqli_query($conn, "INSERT INTO `materia`(`nombre_materia`, `codigo_materia`, `creditos_materia`, `horas_materias`, `id_carrera`, `estado_materia`)
                    VALUES('$nombre_materia', '$codigo_materia', '$creditos_materia', '$horas_materias', '$id_carrera', '$estado_materia')");

    if($insert){
        echo '<br><br><br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>¡Los datos de la materia se han guardado con éxito!</div>';
    }else{
        echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudieron guardar los datos de la materia.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Registro de Materia</title>

</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Datos de la materia &raquo; Agregar datos</h2>
            <hr />

            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre de la Materia</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre_materia" class="form-control" placeholder="Nombre de la Materia" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Código de la Materia</label>
                    <div class="col-sm-4">
                        <input type="text" name="codigo_materia" class="form-control" placeholder="Código de la Materia" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Créditos de la Materia</label>
                    <div class="col-sm-4">
                        <input type="number" name="creditos_materia" class="form-control" placeholder="Créditos de la Materia" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Horas de la Materia</label>
                    <div class="col-sm-4">
                        <input type="number" name="horas_materias" class="form-control" placeholder="Horas de la Materia" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Carrera</label>
                    <div class="col-sm-4">
                        <select name="id_carrera" class="form-control" required>
                            <?php
                            while($row_carrera = mysqli_fetch_assoc($resultado_nombres_carreras)) {
                                echo "<option value='{$row_carrera['id_carrera']}'>{$row_carrera['nombre_carrera']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
                        <a href="ver_materias.php" class="btn btn-sm btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
