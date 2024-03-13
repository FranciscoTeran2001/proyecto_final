<?php
include("conexion.php");

$sql = "SELECT a.nombre AS nombre_aula, d.nombres AS nombre_docente, m.nombre AS nombre_materia, asig.id_asignacion
        FROM asignaciones asig
        JOIN aulas a ON asig.id_aula = a.id_aula
        JOIN docentes d ON asig.id_docente = d.id_docente
        JOIN materias m ON asig.id_materia = m.id_materia
        ORDER BY asig.id_asignacion ASC";


$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lista de Asignaciones</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/style_nav.css" rel="stylesheet">
  <style>
    .content {
      margin-top: 80px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <?php include('nav.php');?>
  </nav>
  <div class="container">
    <div class="content">
      <h2>Lista de Asignaciones</h2>
      <hr />

      <table class="table table-striped table-hover">
        <tr>
          <th>Aula</th>
          <th>Docente</th>
          <th>Materia</th>
          <th>Acciones</th>
        </tr>
        <?php
        if(mysqli_num_rows($result) == 0){
          echo '<tr><td colspan="4">No hay datos.</td></tr>';
        }else{
          while($row = mysqli_fetch_assoc($result)){
            echo '
            <tr>
                <td>'.$row['nombre_aula'].'</td>
              <td>'.$row['nombre_docente'].'</td>
              <td>'.$row['nombre_materia'].'</td>
              <td>
                <a href="edit_asignacion.php?nik='.$row['id_asignacion'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                <a href="index.php?aksi=delete&nik='.$row['id_asignacion'].'" title="Eliminar" onclick="return confirm(\'¿Estás seguro de borrar esta asignación?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
              </td>
            </tr>
            ';
          }
        }
        ?>
      </table>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>
