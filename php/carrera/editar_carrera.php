<?php
include("../conexion.php");


// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_carrera = $_POST['id_carrera'];
    $nombre_carrera = mysqli_real_escape_string($conn, $_POST['nombre_carrera']);

    // Consultar si el nombre de la carrera ya existe en la base de datos
    $check_query = "SELECT id_carrera FROM carrera WHERE nombre_carrera = '$nombre_carrera' AND id_carrera != $id_carrera";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $update_message = 'Error al actualizar la carrera: Ya existe una carrera con ese nombre.';
    } else {
        // Actualizar los datos de la carrera en la base de datos
        $sql = "UPDATE carrera SET nombre_carrera = '$nombre_carrera' WHERE id_carrera = $id_carrera";

        if (mysqli_query($conn, $sql)) {
            // Establecer el mensaje de actualización exitosa
            $update_message = 'La carrera se ha actualizado correctamente.';
        } else {
            // Establecer el mensaje de error de actualización
            $update_message = 'Error al actualizar la carrera: ' . mysqli_error($conn);
        }
    }
}


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

        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>
        
        <!-- Formulario de edición de carrera -->
        <form method="post" action="update_carrera.php">
            <input type="hidden" name="id_carrera" value="<?php echo $id_carrera; ?>">
            <div class="form-group">
                <label for="nombre_carrera">Nombre Carrera:</label>
                <input type="text" class="form-control" id="nombre_carrera" name="nombre_carrera" value="<?php echo $nombre_carrera; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Carrera</button>
        </form>
    </div>

