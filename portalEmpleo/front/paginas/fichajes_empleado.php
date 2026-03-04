<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fichajes del empleado</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
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
                    echo "<h2>Fichajes de ".$empleado['nombre']." ".$empleado['apellidos']."</h2>";

                  
                    echo "<div class='d-flex'>";
                    // entradas
                    echo "<section class='border border-black p-3 col-6'>";
                    echo "<h3>Entradas</h3>";
                    while ($entradas = mysqli_fetch_array($consulta3)) {
                        echo "<p>Fecha: ".$entradas['fecha_hora']."</p>";
                    }
                    echo "</section>";

                    //salidas
                    echo "<section class='border border-black p-3 col-6'>";
                    echo "<h3>Salidas</h3>";
                    while ($salidas = mysqli_fetch_array($consulta4)) {
                        echo "<p>Fecha: ".$salidas['fecha_hora']."</p>";
                    }
                    echo "</section>";
                    echo "</div>";

                    
    echo "</main>";
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