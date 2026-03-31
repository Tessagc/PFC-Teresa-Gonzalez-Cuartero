<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar departamento</title>
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

        // sacar empleados con asignacion de jefe
        $consulta2 = mysqli_query($conexion , "SELECT cod_empleado, nombre, apellidos FROM empleados WHERE rol = 'jefe'");
        
        // redirigir si no llega un departamento
        if (!isset($_GET['id_departamento'])) {
            header("location:ver_departamentos.php?error=3");
            exit();
        }

        // formulario para actualizar el departamento
        $id_departamento_editar = $_GET['id_departamento'];
        $consulta3 = mysqli_query($conexion, "SELECT * FROM departamentos WHERE cod_departamento = ".$id_departamento_editar);
        $info_actualizar = mysqli_fetch_array($consulta3);
        echo "<main>";
        echo "<h2 class='text-center mt-5 mb-4 titulo-mediano fw-bold'>Editar el departamento</h2>";
        echo "<div class='container mt-5'>";
            echo "<div class='justify-content-center p-4'>";
                echo "<form action='../../back/acciones/actualizar_departamento.php' method='post' class='mx-auto w-75' name='nuevo_departamento' enctype='application/x-www-form-urlencoded'>
                        <input type='hidden' name='cod_departamento' value='$id_departamento_editar'>
                        <div class='mb-3'>
                            <label for='nombre_departamento' class='form-label fw-semibold fs-5 text-primary'>Nombre Departamento</label>
                            <input type='text' name='nombre_departamento' id='nombre_departamento' class='form-control' minlength=8 required value='".$info_actualizar['nombre']."'>
                        </div>
                        <div class='mb-3'>
                            <label for='descripcion_departamento' class='form-label fw-semibold fs-5 text-primary'>Descripcion Departamento</label>
                            <input type='text' name='descripcion_departamento' id='descripcion_departamento' class='form-control' minlength=15 required value='".$info_actualizar['descripcion']."'>
                        </div>
                        <div class='mb-3'>
                            <label for='jefe_departamento' class='form-label fw-semibold fs-5 text-primary'>Empleado jefe (SOLO SI SE HA CAMBIADO)</label>
                            <select name='jefe_departamento' id='jefe_departamento' class='form-select'> 
                            <option value='' selected hidden>Escoja al nuevo empleado jefe</option>";
                            while ($jefes = mysqli_fetch_array($consulta2)) {
                                echo "<option value=".$jefes['cod_empleado'].">".$jefes['nombre']." ".$jefes['apellidos']."</option>";
                            }
                            echo "</select>
                        </div>
                        <div class='mb-3 container'>
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