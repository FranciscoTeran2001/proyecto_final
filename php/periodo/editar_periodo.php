<?php
include("../conexion.php");

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si todos los campos están presentes y no están vacíos
    if (isset($_POST['id_periodo']) && isset($_POST['fecha_inicio']) && isset($_POST['fecha_final']) &&
        !empty($_POST['id_periodo']) && !empty($_POST['fecha_inicio']) && !empty($_POST['fecha_final'])) {
        
        // Obtener los datos del formulario
        $id_periodo = $_POST['id_periodo'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_final = $_POST['fecha_final'];

        // Actualizar los datos del periodo en la base de datos
        $sql = "UPDATE periodo 
                SET fecha_inicio = '$fecha_inicio', 
                    fecha_final = '$fecha_final' 
                WHERE id_periodo = $id_periodo";

        if (mysqli_query($conn, $sql)) {
            // Establecer el mensaje de actualización exitosa
            $update_message = 'El periodo se ha actualizado correctamente.';
        } else {
            // Establecer el mensaje de error de actualización
            $update_message = 'Error al actualizar el periodo: ' . mysqli_error($conn);
        }
    } else {
        // Si algún campo está vacío, mostrar un mensaje de error
        $update_message = 'Por favor, complete todos los campos.';
    }
}

// Verificar si se ha proporcionado un ID de periodo válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del periodo desde la URL
    $id_periodo = $_GET['id'];

    // Consultar los datos del periodo correspondiente
    $sql = "SELECT * FROM periodo WHERE id_periodo = $id_periodo";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Obtener los detalles del periodo
        $row = mysqli_fetch_assoc($result);
        $fecha_inicio = $row['fecha_inicio'];
        $fecha_final = $row['fecha_final'];
    } else {
        echo "ID de periodo no válido.";
        exit();
    }
} else {
    echo "ID de periodo no especificado.";
    exit();
}
?>


    <div class="container">
        <h2>Editar Periodo</h2>
        <hr />

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <!-- Formulario de edición de periodo -->
        <form method="post" action="">
            <input type="hidden" name="id_periodo" value="<?php echo $id_periodo; ?>">

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fecha_inicio; ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha_final">Fecha Final:</label>
                <input type="date" class="form-control" id="fecha_final" name="fecha_final" value="<?php echo $fecha_final; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Periodo</button>
            <a href="ver_periodo.php" class="btn btn-default">Volver</a>
        </form>
    </div>

