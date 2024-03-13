<?php
include("../conexion.php");

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id_nrc = $_GET['id'];
    
    // Consulta para restaurar el NRC (cambiar estado_nrc a 1)
    $sql = "UPDATE nrc SET estado_nrc = 1 WHERE id_nrc = $id_nrc";
    $resultado = mysqli_query($conn, $sql);
    
    if($resultado) {
        header("Location: nrc_eliminados.php");
        exit();
    } else {
        echo "Error al restaurar el NRC: " . mysqli_error($conn);
    }
} else {
    echo "ID de NRC no proporcionado.";
}
?>
