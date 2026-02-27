<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    
        <?php
            try {
                require("plantillas/barras_nav.php");
                require("../../back/auth/conexion_bbdd.php");
            } catch (\Throwable $th) {
                echo "No se pudo acceder a los archivos auxiliares";
            }


            // mostrar info y navegacion segun usuario
            try {
                if (isset($_GET['usuario'])) {
                    // conexion
                    $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);

                    // sacar la info del usuario para trabajar
                    $consulta = mysqli_query($conexion, "SELECT * FROM empleados WHERE cod_empleado = ".$_GET['usuario']);
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
                    echo "<p>Nombre: ". $usuario['nombre']."</p>";
                    echo "<p>Apellidos: ". $usuario['apellidos']."</p>";
                    echo "<p>Telefono: ". $usuario['telefono_personal']."</p>";
                    echo "<p>Gmail personal: ". $usuario['gmail_contacto']."</p>";
                    echo "<p>Gmail empresa: ". $usuario['gmail_empresarial']."</p>";
                    echo "<p>Puesto: ". $usuario['puesto']."</p>";
                    echo "<p>Estado: ". $usuario['puesto']."</p>";
                    echo "<p>Foto: ". $usuario['foto']."</p>";
                    if ($usuario['foto'] == "") {
                        echo "<img src='../../media/empleados/default.png' alt='foto generica'>";
                    }
    echo "</main>";
                } else {
                    echo "No se mando un usuario";
                }
                
            } catch (mysqli_sql_exception $sql) {
                echo "No se pudo acceder a la bbdd: $sql";
            }
        ?>
        
</body>
</html>