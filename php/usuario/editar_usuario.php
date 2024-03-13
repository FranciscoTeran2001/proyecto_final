<?php
include("../conexion.php");
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
        <form method="post" action="update_usuario.php">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>" required>
            </div>
            <div class="form-group">
                <label for="usuario_usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario_usuario" name="usuario_usuario" value="<?php echo $usuario_usuario; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary" name="Actualizar">Actualizar Usuario</button>
            <a href="ver_usuarios.php" class="btn btn-default">Volver</a>
        </form>
    </div>

