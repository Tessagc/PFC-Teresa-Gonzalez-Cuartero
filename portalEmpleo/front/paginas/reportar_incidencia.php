<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar incidencia</title>
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
                echo "<p>No se pudo acceder a los archivos auxiliares</p>";
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
                    // formulario para enviar la incidencia
                    
    echo "<main>";
        

        // mensajes de error si los hay
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 0) {
                echo "<p class='alert alert-primary text-center fw-bold'>Incidencia enviada.</p>";
            } else if ($_GET['error'] == 1) {
                echo "<p class='alert alert-danger text-center fw-bold'>No se pudo conectar a la base de datos.</p>";
            } else if ($_GET['error'] == 2) {
                echo "<p class='alert alert-danger text-center fw-bold'>No se pudo reportar la incidencia.</p>";
            } else if ($_GET['error'] == 3) {
                echo "<p class='alert alert-danger text-center fw-bold'>Debe enviar los datos de la incidencia para poder reportarla.</p>";
            }
        }


        echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Reportar incidencia</h2>";
        echo "<div class='container mt-5'>";
            echo "<div class='justify-content-center p-4'>";
            echo "<form action='../../back/acciones/enviar_incidencia.php' class='mx-auto w-75' method='post' name='sesiones' enctype='application/x-www-form-urlencoded'>

                    <input type='hidden' name='cod_reportante' value='$id_sesion_usuario'>
                    <div class='mb-3'>
                        <label for='descripcion_incidencia' class='form-label fw-semibold fs-5 text-primary'>Descripcion de la Incidencia</label>
                        <textarea name='descripcion_incidencia' id='descripcion_incidencia' rows=3 class='form-control' placeholder='Describe el problema...' required></textarea>
                    </div>

                    <div class='mb-3'>
                        <label for='gravedad_incidencia' class='form-label fw-semibold fs-5 text-primary'>Gravedad de la Incidencia</label>
                        <select name='gravedad_incidencia' id='gravedad_incidencia' class='form-select' required>
                            <option value='' hidden selected>Selecione la gravedad de la incidencia</option>
                            <option value='Leve'>Leve</option>
                            <option value='Moderada'>Moderada</option>
                            <option value='Grave'>Grave</option>
                            <option value='Urgente'>Urgente</option>
                        </select>
                    </div>
                    <div class='mb-3 container'>
                        <div class='container d-flex justify-content-between'>
                            <input type='submit' value='Reportar' name='enviar' class='btn btn-primary'>
                            <input type='reset' value='Borrar' class='btn btn-secondary'>
                        </div>
                    </div>
                </form>";
            echo "</div>";
        echo "</div>";
    echo "</main>";
            } catch (mysqli_sql_exception $sql) {
                // echo $sql;
                echo "<p>No se pudo acceder a la bbdd: </p>";
            }
        ?>
</body>
</html>