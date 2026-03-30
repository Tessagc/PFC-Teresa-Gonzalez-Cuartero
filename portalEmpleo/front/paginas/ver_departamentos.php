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
                        echo "<p class='alert alert-primary text-center fw-bold'>Departamento borrado correctamente.</p>";
                    }  else if ($_GET['error'] == 1) {
                        echo "<p class='alert alert-danger text-center fw-bold'>No se pudo conectar a la base de datos.</p>";
                    } else if ($_GET['error'] == 2) {
                        echo "<p class='alert alert-danger text-center fw-bold'>No se pudo borrar/actualizar el departamento.</p>";
                    } else if ($_GET['error'] == 3) {
                        echo "<p class='alert alert-danger text-center fw-bold'>Seleccione un departamento para borrarlo/actualizarlo.</p>";
                    } else if ($_GET['error'] == 4) {
                        echo "<p class='alert alert-primary text-center fw-bold'>Departamento actualizado correctamente.</p>";
                    } 
                }

                // informacion de todos los departamentos y opciones
                $consulta2 = mysqli_query($conexion, "SELECT departamentos.*, empleados.nombre AS nombre_jefe, empleados.apellidos AS apellidos_jefe
                FROM departamentos LEFT JOIN empleados ON departamentos.cod_jefe_departamento = empleados.cod_empleado ORDER BY departamentos.nombre ASC");

                echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Informacion de los departamentos</h2>";
                echo "<section class='container-sm mb-5'>";

                while ($departamentos = mysqli_fetch_array($consulta2)) {
                    echo "<div class='card shadow-sm rounded-4 p-3 mt-2 w-75 mx-auto'>";
                        echo "<section class='p-3'>";
                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Nombre departamento: </strong>". $departamentos['nombre']."</p>";
                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Descripción: </strong>". $departamentos['descripcion']."</p>";
                            echo "<p class='mb-2 fs-5'><strong class='titulo-pequeño'>Jefe departamento: </strong>". $departamentos['nombre_jefe']." ".$departamentos['apellidos_jefe']."</p>
                            <button type='button' class='btnOpciones btn btn-danger'>Borrar</button>
                            <a href='editar_departamento.php?id_departamento=".$departamentos['cod_departamento']."' class='btn btn-warning'>Editar</a>
                            <div class='panel-opciones' hidden>
                                <p class='text-aviso fw-bold'>¿Esta seguro de que quiere borra este departamento? Si lo hace, todos los empleados del mismo quedaran sin departamentos asociado</p>
                                <a href='../../back/acciones/borrar_departamento.php?id_departamento=".$departamentos['cod_departamento']."' class='btn btn-primary'>Si</a>
                                <button type='button' class='cancelarOpciones btn btn-danger'>No</button>
                            </div>";
                        echo "</section>";
                    echo  "</div>";
                     
                }
                echo "</section>"; // fin seccion departamentos
               
echo "</main>";
                
        } catch (mysqli_sql_exception $sql) {
            echo "No se pudo acceder a la bbdd: $sql";
        }
    ?>
    
</body>
</html>