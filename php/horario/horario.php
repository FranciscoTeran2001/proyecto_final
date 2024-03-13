<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop Horario</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../../css/styleH.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <?php include('nav.php'); ?>
    </nav>
    <h2>Creación de Horario</h2>
    <div class="container">
        <!-- Primera fila con dos secciones -->
        <div class="row">
            <div class="col-md-6">
                <div class="bg-primary p-3 mb-3">
                    <h2>Seleccionar NRC</h2>
                    <form id="nrcForm">
                        <div class="form-group">
                            <label for="nrcSelect">Seleccione el NRC que quiere registrar en el horario:</label>
                            <select class="form-control" id="nrcSelect" name="nrcSelect">
                                <?php
                                // Establecer la conexión a la base de datos
                                $servername = "localhost";
                                $username = "admin";
                                $password = "admin";
                                $dbname = "proyectoweb";

                                // Crear conexión
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Verificar la conexión
                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }

                                // Consulta SQL para obtener los NRCs seguido de la materia a la que pertenecen
                                $sql = "SELECT nrc.id_nrc, nrc.codigo_nrc, materia.nombre_materia, carrera.nombre_carrera FROM nrc INNER JOIN materia ON nrc.id_materia = materia.id_materia INNER JOIN carrera ON materia.id_carrera = carrera.id_carrera";
                                $result = $conn->query($sql);
                                // Verificar si hay resultados
                                if ($result->num_rows > 0) {
                                    // Iterar sobre los resultados y mostrarlos en el campo de selección
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['id_nrc'] . "'>" . $row['codigo_nrc'] . " - " . $row['nombre_materia'] . " - " . $row['nombre_carrera'] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>No hay NRCs disponibles</option>";
                                }

                                // Cerrar la conexión
                                $conn->close();
                                ?>
                            </select>
                        </div>
                        <button type="button" class="btn btn-warning" onclick="crearDiv()" style="margin-top:3%;">Crear Bloque NRC</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="bg-secondary p-3 mb-3">
                    <h2>Detalles del NRC</h2>
                    <div id="detalleNrc" class="nrcs">

                    </div>
                </div>
            </div>
        </div>

        <!-- Segunda fila con una sección -->
        <div class="row">
            <div class="col-md-12">
                <div class="bg-info p-3">
                    <h2>Horario</h2>
                    <form id="filterForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="aulaSelect">Seleccionar Aula:</label>
                                <select class="form-control" id="aulaSelect" name="aulaSelect">
                                    <option value="" selected disabled>Seleccionar Aula</option>
                                    <?php
                                    // Establecer la conexión a la base de datos
                                    $servername = "localhost";
                                    $username = "admin";
                                    $password = "admin";
                                    $dbname = "proyectoweb";

                                    // Crear conexión
                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    // Verificar la conexión
                                    if ($conn->connect_error) {
                                        die("Conexión fallida: " . $conn->connect_error);
                                    }

                                    // Consulta SQL para obtener las aulas
                                    $sql = "SELECT id_aula, nombre_aula, bloque_aula FROM aula";
                                    $result = $conn->query($sql);

                                    // Verificar si hay resultados
                                    if ($result->num_rows > 0) {
                                        // Iterar sobre los resultados y mostrarlos en el campo de selección
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['id_aula'] . "'>" . $row['bloque_aula'] . $row['nombre_aula'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay aulas disponibles</option>";
                                    }

                                    // Cerrar la conexión
                                    $conn->close();
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="periodoSelect">Seleccionar Periodo:</label>
                                <select class="form-control" id="periodoSelect" name="periodoSelect">
                                    <option value="" selected disabled>Seleccionar Periodo</option>
                                    <?php

                                    include("conexion.php");
                                    // Consulta SQL para obtener los periodos
                                    $sql = "SELECT id_periodo, fecha_inicio, fecha_final, nombre_periodo FROM periodo";
                                    $result = $conn->query($sql);

                                    // Verificar si hay resultados
                                    if ($result->num_rows > 0) {
                                        // Iterar sobre los resultados y mostrarlos en el campo de selección
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['id_periodo'] . "'>" . $row['nombre_periodo'] . " - " . $row['fecha_inicio'] . " - " . $row['fecha_final'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay periodos disponibles</option>";
                                    }

                                    // Cerrar la conexión (puedes reutilizar la misma conexión que arriba)
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>
                    <br>
                    <table id="horario" class="horario">
                        <thead>
                            <tr>
                                <th></th>
                                <?php
                                // Obtener los nombres de los días de la base de datos
                                $servername = "localhost";
                                $username = "admin";
                                $password = "admin";
                                $dbname = "proyectoweb";

                                // Crear conexión
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Verificar la conexión
                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }

                                // Consulta SQL para obtener los nombres de los días
                                $sql = "SELECT dia_fd FROM franja_dias";
                                $result = $conn->query($sql);

                                // Mostrar los nombres de los días como encabezados
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<th>" . $row['dia_fd'] . "</th>";
                                    }
                                } else {
                                    echo "<th>No hay días disponibles</th>";
                                }

                                // Cerrar la conexión
                                $conn->close();
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Obtener las franjas horarias de la base de datos
                            $servername = "localhost";
                            $username = "admin";
                            $password = "admin";
                            $dbname = "proyectoweb";

                            // Crear conexión
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta SQL para obtener las franjas horarias
                            $sql = "SELECT hora_fh FROM franja_horaria";
                            $result = $conn->query($sql);

                            // Mostrar las franjas horarias y crear las filas correspondientes en la tabla
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['hora_fh'] . "</td>";
                                    // Rellenar las celdas con las franjas horarias
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo "<td class='hora droppable'></td>";
                                    }
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No hay franjas horarias disponibles</td></tr>";
                            }

                            // Cerrar la conexión
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                    <br>
                    <button type="button" class="btn btn-primary" id="guardarHorarioBtn">Guardar Horario</button>

                </div>
            </div>
        </div>
        <br><br>
    </div>

    <script src="../../js/scriptHorario.js">
    </script>


</body>

</html>