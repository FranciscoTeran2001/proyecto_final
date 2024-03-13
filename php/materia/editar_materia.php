<?php
include("../conexion.php");

// Obtener la lista de carreras disponibles
$sql_carreras = "SELECT id_carrera, nombre_carrera FROM carrera";
$result_carreras = mysqli_query($conn, $sql_carreras);
$carreras = mysqli_fetch_all($result_carreras, MYSQLI_ASSOC);

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';



// Verificar si se ha proporcionado un ID de materia válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la materia desde la URL
    $id_materia = $_GET['id'];

    // Consultar los datos de la materia correspondiente
    $sql = "SELECT * FROM materia WHERE id_materia = $id_materia";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Obtener los detalles de la materia
        $row = mysqli_fetch_assoc($result);
        $nombre_materia = $row['nombre_materia'];
        $codigo_materia = $row['codigo_materia'];
        $creditos_materia = $row['creditos_materia'];
        $horas_materias = $row['horas_materias'];
        $id_carrera = $row['id_carrera'];
    } else {
        echo "ID de materia no válido.";
        exit();
    }
} else {
    echo "ID de materia no especificado.";
    exit();
}
?>

    <div class="container">
        <h2>Editar Materia</h2>
        <hr />

        <!-- Mostrar el mensaje de actualización -->
        <?php if (!empty($update_message)) { ?>
            <div class="alert alert-<?php echo (strpos($update_message, 'correctamente') !== false) ? 'success' : 'danger'; ?>">
                <?php echo $update_message; ?>
            </div>
        <?php } ?>

        <!-- Formulario de edición de materia -->
        <form method="post" action="update_materia.php">
            <input type="hidden" name="id_materia" value="<?php echo $id_materia; ?>">

            <div class="form-group">
                <label for="nombre_materia">Nombre Materia:</label>
                <input type="text" class="form-control" id="nombre_materia" name="nombre_materia" value="<?php echo $nombre_materia; ?>" required>
            </div>
            <div class="form-group">
                <label for="codigo_materia">Código Materia:</label>
                <input type="text" class="form-control" id="codigo_materia" name="codigo_materia" value="<?php echo $codigo_materia; ?>" required>
            </div>
            <div class="form-group">
                <label for="creditos_materia">Créditos:</label>
                <input type="number" class="form-control" id="creditos_materia" name="creditos_materia" value="<?php echo $creditos_materia; ?>" required>
            </div>
            <div class="form-group">
                <label for="horas_materias">Horas Materias:</label>
                <input type="number" class="form-control" id="horas_materias" name="horas_materias" value="<?php echo $horas_materias; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_carrera">Carrera:</label>
                <select class="form-control" id="id_carrera" name="id_carrera" required>
                    <?php foreach ($carreras as $carrera) { ?>
                        <option value="<?php echo $carrera['id_carrera']; ?>" <?php if ($carrera['id_carrera'] == $id_carrera) echo 'selected'; ?>>
                            <?php echo $carrera['nombre_carrera']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Materia</button>
            <a href="ver_materias.php" class="btn btn-default">volver</a>
        </form>
    </div>


