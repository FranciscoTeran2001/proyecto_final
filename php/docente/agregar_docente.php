<?php
include('../conexion.php');

// Obtener los datos del formulario
$nombre_docente = $_POST['nombre_docente_input'];
$cedula_docente = $_POST['cedula_docente_input'];
$correo_docente = $_POST['correo_docente_input'];
$telefono_docente = $_POST['telefono_docente_input'];
$especializacion_docente = $_POST['especializacion_docente_input'];
$horas_clase_docente = $_POST['horas_clase_docente_input'];
$estado_docente = 1; // Estado predeterminado

// Preparar la consulta para insertar los datos en la tabla 'docente'
$query_insertar_docente = "INSERT INTO docente (nombre_docente, cedula_docente, correo_docente, telefono_docente, especializacion_docente, horas_clase_docente, estado_docente) VALUES ('$nombre_docente', '$cedula_docente', '$correo_docente', '$telefono_docente', '$especializacion_docente', '$horas_clase_docente', '$estado_docente')";

// Ejecutar la consulta
if(mysqli_query($conn, $query_insertar_docente)) {
    echo "Docente agregado exitosamente.";
} else {
    echo "Error al agregar el docente: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
