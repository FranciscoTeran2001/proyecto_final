<?php
include("../conexion.php");

// Verificar si se proporcionó un ID de perfil válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del perfil desde la URL
    $id_perfil = $_GET['id'];

    // Actualizar el estado del perfil a 0 (eliminado)
    $sql_perfil = "UPDATE perfil SET estado_perfil = 0 WHERE id_perfil = $id_perfil";

    if (mysqli_query($conn, $sql_perfil)) {
        // Redireccionar de nuevo a la página de visualización de perfiles
        header("Location: ver_perfiles.php");
        exit();
    } else {
        echo "Error al intentar eliminar el perfil: " . mysqli_error($conn);
    }
} else {
    // Mensaje de error si no se especifica el ID del perfil en la URL
    echo "ID de perfil no especificado.";
}
?>
