<?php

    // archivos requeridos
    try {
        require("../auth/conexion_bbdd.php");
    } catch (\Throwable $th) {
        header("location:../../front/paginas/reportar_incidencia.php?error=1");
        exit();
    }


    try {
        if (isset($_POST['enviar'])) {
            echo "hola";
            // conectamos con la BBDD
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");


            // preparar los datos de la incidencia
            $cod_empleado_reportante = $_POST['cod_reportante'];
            $fecha_creacion = date("Y-m-d H:i:s");
            $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion_incidencia']);
            $gravedad = mysqli_real_escape_string($conexion, $_POST['gravedad_incidencia']);

            // enviar la incidencia
            try {
                mysqli_query($conexion, "INSERT INTO incidencias (cod_empleado_reportante, descripcion, gravedad, fecha_creacion) 
                VALUES ('$cod_empleado_reportante', '$descripcion', '$gravedad' , '$fecha_creacion')");
            } catch (mysqli_sql_exception $sql) {
                header("location:../../front/paginas/reportar_incidencia.php?error=2");
                exit();
            }

            // cerrar conexion
            mysqli_close($conexion);
            header("location:../../front/paginas/reportar_incidencia.php?error=0");
            exit();

        } else {
            header("location:../../front/paginas/reportar_incidencia.php?error=3");
            exit();
        }
    } catch (mysqli_sql_exception $sql) {
        header("location:../../front/paginas/reportar_incidencia.php?error=2");
        exit();
    }
?>