<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fichajes del empleado</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
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

                if (isset($_GET['cod_empleado'])) {
                    // fichajes del empleado
                    $consulta2 = mysqli_query($conexion, "SELECT nombre, apellidos FROM empleados WHERE cod_empleado=".$_GET['cod_empleado']);
                    $empleado = mysqli_fetch_array($consulta2);

                    $consulta3 = mysqli_query($conexion, "SELECT * FROM fichajes WHERE tipo = 'entrada' AND cod_empleado=".$_GET['cod_empleado']);
                    

                    $consulta4 = mysqli_query($conexion, "SELECT * FROM fichajes WHERE tipo = 'salida'AND cod_empleado=".$_GET['cod_empleado']);
                    

    echo "<main>";
                    echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Fichajes de ".$empleado['nombre']." ".$empleado['apellidos']."</h2>";

                  
                    echo "<div class='d-flex w-50 mx-auto'>";
                        // entradas
                        echo "<section class='card car-body border border-black p-3 col-6 me-4'>";
                            echo "<h3 class='card-title mb-3 titulo-pequeño_mediano'>Entradas</h3>";
                            echo "<ul class='list-group mt-1 pt-1'>";
                                while ($entradas = mysqli_fetch_array($consulta3)) {
                                    list($fecha, $hora) = explode(' ', $entradas['fecha_hora']);
                                    $fecha = new DateTime($fecha);
                                    $fecha = strftime("%e de %B de %Y", $fecha->getTimestamp());
                                    echo "<li class='list-group-item border border-5 border-gris mb-1'>".$fecha." ".$hora."</li>";
                                }
                            echo "</ul>";
                        echo "</section>";

                        //salidas
                        echo "<section class='card car-body border border-black p-3 col-6'>";
                            echo "<h3 class='card-title mb-3 titulo-pequeño_mediano'>Salidas</h3>";
                            echo "<ul class='list-group mt-1 pt-1'>";
                                while ($salidas = mysqli_fetch_array($consulta4)) {
                                    list($fecha, $hora) = explode(' ', $salidas['fecha_hora']);
                                    $fecha = new DateTime($fecha);
                                    $fecha = strftime("%e de %B de %Y", $fecha->getTimestamp());
                                    echo "<li class='list-group-item border border-5 border-gris mb-1'>".$fecha." ".$hora."</li>";
                                }
                            echo "</ul>";
                        echo "</section>";
                    echo "</div>";

                    
    echo "</main>";
                } else {
                    header("location:ver_empleados.php?error=1");
                    exit();
                }

            // cerramos la conexion
            mysqli_close($conexion);
                
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }
    ?>

    
</body>
</html>