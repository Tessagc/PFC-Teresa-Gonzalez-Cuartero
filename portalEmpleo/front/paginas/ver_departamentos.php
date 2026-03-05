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

                // informacion de todos los departamentos y opciones
                $consulta2 = mysqli_query($conexion, "SELECT departamentos.*, empleados.nombre AS nombre_jefe, empleados.apellidos AS apellidos_jefe
                FROM departamentos LEFT JOIN empleados ON departamentos.cod_jefe_departamento = empleados.cod_empleado ORDER BY departamentos.nombre ASC");

                echo "<h2>Informacion de los departamentos</h2>";

                while ($departamentos = mysqli_fetch_array($consulta2)) {
                    echo "<section class='border border-black'>";
                        echo "<p>Nombre departamento: ". $departamentos['nombre']."</p>";
                        echo "<p>Descripción: ". $departamentos['descripcion']."</p>";
                        echo "<p>Jefe departamento: ". $departamentos['nombre_jefe']." ".$departamentos['apellidos_jefe']."</p>
                        <button type='button' class='btnBorrar'>Borrar</button>
                        <div class='panel-borrado' hidden>
                            <p>¿Esta seguro de que quiere borra este empleado?</p>
                            <a href='mis_nominas.php?id=".$departamentos['cod_departamento']."' class='btn btn-primary'>Si</a>
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