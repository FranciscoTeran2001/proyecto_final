<?php
include("../conexion.php");

// Verificar si se proporcionó un ID de usuario válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del usuario desde la URL
    $id_usuario = $_GET['id'];

    // Actualizar el estado del usuario a 0
    $sql_usuario = "UPDATE usuario SET estado_usuario = 0 WHERE id_usuario = $id_usuario";

    if (mysqli_query($conn, $sql_usuario)) {
        // Verificar si el usuario es un docente
       $sql_docente = "SELECT id_docente FROM docente WHERE nombre_docente IN (SELECT nombre_usuario FROM usuario WHERE id_usuario = $id_usuario)";
        $result_docente = mysqli_query($conn, $sql_docente);

        if (mysqli_num_rows($result_docente) > 0) {
            // Si el usuario es un docente, cambiar su estado también a 0 en la tabla de docentes
            $row_docente = mysqli_fetch_assoc($result_docente);
            $id_docente = $row_docente['id_docente'];
            $sql_update_docente = "UPDATE docente SET estado_docente = 0 WHERE id_docente = $id_docente";
            mysqli_query($conn, $sql_update_docente);
        }

        // Actualizar el estado del perfil asociado al usuario a 0 en la tabla perfil
        $sql_perfil = "UPDATE perfil SET estado_perfil = 0 WHERE id_usuario = $id_usuario";
        mysqli_query($conn, $sql_perfil);

        // Redireccionar de nuevo a la página de visualización de usuarios
        header("Location: ver_usuarios.php");
        exit();
    } else {
        echo "Error al intentar eliminar el usuario: " . mysqli_error($conn);
    }
} else {
    echo "ID de usuario no especificado.";
}
?>


