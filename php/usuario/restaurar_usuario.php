<?php
include("../conexion.php");

// Verificar si se proporcionó un ID de usuario válido en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de usuario desde la URL
    $id_usuario = $_GET['id'];

    // Consultar si el usuario es un docente
    $sql_docente = "SELECT id_docente FROM docente WHERE nombre_docente IN (SELECT nombre_usuario FROM usuario WHERE id_usuario = $id_usuario)";
    $result_docente = mysqli_query($conn, $sql_docente);

    // Si el usuario es un docente, cambiar su estado en la tabla docente y el estado de los NRC asociados
    if (mysqli_num_rows($result_docente) > 0) {
        $row_docente = mysqli_fetch_assoc($result_docente);
        $id_docente = $row_docente['id_docente'];
        
        // Restaurar el estado del docente en la tabla docente
        $sql_restore_docente = "UPDATE docente SET estado_docente = 1 WHERE id_docente = $id_docente";
        mysqli_query($conn, $sql_restore_docente);
        
     
    }

    // Restaurar el estado del usuario en la tabla usuario
    $sql_restore_usuario = "UPDATE usuario SET estado_usuario = 1 WHERE id_usuario = $id_usuario";
    if (mysqli_query($conn, $sql_restore_usuario)) {
        // Restaurar el estado del perfil asociado al usuario en la tabla perfil
        $sql_restore_perfil = "UPDATE perfil SET estado_perfil = 1 WHERE id_usuario = $id_usuario";
        mysqli_query($conn, $sql_restore_perfil);

        // Redirigir a la página de usuarios eliminados con un mensaje de éxito
        header("Location: usuarios_eliminados.php?restaurado=true");
        exit();
    } else {
        // Redirigir a la página de usuarios eliminados con un mensaje de error
        header("Location: usuarios_eliminados.php?restaurado=false");
        exit();
    }
} else {
    // Redirigir a la página de usuarios eliminados si no se proporciona un ID de usuario válido
    header("Location: usuarios_eliminados.php");
    exit();
}
?>


