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

                
echo "<main>";

                // mensajes de error si los hay
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 0) {
                        echo "<p class='alert alert-primary text-center fw-bold'>Incidencia solucionada.</p>";
                    } else if ($_GET['error'] == 1) {
                        echo "<p class='alert alert-danger text-center fw-bold'>No se pudo conectar a la base de datos.</p>";
                    } else if ($_GET['error'] == 2) {
                        echo "<p class='alert alert-danger text-center fw-bold'>No se pudo actualizar el estado de la incidencia.</p>";
                    }
                }


            echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Incidencias del portal</h2>";
            echo "<div class='container'>";
                echo "<div class='row'>";
                
                // mostrar las incidencias resueltas y no resueltas
                $consulta2 = mysqli_query($conexion, "SELECT incidencias.*, empleados.nombre AS reporte_nombre, empleados.apellidos AS reporte_apellidos
                FROM incidencias LEFT JOIN empleados ON incidencias.cod_empleado_reportante = empleados.cod_empleado WHERE incidencias.atendida = 0");

            

            echo "<div class='container-fluid col-12 col-md-6 mb-4'>";
                echo "<h3 class='text-center'>No atendidas</h3>";
                while ($no_atendidas = mysqli_fetch_array($consulta2)) {
                    echo "<div class='card mb-3 shadow-sm rounded-4 p-3'>";
                        echo "<section class='card-body'>";
                            echo "<p class='card-text'><strong>Descripcion de la incidencia: </strong>". $no_atendidas['descripcion']."</p>";
                            echo "<p class='card-text'><strong>Gravedad: </strong>". $no_atendidas['gravedad']."</p>";
                            echo "<p class='card-text'><strong>Fecha reporte: </strong>". $no_atendidas['fecha_creacion']."</p>";
                            echo "<p class='card-text'><strong>Empleado reportante: </strong>". $no_atendidas['reporte_nombre']." ".$no_atendidas['reporte_apellidos']."</p>";
                            echo "<button type='button' class='btnOpciones btn-sm btn btn-success'>Marcar como atendida</button>
                            <div class='panel-opciones' hidden>
                                <p class='text-aviso fw-bold'>Se cambiara esta incidencia a atendidas, ¿Esta seguro?</p>
                                <a href='../../back/acciones/marcar_incidencia.php?cod_incidencia=".$no_atendidas['cod_incidencia']."&empleado_gestor=".$id_sesion_usuario."' 
                                class='btn btn-primary'>Si</a>
                                <button type='button' class='cancelarOpciones btn btn-danger'>No</button>
                            </div>";
                        echo "</section>";
                    echo "</div>";
                }
            echo "</div>";  
            

                $consulta3 = mysqli_query($conexion, "SELECT incidencias.*, er.nombre AS reporte_nombre, er.apellidos AS reporte_apellidos,
                eg.nombre AS gestor_nombre, eg.apellidos AS gestor_apellidos
                FROM incidencias LEFT JOIN empleados er ON incidencias.cod_empleado_reportante = er.cod_empleado 
                LEFT JOIN empleados eg ON incidencias.cod_empleado_gestor = eg.cod_empleado
                WHERE incidencias.atendida = 1");

                
                echo "<div class='container-fluid col-12 col-md-6 mb-4'>";
                    echo "<h3 class='text-center'>Atendidas</h3>";
                while ($atendidas = mysqli_fetch_array($consulta3)) {
                    echo "<div class='card mb-3 shadow-sm rounded-4 p-3'>";
                        echo "<section class='card-body'>";
                            echo "<p class='card-text'><strong>Descripcion de la incidencia: </strong>". $atendidas['descripcion']."</p>";
                            echo "<p class='card-text'><strong>Gravedad: </strong>". $atendidas['gravedad']."</p>";
                            echo "<p class='card-text'><strong>Fecha reporte: </strong>". $atendidas['fecha_creacion']."</p>";
                            echo "<p class='card-text'><strong>Fecha resolucion: </strong>". $atendidas['fecha_resolucion']."</p>";
                            echo "<p class='card-text'><strong>Empleado reportante: </strong>". $atendidas['reporte_nombre']." ".$atendidas['reporte_apellidos']."</p>";
                            echo "<p class='card-text'><strong>Empleado gestor: </strong>". $atendidas['gestor_nombre']." ".$atendidas['gestor_apellidos']."</p>";
                        echo "</section>";
                    echo "</div>";
                }

                echo "</div>";  
            echo "</div>";  
        echo "</div>";  
echo "</main>";
                
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }
    ?>
</body>
</html>