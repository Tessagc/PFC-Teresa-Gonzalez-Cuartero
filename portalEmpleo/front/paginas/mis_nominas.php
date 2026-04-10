<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis nominas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
</head>
<body class='fondo-web'>
        <?php
            // archivos requeridos
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
                $consulta1 = mysqli_query($conexion, "SELECT * FROM empleados WHERE cod_empleado = ".$id_sesion_usuario);
                $usuario = mysqli_fetch_array($consulta1);

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
                // Todas las nominas del usuario
                echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Nominas de ".$usuario['nombre']." ".$usuario['apellidos']."</h2>";
                $consulta2 = mysqli_query($conexion, "SELECT * FROM nominas WHERE cod_empleado = ".$id_sesion_usuario);
                

                echo "<div class='row justify-content-center container mx-auto'>";
                    while ($nomina_usuario = mysqli_fetch_array($consulta2)) {
                        echo "<div class='col-md-6 col-sm-12 mb-4'>";
                            echo "<section class='border rounded p-3 mb-4 shadow-sm bg-light row'>";
                                echo "<div class='col-md-6 col-sm-12 mb-4'>";
                                    echo "<p class='mb-2'><strong>Periodo:</strong> ".$nomina_usuario['periodo']." </p>";
                                    echo "<p class='mb-2'><strong>Sueldo bruto:</strong> ".$nomina_usuario['sueldo_base']." €</p>";
                                    echo "<p class='mb-2'><strong>Complementos:</strong> ".$nomina_usuario['complementos']." €</p>";
                                echo "</div>";

                                echo "<div class='col-md-6 col-sm-12 mb-4'>";
                                    echo "<p class='mb-2'><strong>Contingencia común:</strong> ".$nomina_usuario['cont_comun']." €</p>";
                                    echo "<p class='mb-2'><strong>Formación:</strong> ".$nomina_usuario['formacion']." €</p>";
                                    echo "<p class='mb-2'><strong>Desempleo:</strong> ".$nomina_usuario['desempleo']." €</p>";
                                    echo "<p class='mb-2'><strong>IRPF:</strong> ".$nomina_usuario['irpf']." €</p>";
                                echo "</div>";
                                echo "<hr>";
                                echo "<p class='mb-3'><strong>Sueldo neto: </strong>".$nomina_usuario['total']." €</p>";

                                echo "<a href='generar_nomina.php?cod_nomina=".$nomina_usuario['cod_nomina']."' class='btn btn-sm btn-secondary w-25'>Generar PDF</a>";
                            echo "</section>";
                        echo "</div>";
                    }
                echo "</div>";
        echo "</main>";
        // cerramos la conexion
        mysqli_close($conexion);
            
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }

        ?>
</body>
</html>