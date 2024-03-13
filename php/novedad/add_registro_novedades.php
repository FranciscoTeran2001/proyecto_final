<?php
include("../conexion.php");

// Establecer la zona horaria a Guayaquil
date_default_timezone_set('America/Guayaquil');

// Consulta para obtener los usuarios
$query_usuarios = "SELECT id_usuario, nombre_usuario FROM usuario";
$resultado_usuarios = mysqli_query($conn, $query_usuarios);

// Consulta para obtener las aulas
$query_aulas = "SELECT id_aula, nombre_aula FROM aula";
$resultado_aulas = mysqli_query($conn, $query_aulas);

if(isset($_POST['add'])){
    $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
    $fecha_creacion = date("Y-m-d H:i:s"); // Obtener la fecha y hora actual en el formato MySQL
    $estado = 1; // Asignar estado automáticamente como 1
    $id_usuario = mysqli_real_escape_string($conn, $_POST["id_usuario"]); // Suponiendo que obtienes esto de algún lugar
    $id_aula = mysqli_real_escape_string($conn, $_POST["id_aula"]); // Suponiendo que obtienes esto de algún lugar
    
    if(empty($descripcion) || empty($id_usuario) || empty($id_aula)){
        echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Todos los campos son obligatorios.</div>';
    } else {
        $insert = mysqli_query($conn, "INSERT INTO `registro_novedades`( `descripcion_novedad`, `fecha_creacion_novedad`, `fecha_edicion_novedad`, `estado_novedad`, `id_usuario`, `id_aula`)
                        VALUES('$descripcion', '$fecha_creacion', '$fecha_creacion', '$estado', '$id_usuario', '$id_aula')");

        if($insert){
            echo '<br><br><br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>¡Novedad registrada correctamente!</div>';
        }else{
            echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error al registrar la novedad.</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Novedades</title>

    <style>
        .content {
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Registro de Novedades</h2>
            <hr />

            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Novedad</label>
                    <div class="col-sm-6">
                        <textarea name="descripcion" class="form-control" placeholder="Novedad" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Usuario</label>
                    <div class="col-sm-4">
                        <select name="id_usuario" class="form-control" required>
                            <?php
                            while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
                                echo "<option value='{$row_usuario['id_usuario']}'>{$row_usuario['nombre_usuario']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Aula</label>
                    <div class="col-sm-4">
                        <select name="id_aula" class="form-control" required>
                            <?php
                            while($row_aula = mysqli_fetch_assoc($resultado_aulas)) {
                                echo "<option value='{$row_aula['id_aula']}'>{$row_aula['nombre_aula']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <input type="submit" name="add" class="btn btn-primary" value="Registrar Novedad">
                        <a href="ver_registros_novedad.php" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
