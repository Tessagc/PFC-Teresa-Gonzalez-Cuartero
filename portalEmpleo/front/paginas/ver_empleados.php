<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados de la empresa</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/funciones.js"></script>
</head>
<body class='fondo-web'>
    
    <?php
        // archivos necesarios
        try {
            require_once("../../back/auth/sesion.php");
            require("plantillas/barras_nav.php");
            require("../../back/auth/conexion_bbdd.php");
        } catch (\Throwable $th) {
            echo "No se pudo acceder a los archivos auxiliares";
        }

        // mostrar info y navegacion segun usuario
        try {
            // conexion
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");


            // sacar la info del usuario para trabajar
            $consulta = mysqli_query($conexion, "SELECT * FROM empleados WHERE cod_empleado = ".$id_sesion_usuario);
            $usuario = mysqli_fetch_array($consulta);

                // barras de navegacion
echo "<header>";
                if ($usuario['rol'] == "admin") { // barra de los admin
                    echo $barra_admin;
                } else if ($usuario['rol'] == "jefe") { // barra de los admin
                    echo $barra_jefe;
                } else if ($usuario['rol'] == "normal") { // barra de los admin
                    echo $barra_normal;
                }
echo "</header>";

                
echo "<main>";

                // mensajes de error si los hay
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 0) {
                        echo "<p class='alert alert-primary text-center fw-bold'>Empleado borrado/actualizado correctamente.</p>";
                    } else if ($_GET['error'] == 1) {
                        echo "<p class='alert alert-danger text-center fw-bold'>Seleccione un empleado para ver sus fichajes.</p>";
                    } else if ($_GET['error'] == 2) {
                        echo "<p class='alert alert-danger text-center fw-bold'>No se pudo conectar a la base de datos.</p>";
                    } else if ($_GET['error'] == 3) {
                        echo "<p class='alert alert-danger text-center fw-bold'>No se pudo borrar/actualizar el empleado.</p>";
                    } else if ($_GET['error'] == 4) {
                        echo "<p class='alert alert-danger text-center fw-bold'>Seleccione un empleado para borrarlo/actualizarlo o modificar su nomina.</p>";
                    } else if ($_GET['error'] == 5) {
                        echo "<p class='alert alert-danger text-center fw-bold'>Formato o tamaño de foto no valido.</p>";
                    } else if ($_GET['error'] == 6) {
                        echo "<p class='alert alert-danger text-center fw-bold'>Foto ya existente.</p>";
                    } else if ($_GET['error'] == 7) {
                        echo "<p class='alert alert-danger text-center fw-bold'>No se pudo actualizar la nomina.</p>";
                    } else if ($_GET['error'] == 8) {
                        echo "<p class='alert alert-primary text-center fw-bold'>Nomina actualizada.</p>";
                    }
                }

                // informacion de todos los empleados y opciones
                $consulta2 = mysqli_query($conexion, "SELECT * FROM empleados ORDER BY nombre ASC");

    echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Informacion de los empleados</h2>";
    echo "<section class='container-fluid mb-5'>";
        echo "<div class='p-4'>";
            echo "<div class='row mx-auto justify-content-right'>";
                while ($empleados = mysqli_fetch_array($consulta2)) {
                    echo "<section class=' col-12 col-lg-6 col-md-6 mt-2'>";
                        echo "<div class='card shadow-sm rounded-4 p-3'>";
                            echo "<div class='card-header bg-white border-0 p-3'>"; // header card
                                        echo "<p class='fw-bold fs-5 d-flex justify-content-between align-items-center m-0'>";
                                            echo $empleados['nombre']." ".$empleados['apellidos'];
                                         echo "<a class='text-dark text-decoration-none fw-light' data-bs-toggle='collapse' href='#emp".$empleados['cod_empleado']."'>";
                                            echo "Ver mas";
                                        echo "</a></p>";
                                echo "</div>"; // fin header card
                                echo "<div id='emp".$empleados['cod_empleado']."' class='collapse'>"; // desplegable
                                    echo "<div class='row p-3'>";
                                        echo "<div class='col-md-12 col-sm-12 col-lg-8 d-flex flex-column justify-content-center'>";
                                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Telefono: </strong>". $empleados['telefono_personal']."</p>";
                                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Gmail personal: </strong>". $empleados['gmail_contacto']."</p>";
                                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Gmail empresa: </strong>". $empleados['gmail_empresarial']."</p>";
                                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Puesto: </strong>". $empleados['puesto']."</p>";
                                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Estado: </strong>". $empleados['estado']."</p>";
                                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Rol: </strong>". $empleados['rol']."</p>";
                                        echo "</div>"; // fin datos
                                        echo "<div class='col-md-12 col-sm-12 col-lg-4 d-flex flex-column align-items-center justify-content-center'>";
                                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Foto: </strong></p>";
                                            if ($empleados['foto'] == "") {
                                                echo "<img src='../../media/empleados/default.png' alt='foto generica' class='img-empleado rounded-circle shadow border border-3 border-primary'>";
                                            } else {
                                                echo "<img src='../../media/empleados/".$empleados['foto']."' alt='foto empleado' class='img-empleado rounded rounded-5 shadow border border-3 border-primary'>";
                                            }

                                            // opciones de empleado
                                            echo "<div class='d-grid mt-4'>";
                                                echo "<div class='mx-3 my-1 d-flex'>";
                                                        echo "<p><a href='fichajes_empleado.php?cod_empleado=".$empleados['cod_empleado']."' class='btn btn-primary me-1'>Fichajes</a></p>";
                                                        echo "<p><a href='nominas_empleado.php?cod_empleado=".$empleados['cod_empleado']."' class='btn btn-secondary'>Nominas</a></p>
                                                        
                                                    </div>"; // fin opciones fichajes y nominas
                                                echo "<div class='mx-3 my-1'>
                                                <p><a href='actualizar_nomina.php?cod_empleado=".$empleados['cod_empleado']."' class='btn btn-info'>Actualizar nominas</a></p>
                                                        <p><a href='editar_empleado.php?cod_empleado=".$empleados['cod_empleado']."' class='btn btn-warning'>Editar</a></p>
                                                        <button type='button' class='btn btn-danger btnOpciones'>Borrar</button>
                                                        <div class='panel-opciones' hidden>
                                                            <p class='text-aviso fw-bold'>¿Esta seguro de que quiere borra este empleado?</p>
                                                            <a href='../../back/acciones/borrar_empleado.php?id_empleado=".$empleados['cod_empleado']."' class='btn btn-primary'>Si</a>
                                                            <button type='button' class='cancelarOpciones btn btn-danger'>No</button>
                                                        </div>";
                                                echo "</div>"; // fin opciones borra y editar
                                            echo "</div>"; // fin bloque opciones
                                        echo "</div>";// fin bloque con foto y opciones
                                    echo "</div>"; // fin fila 2
                                echo "</div>"; // fin desplegable
                        echo "</div>"; // fin card
                    echo "</section>"; // fin seccion empleado
                    }
                echo "</div>"; // fin fila 1
            echo "</div>"; // fin bloque empleados 
        echo "</section>"; // fin seccion empleados
echo "</main>";
        // cerramos conexion
        mysqli_close($conexion);
                
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }
    ?>
    
    
</body>
</html>