<?php
include("../conexion.php");

// Verificar si se ha proporcionado un ID de perfil válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del perfil desde la URL
    $id_perfil = $_GET['id'];

    // Consultar los datos del perfil correspondiente
    $sql = "SELECT * FROM perfil WHERE id_perfil = $id_perfil";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Obtener los detalles del perfil
        $row = mysqli_fetch_assoc($result);
        $tipo_perfil = $row['tipo_perfil'];
        $atributos_perfil = explode(", ", $row['atributos_perfil']);
        $id_usuario = $row['id_usuario'];
    } else {
        echo "ID de perfil no válido.";
        exit();
    }
} else {
    echo "ID de perfil no especificado.";
    exit();
}

// Consulta para obtener los usuarios para el selector
$query_usuarios = "SELECT id_usuario, usuario_usuario FROM usuario";
$result_usuarios = mysqli_query($conn, $query_usuarios);
?>


  
    <div class="container">
        <h2>Actualizar Perfil</h2>
        <hr/>

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <!-- Formulario de edición de perfil -->
        <form method="post" action="update_perfiles.php">
            <input type="hidden" name="id_perfil" value="<?php echo $id_perfil; ?>">

            <div class="form-group">
                <label for="tipo_perfil">Tipo de Perfil:</label>
                <select class="form-control" id="tipo_perfil" name="tipo_perfil" required>
                    <option value="administrador" <?php if ($tipo_perfil == 'administrador') echo 'selected'; ?>>Administrador</option>
                    <option value="docente" <?php if ($tipo_perfil == 'docente') echo 'selected'; ?>>Docente</option>
                </select>
            </div>
            <div class="form-group">
                <label for="atributos_perfil">Atributos del Perfil:</label>
                <div class="checkbox">
                    <label><input type="checkbox" name="atributos_perfil[]" value="lector" <?php if (in_array('lector', $atributos_perfil)) echo 'checked'; ?>> Lector</label>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="atributos_perfil[]" value="editor" <?php if (in_array('editor', $atributos_perfil)) echo 'checked'; ?>> Editor</label>
                </div>
            </div>
            <div class="form-group">
                <label for="id_usuario">Usuario:</label>
                <select class="form-control" id="id_usuario" name="id_usuario" required>
                    <?php while ($row = mysqli_fetch_assoc($result_usuarios)): ?>
                        <option value="<?php echo $row['id_usuario']; ?>" <?php if ($row['id_usuario'] == $id_usuario) echo 'selected'; ?>><?php echo $row['usuario_usuario']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
        </form>
    </div>

