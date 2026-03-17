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
                    if ($_GET['error'] == 1) {
                        echo "<p>Seleccione un empleado para ver sus fichajes.</p>";
                    }
                }

                // informacion de todos los empleados y opciones
                $consulta2 = mysqli_query($conexion, "SELECT * FROM empleados ORDER BY nombre ASC");

    echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Informacion de los empleados</h2>";
    echo "<section class='container-fluid mb-5'>";
        echo "<div class='p-4'>";
            echo "<div class='row mx-auto justify-content-center border border-dark'>";
                while ($empleados = mysqli_fetch_array($consulta2)) {
                    echo "<section class='col-md-6 col-6 mt-2'>";
                        echo "<div class='card shadow-sm rounded-4 p-3'>";
                            echo "<div class='row'>";
                                echo "<div class='col-md-8 col-8 d-flex flex-column justify-content-center'>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Nombre: </strong>". $empleados['nombre']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Apellidos: </strong>". $empleados['apellidos']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Telefono: </strong>". $empleados['telefono_personal']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Gmail personal: </strong>". $empleados['gmail_contacto']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Gmail empresa: </strong>". $empleados['gmail_empresarial']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Puesto: </strong>". $empleados['puesto']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Estado: </strong>". $empleados['estado']."</p>";
                                echo "</div>"; // fin datos
                                echo "<div class='col-md-4 col-4 d-flex flex-column align-items-center justify-content-center'>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Foto: </strong></p>";
                                    if ($empleados['foto'] == "") {
                                        echo "<img src='../../media/empleados/default.png' alt='foto generica' class='img-empleado  rounded-5'>";
                                    } else {
                                        echo "<img src='../../media/empleados/".$empleados['foto']."' alt='foto empleado' class='img-empleado  rounded-5'>";
                                    }

                                    // opciones de empleado
                                    echo "<div class='d-flex'>";
                                        echo "<div class='mx-3 my-1'>";
                                                echo "<p><a href='fichajes_empleado.php?cod_empleado=".$empleados['cod_empleado']."'>Fichajes</a></p>";
                                                echo "<p><a href='nominas_empleado.php?cod_empleado=".$empleados['cod_empleado']."'>Nominas</a></p>
                                            </div>"; // fin opciones fichajes y nominas
                                        echo "<div class='mx-3 my-1'>
                                                <p><a href=''>Editar</a></p>
                                                <button type='button' class='btnOpciones'>Borrar</button>
                                                <div class='panel-opciones' hidden>
                                                    <p>¿Esta seguro de que quiere borra este empleado?</p>
                                                    <a href='mis_nominas.php?id=".$empleados['cod_empleado']."' class='btn btn-primary'>Si</a>
                                                    <button type='button' class='cancelarOpciones btn btn-danger'>No</button>
                                                </div>";
                                        echo "</div>"; // fin opciones borra y editar
                                    echo "</div>"; // fin bloque opciones
                                echo "</div>";// fin bloque con foto y opcioens
                            echo "</div>"; // fin fila 2
                        echo "</div>"; // fin card
                    echo "</section>"; // fin seccion empleado
            }
            echo "</div>"; // fin fila 1
        echo "</div>"; // fin bloque empleados 
    echo "</section>"; // fin seccion empleados
echo "</main>";
                
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }
    ?>
    
    
</body>
</html>