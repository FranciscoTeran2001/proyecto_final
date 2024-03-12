<?php
include("conexion.php");
date_default_timezone_set('America/Guayaquil');
// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_novedad = $_POST['id_novedad'];
    $descripcion_novedad = mysqli_real_escape_string($conn, $_POST['descripcion_novedad']);
    $fecha_edicion_novedad = date("Y-m-d H:i:s"); // Obtener la fecha y hora actual en el formato MySQL
    $id_usuario = mysqli_real_escape_string($conn, $_POST['id_usuario']);
    $id_aula = mysqli_real_escape_string($conn, $_POST['id_aula']);

    // Actualizar los datos de la novedad en la base de datos
    $sql = "UPDATE registro_novedades 
            SET descripcion_novedad = '$descripcion_novedad', 
                fecha_edicion_novedad = '$fecha_edicion_novedad', 
                id_usuario = '$id_usuario', 
                id_aula = '$id_aula' 
            WHERE id_novedad = $id_novedad";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'La novedad se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar la novedad: ' . mysqli_error($conn);
    }
}

// Verificar si se ha proporcionado un ID de novedad válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la novedad desde la URL
    $id_novedad = $_GET['id'];

    // Consultar los datos de la novedad correspondiente
    $sql = "SELECT * FROM registro_novedades WHERE id_novedad = $id_novedad";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Obtener los detalles de la novedad
        $row = mysqli_fetch_assoc($result);
        $descripcion_novedad = $row['descripcion_novedad'];
        $id_usuario = $row['id_usuario'];
        $id_aula = $row['id_aula'];
    } else {
        // Redireccionar a la página de visualización de novedades con un mensaje de error
        header("Location: visualizar_novedades.php?error=1");
        exit();
    }
} else {
    // Redireccionar a la página de visualización de novedades con un mensaje de error
    header("Location: visualizar_novedades.php?error=1");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Novedad</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_nav.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php include('nav.php');?>
    </nav>
    <div class="container">
        <h2>Editar Novedad</h2>
        <hr />

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <form method="post" action="">
            <input type="hidden" name="id_novedad" value="<?php echo $id_novedad; ?>">

            <div class="form-group">
                <label for="descripcion_novedad">Descripción:</label>
                <textarea class="form-control" id="descripcion_novedad" name="descripcion_novedad" required><?php echo $descripcion_novedad; ?></textarea>
            </div>
            <div class="form-group">
                <label for="id_usuario">Usuario:</label>
                <select class="form-control" id="id_usuario" name="id_usuario" required>
                    <?php
                    $query_usuarios = "SELECT id_usuario, nombre_usuario FROM usuario";
                    $resultado_usuarios = mysqli_query($conn, $query_usuarios);
                    while ($row_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
                        $selected = ($row_usuario['id_usuario'] == $id_usuario) ? 'selected' : '';
                        echo "<option value='{$row_usuario['id_usuario']}' $selected>{$row_usuario['nombre_usuario']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_aula">Aula:</label>
                <select class="form-control" id="id_aula" name="id_aula" required>
                    <?php
                    $query_aulas = "SELECT id_aula, nombre_aula FROM aula";
                    $resultado_aulas = mysqli_query($conn, $query_aulas);
                    while ($row_aula = mysqli_fetch_assoc($resultado_aulas)) {
                        $selected = ($row_aula['id_aula'] == $id_aula) ? 'selected' : '';
                        echo "<option value='{$row_aula['id_aula']}' $selected>{$row_aula['nombre_aula']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Novedad</button>
            <a href="ver_registros_novedad.php" class="btn btn-default">Volver</a>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>

