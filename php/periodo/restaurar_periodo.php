<?php
include("../conexion.php");

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_periodo = $_GET['id'];
    
    // Consulta para restaurar el período (cambiar estado_periodo a 1)
    $sql = "UPDATE periodo SET estado_periodo = 1 WHERE id_periodo = $id_periodo";
    $resultado = mysqli_query($conn, $sql);
    
    if($resultado) {
        header("Location: periodos_eliminados.php");
    } else {
        echo "Error al restaurar el período: " . mysqli_error($conn);
    }
} else {
    echo "ID de período no proporcionado.";
}
?>
