<?php
// Obtener el ID del NRC desde la solicitud GET
$idNrc = $_GET['idNrc'];

// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "proyectoweb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los detalles del NRC
$sql = "SELECT nrc.codigo_nrc, docente.nombre_docente, materia.nombre_materia 
        FROM nrc 
        INNER JOIN docente ON nrc.id_docente = docente.id_docente 
        INNER JOIN materia ON nrc.id_materia = materia.id_materia 
        WHERE nrc.id_nrc = $idNrc";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Obtener el primer resultado (debería haber solo uno)
    $row = $result->fetch_assoc();
    // Construir la cadena con los detalles del NRC
    $detalleNrc = "Código del NRC: " . $row["codigo_nrc"] . "<br>";
    $detalleNrc .= "Nombre del Docente: " . $row["nombre_docente"] . "<br>";
    $detalleNrc .= "Materia: " . $row["nombre_materia"] . "<br>";
} else {
    $detalleNrc = "No se encontraron detalles para este NRC";
}

// Cerrar la conexión
$conn->close();

echo $detalleNrc;
?>
