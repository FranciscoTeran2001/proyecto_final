
<?php
include('../conexion.php');
//filtrar solo los que son docentes
$query_nombres_docentes = "SELECT usuario.nombre_usuario, usuario.id_usuario FROM usuario INNER JOIN perfil ON usuario.id_usuario = perfil.id_usuario WHERE perfil.tipo_perfil = 'docente'";
$resultado_nombres_docentes = mysqli_query($conn, $query_nombres_docentes);
?>

<div class="container">
    <div class="content">
        <h2>Registro de docentes</h2>
        <hr />

        <form class="form-horizontal" action="agregar_docente.php" method="post">
            <div class="form-group">
                <label class="col-sm-3 control-label">Nombre del Docente</label>
                <div class="col-sm-6">
                    <select name="nombre_docente_input" id="nombre_docente_input" class="form-control" required>
                        <?php
                        while ($row_docente = mysqli_fetch_assoc($resultado_nombres_docentes)) {
                            echo "<option value='{$row_docente['nombre_usuario']}'>{$row_docente['nombre_usuario']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Cédula de Identidad</label>
                <div class="col-sm-6">
                    <input type="text" name="cedula_docente_input" id="cedula_docente_input" class="form-control" placeholder="Cédula de Identidad" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Correo Electrónico</label>
                <div class="col-sm-6">
                    <input type="email" name="correo_docente_input" id="correo_docente_input" class="form-control" placeholder="Correo Electrónico">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Teléfono</label>
                <div class="col-sm-6">
                    <input type="text" name="telefono_docente_input" id="telefono_docente_input" class="form-control" placeholder="Teléfono">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Especialización</label>
                <div class="col-sm-6">
                    <input type="text" name="especializacion_docente_input" id="especializacion_docente_input" class="form-control" placeholder="Especialización">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Horas de Clases</label>
                <div class="col-sm-6">
                    <input type="number" name="horas_clase_docente_input" id="horas_clase_docente_input" class="form-control" placeholder="Horas de Clases">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <input type="submit" name="agregar_docente" class="btn btn-success" value="Agregar">
                </div>
            </div>
        </form>
    </div>
</div>
