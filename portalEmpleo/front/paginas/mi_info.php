<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi informacion</title>
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
            echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Informacion del empleado ".$usuario['nombre']." ".$usuario['apellidos']."</h2>";
            echo "<section class='container mt-5'>";
                echo "<div class='container p-4'>";
                    echo "<div class='row mx-auto justify-content-center border border-dark rounded-4 bg-light p-3'>";
                        echo "<div class='col-md-6 col-12 d-flex flex-column justify-content-center'>";
                            echo "<p class='mb-2 fs-5 text-break'><strong class='titulo-pequeño'>Nombre: </strong>". $usuario['nombre']."</p>";
                            echo "<p class='mb-2 fs-5 text-break'><strong class='titulo-pequeño'>Apellidos: </strong>". $usuario['apellidos']."</p>";
                            echo "<p class='mb-2 fs-5 text-break'><strong class='titulo-pequeño'>Telefono: </strong>". $usuario['telefono_personal']."</p>";
                            echo "<p class='mb-2 fs-5 text-break'><strong class='titulo-pequeño'>Gmail personal: </strong>". $usuario['gmail_contacto']."</p>";
                            echo "<p class='mb-2 fs-5 text-break'><strong class='titulo-pequeño'>Gmail empresa: </strong>". $usuario['gmail_empresarial']."</p>";
                            echo "<p class='mb-2 fs-5 text-break'><strong class='titulo-pequeño'>Puesto: </strong>". $usuario['puesto']."</p>";
                            echo "<p class='mb-2 fs-5 text-break'><strong class='titulo-pequeño'>Estado: </strong>". $usuario['estado']."</p>";
                        echo "</div>";
                        echo "<div class='col-md-6 col-12 d-flex flex-column'>";
                        
                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Foto: </p>";
                            if ($usuario['foto'] == "") {
                                echo "<img src='../../media/empleados/default.png' alt='foto generica'  class='img-empleado  rounded-circle shadow border border-3 border-primary p-1'>";
                            } else {
                                echo "<img src='../../media/empleados/".$usuario['foto']."' alt='foto empleado' class='img-empleado rounded-circle shadow border border-3 border-primary p-1'>";
                            }
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</section>";
    echo "</main>";

            // cerramos la conexion
            mysqli_close($conexion);
                
            } catch (mysqli_sql_exception $sql) {
                echo "No se pudo acceder a la bbdd: $sql";
            }
        ?>
        
</body>
</html>