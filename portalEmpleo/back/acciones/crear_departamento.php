<?php
    // archivos requeridos
    try {
        require("../auth/conexion_bbdd.php");
    } catch (Throwable $th) {
        header("location:../../front/paginas/nuevo_departamento.php?error=1");
        exit();
    }



    try {
        // ¿llego informacion de un departamento nuevo?
        if (isset($_POST['enviar'])) {
            // conectar con la BBDD
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");

            // preparar datos
            $nombre_departamento = mysqli_real_escape_string($conexion, $_POST['nombre_departamento']);
            $descripcion_departamento = mysqli_real_escape_string($conexion, $_POST['descripcion_departamento']);
            $jefe_departamento = $_POST['jefe_departamento'];

            // prepara consulta en funcion de si se asigno jefe
            if ($jefe_departamento == "") {
                $consulta = "INSERT INTO departamentos (nombre, descripcion) VALUES ('$nombre_departamento','$descripcion_departamento')";
            } else {
                $consulta = "INSERT INTO departamentos (nombre, descripcion, cod_jefe_departamento) VALUES ('$nombre_departamento','$descripcion_departamento', $jefe_departamento)";
            }

            // hacer consulta 
            try {
                mysqli_query($conexion, $consulta);
            } catch (mysqli_sql_exception $sql) {
                header("location:../../front/paginas/nuevo_departamento.php?error=2");
                exit();
            }

            // cerramos conexion y volvemos
            mysqli_close($conexion);
            header("location:../../front/paginas/nuevo_departamento.php?error=0");
            exit();
        } else {
            header("location:../../front/paginas/nuevo_departamento.php");
            exit();
        }
        
    } catch (mysqli_sql_exception $sql) {
        header("location:../../front/paginas/nuevo_departamento.php?error=2");
        exit();
    }
?>