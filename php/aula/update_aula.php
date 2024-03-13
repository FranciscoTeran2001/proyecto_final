<?php 
include("../conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_aula = $_POST['id_aula'];
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $capacidad = mysqli_real_escape_string($conn, $_POST["capacidad"]);
    $bloque = mysqli_real_escape_string($conn, $_POST["bloque"]);

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
}
?>