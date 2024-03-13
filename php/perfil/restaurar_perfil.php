<?php
include("../conexion.php");

// Verificar si se proporcionó un ID de perfil válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del perfil desde la URL
    $id_perfil = $_GET['id'];

    // Restaurar el perfil cambiando su estado a 1 (activo)
    $sql_restaurar = "UPDATE perfil SET estado_perfil = 1 WHERE id_perfil = $id_perfil";

    if (mysqli_query($conn, $sql_restaurar)) {
        // Redireccionar de nuevo a la página de visualización de perfiles eliminados
        header("Location: perfiles_eliminados.php");
        exit();
    } else {
        echo "Error al intentar restaurar el perfil: " . mysqli_error($conn);
    }
} else {
    echo "ID de perfil no especificado.";
}
?>
