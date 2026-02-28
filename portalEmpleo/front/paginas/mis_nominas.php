<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis nominas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
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

                // Todas las nominas del usuario
                echo "<h2>Nominas de ".$usuario['nombre']." ".$usuario['apellidos']."</h2>";
                $consulta2 = mysqli_query($conexion, "SELECT * FROM nominas WHERE cod_empleado = ".$id_sesion_usuario);
                

                while ($nomina_usuario = mysqli_fetch_array($consulta2)) {
                    echo "<section class='border border-black'>";
                    echo "<p>Periodo pago: ".$nomina_usuario['periodo']." Sueldo bruto: ".$nomina_usuario['sueldo_base']."</p>";
                    echo "<p>Complementos: ".$nomina_usuario['complementos']." Contingencia comun: ".$nomina_usuario['cont_comun']."</p>";
                    echo "<p>Formación: ".$nomina_usuario['formacion']." Desempleo: ".$nomina_usuario['desempleo']."</p>";
                    echo "<p>IRPF: ".$nomina_usuario['irpf']." Sueldo neto: ".$nomina_usuario['total']."</p>";
                    echo "</section>";

                }

        echo "<main>";


        echo "</main>";
        
            
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }

        ?>
</body>
</html>