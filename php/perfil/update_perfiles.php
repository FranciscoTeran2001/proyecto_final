<?php
include("../conexion.php");
// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_perfil = $_POST['id_perfil'];
    $tipo_perfil = $_POST['tipo_perfil'];
    $atributos_perfil = implode(", ", $_POST['atributos_perfil']);
    $id_usuario = $_POST['id_usuario'];

    // Actualizar los datos del perfil en la base de datos
    $sql = "UPDATE perfil 
            SET tipo_perfil = '$tipo_perfil', 
                atributos_perfil = '$atributos_perfil', 
                id_usuario = '$id_usuario'
            WHERE id_perfil = $id_perfil";

    if (mysqli_query($conn, $sql)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'El perfil se ha actualizado correctamente.';
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar el perfil: ' . mysqli_error($conn);
    }
}
?>