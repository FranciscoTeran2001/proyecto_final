<?php
include("../conexion.php");

date_default_timezone_set('America/Guayaquil');

// Verificar si se ha proporcionado un ID de aula válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del aula desde la URL
    $id_aula = $_GET['id'];

    // Consultar los datos del aula correspondiente
    $sql = "SELECT * FROM aula WHERE id_aula = $id_aula";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Obtener los detalles del aula
        $row = mysqli_fetch_assoc($result);
        $nombre = $row['nombre_aula'];
        $capacidad = $row['capacidad_aula'];
        $bloque = $row['bloque_aula'];
    } else {
        echo "ID de aula no válido.";
        exit();
    }
} else {
    echo "ID de aula no especificado.";
    exit();
}
?>


    <div class="container">
        <h2>Editar Aula</h2>
        <hr />

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <!-- Formulario de edición de aula -->
        <form method="post" action="update_aula.php">
            <input type="hidden" name="id_aula" value="<?php echo $id_aula; ?>">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="form-group">
                <label for="capacidad">Capacidad:</label>
                <input type="number" class="form-control" id="capacidad" name="capacidad" value="<?php echo $capacidad; ?>" required>
            </div>
            <div class="form-group">
                <label for="bloque">Bloque:</label>
                <select class="form-control" id="bloque" name="bloque" required>
                    <option value="H" <?php if ($bloque == 'H') echo 'selected'; ?>>H</option>
                    <option value="G" <?php if ($bloque == 'G') echo 'selected'; ?>>G</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Aula</button>
        </form>
    </div>
