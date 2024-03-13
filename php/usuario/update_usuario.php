<?php
include("../conexion.php");

// Definir una variable para almacenar el mensaje de actualización
$update_message = '';

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $usuario_usuario = $_POST['usuario_usuario'];
    
    // Consultar el nombre de usuario anterior
    $sql_nombre_anterior = "SELECT nombre_usuario FROM usuario WHERE id_usuario = $id_usuario";
    $result_nombre_anterior = mysqli_query($conn, $sql_nombre_anterior);
    $row_nombre_anterior = mysqli_fetch_assoc($result_nombre_anterior);
    $nombre_usuario_anterior = $row_nombre_anterior['nombre_usuario'];

    // Actualizar los datos del usuario en la base de datos
    $sql_usuario = "UPDATE usuario 
                    SET nombre_usuario = '$nombre_usuario', 
                        usuario_usuario = '$usuario_usuario'
                    WHERE id_usuario = $id_usuario";

    if (mysqli_query($conn, $sql_usuario)) {
        // Establecer el mensaje de actualización exitosa
        $update_message = 'El usuario se ha actualizado correctamente.';
        
        // Verificar si el usuario modificado es un docente
        $sql_es_docente = "SELECT * FROM docente WHERE nombre_docente = '$nombre_usuario_anterior'";
        $result_es_docente = mysqli_query($conn, $sql_es_docente);

        if (mysqli_num_rows($result_es_docente) == 1) {
            // Actualizar el nombre del docente en la tabla docente
            $sql_docente = "UPDATE docente 
                            SET nombre_docente = '$nombre_usuario'
                            WHERE nombre_docente = '$nombre_usuario_anterior'";
            mysqli_query($conn, $sql_docente);
        }
    } else {
        // Establecer el mensaje de error de actualización
        $update_message = 'Error al actualizar el usuario: ' . mysqli_error($conn);
    }
}
?>
