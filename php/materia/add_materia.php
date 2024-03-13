<?php
include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre_materia = mysqli_real_escape_string($conn, $_POST["nombre_materia"]);
    $codigo_materia = mysqli_real_escape_string($conn, $_POST["codigo_materia"]);
    $descripcion_materia = mysqli_real_escape_string($conn, $_POST["descripcion_materia"]);
    $id_docente = mysqli_real_escape_string($conn, $_POST["id_docente"]);

    // Validar si la materia ya está registrada
    $check_materia = mysqli_query($conn, "SELECT * FROM `materia` WHERE `nombre_materia` = '$nombre_materia'");
    if (mysqli_num_rows($check_materia) > 0) {
        echo "La materia ya está registrada.";
        exit();
    }

    // Validar que solo se ingresen números en el código de la materia
    if (!is_numeric($codigo_materia)) {
        echo "El código de la materia debe contener solo números.";
        exit();
    }

    // Validar que solo se ingresen números en el ID del docente
    if (!is_numeric($id_docente)) {
        echo "El ID del docente debe contener solo números.";
        exit();
    }

    // Insertar los datos en la base de datos
    $insert = mysqli_query($conn, "INSERT INTO `materia`(`nombre_materia`, `codigo_materia`, `descripcion_materia`, `id_docente`) 
                    VALUES('$nombre_materia', '$codigo_materia', '$descripcion_materia', '$id_docente')");

    if ($insert) {
        echo "La materia se ha registrado correctamente.";
    } else {
        echo "Error al registrar la materia: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Materia</title>
</head>
<body>
    <div class="container">
        <h2>Registrar Materia</h2>
        <hr />

        <!-- Formulario de registro de materia -->
        <form method="post" action="">
            <div class="form-group">
                <label for="nombre_materia">Nombre de la Materia:</label>
                <input type="text" class="form-control" id="nombre_materia" name="nombre_materia" placeholder="Nombre de la Materia" required>
            </div>
            <div class="form-group">
                <label for="codigo_materia">Código de la Materia:</label>
                <input type="text" class="form-control" id="codigo_materia" name="codigo_materia" placeholder="Código de la Materia" required>
            </div>
            <div class="form-group">
                <label for="descripcion_materia">Descripción:</label>
                <textarea class="form-control" id="descripcion_materia" name="descripcion_materia" rows="3" placeholder="Descripción"></textarea>
            </div>
            <div class="form-group">
                <label for="id_docente">ID del Docente:</label>
                <input type="text" class="form-control" id="id_docente" name="id_docente" placeholder="ID del Docente" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Materia</button>
            <a href="ver_materias.php" class="btn btn-default">Volver</a>
        </form>
    </div>
</body>
</html>
