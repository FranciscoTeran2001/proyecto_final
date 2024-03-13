<?php
include("../conexion.php");



// Verificar si se ha proporcionado un ID de carrera válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la carrera desde la URL
    $id_carrera = $_GET['id'];

    // Consultar los datos de la carrera correspondiente
    $sql = "SELECT * FROM carrera WHERE id_carrera = $id_carrera";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Obtener los detalles de la carrera
        $row = mysqli_fetch_assoc($result);
        $nombre_carrera = $row['nombre_carrera'];
    } else {
        echo "ID de carrera no válido.";
        exit();
    }
} else {
    echo "ID de carrera no especificado.";
    exit();
}
?>

    <div class="container">
        <h2>Editar Carrera</h2>
        <hr />

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <!-- Formulario de edición de carrera -->
        <form method="post" action="update_carrera.php">
            <input type="hidden" name="id_carrera" value="<?php echo $id_carrera; ?>">
            <span class="form-group">
            <input type="text" class="form-control" id="nombre_carrera" name="nombre_carrera" value="<?php echo $nombre_carrera; ?>" required>
            </span>

          <div class="form-group">
            <label for="nombre_carrera">Nombre Carrera:</label>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Carrera</button>
        </form>
    </div>

