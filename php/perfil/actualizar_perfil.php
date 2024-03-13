<?php
include("../conexion.php");

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_perfil = $_POST['id_perfil'];
    $tipo_perfil = $_POST['tipo_perfil'];
    $atributos_perfil = implode(", ", $_POST['atributos_perfil']);
    $id_usuario = $_POST['id_usuario'];

    // Actualizar los datos del perfil en la base de datos
    $sql = "UPDATE perfil 
            SET tipo_perfil = '$tipo_perfil', 
                atributos_perfil = '$atributos_perfil', 
                id_usuario = '$id_usuario'
            WHERE id_perfil = $id_perfil";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'El perfil se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar el perfil: ' . mysqli_error($conn);
    }
}

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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Perfil</title>
</head>
<body>
  
    <div class="container">
        <h2>Actualizar Perfil</h2>
        <hr />

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <!-- Formulario de edición de perfil -->
        <form method="post" action="">
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
            <a href="ver_perfiles.php" class="btn btn-default">Volver</a>
        </form>
    </div>
</body>
</html>
