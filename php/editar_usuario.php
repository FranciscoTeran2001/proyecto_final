<?php
include("conexion.php");

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $usuario_usuario = $_POST['usuario_usuario'];

    // Consultar el nombre de usuario anterior
    $sql_nombre_anterior = "SELECT nombre_usuario FROM usuario WHERE id_usuario = $id_usuario";
    $result_nombre_anterior = mysqli_query($conn, $sql_nombre_anterior);
    $row_nombre_anterior = mysqli_fetch_assoc($result_nombre_anterior);
    $nombre_usuario_anterior = $row_nombre_anterior['nombre_usuario'];

    // Actualizar los datos del usuario en la base de datos
    $sql_usuario = "UPDATE usuario 
                    SET nombre_usuario = '$nombre_usuario', 
                        usuario_usuario = '$usuario_usuario'
                    WHERE id_usuario = $id_usuario";

    if (mysqli_query($conn, $sql_usuario)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'El usuario se ha actualizado correctamente.';
        
        // Verificar si el usuario modificado es un docente
        $sql_es_docente = "SELECT * FROM docente WHERE nombre_docente = '$nombre_usuario_anterior'";
        $result_es_docente = mysqli_query($conn, $sql_es_docente);

        if (mysqli_num_rows($result_es_docente) == 1) {
            // Actualizar el nombre del docente en la tabla docente
            $sql_docente = "UPDATE docente 
                            SET nombre_docente = '$nombre_usuario'
                            WHERE nombre_docente = '$nombre_usuario_anterior'";
            mysqli_query($conn, $sql_docente);
        }
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar el usuario: ' . mysqli_error($conn);
    }
}

// Verificar si se ha proporcionado un ID de usuario válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del usuario desde la URL
    $id_usuario = $_GET['id'];

    // Consultar los datos del usuario correspondiente
    $sql = "SELECT * FROM usuario WHERE id_usuario = $id_usuario";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Obtener los detalles del usuario
        $row = mysqli_fetch_assoc($result);
        $nombre_usuario = $row['nombre_usuario'];
        $usuario_usuario = $row['usuario_usuario'];
    } else {
        echo "ID de usuario no válido.";
        exit();
    }
} else {
    echo "ID de usuario no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_nav.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php include('nav.php');?>
    </nav>
    <div class="container">
        <h2>Editar Usuario</h2>
        <hr />

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <!-- Formulario de edición de usuario -->
        <form method="post" action="">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>" required>
            </div>
            <div class="form-group">
                <label for="usuario_usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario_usuario" name="usuario_usuario" value="<?php echo $usuario_usuario; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
            <a href="ver_usuarios.php" class="btn btn-default">Volver</a>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
