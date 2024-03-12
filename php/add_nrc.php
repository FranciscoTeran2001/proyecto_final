<?php
include("conexion.php");

// Consulta para obtener los nombres de las materias y carreras
$query_materias_carreras = "SELECT materia.nombre_materia, carrera.nombre_carrera, materia.id_materia FROM materia INNER JOIN carrera ON materia.id_carrera = carrera.id_carrera";
$resultado_materias_carreras = mysqli_query($conn, $query_materias_carreras);



// Consulta para obtener los nombres de los docentes
$query_nombres_docentes = "SELECT nombre_docente, id_docente FROM docente";
$resultado_nombres_docentes = mysqli_query($conn, $query_nombres_docentes);
if(isset($_POST['add'])){
    $codigo_nrc = mysqli_real_escape_string($conn, $_POST["codigo_nrc"]);
    $id_materia = mysqli_real_escape_string($conn, $_POST["id_materia"]);
    $id_docente = mysqli_real_escape_string($conn, $_POST["id_docente"]);
    $estado_nrc = 1; // Asignar estado automáticamente como 1
    
    $insert = mysqli_query($conn, "INSERT INTO `nrc`(`codigo_nrc`, `id_materia`, `id_docente`, `estado_nrc`)
                    VALUES('$codigo_nrc', '$id_materia', '$id_docente', '$estado_nrc')");

    if($insert){
        echo '<br><br><br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>¡El NRC se ha guardado con éxito!</div>';
    }else{
        echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo guardar el NRC.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Registro de NRC</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="../css/style_nav.css" rel="stylesheet">
    <style>
        .content {
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php include("nav.php");?>
    </nav>
    <div class="container">
        <div class="content">
            <h2>Datos del NRC &raquo; Agregar datos</h2>
            <hr />

            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Código del NRC</label>
                    <div class="col-sm-4">
                        <input type="text" name="codigo_nrc" class="form-control" placeholder="Código del NRC" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Materia y Carrera</label>
                    <div class="col-sm-4">
                        <select name="id_materia" class="form-control" required>
                            <?php
                            while($row_materia_carrera = mysqli_fetch_assoc($resultado_materias_carreras)) {
                                echo "<option value='{$row_materia_carrera['id_materia']}'>{$row_materia_carrera['nombre_materia']} - {$row_materia_carrera['nombre_carrera']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Docente</label>
                    <div class="col-sm-4">
                        <select name="id_docente" class="form-control" required>
                            <?php
                            while($row_docente = mysqli_fetch_assoc($resultado_nombres_docentes)) {
                                echo "<option value='{$row_docente['id_docente']}'>{$row_docente['nombre_docente']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
                        <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/bootstrap-datepicker.js"></script>
    <script>
        $('.date').datepicker({
            format: 'dd-mm-yyyy',
        })
    </script>
</body>
</html>
