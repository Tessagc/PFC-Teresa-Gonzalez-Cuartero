<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi departamento</title>
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
                    
                }

                // titulo y consulta varia segun usuario
                if ($usuario['rol'] == "normal") { // barra de los admin
                    echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Departamento al que pertenece ".$usuario['nombre']." ".$usuario['apellidos']."</h2>";

                    $consulta2 = mysqli_query($conexion, "SELECT departamentos.*, jefe.nombre AS nombre_jefe, jefe.apellidos AS apellidos_jefe
                    FROM empleados 
                    LEFT JOIN departamentos  ON empleados.cod_departamento = departamentos.cod_departamento
                    LEFT JOIN empleados jefe ON departamentos.cod_jefe_departamento = jefe.cod_empleado
                    WHERE empleados.cod_empleado = $id_sesion_usuario");
                } else if ($usuario['rol'] == "jefe") { // barra de los admin
                    echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Departamento liderado por ".$usuario['nombre']." ".$usuario['apellidos']."</h2>";

                    $consulta2 = mysqli_query($conexion, "SELECT departamentos.*, empleados.nombre AS nombre_jefe, empleados.apellidos AS apellidos_jefe
                    FROM departamentos LEFT JOIN empleados ON departamentos.cod_jefe_departamento = empleados.cod_empleado 
                    WHERE cod_jefe_departamento =".$id_sesion_usuario);
                }
                

                // departamento del empleado/jefe
               
                $departamento = mysqli_fetch_array($consulta2);
                echo "<section class='container-sm mb-5'>";
                if ($departamento) {
                    

                    echo "<div class='card shadow-sm rounded-4 p-3 mt-2 w-75 mx-auto'>";
                        echo "<section class='p-3'>";
                        echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Nombre departamento: </strong>". $departamento['nombre']."</p>";
                        echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Descripción: </strong>". $departamento['descripcion']."</p>";
                        echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Jefe departamento: 
                        </strong>". $departamento['nombre_jefe']." ".$departamento['apellidos_jefe']."</p>";
                
                echo "</section>"; 
                } else {
                    echo "<p>No tienes ningún departamento asignado.</p>";
                    echo "ID usuario: " . $id_sesion_usuario;
                }

                
echo "</main>";
                
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }
    ?>
</body>
</html>