<?php
include("conexion.php");

if(isset($_POST['add'])){
    $id_docente = mysqli_real_escape_string($conn, $_POST["id_docente"]);
    $id_materia = mysqli_real_escape_string($conn, $_POST["id_materia"]);
    $semestre = mysqli_real_escape_string($conn, $_POST["semestre"]);
    $ano = mysqli_real_escape_string($conn, $_POST["ano"]);
    $id_aula = mysqli_real_escape_string($conn, $_POST["id_aula"]);
    
    $insert = mysqli_query($conn, "INSERT INTO asignaciones(id_docente, id_materia, semestre, año, id_aula)
                    VALUES('$id_docente', '$id_materia', '$semestre', '$ano', '$id_aula')");

    if($insert){
        echo '<br><br><br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>¡La asignación se ha agregado correctamente!</div>';
    }else{
        echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo agregar la asignación.</div>';
    }
}
function obtenerNombreDocente($conn, $id) {
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT nombres FROM docentes WHERE id_docente = '$id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['nombres'];
    } else {
        return "";
    }
}
function obtenerNombreMateria($conn, $id) {
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT nombre FROM materias WHERE id_materia = '$id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['nombre'];
    } else {
        return "";
    }
}
function obtenerNombreAula($conn, $id) {
    $id = mysqli_real_escape_string($conn, $id);
    $query = "SELECT nombre FROM aulas WHERE id_aula = '$id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['nombre'];
    } else {
        return "";
    }
}
if(isset($_POST['id_docente'])){
    $id_docente = $_POST['id_docente'];
    $nombre_docente = obtenerNombreDocente($conn, $id_docente);
    echo $nombre_docente;
    exit; // Detener la ejecución del script después de enviar la respuesta AJAX
}
if(isset($_POST['id_materia'])){
    $id_materia = $_POST['id_materia'];
    $nombre_materia = obtenerNombreMateria($conn, $id_materia);
    echo $nombre_materia;
    exit; // Detener la ejecución del script después de enviar la respuesta AJAX
}
if(isset($_POST['id_aula'])){
    $id_aula = $_POST['id_aula'];
    $nombre_aula = obtenerNombreAula($conn, $id_aula);
    echo $nombre_aula;
    exit; // Detener la ejecución del script después de enviar la respuesta AJAX
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Registro de Asignación</title>
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
            <h2>Datos de asignación &raquo; Agregar datos</h2>
            <hr />

             <form class="form-horizontal" action="" method="post">
    <div class="form-group">
        <label class="col-sm-3 control-label">ID Docente</label>
        <div class="col-sm-4">
            <input type="number" name="id_docente" id="id_docente" class="form-control" placeholder="ID Docente" required>
                        <label id="nombre_docente"></label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">ID Materia</label>
        <div class="col-sm-4">
            <input type="number" name="id_materia" id="id_materia" class="form-control" placeholder="ID Materia" required>
                        <label id="nombre_materia"></label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Semestre</label>
        <div class="col-sm-4">
            <input type="text" name="semestre" class="form-control" placeholder="Semestre" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Año</label>
        <div class="col-sm-4">
            <input type="number" name="ano" class="form-control" placeholder="Año" required>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">ID Aula</label>
        <div class="col-sm-4">
             <input type="number" name="id_aula" id="id_aula" class="form-control" placeholder="ID Aula" required>
                        <label id="nombre_aula"></label>
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
	 <script>
    $(document).ready(function(){
        $('#id_docente').on('blur', function(){
            var id_docente = $(this).val();
            $.ajax({
                url: 'add_asignacion.php',
                type: 'POST',
                data: {id_docente: id_docente},
                success: function(response){
                    $('#nombre_docente').text(response);
                }
            });
        });

        $('#id_materia').on('blur', function(){
            var id_materia = $(this).val();
            $.ajax({
                url: 'add_asignacion.php',
                type: 'POST',
                data: {id_materia: id_materia},
                success: function(response){
                    $('#nombre_materia').text(response);
                }
            });
        });

        $('#id_aula').on('blur', function(){
            var id_aula = $(this).val();
            $.ajax({
                url: 'add_asignacion.php',
                type: 'POST',
                data: {id_aula: id_aula},
                success: function(response){
                    $('#nombre_aula').text(response);
                }
            });
        });
    });
    </script>
</body>
</html>
