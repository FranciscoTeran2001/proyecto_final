<?php
include("conexion.php");

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_carrera = $_POST['id_carrera'];
    $nombre_carrera = mysqli_real_escape_string($conn, $_POST['nombre_carrera']);

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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Carrera</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style_nav.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php include('nav.php');?>
    </nav>
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
        <form method="post" action="">
            <input type="hidden" name="id_carrera" value="<?php echo $id_carrera; ?>">
            <span class="form-group">
            <input type="text" class="form-control" id="nombre_carrera" name="nombre_carrera" value="<?php echo $nombre_carrera; ?>" required>
            </span>

          <div class="form-group">
            <label for="nombre_carrera">Nombre Carrera:</label>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Carrera</button>
            <a href="ver_carreras.php" class="btn btn-default">Volver</a>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
