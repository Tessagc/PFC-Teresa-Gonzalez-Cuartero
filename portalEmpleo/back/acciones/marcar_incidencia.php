<?php
    // archivos requeridos
    try {
        require("../auth/conexion_bbdd.php");
    } catch (Throwable $th) {
        header("location:../../front/paginas/ver_incidencias.php?error=1");
        exit();
    }



    try {
        if (isset($_GET['cod_incidencia'])) {
            // conexion con al BBDD
            $conexion = mysqli_connect($servidor, $usuario, $contra, $bbdd);
            mysqli_set_charset($conexion, "utf8mb4");

            // marcar la incidencia enviada como completada
            try {
                $incidencia_completada = $_GET['cod_incidencia'];
                $gestor = $_GET['empleado_gestor'];
                mysqli_query($conexion, "UPDATE incidencias SET atendida = 1, cod_empleado_gestor = $gestor WHERE cod_incidencia=".$incidencia_completada);
            } catch (mysqli_sql_exception $sql) {
                header("location:../../front/paginas/ver_incidencias.php?error=2");
                exit();
            }

            // cerrar conexion
            mysqli_close($conexion);
            header("location:../../front/paginas/ver_incidencias.php?error=0");
            exit();

        } else {
            header("location:../../front/paginas/ver_incidencias.php");
            exit();
        }
    } catch (mysqli_sql_exception $sql) {
        header("location:../../front/paginas/ver_incidencias.php?error=2");
        exit();
    }
?>
