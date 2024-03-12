<?php
include('conexion.php');
session_start();
if (!isset($_SESSION['nombredelusuario'])) {
    header('location: ../index.html');
}
//cerrar sesion
if (isset($_POST['btncerrar'])) {
    session_destroy();
    header('location: ../index.html');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.84.0" />
    <title>Dashboard Template · Bootstrap v5.0</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .dropdown-item-container {
            margin-bottom: 20px;
            /* Ajusta este valor según el espacio deseado entre los elementos */
        }
    </style>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">


</head>

<body>


    <!-- Estructura del Modal -->

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

    <div class="container-fluid  ">
        <div class="row  ">
            <nav class=" col-lg-2 d-md-block  sidebar collapse bg-dark ">
                <div>
                    <header class="navbar  flex-md-nowrap p-0 shadow  sidebar-content "
                        style="background-color:#3E3E3E">
                        <h1 class="navbar-brand col-md-3 col-lg-2 me-0 px-3" style="color:white">Registro Horarios</h1>

                    </header>
                    <hr style="background-color: white;">
                    <ul class="nav flex-column ">
                        <li class="nav-item">
                            <?php
                            session_start();
                            if (isset($_SESSION['nombredelusuario'])) {
                                $usuarioingresado = $_SESSION['nombredelusuario'];
                                echo "<h4 style='color:white'>Bienvenido: $usuarioingresado </h4>";
                            } else {
                                header('location: ../index.html');
                            }
                            ?>

                        </li>
                        <hr style="background-color: white;">
                     
                            <div class="dropdown dropdown dropdown-item-container">
                                <a class="dropdown-toggle " href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Usuarios
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                                    <li class="nav-item"><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Registrar usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Asignar perfil a usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="add_aula.php">Lista de usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link" href="#">Lista de
                                            perfiles</a></li>
                                </ul>
                            </div>
                            <div class="dropdown dropdown dropdown-item-container ">
                                <a class="dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Docente
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                                    <li class="nav-item"><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Ver docentes</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Asignar perfil a usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="add_aula.php">Lista de usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link" href="#">Lista de
                                            perfiles</a></li>
                                </ul>
                            </div>

                            <div class="dropdown dropdown dropdown-item-container ">
                                <a class="dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aulas
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                                    <li class="nav-item"><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Detalles de aulas</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Asignar perfil a usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="add_aula.php">Lista de usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link" href="#">Lista de
                                            perfiles</a></li>
                                </ul>
                            </div>


                            <div class="dropdown dropdown dropdown-item-container ">
                                <a class="dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Registro de novedades de aulas
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                                    <li class="nav-item"><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Detalles de aulas</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Asignar perfil a usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="add_aula.php">Lista de usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link" href="#">Lista de
                                            perfiles</a></li>
                                </ul>
                            </div>

                            <div class="dropdown dropdown dropdown-item-container ">
                                <a class="dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Materia y carreras
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                                    <li class="nav-item"><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Detalles de aulas</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Asignar perfil a usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="add_aula.php">Lista de usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link" href="#">Lista de
                                            perfiles</a></li>
                                </ul>
                            </div>

                            <div class="dropdown dropdown dropdown-item-container ">
                                <a class="dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    detalles horarios
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                                    <li class="nav-item"><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Detalles de aulas</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Asignar perfil a usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="add_aula.php">Lista de usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link" href="#">Lista de
                                            perfiles</a></li>
                                </ul>
                            </div>

                            <div class="dropdown dropdown dropdown-item-container ">
                                <a class="dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    eiminados
                                </a>

                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuLink">
                                    <li class="nav-item"><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Detalles de aulas</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="registrar_usuarios.php">Asignar perfil a usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link"
                                            href="add_aula.php">Lista de usuarios</a></li>
                                    <li><a class="dropdown-item nav-link  dynamic-content-link" href="#">Lista de
                                            perfiles</a></li>
                                </ul>
                            </div>
                        <div style="position: absolute; bottom: 0; padding: 20px;">
                            <form method="POST">
                                <button type="submit" class="btn btn-danger" name="btncerrar">cerrar sesion</button>
                            </form>
                        </div>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="mostrar">
                <h>hola mundo </h>
            </main>
        </div>
    </div>
    </div>







    <!--jquery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/pet_ajax.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>