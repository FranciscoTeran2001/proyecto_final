<?php
include("../conexion.php");

// Consulta para obtener las carreras
$sql = "SELECT id_carrera, nombre_carrera FROM carrera WHERE estado_carrera = 1";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Carreras</title>
    <!-- Bootstrap -->
</head>
<body>
<?php include('../pagina/header.php'); ?>
<div class="col py-3">
    <div class="container">
        <h2>Visualizar Carreras</h2>
        <hr />

        <table class="table table-striped table-hover">
            <tr>
                <th>ID Carrera</th>
                <th>Nombre Carrera</th>
                <th>Acciones</th>
            </tr>
            <?php
            if(mysqli_num_rows($result) == 0){
                echo '<tr><td colspan="3">No hay datos.</td></tr>';
            }else{
                while($row = mysqli_fetch_assoc($result)){
                    echo '
                    <tr>
                        <td>'.$row['id_carrera'].'</td>
                        <td>'.$row['nombre_carrera'].'</td>
                        <td>
                            <a data-url="editar_carrera.php?id='.$row['id_carrera'].'" class="btn btn-primary btn-sm load-modal-content" data-bs-toggle="modal" data-bs-target="#forModal">Editar</a>
                            <a href="eliminar_carrera.php?id='.$row['id_carrera'].'" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                    ';
                }
            }
            ?>
        </table>
    </div>
<!-- Estructura del Modal -->
<div class="modal fade" id="forModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php include('../pagina/footer.php'); ?>    



