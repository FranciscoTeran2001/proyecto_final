<div class="row flex-nowrap">
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-5 d-none d-sm-inline">Menu</span>
            </a>
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                <li class="nav-item">
                    <a href="../pagina/principal.php" class="nav-link align-middle px-0">
                        <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Usuario</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="../usuario/ver_usuarios.php" class="nav-link px-0">Ver usuario</a>
                        </li>
                        <li>
                            <a href="../perfil/ver_perfiles.php" class="nav-link px-0">Ver perfiles</a>
                        </li>
                        <li>
                            <a href="../usuario/usuarios_eliminados.php" class="nav-link px-0">lista de eliminados</a>
                        </li>
                    
                    </ul>
                </li>
                <li>
                    <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Docente</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="../docente/ver_docente.php" class="nav-link px-0">ver docentes</a>
                        </li>
                        <li>
                            <a href="../perfil/ver_perfiles.php" class="nav-link px-0">Ver perfiles</a>
                        </li>
                        <li>
                            <a href="../usuario/usuarios_eliminados.php" class="nav-link px-0">lista de eliminados</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Aula</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="../aula/ver_aula.php" class="nav-link px-0">ver Aulas</a>
                        </li>
                        <li>
                            <a href="../aula/aulas_eliminados.php" class="nav-link px-0">lista de eliminados</a>
                        </li>
                    
                    </ul>
                </li>
                <li>
                    <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Novedades</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="../novedad/ver_registros_novedad.php" class="nav-link px-0">Ver registros</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#submenu6" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Carrera y Materias</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu6" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="../carrera/ver_carreras.php" class="nav-link px-0">Ver carreras</a>
                        </li>
                        <li class="w-100">
                            <a href="../materia/ver_materias.php" class="nav-link px-0">Ver materias</a>
                        </li>
                        <li class="w-100">
                            <a href="../carrera/carreras_eliminadas.php" class="nav-link px-0">Carreras eliminadas</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#submenu7" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Horarios</span> </a>
                    <ul class="collapse nav flex-column ms-1" id="submenu7" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="../nrc/ver_nrc.php" class="nav-link px-0">Ver NRC</a>
                        </li>
                        <li class="w-100">
                            <a href="../nrc/add_nrc.php" class="nav-link px-0">agregar nrc</a>
                        </li>
                        <li class="w-100">
                            <a href="../periodo/ver_periodo.php" class="nav-link px-0">Ver periodo</a>
                        </li>
                        <li class="w-100">
                            <a href="../periodo/add_periodo.php" class="nav-link px-0">agregar periodo</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <hr>
            <form method="POST">
                <button type="submit" class="btn btn-danger" name="btncerrar">cerrar sesion</button>
            </form>
        </div>
    </div>