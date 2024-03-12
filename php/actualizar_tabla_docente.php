<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Consulta para obtener los datos actualizados de la tabla
$sql = "SELECT * FROM docente WHERE estado_docente=1 ORDER BY id_docente";
$result = mysqli_query($conn, $sql);

// Generar el HTML de la tabla con los nuevos datos
$table_html = '<table class="table table-striped table-hover">';
$table_html .= '
    <tr>
        <th>No</th>
        <th>Nombre</th>
        <th>Cédula de Identidad</th>
        <th>Correo Electrónico</th>
        <th>Teléfono</th>
        <th>Área de Especialización</th>
        <th>Horas de Clases</th>
        <th>Acciones</th>
    </tr>';

if(mysqli_num_rows($result) == 0){
    $table_html .= '<tr><td colspan="8">No hay datos.</td></tr>';
} else {
    $no = 1;
    while($row = mysqli_fetch_assoc($result)){
        $table_html .= '
            <tr>
                <td>'.$no.'</td>
                <td>'.$row['nombre_docente'].'</td>
                <td>'.$row['cedula_docente'].'</td>
                <td>'.$row['correo_docente'].'</td>
                <td>'.$row['telefono_docente'].'</td>
                <td>'.$row['especializacion_docente'].'</td>
                <td>'.$row['horas_clase_docente'].'</td>
                <td>
                    <a href="editar_docente.php?id='.$row['id_docente'].'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                    <a href="index.php?aksi=delete&nik'.$row['id_docente'].'" title="Eliminar" onclick="return confirm(\'¿Estás seguro de borrar los datos de '.$row['nombre_docente'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                </td>
            </tr>
        ';
        $no++;
    }
}

// Cerrar la etiqueta de la tabla
$table_html .= '</table>';

// Devolver el HTML de la tabla
echo $table_html;
?>
