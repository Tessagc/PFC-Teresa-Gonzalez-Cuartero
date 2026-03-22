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
                echo "<h2>Empleados del departamento liderado por ".$usuario['nombre']." ".$usuario['apellidos']."</h2>";

                // informacion de todos los empleados
                $consulta2 = mysqli_query($conexion, "SELECT * FROM empleados WHERE cod_departamento = (SELECT cod_departamento FROM
                departamentos WHERE cod_jefe_departamento = ".$id_sesion_usuario.") ORDER BY nombre ASC");

                while ($empleados = mysqli_fetch_array($consulta2)) {
                    echo "<section class='border border-black'>";
                        echo "<p>Nombre: ". $empleados['nombre']."</p>";
                        echo "<p>Apellidos: ". $empleados['apellidos']."</p>";
                        echo "<p>Telefono: ". $empleados['telefono_personal']."</p>";
                        echo "<p>Gmail personal: ". $empleados['gmail_contacto']."</p>";
                        echo "<p>Gmail empresa: ". $empleados['gmail_empresarial']."</p>";
                        echo "<p>Puesto: ". $empleados['puesto']."</p>";
                        echo "<p>Estado: ". $empleados['estado']."</p>";
                        if ($empleados['foto'] == "") {
                            echo "<img src='../../media/empleados/default.png' alt='foto generica' class='img-empleado'>";
                        } else {
                            echo "<img src='../../media/empleados/".$empleados['foto']."' alt='foto generica' class='img-empleado'>";
                        }
                    echo "</section>";
            }
echo "</main>";
            // cerramos la conexion
            mysqli_close($conexion);
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }

    ?>
    
</body>
</html>