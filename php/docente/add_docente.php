<?php
include("../conexion.php");




    $nombre_docente = mysqli_real_escape_string($conn, $_POST["nombre_docente"]);
    $cedula_docente = mysqli_real_escape_string($conn, $_POST["cedula_docente"]);
    $correo_docente = mysqli_real_escape_string($conn, $_POST["correo_docente"]);
    $telefono_docente = mysqli_real_escape_string($conn, $_POST["telefono_docente"]);
    $especializacion_docente = mysqli_real_escape_string($conn, $_POST["especializacion_docente"]);
    $horas_clase_docente = mysqli_real_escape_string($conn, $_POST["horas_clase_docente"]);
    $estado_docente = 1; // Asignar estado automáticamente como 1
    
    $insert = mysqli_query($conn, "INSERT INTO `docente`(`nombre_docente`, `cedula_docente`, `correo_docente`, `telefono_docente`, `especializacion_docente`, `horas_clase_docente`, `estado_docente`)
                    VALUES('$nombre_docente', '$cedula_docente', '$correo_docente', '$telefono_docente', '$especializacion_docente', '$horas_clase_docente', '$estado_docente')");

?>


