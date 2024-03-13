<?php
include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar si ya está registrado el docente
    $cedula_docente = mysqli_real_escape_string($conn, $_POST["cedula_docente"]);
    $check_docente = mysqli_query($conn, "SELECT * FROM `docente` WHERE `cedula_docente` = '$cedula_docente'");
    if (mysqli_num_rows($check_docente) > 0) {
        echo "El docente ya está registrado.";
        exit(); // Detenemos la ejecución del script si el docente ya está registrado
    }

    // Validar si ya se registró la misma cedula
    if (!is_numeric($cedula_docente)) {
        echo "La cédula debe contener solo números.";
        exit();
    }

    // Validar el formato del email y si ya se registró el mismo correo electrónico
    $correo_docente = mysqli_real_escape_string($conn, $_POST["correo_docente"]);
    if (!filter_var($correo_docente, FILTER_VALIDATE_EMAIL)) {
        echo "El formato del correo electrónico es inválido.";
        exit();
    }
    $check_correo = mysqli_query($conn, "SELECT * FROM `docente` WHERE `correo_docente` = '$correo_docente'");
    if (mysqli_num_rows($check_correo) > 0) {
        echo "El correo electrónico ya está registrado.";
        exit();
    }

    // Validar si ya se registró el mismo teléfono y solo números
    $telefono_docente = mysqli_real_escape_string($conn, $_POST["telefono_docente"]);
    if (!is_numeric($telefono_docente)) {
        echo "El teléfono debe contener solo números.";
        exit();
    }
    $check_telefono = mysqli_query($conn, "SELECT * FROM `docente` WHERE `telefono_docente` = '$telefono_docente'");
    if (mysqli_num_rows($check_telefono) > 0) {
        echo "El teléfono ya está registrado.";
        exit();
    }

    // Validar horas de clases como números positivos enteros
    $horas_clase_docente = mysqli_real_escape_string($conn, $_POST["horas_clase_docente"]);
    if (!is_numeric($horas_clase_docente) || $horas_clase_docente <= 0 || strpos($horas_clase_docente, '.') !== false) {
        echo "Las horas de clases deben ser números positivos enteros.";
        exit();
    }

    // Si todas las validaciones pasan, insertamos los datos en la base de datos
    $nombre_docente = mysqli_real_escape_string($conn, $_POST["nombre_docente"]);
    $especializacion_docente = mysqli_real_escape_string($conn, $_POST["especializacion_docente"]);
    $estado_docente = 1; // Asignar estado automáticamente como 1
    
    $insert = mysqli_query($conn, "INSERT INTO `docente`(`nombre_docente`, `cedula_docente`, `correo_docente`, `telefono_docente`, `especializacion_docente`, `horas_clase_docente`, `estado_docente`)
                    VALUES('$nombre_docente', '$cedula_docente', '$correo_docente', '$telefono_docente', '$especializacion_docente', '$horas_clase_docente', '$estado_docente')");
}
?>

