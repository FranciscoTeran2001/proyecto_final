<?php
include("../conexion.php");

// Obtener la lista de materias y carreras disponibles
$sql_materias_carreras = "SELECT materia.id_materia, materia.nombre_materia, carrera.nombre_carrera 
                          FROM materia 
                          INNER JOIN carrera ON materia.id_carrera = carrera.id_carrera";
$result_materias_carreras = mysqli_query($conn, $sql_materias_carreras);
$materias_carreras = mysqli_fetch_all($result_materias_carreras, MYSQLI_ASSOC);

// Obtener la lista de docentes disponibles con estado activo
$sql_docentes = "SELECT id_docente, nombre_docente FROM docente WHERE estado_docente = 1";
$result_docentes = mysqli_query($conn, $sql_docentes);
$docentes = mysqli_fetch_all($result_docentes, MYSQLI_ASSOC);

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_nrc = $_POST['id_nrc'];
    $codigo_nrc = $_POST['codigo_nrc'];
    $id_materia = $_POST['id_materia'];
    $id_docente = $_POST['id_docente'];

    // Actualizar los datos del NRC en la base de datos
    $sql = "UPDATE nrc 
            SET codigo_nrc = '$codigo_nrc', 
                id_materia = '$id_materia', 
                id_docente = '$id_docente' 
            WHERE id_nrc = $id_nrc";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'El NRC se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar el NRC: ' . mysqli_error($conn);
    }
}

// Verificar si se ha proporcionado un ID de NRC válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del NRC desde la URL
    $id_nrc = $_GET['id'];

    // Consultar los datos del NRC correspondiente
    $sql = "SELECT * FROM nrc WHERE id_nrc = $id_nrc";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Obtener los detalles del NRC
        $row = mysqli_fetch_assoc($result);
        $codigo_nrc = $row['codigo_nrc'];
        $id_materia = $row['id_materia'];
        $id_docente = $row['id_docente'];
    } else {
        echo "ID de NRC no válido.";
        exit();
    }
} else {
    echo "ID de NRC no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar NRC</title>

</head>
<body>

    <div class="container">
        <h2>Editar NRC</h2>
        <hr />

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <!-- Formulario de edición de NRC -->
        <form method="post" action="">
            <input type="hidden" name="id_nrc" value="<?php echo $id_nrc; ?>">

            <div class="form-group">
                <label for="codigo_nrc">Código del NRC:</label>
                <input type="text" class="form-control" id="codigo_nrc" name="codigo_nrc" value="<?php echo $codigo_nrc; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_materia">Materia:</label>
                <select class="form-control" id="id_materia" name="id_materia" required>
                    <?php foreach ($materias_carreras as $materia) { ?>
                        <option value="<?php echo $materia['id_materia']; ?>" <?php if ($materia['id_materia'] == $id_materia) echo 'selected'; ?>>
                            <?php echo $materia['nombre_materia'] . ' - ' . $materia['nombre_carrera']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_docente">Docente:</label>
                <select class="form-control" id="id_docente" name="id_docente" required>
                    <?php foreach ($docentes as $docente) { ?>
                        <option value="<?php echo $docente['id_docente']; ?>" <?php if ($docente['id_docente'] == $id_docente) echo 'selected'; ?>>
                            <?php echo $docente['nombre_docente']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar NRC</button>
            <a href="ver_nrc.php" class="btn btn-default">Volver</a>
        </form>
    </div>
</body>
</html>
