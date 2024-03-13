<?php
include("../conexion.php");

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_periodo = $_GET['id'];
    
    // Consulta para cambiar el estado del período a 0 (eliminado)
    $sql = "UPDATE periodo SET estado_periodo = 0 WHERE id_periodo = $id_periodo";
    $resultado = mysqli_query($conn, $sql);
    
    if($resultado) {
        header("Location: ver_periodo.php");
        exit();
    } else {
        echo "Error al eliminar el período: " . mysqli_error($conn);
    }
} else {
    echo "ID de período no proporcionado.";
}
?>
