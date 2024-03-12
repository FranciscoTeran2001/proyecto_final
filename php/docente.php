<div class="cajafuera">
    <div class="pagprincipal">

        <?php
include("conexion.php");

//filtrar solo los que tengan estado 1 y mostrar
$sql = "SELECT * FROM docente WHERE estado_docente=1 ORDER BY id_docente";
$result = mysqli_query($conn, $sql);
//filtrar solo los que son docentes
$query_nombres_docentes = "SELECT usuario.nombre_usuario, usuario.id_usuario FROM usuario INNER JOIN perfil ON usuario.id_usuario = perfil.id_usuario WHERE perfil.tipo_perfil = 'docente'";
$resultado_nombres_docentes = mysqli_query($conn, $query_nombres_docentes);
?>




    </div>

</div>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Docentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php include('modal_agregar_docente.php'); ?>


    
    <form method="POST">
        <tr>
            <td colspan='2' align="center"><input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        </tr>
    </form>
    <h2>Lista de docentes</h2>
    <hr />
    <div class="col-sm-6">
        <a href="#addDocenteModal" class="btn btn-success" data-toggle="modal">
            <i class="material-icons">&#xE147;</i><span>Añadir Nuevo Docente</span></a>
    </div>
    <table class="table table-striped table-hover">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Cédula de Identidad</th>
            <th>Correo Electrónico</th>
            <th>Teléfono</th>
            <th>Área de Especialización</th>
            <th>Horas de Clases</th>
            <th>Acciones</th>
        </tr>
        <?php
                if(mysqli_num_rows($result) == 0){
                    echo '<tr><td colspan="8">No hay datos.</td></tr>';
                }else{
                    $no = 1;
                    while($row = mysqli_fetch_assoc($result)){
                        echo '
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
                ?>
    </table>

    <script>
    function addEmpleado() {
        var nombre_docente = $('#nombre_docente_input').val();
        var cedula_docente = $('#cedula_docente_input').val();
        var correo_docente = $('#correo_docente_input').val();
        var telefono_docente = $('#telefono_docente_input').val();
        var especializacion_docente = $('#especializacion_docente_input').val();
        var horas_clase_docente = $('#horas_clase_docente_input').val();

        $.ajax({
            type: 'POST',
            url: 'add_docente.php',
            data: {
                nombre_docente: nombre_docente,
                cedula_docente: cedula_docente,
                correo_docente: correo_docente,
                telefono_docente: telefono_docente,
                especializacion_docente: especializacion_docente,
                horas_clase_docente: horas_clase_docente
            },
            success: function(response) {
                // Manejar la respuesta aquí
                alert('Docente agregado exitosamente');
                // Actualizar la tabla después de agregar el usuario
                updateTable();
                // Cerrar el modal si es necesario
                $('#addDocenteModal').modal('hide');
            },
            error: function(xhr, status, error) {
                // Manejar errores aquí
                console.error(xhr);
            }
        });
    }

    function updateTable() {
        $.ajax({
            type: 'GET',
            url: 'actualizar_tabla_docente.php', // Archivo PHP que actualiza la tabla
            success: function(data) {
                // Reemplazar el contenido de la tabla con los nuevos datos
                $('.table').html(data);
            },
            error: function(xhr, status, error) {
                // Manejar errores aquí
                console.error(xhr);
            }
        });
    }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>