<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nominas del empleado</title>
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

                $consulta3 = mysqli_query($conexion, "SELECT * FROM nominas WHERE cod_empleado=".$_GET['cod_empleado']);
echo "<main>";
            echo "<h2>Ultimas nominas de ".$empleado['nombre']." ".$empleado['apellidos']."</h2>";
            while ($nominas = mysqli_fetch_array($consulta3)) {
                echo "<section class='border border-black'>";
                    echo "<p>Periodo pago: ".$nominas['periodo']." Sueldo bruto: ".$nominas['sueldo_base']."</p>";
                    echo "<p>Complementos: ".$nominas['complementos']." Contingencia comun: ".$nominas['cont_comun']."</p>";
                    echo "<p>Formación: ".$nominas['formacion']." Desempleo: ".$nominas['desempleo']."</p>";
                    echo "<p>IRPF: ".$nominas['irpf']." Sueldo neto: ".$nominas['total']."</p>";
                echo "</section>";
            }
                
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