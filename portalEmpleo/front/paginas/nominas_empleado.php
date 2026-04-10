<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nominas del empleado</title>
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

                $consulta3 = mysqli_query($conexion, "SELECT * FROM nominas WHERE cod_empleado=".$_GET['cod_empleado']);
echo "<main>";
            echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Ultimas nominas de ".$empleado['nombre']." ".$empleado['apellidos']."</h2>";
            echo "<div class='row justify-content-center container mx-auto'>";
                    while ($nominas_empleado = mysqli_fetch_array($consulta3)) {
                        echo "<div class='col-md-6 col-sm-12 mb-4'>";
                            echo "<section class='border rounded p-3 mb-4 shadow-sm bg-light row'>";
                                echo "<div class='col-md-6 col-sm-12 mb-4'>";
                                    echo "<p class='mb-2'><strong>Periodo:</strong> ".$nominas_empleado['periodo']." </p>";
                                    echo "<p class='mb-2'><strong>Sueldo bruto:</strong> ".$nominas_empleado['sueldo_base']." €</p>";
                                    echo "<p class='mb-2'><strong>Complementos:</strong> ".$nominas_empleado['complementos']." €</p>";
                                echo "</div>";

                                echo "<div class='col-md-6 col-sm-12 mb-4'>";
                                    echo "<p class='mb-2'><strong>Contingencia común:</strong> ".$nominas_empleado['cont_comun']." €</p>";
                                    echo "<p class='mb-2'><strong>Formación:</strong> ".$nominas_empleado['formacion']." €</p>";
                                    echo "<p class='mb-2'><strong>Desempleo:</strong> ".$nominas_empleado['desempleo']." €</p>";
                                    echo "<p class='mb-2'><strong>IRPF:</strong> ".$nominas_empleado['irpf']." €</p>";
                                echo "</div>";
                                echo "<hr>";
                                echo "<p class='mb-3'><strong>Sueldo neto: </strong>".$nominas_empleado['total']." €</p>";

                                echo "<a href='generar_nomina.php?cod_nomina=".$nominas_empleado['cod_nomina']."' class='btn btn-sm btn-secondary w-25'>Generar PDF</a>";
                            echo "</section>";
                        echo "</div>";
                    }
                echo "</div>";
                
echo "</main>";

        // cerramos la conexion
        mysqli_close($conexion);
            } else {
                header("location:ver_empleados.php?error=1");
                exit();
            }
                
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }
    ?>
    
</body>
</html>