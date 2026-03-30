


    <!-- Admin -->
    <?php 
        $barra_admin = "<nav class='navbar navbar-light border border-dark bg-grey py-3'>
            <div class='container-fluid px-2 d-flex flex-column align-items-center'>
                
                <!-- Logo arriba -->
                <a class='navbar-brand mb-3 fs-5 fw-bold' href='#'>
                    <h1 class='titulo-grande w-100 text-center mb-2 text-wrap'>Portal Empleados</h1>
                </a>

                <!-- Menú debajo -->
                <ul class='navbar-nav d-flex flex-row flex-wrap justify-content-center text-center w-100'>
                    <li class='nav-item fs-5 col-6 col-md-auto'>
                        <a class='nav-link px-2' href='mi_info.php'>Mi info</a>
                    </li>
                    <li class='nav-item fs-5 dropdown position-relative col-6 col-md-auto'>
                        <a class='nav-link px-2 dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Empleados</a>
                        <ul class='dropdown-menu bg-grey'>
                            <li class='bg-grey'><a class='dropdown-item' href='ver_empleados.php'>Ver empleados</a></li>
                            <li class='bg-grey'><a class='dropdown-item' href='#'>Añadir empleado</a></li>
                        </ul>
                    </li>
                    <li class='nav-item fs-5 dropdown position-relative col-6 col-md-auto'>
                        <a class='nav-link px-2 dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>Departamentos</a>
                        <ul class='dropdown-menu bg-grey'>
                            <li class='bg-grey'><a class='dropdown-item' href='ver_departamentos.php'>Ver departamentos</a></li>
                            <li class='bg-grey'><a class='dropdown-item' href='nuevo_departamento.php'>Añadir departamentos</a></li>
                        </ul>
                    </li>
                    <li class='nav-item fs-5 col-6 col-md-auto'>
                        <a class='nav-link px-2' href='ver_incidencias.php'>Incidencias</a>
                    </li>
                    <li class='nav-item fs-5 col-6 col-md-auto'>
                        <a class='nav-link px-2' href='mis_nominas.php'>Mis Nóminas</a>
                    </li>
                    <li class='nav-item fs-5 col-6 col-md-auto'>
                        <a class='nav-link px-2' href='../../back/auth/salir.php'>Cerrar sesion</a>
                    </li>
                </ul>

            </div>
        </nav>";
    
    

    // <!-- jefe -->
    $barra_jefe = "<nav class='navbar navbar-light border border-dark bg-grey py-3'>
            <div class='container-fluid px-2 d-flex flex-column align-items-center'>
                
                <!-- Logo arriba -->
                <a class='navbar-brand mb-3 fs-5 fw-bold' href='#'>
                    <h1 class='titulo-grande w-100 text-center mb-2 text-wrap'>Portal Empleados</h1>
                </a>

                <!-- Menú debajo -->
                <ul class='navbar-nav d-flex flex-row flex-wrap justify-content-center gap-2 text-center'>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='mi_info.php'>Mi info</a>
                    </li>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='empleados_departamento.php'>Empleados</a>
                    </li>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='ver_departamento.php'>Departamento</a>
                    </li>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='reportar_incidencia.php'>Reportar incidencia</a>
                    </li>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='mis_nominas.php'>Mis Nóminas</a>
                    </li>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='../../back/auth/salir.php'>Cerrar sesion</a>
                    </li>
                </ul>

            </div>
        </nav>";
        

    // <!-- normal -->
        $barra_normal = "<nav class='navbar navbar-light border border-dark bg-grey py-3'>
            <div class='container-fluid px-2 d-flex flex-column align-items-center'>
                
                <!-- Logo arriba -->
                <a class='navbar-brand mb-3 fs-5 fw-bold' href='#'>
                    <h1 class='titulo-grande w-100 text-center mb-2 text-wrap'>Portal Empleados</h1>
                </a>

                <!-- Menú debajo -->
                <ul class='navbar-nav d-flex flex-row flex-wrap justify-content-center gap-2 text-center'>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='mi_info.php'>Mi info</a>
                    </li>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='ver_departamento.php'>Departamento</a>
                    </li>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='reportar_incidencia.php'>Reportar incidencia</a>
                    </li>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='mis_nominas.php'>Mis Nóminas</a>
                    </li>
                    <li class='nav-item fs-5'>
                        <a class='nav-link px-2' href='../../back/auth/salir.php'>Cerrar sesion</a>
                    </li>
                </ul>

            </div>
        </nav>";
        
        ?>