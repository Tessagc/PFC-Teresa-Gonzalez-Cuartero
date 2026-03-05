<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incidencias</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/funciones.js"></script>
</head>
<body>
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

                
echo "<main>";

                // mensajes de error si los hay
                if (isset($_GET['error'])) {
                    
                }


        echo "<h2>Incidencias del portal</h2>";
            echo "<div class='d-flex container justify-content-between'>";
                
                // mostrar las incidencias resueltas y no resueltas
                $consulta2 = mysqli_query($conexion, "SELECT incidencias.*, empleados.nombre AS reporte_nombre, empleados.apellidos AS reporte_apellidos
                FROM incidencias LEFT JOIN empleados ON incidencias.cod_empleado_reportante = empleados.cod_empleado WHERE incidencias.atendida = 0");

            

            echo "<div class='flex-column container-fluid pe-2'>";
                echo "<h3>No atendidas</h3>";
                while ($no_atendidas = mysqli_fetch_array($consulta2)) {
                    echo "<section class='border border-black w-75'>";
                        echo "<p>Descripcion de la incidencia: ". $no_atendidas['descripcion']."</p>";
                        echo "<p>Gravedad: ". $no_atendidas['gravedad']."</p>";
                        echo "<p>Fecha reporte: ". $no_atendidas['fecha_creacion']."</p>";
                        echo "<p>Empleado reportante: ". $no_atendidas['reporte_nombre']." ".$no_atendidas['reporte_apellidos']."</p>";
                        echo "<button type='button' class='btnAtender'>Marcar como atendida</button>";
                    echo "</section>";
                }
            echo "</div>";  
            

                $consulta3 = mysqli_query($conexion, "SELECT incidencias.*, er.nombre AS reporte_nombre, er.apellidos AS reporte_apellidos,
                eg.nombre AS gestor_nombre, eg.apellidos AS gestor_apellidos
                FROM incidencias LEFT JOIN empleados er ON incidencias.cod_empleado_reportante = er.cod_empleado 
                LEFT JOIN empleados eg ON incidencias.cod_empleado_gestor = eg.cod_empleado
                WHERE incidencias.atendida = 1");

                
                echo "<div class='flex-column pe-2 container-fluid'>";
                    echo "<h3>Atendidas</h3>";
                while ($atendidas = mysqli_fetch_array($consulta3)) {
                    echo "<section class='border border-black w-75'>";
                        echo "<p>Descripcion de la incidencia: ". $atendidas['descripcion']."</p>";
                        echo "<p>Gravedad: ". $atendidas['gravedad']."</p>";
                        echo "<p>Fecha reporte: ". $atendidas['fecha_creacion']."</p>";
                        echo "<p>Fecha resolucion: ". $atendidas['fecha_resolucion']."</p>";
                        echo "<p>Empleado reportante: ". $atendidas['reporte_nombre']." ".$atendidas['reporte_apellidos']."</p>";
                        echo "<p>Empleado gestor: ". $atendidas['gestor_nombre']." ".$atendidas['gestor_apellidos']."</p>";
                    echo "</section>";
                }

            echo "</div>";  
        echo "</div>";  
echo "</main>";
                
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }
    ?>
</body>
</html>