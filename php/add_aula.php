<?php
include("conexion.php");

if(isset($_POST['add'])){
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $capacidad = mysqli_real_escape_string($conn, $_POST["capacidad"]);
    $bloque = mysqli_real_escape_string($conn, $_POST["bloque"]);
    
    $insert = mysqli_query($conn, "INSERT INTO `aula`( `nombre_aula`, `capacidad_aula`, `bloque_aula`, `estado_aula`)
                    VALUES('$nombre', '$capacidad', '$bloque', 1)");

    if($insert){
        echo '<br><br><br><div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>¡El aula se ha agregado correctamente!</div>';
    }else{
        echo '<br><br><br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error. No se pudo agregar el aula.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Registro de Aula</title>
    <!-- Bootstrap -->
</head>
<body>

    <div class="container">
        <div class="content">
            <h2>Datos del aula &raquo; Agregar datos</h2>
            <hr />

            <form class="form-horizontal"  method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre</label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Capacidad</label>
                    <div class="col-sm-4">
                        <input type="number" name="capacidad" class="form-control" placeholder="Capacidad" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Bloque</label>
                    <div class="col-sm-4">
                        <select name="bloque" class="form-control" required>
                            <option value="H">H</option>
                            <option value="G">G</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                    <button type="button" id="guardarDatos" class="btn btn-sm btn-primary">Guardar datos</button>

                        <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#guardarDatos').click(function() {
            // Recolectar los datos del formulario
            var formData = {
                nombre: $('input[name=nombre]').val(),
                capacidad: $('input[name=capacidad]').val(),
                bloque: $('select[name=bloque]').val()
            };

            // Enviar los datos mediante AJAX
            $.ajax({
                type: 'POST',
                url: 'add_aula.php',
                data: formData,
                success: function(response) {
                    // Manejar la respuesta según sea necesario
                    if (response.includes('correctamente')) {
                        // Redirigir a la página de inicio u otro lugar
                        window.location.href = 'principal.php';
                    } else {
                        // Manejar otros casos de respuesta
                    }
                }
            });
        });
    });
</script>



</body>
</html>

