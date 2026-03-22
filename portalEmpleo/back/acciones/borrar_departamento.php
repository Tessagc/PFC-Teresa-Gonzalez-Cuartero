<?php
    // archivos requeridos
    try {
        require("../auth/conexion_bbdd.php");
    } catch (Throwable $th) {
        header("location:../../front/paginas/ver_departamentos.php?error=1");
        exit();
    }


    try {
        // ¿llego informacion de un departamento para borrarlo?
        if (isset($_GET['id_departamento'])) {
            // conexion con la BBDD
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");

            // borramos el empleado
            $id_borrar = $_GET['id_departamento'];
            try {
                mysqli_query($conexion, "DELETE FROM departamentos WHERE cod_departamento = $id_borrar");
            } catch (mysqli_sql_exception $sql) {
                header("location:../../front/paginas/ver_departamentos.php?error=2");
                exit();
            }


            // cerramos la conexion
            mysqli_close($conexion);
            header("location:../../front/paginas/ver_departamentos.php?error=0");
            exit();

        } else {
            header("location:../../front/paginas/ver_departamentos.php?error=3");
            exit();
        }
        
    } catch (mysqli_sql_exception $sql) {
        header("location:../../front/paginas/ver_departamentos.php?error=2");
        exit();
    }
?>