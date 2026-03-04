<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados de la empresa</title>
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

                
echo "<main>";

                // mensajes de error si los hay
                if (isset($_GET['error'])) {
                    if ($_GET['error']) {
                        echo "<p>Seleccione un empleado para ver sus fichajes.</p>";
                    }
                }

                // informacion de todos los empleados y opciones
                $consulta2 = mysqli_query($conexion, "SELECT * FROM empleados ORDER BY nombre ASC");

                echo "<h2>Informacion de los empleados</h2>";
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
                        echo "<p><a href='fichajes_empleado.php?cod_empleado=".$empleados['cod_empleado']."'>Fichajes</a></p>";
                        echo "<p><a href='nominas_empleado.php?cod_empleado=".$empleados['cod_empleado']."'>Nominas</a></p>
                        <button type='button' class='btnBorrar'>Borrar</button>
                        <div class='panel-borrado' hidden>
                            <p>¿Esta seguro de que quiere borra este empleado?</p>
                            <a href='mis_nominas.php?id=".$empleados['cod_empleado']."' class='btn btn-primary'>Si</a>
                            <button type='button' class='cancelarBorrado btn btn-danger'>No</button>
                        </div>";
                    echo "</section>";
            }
echo "</main>";
                
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }
    ?>
    
    
</body>
</html>