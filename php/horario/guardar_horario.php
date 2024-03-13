<?php
// Conexión a la base de datos
include("conexion.php");

// Obtener los datos enviados por AJAX
$id_fd = $_POST['id_fd'];
$id_nrc = $_POST['id_nrc'];
$id_aula = $_POST['id_aula'];
$id_periodo = $_POST['id_periodo'];

// Consulta preparada para insertar los datos en la tabla
$sql = "INSERT INTO horario (id_fd, id_nrc, id_aula, id_periodo, estado_horario) VALUES (?, ?, ?, ?, 1)";

// Preparar la consulta
if ($stmt = mysqli_prepare($conn, $sql)) {
    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "iiii", $id_fd, $id_nrc, $id_aula, $id_periodo);

    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
        echo "Horario guardado correctamente.";
    } else {
        echo "Error al guardar el horario: " . mysqli_stmt_error($stmt);
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conn);
}

// Cerrar conexión a la base de datos si es necesario
mysqli_close($conn);
?>
