<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar nominas empleado</title>
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
    <script src='../js/bootstrap.min.js'></script>
    <script src='../js/funciones.js'></script>
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
                
        } catch (mysqli_sql_exception $sql) {
            echo 'No se pudo acceder a la bbdd: $sql';
        }

        // redirigir si no hay cod_empleado
        if (!isset($_GET['cod_empleado'])) {
            header("location:ver_empleados.php?error=4");
            exit();
        }

        // nombre y apellidos del empleado
        $cod_empleado_actualizar = $_GET['cod_empleado'];
        $consulta2 = mysqli_query($conexion, "SELECT nombre, apellidos FROM empleados WHERE cod_empleado = ".$cod_empleado_actualizar);
        $datos_empleado = $usuario = mysqli_fetch_array($consulta2);

    echo "<main>";
        echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Nueva nomina mensual para ".$datos_empleado['nombre']." ".$datos_empleado['apellidos']."</h2>";
        echo "<div class='container mt-5'>";
            echo "<div class='justify-content-center p-4'>";
                echo "<form action='../../back/acciones/modificar_nomina.php' method='post' class='mx-auto w-75' enctype='multipart/form-data' name='nuevo_empleado'>";
                    echo "
                        <input type='hidden' name='cod_empleado' value='".$cod_empleado_actualizar."'>
                        <div class='mb-3 px-5'>
                            <label for='sueldo_base' class='form-label fw-semibold fs-5 text-primary'>Sueldo Base:</label>
                            <input type='number' step='0.0001' id='sueldo_base' name='sueldo_base' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='complementos' class='form-label fw-semibold fs-5 text-primary'>Complementos:</label>
                            <input type='number' step='0.01' id='complementos' name='complementos' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='cont_comun' class='form-label fw-semibold fs-5 text-primary'>Contingencias Comunes (porcentaje):</label>
                            <input type='number' step='0.00001' id='cont_comun' name='cont_comun' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='formacion' class='form-label fw-semibold fs-5 text-primary'>Formación (porcentaje):</label>
                            <input type='number' step='0.00001' id='formacion' name='formacion' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='desempleo' class='form-label fw-semibold fs-5 text-primary'>Desempleo (porcentaje):</label>
                            <input type='number' step='0.00001' id='desempleo' name='desempleo' class='form-control' required>
                        </div>

                        <div class='mb-3 px-5'>
                            <label for='irpf' class='form-label fw-semibold fs-5 text-primary'>IRPF (porcentaje):</label>
                            <input type='number' step='0.01' id='irpf' name='irpf' class='form-control' required>
                        </div>";


        echo"<div class='mb-3 container'>
                <div class='container d-flex justify-content-between'>
                    <input type='submit' value='Guardar' name='enviar' class='btn btn-primary m-1'>
                    <input type='reset' value='Borrar' class='btn btn-secondary m-1'>
                </div>
            </div>

                </form>";
            echo "</div>";
        echo "</div>";
    echo "</main>";

    ?>
    
</body>
</html>