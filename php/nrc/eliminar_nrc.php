<?php
include("../conexion.php");

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_nrc = $_GET['id'];
    
    // Consulta para cambiar el estado del NRC a 0 (eliminado)
    $sql = "UPDATE nrc SET estado_nrc = 0 WHERE id_nrc = $id_nrc";
    $resultado = mysqli_query($conn, $sql);
    
    if($resultado) {
        header("Location: ver_nrc.php");
        exit();
    } else {
        echo "Error al eliminar el NRC: " . mysqli_error($conn);
    }
} else {
    echo "ID de NRC no proporcionado.";
}
?>
