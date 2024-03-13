<?php
include("../conexion.php");

// Establecer la zona horaria a Guayaquil
date_default_timezone_set('America/Guayaquil');

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($nombre) && !empty($capacidad) && !empty($bloque)) {
        $id_aula = $_POST['id_aula'];
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $capacidad = mysqli_real_escape_string($conn, $_POST["capacidad"]);
        $bloque = mysqli_real_escape_string($conn, $_POST["bloque"]);

        if ($capacidad > 0) {
            // Actualizar los datos del aula en la base de datos
            $sql = "UPDATE aula 
                    SET nombre_aula = '$nombre', 
                        capacidad_aula = '$capacidad', 
                        bloque_aula = '$bloque' 
                    WHERE id_aula = $id_aula";

            if (mysqli_query($conn, $sql)) {
                // Establecer el mensaje de actualización exitosa
                $update_message = 'El aula se ha actualizado correctamente.';
            } else {
                // Establecer el mensaje de error de actualización
                $update_message = 'Error al actualizar el aula: ' . mysqli_error($conn);
            }
        } else {
            $update_message = 'Error. La capacidad debe ser un número entero positivo.';
        }
    } else {
        $update_message = 'Error. Todos los campos son obligatorios.';
    }
}


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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Aula</title>
</head>
<body>
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
        <form method="post" action="" onsubmit="return validateaulaeditar()">
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
            <a href="ver_aula.php" class="btn btn-default">Volver</a>
        </form>
    </div>

    <script src="../../js/validaciones.js"></script>
</body>
</html>
