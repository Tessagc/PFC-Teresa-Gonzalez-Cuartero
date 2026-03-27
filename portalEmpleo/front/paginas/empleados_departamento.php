<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados de mi departamento</title>
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


        try {
            // conexion
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");


            // sacar la info del usuario para trabajar
            $consulta = mysqli_query($conexion, "SELECT * FROM empleados WHERE cod_empleado = ".$id_sesion_usuario);
            $usuario = mysqli_fetch_array($consulta);

                // mostrar info y navegacion segun usuario
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

                // mensajes de error si los hay
                if (isset($_GET['error'])) {
                    
                }

                // sacar nombre del departamento
                
echo "<main>";
                echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Empleados del departamento liderado por ".$usuario['nombre']." ".$usuario['apellidos']."</h2>";

                // informacion de todos los empleados
                $consulta2 = mysqli_query($conexion, "SELECT * FROM empleados WHERE cod_departamento = (SELECT cod_departamento FROM
                departamentos WHERE cod_jefe_departamento = ".$id_sesion_usuario.") ORDER BY nombre ASC");

                echo "<section class='container-fluid mb-5'>";
        echo "<div class='p-4'>";
            echo "<div class='row mx-auto justify-content-center'>";
                while ($empleados = mysqli_fetch_array($consulta2)) {
                    echo "<section class='col-md-6 col-6 col-12 mt-2'>";
                        echo "<div class='card shadow-sm rounded-4 p-3'>";
                            echo "<div class='row'>";
                                echo "<div class='col-md-8 col-12 d-flex flex-column justify-content-center'>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Nombre: </strong>". $empleados['nombre']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Apellidos: </strong>". $empleados['apellidos']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Telefono: </strong>". $empleados['telefono_personal']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Gmail personal: </strong>". $empleados['gmail_contacto']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Gmail empresa: </strong>". $empleados['gmail_empresarial']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Puesto: </strong>". $empleados['puesto']."</p>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Estado: </strong>". $empleados['estado']."</p>";
                                echo "</div>"; // fin datos
                                echo "<div class='col-md-4 col-12 d-flex flex-column align-items-center justify-content-center'>";
                                    echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Foto: </strong></p>";
                                    if ($empleados['foto'] == "") {
                                        echo "<img src='../../media/empleados/default.png' alt='foto generica' class='img-empleado  rounded-5'>";
                                    } else {
                                        echo "<img src='../../media/empleados/".$empleados['foto']."' alt='foto empleado' class='img-empleado  rounded-5'>";
                                    }
                                echo "</div>";// fin bloque con foto y opcioens
                            echo "</div>"; // fin fila 2
                        echo "</div>"; // fin card
                    echo "</section>"; // fin seccion empleado
            }
            echo "</div>"; // fin fila 1
        echo "</div>"; // fin bloque empleados 
    echo "</section>"; // fin seccion empleados
echo "</main>";
            // cerramos la conexion
            mysqli_close($conexion);
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }

    ?>
    
</body>
</html>