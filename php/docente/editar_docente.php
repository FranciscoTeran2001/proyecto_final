<?php
include("../conexion.php");

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';


// Verificar si se ha proporcionado un ID de docente válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de docente desde la URL
    $id_docente = $_GET['id'];

    // Consultar los datos del docente correspondiente
    $sql = "SELECT * FROM docente WHERE id_docente = $id_docente";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Obtener los detalles del docente
        $row = mysqli_fetch_assoc($result);
        $nombre_docente = $row['nombre_docente'];
        $cedula_docente = $row['cedula_docente'];
        $correo_docente = $row['correo_docente'];
        $telefono_docente = $row['telefono_docente'];
        $especializacion_docente = $row['especializacion_docente'];
        $horas_clase_docente = $row['horas_clase_docente'];
    } else {
        echo "ID de docente no válido.";
        exit();
    }
} else {
    echo "ID de docente no especificado.";
    exit();
}
?>


    <div class="container">
        <h2>Editar Docente</h2>
        <hr />

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <!-- Formulario de edición de docente -->
        <form method="post" action="actualizar_tabla_docente.php">
            <input type="hidden" name="id_docente" value="<?php echo $id_docente; ?>">

            <div class="form-group">
                <label for="nombre_docente">Nombre:</label>
    <input type="text" class="form-control" id="nombre_docente" name="nombre_docente" value="<?php echo $nombre_docente; ?>" required>
            </div>
            <div class="form-group">
                <label for="cedula_docente">Cédula de Identidad:</label>
                <input type="text" class="form-control" id="cedula_docente" name="cedula_docente" value="<?php echo $cedula_docente; ?>" required>
            </div>
            <div class="form-group">
                <label for="correo_docente">Correo Electrónico:</label>
                <input type="email" class="form-control" id="correo_docente" name="correo_docente" value="<?php echo $correo_docente; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono_docente">Teléfono:</label>
                <input type="text" class="form-control" id="telefono_docente" name="telefono_docente" value="<?php echo $telefono_docente; ?>" required>
            </div>
            <div class="form-group">
                <label for="especializacion_docente">Especialización:</label>
                <input type="text" class="form-control" id="especializacion_docente" name="especializacion_docente" value="<?php echo $especializacion_docente; ?>" required>
            </div>
            <div class="form-group">
                <label for="horas_clase_docente">Horas de Clases:</label>
                <input type="number" class="form-control" id="horas_clase_docente" name="horas_clase_docente" value="<?php echo $horas_clase_docente; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Docente</button>
            <a href="ver_docente.php" class="btn btn-default">Volver</a>
        </form>
    </div>



