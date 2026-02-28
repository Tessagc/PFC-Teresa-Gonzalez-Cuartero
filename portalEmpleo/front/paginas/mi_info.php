<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi informacion</title>
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

                    // informacion del usuario impresa
    echo "<main>";
                    echo "<h2>Informacion del empleado ".$usuario['nombre']." ".$usuario['apellidos']."</h2>";
                    echo "<p>Nombre: ". $usuario['nombre']."</p>";
                    echo "<p>Apellidos: ". $usuario['apellidos']."</p>";
                    echo "<p>Telefono: ". $usuario['telefono_personal']."</p>";
                    echo "<p>Gmail personal: ". $usuario['gmail_contacto']."</p>";
                    echo "<p>Gmail empresa: ". $usuario['gmail_empresarial']."</p>";
                    echo "<p>Puesto: ". $usuario['puesto']."</p>";
                    echo "<p>Estado: ". $usuario['puesto']."</p>";
                    echo "<p>Sueldo base: ". $usuario['sueldo_base']."</p>";
                    echo "<p>Foto: ". $usuario['foto']."</p>";
                    if ($usuario['foto'] == "") {
                        echo "<img src='../../media/empleados/default.png' alt='foto generica'>";
                    }
    echo "</main>";
                
            } catch (mysqli_sql_exception $sql) {
                echo "No se pudo acceder a la bbdd: $sql";
            }
        ?>
        
</body>
</html>