<?php
include("../conexion.php");

if(isset($_POST['add'])){
    $tipo_perfil = mysqli_real_escape_string($conn, $_POST["tipo_perfil"]);
    $atributos_perfil = implode(", ", $_POST["atributos_perfil"]); // Convertimos el array de atributos a una cadena separada por comas
    $id_usuario = mysqli_real_escape_string($conn, $_POST["id_usuario"]);
    
    $insert = mysqli_query($conn, "INSERT INTO perfil (tipo_perfil, atributos_perfil, id_usuario,estado_perfil) 
                                   VALUES ('$tipo_perfil', '$atributos_perfil', '$id_usuario',1)");

     if($insert){
        // Alerta de éxito si la inserción es exitosa
        echo "<script> alert('El perfil se ha agregado correctamente');window.location= 'add_perfil.php' </script>";
    }else{
        // Alerta de error si hay un problema en la inserción
        echo "<script> alert('Error. No se pudo agregar el perfil.');window.location= 'add_perfil.php' </script>";
    }
}

// Consulta para obtener los usuarios para el selector
$query_usuarios = "SELECT id_usuario, usuario_usuario FROM usuario";
$result_usuarios = mysqli_query($conn, $query_usuarios);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario de Registro de Perfil</title>
    <!-- Bootstrap -->
    <style>
        .content {
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Datos de perfil &raquo; Agregar datos</h2>
            <hr />

            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Tipo de Perfil</label>
                    <div class="col-sm-4">
                        <select name="tipo_perfil" class="form-control" required>
                            <option value="administrador">Administrador</option>
                            <option value="docente">Docente</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Atributos del Perfil</label>
                    <div class="col-sm-4">
                        <div class="checkbox">
                            <label><input type="checkbox" name="atributos_perfil[]" value="lector">Lector</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="atributos_perfil[]" value="editor">Editor</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Usuario</label>
                    <div class="col-sm-4">
                        <select name="id_usuario" class="form-control" required>
                            <?php while($row = mysqli_fetch_assoc($result_usuarios)): ?>
                                <option value="<?php echo $row['id_usuario']; ?>"><?php echo $row['usuario_usuario']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">

                        <input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
                        <a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


